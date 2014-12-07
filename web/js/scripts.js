$(document).ready(function () {
    $(window).on('resize', function () {
        setHeight();
    });
    setHeight();
});
var setHeight = function () {
    var $layout = $('.k-layout');
    var $currency = $('.k-currency');
    var windowHeight = $(window).height();
    $layout.height(windowHeight);
    $currency.css('padding-top', ((windowHeight - $currency.height()) / 2) + 'px');
}


