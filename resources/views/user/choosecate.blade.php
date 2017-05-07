<!--
Author: W3layouts
Author URL: http://w3layouts.com
License: Creative Commons Attribution 3.0 Unported
License URL: http://creativecommons.org/licenses/by/3.0/
-->
<!DOCTYPE HTML>
<html>
@include('user/head')
<body>
<!---start-wrap---->
<!---start-header---->
@include('user/header')
<!---//End-header---->
<!---start-content---->
@include('user/flash')
<div class="content">
    <div class="wrap">
        <form action="" method="post">
            <input type="hidden" name="_token" value="{{csrf_token()}}">
            <div id="main" role="main">
                <h2 class="text-center">Lựa chọn Chủ Đề Tin tức</h2>
                <br>
                @foreach($result as $item)
                    <div class="col-md-2 col-xs-4 child">
                        <label class="btn">
                            <img src="{!! asset('yournews/images/category/'.$item->thumbnail)!!}" alt="" class="img-thumbnail img-check">
                            <input type="checkbox" name="cbCategory[]" id="{!! $item->cat_id !!}"
                                   value="{!! $item->cat_id !!}" class="hidden" autocomplete="off">
                            <p>{!! $item->cat_name !!}</p>
                        </label>
                    </div>
                @endforeach
            </div>
            <a type="button" class="btn btn-default btn-lg" href="{!! route('getindex') !!}">Skip</a>
            <input type="submit" class="btn btn-primary btn-lg" value="Next step">
        </form>
    </div>
</div>
<!---//End-content---->
<!----wookmark-scripts---->
<script src="{!! asset('yournews/js/jquery.imagesloaded.js')!!}"></script>
<script src="{!! asset('yournews/js/jquery.wookmark.js')!!}"></script>
<script type="text/javascript">
    (function ($) {
        var $tiles = $('#tiles'),
                $handler = $('li', $tiles),
                $main = $('#main'),
                $window = $(window),
                $document = $(document),
                options = {
                    autoResize: true, // This will auto-update the layout when the browser window is resized.
                    container: $main, // Optional, used for some extra CSS styling
                    offset: 20, // Optional, the distance between grid items
                    itemWidth: 280 // Optional, the width of a grid item
                };

        /**
         * Reinitializes the wookmark handler after all images have loaded
         */
        function applyLayout() {
            $tiles.imagesLoaded(function () {
                // Destroy the old handler
                if ($handler.wookmarkInstance) {
                    $handler.wookmarkInstance.clear();
                }

                // Create a new layout handler.
                $handler = $('li', $tiles);
                $handler.wookmark(options);
            });
        }

        /**
         * When scrolled all the way to the bottom, add more tiles
         */
        function onScroll() {
            // Check if we're within 100 pixels of the bottom edge of the broser window.
            var winHeight = window.innerHeight ? window.innerHeight : $window.height(), // iphone fix
                    closeToBottom = ($window.scrollTop() + winHeight > $document.height() - 100);

            if (closeToBottom) {
                // Get the first then items from the grid, clone them, and add them to the bottom of the grid
                var $items = $('li', $tiles),
                        $firstTen = $items.slice(0, 10);
                $tiles.append($firstTen.clone());

                applyLayout();
            }
        };

        // Call the layout function for the first time
        applyLayout();

        // Capture scroll event.
        $window.bind('scroll.wookmark', onScroll);
    })(jQuery);
</script>
<script src="{!! asset('yournews/js/animated-checkboxes.js')!!}"></script>
<!----//wookmark-scripts---->
<!----start-footer--->
<div class="footer">

</div>
<!----//End-footer--->
<!---//End-wrap---->
</body>
</html>

