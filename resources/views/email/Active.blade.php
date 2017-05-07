<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{!! asset('public/yournews/css/main.css')!!}">
    <link rel="stylesheet" href="{!! asset('public/yournews/css/bootstrap.css')!!}">

    <title>Forgot Mail</title>
</head>
<body>
<div class="wrap text-center">
    <div class="alert alert-info thumbnail" style="margin: 5% auto;width: 40%;">
            <h4>Hi{!! $username !!}</h4>
            <h4>You have successfully created an account, to active your account</h4>
            <h4>please click the button</h4>
            <button><a href="{!! route('active',['code'=>$code,'username'=>$username]) !!}">Active now</a></button>
    </div>
</div>
</body>

