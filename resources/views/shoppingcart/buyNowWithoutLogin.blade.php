
<link href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.11.4/jquery-ui.css" rel="stylesheet" />

<style type="text/css">
    .big_checkbox {
        width: 15px;
        height: 15px;
    }
</style>

<!--test for loading spinner 26/04/2019-->
<style>
    .my_loader {
        position: fixed;
        left: 0;
        top: 0;
        width: 100%;
        height: 100%;
        z-index: 9999;
        background: url(/files/loader.gif) 50% 50% no-repeat #000;
        opacity: .2;
    }
</style>
<!--test for loading spinner 26/04/2019-->
<script>
        $(window).on(function () {
            $(".my_loader").fadeOut("slow");
        });

        ! function (a)
        {
              jQuery(window).bind("unload", function () { }), a(document).ready(function () {
                  a(".my_loader").hide(), a("form").on("submit", function () {
                      a("form").validate(), a("form").valid() ? (a(".my_loader").show(), a("form").valid() || a(".my_loader").hide()) : a(".my_loader").hide()
                  }), a('a:not([href^="#"])').on("click", function () {
                      "" != a(this).attr("href") && a(".my_loader").show(), a(this).is('[href*="Download"]') && a(".my_loader").hide()
                  }), a("a:not([href])").click(function () {
                      a(".my_loader").hide()
                  }), a('a[href*="javascript:void(0)"]').click(function () {
                      a(".my_loader").hide()
                  }), a(".export").click(function () {
                      setTimeout(function () {
                          a(".my_loader").fadeOut("fast")
                      }, 1e3)
                  })
              })
        }(jQuery);
</script>

<!--test for loading spinner 26/04/2019-->
<div class="my_loader"></div>

<!----------------------------start display section---------------------------------------->
<div class="display_section">
    <!--전체 스마일배송 당일배송-->
    <div class="row">
        <div class='col-sm-12 col-md-12 col-lg-12'>
            <div class='col-sm-1 col-md-1 col-lg-1'>
                <a href="javascript:void(0)">
                    <div style="font-size: 20px; float:left">
                        전체
                    </div>
                    <div class="cart_item_counter" style="color: blue; font-size: 15px; float: left; 
                    min-width: 20px; height: 20px; line-height: 20px; border-radius: 50%; 
                    background: rgba(0, 148, 255, 0.40);
                    text-align: center; margin-left: 2px; top: 3px; position: relative;">
                        <?=$numRows?>
                    </div>
                </a>
            </div>
            <div class='col-sm-2 col-md-2 col-lg-2'>
                <a href="javascript:void(0)">
                    <div style="font-size: 20px; float:left">
                        스마일배송
                    </div>
                    <div class="cart_item_counter" style="color: blue; font-size: 15px; float: left; 
                    min-width: 20px; height: 20px; line-height: 20px; border-radius: 50%; 
                    background: rgba(0, 148, 255, 0.40);
                    text-align: center; margin-left: 2px; top: 3px; position: relative;">
                        0
                    </div>
                </a>
            </div>
            <div class='col-sm-2 col-md-2 col-lg-2'>
                <a href="javascript:void(0)">
                    <div style="font-size: 20px; float:left">
                        당일배송
                    </div>
                    <div class="cart_item_counter" style="color: blue; font-size: 15px; float: left; 
                    min-width: 20px; height: 20px; line-height: 20px; border-radius: 50%; 
                    background: rgba(0, 148, 255, 0.40);
                    text-align: center; margin-left: 2px; top: 3px; position: relative;">
                        0
                    </div>
                </a>
            </div>
            <div class='col-sm-7 col-md-7 col-lg-7'>
                <!--///////-->
            </div>
        </div>
    </div>

    <!--간격을 준다-->
    <div class="row">
        <div class='col-sm-12 col-md-12 col-lg-12'>
            <div style="margin-top: 20px; margin-bottom: 10px; margin-right: 15px;">
                <!---->
            </div>
        </div>
    </div>

    <!--전체선택 선택삭제 상단부분-->
    <div class="row" style="margin-right: 30px;">
        <div class='col-sm-12 col-md-12 col-lg-12'
            style="height: 60px; line-height: 60px; margin-left: 15px;
            background-color: rgba(128, 128, 128, 0.1)">
            <div class='col-sm-1 col-md-1 col-lg-1' style="padding-left: 0px; padding-right: 0px;">
                <input type="checkbox" id="cbSelectAll" class="big_checkbox" />
                <a href="javascript:void(0)" class="cbSelectAll_text" style="font-size: 15px;">전체선택</a>
            </div>
            <div class='col-sm-1 col-md-1 col-lg-1'>
                <a href="javascript:void()" type="button" class="btn btn-sm btn-danger delete_selected" style="display: none;">
                    선택삭제
                </a>
            </div>
            <div class='col-sm-10 col-md-10 col-lg-10'></div>
        </div>
    </div>

    <!--간격을 준다-->
    <div class="row">
        <div class='col-sm-12 col-md-12 col-lg-12'>
            <div style="margin-top: 20px;">
                <!---->
            </div>
        </div>
    </div>

    <div class="row">
        <!--상품상세, 갯수조정,삭제,배송비 등을 보여준다-->
        <div class='col-sm-8 col-md-8 col-lg-8 checkableGrid'>
            <!--checkableGrid-->
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
            }
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
            }

            ////전체합계에 보여줄 내용(old version...)
            //$originSumPrice = $originPrice * $item->quantity;
            //$originGrandTotal = $originGrandTotal + $originSumPrice;
            //$sumPrice = $sellPrice * $item->quantity;
            //$grandTotal = $grandTotal + $sumPrice;
            //$discountRate = round((100 - (($sellPrice * $item->quantity) /
            //                        ($originPrice * $item->quantity) * 100)),2);
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
            ?>
            <?php
                    if ($orderAmountWithoutDeliveryCost < $saveDeliveryFreeMinimum)
                    {
                        ////전체합계에 보여줄 내용
                        $grandDeliveryCost = $grandDeliveryCost + $saveDeliveryCost;
            ?>
            <div class='col-sm-12 col-md-12 col-lg-12'
                style="background-color: rgba(128, 128, 128, 0.15); min-height: 40px; line-height: 40px; opacity: 0.5;">
                <div class='col-sm-6 col-md-6 col-lg-6'></div>

                <div class='col-sm-5 col-md-5 col-lg-5' style="text-align: right; margin-left: 15px;">
                    <span>배송비 : </span>
                    <span class="delivery_free_minimum_txt">
                        <?=$saveDeliveryFreeMinimum?>
                    </span>
                    <span>원 이상 구매시 무료</span>
                </div>
                <div class='col-sm-1 col-md-1 col-lg-1'></div>
            </div>
            <?php
                    }
            ?>
            <div class='col-sm-12 col-md-12 col-lg-12'
                style="background-color: rgba(128, 128, 128, 0.15); min-height: 20px;">
                <div class='col-sm-2 col-md-2 col-lg-2'>상품금액</div>
                <div class='col-sm-1 col-md-1 col-lg-1'>-</div>
                <div class='col-sm-2 col-md-2 col-lg-2'>할인금액</div>
                <div class='col-sm-1 col-md-1 col-lg-1'>+</div>
                <div class='col-sm-2 col-md-2 col-lg-2'>배송비</div>
                <div class='col-sm-1 col-md-1 col-lg-1'>=</div>
                <div class='col-sm-2 col-md-2 col-lg-2' style="text-align: right; margin-left: 15px;">
                    <span>주문금액</span>
                </div>
                <div class='col-sm-1 col-md-1 col-lg-1'></div>
            </div>
            <div class='col-sm-12 col-md-12 col-lg-12'
                style="background-color: rgba(128, 128, 128, 0.15); min-height: 20px; margin-bottom: 20px;">
                <div class='col-sm-3 col-md-3 col-lg-3'>
                    <span class="saveOriginalPriceByQtyTotal_text" style="font-size: 20px; text-align: right;">
                        <?=$saveOriginalPriceByQtyTotal?>
                    </span>
                    <span>원</span>
                </div>
                <div class='col-sm-3 col-md-3 col-lg-3'>
                    <span class="saveDiscountedPriceByQtyTotal_text" style="font-size: 20px; color: #00ff90;">
                        <?=$saveDiscountedPriceByQtyTotal?>
                    </span>
                    <span>원</span>
                </div>
                <div class='col-sm-2 col-md-2 col-lg-2'>
                    <span class="saveDeliveryCost_text" style="font-size: 20px;">
                        <?=$saveDeliveryCost?>
                    </span>
                    <span>원</span>
                </div>
                <div class='col-sm-1 col-md-1 col-lg-1'></div>
                <div class='col-sm-2 col-md-2 col-lg-2' style="text-align: right; margin-left: 15px; padding-left: 0px; padding-right: 0px;">
                    <span class="order_amount_text" style="font-size: 20px;">
                        <?=$orderAmount?>
                    </span>
                    <span>원</span>
                </div>
                <div class='col-sm-1 col-md-1 col-lg-1'></div>
            </div>
            <?php
                }
            ?>

            <!--*************1-->
            <div class='col-sm-12 col-md-12 col-lg-12'
                style="background-color: rgba(128, 128, 128, 0.04); min-height: 80px;
                margin-top: 0px; border-bottom: 1px solid rgba(128, 128, 128, 0.3);">
                <div class="row">
                    <div class='col-sm-1 col-md-1 col-lg-1 each_check_box'>
                        <input type="checkbox" name="cartIds" class="cartIds big_checkbox" value="<?=$cartId?>" />
                    </div>
                    <div class='col-sm-2 col-md-2 col-lg-2' style="padding-left: 0px;">
                        <a href="/product/detailsWithCdn/{{ $item->productId }}">
                            <?=$fileName?>
                        </a>
                    </div>
                    <?php
                if ($item->optionCode == 1)
                {
                    ?>
                    <div class='col-sm-3 col-md-3 col-lg-3' style="padding-left: 0px; word-break: break-all;
                                                            text-align: left;">
                        <a href="/product/detailsWithCdn/{{ $item->productId }}">
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
                }else if ($item->optionCode == 2)
                {
                    ?>
                    <div class='col-sm-3 col-md-3 col-lg-3' style="padding-left: 0px; word-break: break-all;
                                                            text-align: left;">
                        <a href="/product/detailsWithCdn/{{ $item->productId }}">
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
                }
                    ?>
                    <div class='col-sm-1 col-md-1 col-lg-1' style="padding-left: 0px; padding-right: 0px;">
                        <!-------------spinner-------------->
                        <a href="javascript:void()" class="spinner">
                            <input class="orderQty" name="orderQty" value="<?=$item->quantity?>" readonly style="width: 17px;" />개
                        </a>
                        <span style="display: none;" class="originPrice">
                            <?=$originPrice * $item->quantity?>
                        </span>
                    </div>
                    <div class='col-sm-2 col-md-2 col-lg-2'>
                        <a href="javascript:void(0)">
                            <div style="border: 1px solid rgba(128, 128, 128, 0.1); min-height: 30px; 
                            line-height: 30px; vertical-align: middle; float: left;
                            padding-left: 0px; padding-right: 0px;">
                                쿠폰적용
                            </div>
                            <div style="border: 1px solid #00ff21; float: left; min-height: 30px;
                            width: 10px; background-color: #00ff21;"></div>
                        </a>
                    </div><!--판매금액-->
                    <div class='col-sm-2 col-md-2 col-lg-2' style="padding-left: 0px; padding-right: 0px; text-align: right;">
                        <span style="display: none;" class="sellPrice">
                            <?=$sellPriceByQty?>
                        </span>
                        <span class="sellPrice_txt" style="font-size: 20px;">
                            <?=$sellPriceByQty?>
                        </span>
                        <span>원</span>
                        <!--ProcductId, cartId를 Ajax에서 사용하기위하여 save해 놓는다...-->
                        <span style="display: none;" class="productIdxx">
                            <?=$item->productId?>
                        </span>
                        <span style="display: none;" class="cartIdxx">
                            <?=$cartId?>
                        </span>
                    </div>
                    <!--X 마크-->
                    <div class='col-sm-1 col-md-1 col-lg-1' style="text-align: right;">
                        <a href="javascript:void()">
                            <div class="each_delete" style="font-size: 20px;">
                                x
                            </div>
                        </a>
                    </div>
                </div>
            </div><!--*************1-->
            <?php ////
            } //if ($saveProductId != $productId)
            else //if ($saveProductId != $productId) else
            {
            ?>
            <!--$$$$$$$$$$$$$$$$-->
            <div class='col-sm-12 col-md-12 col-lg-12'
                style="background-color: rgba(128, 128, 128, 0.04); min-height: 80px;
                margin-top: 0px; border-bottom: 1px solid rgba(128, 128, 128, 0.3);">
                <div class="row">
                    <div class='col-sm-1 col-md-1 col-lg-1 each_check_box'>
                        <input type="checkbox" name="cartIds" class="cartIds big_checkbox" value="<?=$cartId?>" />
                    </div>
                    <div class='col-sm-2 col-md-2 col-lg-2' style="padding-left: 0px;">
                        <!--image 있던 곳-->
                    </div>
                    <?php
                if ($item->optionCode == 1)
                {
                    ?>
                    <div class='col-sm-3 col-md-3 col-lg-3' style="padding-left: 0px; word-break: break-all;
                                                            text-align: left;">
                        <a href="/product/detailsWithCdn/{{ $item->productId }}">
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
                }else if ($item->optionCode == 2)
                {
                    ?>
                    <div class='col-sm-3 col-md-3 col-lg-3' style="padding-left: 0px; word-break: break-all;
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
                }
                    ?>
                    <div class='col-sm-1 col-md-1 col-lg-1' style="padding-left: 0px; padding-right: 0px;">
                        <!-------------spinner-------------->
                        <a href="javascript:void()" class="spinner">
                            <input class="orderQty" name="orderQty" value="<?=$item->quantity?>" readonly style="width: 17px;" />개
                        </a>
                        <span style="display: none;" class="originPrice">
                            <?=$originPrice * $item->quantity?>
                        </span>
                    </div>
                    <div class='col-sm-2 col-md-2 col-lg-2'>
                        <a href="javascript:void(0)">
                            <div style="border: 1px solid rgba(128, 128, 128, 0.1); min-height: 30px; 
                            line-height: 30px; vertical-align: middle; float: left;
                            padding-left: 0px; padding-right: 0px;">
                                쿠폰적용
                            </div>
                            <div style="border: 1px solid #00ff21; float: left; min-height: 30px;
                            width: 10px; background-color: #00ff21;"></div>
                        </a>
                    </div><!--판매금액-->
                    <div class='col-sm-2 col-md-2 col-lg-2' style="padding-left: 0px; padding-right: 0px; text-align: right;">
                        <span style="display: none;" class="sellPrice">
                            <?=$sellPriceByQty?>
                        </span>
                        <span class="sellPrice_txt" style="font-size: 20px;">
                            <?=$sellPriceByQty?>
                        </span>
                        <span>원</span>
                        <!--ProcductId, cartId를 Ajax에서 사용하기위하여 save해 놓는다...-->
                        <span style="display: none;" class="productIdxx">
                            <?=$item->productId?>
                        </span>
                        <span style="display: none;" class="cartIdxx">
                            <?=$cartId?>
                        </span>
                    </div>
                    <!--X 마크-->
                    <div class='col-sm-1 col-md-1 col-lg-1' style="text-align: right;">
                        <a href="javascript:void()">
                            <div class="each_delete" style="font-size: 20px;">
                                x
                            </div>
                        </a>
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
            ?>
            <?php
                if ($orderAmountWithoutDeliveryCost < $saveDeliveryFreeMinimum)
                {
                    ////전체합계에 보여줄 내용
                    $grandDeliveryCost = $grandDeliveryCost + $saveDeliveryCost;
            ?>
            <div class='col-sm-12 col-md-12 col-lg-12'
                style="background-color: rgba(128, 128, 128, 0.15); min-height: 40px; line-height: 40px; opacity: 0.5;">
                <div class='col-sm-6 col-md-6 col-lg-6'></div>

                <div class='col-sm-5 col-md-5 col-lg-5' style="text-align: right; margin-left: 15px;">
                    <span>배송비 : </span>
                    <span class="delivery_free_minimum_txt">
                        <?=$saveDeliveryFreeMinimum?>
                    </span>
                    <span>원 이상 구매시 무료</span>
                </div>
                <div class='col-sm-1 col-md-1 col-lg-1'></div>
            </div>
            <?php
                }
            ?>
            <div class='col-sm-12 col-md-12 col-lg-12'
                style="background-color: rgba(128, 128, 128, 0.15); min-height: 20px;">
                <div class='col-sm-2 col-md-2 col-lg-2'>상품금액</div>
                <div class='col-sm-1 col-md-1 col-lg-1'>-</div>
                <div class='col-sm-2 col-md-2 col-lg-2'>할인금액</div>
                <div class='col-sm-1 col-md-1 col-lg-1'>+</div>
                <div class='col-sm-2 col-md-2 col-lg-2'>배송비</div>
                <div class='col-sm-1 col-md-1 col-lg-1'>=</div>
                <div class='col-sm-2 col-md-2 col-lg-2' style="text-align: right; margin-left: 15px;">
                    <span>주문금액</span>
                </div>
                <div class='col-sm-1 col-md-1 col-lg-1'></div>
            </div>
            <div class='col-sm-12 col-md-12 col-lg-12'
                style="background-color: rgba(128, 128, 128, 0.15); min-height: 20px; margin-bottom: 20px;">
                <div class='col-sm-3 col-md-3 col-lg-3'>
                    <span class="saveOriginalPriceByQtyTotal_text" style="font-size: 20px; text-align: right;">
                        <?=$saveOriginalPriceByQtyTotal?>
                    </span>
                    <span>원</span>
                </div>
                <div class='col-sm-3 col-md-3 col-lg-3'>
                    <span class="saveDiscountedPriceByQtyTotal_text" style="font-size: 20px; color: #00ff90;">
                        <?=$saveDiscountedPriceByQtyTotal?>
                    </span>
                    <span>원</span>
                </div>
                <div class='col-sm-2 col-md-2 col-lg-2'>
                    <span class="saveDeliveryCost_text" style="font-size: 20px;">
                        <?=$saveDeliveryCost?>
                    </span>
                    <span>원</span>
                </div>
                <div class='col-sm-1 col-md-1 col-lg-1'></div>
                <div class='col-sm-2 col-md-2 col-lg-2' style="text-align: right; margin-left: 15px; padding-left: 0px; padding-right: 0px;">
                    <span class="order_amount_text" style="font-size: 20px;">
                        <?=$orderAmount?>
                    </span>
                    <span>원</span>
                </div>
                <div class='col-sm-1 col-md-1 col-lg-1'></div>
            </div>
            <?php
            }
            ?>
            <?php
            $index++;
            $saveProductId = $productId;
            $saveOwner = $owner;
        } //foreach=>a
            ?>
        </div><!--checkableGrid-->

        <!--전체합계-->
        <div class='col-sm-4 col-md-4 col-lg-4 section_of_total' style="position: sticky; top: 50px;">
            <div style="border-top: solid 2px #0026ff; border-bottom: solid 2px #0026ff;
                border-left: solid 2px #0026ff; border-right: solid 2px #0026ff;
                margin-right: 15px;">
                <div class="text-center" style="background: #0026ff; color: white; font-size: 25px;">
                    <span>전체합계</span>
                </div>
                <div class="row" style="font-size: 15px; margin-top: 10px; margin-right: 0px;">
                    <div class="col-sm-6 col-md-6 col-lg-6">
                        <b>&nbsp;&nbsp;상품수</b>
                    </div>
                    <div class="col-sm-6 col-md-6 col-lg-6" style="text-align: right;">
                        <?=$numRows?>
                        <span>개</span>
                    </div>
                </div>
                <hr style="margin: 10px;" />
                <div class="row" style="font-size: 15px; margin-top: 10px; margin-right: 0px;">
                    <div class="col-sm-6 col-md-6 col-lg-6">
                        <b>&nbsp;&nbsp;상품금액</b>
                    </div>
                    <div class="col-sm-6 col-md-6 col-lg-6 originGrandTotal_Text" style="text-align: right;">
                        <?=$originGrandTotal?>
                        <span>원</span>
                    </div>
                    <!--Ajax에서 사용하기위해 숨긴다...-->
                    <div style="display: none;" class="originGrandTotal_number">
                        <?=$originGrandTotal?>
                    </div>
                </div>
                <hr style="margin: 10px;" />
                <div class="row" style="font-size: 15px; margin-top: 10px; margin-right: 0px;">
                    <div class="col-sm-6 col-md-6 col-lg-6">
                        <b>&nbsp;&nbsp;할인금액</b>
                    </div>
                    <div class="col-sm-6 col-md-6 col-lg-6" style="text-align: right; color: #00ff90;">
                        <span>-</span>
                        <!--<span class="grandTotal_Text"><?=$grandTotal?></span>-->
                        <span class="grandDiscountedAmoun_text">
                            <?=$grandDiscountedAmount?>
                        </span>
                        <span>원</span>
                        <span class="grandDiscountedAmoun_number" style="display: none;">
                            <?=$grandDiscountedAmount?>
                        </span>
                    </div>
                </div>
                <hr style="margin: 10px;" />
                <div class="row" style="font-size: 15px; margin-top: 10px; margin-right: 0px;">
                    <div class="col-sm-6 col-md-6 col-lg-6">
                        <b>&nbsp;&nbsp;배송비</b>
                    </div>
                    <div class="col-sm-6 col-md-6 col-lg-6" style="text-align: right;">
                        <span class="grandDeliveryCost_text">
                            <?=$grandDeliveryCost?>
                        </span>
                        <span>원</span>
                    </div>
                </div>
                <?php
            $grandTotalOrderAmount = $originGrandTotal - $grandDiscountedAmount + $grandDeliveryCost;
                ?>
                <hr style="margin: 10px;" />
                <div class="row" style="margin-top: 10px; margin-right: 0px; min-height: 40px; line-height: 40px;">
                    <div class="col-sm-5 col-md-5 col-lg-5" style="font-size: 17px;">
                        <b>&nbsp;&nbsp;전체주문금액</b>
                    </div>
                    <div class="col-sm-7 col-md-7 col-lg-7" style="color: black; font-size: 23px; text-align: right;">
                        <span class="grandTotalOrderAmount_text">
                            <?=$grandTotalOrderAmount?>
                        </span>
                        <span>원</span>
                    </div>
                </div>
                <!--주문 결제-->
                <div class="row">
                    <div class="col-sm-12 col-md-12 col-lg-12">
                        <a href="javascript:void()" style="font-size: 35px;" class="order_and_pay">
                            <div style="text-align: center;color: white;
                                border: 1px solid rgba(0, 148, 255, 0.80); 
                                background-color: rgba(0, 148, 255, 0.80);
                                margin-top: 30px; min-height: 80px; line-height: 80px;">
                                주문하기
                            </div>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!--전체선택 선택삭제 하단부분-->
    <div class="row" style="margin-right: 30px; margin-bottom: 50px;">
        <div class='col-sm-12 col-md-12 col-lg-12'
            style="height: 60px; line-height: 60px; margin-left: 15px;
            background-color: rgba(128, 128, 128, 0.1)">
            <div class='col-sm-1 col-md-1 col-lg-1' style="padding-left: 0px; padding-right: 0px;">
                <input type="checkbox" id="cbSelectAll2" class="big_checkbox" />
                <a href="javascript:void(0)" class="cbSelectAll_text" style="font-size: 15px;">전체선택</a>
            </div>
            <div class='col-sm-1 col-md-1 col-lg-1'>
                <a href="javascript:void()" type="button" class="btn btn-sm btn-danger delete_selected" style="display: none;">
                    선택삭제
                </a>
            </div>
            <div class='col-sm-10 col-md-10 col-lg-10'></div>
        </div>
    </div>

    <div class="page_footer">
        {!! $carts->render() !!}
    </div>
</div><!-----------------------end of display section----------------------------------------->

<script
    src="https://code.jquery.com/jquery-2.2.4.min.js"
    integrity="sha256-BbhdlvQf/xTY9gja0Dq3HiwQF8LaCRTXxZKRutelT44="
    crossorigin="anonymous"></script>
<!--<script src="/lib/jquery-ui-1.11.4.custom/jquery-ui.min.js"></script>-->
<script
    src="https://code.jquery.com/ui/1.11.4/jquery-ui.min.js"
    integrity="sha256-xNjb53/rY+WmG+4L6tTl9m6PpqknWZvRt0rO1SRnJzw="
    crossorigin="anonymous"></script>

<script src="/myJs/cartListWithCdn.js"></script>
