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
<h2>安否確認bot for LINE WORKS初期設定のご案内</h2>

<div>
    <p>{{ $data['name'] }} ご担当者様</p>
    <p>安否確認bot for LINE WORKSにお申し込みいただき、ありがとうございます。</p>
    <p>以下のリンクから初期設定を行い、ご利用を開始してください。
        <a href="{{env('APP_URL') . '/setting/company-activation/' . $data['token']}}">{{env('APP_URL') . '/setting/company-activation/' . $data['token']}}</a></p>
    <p>メールアドレス: {{ $data['email'] }}</p>
    <p>初期パスワード: {{ $data['password'] }}</p>
    <br/>
    <p>本メールは安否確認bot for LINE WORKSより自動的に配信されています。</p>
</div>

</body>
</html>
