<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Status Trainer</title>
</head>
<body>
    <h1>Status Your Account</h1>
    <p>Dear {{ $data['name'] }},</p>
    <p>{!! $data['body'] !!}.</p>
</body>
</html>
