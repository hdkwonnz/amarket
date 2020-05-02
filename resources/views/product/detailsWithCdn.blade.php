@extends('layouts.app')

@section('title')
Product-details
@endsection

@section('content')

<link href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.11.4/jquery-ui.css" rel="stylesheet" />

<!--메인메뉴 밑에 가로로 나열된 메뉴에 대한 style-->
<style>                
    .menu_map_box {
        margin-left: -45px;
    }
    .menu_map_child1, .menu_map_child2, .menu_map_child3 {
        background-color: white; /*width: 100px;*/
        width: auto;
        padding: 5px;
        display: none;
        z-index: 5;
        position: absolute;
    }
</style>

<!--상품정보, 상품분석평, 배송반품등에 대한 스타일 -->
<style>
    /*아래는 stopped.23/05/2019*/
    /*.fixed_top {
        position: fixed;
        top: 10px;
        width: 60.7%;
      }
    }*/    
    .blue_white {
        background: blue;
        color: white;       
    }
</style>

<?php
$productId = $product->productId;
$categoryAId = $product->categorya_id;
$categoryBId = $product->categoryb_id;
$categoryCId = $product->categoryc_id;
$categoryDId = $product->categoryd_id;
$modelName = $product->modelName;
$originPrice = $product->originPrice;
$sellPrice = $product->sellPrice;
$categoryBname = $product->bname;
$categoryCname = $product->cname;
$categoryDname = $product->dname;
$differPrice = $originPrice - $sellPrice;
$discountRate = round((100 - ($sellPrice / $originPrice * 100)), 2);
$productImage = $product->productImage; ////
$description = $product->description; ////
$deliveryNotice = $product->deliveryNotice; ////
$deliveryCode = $product->deliveryCode; ////
//$deliveryDescription = $product->deliveryDescription; ////removed 20/04/2019
$deliveryCost = $product->deliveryCost; ////
$deliveryFreeMinimum = $product->deliveryFreeMinimum; ////
$countryOfProduct = $product->countryOfProduct; ////
$overseasDelivery = $product->overseasDelivery; ////
$optionCode = $product->optionCode; ////
$fileName = $product->searchImage; ////
$certifyCode = $product->certifyCode;
?>

<!--productId 값을 얻기위해 데이터를 숨긴다(Ajax에서 사용)...-->
<div style="display: none; " class="hidden_productId">
    <?=$productId?>
</div>
<!--fileName 값을 얻기위해 데이터를 숨긴다(Ajax에서 사용)...-->
<div style="display: none; " class="hidden_fileName">
    <?=$fileName?>
</div>
<!--categoryAId 값을 얻기위해 데이터를 숨긴다(Ajax에서 사용)...-->
<div style="display: none; " class="hidden_categoryAId">
    <?=$categoryAId?>
</div>
<!--categoryBId 값을 얻기위해 데이터를 숨긴다(Ajax에서 사용)...-->
<div style="display: none; " class="hidden_categoryBId">
    <?=$categoryBId?>
</div>

<!--현재 상품이 속해있는 카테고리를 보여주고 카테고리의 형제들을 보여준다-->
<!--현재 상품의 부모 카테고리를 보여준다. 클릭하면 해당 페니이지로 이동 -->
<div class="row menu_map_box">
    <div class="col-sm-12 col-md-12 col-lg-12">
        <div class="col-sm-10 col-md-10 col-lg-10">
            <div class="col-sm-1 col-md-1 col-lg-1">
                <div class="{{ Request::is('/') ? " active" : "" }}">
                    <a href="/">Home</a>&nbsp;&nbsp;&nbsp;>
                </div>
            </div>
            <div class="col-sm-9 col-md-9 col-lg-9">
                <div class="row">
                    <div class="menu_map_parent1" style="float: left;">
                        <a href="/product/categoryBmenu/<?=$categoryAId?>/<?=$categoryBId?>/<?=$categoryBname?>">
                            <?=$categoryBname?>
                        </a>&nbsp;&nbsp;>&nbsp;&nbsp;
                        <div class="menu_map_child1 text-center">
                            @foreach ($resultB as $item)
                            <div>
                                <a href="/product/categoryBmenu/<?=$item->categorya_id?>/<?=$item->id?>/<?=$item->name?>" class="hoverBlue">
                                    <?=$item->name?>
                                </a>
                            </div>
                            @endforeach
                        </div>
                    </div>
                    <div class="menu_map_parent2" style="float: left;">
                        <a href="/product/categoryCmenu/<?=$categoryAId?>/<?=$categoryBId?>/ <?=$categoryCId?>/<?=$categoryBname?>/<?=$categoryCname?>">
                            <?=$categoryCname?>
                        </a>&nbsp;&nbsp;>&nbsp;&nbsp;
                        <div class="menu_map_child2 text-center">
                            @foreach ($resultC as $item)
                            <div>
                                <?php
                                //$nameB = $item->categoryb->name;////////////////////////////////
                                $nameB = $item->bname;
                                ?>                                                                                <!--$item->id-->            <!--$item->name-->
                                <a href="/product/categoryCmenu/<?=$item->categorya_id?>/<?=$item->categoryb_id?>/ <?=$item->cid?>/<?=$nameB?>/<?=$item->cname?>" class="hoverBlue">
                                    <?=$item->cname?><!----$item->name ----->
                                </a>
                            </div>
                            @endforeach
                        </div>
                    </div>
                    <div class="menu_map_parent3" style="float: left;">
                        <a href="/product/categoryDmenu/<?=$categoryAId?>/<?=$categoryBId?>/<?=$categoryCId?>/<?=$categoryDId?>/<?=$categoryBname?>/<?=$categoryCname?>/<?=$categoryDname?>">
                            <b>
                                <?=$categoryDname?>
                            </b>
                        </a>
                        <div class="menu_map_child3 text-center">
                            @foreach ($resultD as $item)
                            <div>
                                <?php
                                //$nameB = $item->categoryb->name;////////////////////////////////
                                //$nameC = $item->categoryc->name;////////////////////////////////
                                $nameB = $item->bname;
                                $nameC = $item->cname;
                                ?>                                                                                                        <!--$item->id-->                         <!--$item->name-->        
                                <a href="/product/categoryDmenu/<?=$item->categorya_id?>/<?=$item->categoryb_id?>/<?=$item->categoryc_id?>/<?=$item->did?>/<?=$nameB?>/<?=$nameC?>/<?=$item->dname?>" class="hoverBlue">
                                    <?=$item->dname?><!--$item->name-->
                                </a>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-2 col-md-2 col-lg-2"></div>
    </div>
</div><!--메뉴바 바로밑에 가로로 정렬되어 있는 카테고리 보여주기-->

<!--상품 화면 시작-->
<div class="row" style="margin-right: 0px;">
    <div class="col-sm-12 col-md-12 col-lg-12">
        <!--상품 이름 과 상품번호 보여주기 상단의 긴 박스-->
        <div class="col-sm-12 col-md-12 col-lg-12" style="height: 100%; background-color: rgba(128, 128, 128, 0.09); border-top: 1px solid rgba(128, 128, 128, 0.16); border-bottom: 1px solid rgba(128, 128, 128, 0.16);">                       
                    <div class="col-sm-9 col-md-9 col-lg-9" style="">
                        <div style="word-break: break-all; height: 100%; line-height: 60px; vertical-align: middle; font-size: 20px;">
                            <b><?=$modelName?></b>
                        </div>
                    </div>
                    <div class="col-sm-3 col-md-3 col-lg-3" style="height: 100%; vertical-align: middle; line-height: 28px; display: inline-block;">
                        <div class="text-center" style="width: 100%; height: 98%; background-color: white; border: 1px thick gray;">
                            <span>
                                상품번호:<?=$productId?><br />
                            </span>
                            <span>추후에무언가보여여질예정</span>
                        </div>
                    </div>                         
        </div>

        <!--왼쪽: 상품 이미지, 오른쪽: 판매금액 과 디스카운트-->
        <div class="col-sm-12 col-md-12 col-lg-12 contentHeight" style="padding: 0px;">
            <div class="row">
                <!--상품 이미지 : 좌측-->
                <!--carousel에 들어올 data는 database에 html tag로 저장 되어 있다.18/04/2019-->
                <div class="col-sm-6 col-md-6 col-lg-6" style="padding-left: 0px;">
                    <div class="col-sm-12 col-md-12 col-lg-12"
                        style="width: 100%; height: 100%; margin-top: 10px; 
                                padding-right: 0px; margin-left: 0px;">
                        <div id="my-carousel" class="carousel slide" data-ride="carousel" data-interval="0">
                            <ol class="carousel-indicators"><!--위 data-interval="0" => NO 자동슬라이딩-->
                                <li data-target="#my-carousel" data-slide-to="0" class="active"></li>
                                <li data-target="#my-carousel" data-slide-to="1"></li>
                                <li data-target="#my-carousel" data-slide-to="2"></li>
                            </ol>
                            <div class="carousel-inner">

                                <?= $productImage ?>

                                <!--아래 코드 지우지 말 것.==>template 임. 16/04/2019-->
                                <!--<div class="item top_images active">
                                    <a href="#">
                                        <img src="http://hdkwonnzlaravel.cdn3.cafe24.com/291_14d.JPG" class="img-responsive" />                                      
                                    </a>
                                    <div class="carousel-caption">
                                        <h2></h2>
                                    </div>
                                </div>                               
                                <div class="item top_images">
                                    <a href="#">
                                        <img src="http://hdkwonnzlaravel.cdn3.cafe24.com/291_14d.JPG" class="img-responsive" />                                      
                                    </a>
                                    <div class="carousel-caption">
                                        <h2></h2>
                                    </div>
                                </div>
                                <div class="item top_images">
                                    <a href="#">
                                        <img src="http://hdkwonnzlaravel.cdn3.cafe24.com/291_14d.JPG" class="img-responsive" />
                                    </a>
                                    <div class="carousel-caption">
                                        <h2></h2>
                                    </div>
                                </div>-->
                                <!--위 코드 지우지 말 것.==>template 임. 16/04/2019-->

                            </div>
                            <a class="left carousel-control" href="#my-carousel" data-slide="prev">
                                <!--밑에 div tag가 원래는 span이었는데 바꾸었음(클릭시 "_"가 나오지 않도록)-->
                                <div class="glyphicon glyphicon-chevron-left"></div>
                            </a>
                            <a class="right carousel-control" href="#my-carousel" data-slide="next">
                                <!--밑에 div tag가 원래는 span이었는데 바꾸었음(클릭시 "_"가 나오지 않도록)-->
                                <div class="glyphicon glyphicon-chevron-right"></div>
                            </a>
                        </div>
                    </div>

                    <!--썸네일.18/04/2019-->
                    <!--productDetailsTopImageCarousel.js에서 data가 들어온다.-->
                    <div class="col-sm-12 col-md-12 col-lg-12"
                        style="width: 100%; height: 100%; margin-top: 10px; 
                                padding-right: 0px; margin-left: 0px;">
                        <div class="col-sm-3 col-md-3 col-lg-3 top_images_thum"
                            style="width: 80px; height: 80px; margin-top: 10px; 
                                    padding-right: 0px; margin-left: 0px;">
                            <!--썸네일 들어 올 자리-->    
                        </div>
                        <div class="col-sm-3 col-md-3 col-lg-3 top_images_thum"
                            style="width: 80px; height: 80px; margin-top: 10px; 
                                    padding-right: 0px; margin-left: 0px;">
                            <!--썸네일 들어 올 자리-->
                        </div>
                        <div class="col-sm-3 col-md-3 col-lg-3 top_images_thum"
                            style="width: 80px; height: 80px; margin-top: 10px; 
                                    padding-right: 0px; margin-left: 0px;">
                            <!--썸네일 들어 올 자리-->
                        </div>
                    </div>

                </div><!--상품 이미지 : 좌측-->               
                
                <!--판매금액 과 디스카운트, 배송등... : 우측-->
                <div class="col-sm-6 col-md-6 col-lg-6" style="padding-left: 0px;">
                    <!--판매금액-->
                    <div class="col-sm-12 col-md-12 col-lg-12" style="background-color: rgba(128, 128, 128, 0.09); border: 1px solid rgba(128, 128, 128, 0.16); margin-top: 10px; min-height: 60px;">
                        <div class="row" style="margin-left: 0px;">
                            <div class="col-sm-4 col-md-4 col-lg-4" style="height: 100%; line-height: 60px; vertical-align: middle;">
                                <?php //할인된 상태이면 할인율 표시 19/04/2019
                                if ($differPrice > 0)
                                {
                                ?>
                                <span style="color: blue; font-size: 40px; vertical-align: middle;">
                                    <?=$discountRate?> %
                                </span>
                                <?php
                                }
                                ?>
                            </div>

                            <div class="col-sm-7 col-md-7 col-lg-7">
                                <?php //할인된 상태이면 원래가격 표시 19/04/2019
                                if ($differPrice > 0)
                                {
                                ?>
                                <span style="text-decoration: line-through; font-size: 18px;" class="originPrice">
                                    <?=$originPrice?>원
                                </span>                              
                                <br />
                                <span style="font-size: 30px;  font-weight: 700;" class="sellPrice">
                                    <b>
                                        <?=$sellPrice?>
                                    </b>원
                                </span>                               
                                <?php
                                }else{ //할인된 상태가 아니면 판매가격 표시 19/04/2019
                                ?>                               
                                <span style="font-size: 40px;  font-weight: 700;" class="sellPrice">
                                    <b>
                                        <?=$sellPrice?>
                                    </b>원
                                </span>                               
                                <?php
                                }
                                ?>
                                <!--원래가격,판매가격을 나중에 ajax에서 사용하기위해 save한다-->
                                <span style="display: none;" class="originPriceAjax">
                                    <?=$originPrice?>
                                </span>
                                <span style="display: none;" class="sellPriceAjax">
                                    <?=$sellPrice?>
                                </span>                                                                                                                              
                            </div>
                            <div class="col-sm-1 col-md-1 col-lg-1">                                                             
                            </div>
                        </div>
                    </div>
                  
                   <!--배송안내 배송방법-->
                    <div class="col-sm-12 col-md-12 col-lg-12" style="margin-top: 10px;">
                        <div style="margin-left: -15px; margin-right: -15px;">                            
                            <div style="border: 1px solid rgba(128, 128, 128, 0.16); padding-left: 15px;">
                                <!--배송 안내-->
                                <div style="vertical-align: middle; line-height: 30px; font-size: 18px;">
                                    <img src="http://hdkwonnzlaravel.cdn3.cafe24.com/icon/delivery_truck.JPG" class="img-responsive" style="display: inline;" />
                                    <div style="display: inline; font-size: 15px;">
                                        <?= $deliveryNotice ?>
                                    </div>
                                    <div class="delivery_notice_block" style="display: inline; font-size: 18px;">
                                        <a href="javascript:void(0) return false;">
                                            <i class="glyphicon glyphicon-question-sign"></i>
                                        </a>
                                        <div class="delivery_notice" style="border: 1px solid #0026ff; z-index: 2; position: absolute; background: gray; display: none;">
                                            <div style="color: white; word-break: break-all; line-height: 1.3;">
                                                <p>출발예정일과 배송사 정보는 판매자가 설정한 정보입니다.
                                                      판매자 사정 또는 여러 상품을 함께 주무한 경우 출발
                                                      예정일이나 배송사가 변동 될 수 있습니다.</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>                       
                    </div>
                                                          
                    <!--배송 방법(무료배송,유료배송,조건부 무료 배송)-->
                    <div class="col-sm-12 col-md-12 col-lg-12" style="margin-top: 0px; border: 1px solid rgba(128, 128, 128, 0.14); line-height: 50px; min-height: 50px; background-color: rgba(51, 51, 51, 0.03); opacity: 0.9;">
                        <div class="col-sm-11 col-md-11 col-lg-11">
                            <div style="vertical-align: middle; line-height: 50px; font-size: 18px; margin-left: -15px;">
                                <a href="javascript:void(0)" return false;">
                                    <?php
                                    if ($deliveryCode == 0)
                                    {
                                    ?>
                                    무료배송
                                    <?php
                                    }else{                                                                            
                                    ?>
                                    <div style="display: inline;">배송비 <span class="delivery_cost_set"><?= $deliveryCost ?></span>원</div> 
                                    <div style="font-size: 13px; display: inline;">(<span class="delivery_free_minimum"><?= $deliveryFreeMinimum ?></span>)원 이상 구매시 무료</div>
                                    <?php
                                    }
                                    ?>
                                </a>
                            </div>
                        </div>
                        <div class="col-sm-1 col-md-1 col-lg-1">
                            <div style="font-size: 25px; opacity: 0.4; text-align: right;">
                                <a href="javascript:void(0)" return false;">
                                    <div class="glyphicon glyphicon-chevron-down"></div>
                                </a>
                            </div>                           
                        </div>
                    </div>
                    
                    <!--카드할인 무이자할부 카드추가 혜택-->
                    <div class="col-sm-12 col-md-12 col-lg-12" style="margin-top: 0px; border: 1px solid rgba(128, 128, 128, 0.14); line-height: 50px; min-height: 50px; background-color: rgba(128, 128, 128, 0.0);">
                        <div class="col-sm-3 col-md-3 col-lg-3">
                            <div style="margin-left: -15px; font-size:18px;">
                                <a href="javascript:void(0)" return false;">
                                    <img src="http://hdkwonnzlaravel.cdn3.cafe24.com/icon/card_dc.JPG" class="img-responsive" style="display: inline;" />
                                    카드할인
                                </a>
                            </div>
                           
                        </div>
                        <div class="col-sm-3 col-md-3 col-lg-3">
                            <div style="margin-left: -15px; font-size:17px;">
                                <a href="javascript:void(0)" return false;">
                                    <img src="http://hdkwonnzlaravel.cdn3.cafe24.com/icon/no_interest.JPG" class="img-responsive" style="display: inline;" />
                                    무이자할부
                                </a>
                            </div>                                       
                        </div>
                        <div class="col-sm-5 col-md-5 col-lg-5">
                            <div style="margin-left: -15px; font-size:17px;">
                                <a href="javascript:void(0)" return false;">
                                    <img src="http://hdkwonnzlaravel.cdn3.cafe24.com/icon/card_add.JPG" class="img-responsive" style="display: inline;" />
                                    카드추가혜택
                                </a>
                            </div>
                        </div>
                        <div class="col-sm-1 col-md-1 col-lg-1">
                           <div style="font-size: 25px; opacity: 0.4; text-align: right;">
                               <a href="javascript:void(0)" return false;">
                                   <div class="glyphicon glyphicon-chevron-down"></div>
                               </a>
                           </div>                           
                        </div>
                    </div>

                    <!--원산지-->
                    <div class="col-sm-12 col-md-12 col-lg-12" style="margin-top: 0px; border: 1px solid rgba(128, 128, 128, 0.10); line-height: 50px; min-height: 50px; background-color: rgba(51, 51, 51, 0.00);">
                        <div class="col-sm-12 col-md-12 col-lg-12">
                            <div style="vertical-align: middle; line-height: 50px; font-size: 17px; margin-left: -15px; opacity: 1;">
                                <b>원산지-<?= $countryOfProduct ?></b>          
                            </div>
                        </div>                        
                    </div>

                    @if ($certifyCode == 1)
                    <!--인증정보-->
                    <div class="col-sm-12 col-md-12 col-lg-12" style="margin-top: 0px; border: 1px solid rgba(128, 128, 128, 0.10); line-height: 50px; min-height: 50px; background-color: rgba(51, 51, 51, 0.00);">
                        <div class="col-sm-11 col-md-11 col-lg-11">
                            <a href="javascript:void(0)" return false;">
                                <div style="vertical-align: middle; line-height: 50px; font-size: 17px; margin-left: -15px; opacity: 1;">
                                    <b>인증정보</b>
                                </div>
                            </a>
                        </div>
                        <div class="col-sm-1 col-md-1 col-lg-1">
                            <div style="font-size: 25px; opacity: 0.4; text-align: right;">
                                <a href="javascript:void(0)" return false;">
                                    <div class="glyphicon glyphicon-chevron-down"></div>
                                </a>
                            </div>
                        </div>
                    </div>
                    @endif
                    
                    <!--국내,해외발송-->
                    <div class="col-sm-12 col-md-12 col-lg-12" style="margin-top: 0px; border: 1px solid rgba(128, 128, 128, 0.10); line-height: 50px; min-height: 50px; background-color: rgba(51, 51, 51, 0.00);">
                        <div class="col-sm-12 col-md-12 col-lg-12">
                            <div style="vertical-align: middle; line-height: 50px; font-size: 16px; margin-left: -15px; opacity: 0.9;">
                                <?php
                                if ($overseasDelivery == 1)
                                {
                                ?>                                                                
                                본 상품은 <b>해외발송</b>이 가능 합니다
                                <?php
                                }else{
                                ?>                                                                                               
                                본 상품은 <b>국내배송</b>만 가능 합니다                                
                                <?php
                                }
                                ?>
                            </div>
                        </div>
                    </div>
                    
                    <!--스마일카드-->
                    <div class="col-sm-12 col-md-12 col-lg-12" style="margin-top: 10px; margin-bottom: 20px; border: 1px solid rgba(128, 128, 128, 0.10); line-height: 50px; min-height: 50px; background-color: rgba(128, 128, 128, 0.1);">                      
                        <div class="col-sm-12 col-md-12 col-lg-12">
                            <a href="javascript:void(0)" return false;">
                                <div style="vertical-align: middle; line-height: 50px; font-size: 17px; margin-left: -15px; opacity: 1;">
                                    <img src="http://hdkwonnzlaravel.cdn3.cafe24.com/icon/smile_card.JPG" class="img-responsive" style="display: inline;" />
                                    <b>
                                        Smile Card 할인금액
                                        <u style="color: red;">-5,000원</u>
                                    </b>
                                    <b style="border: 1px solid rgba(128, 128, 128, 0.7);">확인하기></b>
                                </div>
                            </a>
                        </div>                                                                             
                    </div>

                    <!--공백 주기-->
                    <div class="col-sm-12 col-md-12 col-lg-12" style="margin-top: 20px;">
                        
                    </div>
                    
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
                    <div style="display: none;" class="option_code">
                        1
                    </div>
                    <!--옵션명1 내용--><!--select_option11-->
                    <div class="col-sm-12 col-md-12 col-lg-12 select_option11" style="border: 1px solid rgba(128, 128, 128, 0.10); line-height: 50px; min-height: 50px; background-color: rgba(51, 51, 51, 0.00);">
                        <div class="col-sm-11 col-md-11 col-lg-11">
                            <a href="javascript:void(0)" return false;">
                                <div class="option01_01_description" style="vertical-align: middle; line-height: 50px; font-size: 17px; margin-left: -15px; opacity: 1;">
                                    옵션명11
                                </div>
                            </a>
                        </div>
                        <div class="col-sm-1 col-md-1 col-lg-1">
                            <div style="font-size: 25px; opacity: 0.4; text-align: right;">
                                <!--select_option11-->
                                <a href="javascript:void(0)" return false;" class="select_option11">
                                    <i class="glyphicon glyphicon-chevron-down chevron_down_option11 select_option11"></i><!--select_option11-->
                                    <i class="glyphicon glyphicon-chevron-up chevron_up_option11 select_option11" style="display: none;"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                 
                    <!--옵션1 상품리스트 보여줄 줄 자리. 처음에는 숨겨놓는다--><!--option_list11-->
                    <div class="row show_option11_list" style="margin-left: 30px; margin-right: 0px;">
                        <div class="col-sm-12 col-md-12 col-lg-12">
                            <!--option_list11-->
                            <div style="display: none; width: 106.8%;" class="option_list11">
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
                                                <div class="productList_option11">
                                                    <!--productList_option11-->
                                                    <a href="javascript:void(0)" return false;" class="click_option">
                                                        <span class="option11_first_options_id" style="display: none;">
                                                            <?=$item->id?>
                                                        </span>
                                                        <span style="display: none;">
                                                            <?=$item->product_id?>
                                                        </span>
                                                        <span class="option01_01_description_member">
                                                            <?=$item->description?>
                                                        </span>
                                                        <span class="option11_amount" style="display: none;">
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
                                                        <span class="option11_amount_text">
                                                            <?=$item->amount?>
                                                        </span>
                                                        <span>원)</span>
                                                        <span class="option11_stock" style="display: none;">
                                                            <?=$item->stock?>
                                                        </span>
                                                        <span> - 재고 : </span>
                                                        <span class="option11_stock_text">
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
                                            <div class="col-sm-12 col-md-12 col-lg-12 attach_option_list11"></div>
                                        </div>
                                    </div>
                                </div>
                                <!--총상품금액-->
                                <div class="row grand_real_sell_amount11" style="display:none; margin-top: 15px;">
                                    <div style="background: white; width: 94%;">
                                        <div class="row">
                                            <div class="col-sm-12 col-md-12 col-lg-12"></div>
                                            <div class="amount_option11">
                                                <div class="col-sm-2 col-md-2 col-lg-2"></div>
                                                <div class="col-sm-4 col-md-4 col-lg-4">
                                                    <span style="font-size: 20px;">
                                                        총상품금액
                                                        <a href="javascript:void(0)" return false;">
                                                            <i class="glyphicon glyphicon-question-sign"></i>
                                                        </a>
                                                    </span>
                                                </div>
                                                <div class="col-sm-6 col-md-6 col-lg-6" style="text-align: right;">
                                                    <span id="totalAmount11_text" style="font-size: 25px; color: black;"></span>
                                                    <span style="font-size: 17px;">원</span>
                                                    <span class="totalAmountNumber11" style="display: none;"></span>
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
                    <div style="display: none;" class="option_code">
                        2
                    </div>
                    <!--옵션2=>옵션명21 내용--><!--select_option21-->                   
                    <div class="col-sm-12 col-md-12 col-lg-12 select_option21" style="border: 1px solid rgba(128, 128, 128, 0.10); line-height: 50px; min-height: 50px; background-color: rgba(51, 51, 51, 0.00);">
                        <div class="col-sm-11 col-md-11 col-lg-11">                           
                            <a href="javascript:void(0)" return false;">
                                <div class="option02_01_description" style="vertical-align: middle; line-height: 50px; font-size: 17px; margin-left: -15px; opacity: 1;">
                                    옵션명21
                                </div>
                            </a>
                        </div>
                        <div class="col-sm-1 col-md-1 col-lg-1">
                            <div style="font-size: 25px; opacity: 0.4; text-align: right;">
                                <!--select_option21-->
                                <a href="javascript:void(0)" return false;" class="select_option21">
                                    <i class="glyphicon glyphicon-chevron-down chevron_down_option21 select_option21"></i><!--select_option21-->
                                    <i class="glyphicon glyphicon-chevron-up chevron_up_option21 select_option21" style="display: none;"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                                     
                    <!--옵션1 상품리스트 보여줄 줄 자리. 처음에는 숨겨놓는다--><!--option_list21-->
                    <div class="row show_option21_list" style="margin-left: 30px; margin-right: 0px;">
                        <div class="col-sm-12 col-md-12 col-lg-12">
                            <!--option_list21-->
                            <div style="display: none; width: 106.8%;" class="option_list21">
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
                                                <div class="productList_option21">
                                                    <!--productList_option21-->
                                                    <a href="javascript:void(0)" return false;" class="click_option">
                                                        <span class="option21_first_options_id" style="display: none;">
                                                            <?=$item->id?>
                                                        </span>
                                                        <span style="display: none;">
                                                            <?=$item->product_id?>
                                                        </span>
                                                        <span class="option02_01_description_member">
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
                    <div class="col-sm-12 col-md-12 col-lg-12 select_option22" style="border: 1px solid rgba(128, 128, 128, 0.10); line-height: 50px; min-height: 50px; background-color: rgba(51, 51, 51, 0.00);">
                        <div class="col-sm-11 col-md-11 col-lg-11">                           
                            <a href="javascript:void(0)">
                                <div class="option02_02_description" style="vertical-align: middle; line-height: 50px; font-size: 17px; margin-left: -15px; opacity: 1;">
                                    옵션명22
                                </div>
                            </a>
                        </div>
                        <div class="col-sm-1 col-md-1 col-lg-1">
                            <div style="font-size: 25px; opacity: 0.4; text-align: right;">
                                <!--select_option22-->
                                <a href="javascript:void(0)" class="select_option22">
                                    <i class="glyphicon glyphicon-chevron-down chevron_down_option22 select_option22"></i><!--select_option22-->
                                    <i class="glyphicon glyphicon-chevron-up chevron_up_option22 select_option22" style="display: none;"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                    
                    <!--옵션22 상품리스트 보여줄 줄 자리. 처음에는 숨겨놓는다--><!--option_list22-->
                    <div class="row show_option22_list" style="margin-left: 30px; margin-right: 0px;">
                        <div class="col-sm-12 col-md-12 col-lg-12"><!--option_list22-->
                            <div style="display: none; width: 106.8%;" class="option_list22">
                                <div class="row">
                                    <!---->
                                    <div style="background: white; border: 2px solid black; width: 94%; height: 200px; overflow-y: scroll; overflow-x: hidden;">
                                        <div class="row">
                                            <div class="col-sm-10 col-md-10 col-lg-10"><!--db에서 온값-->
                                                <?php
                                                foreach ($secondOptions as $item)
                                                {
                                                ?>
                                                <div class="productList_option22"><!--productList_option22-->
                                                    <a href="javascript:void(0)" return false;" class="click_option22">
                                                        <span class="second_option_id" style="display: none;">
                                                            <?=$item->id?>
                                                        </span>
                                                        <span class="option22_first_options_id" style="display: none;">
                                                            <?=$item->first_option_id?>
                                                        </span>
                                                        <span class="option_product_id" style="display: none;">
                                                            <?=$item->product_id?>
                                                        </span>
                                                        <span class="option02_02_description_member">
                                                            <?=$item->description?>
                                                        </span>
                                                        <span class="option22_amount" style="display: none;">
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
                                                        <span class="option22_amount_text">
                                                            <?=$item->amount?>
                                                        </span>
                                                        <span>원)</span>
                                                        <span class="option22_stock" style="display: none;">
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
                                            <div class="col-sm-12 col-md-12 col-lg-12 attach_option_list22">
                                                
                                                
                                            </div>                                          
                                        </div>
                                    </div>
                                </div>
                                <!--총상품금액-->
                                <div class="row grand_real_sell_amount22" style="display:none; margin-top: 15px;">
                                    <div style="background: white; width: 94%;">
                                        <div class="row">
                                            <div class="col-sm-12 col-md-12 col-lg-12"></div>
                                            <div class="amount_option22">
                                                <div class="col-sm-2 col-md-2 col-lg-2"></div>
                                                <div class="col-sm-4 col-md-4 col-lg-4">
                                                    <span style="font-size: 20px;">
                                                        총상품금액
                                                        <a href="javascript:void(0)" return false;">
                                                            <i class="glyphicon glyphicon-question-sign"></i>
                                                        </a>
                                                    </span>
                                                </div>
                                                <div class="col-sm-6 col-md-6 col-lg-6" style="text-align: right;">
                                                    <span id="totalAmount22_text" style="font-size: 25px; color: black;"></span>
                                                    <span style="font-size: 17px;">원</span>
                                                    <span class="totalAmountNumber22" style="display: none;"></span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                   
                    <!--배송비 결제 title-->
                    <div class="col-sm-12 col-md-12 col-lg-12" style="margin-left: -15px; margin-top:  15px;">
                        <b style="font-size: 18px;">배송비 결제</b>
                    </div>

                    <?php
                    if ($deliveryCode != 0)
                    {
                    ?>
                    <!--배송비 결제-->
                    <div class="col-sm-12 col-md-12 col-lg-12" style="border: 1px solid rgba(128, 128, 128, 0.10); line-height: 50px; min-height: 50px; background-color: rgba(51, 51, 51, 0.00);">
                        <div class="col-sm-11 col-md-11 col-lg-11">
                            <a href="javascript:void(0)" return false;" class="delivery_charge">
                                <div style="color: #0094ff; vertical-align: middle; line-height: 50px; font-size: 17px; margin-left: -15px; opacity: 1;">
                                    주문시 <span class="delivery_cost_set"><?= $deliveryCost ?></span>원 결제
                                </div>
                            </a>
                        </div>
                        <div class="col-sm-1 col-md-1 col-lg-1">
                            <div style="font-size: 25px; opacity: 0.4; text-align: right;">
                                <a href="javascript:void(0)" return false;" class="delivery_charge">
                                    <div class="glyphicon glyphicon-chevron-down"></div>
                                </a>
                            </div>
                        </div>
                    </div>
                    <?php
                    }
                    ?>
                                                                           
                    <!--장바구니, 구매하기-->
                    <div class="row">
                        <div class="col-sm-12 col-md-12 col-lg-12" style="margin-top: 20px;">
                            <div class="row" style="">
                                <div class="col-sm-6 col-md-6 col-lg-6 text-center">
                                    <div>
                                        <!--void(0):loading spinner not working,void():loading spinner woring-->
                                        <a href="javascript:void();" class="addCart_Click">
                                            <div style="color: black; background-color: rgba(128, 128, 128, 0.10); font-size: 25px; border: 1px solid rgba(128, 128, 128, 0.16); vertical-align: middle; line-height: 60px; min-height: 60px; ">
                                                장바구니
                                            </div>
                                        </a>
                                    </div>                                       
                                </div>
                                <div class="col-sm-6 col-md-6 col-lg-6 text-center">
                                    <div>
                                        <a href="javascript:void()" class="buyNow_Click">
                                            <div style="color: white; background-color: #0094ff; font-size: 25px; border: 1px solid rgba(128, 128, 128, 0.16); vertical-align: middle; line-height: 60px; min-height: 60px; ">
                                                구매하기
                                            </div>
                                        </a>
                                    </div>                                   
                                </div>                           
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
                                                  
        <!--상단 화면의 좌우 구분이 끝나고 한 화면으로 모아진다.-->
        <!--상품정보 상품분석평 배송반품/상품고시 메뉴표시 칸-->        
        <div class="row fixedPosition" style="z-index: 10;">            
            <div class="col-sm-12 col-md-12 col-lg-12">
                <div style="margin-top: 40px; margin-bottom: 0px; min-height: 50px; background-color: #ff6a00;">
                    <div class="col-sm-3 col-md-3 col-lg-3" style="min-height: 50px; line-height: 50px; margin-left: -15px; margin-right: -15px; text-align: center;">
                        <a href="#">
                            <div class="productInfo" style="vertical-align: middle; font-size: 20px;">상품정보</div>
                        </a>
                    </div>
                    <div class="col-sm-4 col-md-4 col-lg-4" style="min-height: 50px; line-height: 50px; margin-left: -15px; margin-right: -15px; text-align: center;">
                        <a href="#productAnalysis">
                            <div class="productAnalysis" style="vertical-align: middle; font-size: 20px;">상품분석평(0000)/판매자문의</div>
                        </a>
                    </div>
                    <div class="col-sm-3 col-md-3 col-lg-3" style="min-height: 50px; line-height: 50px; margin-left: -15px; margin-right: -15px; text-align: center;">
                        <a href="#backDelivery">
                            <div class="backDelivery" style="vertical-align: middle; font-size: 20px;">배송반품/상품고시</div>
                        </a>
                    </div>
                    <div class="col-sm-2 col-md-2 col-lg-2" style="min-height: 50px; line-height: 50px; margin-left: -15px; margin-right: -15px; text-align: right;">
                        <a href="#">
                            <div style="vertical-align: middle; font-size: 20px;">맨위로</div>
                        </a>
                    </div>
                </div>
            </div>            
        </div>
        
        <!--판매자의 인기상품-->
        <!--데이터는 Ajax에서 loading 된다(ownersPopularProducts.balde.php)-->
        <div class="ownersPopularProducts_section">
            <!--ajax에서 load...-->           
            <div class="row" style="margin-left: -15px; margin-top: 30px;">
                <div class="col-sm-8 col-md-8 col-lg-8">
                    <span style="font-size: 20px;">
                        <b>판매자</b>의
                        <b>인기상품</b>
                    </span>
                </div>
                <div class="col-sm-8 col-md-8 col-lg-8">
                    <span style="font-size: 15px; color: blue;">
                        데이터 로딩중...
                    </span>
                </div>                
            </div>           
        </div>

        <!--줄 긋기-->
        <div class="row">
            <div class="col-sm-12 col-md-12 col-lg-12">
                <div style="border-bottom: 1px solid rgba(128, 128, 128, 0.17);"></div>
            </div>
        </div>
              
        <!--상품정보, 옵션선택리스트B 만들기-->
        <!--화면을 이등분하여 사용한다-->
        <div class="row">
            <div class="col-sm-8 col-md-8 col-lg-8"><!--아래 margin-top: 10px 였음.20/04/2019-->
                <!--상품정보-->
                <div class="dis_productInfo" style="margin-top: 17px; margin-bottom: 30px; min-height: 800px; width: 100%;" id="productInfo">
                    
                    <?= $description ?><!--for test 16/04/2019-->
                    <!--상품정보-->
                </div>
                <!--상품분석평-->
                <div class="dis_productAnalysis" style="margin-top: 17px; margin-bottom: 30px; min-height: 800px; width: 100%; border: 1px solid green;" id="productAnalysis">
                    상품분석평
                    <br />
                    상품분석평
                </div>
                <!--배송반품-->
                <div class="dis_backDelivery" style="margin-top: 17px; margin-bottom: 30px; min-height: 800px; width: 100%; border: 1px solid #b200ff;" id="backDelivery">
                    배송반품
                    <br />
                    배송반품
                </div>
            </div>
            
            <!--옵션선택리스트B 만들기-->
            <!--상품정보 우측에 옵션선택 창을 만든다. 바로 위에있는 옵션 창과 같다-->            
            <div class="col-sm-4 col-md-4 col-lg-4" style="position: sticky;  top: 100px;">
                <div style="border: 1px solid gray; height: 400px;  overflow-y: scroll; overflow-x: hidden;">
                    @include('include.optionSelect')<!--앞에 at마크추가할것-->


                </div>
            </div>
            <!--장바구니B-->
            <div class="col-sm-4 col-md-4 col-lg-4 text-center" style="margin-top: 20px; position: sticky;  top: 520px;">
                <div>
                    <!--void(0):loading spinner not working,void():loading spinner woring-->
                    <a href="javascript:void();" class="addCart_Click">
                        <div style="color: black; background-color: rgba(128, 128, 128, 0.10); font-size: 25px; border: 1px solid rgba(128, 128, 128, 0.16); vertical-align: middle; line-height: 60px; min-height: 60px; ">
                            장바구니
                        </div>
                    </a>
                </div>
            </div>
            <!--구매하기B-->
            <div class="col-sm-4 col-md-4 col-lg-4 text-center" style="margin-top: 15px; position: sticky;  top: 595px;">
                <div>
                    <a href="javascript:void()" class="buyNow_Click">
                        <div style="color: white; background-color: #0094ff; font-size: 25px; border: 1px solid rgba(128, 128, 128, 0.16); vertical-align: middle; line-height: 60px; min-height: 60px; ">
                            구매하기
                        </div>
                    </a>
                </div>
            </div>                       
        </div>
                              
        <!--------------------------------------------------------------------------------------------------->
               
        <!--사용자의 하드디스크에 현재 보고있는 상품의 id 와 picture 이름를 저장(쿠키)-->
        <?php
        if (Cookie::get('myProducts'))   //myProducts라는 쿠키가 존재하면...
        {
            foreach (Cookie::get('myProducts') as $name => $value)  //쿠키를 순서대로 읽어서
            {                
                $name = htmlspecialchars($name);
                $value = htmlspecialchars($value);
                //echo ($name . '###'. $value . '    ' ); ///////////////
                if ($name == $productId)  //현재 보고 있는 상품이 있으면
                {                         //삭제한다.(아래 루틴에서 다시 세이브한다==>순서를 유지하기 위해...)
                    $myCookie = 'myProducts' . '[' . $productId . ']';
                    Cookie::queue($myCookie, $fileName,  -1, '/'); //-1은 분을 의미(1시간 = 60초 * 60초)
                }                                                  //일분 전에 쿠키가 지워졌다는 의미...
            }
        }
        $myCookie = 'myProducts' . '[' . $productId . ']'; //어레이 형태로 저장하기 위해 대괄호를 포함.
        Cookie::queue($myCookie, $fileName, +1440, '/'); //+1440은 분을 의미(+숫자는 분을 의미)
        ?>
        
        <!--------------------------------------------------------------------------------------------------->

    </div><!--여기까지가 전체 화면-->        
</div><!--상품 화면 시작 끝-->

<!--장바구니담기를 위한 다이얼로그용 화면(숨겨져 있다가 이벤트 발생시 보여진다)-->
<div id="dialogForCart" title="장바구니에 담기">
    <div style="margin-top: 20px; margin-bottom: 20px;" class="text-center">
        <span>
            <span style="color: blue;" >장바구니</span>에 상품을 담았습니다
        </span>
    </div>
    <div style="margin-top: 20px; margin-bottom: 20px; margin-left: 10px; margin-right: 10px;  background: rgba(128, 128, 128, 0.50)" class="text-center">
        <div style="word-break: break-all;">
            <span>
                <?=$modelName?>
            </span>
        </div>
    </div>
</div><!--장바구니담기를 위한 다이얼로그용 화면(숨겨져 있다가 이벤트 발생시 보여진다)-->

<!--script-->
<!--<script src="/lib/jquery/jquery-2.2.3.min.js"></script>-->
<script
    src="https://code.jquery.com/jquery-2.2.4.min.js"
    integrity="sha256-BbhdlvQf/xTY9gja0Dq3HiwQF8LaCRTXxZKRutelT44="
    crossorigin="anonymous"></script>
<!--<script src="/lib/jquery-ui-1.11.4.custom/jquery-ui.min.js"></script>-->
<script
    src="https://code.jquery.com/ui/1.11.4/jquery-ui.min.js"
    integrity="sha256-xNjb53/rY+WmG+4L6tTl9m6PpqknWZvRt0rO1SRnJzw="
    crossorigin="anonymous"></script>

<script src="/myJs/productDetailsTopImageCarouel.js"></script>
<script src="/myJs/productDetailsOptionControlB.js"></script>
<script src="/myJs/productDetailsInfo.js"></script>
<script src="/myJs/addCartOrBuyNow.js"></script>
<script src="/myJs/productDetailsOthers.js"></script>

<!--//메뉴바 밑에 가로로 펼쳐있는 메뉴에 마우를 대면 그에 해당하는 서브 메뉴가 펼쳐 진다.-->
<script>        
</script>
<!--//택배회사에 마우스 온하면 내용이 보인다. -->  
<script>    
</script>

<!--금액 편집-->
<script>    
</script>

<!--JQuery UI사용시 conflict가 발생하여 $m으로 재정의 하였음-->
<!--아래는 절대로 지우지 말것. spinner 사용시 에러가 나옴-->
<script type="text/javascript">   
</script>
@endsection
