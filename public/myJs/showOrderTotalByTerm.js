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

////<!--세부항목 보기-->
$(function () {
    $('.btn_details').click(function () {
        $('.modalNotice').show()  //데이터를 로딩 중... 메시지 보여주기
        $('.modal-body').empty()  //전에 보여준 화면을 clear 한다
        ////alert($(this).next().next().text())
        var orderId = $(this).next().next().text().trim();
        var oderDate = $(this).prev().prev().text();
        ////    alert("ssssssssss " + orderId);

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
                $('.bs-example-modal-lg2').modal();
            },
            error: function (data) {
                alert("/order/showOrderDetailsByChild 시스템에러...")
            }
        });
    });
});

////<!--Page 번호(Footer)를 클릭했을때 Ajax로 해당 데이터를 보낸다-->
$(function () {
    $('.page_footer').on('click', 'a', function () {
        if (this.href == "") { return; } //잘못 클릭했을 경우 아무것도 하지 않는다...
        var sDate = $('#startDate2').val().trim(); //위에서 숨겨놓은 값을 참조한다...////
        var eDate = $('#endDate2').val().trim();   //위에서 숨겨놓은 값을 참조한다...////
        $.ajax({
            url: this.href,
            type: 'GET',
            data: { startDate: sDate, endDate: eDate },
            cache: false,
            success: function (data) {
                $('#partialContent').html(data);
                //alert(data);
                //$('#partialContent').empty().append(data); //이렇게 코딩해도 실행된다...
                //debugger;
            },
            error: function () {
                alert("errors from ShowOrderTotalByTermPv...");
            }
        });
        return false;
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