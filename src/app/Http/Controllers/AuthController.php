<?php

namespace App\Http\Controllers;

use App\Http\Requests\RegisterRequest;
use App\Http\Requests\LoginRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    /**
     * PG08: ユーザー登録画面を表示
     */
    public function showRegister()
    {
        return view('auth.register');
    }

    /**
     * ユーザー登録処理を実行
     */
    public function register(RegisterRequest $request)
    {
        // データを安全に暗号化してユーザーを作成
        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password), // パスワードは必ずハッシュ化（暗号化）
        ]);

        // 登録できたら自動でログインさせて管理画面へ
        return redirect('/admin');
    }

    /**
     * PG09: ログイン画面を表示
     */
    public function showLogin()
    {
        return view('auth.login');
    }

    /**
     * ログイン処理を実行
     */
    public function login(LoginRequest $request)
    {
        // メールアドレスとパスワードの組み合わせをチェック
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            // ログイン成功したらセッションを再生成して管理画面へ
            $request->session()->regenerate();
            return redirect('/admin');
        }

        // ログイン失敗時はエラーメッセージを返して戻る
        return back()->withErrors([
            'login_error' => 'メールアドレスまたはパスワードが正しくありません',
        ])->withInput($request->only('email'));
    }

    /**
     * PG10: ログアウト処理
     */
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        // ログアウトしたらログイン画面へ戻す
        return redirect('/login');
    }
}