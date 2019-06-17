@extends('layouts.app')

@section('title')
Order-orderpaymentForwebgrid
@endsection

@section('content')

<!--blink 기능 구현--><!--stopped. 12/05/2019-->
<script>
    //function blinker() {
    //    $('.blink_me').fadeOut(500);
    //    $('.blink_me').fadeIn(500);
    //}
    //setInterval(blinker, 1000); //Runs every second
</script>

<!--헤더 타이틀-->
<div class="row" style="margin-right: 30px;">
    <div class='col-sm-12 col-md-12 col-lg-12'
        style="background-color: rgba(0, 148, 255, 0.13); min-height: 80px;
                line-height: 80px; margin-left: 15px;">
        <div class='col-sm-5 col-md-5 col-lg-5' style="padding-left: 0px; font-size: 30px;">
            <span>주문결제</span>
        </div>
        <div class='col-sm-2 col-md-2 col-lg-2'>
            <!----->
        </div>
        <div class='col-sm-5 col-md-5 col-lg-5'>
            <span style="font-size: 20px; color: #0026ff; opacity: 0.3;">장바구니</span>
            <span style="font-size: 20px; color: #0026ff; 
                        margin-left: 20px; opacity: 0.3;">
                >
            </span>
            <span style="font-size: 20px; color: #0026ff;
                          margin-left: 15px; opacity: 1;">
                주문결제
            </span>
            <span style="font-size: 20px; color: #0026ff; 
                        margin-left: 15px; opacity: 0.3;">
                >
            </span>
            <span style="font-size: 20px; color: #0026ff;
                          margin-left: 15px; opacity: 0.3;">
                주문완료
            </span>
        </div>
    </div>
</div>

<!--화면을 크게 이등분 하였음.-->
<!--화면의 왼쪽. 배송지선택,할인및제휴포인트선택,결제수단선택-->
<div class="row" style="margin-right: 0px; margin-top: 20px; margin-bottom: 20px;">
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

    <!--화면의 오른쪽.주문상품정보,최종결제정보-->
    <div class="col-sm-5 col-md-5 col-lg-5">
        <span style="font-size: 20px;">
            <b>주문상품 정보</b>
        </span>

        <!--주문상품 정보 오른쪽 위 box-->
        <div style="width: 100%; height: 400px; overflow-y: scroll; border-top: 1px solid black; border-bottom: 1px solid black; border-left: 1px solid black; border-right: 1px solid black;">
           
            <?php
            $saveProductId = '';
            $saveOwner = '';
            $index = 0;
            $originSumPrice = 0;
            $originGrandTotal = 0;
            $sumPrice = 0;
            $grandTotal = 0;
            $discountRate = 0;
            $saveOriginalPriceByQtyTotal = 0;
            $originalPriceByQtyTotal = 0;
            $originalPriceByQty = 0;
            $originalPriceByOptions = 0;
            $firstOptionAmount = 0;
            $secondOptionAmount = 0;
            $sellPriceByOptions = 0;
            $sellPriceByQty = 0;
            $discountedPriceByQty = 0;
            $discountedPriceByQtyTotal = 0;
            $saveDiscountedPriceByQtyTotal = 0;
            $saveDeliveryCost = 0;
            $currentDeliveryCost = 0;
            $currentDeliveryFreeMinimum = 0;
            $saveDeliveryFreeMinimum = 0;
            $grandDiscountedAmount = 0;
            $grandDeliveryCost = 0;
            $grandTotalOrderAmount = 0;
            $orderAmount = 0;
            $orderAmountWithoutDeliveryCost = 0;

            foreach($carts as $item) { //foreach=>a start looping
                $cartId = $item->cartId;
                $productId = $item->productId;
                $modelName = $item->modelName;
                $originPrice = $item->originPrice;
                $sellPrice = $item->sellPrice;
                $quantity = $item->quantity;
                $fileName = $item->searchImage;
                $firstOptionAmount = $item->firstOptionAmount;
                $secondOptionAmount = $item->secondOptionAmount;
                $owner = $item->owner;
                $deliveryCost = $item->deliveryCost;
                $deliveryFreeMinimum = $item->deliveryFreeMinimum;

                //product owner 별로 합계를 구한다
                if (($owner == $saveOwner)){
                    $originalPriceByOptions = $originPrice + $firstOptionAmount + $secondOptionAmount;
                    $originalPriceByQty = $originalPriceByOptions * $item->quantity;
                    $sellPriceByOptions = $sellPrice  + $firstOptionAmount + $secondOptionAmount;
                    $sellPriceByQty = $sellPriceByOptions * $item->quantity;
                    $discountedPriceByQty = $originalPriceByQty - $sellPriceByQty;
                    $originalPriceByQtyTotal = $originalPriceByQtyTotal + $originalPriceByQty;
                    $discountedPriceByQtyTotal = $discountedPriceByQtyTotal + $discountedPriceByQty;
                    if (($originalPriceByQtyTotal - $discountedPriceByQtyTotal) >= $deliveryFreeMinimum)
                    {
                        $currentDeliveryCost = 0;
                    }
                    else{
                        $currentDeliveryCost = $deliveryCost;
                        $currentDeliveryFreeMinimum = $deliveryFreeMinimum;
                    }
                    if ($index == ($numRows - 1)) //마지막 상품이면
                    {
                        $saveOriginalPriceByQtyTotal = $originalPriceByQtyTotal;
                        $saveDiscountedPriceByQtyTotal = $discountedPriceByQtyTotal;
                        $saveDeliveryCost = $currentDeliveryCost;
                        $saveDeliveryFreeMinimum = $currentDeliveryFreeMinimum;
                    }
                } //if (($owner == $saveOwner))
                else{
                    $saveOriginalPriceByQtyTotal = $originalPriceByQtyTotal;
                    $saveDiscountedPriceByQtyTotal = $discountedPriceByQtyTotal;
                    $saveDeliveryCost = $currentDeliveryCost;
                    $saveDeliveryFreeMinimum = $currentDeliveryFreeMinimum;
                    $originalPriceByQtyTotal = 0;
                    $discountedPriceByQtyTotal = 0;
                    $currentDeliveryCost = 0;
                    $currentDeliveryFreeMinimum = 0;
                    $originalPriceByOptions = $originPrice + $firstOptionAmount + $secondOptionAmount;
                    $originalPriceByQty = $originalPriceByOptions * $item->quantity;
                    $sellPriceByOptions = $sellPrice  + $firstOptionAmount + $secondOptionAmount;
                    $sellPriceByQty = $sellPriceByOptions * $item->quantity;
                    $discountedPriceByQty = $originalPriceByQty - $sellPriceByQty;
                    //$originalPriceByQty = $originPrice * $item->quantity;
                    $originalPriceByQtyTotal = $originalPriceByQtyTotal + $originalPriceByQty;
                    $discountedPriceByQtyTotal = $discountedPriceByQtyTotal + $discountedPriceByQty;
                    if (($originalPriceByQtyTotal - $discountedPriceByQtyTotal) >= $deliveryFreeMinimum)
                    {
                        $currentDeliveryCost = 0;
                    }
                    else{
                        $currentDeliveryCost = $deliveryCost;
                        $currentDeliveryFreeMinimum = $deliveryFreeMinimum;
                    }
                } //if else(($owner == $saveOwner))
            ?>

            <!--////동일한 productId는 맨 처음 row 에만 사진을 보여준다.-->
                <?php
                if ($saveProductId != $productId) //if ($saveProductId != $productId)
                {
                ?>
                    <!--//loop에 첫번째가 아니고 새로운 productId가 나오면 새로운 product를 보여주기 전에-->
                    <!--//전 product에 대한 총상품금액,할인금액,배송비 등을 보여준다-->
                    <!--//판매자가 동일하면 묶음 배송을 위해 productId가 달라도 맨 마지막에 합계를 보여준다-->
                    <?php
                    if (($index != 0) && ($saveOwner != $owner))
                    {
                        $orderAmount = $saveOriginalPriceByQtyTotal - $saveDiscountedPriceByQtyTotal + $saveDeliveryCost;
                        $orderAmountWithoutDeliveryCost = $saveOriginalPriceByQtyTotal - $saveDiscountedPriceByQtyTotal;
                        ////전체합계에 보여줄 내용
                        $originGrandTotal = $originGrandTotal + $saveOriginalPriceByQtyTotal;
                        $grandTotal = $grandTotal + $saveDiscountedPriceByQtyTotal;
                        $grandDiscountedAmount = $grandDiscountedAmount + $saveDiscountedPriceByQtyTotal;
                        if ($orderAmountWithoutDeliveryCost < $saveDeliveryFreeMinimum)
                        {
                            ////전체합계에 보여줄 내용
                            $grandDeliveryCost = $grandDeliveryCost + $saveDeliveryCost;
                        } //($orderAmountWithoutDeliveryCost < $saveDeliveryFreeMinimum)
                    } //(($index != 0) && ($saveOwner != $owner))
                    ?>
           
            <!--*************1-->
            <div class='col-sm-12 col-md-12 col-lg-12'
                style="background-color: rgba(128, 128, 128, 0.04); min-height: 80px;
                   margin-top: 0px; border-bottom: 1px solid rgba(128, 128, 128, 0.3);">
                <div class="row">
                    <!--image file name-->                    
                    <div class='col-sm-3 col-md-3 col-lg-3' style="padding-left: 0px;">
                        <a href="/product/detailsWithCdn/{{ $productId }}">
                            <?=$fileName?>
                        </a>
                    </div>
                    <?php
                    if ($item->optionCode == 1)
                    {
                    ?>
                    <!--모델 네임, 옵션1네임, 옵션1가감금액-->
                    <div class='col-sm-9 col-md-9 col-lg-9' style="padding-left: 0px; word-break: break-all;
                                                               text-align: left;">
                        <a href="/product/detailsWithCdn/{{ $productId }}">
                            <?=$modelName?>
                            <br />
                            <div style="float: left;">
                                <?=$item->firstDescription?>
                            </div>
                            <div style="float: left;">(</div>
                            <?php
                        if ($firstOptionAmount > 0 )
                        {
                            ?>
                            <div style="float: left;">+</div>
                            <?php
                        }
                            ?>
                            <div style="float: left;" class="first_option_amount_text">
                                <?=$firstOptionAmount?>
                            </div>
                            <div style="float: left;">원)</div>
                        </a>
                    </div>
                    <?php
                    }else //($item->optionCode == 1)
                     if ($item->optionCode == 2)
                    {
                    ?>
                    <!--모델네임,옵션1네임,옵션2네임,옵션2가감금액-->
                    <div class='col-sm-9 col-md-9 col-lg-9' style="padding-left: 0px; word-break: break-all;
                                                               text-align: left;">
                        <a href="/product/detailsWithCdn/{{ $productId }}">
                            <?=$modelName?>
                            <br />
                            <div style="display: inline;">
                                <?=$item->firstDescription?> + <?=$item->secondDescription?>
                            </div>
                            <div style="display: inline;">(</div>
                            <?php
                        if ($secondOptionAmount > 0 )
                        {
                            ?>
                            <div style="display: inline;">+</div>
                            <?php
                        }
                            ?>
                            <div style="display: inline;" class="second_option_amount_text">
                                <?=$secondOptionAmount?>
                            </div>
                            <div style="display: inline;">원)</div>
                        </a>
                    </div>
                    <?php
                    } //else if($item->optionCode == 2)
                    ?>                  
                </div>
                <div class="row">
                    <div class='col-sm-3 col-md-3 col-lg-3'>
                        <!---->
                    </div>
                    <!--original 금액-->
                    <div class='col-sm-4 col-md-4 col-lg-4' style="padding-left: 0px; padding-right: 0px; text-align: right;">
                        @if ($originalPriceByQty > $sellPriceByQty)
                        <span class="originPrice_txt" style="text-decoration: line-through;"><?=$originalPriceByQty?></span><span>원</span>                     
                        @else
                        <!--<span class="originPrice_txt"><?=$originalPriceByQty?></span><span>원</span>-->                                                                                                      
                        @endif                        
                    </div>
                    <div class='col-sm-5 col-md-5 col-lg-5'>
                        <!---->
                    </div>
                </div>
                <div class="row">
                    <div class='col-sm-4 col-md-4 col-lg-4'>
                        <!---->
                    </div>
                    <!--실제판매금액,갯수-->
                    <div class='col-sm-4 col-md-4 col-lg-4' style="padding-left: 0px; padding-right: 0px; text-align: right;">                       
                        <span class="sellPrice_txt" style="font-size: 18px;"><b><?=$sellPriceByQty?></b></span><span>원</span>                       
                        <span style="font-size: 15px;"> / </span>
                        <!--갯수-->
                        <span>
                            <b><?=$item->quantity?></b>개
                        </span>                                                                      
                    </div>                                    
                    <div class='col-sm-4 col-md-4 col-lg-4'>
                        <!---->
                    </div>
                </div>
            </div><!--*************1-->
                <?php ////
                } //if ($saveProductId != $productId)
                else //if else($saveProductId != $productId)
                {
                ?>
            <!--$$$$$$$$$$$$$$$$-->
            <div class='col-sm-12 col-md-12 col-lg-12'
                style="background-color: rgba(128, 128, 128, 0.04); min-height: 80px;
                   margin-top: 0px; border-bottom: 1px solid rgba(128, 128, 128, 0.3);">
                <div class="row">                   
                    <div class='col-sm-3 col-md-3 col-lg-3' style="padding-left: 0px;">
                        <!--image 있던 곳-->
                    </div>
                    <?php
                    if ($item->optionCode == 1)
                    {
                    ?>
                    <!--옵션1네임,옵션1가감금액-->
                    <div class='col-sm-9 col-md-9 col-lg-9' style="padding-left: 0px; word-break: break-all;
                                                               text-align: left;">
                        <a href="/product/detailsWithCdn/{{ $productId }}">
                            <!--상품명 있던 곳-->
                            <div style="float: left;">
                                <?=$item->firstDescription?>
                            </div>
                            <div style="float: left;">(</div>
                            <?php
                        if ($firstOptionAmount > 0 )
                        {
                            ?>
                            <div style="float: left;">+</div>
                            <?php
                        }
                            ?>
                            <div style="float: left;" class="first_option_amount_text">
                                <?=$firstOptionAmount?>
                            </div>
                            <div style="float: left;">원)</div>
                        </a>
                    </div>
                    <?php
                    }else if ($item->optionCode == 2) //if ($item->optionCode == 1)$$$$$$$
                    {
                    ?>
                    <!--옵션1네임,옵션2네임,옵션2가감금액-->
                    <div class='col-sm-9 col-md-9 col-lg-9' style="padding-left: 0px; word-break: break-all;
                                                               text-align: left;">
                        <a href="/product/detailsWithCdn/{{ $item->productId }}">
                            <!---->
                            <div style="display: inline;">
                                <?=$item->firstDescription?> + <?=$item->secondDescription?>
                            </div>
                            <div style="display: inline;">(</div>
                            <?php
                        if ($secondOptionAmount > 0 )
                        {
                            ?>
                            <div style="display: inline;">+</div>
                            <?php
                        }
                            ?>
                            <div style="display: inline;" class="second_option_amount_text">
                                <?=$secondOptionAmount?>
                            </div>
                            <div style="display: inline;">원)</div>
                        </a>
                    </div>
                    <?php
                    } //else if ($item->optionCode == 2)$$$$$$$
                    ?>                    
                </div>
                <div class="row">
                    <div class='col-sm-3 col-md-3 col-lg-3'>
                        <!---->
                    </div>
                    <!--original 금액-->
                    <div class='col-sm-4 col-md-4 col-lg-4' style="padding-left: 0px; padding-right: 0px; text-align: right;">
                        @if ($originalPriceByQty > $sellPriceByQty)
                        <span class="originPrice_txt" style="text-decoration: line-through;"><?=$originalPriceByQty?></span><span>원</span>                                                    
                        @else
                        <!--<span class="originPrice_txt"><?=$originalPriceByQty?></span><span>원</span>-->                                                   
                        @endif                        
                    </div>
                    <div class='col-sm-5 col-md-5 col-lg-5'>
                        <!---->
                    </div>
                </div>
                <div class="row">
                    <div class='col-sm-4 col-md-4 col-lg-4'>
                        <!---->
                    </div>
                    <!--실제 판매금액,갯수-->
                    <div class='col-sm-4 col-md-4 col-lg-4' style="padding-left: 0px; padding-right: 0px; text-align: right;">
                        <span class="sellPrice_txt" style="font-size: 18px;"><b><?=$sellPriceByQty?></b></span><span>원</span>                          
                        <span style="display: none;" class="sellPrice">
                            <?=$sellPriceByQty?>
                        </span>
                        <span style="font-size: 15px;"> / </span>
                        <!--갯수-->
                        <span><b><?=$item->quantity?></b>개</span>                                                   
                    </div>
                    <div class='col-sm-4 col-md-4 col-lg-4'>
                        <!---->
                    </div>
                </div>
            </div><!--$$$$$$$$$$$$$$$$-->
            <?php
                } //if ($saveProductId != $productId) else
            ?>

            <?php
                if ($index == ($numRows - 1)) //맨 마지막 product에 대한 총상품금액,할인금액,배송비 등을 보여준다
                {
                    $saveOriginalPriceByQtyTotal = $originalPriceByQtyTotal;
                    $saveDiscountedPriceByQtyTotal = $discountedPriceByQtyTotal;
                    $saveDeliveryCost = $currentDeliveryCost;
                    $saveDeliveryFreeMinimum = $currentDeliveryFreeMinimum;
                    $orderAmount = $saveOriginalPriceByQtyTotal - $saveDiscountedPriceByQtyTotal + $saveDeliveryCost;
                    $orderAmountWithoutDeliveryCost = $saveOriginalPriceByQtyTotal - $saveDiscountedPriceByQtyTotal;
                    ////전체합계에 보여줄 내용
                    $originGrandTotal = $originGrandTotal + $saveOriginalPriceByQtyTotal;
                    $grandTotal = $grandTotal + $saveDiscountedPriceByQtyTotal;
                    $grandDiscountedAmount = $grandDiscountedAmount + $saveDiscountedPriceByQtyTotal;
                    if ($orderAmountWithoutDeliveryCost < $saveDeliveryFreeMinimum)
                    {
                        ////전체합계에 보여줄 내용
                        $grandDeliveryCost = $grandDeliveryCost + $saveDeliveryCost;
                    } //($orderAmountWithoutDeliveryCost < $saveDeliveryFreeMinimum)
                } //($index == ($numRows - 1))
            ?>
                                                      
            <?php
                $index++;
                $saveProductId = $productId;
                $saveOwner = $owner;
            } //foreach=>a
            $grandTotalOrderAmount = $originGrandTotal - $grandDiscountedAmount + $grandDeliveryCost;
            ?>

        </div><!--주문상품 정보 오른쪽 위 box-->

        <!--총 판매건수-->
        <div style="width: 100%; height: 50px; background: rgba(128, 128, 128, 0.12); margin-top: 0px; border-bottom: 1px solid black; border-left: 1px solid black; border-right: 1px solid black;">
            <div class="text-center" style="font-size: 20px; padding-top: 8px;">
                총
                <span style="color: green;">
                    <?=$numRows?> 
                </span>
                건
            </div>
        </div>

        <!--최종결제 정보--><!--오른쪽 아래 box-->
        <div style="font-size: 20px; margin-top: 40px;">
            <b>최종결제 정보</b>
        </div>
        <div style="width: 100%; height: auto; font-size: 25px; border-top: 4px solid black; border-bottom: 4px solid black; border-left: 4px solid black; border-right: 4px solid black;">
            <div class="row">
                <div class="col-sm-6 col-md-6-col-lg-6 text-left">
                    -상품가격
                </div>
                <div class="col-sm-6 col-md-6-col-lg-6 text-right"><span class="originPriceGrandTotal_txt"><?=$originGrandTotal?></span><span style="font-size: 15px;">원</span>                                     
                </div>
            </div>
            <div class="row">
                <div class="col-sm-6 col-md-6-col-lg-6 text-left">
                    -할인가격
                </div>
                <div class="col-sm-6 col-md-6-col-lg-6 text-right"><span class="grandDiscountedAmount_txt"><?=$grandDiscountedAmount?></span><span style="font-size: 15px;">원</span>                                       
                </div>                
            </div>
            <div class="row">
                <div class="col-sm-6 col-md-6-col-lg-6 text-left">
                    -배송비
                </div>
                <div class="col-sm-6 col-md-6-col-lg-6 text-right"><span class="grandDeliveryCost_txt"><?=$grandDeliveryCost?></span><span style="font-size: 15px;">원</span>                   
                </div>
            </div>
            <hr />
            <div class="row">
                <div class="col-sm-6 col-md-6-col-lg-6 text-left">
                    -결제예정금액
                </div>
                <div class="col-sm-6 col-md-6-col-lg-6 text-right"><span class="grandTotalOrderAmount_txt" style="color: red; font-size: 30px;"><?=$grandTotalOrderAmount?></span><span style="font-size: 15px;">원</span> 
                    <span class="grandTotalOrderAmount_number" style="display: none;">{{ $grandTotalOrderAmount }}</span>                
                </div>
            </div>
            <div class="row">
                <a href="javascript:void();" id="checkOut">
                    <div class="col-sm-12 col-md-12-col-lg-12 text-center" style="margin-top: 20px; margin-bottom: 20px; margin-left: 48px; min-height: 80px; width: 80%; background: #0094ff; line-height: 80px; vertical-align: middle;">
                        <div style="font-size: 40px; color: white;" id="checkOutButton">결제 하기</div>
                    </div>
                </a>
                <!--stopped. 12/05/2019-->
                <!--<div style="padding-left: 25px;">
                    <div class="waitMessage blink_me" style="color: red; font-size: 20px;"></div>
                </div>-->
            </div>
        </div>

    </div>
</div><!--끝...화면을 크게 이등분 하였음.-->

<!--script-->
<script src="/myJs/orderPayment.js"></script>

@endsection
