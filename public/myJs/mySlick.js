//충돌이 발생하여 재정의 하였음
$m = jQuery.noConflict();
//충돌이 발생하여 재정의 하였음
$m(document).ready(function () {
    $m('.slider1').slick({
        slidesToShow: 3,
        slidesToScroll: 3,
        autoplay: true,
        autoplaySpeed: 2000,
    });
});
//충돌이 발생하여 재정의 하였음
$m(document).ready(function () {
    $m('.slider2').slick();
});
//충돌이 발생하여 재정의 하였음
$m(document).ready(function () {
    $m('.slider3').slick({
        slidesToShow: 3,
        slidesToScroll: 3,
        autoplay: false,
        autoplaySpeed: 2000,
    });
});
//CategoryCmenu에서 쓰인다
$m(document).ready(function () {
    $m('.slider4').slick({
        slidesToShow: 6,
        slidesToScroll: 6,
        autoplay: false,
        autoplaySpeed: 2000,
    });
});