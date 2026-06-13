<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Confirm</title>
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
            color: #8b7b6b; /* 上品なブラウングレー */
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

        /* テーブル（表）全体のスタイル */
        .confirm-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 40px;
        }

        .confirm-table th, .confirm-table td {
            padding: 16px 20px;
            font-size: 15px;
            text-align: left;
            border-bottom: 1px solid #ffffff; /* 行間の区切り（白線） */
        }

        /* 左側のラベル（デザインUIのブラウングレー背景） */
        .confirm-table th {
            width: 200px;
            background-color: #bfae9e; /* 画像特有のくすんだブラウンベージュ */
            color: #ffffff;
            font-weight: bold;
        }

        /* 右側の値（薄いグレーの背景） */
        .confirm-table td {
            background-color: #f7f7f7;
            color: #333333;
        }

        /* ボタンエリア（中央寄せ、横並び） */
        .btn-container {
            display: flex;
            justify-content: center;
            gap: 40px;
            margin-top: 40px;
        }

        button {
            padding: 12px 0;
            border-radius: 4px;
            font-size: 15px;
            font-weight: bold;
            cursor: pointer;
            letter-spacing: 2px;
            transition: opacity 0.2s;
        }
        button:hover {
            opacity: 0.8;
        }

        /* 送信ボタン（シックなダークグレー） */
        .btn-submit {
            width: 160px;
            background-color: #7d7065; /* 指示書の落ち着いたブラウングレー */
            color: #ffffff;
            border: none;
        }

        /* 修正ボタン（シンプルなリンク風、または薄い線） */
        .btn-back {
            background-color: transparent;
            color: #8b7b6b;
            border: none;
            text-decoration: underline;
            font-size: 14px;
            font-weight: normal;
        }
    </style>
</head>
<body>

    <div class="header">
        <h1>FashionablyLate</h1>
    </div>

    <div class="container">
        <div class="page-title">Confirm</div>

        <form action="/contact/thanks" method="POST">
            @csrf

            <input type="hidden" name="name" value="{{ $data['name'] }}">
            <input type="hidden" name="gender" value="{{ $data['gender'] }}">
            <input type="hidden" name="email" value="{{ $data['email'] }}">
            <input type="hidden" name="tel" value="{{ $data['tel'] }}">
            <input type="hidden" name="address" value="{{ $data['address'] }}">
            <input type="hidden" name="category" value="{{ $data['category'] }}">
            <input type="hidden" name="content" value="{{ $data['content'] }}">

            <table class="confirm-table">
                <tr>
                    <th>お名前</th>
                    <td>{{ $data['name'] }}</td>
                </tr>
                <tr>
                    <th>性別</th>
                    <td>
                        @if($data['gender'] == 'male') 男性
                        @elseif($data['gender'] == 'female') 女性
                        @else その他 @endif
                    </td>
                </tr>
                <tr>
                    <th>メールアドレス</th>
                    <td>{{ $data['email'] }}</td>
                </tr>
                <tr>
                    <th>電話番号</th>
                    <td>{{ str_replace('-', '', $data['tel']) }}</td>
                </tr>
                <tr>
                    <th>住所</th>
                    <td>{{ $data['address'] }}</td>
                </tr>
                <tr>
                    <th>お問い合わせの種類</th>
                    <td>
                        @if($data['category'] == '1') 商品のお届けについて
                        @elseif($data['category'] == '2') 商品の交換について
                        @elseif($data['category'] == '3') 商品トラブル
                        @elseif($data['category'] == '4') ショップへのお問い合わせ
                        @else その他 @endif
                    </td>
                </tr>
                <tr>
                    <th>お問い合わせ内容</th>
                    <td>{!! nl2br(e($data['content'])) !!}</td>
                </tr>
            </table>

            <div class="btn-container">
                <button type="submit" class="btn-submit">送信</button>
                <button type="button" class="btn-back" onclick="history.back()">修正</button>
            </div>
        </form>
    </div>

</body>
</html>