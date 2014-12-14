(function ($) {
    "use strict";
    $(document).ready(function () {
        var $window = $(window);
        $window.on('resize', function () {
            setHeight($(this));
        });
        setHeight($window);
        setPosition($('.k-currency'), $window);
    });
    var setHeight = function ($window) {
        var $layout = $('.k-layout');
        var windowHeight = $window.height();
        $layout.height(windowHeight);
    };
    var setPosition = function ($block, $window) {
        var windowHeight = $window.height();
        var top = windowHeight / 2 - $block.height() / 2;
        $block.animate(
            {
                opacity: 1,
                marginTop: top
            },
            1000
        );
    };
})(jQuery);



