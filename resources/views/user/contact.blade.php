<!--
Author: W3layouts
Author URL: http://w3layouts.com
License: Creative Commons Attribution 3.0 Unported
License URL: http://creativecommons.org/licenses/by/3.0/
-->
<!DOCTYPE HTML>
<html>
@include('user.head')
<body>
<!---start-wrap---->
<!---start-header---->
@include('user.header')
<!---//End-header---->
<!---start-content---->
<div class="content">
    <div class="wrap">
        <div class="contact-info">
            <div class="map">
                <iframe width="100%" height="400" frameborder="0" scrolling="no" marginheight="0" marginwidth="0"
                        src="https://maps.google.co.in/maps?f=q&amp;source=s_q&amp;hl=en&amp;geocode=&amp;q=Lighthouse+Point,+FL,+United+States&amp;aq=4&amp;oq=light&amp;sll=26.275636,-80.087265&amp;sspn=0.04941,0.104628&amp;ie=UTF8&amp;hq=&amp;hnear=Lighthouse+Point,+Broward,+Florida,+United+States&amp;t=m&amp;z=14&amp;ll=26.275636,-80.087265&amp;output=embed"></iframe>
                <br>
                <small>
                    <a href="https://maps.google.co.in/maps?f=q&amp;source=embed&amp;hl=en&amp;geocode=&amp;q=Lighthouse+Point,+FL,+United+States&amp;aq=4&amp;oq=light&amp;sll=26.275636,-80.087265&amp;sspn=0.04941,0.104628&amp;ie=UTF8&amp;hq=&amp;hnear=Lighthouse+Point,+Broward,+Florida,+United+States&amp;t=m&amp;z=14&amp;ll=26.275636,-80.087265"
                       style="color:#666;text-align:left;font-size:12px"></a></small>
            </div>
            <div class="contact-grids">
                <div class="col_1_of_bottom span_1_of_first1">
                    <h5>Address</h5>
                    <ul class="list3">
                        <li>
                            <img src="{!! asset('yournews/images/home.png')!!}" alt="">
                            <div class="extra-wrap">
                                <p>Lorem ipsum consectetu,<br>dolor sit amet,.</p>
                            </div>
                        </li>
                    </ul>
                </div>
                <div class="col_1_of_bottom span_1_of_first1">
                    <h5>Phones</h5>
                    <ul class="list3">
                        <li>
                            <img src="{!! asset('yournews/images/phone.png')!!}" alt="">
                            <div class="extra-wrap">
                                <p><span>Telephone:</span>+1 800 258 2598</p>
                            </div>
                            <img src="{!! asset('yournews/images/fax.png')!!}" alt="">
                            <div class="extra-wrap">
                                <p><span>FAX:</span>+1 800 589 2587</p>
                            </div>
                        </li>
                    </ul>
                </div>
                <div class="col_1_of_bottom span_1_of_first1">
                    <h5>Email</h5>
                    <ul class="list3">
                        <li>
                            <img src="{!! asset('yournews/images/email.png')!!}" alt="">
                            <div class="extra-wrap">
                                <p><span class="mail"><a href="mailto:yoursite.com">info(at)pinball.com</a></span></p>
                            </div>
                        </li>
                    </ul>
                </div>
                <div class="clear"></div>
            </div>
            <form method="post" action="">
                <input type="hidden" name="_token" value="{!! csrf_token() !!}">
                <div class="contact-form">
                    <div class="contact-to">
                        <input type="text" class="text"
                               value="@if(count($errors)>0)@foreach($errors->get('username') as $error){{$error}}@endforeach @else{!! $thisUser->username !!}@endif"
                               name="username">
                        <input type="text" class="text"
                               value="@if(count($errors)>0)@foreach($errors->get('email') as $error){{$error}}@endforeach @else{!! $thisUser->email !!}@endif"
                               name="email">
                        <input type="text" class="text" placeholder="Subject..."
                               value="@if(count($errors)>0)@foreach($errors->get('subject') as $error) {{$error}} @endforeach @else subject... @endif "
                               name="subject">
                    </div>
                    <div class="text2">
                        <textarea value="Message:" name="message">@if(count($errors)>0)@foreach($errors->get('message') as $error){{$error}}@endforeach @else message... @endif</textarea>
                    </div>
                    <span><input type="submit" value="Send Email"></span>
                    <div class="clear"></div>
                </div>
            </form>
        </div>
    </div>
</div>
<!----start-footer--->
<div class="footer">
</div>
<!----//End-footer--->
<!---//End-wrap---->
</body>
</html>

