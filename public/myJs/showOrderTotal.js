////<!--금액 편집-->
$(function () {
    $('.totalPrice_txt').each(function () {
        var txtValue = "";
        txtValue = formatNumber($(this).text());
        $(this).text(txtValue);
    })
});
//편집하는 함수
function formatNumber(num) {
    return num.toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, "$1,")
}

////<!--화면 왼쪽 메뉴박스에 마우스오버하면 하위 메뉴를 보여준다-->
$(function () {
    //bootstrap의 class list-group-item을 사용 할 경우 클릭하면 백그라운드 색이
    //흰색으로 바뀌는 현상을 원래 지정했던 색상으로 보정한다
    $('.leftSideMenu a').click(function () {
        $(this).css('background-color', 'rgba(0, 38, 255, 0.64)');
    });

    $('.smilePay').mouseover(function () {
        $('.smilePayChildren').show();
    });
    $('.smilePay').mouseout(function () {
        $('.smilePayChildren').hide();
    });

    $('.coupon').mouseover(function () {
        $('.couponChildren').show();
    });
    $('.coupon').mouseout(function () {
        $('.couponChildren').hide();
    });

    $('.myInterest').mouseover(function () {
        $('.myInterestChildren').show();
    });
    $('.myInterest').mouseout(function () {
        $('.myInterestChildren').hide();
    });

    $('.myMessage').mouseover(function () {
        $('.myMessageChildren').show();
    });
    $('.myMessage').mouseout(function () {
        $('.myMessageChildren').hide();
    });

    $('.myInfo').mouseover(function () {
        $('.myInfoChildren').show();
    });
    $('.myInfo').mouseout(function () {
        $('.myInfoChildren').hide();
    });
});

////<!--지난 주문내역 더보기를 클릭했을때 그 하위 메뉴에서 실행되는 내용들-->
//order/showOrderTotalByTerm로 보낸다.
function showOrderTotalByTerm(sDate, eDate) {
    $('#partialContent').empty()//항상 전 화면을 clear한다.
    $('.dataLoadingNotice').show()//데이터 로딩 중... 메시지를 보여 준다.

    //alert("sDate : " + sDate + "  eDate : " + eDate);  ///////
    $.ajax({
        type: "GET",
        cache: false,  //반드시 사용할것 ==> 그렇지 않으면 리프레시가 않된다......
        url: "/order/showOrderTotalByTerm",
        data: { startDate: sDate, endDate: eDate },
        success: function (data) {
            //alert(data + "정상");
            $('.dataLoadingNotice').hide()//데이터 로딩 중... 메시지를 숨긴다.
            $('#partialContent').empty().append(data);//"/order/showOrderTotalByTerm"에서 넘어온 내용 보여주기
            //debugger;
        },
        error: function (data) {
            $('.dataLoadingNotice').hide()//데이터 로딩 중... 메시지를 숨긴다.
            alert("order/showOrderTotalByTerm 시스템에러...");
            //debugger;
        }
    });
}

$(function () {
    //화면이 나옴과 동시에 "1개월"(화면중간 기간별조회)칸에 노란색(콘트롤에서 처음에는 1개월치만 보요준다)
    //$('.oneMonth').css('background', 'yellow');
    ////지난주문내역더보기 클릭
    //$('.click_first_title').click(function () {
    //    $('.first_title').hide();
    //    $('.second_title').show();
    //    $('.show_term_title').show();
    //});

    //지난 주문내역 더보기 클릭
    $('.click_first_title').click(function () {
        //alert("############");
        $('.first_title').hide();
        $('.second_title').show();
        $('.show_term_title').show();

        var today = new Date();
        var eDate = $m.datepicker.formatDate('yy/mm/dd', new Date(today));
        eDate = eDate + " 23:59:59";
        //alert("eDate : " + eDate); //
        var actualDate = new Date(today); // convert to actual date
        var newDate = new Date(actualDate.getFullYear(), actualDate.getMonth(), actualDate.getDate() - 31); // // create new in(de)creased date
        var sDate = $m.datepicker.formatDate('yy/mm/dd', new Date(newDate));
        sDate = sDate + " 00:00:00";
        //$(this).css('background', 'yellow');
        $('.oneMonth').css('background', 'yellow');
        $('.fifteenDays').css('background', 'white');
        $('.oneWeek').css('background', 'white');
        $('.oneMonthBefore').css('background', 'white');
        $('.twoMonthBefore').css('background', 'white');
        $('.threeMonthBefore').css('background', 'white');
        $('.fourMonthBefore').css('background', 'white');
        $('.fiveMonthBefore').css('background', 'white');
        $('#txtFromDate, #txtToDate').css('background', 'white');
        $('#txtFromDate, #txtToDate').val('');
        //window.location.href = '/Orders/ShowOrderTotalByTerm?startDate=' + sDate + '&endDate=' + eDate;
        //sDate = '2016/10/09 00:00:00';
        //eDate = '2016/10/09 23:59:59';
        showOrderTotalByTerm(sDate, eDate);
    });

    //주문내역 건수 클릭(화면 맨 상단 우측)
    $('.show_status').click(function () {
        $('.show_all_status').show();
    });
    $('.show_all_status').click(function () {
        $(this).hide();
    });

    //세부항목 보기
    $('.btn_details').click(function () {
        $('.modalNotice').show()  //데이터를 로딩 중... 메시지 보여주기
        $('.modal-body').empty()  //전에 보여준 화면을 clear 한다
        var orderId = $(this).next().next().text().trim();
        var oderDate = $(this).prev().prev().text();
        //alert(oderDate);
        //alert(orderId);
        ////    //window.open('/Orders/ShowOrderDetailsByAngular?orderId=' + orderId);  //Angular==>문제있음...

        //아래처럼 윈도우를 새로 열다가 모달다이얼로그로 바꾸었음.
        //아래 Ajax에서 data를 전송받아 모달로 다시 전송한다.
        //window.open('/orders/showOrderDetailsByChild?orderId=' + orderId, 'PopupWindow2', 'resizable=no,scrollbars=yes,width=600px,height=600px');

        $.ajax({
            type: "get",
            url: "/order/showOrderDetailsByChild",
            data: { orderId: orderId, oderDate: oderDate },
            success: function (data) {
                $('.modal_oderDate').empty().append(oderDate);
                $('.modal_orderId').empty().append(orderId);
                $('.modalNotice').hide(); //데이터를 로딩 중... 메시지 숨기기
                $('.modal-body').empty().append(data);
                $('.bs-example-modal-lg').modal(show);
            },
            error: function (data) {
                alert("/order/showOrderDetailsByChild 시스템에러...xxx")
            }
        });
    });

    //칼렌다로 표시된 항목의 시작 과 끝 날짜를 눌렀을때 처리하는 로직
    $('#btnBtn').click(function () {
        var fromDate = $('#txtFromDate').val();
        var fDate = $m.datepicker.parseDate('yy/mm/dd', fromDate);
        //alert("fDate : " + fDate); //

        var toDate = $('#txtToDate').val();
        var tDate = $m.datepicker.parseDate('yy/mm/dd', toDate);
        //alert("tDate : " + tDate); //

        if (fromDate == "" || toDate == "") {
            $('#txtFromDate, #txtToDate').css('background', 'white');
            alert("Please Select Date 1 ...");
            return;
        }
        if (fDate > tDate) {
            $('#txtFromDate, #txtToDate').css('background', 'white');
            alert("Please Select Right Date 2 ...");
            return;
        }
        var now = $m.datepicker.formatDate('yy/mm/dd', new Date());
        var nDate = $m.datepicker.parseDate('yy/mm/dd', now);
        //alert(nDate);
        //alert(tDate);

        if (tDate > nDate) {
            $('#txtFromDate, #txtToDate').css('background', 'white');
            alert("Please Select Right Date 3 ...");
            return;
        }

        ////두 날짜 사이의 경과된 일수 구하는 로직
        var oneDay = 24 * 60 * 60 * 1000;
        var start = new Date(fDate);
        //alert(start);                      //
        var end = new Date(tDate);
        //alert(end);                            //
        var diffDays = Math.round(Math.abs((end.getTime() - start.getTime()) / (oneDay)));
        //alert(diffDays);
        if (diffDays > 31) {
            $('#txtFromDate, #txtToDate').css('background', 'white');
            alert("날자 수 가 31일을 넘었습니다. 다시 선택해 주십시요...")
            return;
        }

        ////시작 날짜가 현재 시점에서 180일 보다 크면 에러
        var tTDate = new Date(nDate);
        //alert(tDate);                            //
        diffDays = Math.round(Math.abs((tTDate.getTime() - start.getTime()) / (oneDay)));
        //alert(diffDays);                        //
        if (diffDays > 180) {
            $('#txtFromDate, #txtToDate').css('background', 'white');
            alert("시작 날자가 180일을 넘었습니다. 다시 선택해 주십시요...")
            return;
        }

        //var sDate = fromDate + " 00:00:00";
        var sDate = $m.datepicker.formatDate('mm/dd/yy', new Date(fDate));
        sDate = sDate + " 00:00:00";
        //alert("sDate : " + sDate); //
        //var eDate = toDate + " 23:59:59";
        var eDate = $m.datepicker.formatDate('mm/dd/yy', new Date(tDate));
        eDate = eDate + " 23:59:59";
        //alert("eDate : " + eDate); //
        $('#txtFromDate, #txtToDate').css('background', 'yellow');
        $('.oneWeek').css('background', 'white');
        $('.fifteenDays').css('background', 'white');
        $('.oneMonth').css('background', 'white');
        $('.oneMonthBefore').css('background', 'white');
        $('.twoMonthBefore').css('background', 'white');
        $('.threeMonthBefore').css('background', 'white');
        $('.fourMonthBefore').css('background', 'white');
        $('.fiveMonthBefore').css('background', 'white');
        //window.location.href = '/Orders/ShowOrderTotalByTerm?startDate=' + sDate + '&endDate=' + eDate;

        showOrderTotalByTerm(sDate, eDate);

        ////어느 시점으로 부터 일정기간 경과된 날짜 구하는 로직--지우지 말 것--
        ////var dateString = '30 Apr 2010'; // date string
        //var dateString = new Date();
        //var actualDate = new Date(dateString); // convert to actual date
        //var newDate = new Date(actualDate.getFullYear(), actualDate.getMonth(), actualDate.getDate() + 7); // // create new increased date
        //alert(newDate);
        //var dDate = $m.datepicker.formatDate('dd/mm/yy', new Date(newDate));
        //alert($m.datepicker.formatDate('dd/mm/yy', new Date(newDate)));
        //alert(dDate);
    });

    //1주일을 클릭했으때
    $('.oneWeek').click(function () {
        var today = new Date();
        var eDate = $m.datepicker.formatDate('mm/dd/yy', new Date(today));
        eDate = eDate + " 23:59:59";
        //alert("eDate : " + eDate); //
        var actualDate = new Date(today); // convert to actual date
        var newDate = new Date(actualDate.getFullYear(), actualDate.getMonth(), actualDate.getDate() - 7); // // create new in(de)creased date
        var sDate = $m.datepicker.formatDate('mm/dd/yy', new Date(newDate));
        sDate = sDate + " 00:00:00";
        $(this).css('background', 'yellow');
        $('.fifteenDays').css('background', 'white');
        $('.oneMonth').css('background', 'white');
        $('.oneMonthBefore').css('background', 'white');
        $('.twoMonthBefore').css('background', 'white');
        $('.threeMonthBefore').css('background', 'white');
        $('.fourMonthBefore').css('background', 'white');
        $('.fiveMonthBefore').css('background', 'white');
        $('#txtFromDate, #txtToDate').css('background', 'white');
        $('#txtFromDate, #txtToDate').val('');
        //window.location.href = '/Orders/ShowOrderTotalByTerm?startDate=' + sDate + '&endDate=' + eDate;

        showOrderTotalByTerm(sDate, eDate);
    });

    //15일을 클릭했을때
    $('.fifteenDays').click(function () {
        var today = new Date();
        var eDate = $m.datepicker.formatDate('mm/dd/yy', new Date(today));
        eDate = eDate + " 23:59:59";
        //alert("eDate : " + eDate); //
        var actualDate = new Date(today); // convert to actual date
        var newDate = new Date(actualDate.getFullYear(), actualDate.getMonth(), actualDate.getDate() - 15); // // create new in(de)creased date
        var sDate = $m.datepicker.formatDate('mm/dd/yy', new Date(newDate));
        sDate = sDate + " 00:00:00";
        $(this).css('background', 'yellow');
        $('.oneWeek').css('background', 'white');
        $('.oneMonth').css('background', 'white');
        $('.oneMonthBefore').css('background', 'white');
        $('.twoMonthBefore').css('background', 'white');
        $('.threeMonthBefore').css('background', 'white');
        $('.fourMonthBefore').css('background', 'white');
        $('.fiveMonthBefore').css('background', 'white');
        $('#txtFromDate, #txtToDate').css('background', 'white');
        $('#txtFromDate, #txtToDate').val('');
        //window.location.href = '/Orders/ShowOrderTotalByTerm?startDate=' + sDate + '&endDate=' + eDate;

        showOrderTotalByTerm(sDate, eDate);
    });

    //1개월을 클릭 했을때
    $('.oneMonth').click(function () {
        var today = new Date();
        var eDate = $m.datepicker.formatDate('mm/dd/yy', new Date(today));
        eDate = eDate + " 23:59:59";
        //alert("eDate : " + eDate); //
        var actualDate = new Date(today); // convert to actual date
        var newDate = new Date(actualDate.getFullYear(), actualDate.getMonth(), actualDate.getDate() - 31); // // create new in(de)creased date
        var sDate = $m.datepicker.formatDate('mm/dd/yy', new Date(newDate));
        sDate = sDate + " 00:00:00";
        $(this).css('background', 'yellow');
        $('.fifteenDays').css('background', 'white');
        $('.oneWeek').css('background', 'white');
        $('.oneMonthBefore').css('background', 'white');
        $('.twoMonthBefore').css('background', 'white');
        $('.threeMonthBefore').css('background', 'white');
        $('.fourMonthBefore').css('background', 'white');
        $('.fiveMonthBefore').css('background', 'white');
        $('#txtFromDate, #txtToDate').css('background', 'white');
        $('#txtFromDate, #txtToDate').val('');
        //window.location.href = '/Orders/ShowOrderTotalByTerm?startDate=' + sDate + '&endDate=' + eDate;

        showOrderTotalByTerm(sDate, eDate);
    });

    //1개월 전 클릭 했을때
    $('.oneMonthBefore').click(function () {
        var eDate = $('#oneMonthLast').val();
        //alert("eDate  " + eDate);
        var sDate = $('#oneMonthFirst').val();
        //alert("sDate  " + sDate);
        $(this).css('background', 'yellow');
        $('.fifteenDays').css('background', 'white');
        $('.oneWeek').css('background', 'white');
        $('.oneMonth').css('background', 'white');
        $('.twoMonthBefore').css('background', 'white');
        $('.threeMonthBefore').css('background', 'white');
        $('.fourMonthBefore').css('background', 'white');
        $('.fiveMonthBefore').css('background', 'white');
        $('#txtFromDate, #txtToDate').css('background', 'white');
        $('#txtFromDate, #txtToDate').val('');
        //alert(sDate);
        //window.location.href = '/Orders/ShowOrderTotalByTerm?startDate=' + sDate + '&endDate=' + eDate;

        showOrderTotalByTerm(sDate, eDate);
    });

    //2개월 전 클릭 했을때
    $('.twoMonthBefore').click(function () {
        var eDate = $('#twoMonthLast').val();
        //alert(eDate);
        var sDate = $('#twoMonthFirst').val();
        $(this).css('background', 'yellow');
        $('.fifteenDays').css('background', 'white');
        $('.oneWeek').css('background', 'white');
        $('.oneMonth').css('background', 'white');
        $('.oneMonthBefore').css('background', 'white');
        $('.threeMonthBefore').css('background', 'white');
        $('.fourMonthBefore').css('background', 'white');
        $('.fiveMonthBefore').css('background', 'white');
        $('#txtFromDate, #txtToDate').css('background', 'white');
        $('#txtFromDate, #txtToDate').val('');
        //alert(sDate);
        //window.location.href = '/Orders/ShowOrderTotalByTerm?startDate=' + sDate + '&endDate=' + eDate;

        showOrderTotalByTerm(sDate, eDate);
    });

    //3개월 전 클릭 헸을때
    $('.threeMonthBefore').click(function () {
        var eDate = $('#threeMonthLast').val();
        //alert(eDate);
        var sDate = $('#threeMonthFirst').val();
        $(this).css('background', 'yellow');
        $('.fifteenDays').css('background', 'white');
        $('.oneWeek').css('background', 'white');
        $('.oneMonth').css('background', 'white');
        $('.oneMonthBefore').css('background', 'white');
        $('.twoMonthBefore').css('background', 'white');
        $('.fourMonthBefore').css('background', 'white');
        $('.fiveMonthBefore').css('background', 'white');
        $('#txtFromDate, #txtToDate').css('background', 'white');
        $('#txtFromDate, #txtToDate').val('');
        //alert(sDate);
        //window.location.href = '/Orders/ShowOrderTotalByTerm?startDate=' + sDate + '&endDate=' + eDate;

        showOrderTotalByTerm(sDate, eDate);
    });

    //4개월 전 클릭 했을때
    $('.fourMonthBefore').click(function () {
        var eDate = $('#fourMonthLast').val();
        //alert(eDate);
        var sDate = $('#fourMonthFirst').val();
        $(this).css('background', 'yellow');
        $('.fifteenDays').css('background', 'white');
        $('.oneWeek').css('background', 'white');
        $('.oneMonth').css('background', 'white');
        $('.oneMonthBefore').css('background', 'white');
        $('.twoMonthBefore').css('background', 'white');
        $('.threeMonthBefore').css('background', 'white');
        $('.fiveMonthBefore').css('background', 'white');
        $('#txtFromDate, #txtToDate').css('background', 'white');
        $('#txtFromDate, #txtToDate').val('');
        //alert(sDate);
        //window.location.href = '/Orders/ShowOrderTotalByTerm?startDate=' + sDate + '&endDate=' + eDate;

        showOrderTotalByTerm(sDate, eDate);
    });

    //5개월 전 클릭 했을때
    $('.fiveMonthBefore').click(function () {
        var eDate = $('#fiveMonthLast').val();
        //alert(eDate);
        var sDate = $('#fiveMonthFirst').val();
        $(this).css('background', 'yellow');
        $('.fifteenDays').css('background', 'white');
        $('.oneWeek').css('background', 'white');
        $('.oneMonth').css('background', 'white');
        $('.oneMonthBefore').css('background', 'white');
        $('.twoMonthBefore').css('background', 'white');
        $('.threeMonthBefore').css('background', 'white');
        $('.fourMonthBefore').css('background', 'white');
        $('#txtFromDate, #txtToDate').css('background', 'white');
        $('#txtFromDate, #txtToDate').val('');
        //alert(sDate);
        //window.location.href = '/Orders/ShowOrderTotalByTerm?startDate=' + sDate + '&endDate=' + eDate;

        showOrderTotalByTerm(sDate, eDate);
    });
});

////<!--화면좌측 박스메뉴에서 나의설정에서-->
$(function () {
    //회원정보설정을 클릭하면...
    $('.memberClick').click(function () {
        //window.location.href = '/manage/myInfo';
        window.location = '/manage/reEnterPassword?id=' + 1;
        return false;
    });
    //주소록설정을 클릭하면...
    $('.addressClick').click(function () {
        //window.location = '/manage/myAddress';
        window.location = '/manage/reEnterPassword?id=' + 2;
    });
    //사이트설정을 클릭하면...
    $('.siteClick').click(function () {
        //window.location = '/manage/myAddress';
        window.location = '/manage/reEnterPassword?id=' + 3;
    });
    //주문/결제설정을 클릭하면...
    $('.orderPayClick').click(function () {
        //window.location = '/manage/myAddress';
        window.location = '/manage/reEnterPassword?id=' + 4;
    });
});

////$로 하면 에러가 나서 $m으로 재정의(Jquery UI 사용을 위하여...)
//// DatePicker의 UI(특히 prev, next 표시)를 바로 쓰기 위해서는 Jquery Ui에서 다운 받은 images파일을
////jquery-ui.css가 있는 같은 경로에 두어야한다. 예를들면 아래와 같다.
////<link href="~/Content/jquery-ui.css" rel="stylesheet" /> 가 Content 밑에 있으니 images 파일도 Content 도 밑에 있어야 한다... 
$m = jQuery.noConflict();
$m(function () {
    $m("#txtFromDate").datepicker({
        showButtonPanel: true,
        dateFormat: 'yy/mm/dd'
    });
    $m("#txtToDate").datepicker({
        showButtonPanel: true,
        dateFormat: 'yy/mm/dd'
    });
});

////<!--아래는 매우 중요 절대 지우지 말 것.13/05/2019-->
////<!--이미지값을 trim 해 준다.-->
$(function () {
    $('.search_image').each(function () {
        trimedText = ($(this).text().trim());
        $(this).empty().append(trimedText);
    })
});
