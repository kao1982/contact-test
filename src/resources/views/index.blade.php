<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact</title>
    <style>
        /* 全体のリセットと背景・フォント設定 */
        body {
            font-family: 'Times New Roman', 'Noto Serif JP', serif;
            margin: 0;
            padding: 0;
            background-color: #ffffff;
            color: #333333;
        }

        /* ヘッダーのロゴエリア */
        .header {
            text-align: center;
            padding: 30px 0;
            border-bottom: 1px solid #e0e0e0;
        }
        .header h1 {
            font-size: 32px;
            font-weight: normal;
            color: #8b7b6b; /* 画像特有の上品なブラウングレー */
            margin: 0;
            letter-spacing: 1px;
        }

        /* メインコンテナ */
        .container {
            max-width: 650px;
            margin: 40px auto;
            padding: 0 20px;
        }

        .page-title {
            text-align: center;
            font-size: 24px;
            font-weight: normal;
            color: #666666;
            margin-bottom: 40px;
            letter-spacing: 1px;
        }

        /* フォームの各行のレイアウト */
        .form-group {
            display: flex;
            margin-bottom: 25px;
            align-items: flex-start;
        }

        /* 左側のラベルエリア */
        .label-container {
            width: 200px;
            padding-top: 8px;
        }
        label {
            font-size: 15px;
            font-weight: bold;
            color: #333333;
        }
        .required {
            color: #ff9999; /* 画像の淡いピンク赤の※マーク */
            margin-left: 5px;
            font-size: 14px;
        }

        /* 右側の入力エリア */
        .input-container {
            flex: 1;
        }

        /* 入力ボックスの共通デザイン */
        input[type="text"], select, textarea {
            width: 100%;
            padding: 12px;
            border: none;
            background-color: #f4f4f4; /* 参照UIの薄グレー */
            border-radius: 4px;
            box-sizing: border-box;
            font-size: 14px;
            color: #333333;
        }
        input[type="text"]::placeholder, textarea::placeholder {
            color: #cccccc;
        }

        /* 姓・名の横並び設定 */
        .name-group {
            display: flex;
            gap: 20px;
        }

        /* 性別のラジオボタン（カスタムデザイン） */
        .gender-group {
            display: flex;
            gap: 20px;
            padding-top: 8px;
        }
        .gender-group label {
            font-weight: normal;
            font-size: 14px;
            display: flex;
            align-items: center;
            cursor: pointer;
        }
        .gender-group input[type="radio"] {
            margin-right: 6px;
        }

        /* 電話番号の3分割設定 */
        .tel-group {
            display: flex;
            align-items: center;
            gap: 10px;
        }
        .tel-group input {
            text-align: center;
        }
        .tel-span {
            color: #333333;
        }

        /* お問い合わせ内容のテキストエリア */
        textarea {
            height: 120px;
            resize: none;
        }

        /* エラーメッセージ（入力欄の真下に綺麗に配置） */
        .error-message {
            color: #ff5555;
            font-size: 13px;
            margin: 6px 0 0 0;
            font-family: sans-serif;
        }

        /* ボタンエリア（黒いシックなボタン） */
        .btn-container {
            text-align: center;
            margin-top: 40px;
            padding-left: 200px; /* ラベルの幅と合わせる */
        }
        button {
            width: 100%;
            padding: 14px;
            background-color: #886955; /* 漆黒に近いボタン色 */
            color: #ffffff;
            border: none;
            border-radius: 4px;
            font-size: 15px;
            font-weight: bold;
            cursor: pointer;
            letter-spacing: 2px;
            transition: background-color 0.2s;
        }
        button:hover {
            background-color: #444444;
        }
    </style>
</head>
<body>

    <div class="header">
        <h1>FashionablyLate</h1>
    </div>

    <div class="container">
        <div class="page-title">Contact</div>

        <form action="/contact/confirm" method="POST">
            @csrf

            <div class="form-group">
                <div class="label-container">
                    <label>お名前<span class="required">※</span></label>
                </div>
                <div class="input-container">
                    <div class="name-group">
                        <input type="text" name="last_name" placeholder="例: 山田" value="{{ old('last_name') }}">
                        <input type="text" name="first_name" placeholder="例: 太郎" value="{{ old('first_name') }}">
                    </div>
                    @error('last_name') <p class="error-message">{{ $message }}</p> @enderror
                    @error('first_name') <p class="error-message">{{ $message }}</p> @enderror
                </div>
            </div>

            <div class="form-group">
                <div class="label-container">
                    <label>性別<span class="required">※</span></label>
                </div>
                <div class="input-container">
                    <div class="gender-group">
                        <label><input type="radio" name="gender" value="male" {{ old('gender') == 'male' ? 'checked' : '' }}> 男性</label>
                        <label><input type="radio" name="gender" value="female" {{ old('gender') == 'female' ? 'checked' : '' }}> 女性</label>
                        <label><input type="radio" name="gender" value="other" {{ old('gender') == 'other' ? 'checked' : '' }}> その他</label>
                    </div>
                    @error('gender') <p class="error-message">{{ $message }}</p> @enderror
                </div>
            </div>

            <div class="form-group">
                <div class="label-container">
                    <label for="email">メールアドレス<span class="required">※</span></label>
                </div>
                <div class="input-container">
                    <input type="text" id="email" name="email" placeholder="例: test@example.com" value="{{ old('email') }}">
                    @error('email') <p class="error-message">{{ $message }}</p> @enderror
                </div>
            </div>
            
            <div class="form-group">
                <div class="label-container">
                    <label>電話番号<span class="required">※</span></label>
                </div>
                <div class="input-container">
                    <div class="tel-group">
                        <input type="text" name="tel_1" placeholder="例: 080" value="{{ old('tel_1') }}">
                        - 
                        <input type="text" name="tel_2" placeholder="例: 1234" value="{{ old('tel_2') }}">
                        - 
                        <input type="text" name="tel_3" placeholder="例: 5678" value="{{ old('tel_3') }}">
                    </div>
                    
                    @if ($errors->has('tel_1') || $errors->has('tel_2') || $errors->has('tel_3'))
                        <p class="error-message" style="color: red; margin: 5px 0 0 0; font-size: 14px; text-align: left; width: 100%;">
                            {{ $errors->first('tel_1') ?? $errors->first('tel_2') ?? $errors->first('tel_3') }}
                        </p>
                    @endif
                </div>
            </div>

            <div class="form-group">
                <div class="label-container">
                    <label for="address">住所<span class="required">※</span></label>
                </div>
                <div class="input-container">
                    <input type="text" id="address" name="address" placeholder="例: 東京都渋谷区千駄ヶ谷1-2-3" value="{{ old('address') }}">
                    @error('address') <p class="error-message">{{ $message }}</p> @enderror
                </div>
            </div>

            <div class="form-group">
                <div class="label-container">
                    <label for="building">建物名</label>
                </div>
                <div class="input-container">
                    <input type="text" id="building" name="building" placeholder="例) 千駄ヶ谷マンション101" value="{{ old('building') }}">
                </div>
            </div>

            <div class="form-group">
                <div class="label-container">
                    <label for="category">お問い合わせの種類<span class="required">※</span></label>
                </div>
                <div class="input-container">
                    <select id="category" name="category">
                        <option value="">選択してください</option>
                        <option value="1" {{ old('category') == '1' ? 'selected' : '' }}>1，商品のお届けについて</option>
                        <option value="2" {{ old('category') == '2' ? 'selected' : '' }}>2，商品の交換について</option>
                        <option value="3" {{ old('category') == '3' ? 'selected' : '' }}>3，商品トラブル</option>
                        <option value="4" {{ old('category') == '4' ? 'selected' : '' }}>4，ショップへのお問い合わせ</option>
                        <option value="5" {{ old('category') == '5' ? 'selected' : '' }}>5，その他</option>
                    </select>
                    @error('category') <p class="error-message">{{ $message }}</p> @enderror
                </div>
            </div>

            <div class="form-group">
                <div class="label-container">
                    <label for="content">お問い合わせ内容<span class="required">※</span></label>
                </div>
                <div class="input-container">
                    <textarea id="content" name="content" placeholder="お問い合わせ内容をご記載ください">{{ old('content') }}</textarea>
                    @error('content') <p class="error-message">{{ $message }}</p> @enderror
                </div>
            </div>

            <div class="btn-container">
                <button type="submit">確認画面へ</button>
            </div>
        </form>
    </div>

</body>
</html>