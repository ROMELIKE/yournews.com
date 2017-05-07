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
<div class="content">
    @include('user/flash')
    <div class="wrap">
        <div id="main" role="main">
            <ul id="tiles">
                <!-- These are our grid blocks -->
                @foreach($posts as $item)
                    <li onclick="location.href='{!! route('getpost',[$item->post_id])!!}';">
                        <img src="http://yournews.romecody.com/yournews/images/download/{!!$item->post_thumbnail!!}" width="282"
                             height="auto">
                        <div class="post-info">
                            <div class="post-basic-info">
                                <h3><a href="{!! route('getpost',[$item->post_id])!!}">{!! $item->title !!}</a></h3>
                                <span><a href="{!! route('getpost',[$item->post_id])!!}"><label> </label>{!! $item->cat_name !!}</a></span>
                                <p>{!! $item->excerpt !!}</p>
                            </div>
                        </div>
                    </li>
            @endforeach
            <!-- End of grid blocks -->
            </ul>
        </div>
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
//        function onScroll() {
//            // Check if we're within 100 pixels of the bottom edge of the broser window.
//            var winHeight = window.innerHeight ? window.innerHeight : $window.height(), // iphone fix
//                    closeToBottom = ($window.scrollTop() + winHeight > $document.height() - 100);
//
//            if (closeToBottom) {
//                // Get the first then items from the grid, clone them, and add them to the bottom of the grid
//                var $items = $('li', $tiles),
//                        $firstTen = $items.slice(0, 10);
//                $tiles.append($firstTen.clone());
//
//                applyLayout();
//            }
//        };

        // Call the layout function for the first time
        applyLayout();

        // Capture scroll event.
        $window.bind('scroll.wookmark', onScroll);
    })(jQuery);
</script>
<script src="{!! asset('yournews/js/animated-checkboxes.js')!!}"></script>
<script src="{!! asset('yournews/js/app.js')!!}"></script>
<script src="{!! asset('yournews/js/jquery.slide.js')!!}"></script>
<!----//wookmark-scripts---->
<!----start-footer--->
<div class="footer">

</div>
<!----//End-footer--->
<!---//End-wrap---->
</body>
</html>

