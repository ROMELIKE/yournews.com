<head>
    <base href="{{asset('')}}">
    <title>Yournews | Home </title>
    <link href='http://fonts.googleapis.com/css?family=Roboto:400,700,500' rel='stylesheet' type='text/css'>
    <link rel='stylesheet prefetch' href='http://maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css'>


    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" type="image/x-icon" href="{!! asset('yournews/images/fav-icon.png')!!}" />
    <!----webfonts-->
    <link href='http://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700,800' rel='stylesheet' type='text/css'>
            <!----//webfonts---->
            <!-- Global CSS for the page and tiles -->
            <link rel="stylesheet" href="{!! asset('yournews/css/main.css')!!}">
            <link rel="stylesheet" href="{!! asset('yournews/css/bootstrap.css')!!}">
            <link rel="stylesheet" href="{!! asset('yournews/css/app.css')!!}">
            <link rel="stylesheet" href="{!! asset('yournews/css/stylogin.css')!!}">
            <link href="{!! asset('yournews/css/style.css')!!}" rel='stylesheet' type='text/css'/>
            <!-- //Global CSS for the page and tiles -->

    <!---start-click-drop-down-menu----->
    <script src="{!! asset('yournews/js/jquery.min.js')!!}"></script>
    <script src="{!! asset('yournews/js/bootstrap.js')!!}"></script>
    <script src="{!! asset('yournews/js/msgbox.js')!!}"></script>

            <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js">
            <script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>
    <!----start-dropdown--->
    <script type="text/javascript">
        var $ = jQuery.noConflict();
        $(function() {
            $('#activator').click(function(){
                $('#box').animate({'top':'0px'},500);
                $('.form_content').addClass('bg-fr');
            });
            $('#boxclose').click(function(){
                $('#box').animate({'top':'-700px'},500);
            });
        });
        $(document).ready(function(){
            //Hide (Collapse) the toggle containers on load
            $(".toggle_container").hide();
            //Switch the "Open" and "Close" state per click then slide up/down (depending on open/close state)
            $(".trigger").click(function(){
                $(this).toggleClass("active").next().slideToggle("slow");
                return false; //Prevent the browser jump to the link anchor
            });

        });
    </script>
    <!----//End-dropdown--->
    {{--scroll spy--}}
    <script>

        /*Menu-toggle*/
        $("#menu-toggle").click(function(e) {
            e.preventDefault();
            $("#wrapper").toggleClass("active");
        });

        /*Scroll Spy*/
        $('body').scrollspy({ target: '#spy', offset:80});

        /*Smooth link animation*/
        $('a[href*=#]:not([href=#])').click(function() {
            if (location.pathname.replace(/^\//, '') == this.pathname.replace(/^\//, '') || location.hostname == this.hostname) {

                var target = $(this.hash);
                target = target.length ? target : $('[name=' + this.hash.slice(1) + ']');
                if (target.length) {
                    $('html,body').animate({
                        scrollTop: target.offset().top
                    }, 1000);
                    return false;
                }
            }
        });
    </script>
    <!---//End-click-drop-down-menu----->
    <script>
        $(document).ready(function(e){
            $(".img-check").click(function(){
                $(this).toggleClass("check");
            });
        });
    </script>

</head>
