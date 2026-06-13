<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thank You</title>
    <style>
        body {
            font-family: 'Times New Roman', 'Noto Serif JP', serif;
            margin: 0;
            padding: 0;
            background-color: #fbfaf8;
            color: #333333;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            overflow: hidden; 
        }

        .thanks-container {
            text-align: center;
                position: relative;
                z-index: 10;
        }

        /*  背景の「Thank you」 */
        .bg-text {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            font-size: 24vw;            
            color: #f4f1ed;             /
            z-index: 1;
            white-space: nowrap;
            user-select: none;
            font-weight: 300;           /* 
            letter-spacing: 0.05em;     /* 
        }

        .content-box {
            position: relative;
            z-index: 15;
        }

    
        /*  実際のHTMLのクラス名（ハイフンなし）に完全に一致させました */
        body .thanks-container .content-box .message {
            font-size: 20px;
            font-weight: bold;  /* 自然なカスケードで確実に太字になります */
            color: #ab805a;     /* 上品なこげ茶色（ブラウングレー） */
            margin-bottom: 40px;
            letter-spacing: 1px;
        }

        .btn-home {
            background-color: #7d7065;
            color: #ffffff;
            border: none;
            padding: 12px 35px;
            border-radius: 4px;
            font-size: 14px;
            font-weight: bold;
            cursor: pointer;
            text-decoration: none;
            letter-spacing: 1px;
            transition: opacity 0.2s;
        }
        .btn-home:hover {
            opacity: 0.9;
        }
    </style>
</head>
<body>

    <div class="bg-text">Thank you</div>

    <div class="thanks-container">
        <div class="content-box">
            <p class="message">お問い合わせありがとうございました</p>
            <a href="/" class="btn-home">HOME</a>
        </div>
    </div>

</body>
</html>