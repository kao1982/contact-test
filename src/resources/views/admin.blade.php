<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel</title>
    <style>
        body {
            font-family: 'Times New Roman', 'Noto Serif JP', serif;
            margin: 0;
            padding: 0;
            background-color: #fbfaf8;
            /* 💡 画面全体の文字色をデザインUIの上品なこげ茶色に統一します */
            color: #7d7065; 
        }

        /*  ヘッダーエリアとログアウトボタン */
        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 20px 40px;
            border-bottom: 1px solid #e0e0e0;
            background-color: #ffffff;
        }
        .header h1 {
            font-size: 26px;
            font-weight: normal;
            color: #745d4c;
            margin: 0;
            letter-spacing: 1px;
        }
        .btn-logout {
            background-color: transparent;
            border: 1px solid #745d4c;
            color: #745d4c;
            padding: 8px 16px;
            border-radius: 4px;
            cursor: pointer;
            font-size: 13px;
            transition: all 0.2s;
        }
        .btn-logout:hover {
            background-color: #745d4c;
            color: #ffffff;
        }

        /* 全体を囲む器（ページいっぱいに広がらないように1100pxに固定し、中央寄せします） */
        .container {
            max-width: 1100px;
            margin: 40px auto;
            padding: 0 20px;
            box-sizing: border-box;
        }

        .page-title {
            text-align: center;
            font-size: 24px;
            font-weight: normal;
            color: #745d4c;
            margin-bottom: 30px;
            letter-spacing: 1px;
        }

        /*  検索フォーム全体（絶対に折り返さず、自然なサイズで横一列に並べる） */
        .search-form {
            display: flex;
            align-items: center;
            flex-wrap: nowrap;     /* 絶対に2列に折り返さない */
            gap: 12px;             /* アイテム同士の程よいすき間 */
            margin-bottom: 30px;
            width: 100%;
        }

        /* 各入力項目の箱（絶対に縮まないように固定） */
        .form-item {
            display: flex;
            align-items: center;
            flex-shrink: 0;       /*  周りに押されても絶対に縮まない設定 */
        }

        /* 入力ボックス・セレクトボックスの見た目調整 */
        .form-item input[type="text"] {
            width: 280px;         /* 名前やメールアドレス欄の横幅 */
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
            color: #7d7065;
            font-size: 14px;
            background-color: #ffffff;
        }

        .form-item select {
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
            color: #7d7065;
            font-size: 14px;
            background-color: #ffffff;
        }

        /* 日時選択ボックスの横幅 */
        .date-picker-container input {
            width: 150px;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
            color: #7d7065;
            font-size: 14px;
            background-color: #ffffff;
            box-sizing: border-box;
        }

        .date-picker-container input::placeholder {
            color: #b0a499;
            opacity: 1; /* Firefox対策 */
        }

        /* 検索ボタン */
        .btn-search {
            background-color: #7d7065;
            color: white;
            border: none;
            padding: 10px 22px;
            border-radius: 4px;
            cursor: pointer;
            white-space: nowrap;  /* 文字の改行を防ぐ */
            font-size: 14px;
            flex-shrink: 0;
        }

        /* 🔄 リセットボタン（薄いベージュ） */
        .btn-reset {
            background-color: #d1c7bd;
            color: white;
            border: none;
            padding: 10px 22px;
            border-radius: 4px;
            cursor: pointer;
            white-space: nowrap;
            text-decoration: none; 
            font-size: 14px;
            display: inline-block;
            text-align: center;
            flex-shrink: 0;
        }

        /*  アクションバー（エクスポートと件数表示） */
        .table-actions {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 15px;
        }
        .btn-export {
            background-color: #ffffff;
            border: 1px solid #e0e0e0;
            color: #7d7065;
            padding: 8px 16px;
            border-radius: 4px;
            cursor: pointer;
            font-size: 13px;
            font-weight: bold;
        }
        .pagination-mock {
            font-size: 14px;
            color: #777777;
        }

        /*  ページネーション全体の枠 */
        .pagination-wrapper {
            display: flex;
            justify-content: center;
            margin-top: 30px;
        }

        /* Laravelが自動生成する ul タグを横並びにする（最重要！） */
        .pagination-wrapper ul.pagination {
            display: flex ;
            list-style: none; /* 縦並びの「・」を消す */
            padding: 0;
            margin: 0;
        }

        /*  ボタンの見た目 */
        .pagination-wrapper .page-item .page-link {
            color: #745d4c; /* こげ茶 */
            background-color: #ffffff;
            border: 1px solid #d1c7bd; /* ベージュの枠線 */
            padding: 8px 16px;
            border-radius: 4px;
            text-decoration: none;
        }

        /* ページのボタン色 */
        .pagination-wrapper .page-item.active .page-link {
            background-color: #745d4c; /* 濃いこげ茶 */
            border-color: #745d4c;
            color: #ffffff;
        }

        /* マウスを乗せたときの変化 */
        .pagination-wrapper .page-item .page-link:hover {
            background-color: #f0eae4;
        }

       /* データ一覧テーブル */
        .data-table {
            width: 100%;         /*  検索バーのトータル幅に合わせます */
            border-collapse: collapse;
            background-color: #ffffff;
            border: 1px solid #e0e0e0;
            table-layout: fixed;  /* 各列の幅をガチッと固定する */
            margin-top: 15px;
            margin-left: 0;       /*  左端を検索バーのスタート位置と揃えます */
            box-shadow: 0 2px 5px rgba(0,0,0,0.02);
        }
        
        /* 列ごとの幅の比率を調整 */
        .data-table th:nth-child(1) { width: 15%; } /* お名前 */
        .data-table th:nth-child(2) { width: 10%; } /* 性別 */
        .data-table th:nth-child(3) { width: 30%; } /* メールアドレス */
        .data-table th:nth-child(4) { width: 33%; } /* お問い合わせの種類 */
        .data-table th:nth-child(5) { width: 12%; } /* 詳細ボタン用の列 */

        .data-table th, .data-table td {
            color: #7d7065;
            padding: 14px 15px;
            font-size: 14px;
            text-align: left;
            border-bottom: 1px solid #dbcaca; /* ほんのり茶系の線 */
        }
        .data-table th {
            background-color: #745d4c;  /* テーブルヘッダーのヘッダー色 */
            color: #ffffff;
            font-weight: bold;
        }
        .data-table tr:hover td {
            background-color: #fbfaf8;
        }

        /*  詳細ボタンのスタイル */
        .btn-detail {
            background-color: #bfae9e;
            color: white;
            border: none;
            padding: 7px 16px;
            border-radius: 4px;
            cursor: pointer;
            font-size: 13px;
            display: inline-block;
            text-align: center;
        }

        /* 下半分だけを綺麗に中央寄せするための透明な箱 */
        .table-container {
            max-width: 945px;     /* 検索バーと同じトータルの幅に合わせます */
            margin: 0 auto;       /* これで下半分だけが画面の真ん中に寄ります */
            padding: 0;
        }

        /*  アクションバーの修正 */
        .table-actions {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 15px;
            width: 100%;          /* ここも透明な箱の幅に合わせます */
        }

        /*  削除完了メッセージのボックス */
        .alert-success {
            background-color: #f0eae4; /* 画面に馴染む淡いベージュグレー */
            border-left: 4px solid #745d4c; /* アクセントのこげ茶線 */
            color: #745d4c;
            padding: 12px 20px;
            margin-bottom: 20px;
            border-radius: 4px;
            font-size: 14px;
            letter-spacing: 0.5px;
        }
    </style>
</head>
<body>

    <div class="header">
        <h1>FashionablyLate</h1>
        <form action="/logout" method="POST">
            @csrf
            <button type="submit" class="btn-logout">ログアウト</button>
        </form>
    </div>

    <div class="container">
        <div class="page-title">Admin</div>

        @if (session('success'))
        <div class="alert-success">
            {{ session('success') }}
        </div>
        @endif

        <form action="/search" method="GET" class="search-form">
    @csrf
    <div class="form-item">
        <input type="text" name="keyword" value="{{ request('keyword') }}" placeholder="名前やメールアドレスを入力してください">
    </div>
    
    <div class="form-item">
        <select name="gender">
            <option value="">性別</option>
            <option value="1" {{ request('gender') == 'male' ? 'selected' : '' }}>男性</option>
            <option value="2" {{ request('gender') == 'female' ? 'selected' : '' }}>女性</option>
            <option value="3" {{ request('gender') == 'other' ? 'selected' : '' }}>その他</option>
        </select>
    </div>

    <div class="form-item">
        <select name="category">
            <option value="">お問い合わせの種類</option>
            <option value="1" {{ request('category') == '1' ? 'selected' : '' }}>1，商品のお届について</option>
            <option value="2" {{ request('category') == '2' ? 'selected' : '' }}>2，商品の交換について</option>
            <option value="3" {{ request('category') == '3' ? 'selected' : '' }}>3，商品トラブル</option>
            <option value="4" {{ request('category') == '4' ? 'selected' : '' }}>4，ショップへのお問い合わせ</option>
            <option value="5" {{ request('category') == '5' ? 'selected' : '' }}>5，その他</option>
        </select>
    </div>

    <div class="form-item date-picker-container">
        <input type="text" name="date" value="{{ request('date') }}" placeholder="年/月/日" onfocus="(this.type='date')" onblur="if(!this.value)this.type='text'">
    </div>

    <button type="submit" class="btn-search">検索</button>
    <a href="/admin" class="btn-reset">リセット</a>
</form>
        </div>

        <div class="table-container">
            <div class="table-actions">
                <button class="btn-export" onclick="location.href='/export'">エクスポート</button>
                <div class="pagination-wrapper">
                {{ $contacts->links('pagination::bootstrap-4') }}
                </div>
            </div>

        <table class="data-table">
            <thead>
                <tr>
                    <th>お名前</th>
                    <th>性別</th>
                    <th>メールアドレス</th>
                    <th>お問い合わせの種類</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                
            @forelse($contacts as $contact)
                <tr>
                    <td>{{ $contact->last_name }} {{ $contact->first_name }}</td>
                    <td>
                        @if($contact->gender == 1) 男性
                        @elseif($contact->gender == 2) 女性
                        @elseif($contact->gender == 3) その他
                        @endif
                    </td>
                    <td>{{ $contact->email }}</td>
                    <td>
                        @if($contact->category_id == 1) 商品のお届けについて
                        @elseif($contact->category_id == 2) 商品の交換について
                        @elseif($contact->category_id == 3) 商品トラブル
                        @elseif($contact->category_id == 4) ショップへのお問い合わせ
                        @elseif($contact->category_id == 5) その他@endif
</td>
                    <td>
                        <button class="btn-detail" onclick="openModal('{{ $contact->id }}', '{{ $contact->last_name }} {{ $contact->first_name }}', '{{ $contact->gender == 1 ? '男性' : ($contact->gender == 2 ? '女性' : 'その他') }}', '{{ $contact->email }}', '{{ $contact->tel }}', '{{ $contact->address }}', '{{ $contact->building ?? '' }}', '{{ $contact->category_id == 1 ? '商品のお届について' : ($contact->category_id == 2 ? '商品の交換について' : ($contact->category_id == 3 ? '商品トラブル' : ($contact->category_id == 4 ? 'ショップへのお問い合わせ' : ($contact->category_id == 5 ? 'その他' : '')))) }}', '{{ e(str_replace(["\r\n", "\r", "\n"], ' ', $contact->detail ?? '')) }}')">詳細</button>
                    </td>
                </tr>

                @empty
                <tr>
                    <td colspan="5" style="text-align: center; color: #999999; padding: 40px 0;">
                        登録されているお問い合わせデータがありません。
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
        </div>
    </div>

    <div id="detailModal" class="modal" style="display: none; position: fixed; z-index: 100; left: 0; top: 0; width: 100%; height: 100%; background-color: rgba(0,0,0,0.4);">
        <div class="modal-content" style="background-color: #fff; margin: 5% auto; padding: 40px; border-radius: 8px; width: 45%; position: relative; box-shadow: 0 4px 20px rgba(0,0,0,0.15);">
            <span class="close-btn" onclick="closeModal()" style="position: absolute; right: 25px; top: 20px; font-size: 28px; cursor: pointer; color: #aaaaaa;">×</span>
            
            <table style="width: 100%; border-collapse: collapse; margin-top: 10px; font-size: 15px;">
                <tr style="border-bottom: 1px solid #eeeeee;"><th style="text-align: left; padding: 15px 10px; width: 35%; color: #555;">お名前</th><td id="modal-name" style="padding: 15px 10px;"></td></tr>
                <tr style="border-bottom: 1px solid #eeeeee;"><th style="text-align: left; padding: 15px 10px; color: #555;">性別</th><td id="modal-gender" style="padding: 15px 10px;"></td></tr>
                <tr style="border-bottom: 1px solid #eeeeee;"><th style="text-align: left; padding: 15px 10px; color: #555;">メールアドレス</th><td id="modal-email" style="padding: 15px 10px; word-break: break-all;"></td></tr>
                <tr style="border-bottom: 1px solid #eeeeee;"><th style="text-align: left; padding: 15px 10px; color: #555;">電話番号</th><td id="modal-tel" style="padding: 15px 10px;"></td></tr>
                <tr style="border-bottom: 1px solid #eeeeee;"><th style="text-align: left; padding: 15px 10px; color: #555;">住所</th><td id="modal-address" style="padding: 15px 10px;"></td></tr>
                <tr style="border-bottom: 1px solid #eeeeee;"><th style="text-align: left; padding: 15px 10px; color: #555;">建物名</th><td id="modal-building" style="padding: 15px 10px;"></td></tr>
                <tr style="border-bottom: 1px solid #eeeeee;"><th style="text-align: left; padding: 15px 10px; color: #555;">お問い合わせの種類</th><td id="modal-category" style="padding: 15px 10px;"></td></tr>
                <tr style="border-bottom: 1px solid #eeeeee;"><th style="text-align: left; padding: 15px 10px; color: #555; vertical-align: top;">お問い合わせ内容</th><td id="modal-detail" style="padding: 15px 10px; white-space: pre-wrap; line-height: 1.6;"></td></tr>
            </table>

            <div style="text-align: center; margin-top: 30px;">
                <form id="delete-form" action="/delete" method="POST" onsubmit="return confirm('本当に削除しますか？')">
                    @csrf
                    <input type="hidden" name="id" id="modal-id">
                    <button type="submit" style="background-color: #e06666; color: white; border: none; padding: 10px 35px; border-radius: 4px; font-size: 14px; cursor: pointer;">削除</button>
                </form>
            </div>
        </div>
    </div>

</body>

<script>
    function openModal(id, name, gender, email, tel, address, building, category, detail) {
        document.getElementById('modal-id').value = id;
        document.getElementById('modal-name').innerText = name;
        document.getElementById('modal-gender').innerText = gender;
        document.getElementById('modal-email').innerText = email;
        document.getElementById('modal-tel').innerText = tel;
        document.getElementById('modal-address').innerText = address;
        document.getElementById('modal-building').innerText = building;
        document.getElementById('modal-category').innerText = category;
        document.getElementById('modal-detail').innerText = detail;
        
        document.getElementById('detailModal').style.display = 'block';
    }

    function closeModal() {
        document.getElementById('detailModal').style.display = 'none';
    }

    window.onclick = function(event) {
        var modal = document.getElementById('detailModal');
        if (event.target == modal) {
            modal.style.display = 'none';
        }
    }
</script>

</html>
