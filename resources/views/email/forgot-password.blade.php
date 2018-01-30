<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>安否確認bot for LINE WORKS</title>
</head>
<body>
<h2>パスワード再設定のご案内</h2>

<div>
    <p>ご担当者様</p>
    <p>パスワードの再設定を受け付けました。次のリンクでパスワードの再設定が出来ます。</p>
    <p>次のURLから、パスワードの再設定をお願いします: <a href="{{ env('APP_URL') . '/password/reset/' . $token .'?email='. $email }}">パスワードを再設定する</a></p>
    <p>もしこのメールに心当たりがない場合、support@ampi.bizまでご連絡ください。</p>
    <p>もしボタンがクリックできない場合、</p>
    <p>次のURLをコピーして、ブラウザに貼り付けて開いてください: {{ env('APP_URL') . '/password/reset/' . $token .'?email='. $email  }}</p>
    <br/>
    <p>本メールは安否確認bot for LINE WORKSより自動的に配信されています。</p>
</div>
</body>
</html>
