////<!--금액 편집-->/////////////////////////////////////////////////////
$(function () {
    $('.sellPrice_txt').each(function () {
        var txtValue = "";
        txtValue = formatNumber($(this).text());
        $(this).text(txtValue);
    })

    $('.originPrice_txt').each(function () {
        var txtValue = "";
        txtValue = formatNumber($(this).text());
        $(this).text(txtValue);
    })

    $('.second_option_amount_text').each(function () {
        var txtValue = "";
        txtValue = formatNumber($(this).text());
        $(this).text(txtValue);
    })

    $('.first_option_amount_text').each(function () {
        var txtValue = "";
        txtValue = formatNumber($(this).text());
        $(this).text(txtValue);
    })
    
    $('.grandDeliveryCost_txt').each(function () {
        var txtValue = "";
        txtValue = formatNumber($(this).text());
        $(this).text(txtValue);
    })

    $('.grandTotalOrderAmount_txt').each(function () {
        var txtValue = "";
        txtValue = formatNumber($(this).text());
        $(this).text(txtValue);
    })
   
    var txtValue = "";
    txtValue = formatNumber($('.originPriceGrandTotal_txt').text());
    $('.originPriceGrandTotal_txt').text(txtValue);

    var txtValue = "";
    txtValue = formatNumber($('.grandDiscountedAmount_txt').text());
    $('.grandDiscountedAmount_txt').text(txtValue);

});

//편집하는 함수
function formatNumber(num) {
    return num.toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, "$1,")
}

////<!--결제하기 버튼 클릭시-->//////////////////////////////////////////////
$(function () {
    var sellPGT = $('.grandTotalOrderAmount_number').text().trim();  ////    
    $('#checkOut').click(function () { //결제하기 버튼을 누르면
        if ('sellPGT' == 0) { //현재는 이로직을 커치지 않는다...19/05/2019
            alert("결제할 상품이 없습니다...");
            $('.my_loader').hide();//loding spinner를 숨긴다.26/04/2019
            return false;
        }
        else {   ////중요한 예제임...
            ////payStation을 이용하기 전 로직(지우지 말것...)
            ////콘트롤러에서 처리 결과를 어레이형태로 받는다

            //$('#checkOut').hide();//stop 26/04/2019
            //$('.waitMessage').text("잠시만 기다리세요...");//stop 26/04/2019

            $.ajax({
                type: "Post",
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: "/order/checkOutWithCdn",
                data: { totalPrice: sellPGT },
                cash: false,
                success: function (data) {
                    if (data.success == false) {
                        //$('.waitMessage').text("");//stop 26/04/2019
                        alert(data.errorMessage);
                        $('.my_loader').hide();//loding spinner를 숨긴다.26/04/2019
                        //$('#checkOut').show();//stop 26/04/2019
                    }
                    else {                       
                        var cartNum = data.cartNum;
                        var orderId = data.currentOrderId;
                        //alert(cartNum + "  ++++  " + orderId);
                        //아래방법으로 하면 새로운 창이뜬다...
                        //window.open('/Orders/ShowCurrentOrder?cartUser=' + cartNum + '&currentOrderId=' + orderId, 'NewWindow');
                        //window.location.href = '/order/showCurrentOrder?cartUser=' + cartNum + '&currentOrderId=' + orderId;
                        ////아래는 "/order/checkOutWithCdn"에 합쳐야하나 학습 목적으로 분리시켰음.13/05/2019
                        window.location.href = '/order/showCurrentOrder/' + orderId;
                    }
                },
                error: function (data) {
                    //$('.waitMessage').text("");//stop 26/04/2019
                    alert("order/checkOutWithCdn 시스템에러...orderPaymentForWebGridWithCdn.blade.php");
                    $('.my_loader').hide();//loding spinner를 숨긴다.26/04/2019
                    //$('#checkOut').show();//stop 26/04/2019
                }
            });

            ////아래는 잠시보류. payStation 등록문제로...09/10/2016
            //$('#checkOut').prop('disabled', true);
            //$('#checkOut').hide();
            //$('.waitMessage').text("잠시만 기다리세요...");
            //$.ajax({
            //    type: "Post",
            //    url: "/payStation/payStationRefresh",
            //    data: { amount: sellPGT },
            //    cash: false,
            //    success: function (data) {          //중요한 예제임...
            //        if (data.success == false) {    //콘트롤러에서 처리 결과를 어레이형태로 받는다.
            //            $('.waitMessage').text("");
            //            alert(data.result);
            //            //$('#checkOut').prop('disabled', false);
            //            $('#checkOut').show();
            //        }
            //        else {
            //            window.location.href = data.result;  //payStation으로 이동
            //        }
            //    },
            //    error: function (data) {
            //        $('.waitMessage').text("");
            //        alert("/payStation/payStationRefresh 시스템에러...");
            //        //$('#checkOut').prop('disabled', false);
            //        $('#checkOut').show();
            //    }
            //});
            //return false;
        }
    });
});
