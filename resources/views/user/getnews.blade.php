<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Choose page</title>
    <link rel="stylesheet" href="{!! asset('yournews/css/main.css')!!}">
    <link rel="stylesheet" href="{!! asset('yournews/css/bootstrap.css')!!}">
    <script src="{!! asset('yournews/js/jquery.min.js')!!}"></script>
    <script src="{!! asset('yournews/js/bootstrap.js')!!}"></script>
    <style>
        .child img {width: 100px;height: 50px;}
    </style>
    @include('user/head')
</head>
<body data-spy="scroll" data-target="#sidebar-wrapper">

<div class="content">
    <div class="form-group">
        <form action="{!! route('postnews') !!}" method="post">
            <input type="hidden" name="_token" value="{!! csrf_token() !!}">
            <div class="container alert alert-info text-center">
                <h2 class="text-center text-success text-uppercase">Choose source page</h2>
                <div class="row">
                    {{---------------}}
                    <div class="col-md-2 col-xs-4 child">
                        <label class="btn">
                            <img src="{!! asset('yournews/images/page/img_logo_vne_web.gif')!!}"
                                 alt=""
                                 class="img-thumbnail img-check">
                            <input type="checkbox" name="page[]" id=""
                                   value="vnexpress" class="hidden" autocomplete="off">
                            <p>Vnexpress</p>
                        </label>
                    </div>
                    {{----------------}}
                    <div class="col-md-2 col-xs-4 child">
                        <label class="btn">
                            <img src="{!! asset('yournews/images/page/logo-vnn.svg')!!}"
                                 alt=""
                                 class="img-thumbnail img-check">
                            <input type="checkbox" name="page[]" id=""
                                   value="vietnamnet" class="hidden" autocomplete="off">
                            <p>vietnamnet</p>
                        </label>
                    </div>
                    {{----------------}}
                    <div class="col-md-2 col-xs-4 child">
                        <label class="btn">
                            <img src="{!! asset('yournews/images/page/logocms2.png')!!}"
                                 alt=""
                                 class="img-thumbnail img-check">
                            <input type="checkbox" name="page[]" id=""
                                   value="dantri" class="hidden" autocomplete="off">
                            <p>dantri</p>
                        </label>
                    </div>
                    {{----------------}}
                    <div class="col-md-2 col-xs-4 child">
                        <label class="btn">
                            <img src="{!! asset('yournews/images/page/Zing_official_logo.png')!!}"
                                 alt=""
                                 class="img-thumbnail img-check">
                            <input type="checkbox" name="page[]" id=""
                                   value="zing" class="hidden" autocomplete="off">
                            <p>zing</p>
                        </label>
                    </div>
                    {{----------------}}
                    <div class="col-md-2 col-xs-4 child">
                        <label class="btn">
                            <img src="{!! asset('yournews/images/page/kenh14.png')!!}"
                                 alt=""
                                 class="img-thumbnail img-check">
                            <input type="checkbox" name="page[]" id=""
                                   value="kenh14" class="hidden" autocomplete="off">
                            <p>kenh14</p>
                        </label>
                    </div>
                    {{----------------}}
                    <div class="col-md-2 col-xs-4 child">
                        <label class="btn">
                            <img src="{!! asset('yournews/images/page/3162495_Tinhte_Logo.png')!!}"
                                 alt=""
                                 class="img-thumbnail img-check">
                            <input type="checkbox" name="page[]" id=""
                                   value="tinhte" class="hidden" autocomplete="off">
                            <p>tinhte</p>
                        </label>
                    </div>
                    {{----------------}}
                    <div class="col-md-2 col-xs-4 child">
                        <label class="btn">
                            <img src="{!! asset('yournews/images/page/bongdaplus.logo.png')!!}"
                                 alt=""
                                 class="img-thumbnail img-check">
                            <input type="checkbox" name="page[]" id=""
                                   value="bongdaplus" class="hidden" autocomplete="off">
                            <p>bongdaplus</p>
                        </label>
                    </div>
                    {{----------------}}
                    <div class="col-md-2 col-xs-4 child">
                        <label class="btn">
                            <img src="{!! asset('yournews/images/page/Afamily-logo.png')!!}"
                                 alt=""
                                 class="img-thumbnail img-check">
                            <input type="checkbox" name="page[]" id=""
                                   value="afamily" class="hidden" autocomplete="off">
                            <p>afamily</p>
                        </label>
                    </div>
                    {{----------------}}
                    <div class="col-md-2 col-xs-4 child">
                        <label class="btn">
                            <img src="{!! asset('yournews/images/page/24h_logo_trang_trong_2015_1.png')!!}"
                                 alt=""
                                 class="img-thumbnail img-check">
                            <input type="checkbox" name="page[]" id=""
                                   value="24h" class="hidden" autocomplete="off">
                            <p>24h</p>
                        </label>
                    </div>
                    {{----------------}}
                    <div class="col-md-2 col-xs-4 child">
                        <label class="btn">
                            <img src="{!! asset('yournews/images/page/quang-cao-cafef-vn.jpg')!!}"
                                 alt=""
                                 class="img-thumbnail img-check">
                            <input type="checkbox" name="page[]" id=""
                                   value="cafef" class="hidden" autocomplete="off">
                            <p>cafef</p>
                        </label>
                    </div>
                    {{----------------}}
                    <div class="col-md-2 col-xs-4 child">
                        <label class="btn">
                            <img src="{!! asset('yournews/images/page/logo.png')!!}"
                                 alt=""
                                 class="img-thumbnail img-check">
                            <input type="checkbox" name="page[]" id=""
                                   value="laodong" class="hidden" autocomplete="off">
                            <p>laodong</p>
                        </label>
                    </div>
                    {{----------------}}
                </div>
                <input type="submit" value="Save changes" class="btn btn-info">
            </div>
        </form>
    </div>
</div>
</div>
</body>
</html>