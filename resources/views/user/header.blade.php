<div class="header">
    <div class="wrap">
        <div class="logo">
            <a href="{!! route('getindex') !!}"><img src="{!! asset('yournews/images/logo.png')!!}"
                                                     title="pinbal"/></a>
        </div>
        <div class="nav-icon">
            <a class="right_bt" id="activator"><span> </span> </a>
        </div>
        <div class="box" id="box">
            <div class="box_content">
                <div class="box_content_center">
                    <div class="form_content">
                        <div class="menu_box_list">
                            <form action="" class="form-groupt">
                                <div class="checkbox">
                                    @if(isset($choosedCate))
                                        @foreach($choosedCate as $item)
                                            <label class="checkbox-inline"><input id="{!! $item->cat_id !!}"
                                                                                  type="checkbox"
                                                                                  value="{!! $item->cat_id !!}"
                                                                                  checked>{!! $item->cat_name !!}
                                            </label>
                                        @endforeach
                                    @endif
                                </div>
                                <div class="radio">
                                    <label class="radio-inline"><input type="radio" name="optradio" id="newrd" checked>Mới
                                        nhất</label>
                                    <label class="radio-inline"><input type="radio" name="optradio" id="oldrd">Cũ
                                        nhất</label>

                                </div>
                                <input type="submit" class="boxclose btn btn-default" value="Lọc">

                                <!--<button type="button" class="btn btn-primary">Primary</button>-->
                            </form>
                        </div>

                    </div>
                </div>
            </div>
        </div>
        <div class="top-searchbar">
            <form>
                <input type="text" placeholder="Search..."/><input type="submit" value=""/>
            </form>
        </div>
        <div class="userinfo">
            <div class="user">
                <ul>
                    <li><a href="{!! route('getprofile') !!}">
                            <img src="@if (isset($thisUser->avatar)&& $thisUser->avatar) {!! asset('yournews/images/user/'.$thisUser->avatar)!!} @else {!! asset('yournews/images/user/user-pic.png')!!} @endif"
                                 title="avatar" alt="avatar" class="img-circle" width="50"/>
                            <span><?php if (Session::has('username')) {
                                    echo Session::get('username');
                                } ?></span>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
        <div class="clear"></div>
    </div>

</div>