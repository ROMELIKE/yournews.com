<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Login</title>
    <base href="{!! asset('') !!}">
    <link rel='stylesheet prefetch' href='http://fonts.googleapis.com/css?family=Open+Sans:600'>
    <link rel="stylesheet" href="{!! asset('yournews/css/main.css')!!}">
    <link rel="stylesheet" href="{!! asset('yournews/css/bootstrap.css')!!}">
    <link rel="stylesheet" href="{!! asset('yournews/css/stylogin.css')!!}">
    <script src="{!! asset('yournews/js/jquery.min.js')!!}"></script>
    <script src="{!! asset('yournews/js/bootstrap.js')!!}"></script>
    <script src="{!! asset('yournews/js/msgbox.js')!!}"></script>

</head>
<body>
{{--@include('user/flash')--}}
@if(isset($messageLogin))
    <div class="alert alert-warning" id="msg_box" style="margin-bottom: 0px;">
        <h5 class="text-center">{!! $messageLogin!!}</h5>
    </div>

@endif
<div class="login-wrap">
    <div class="login-html">
        <input id="tab-1" type="radio" name="tab" class="sign-in" checked><label for="tab-1" class="tab">Sign In</label>
        <input id="tab-2" type="radio" name="tab" class="sign-up"><label for="tab-2" class="tab">Sign Up</label>
        <div class="login-form">
            <div class="sign-in-htm">
                <form action="" method="post">
                    <input type="hidden" name="_token" value="{!! csrf_token() !!}">
                    <div class="group">
                        <label for="user" class="label">Username</label>
                        <input id="user" type="text" class="input" name="username" value="{{ old('username') }}">
                        @if(count($errors)>0)
                            <ul class="error_msg">
                                @foreach($errors->get('username') as $error)
                                    <li style="color: red">{{$error}}</li>
                                @endforeach
                            </ul>
                        @endif
                    </div>
                    <div class="group">
                        <label for="pass" class="label">Password</label>
                        <input id="pass" type="password" class="input" data-type="password" name="password">
                        @if(count($errors)>0)
                            <ul class="error_msg">
                                @foreach($errors->get('password') as $error)
                                    <li style="color: red">{{$error}}</li>
                                @endforeach
                            </ul>
                        @endif
                    </div>
                    <div class="group">
                        <input id="check" type="checkbox" class="check" checked name="remember">
                        <label for="check"><span class="icon"></span> Keep me Signed in</label>
                    </div>

                    {{--<div class="group">--}}
                        {{--<a href="#">--}}
                            {{--<button class="button">google</button>--}}
                        {{--</a>--}}
                    {{--</div>--}}
                    <div class="group">
                        <input type="submit" class="button" value="Sign In">
                    </div>
                </form>
                    <div class="group">
                        <a href="{!! url('auth/facebook') !!}">
                            <button class="button">facebooks</button>
                        </a>
                    </div>

                    <div class="hr"></div>
                    <div class="foot-lnk">
                        <a href="{!! route('getforgot') !!}">Forgot Password?</a>
                    </div>
            </div>
            <div class="sign-up-htm">
                <form action="{!! url('register') !!}" method="post">
                    <input type="hidden" name="_token" value="{!! csrf_token() !!}">
                    <div class="group">
                        <label for="user" class="label">Username</label>
                        <input id="user" type="text" class="input" name="rusername"  value="{{ old('rusername') }}">
                        @if(count($errors)>0)
                            <ul class="error_msg">
                                @foreach($errors->get('rusername') as $error)
                                    <li style="color: red">{{$error}}</li>
                                @endforeach
                            </ul>
                        @endif
                    </div>
                    <div class="group">
                        <label for="pass" class="label">Password</label>
                        <input id="pass" type="password" class="input" data-type="password" name="rpassword">
                        @if(count($errors)>0)
                            <ul class="error_msg">
                                @foreach($errors->get('rpassword') as $error)
                                    <li style="color: red">{{$error}}</li>
                                @endforeach
                            </ul>
                        @endif
                    </div>
                    <div class="group">
                        <label for="pass" class="label">Repeat Password</label>
                        <input id="pass" type="password" class="input" data-type="password" name="rrepass">
                        @if(count($errors)>0)
                            <ul class="error_msg">
                                @foreach($errors->get('rrepass') as $error)
                                    <li style="color: red">{{$error}}</li>
                                @endforeach
                            </ul>
                        @endif
                    </div>
                    <div class="group">
                        <label for="pass" class="label">Email Address</label>
                        <input id="pass" type="text" class="input" name="remail"  value="{{ old('remail') }}">
                        @if(count($errors)>0)
                            <ul class="error_msg">
                                @foreach($errors->get('remail') as $error)
                                    <li style="color: red">{{$error}}</li>
                                @endforeach
                            </ul>
                        @endif
                    </div>
                    <div class="group">
                        <label for="pass" class="label">phone number</label>
                        <input id="pass" type="text" class="input" name="rphone"  value="{{ old('rphone') }}">
                        @if(count($errors)>0)
                            <ul class="error_msg">
                                @foreach($errors->get('rphone') as $error)
                                    <li style="color: red">{{$error}}</li>
                                @endforeach
                            </ul>
                        @endif
                    </div>
                    <div class="group">
                        <input type="submit" class="button" value="Sign Up">
                    </div>
                    <div class="hr"></div>
                    <div class="foot-lnk">
                        <label for="tab-1">Already Member?</label>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
</body>
</html>
