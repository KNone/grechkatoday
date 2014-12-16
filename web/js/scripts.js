(function ($) {
    "use strict";
    $(document).ready(function () {
        var $window = $(window);
        var $currency = $('.k-currency');
        $currency.css('opacity', 0);
        $window.on('resize', function () {
            var __this = $(this);
            setHeight(__this);
            setPosition($currency, __this, 200);
        });
        setHeight($window);
        setPosition($currency, $window, 1000);

        var $star = $('.k-price_star');
        var $priceInfo = $('.k-price_info');

        $star.on('mouseenter', function () {
            var position = $(this).position();
            $priceInfo.css('left', position.left + $(this).width() + 10);
            $priceInfo.css('top', position.top);
            $priceInfo.show(100);
        });
        $star.on('mouseleave', function () {
            $priceInfo.hide(100);
        });
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



