////<!--아래 코드를 "/myJs/myCategorySub.js"에 추가 시키면 충돌로 인하여 작동불능 -->
$n(function () {
    ////bootstrap의 class list-group-item을 사용 할 경우 클릭하면 백그라운드 색이
    ////흰색으로 바뀌는 현상을 원래 지정했던 색상으로 보정한다.==>밑에 코드 추가로 사용 중단.
    //$n('.leftSideMenu a').click(function () {            
    //    $n(this).css('background-color', '#00ffff');
    //});

    //한번 크릭한 후에는 다시 mouseover를 하여도   
    //흰색으로 바뀌지 않아 강제로 흰색 과 blue를 추가 하였음.
    $n('.leftSideMenu a').mouseover(function () {
        $n(this).css('background-color', 'white');
    })

    $n('.leftSideMenu a').mouseout(function () {
        $n(this).css('background-color', '#00ffff');
    })

    ////화면 최 상단 좌측 세로줄 메뉴와 그에 따른 숨겨진 메뉴 그리고 화면 우측의 메인 카루셀을
    ////콘트롤 하는 로직을 간소화 시키려고 시도하다 중단 하였음. 추후에 다시 시도 예정 28/02/2019
    ////****아래 지우지 말 것****
    //$n('.leftSideMenu a').mouseover(function () { //한번 크릭한 후에는 다시 mouseover를 하여도             
    //    $n(this).css('background-color', 'white'); //흰색으로 바뀌지 않아 강제로 흰색 과 blue를 추가 하였음.

    //    $n('.list-group-item').each(function (i) {
    //        if ($n(this).attr("style") == "background-color: white;") { //**attr 로 style value check**
    //            $n(".categorySubBox").each(function (ii) {
    //                if (i == ii) {
    //                    $n(this).css('top', '0px').css('left', '-15px').css('position', 'relative').show()
    //                    $n('#my-carousel, .main_carousel_bottom').hide()
    //                }
    //            })
    //        }
    //    })                       
    //});

    //$n('.leftSideMenu a').mouseout(function () {
    //    //$n(this).css('background-color', '#00ffff');

    //    $n('.list-group-item').each(function (iii) {
    //        if ($n(this).attr("style") == "background-color: white;") { //**attr 로 style value check**
    //            $n(this).css('background-color', '#00ffff');
    //            //$n('#my-carousel, .main_carousel_bottom').show()
    //            //$n('.categorySubBox').hide()                    
    //        }
    //    })
    //});

});