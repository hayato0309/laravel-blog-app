<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
</head>
<body>
    <p>Dear Mr./Ms. {{ $name }}</p>
    <p>Thank you for registering!</p>
    <p>I hope you will enjoy my service 😊</p>
    <p>To start, please access from <a href="{{ config('app.url') }}">here</a>.</p>
    <p>Thank you!</p>
</body>
</html>