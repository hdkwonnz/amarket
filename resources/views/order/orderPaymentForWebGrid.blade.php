@extends('layouts.app')

@section('title')
Order-orderpaymentForwebgrid
@endsection

@section('content')

<style>
    #table2 {
        width: 100%;
    }

    #table2 .td1 {
        width: 15%;
    }

    #table2 .td2 {
        word-break: break-all;
        width: 75%;
    }

    #table2 .tr2 {
        border-bottom: 1px solid rgba(128, 128, 128, 0.30);
    }
</style>

<style>
    #table1 {
        width: 100%;
        margin-bottom: 20px;
    }

    #table1 tr {
        line-height: 70px;
        width: 100%;
        background-color: rgba(0, 148, 255, 0.13);
    }

    #table1 .td1 {
        font-size: 30px;
        width: 60%;
        padding-left: 10px;
    }

    #table1 .td2 {
        font-size: 20px;
        width: 10%;
        opacity: 0.3;
    }

    #table1 .td3 {
        font-size: 20px;
        width: 5%;
        opacity: 0.3;
    }

    #table1 .td4 {
        font-size: 20px;
        width: 10%;
        color: blue;
    }

    #table1 .td5 {
        font-size: 20px;
        width: 5%;
        opacity: 0.3;
    }

    #table1 .td6 {
        font-size: 20px;
        width: 10%;
        opacity: 0.3;
    }
</style>

<!--blink 기능 구현-->
<script>
    function blinker() {
        $('.blink_me').fadeOut(500);
        $('.blink_me').fadeIn(500);
    }
    setInterval(blinker, 1000); //Runs every second
</script>

<div class="row" style="margin-right: 0px;">
    <div class='col-sm-12 col-md-12 col-lg-12'>
        <table id="table1">
            <tr>
                <td class="td1">
                    주문결제
                </td>
                <td class="td2">
                    장바구니
                </td>
                <td class="td3">
                    >
                </td>
                <td class="td4">
                    주문결제
                </td>
                <td class="td5">
                    >
                </td>
                <td class="td6">
                    주문완료
                </td>
            </tr>
        </table>
    </div>
</div>

<?php
$productCount = $numRows;  //controller에서 넘어온 값
?>

<div class="row" style="margin-right: 0px;">
    <div class="col-sm-7 col-md-7 col-lg-7">
        <div>
            <span style="font-size: 20px;">
                <b>배송지 선택</b>
            </span>
            <div style="border-top: 1px solid black; min-height: 30px; width: 100%;
                    background-color: rgba(128, 128, 128, 0.14);"></div>
            <div style="min-height: 250px;"></div>
            <div style="border-bottom: 1px solid black; min-height: 30px; width: 100%; line-height: 30px;
                    background-color: rgba(128, 128, 128, 0.14); vertical-align: central;">
                <div class="col-sm-8 col-md-8 col-lg-8"></div>
                <div class="col-sm-4 col-md-4 col-lg-4 text-right">
                    배송시 요청사항 입력하기 >
                </div>
            </div>
        </div>

        <div style="margin-top: 30px;">
            <span style="font-size: 20px;">
                <b>할인 및 제휴포인트 선택</b>
            </span>
            <div style="border-top: 1px solid black; min-height: 30px; width: 100%;
                    background-color: rgba(128, 128, 128, 0.14);"></div>
            <div style="min-height: 250px;"></div>
            <div style="border-bottom: 1px solid black; min-height: 30px; width: 100%; line-height: 30px;
                    background-color: rgba(128, 128, 128, 0.14); vertical-align: central;">
                <div class="col-sm-8 col-md-8 col-lg-8"></div>
                <div class="col-sm-4 col-md-4 col-lg-4 text-right"></div>
            </div>
        </div>

        <div style="margin-top: 30px;">
            <span style="font-size: 20px;">
                <b>결제수단 선택</b>
            </span>
            <div style="border-top: 1px solid black; min-height: 30px; width: 100%;
                    background-color: rgba(128, 128, 128, 0.14);"></div>
            <div style="min-height: 250px;"></div>
            <div style="border-bottom: 1px solid black; min-height: 30px; width: 100%; line-height: 30px;
                    background-color: rgba(128, 128, 128, 0.14); vertical-align: central;">
                <div class="col-sm-8 col-md-8 col-lg-8"></div>
                <div class="col-sm-4 col-md-4 col-lg-4 text-right"></div>
            </div>
        </div>
    </div>
    <div class="col-sm-5 col-md-5 col-lg-5">
        <span style="font-size: 20px;">
            <b>주문상품 정보</b>
        </span>
        <div style="width: 100%; height: 400px; overflow-y: scroll; border-top: 1px solid black; border-bottom: 1px solid black; border-left: 1px solid black; border-right: 1px solid black;">

            <table id="table2">
                <?php
                $originPriceGrandTotal = 0;
                $sellPriceGrandTotal = 0;
                foreach ($carts as $item)
                {
                    $cartId = $item->id;
                    $quantity = $item->quantity;
                    $product = $item->product; //Shoppingcart model class에서 product function call
                    $modelName = $product->modelName;
                    $originPrice = $product->originPrice;
                    $sellPrice = $product->sellPrice;
                    //$pictures = $product->pictures->first(); //$product(Product model class에서 pictures function call
                    //$fileName = $pictures->fileName; //stop 26/04/2019
                    $fileName = $product->searchImage;
                    $originPriceTotal = $originPrice * $quantity;
                    $originPriceGrandTotal = $originPriceTotal + $originPriceGrandTotal;
                    $sellPriceTotal = $sellPrice * $quantity;
                    $sellPriceGrandTotal = $sellPriceTotal + $sellPriceGrandTotal;
                ?>

                <tr>
                    <td class="td1">
                        <div>
                            <?=$fileName?>                            
                        </div>
                    </td>
                    <td class="td2">
                        <?=$modelName?>
                    </td>
                </tr>
                <tr class="tr2">
                    <td colspan="2" class="text-center">
                        <span style="text-decoration: line-through;" class="originPriceTotal_txt">
                            <?=$originPriceTotal?>
                        </span>
                        원
                        <br />
                        <span>
                            <b class="sellPriceTotal_txt">
                                <?=$sellPriceTotal?>
                            </b>
                            원
                        </span>
                        /
                        <span>
                            <b>
                                <?=$quantity?>
                            </b>
                            개
                        </span>
                    </td>
                </tr>

                <?php
                }
                ?>
            </table>

        </div>
        <div style="width: 100%; height: 50px; background: rgba(128, 128, 128, 0.12); margin-top: 0px; border-bottom: 1px solid black; border-left: 1px solid black; border-right: 1px solid black;">
            <div class="text-center" style="font-size: 20px; padding-top: 8px;">
                총
                <span style="color: green;">
                    <?=$productCount?>
                </span>
                건
            </div>
        </div>
        <div style="font-size: 20px; margin-top: 40px;">
            <span>최종결제 정보</span>
        </div>
        <div style="width: 100%; height: auto; font-size: 25px; border-top: 4px solid black; border-bottom: 4px solid black; border-left: 4px solid black; border-right: 4px solid black;">
            <div class="row">
                <div class="col-sm-6 col-md-6-col-lg-6 text-left">
                    .상품가격
                </div>
                <div class="col-sm-6 col-md-6-col-lg-6 text-right originPriceGrandTotal_txt">
                    <?=$originPriceGrandTotal?>
                    <span>원</span>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-6 col-md-6-col-lg-6 text-left">
                    .할인가격
                </div>
                <div class="col-sm-6 col-md-6-col-lg-6 text-right sellPriceGrandTotal_txt">
                    <?=$sellPriceGrandTotal?>
                    <span>원</span>
                </div>
                <!--Ajax에서 사용하기위해 숨긴다...-->
                <div style="display: none;" class="sellPriceGrandTotal_txt2">
                    <?=$sellPriceGrandTotal?>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-6 col-md-6-col-lg-6 text-left">
                    .배송비
                </div>
                <div class="col-sm-6 col-md-6-col-lg-6 text-right">
                    xxxxxx 원
                </div>
            </div>
            <hr />
            <div class="row">
                <div class="col-sm-6 col-md-6-col-lg-6 text-left">
                    .결제예정금액
                </div>
                <div class="col-sm-6 col-md-6-col-lg-6 text-right">
                    xxxxxx 원
                </div>
            </div>
            <div class="row">
                <a href="javascript:void();" id="checkOut">
                    <div class="col-sm-12 col-md-12-col-lg-12 text-center" style="margin-top: 20px; margin-bottom: 20px; margin-left: 48px; min-height: 80px; width: 80%; background: #0094ff; line-height: 80px; vertical-align: middle;">
                        <div style="font-size: 40px; color: white;" id="checkOutButton">결제 하기</div>
                    </div>
                </a>
                <div style="padding-left: 25px;">
                    <div class="waitMessage blink_me" style="color: red; font-size: 20px;"></div>
                </div>
            </div>
        </div>

    </div>
</div>

<!--script-->

<!--금액 편집-->
<script>
    $(function () {
        $('.originPriceTotal_txt').each(function () {
            var txtValue = "";
            txtValue = formatNumber($(this).text());
            $(this).text(txtValue);
        })

        $('.sellPriceTotal_txt').each(function () {
            var txtValue = "";
            txtValue = formatNumber($(this).text());
            $(this).text(txtValue);
        })

        var txtValue = "";
        txtValue = formatNumber($('.originPriceGrandTotal_txt').text());
        $('.originPriceGrandTotal_txt').text(txtValue);

        var txtValue = "";
        txtValue = formatNumber($('.sellPriceGrandTotal_txt').text());
        $('.sellPriceGrandTotal_txt').text(txtValue);

    });

    //편집하는 함수
    function formatNumber(num) {
        return num.toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, "$1,")
    }
</script>

<!--결제하기 버튼 클릭시 처리 로직-->
<script>
    $(function(){
        var sellPGT = $('.sellPriceGrandTotal_txt2').text().trim();  ////
        $('#checkOut').click(function () { //결제하기 버튼을 누르면
            if ('sellPGT' == 0)
            {
                alert("결제할 상품이 없습니다...");
                $('.loader').hide();//loding spinner를 숨긴다.26/04/2019
                return false;
            }
            else
            {   ////중요한 예제임...
                ////payStation을 이용하기 전 로직(지우지 말것...)
                ////콘트롤러에서 처리 결과를 어레이형태로 받는다  

                    //$('#checkOut').hide();//stop 26/04/2019
                    //$('.waitMessage').text("잠시만 기다리세요...");//stop 26/04/2019

                    $.ajax({                
                    type: "Post",
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    url: "/order/checkOut",
                    data: { totalPrice: sellPGT },
                    cash: false,
                    success: function (data) {
                        if (data.success == false) {
                            //$('.waitMessage').text("");//stop 26/04/2019
                            alert(data.errorMessage);
                            $('.loader').hide();//loding spinner를 숨긴다.26/04/2019
                            //$('#checkOut').show();//stop 26/04/2019
                        }
                        else {
                            var cartNum = data.cartNum;
                            var orderId = data.currentOrderId;
                            //alert(cartNum + "  ++++  " + orderId);
                            //아래방법으로 하면 새로운 창이뜬다...
                            //window.open('/Orders/ShowCurrentOrder?cartUser=' + cartNum + '&currentOrderId=' + orderId, 'NewWindow');
                            //window.location.href = '/order/showCurrentOrder?cartUser=' + cartNum + '&currentOrderId=' + orderId;
                            window.location.href = '/order/showCurrentOrder/' + orderId;
                        }                       
                    },
                    error: function (data) {
                        //$('.waitMessage').text("");//stop 26/04/2019
                        alert("order/checkOut 시스템에러...orderPaymentForWebGrid.blade.php");
                        $('.loader').hide();//loding spinner를 숨긴다.26/04/2019
                        //$('#checkOut').show();//stop 26/04/2019                       
                    }
                });

                ////아래는 잠시보류. payStation 등록문제로...09/10/2016
                ////$('#checkOut').prop('disabled', true);
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
</script>

@endsection