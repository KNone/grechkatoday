(function ($) {
    "use strict";
    $(document).ready(function () {
        var $window = $(window);
        var $currency = $('.k-currency');
        $window.on('resize', function () {
            var __this = $(this);
            setHeight(__this);
            setPosition($currency, __this, 200);
        });
        setHeight($window);
        setPosition($currency, $window, 1000);
    });
    var setHeight = function ($window) {
        var $layout = $('.k-layout');
        var windowHeight = $window.height();
        $layout.height(windowHeight);
    };
    var setPosition = function ($block, $window, timeout) {
        var windowHeight = $window.height();
        var top = windowHeight / 2 - $block.height() / 2;
        $block.animate(
            {
                opacity: 1,
                marginTop: top
            },
            timeout
        );
    };
})(jQuery);



