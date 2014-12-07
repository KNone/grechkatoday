$(document).ready(function () {
    setHeight();
    $(window).on('resize', function () {
        setHeight();
    })
});
var setHeight = function () {
    var $layout = $('.k-layout');
    $layout.height($(window).height());
}


