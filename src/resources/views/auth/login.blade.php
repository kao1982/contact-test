<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <style>
        /* 全体のリセットと背景・フォント設定 */
        body {
            font-family: 'Times New Roman', 'Noto Serif JP', serif;
            margin: 0;
            padding: 0;
            background-color: #fbfaf8; /* 登録画面と同じ統一背景色 */
            color: #333333;
        }

        /*  ヘッダー全体：ロゴを中央、ボタンを右端に配置する設定 */
        .header {
            display: grid;
            grid-template-columns: 1fr auto 1fr; /* 画面を「左・中央・右」に3等分 */
            align-items: center;
            padding: 30px 40px;
            background-color: #ffffff;
            position: relative;
            solid #e0e0e0;
        }

        /*  ロゴタイトル（h1）を中央エリアに固定 */
        .header h1 {
            grid-column: 2;
            margin: 0;
            font-size: 32px;
            font-weight: bold;
            color: #8b7b6b;
            text-align: center;
        }

        /*  切り替えボタン：右端エリアに飛ばして、ベージュのボタン型にする */
        .header .btn-auth-switch {
            grid-column: 3;
            justify-self: end; /*  これで真横から右端へ絶対にジャンプします */
            
            /* 🎨 ここからボタンのデザイン */
            background-color: #d1c7bd;   /* デザインUIの上品なベージュ */
            color: #ffffff !important;   /* 文字色は白 */
            text-decoration: none;       /* 下線を消す */
            padding: 8px 24px;           /* ボタンらしく横長にぷっくり */
            border-radius: 5px;          /* 角のほんのり丸み */
            font-size: 14px;
            font-weight: 500;
            display: inline-block;
            transition: background-color 0.2s;
        }

        /* マウスを乗せたときに少し濃くする */
        .header .btn-auth-switch:hover {
            background-color: #bfae9e;
        }


        /* メインコンテナ */
        .container {
            max-width: 500px;
            margin: 60px auto;
            padding: 0 20px;
        }

        .page-title {
            text-align: center;
            font-size: 24px;
            font-weight: normal;
            color: #666666;
            margin-bottom: 30px;
            letter-spacing: 1px;
        }

        /* カード型のフォーム外枠 */
        .auth-card {
            background-color: #ffffff;
            padding: 40px;
            border: 1px solid #e0e0e0;
            border-radius: 4px;
        }

        .form-group {
            margin-bottom: 20px;
        }

        label {
            display: block;
            font-size: 14px;
            font-weight: bold;
            margin-bottom: 8px;
            color: #333333;
        }

        /* 入力ボックス */
        input[type="text"], input[type="password"] {
            width: 100%;
            padding: 12px;
            border: none;
            background-color: #f4f4f4;
            border-radius: 4px;
            box-sizing: border-box;
            font-size: 14px;
            color: #333333;
        }
        input::placeholder {
            color: #cccccc;
        }

        /* エラーメッセージ（通常のバリデーションとログイン失敗エラー両用） */
        .error-message {
            color: #ff5555;
            font-size: 13px;
            margin: 6px 0 0 0;
            font-family: sans-serif;
        }

        /* ログインボタン */
        .btn-submit {
            width: 100%;
            padding: 14px;
            background-color: #886955;
            color: #ffffff;
            border: none;
            border-radius: 4px;
            font-size: 15px;
            font-weight: bold;
            cursor: pointer;
            letter-spacing: 2px;
            margin-top: 20px;
        }
        .btn-submit:hover {
            background-color: #444444;
        }

        /* 会員登録へのリンク */
        .link-container {
            text-align: center;
            margin-top: 20px;
            font-size: 13px;
        }
        .link-container a {
            color: #8b7b6b;
            text-decoration: underline;
        }

        /*  切り替えボタンを右上に寄せるための枠 */
        .auth-switch-wrapper {
            display: flex;
            justify-content: flex-end; /* 右端に寄せる */
            margin-bottom: 10px;       /* 下のタイトルとの隙間 */
        }

        .btn-auth-switch {
            background-color: #d1c7bd;
            color: white;
            text-decoration: none;
            padding: 6px 16px;
            border-radius: 5px;
            font-size: 13px;
            transition: background-color 0.2s;
        }
        .btn-auth-switch:hover {
            background-color: #b8a99c;
        }
    </style>
</head>
<body>

    <div class="header">
        <h1>FashionablyLate</h1>
        <a href="/register" class="btn-auth-switch">register</a>
    </div>

    <div class="container">
        <div class="page-title">Login</div>

        <div class="auth-card">
            @error('login_error')
                <p class="error-message" style="margin-bottom: 15px; text-align: center;">{{ $message }}</p>
            @enderror

            <form action="/login" method="POST">
                @csrf

                <div class="form-group">
                    <label for="email">メールアドレス</label>
                    <input type="text" id="email" name="email" placeholder="例: test@example.com" value="{{ old('email') }}">
                    @error('email') <p class="error-message">{{ $message }}</p> @enderror
                </div>

                <div class="form-group">
                    <label for="password">パスワード</label>
                    <input type="password" id="password" name="password" placeholder="例: coachtech1106">
                    @error('password') <p class="error-message">{{ $message }}</p> @enderror
                </div>

                <button type="submit" class="btn-submit">ログイン</button>
            </form>

            <div class="link-container">
                
            </div>
        </div>
    </div>

</body>
</html>