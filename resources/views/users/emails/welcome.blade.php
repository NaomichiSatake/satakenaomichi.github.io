<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>

    <div class="email-header">
        <h1>Welcome to Ainsta App!</h1>
    </div>

    <div class="email-body">
        <p class="name">Hi {{$name }}</p>
        <p>Thanks you for signing up to Insta app. We're excited to have you on board!</p>
        <p>To get started, please conrirm your email address by clicking the button bellow:</p>
        <p><a href="{{$app_url}}" class="button">Confirm Email Address</a></p>
        <p>Ifyou did not sign up for this account, you can ignore this emial.</p>
        <p>Best friends, <br>The Team</p>
    </div>

    <div class="email-footer">
        <p>&copy; 2024 kredo Insta App. All rights reserved.</p>
    </div>

</body>

<style>
    /* General Reset */
body {
    font-family: Arial, sans-serif;
    margin: 0;
    padding: 0;
    background-color: #f5f5f5;
    color: #333;
    line-height: 1.6;
}

.email-header {
    background-color: #007bff;
    color: #fff;
    padding: 20px;
    text-align: center;
    border-radius: 10px 10px 0 0;
}

.email-header h1 {
    margin: 0;
    font-size: 24px;
}

.email-body {
    background-color: #fff;
    padding: 20px;
    margin: 0 auto;
    max-width: 600px;
    border: 1px solid #ddd;
    border-radius: 0 0 10px 10px;
}

.email-body .name {
    font-size: 18px;
    font-weight: bold;
}

.email-body p {
    margin: 10px 0;
}

.email-body a.button {
    display: inline-block;
    padding: 10px 20px;
    background-color: #007bff;
    color: #fff;
    text-decoration: none;
    border-radius: 5px;
    font-size: 16px;
    margin-top: 10px;
}

.email-body a.button:hover {
    background-color: #0056b3;
}

.email-footer {
    text-align: center;
    margin-top: 20px;
    font-size: 14px;
    color: #666;
}

</style>
</html>
