<!--옵션선택 title-->
<div class="col-sm-12 col-md-12 col-lg-12" style="margin-left: -15px;">
    <b style="font-size: 18px;">옵션선택</b>
</div>

<!-------------------------------------------------------------------------------->
<!--아래는 option code가 1 일때 화면을 보여주고 옵션을 선택하는 코드이다. ------------>
<!-------------------------------------------------------------------------------->
<?php
if ($optionCode == 1)
{
?>
<!--optionCode를 숨긴다. productOptionControl.js에서 사용-->
<div style="display: none;" class="option_codeB">
    1
</div>
<!--옵션명1 내용--><!--select_option11-->
<div class="col-sm-12 col-md-12 col-lg-12 select_option11B" style="border: 1px solid rgba(128, 128, 128, 0.10); line-height: 50px; min-height: 50px; background-color: rgba(51, 51, 51, 0.00);">
    <div class="col-sm-10 col-md-10 col-lg-10">
        <a href="javascript:void(0)" return false;">
            <div class="option01_01_descriptionB" style="vertical-align: middle; line-height: 50px; font-size: 14px; margin-left: -15px; opacity: 1;">
                옵션명11
            </div>
        </a>
    </div>
    <div class="col-sm-2 col-md-2 col-lg-2">
        <div style="font-size: 14px; opacity: 0.4; text-align: right;">
            <!--select_option11-->
            <a href="javascript:void(0)" return false;" class="select_option11B">
                <i class="glyphicon glyphicon-chevron-down chevron_down_option11B select_option11B"></i><!--select_option11-->
                <i class="glyphicon glyphicon-chevron-up chevron_up_option11B select_option11B" style="display: none;"></i>
            </a>
        </div>
    </div>
</div>

<!--옵션1 상품리스트 보여줄 줄 자리. 처음에는 숨겨놓는다--><!--option_list11-->
<div class="row show_option11_listB" style="margin-left: 30px; margin-right: 0px;">
    <div class="col-sm-12 col-md-12 col-lg-12">
        <!--option_list11-->
        <div style="display: none; width: 106.8%;" class="option_list11B">
            <div class="row">
                <!---->
                <div style="background: white; border: 2px solid black; width: 94%; height: 200px; overflow-y: scroll; overflow-x: hidden;">
                    <div class="row">
                        <div class="col-sm-10 col-md-10 col-lg-10">
                            <!--db에서 온값-->
                            <?php
    foreach ($firstOptions as $item)
    {
                            ?>
                            <div class="productList_option11B">
                                <!--productList_option11-->
                                <a href="javascript:void(0)" return false;" class="click_optionB">
                                    <span class="option11_first_options_idB" style="display: none;">
                                        <?=$item->id?>
                                    </span>
                                    <span style="display: none;">
                                        <?=$item->product_id?>
                                    </span>
                                    <span class="option01_01_description_memberB">
                                        <?=$item->description?>
                                    </span>
                                    <span class="option11_amountB" style="display: none;">
                                        <?=$item->amount?>
                                    </span>
                                    <span>(</span>
                                    <?php
        if ($item->amount > 0 )
        {
                                    ?>
                                                        +
                                    <?php
        }
                                    ?>
                                    <span class="option11_amount_textB">
                                        <?=$item->amount?>
                                    </span>
                                    <span>원)</span>
                                    <span class="option11_stockB" style="display: none;">
                                        <?=$item->stock?>
                                    </span>
                                    <span> - 재고 : </span>
                                    <span class="option11_stock_textB">
                                        <?=$item->stock?>
                                    </span>
                                    <span>개</span>
                                </a>
                            </div>
                            <?php
    }
                            ?>
                        </div>
                        <div class="col-sm-2 col-md-2 col-lg-2"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!----------------------------------------------------------------------------------------->
<!--옵션 선택이 끝나면 선택된 품목을 리스트로 보여준다. jquery에서 실행--------------------->
<!----------------------------------------------------------------------------------------->
<div class="row" style="margin-left: 0px; margin-right: 0px;">
    <div class="col-sm-12 col-md-12 col-lg-12">
        <div style="width: 106.8%;">
            <div class="row">
                <div style="background: white; width: 94%;">
                    <div class="row">
                        <div class="col-sm-12 col-md-12 col-lg-12 attach_option_list11B"></div>
                    </div>
                </div>
            </div>
            <!--총상품금액-->
            <div class="row grand_real_sell_amount11B" style="display:none; margin-top: 15px;">
                <div style="background: white; width: 94%;">
                    <div class="row">
                        <div class="col-sm-12 col-md-12 col-lg-12"></div>
                        <div class="amount_option11B">
                            <div class="col-sm-1 col-md-1 col-lg-1"></div>
                            <div class="col-sm-4 col-md-4 col-lg-4">
                                <span style="font-size: 15px;">
                                    총상품금액
                                    <a href="javascript:void(0)" return false;">
                                        <i class="glyphicon glyphicon-question-sign"></i>
                                    </a>
                                </span>
                            </div>
                            <div class="col-sm-7 col-md-7 col-lg-7" style="text-align: right;">
                                <span id="totalAmount11_textB" style="font-size: 20px; color: black;"></span>
                                <span style="font-size: 17px;">원</span>
                                <span class="totalAmountNumber11B" style="display: none;"></span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-------------------------------------------------------------------------------->
<!--아래는 option code가 2 일때 화면을 보여주고 옵션을 선택하는 코드이다. ------------>
<!-------------------------------------------------------------------------------->
<?php
}elseif($optionCode == 2)
{
?>
<!--optionCode를 숨긴다. productOptionControl.js에서 사용-->
<div style="display: none;" class="option_codeB">
    2
</div>
<!--옵션2=>옵션명21 내용--><!--select_option21-->
<div class="col-sm-12 col-md-12 col-lg-12 select_option21B" style="border: 1px solid rgba(128, 128, 128, 0.10); line-height: 50px; min-height: 50px; background-color: rgba(51, 51, 51, 0.00);">
    <div class="col-sm-10 col-md-10 col-lg-10">
        <a href="javascript:void(0)" return false;">
            <div class="option02_01_descriptionB" style="vertical-align: middle; line-height: 50px; font-size: 14px; margin-left: -15px; opacity: 1;">
                옵션명21
            </div>
        </a>
    </div>
    <div class="col-sm-2 col-md-2 col-lg-2">
        <div style="font-size: 14px; opacity: 0.4; text-align: right;">
            <!--select_option21-->
            <a href="javascript:void(0)" return false;" class="select_option21B">
                <i class="glyphicon glyphicon-chevron-down chevron_down_option21B select_option21B"></i><!--select_option21-->
                <i class="glyphicon glyphicon-chevron-up chevron_up_option21B select_option21B" style="display: none;"></i>
            </a>
        </div>
    </div>
</div>

<!--옵션1 상품리스트 보여줄 줄 자리. 처음에는 숨겨놓는다--><!--option_list21-->
<div class="row show_option21_listB" style="margin-left: 30px; margin-right: 0px;">
    <div class="col-sm-12 col-md-12 col-lg-12">
        <!--option_list21-->
        <div style="display: none; width: 106.8%;" class="option_list21B">
            <div class="row">
                <!---->
                <div style="background: white; border: 2px solid black; width: 94%; height: 200px; overflow-y: scroll; overflow-x: hidden;">
                    <div class="row">
                        <div class="col-sm-10 col-md-10 col-lg-10">
                            <!--db에서 온값-->
                            <?php
    foreach ($firstOptions as $item)
    {
                            ?>
                            <div class="productList_option21B">
                                <!--productList_option21-->
                                <a href="javascript:void(0)" return false;" class="click_optionB">
                                    <span class="option21_first_options_idB" style="display: none;">
                                        <?=$item->id?>
                                    </span>
                                    <span style="display: none;">
                                        <?=$item->product_id?>
                                    </span>
                                    <span class="option02_01_description_memberB">
                                        <?=$item->description?>
                                    </span>
                                </a>
                            </div>
                            <?php
    }
                            ?>
                        </div>
                        <div class="col-sm-2 col-md-2 col-lg-2"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!--옵션2=>옵션명22 내용--><!--select_option22-->
<div class="col-sm-12 col-md-12 col-lg-12 select_option22B" style="border: 1px solid rgba(128, 128, 128, 0.10); line-height: 50px; min-height: 50px; background-color: rgba(51, 51, 51, 0.00);">
    <div class="col-sm-10 col-md-10 col-lg-10">
        <a href="javascript:void(0)">
            <div class="option02_02_descriptionB" style="vertical-align: middle; line-height: 50px; font-size: 14px; margin-left: -15px; opacity: 1;">
                옵션명22
            </div>
        </a>
    </div>
    <div class="col-sm-2 col-md-2 col-lg-2">
        <div style="font-size: 14px; opacity: 0.4; text-align: right;">
            <!--select_option22-->
            <a href="javascript:void(0)" class="select_option22B">
                <i class="glyphicon glyphicon-chevron-down chevron_down_option22B select_option22B"></i><!--select_option22-->
                <i class="glyphicon glyphicon-chevron-up chevron_up_option22B select_option22B" style="display: none;"></i>
            </a>
        </div>
    </div>
</div>

<!--옵션22 상품리스트 보여줄 줄 자리. 처음에는 숨겨놓는다--><!--option_list22-->
<div class="row show_option22_listB" style="margin-left: 30px; margin-right: 0px;">
    <div class="col-sm-12 col-md-12 col-lg-12">
        <!--option_list22-->
        <div style="display: none; width: 106.8%;" class="option_list22B">
            <div class="row">
                <!---->
                <div style="background: white; border: 2px solid black; width: 94%; height: 200px; overflow-y: scroll; overflow-x: hidden;">
                    <div class="row">
                        <div class="col-sm-10 col-md-10 col-lg-10">
                            <!--db에서 온값-->
                            <?php
    foreach ($secondOptions as $item)
    {
                            ?>
                            <div class="productList_option22B">
                                <!--productList_option22-->
                                <a href="javascript:void(0)" return false;" class="click_option22B">
                                    <span class="second_option_idB" style="display: none;">
                                        <?=$item->id?>
                                    </span>
                                    <span class="option22_first_options_idB" style="display: none;">
                                        <?=$item->first_option_id?>
                                    </span>
                                    <span class="option_product_idB" style="display: none;">
                                        <?=$item->product_id?>
                                    </span>
                                    <span class="option02_02_description_memberB">
                                        <?=$item->description?>
                                    </span>
                                    <span class="option22_amountB" style="display: none;">
                                        <?=$item->amount?>
                                    </span>
                                    <span>(</span>
                                    <?php
        if ($item->amount > 0 )
        {
                                    ?>
                                                        +
                                    <?php
        }
                                    ?>
                                    <span class="option22_amount_textB">
                                        <?=$item->amount?>
                                    </span>
                                    <span>원)</span>
                                    <span class="option22_stockB" style="display: none;">
                                        <?=$item->stock?>
                                    </span>
                                </a>
                            </div>
                            <?php
    }
                            ?>
                        </div>
                        <div class="col-sm-2 col-md-2 col-lg-2"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php
}
?>

<!----------------------------------------------------------------------------------------->
<!--옵션 선택이 끝나면 선택된 품목을 리스트로 보여준다. jquery에서 실행--------------------->
<!----------------------------------------------------------------------------------------->
<div class="row" style="margin-left: 0px; margin-right: 0px;">
    <div class="col-sm-12 col-md-12 col-lg-12">
        <div style="width: 106.8%;">
            <div class="row">
                <div style="background: white; width: 94%;">
                    <div class="row">
                        <div class="col-sm-12 col-md-12 col-lg-12 attach_option_list22B"></div>
                    </div>
                </div>
            </div>
            <!--총상품금액-->
            <div class="row grand_real_sell_amount22B" style="display:none; margin-top: 15px;">
                <div style="background: white; width: 94%;">
                    <div class="row">
                        <div class="col-sm-12 col-md-12 col-lg-12"></div>
                        <div class="amount_option22B">                            
                            <div class="col-sm-5 col-md-5 col-lg-5">
                                <span style="font-size: 15px;">
                                    총상품금액
                                    <a href="javascript:void(0)" return false;">
                                        <i class="glyphicon glyphicon-question-sign"></i>
                                    </a>
                                </span>
                            </div>
                            <div class="col-sm-7 col-md-7 col-lg-7" style="text-align: right;">
                                <span id="totalAmount22_textB" style="font-size: 20px; color: black;"></span>
                                <span style="font-size: 17px;">원</span>
                                <span class="totalAmountNumber22B" style="display: none;"></span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>