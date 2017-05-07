<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Forgot password</title>
    <base href="{!! asset('') !!}">
    <link rel='stylesheet prefetch' href='http://fonts.googleapis.com/css?family=Open+Sans:600'>
    <link rel="stylesheet" href="{!! asset('yournews/css/main.css')!!}">
    <link rel="stylesheet" href="{!! asset('yournews/css/bootstrap.css')!!}"">
    <link rel="stylesheet" href="{!! asset('yournews/css/stylogin.css')!!}">
    <script src="{!! asset('yournews/js/jquery.min.js')!!}"></script>
    <script src="{!! asset('yournews/js/bootstrap.js')!!}"></script>
    <script src="{!! asset('yournews/js/msgbox.js')!!}"></script>

</head>
<body>

<div class="login-wrap">
    <div class="login-html">
        @include('user/flash')
        <input id="tab-1" type="radio" name="tab" class="sign-in" checked><label for="tab-1" class="tab" style="color: #101080">Forgot
            Password</label>
        <input id="tab-2" type="radio" name="tab" class="sign-up"><label for="tab-2" class="tab"></label>
        <div class="login-form">
            <div class="sign-in-htm">
                <form action="" method="post">
                    <input type="hidden" name="_token" value="{!! csrf_token() !!}">
                    <div class="group">
                        <label for="email" class="label">Email</label>
                        <input id="email" type="email" class="input" name="fg_email" value="@if(count($errors)>0)@foreach($errors->get('fg_email') as $error){{$error}}@endforeach @else {{ old('fg_email') }} @endif" placeholder="Enter your email">
                    </div>
                    <div class="group">
                        <label for="phone" class="label">phone</label>
                        <input id="phone" type="number" class="input" name="fg_phone" value="@if(count($errors)>0)@foreach($errors->get('fg_phone') as $error){{$error}}@endforeach @else {{ old('fg_phone') }} @endif" placeholder="Enter your phone number">
                    </div>

                    <div class=" group">
                        <input type="submit" class="button" value="submit">
                    </div>
                    <div class="hr"></div>
                </form>
            </div>
        </div>
    </div>
</div>
</body>
</html>
