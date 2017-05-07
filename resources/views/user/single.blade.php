<!--
Author: W3layouts
Author URL: http://w3layouts.com
License: Creative Commons Attribution 3.0 Unported
License URL: http://creativecommons.org/licenses/by/3.0/
-->
<!DOCTYPE HTML>
<html>
@include('user/head')
<style>
    .artical-content img
    {
        width: 700px;
        height: auto;
        margin: 10px auto;
    }
    .artical-content video{
        margin: 0 auto; margin-top: 5px;
        width: 700px;
        height: auto;
    }
    .single-page{
        margin: auto 5% !important;
    }
    td.pCaption, figcaption ,.PhotoCMS_Caption{
        text-align: center;
        font-style: italic !important;
        font-weight: normal;
    }
    figure.video{
        text-align: center !important;
    }
</style>
<body>
<!---start-wrap---->
<!---start-header---->
@include('user/header')
<!---//End-header---->
<!---start-content---->
<div class="content">
    <div id="fb-root"></div>
    <script>(function (d, s, id) {
            var js, fjs = d.getElementsByTagName(s)[0];
            if (d.getElementById(id)) return;
            js = d.createElement(s);
            js.id = id;
            js.src = "//connect.facebook.net/vi_VN/sdk.js#xfbml=1&version=v2.8&appId=1182313241894518";
            fjs.parentNode.insertBefore(js, fjs);
        }(document, 'script', 'facebook-jssdk'));</script>
    <div class="wrap">
        <div class="single-page">
            <div class="single-page-artical">
                <div class="artical-content">
                    <h3><a href="{!! route('getpost',[$post->post_id]) !!}">{!! $post->title !!}</a></h3>
                    <br>
                    <p style="font-weight: bolder">{!! $post->excerpt !!}</p>
                    {{--<img src="http://yournews.romecody.com/yournews/images/download/{!! $post->post_thumbnail !!}" class="img-responsive img-thumbnail" title="banner1" style="width: 30% !important;">--}}

                    <div>{!! $post->content !!}</div>

                </div>

                <div class="clear"></div>
            </div>
            <!---start-comments-section--->
            <div class="comment-section">
                <div class="grids_of_2">
                    <h2>Comments</h2>
                    <div class="fb-comments"
                         data-href="http://yournews.romecody.com/post/{!! $post->post_id !!}"
                         data-numposts="5" data-width="100%"></div>
                </div>
            </div>
            <!---//End-comments-section--->
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

