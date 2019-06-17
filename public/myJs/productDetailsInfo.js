////screen top으로 부터 fixedPosition(상품정보,상품분석평,배송반품...)까지 높이를
////구하여 그값을 0 으로 부터 차감한 후 조정값(시행착오로 얻은 값)을 더하여 위치를 정한다.
var sw = false;  //상품정보, 상품분석평, 배송반품을 거쳐오면 true로 바뀐다
$(function () {
    ////화면 처음 로드시에는...
    $('.productInfo').addClass("blue_white");
    $('.dis_productAnalysis').hide(); //추가 27/05/2019
    $('.dis_backDelivery').hide(); //추가 27/05/2019
    $('.dis_productInfo').show(); //추가 27/05/2019

    $(window).scroll(function () {             //스크롤을 시작하면
        //var h = $('.contentHeight').height();//해당 영역의 높이를 측정하여
        ////alert(h);
        //if ($(document).scrollTop() >= h + 100) {       //높이에 조정값(시행착오로 얻은 값)을 더하고 140 100
        //    $(".fixedPosition").addClass("fixed_top");      //메뉴 칸을 고정 시키다.
        //} else {
        //    $(".fixedPosition").removeClass("fixed_top");
        //}
        //if (sw == true)                     //상품정보, 상품분석평, 배송반품을 거쳐 왔는지를 체크
        //{
        //    $(document).scrollTop(h + 100); //해당 화면을 메뉴 칸 바로 밑에 고정시킨다. 139 100
        //    sw = false;                     //로그인 할 경우 상품정보 메뉴 칸의 위치가 유저이름높이 만큼 아래로 내려온다...
        //}
        ////스크롤을 시작하면 해당 영역의 높이를 측정하여
        var height = $('.fixedPosition').height();
        ////높이에 조정값(시행착오로 얻은 값)을 더하고 메뉴칸이 스크린 탑에 오면 메뉴 칸을 고정 시키다.
        if ($(document).scrollTop() >= height + 10) {
            $(".fixedPosition").css('position', 'sticky').css('top', (0 - height + 100) + 'px');
        ////메뉴칸이 스크린 탑을 벗어나면 position을 unset 시킨다.
        } else {
            $(".fixedPosition").css('position', 'unset');
        }
        ////상품정보, 상품분석평, 배송반품을 거쳐 왔는지를 체크
        ////해당 화면을 메뉴 칸 바로 밑에 고정시킨다.
        ////로그인 할 경우 상품정보 메뉴 칸의 위치가 유저이름높이 만큼 아래로 내려온다.해결해야할 문제.24/05/2019
        if (sw == true)                    
        {
            $(document).scrollTop(height + 340);
            sw = false;                    
        }
    });
    
    $('.productInfo').click(function () {        //상품정보를 클릭하면...
        $(this).addClass("blue_white");
        $('.productAnalysis').removeClass("blue_white");
        $('.backDelivery').removeClass("blue_white");
        sw = true;
        $('.dis_productAnalysis').hide();
        $('.dis_backDelivery').hide();
        $('.dis_productInfo').show();
    });
    $('.productAnalysis').click(function () {    //상품분석평을 클릭하면...
        $(this).addClass("blue_white");
        $('.productInfo').removeClass("blue_white");
        $('.backDelivery').removeClass("blue_white");
        $('.dis_productInfo').hide();
        $('.dis_backDelivery').hide();
        sw = true;
        $('.dis_productAnalysis').show();
    });
    $('.backDelivery').click(function () {        //배송반품을 클릭하면...
        $(this).addClass("blue_white");
        $('.productAnalysis').removeClass("blue_white");
        $('.productInfo').removeClass("blue_white");
        $('.dis_productAnalysis').hide();
        $('.dis_productInfo').hide();
        sw = true;
        $('.dis_backDelivery').show();
    });
});