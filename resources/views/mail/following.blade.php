<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>following message</title>
</head>

<body style="font-family: 'Arial', sans-serif; margin: 0; padding: 0; background-color: #f4f4f4;">

    <div
        style="max-width: 600px; margin: 50px auto; padding: 20px; background-color: #fff; box-shadow: 0 0 10px rgba(0, 0, 0, 0.1); border-radius: 5px;">

        <h2 style="color: #333;">Hello {{ $followerUser }}</h2>

        <p style="color: #555;">{{ $followingUser }} want to follow you</p>

        <p style="color: #555;">Thank you, {{ config('app.name') }} team</p>

    </div>

</body>

</html>
