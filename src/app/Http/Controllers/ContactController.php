<?php

namespace App\Http\Controllers;


use App\Http\Requests\ContactRequest; 
use Illuminate\Http\Request;

class ContactController extends Controller
{
    /**
     * お問い合わせ入力画面を表示する
     */
    public function index()
    {
        return view('index');
    }

    /**
     * フォームの入力を受け取り、バリデーションを実行する
     */
    public function confirm(ContactRequest $request)
    {
        // 入力データを取得
        $input = $request->all();

        //  姓と名を合体させて「name」を作る
        $input['name'] = $input['last_name'] . ' ' . $input['first_name'];

        //  3つの電話番号をハイフンで結んで「tel」を作る
        $input['tel'] = $input['tel_1'] . '-' . $input['tel_2'] . '-' . $input['tel_3'];

        // 綺麗にまとめたデータを、そのまま確認画面（confirm）に渡す
        return view('confirm', ['data' => $input]);
    }

    /**
     * 確認画面から送信ボタンが押されたときの処理
     */
    public function thanks(Request $request)
    {
        // 1. 画面から送られてきたデータをまとめてデータベースに保存！
        \App\Models\Contact::create([
            'name'     => $request->name,
            'gender'   => $request->gender,
            'email'    => $request->email,
            'tel'      => $request->tel,
            'address'  => $request->address,
            'category' => $request->category,
            'content'  => $request->content,
        ]);

        // 2. 保存が終わったら、サンクスページの画面（views/thanks.blade.php）を表示
        return view('thanks');
    }

    
    public function admin()
    {
        // データベースから、最新順（created_atが新しい順）にお問い合わせデータを全件取得
        // 1ページ7件ずつに分割する
        $contacts = \App\Models\Contact::latest()->paginate(7);
        // 取得したデータを管理画面（views/admin.blade.php）に渡して表示
        return view('admin', compact('contacts'));
    }

    /**
     *  お問い合わせの検索処理
     */
    public function search(Request $request)
    {
        // 検索クエリの準備
        $query = \App\Models\Contact::query();

        // 1. 名前やメールアドレスでの検索（キーワード入力がある場合）
        if ($request->filled('keyword')) {
            $keyword = $request->keyword;
            
            //  確実に全角・半角スペースをすべて消去する命令（preg_replace）
            $cleanKeyword = preg_replace('/\s| /u', '', $keyword);

            $query->where(function($q) use ($keyword, $cleanKeyword) {
                $q->where('last_name', 'like', '%' . $keyword . '%')
                ->orWhere('first_name', 'like', '%' . $keyword . '%')
                // データベース側も全角・半角スペースを完全に消去して比較します
                ->orWhere(\DB::raw("REPLACE(REPLACE(CONCAT(last_name, first_name), ' ', ''), ' ', '')"), 'like', '%' . $cleanKeyword . '%')
                ->orWhere('email', 'like', '%' . $keyword . '%');
            });
        }

        // 2. 性別での検索
        if ($request->filled('gender')) {
            $query->where('gender', $request->gender);
        }

        // 3. お問い合わせの種類での検索
        if ($request->filled('category')) {
            
            $query->where('category_id', $request->category);
        }

        // 4. 日付での検索
        if ($request->filled('date')) {
            $query->whereDate('created_at', $request->date);
        }

        // 検索結果を最新順に取得
        $contacts = $query->latest()->paginate(7)->appends($request->only(['keyword', 'gender', 'category', 'date']));

        // 検索結果を管理画面に送る
        return view('admin', compact('contacts'));
    }

    // 管理画面のポップアップから送られてきたデータを削除する処理
    public function delete(Request $request)
    {
        // 1. ポップアップの隠しパラメータから送られてきた「ID」を取得
        $id = $request->input('id');

        // 2. データベースからそのIDのデータをデータを見つけて削除
        if ($id) {
            // あなたの環境のモデル名に合わせてください（一般的にはContactかOpinionなど）
            \App\Models\Contact::find($id)->delete();
        }

        // 3. 削除が終わったら、メッセージ付きで元の管理画面に戻る
        return redirect('/admin')->with('success', 'お問い合わせデータを削除しました');
    }

    // 表示されているデータをCSVでダウンロードする処理
    public function export(Request $request)
    {
        // 1. ダウンロードされるCSVのファイル名（例: contacts_20260612.csv）
        $fileName = 'contacts_' . date('Ymd') . '.csv';

        // 2. データベースから全データを取得（検索条件を引き継ぐ場合は別途調整）
        $contacts = \App\Models\Contact::all();

        // 3. CSVデータを作成するための準備
        $headers = [
            "Content-type"        => "text/csv",
            "Content-Disposition" => "attachment; filename=$fileName",
            "Pragma"              => "no-cache",
            "Cache-Control"       => "must-revalidate, post-check=0, pre-check=0",
            "Expires"             => "0"
        ];

        // 4. 出力バッファを開いてCSVに書き込む
        $callback = function() use ($contacts) {
            $file = fopen('php://output', 'w');
            
            // Excelで文字化けしないための魔法のコード（BOM付与）
            fwrite($file, "\xEF\xBB\xBF");

            // CSVの1行目（ヘッダー・項目名）
            fputcsv($file, ['ID', 'お名前', '性別', 'メールアドレス', 'ご意見', '登録日時']);

            // データの書き込み
            foreach ($contacts as $contact) {
                // 性別の数値を文字に変換（1:男性, 2:女性 のような場合）
                $gender = $contact->gender == 1 ? '男性' : '女性';

                fputcsv($file, [
                    $contact->id,
                    $contact->name ?? $contact->first_name . ' ' . $contact->last_name,
                    $gender,
                    $contact->email,
                    $contact->content,
                    $contact->created_at->format('Y-m-d H:i:s'),
                ]);
            }
            fclose($file);
        };

        // 5. CSVファイルとしてブラウザにダウンロードさせる
        return response()->stream($callback, 200, $headers);
    }

}