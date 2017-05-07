<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>profile</title>
    @include('user/head')
</head>
<body data-spy="scroll" data-target="#sidebar-wrapper">
@include('user/header')

{{--end header--}}
{{--conten profile--}}
<div class="content">
    <div id="wrapper">
        <!-- Sidebar -->
        <div id="sidebar-wrapper" style="background-color: antiquewhite;">
            <ul class="sidebar-nav nav">
                <li class="">
                    <a href="{!! url('profile') !!}#home"><i class="fa fa-home" aria-hidden="true"></i> Dashboard</a>
                </li>
                <li>
                    <a href="{!! url('profile') !!}#anch1" data-scroll>
                        <span class="solo"><i class="fa fa-user" aria-hidden="true"></i> Profile</span>
                    </a>
                </li>
                <li>
                    <a href="{!! url('profile') !!}#anch3" data-scroll>
                        <span class="solo"><i class="fa fa-newspaper-o" aria-hidden="true"></i> Category</span>
                    </a>
                </li>
                <li>
                    <a href="{!! route('getcontact') !!}" data-scroll>
                        <span class="solo"><i class="fa fa-envelope" aria-hidden="true"></i> Contact</span>
                    </a>
                </li>
                <li>
                    <a href="{!! url('logout') !!}" data-scroll>
                        <span class="solo"><i class="fa fa-sign-out" aria-hidden="true"></i> Logout</span>
                    </a>
                </li>
            </ul>
        </div>

        <!-- Page content -->
        <div id="page-content-wrapper">
            @include('user/flash')
            <div class="content-header">
                <h1 id="home">
                    Profile Infomation
                </h1>
            </div>
            <div class="page-content inset">
                <form action="{!! route('postprofile') !!}" method="post" enctype="multipart/form-data">
                    <input type="hidden" name="_token" value="{!! csrf_token() !!}">
                    <div class="row">
                        <div class="col-md-12 wells">
                            <legend id="anch1">Profile Infomation:</legend>

                            <div class="form-group">
                                <label for="email" class="text-capitalize">Email:</label>
                                <input type="email" class="form-control" id="email"
                                       placeholder="Your email address is require" value="{!! $result->email !!}"
                                       name="email">
                                @if(count($errors)>0)
                                    <ul class="error_msg">
                                        @foreach($errors->get('email') as $error)
                                            <li style="color: red">{{$error}}</li>
                                            {$                                      @endforeach
                                    </ul>
                                @endif
                            </div>
                            <div class="form-group">
                                <label for="pwd">Password:</label>
                                <button type="button" class="form-control btn-txt" data-toggle="modal"
                                        data-target="#change-pwd">
                                    Change password...
                                </button>
                            </div>
                            <div class="form-group">
                                <label>Gender: </label>
                                @if($result->sex)
                                    <input type="radio" name="gender" value="1" checked>
                                    <span class="gender">male</span>
                                    <input type="radio" name="gender" value="0">
                                    <span class="gender">female</span>
                                @else
                                    <input type="radio" name="gender" value="1">
                                    <span class="gender">male</span>
                                    <input type="radio" name="gender" value="0" checked>
                                    <span class="gender">female</span>
                                @endif
                            </div>
                            <div class="form-group">
                                <label>Phonenumber: </label>
                                <input type="number" name="phone" class="form-control"
                                       placeholder="Your phonenumber is require"
                                       value="{!! $result->sdt !!}">
                                @if(count($errors)>0)
                                    <ul class="error_msg">
                                        @foreach($errors->get('phone') as $error)
                                            <li style="color: red">{{$error}}</li>
                                        @endforeach
                                    </ul>
                                @endif
                            </div>
                        </div>
                        <div class="col-md-12 wells">
                            <div class="form-group">
                                <label>Avatar:</label>
                                <div class="profileImageWrapper" data-reactid="137">
                                    <img alt="avatar" class="profileImage img-circle"
                                         src="@if (isset($thisUser->avatar)&& $thisUser->avatar) {!! asset('yournews/images/user/'.$thisUser->avatar)!!} @else https://s.pinimg.com/images/user/default_75.png @endif ">
                                </div>
                                <input class="changePhoto Button Module btn hasText rounded" type="file" name="avatar">
                                <input  type="hidden" name="current_avatar" value="{!! $thisUser->avatar !!}">
                                @if(count($errors)>0)
                                    <ul class="error_msg">
                                        @foreach($errors->get('avatar') as $error)
                                            <li style="color: red">{{$error}}</li>
                                        @endforeach
                                    </ul>
                                @endif
                            </div>
                        </div>
                        <div class="col-md-12 wells">
                            <legend id="anch3">Your Category:</legend>
                            <div class="form-group">
                                <div class="row">
                                    @foreach($choosedCate as $item)
                                        <div class="col-md-2 col-xs-4 child">
                                            <label class="btn">
                                                <img src="{!! asset('yournews/images/category/'.$item->thumbnail)!!}"
                                                     alt=""
                                                     class="img-thumbnail img-check">
                                                <input type="checkbox" name="cbCategory[]" id="{!! $item->cat_id !!}"
                                                       value="{!! $item->cat_id !!}" class="hidden" autocomplete="off"
                                                       checked="checked">
                                                <p>{!! $item->cat_name !!}</p>
                                            </label>
                                        </div>
                                    @endforeach
                                    {{--những chuyên mục chưa được chọn--}}
                                    @foreach($unChoosedCate as $item)
                                        <div class="col-md-2 col-xs-4 child">
                                            <label class="btn">
                                                <img src="{!! asset('yournews/images/category/'.$item->thumbnail)!!}"
                                                     alt=""
                                                     class="img-thumbnail img-check check">
                                                <input type="checkbox" name="cbCategory[]" id="{!! $item->cat_id !!}"
                                                       value="{!! $item->cat_id !!}" class="hidden" autocomplete="off">
                                                <p>{!! $item->cat_name !!}</p>
                                            </label>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                        <div class="formFooter">
                            <div class="save">
                                <button aria-label="Hủy" class="btn-default btn " type="button">
                                    <span class="buttonText">Cancel</span>
                                </button>
                                <input type="submit" value="update" class="btn btn-danger">
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="change-pwd" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Change password: </h4>
            </div>
            <div class="modal-body">
                <form action="{!! route('changepassword') !!}" method="post" class="form-inline" id="">
                    <input type="hidden" name="_token" value="{{csrf_token()}}">
                    <div class="form-group" style="width: 100%">
                        <div class="row">
                            <div class="col-md-3">
                                <label for="old-pwd"> Current password:</label>
                            </div>
                            <div class="col-md-9">
                                <input type="password" name="current_pwd" class="form-control" id="current_pwd"
                                       style="width: 100%" placeholder="Enter your current password"></br>
                                @if(count($errors)>0)
                                    <ul class="error_msg">
                                        @foreach($errors->get('current_pwd') as $error)
                                            <li style="color: darkorange">{{$error}}</li>
                                        @endforeach
                                    </ul>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="form-group" style="width: 100%">
                        <div class="row">
                            <div class="col-md-3">
                                <label for="old-pwd"> New password:</label>
                            </div>
                            <div class="col-md-9">
                                <input type="password" name="new_pwd" class="form-control" id="new_pwd"
                                       style="width: 100%" placeholder="Enter new password">
                                @if(count($errors)>0)
                                    <ul class="error_msg">
                                        @foreach($errors->get('new_pwd') as $error)
                                            <li style="color: darkorange">{{$error}}</li>
                                        @endforeach
                                    </ul>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="form-group" style="width: 100%">
                        <div class="row">
                            <div class="col-md-3">
                                <label for="renew-pwd">Re new password:</label>
                            </div>
                            <div class="col-md-9">
                                <input type="password" name="renew_pwd" class="form-control" id="renew_pwd"
                                       style="width: 100%" placeholder="Enter your new password one more time">
                                @if(count($errors)>0)
                                    <ul class="error_msg">
                                        @foreach($errors->get('renew_pwd') as $error)
                                            <li style="color: darkorange">{{$error}}</li>
                                        @endforeach
                                    </ul>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="text-right">

                        <a href="">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                        </a>
                        <button type="submit" class="btn btn-danger">Update</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- Modal content-->
</div>
</body>
</html>