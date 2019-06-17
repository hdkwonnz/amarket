@extends('layouts.app')

@section('title')
Product-details
@endsection

@section('content')

<!--<link href="/lib/jquery-ui-1.11.4.custom/jquery-ui.min.css" rel="stylesheet" />-->
<link href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.css" rel="stylesheet" />

<!--/static/user/mycss/myHomeIndex.css-->
<style>
    /*.main_carousel{
    width: 100%; height: 200px;
}*/
    .main_carousel_bottom {
        margin-top: 15px;
    }

    .carousel_margin_right {
        margin-right: 0px;
        z-index: 1;
    }

    .hr_thicker {
        height: 2px;
        border: none;
        color: #333;
        background-color: #333;
    }

    .super_deal_logo_size {
        width: 40px;
        height: 40px;
        margin-left: 19px;
    }

    .color_red {
        color: red;
    }

    .text_white {
        color: white;
    }

    .text_black {
        color: black;
    }

    .text_blue {
        color: blue;
    }

    .text_red {
        color: red;
    }
    /*Category Sub Menu Hanling......*/
    .categorySubBox {
        z-index: 2;
        display: none;
        background-color: rgba(255, 216, 0, 0.28);
        width: 100%;
        min-height: 410px;
        margin-left: 15px;
    }

    .category01SubArea, .category02SubArea, .category03SubArea {
        /*margin: 30px;*/
    }

    .category01SubCloseBox {
        top: -360px;
        left: 310px;
        position: relative;
    }

    .category02SubCloseBox {
        top: -320px;
        left: 220px;
        position: relative;
    }

    .category03SubCloseBox {
        top: -320px;
        left: 220px;
        position: relative;
    }

    .line_height_10 {
        line-height: 10%;
    }

    .margin_top20 {
        margin-top: 20px;
    }

    .width100 {
        width: 100%;
    }

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

    .directContactQuesSub {
        background-color: white;
        width: 150px;
        display: none;
        z-index: 5;
        position: absolute;
    }

    .top_upper {
        /*margin: -13px;*/ margin: 0px;
    }
</style>

<!--상품정보, 상품분석평, 배송반품등에 대한 스타일 -->
<style>
    .fixed {
        position: fixed;
        top: 44px;
        width: 50.8%;
    }

    .blue_white {
        background: blue;
        color: white;
    }
</style>

<?php
    $productId = $product->id;
    $categoryAId = $product->categorya_id;
    $categoryBId = $product->categoryb_id;
    $categoryCId = $product->categoryc_id;
    $categoryDId = $product->categoryd_id;
    $modelName = $product->modelName;
    $originPrice = $product->originPrice;
    $sellPrice = $product->sellPrice;
    //Model Product에서 categoryb를 콜 한후 field name을 가져옴.
    $categoryBname = $product->categoryb->name;
    $categoryCname = $product->categoryc->name; //위와 동일
    $categoryDname = $product->categoryd->name; //위와 동일
    $differPrice = $originPrice - $sellPrice;
    $discountRate = round((100 - ($sellPrice / $originPrice * 100)), 2);
    $productImage = $product->productImage;
?>

<!--현재 상품이 속해있는 카테고리를 보여주고 카테고리의 형제들을 보여준다-->
<!--현재 상품의 부모 카테고리를 보여준다. 클릭하면 해당 페니이지로 이동 -->
<div class="row menu_map_box">
    <div class="col-sm-12 col-md-12 col-lg-12">
        <div class="col-sm-10 col-md-10 col-lg-10">
            <div class="col-sm-1 col-md-1 col-lg-1">
                <div class="{{ Request::is('/') ? "active" : "" }}">
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
                                $nameB = $item->categoryb->name;
                                ?>                                
                                <a href="/product/categoryCmenu/<?=$item->categorya_id?>/<?=$item->categoryb_id?>/ <?=$item->id?>/<?=$nameB?>/<?=$item->name?>" class="hoverBlue">
                                    <?=$item->name?>
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
                                $nameB = $item->categoryb->name;
                                $nameC = $item->categoryc->name;
                                ?>                               
                                <a href="/product/categoryDmenu/<?=$item->categorya_id?>/<?=$item->categoryb_id?>/<?=$item->categoryc_id?>/<?=$item->id?>/<?=$nameB?>/<?=$nameC?>/<?=$item->name?>" class="hoverBlue">
                                    <?=$item->name?>
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
</div>

<!--화면을 크게 좌측(상품이름,상품이미지, 상품정보 등등) 과 우측(형제 상품들이 나열)으로 구분한다.-->
<!--좌측은 다시 좌 와 우로 구분.-->
<div class="row">
    <div class="col-sm-10 col-md-10 col-lg-10">
        <!--상품 이름 과 상품번호 보여주기 상단의 긴 박스-->
        <div class="col-sm-12 col-md-12 col-lg-12" style="height: 100%; background-color: rgba(128, 128, 128, 0.09); border-top: 1px solid rgba(128, 128, 128, 0.16); border-bottom: 1px solid rgba(128, 128, 128, 0.16);">
            <div class="row">
                <div class="col-sm-12 col-md-12 col-lg-12">
                    <div class="col-sm-10 col-md-10 col-lg-10" style="height: 100%; line-height: 60px; vertical-align: middle;">
                        <div style="word-break: break-all;">
                            <h4>
                                <b>
                                    <?=$modelName?>
                                </b>
                            </h4>
                        </div>
                    </div>
                    <div class="col-sm-2 col-md-2 col-lg-2" style="height: 100%; vertical-align: middle; line-height: 28px; display: inline-block;">
                        <div class="text-center" style="width: 100%; height: 98%; background-color: white; border: 1px thick gray;">
                            <span>
                                상품번호:<?=$productId?>
                            </span>
                            <span>ererereererdfdff</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!--왼쪽: 상품 이미지와 관심품목  오른쪽: 판매금액 과 디스카운트-->
        <div class="col-sm-12 col-md-12 col-lg-12 contentHeight" style="padding: 0px;">
            <div class="row">
                <!--상품 이미지와 관심품목 : 좌측-->
                <div class="col-sm-6 col-md-6 col-lg-6" style="padding-left: 0px;">
                    <div class="col-sm-12 col-md-12 col-lg-12" 
                         style="width: 100%; height: 100%; margin-top: 10px; 
                                padding-right: 0px; margin-left: 0px;">
                        <div id="my-carousel" class="carousel slide" data-ride="carousel">
                            <ol class="carousel-indicators">
                                <li data-target="#my-carousel" data-slide-to="0" class="active"></li>
                                <li data-target="#my-carousel" data-slide-to="1"></li>
                                <li data-target="#my-carousel" data-slide-to="2"></li>
                            </ol>
                            <div class="carousel-inner">
                                <?php
                            $pictures = $product->pictures;
                            $i = 0;
                            foreach($pictures as $picture)
                            {
                                if ($pictures)
                                {
                                    $fileName = $picture->fileName;
                                }
                                else
                                {
                                    $fileName = "";
                                }
                                if ($i == 0)
                                {
                                ?>
                                <div class="item active">                                  
                                    <a href="#">
                                        <img src="/uploadFiles/pictures/sellers/<?=$fileName?>" alt="<?=$fileName?>" class="img-responsive" />
                                        <!--<img src="http://hdkwonnz.cdn2.cafe24.com/uploadFiles/pictures/sellers/{{                                        $fileName }}" class="img-responsive" />-->
                                    </a>
                                    <div class="carousel-caption">
                                        <h2></h2>
                                    </div>                                   
                                </div>
                                <?php
                                }
                                else
                                {
                                ?>
                                <div class="item">                                  
                                    <a href="#">
                                        <img src="/uploadFiles/pictures/sellers/<?=$fileName?>" alt="<?=$fileName?>" class="img-responsive" />
                                        <!--<img src="http://hdkwonnz.cdn2.cafe24.com/uploadFiles/pictures/sellers/{{                                        $fileName }}" class="img-responsive" />-->
                                    </a>
                                    <div class="carousel-caption">
                                        <h2></h2>
                                    </div>                                   
                                </div>
                                <?php
                                }
                                $i++;
                            }
                                ?>
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
                    <!--관심상품-->
                    <div class="col-sm-12 col-md-12 col-lg-12" style="width: 100%; height: 100%; margin-top: 10px; padding-right: 0px; margin-left: 15px;">
                        <a href="#" class="interestProduct">
                            <i class="glyphicon glyphicon-heart text_red"></i>
                            <span class="text_black">InterestProduct</span>
                        </a>
                        <div class="interestProductChild" style="display: none; width: 200px; height: 150px; border: 1px solid black; background-color: white; z-index: 5; position: absolute;">
                            <span>errererereerwewe</span>
                            <a class="interestProductChildX" style="margin-left: 55px;" href="#">X</a>
                            <hr style="height: 1px; border: none; color: #333; background-color: #333; margin-top: 5px; margin-bottom: 5px;" />
                            <span>sdffdfdfdfdfdfdfdfddfdfdf</span>
                            <br />
                            <span>sdffdfdfdfdfdfdfdfddfdfdf</span>
                            <br />
                            <span>sdffdfdfdfdfdfdfdfddfdfdf</span>
                            <br />
                            <span>sdffdfdfdfdfdfdfdfddfdfdf</span>
                            <br />
                        </div>
                    </div>
                </div>

                <!--판매금액 과 디스카운트 : 우측-->
                <div class="col-sm-6 col-md-6 col-lg-6" style="padding-left: 0px;">
                    <div class="col-sm-12 col-md-12 col-lg-12" style="height: 100%; background-color: rgba(128, 128, 128, 0.09); border-top: 1px solid rgba(128, 128, 128, 0.16); border-left: 1px solid rgba(128, 128, 128, 0.16); border-right: 1px solid rgba(128, 128, 128, 0.16); margin-top: 10px;">
                        <div class="row" style="margin-left: 0px;">
                            <div class="col-sm-3 col-md-3 col-lg-3" style="height: 100%; line-height: 60px; vertical-align: middle;">
                                <span>Discounted</span>
                            </div>
                            <div class="col-sm-6 col-md-6 col-lg-6" style="height: 100%; vertical-align: middle; line-height: 28px; display: inline-block;">
                                <span style="text-decoration: line-through" class="originPrice">
                                    <?=$originPrice?>
                                </span>
                                <span style="display: none" class="originPriceAjax">
                                    <?=$originPrice?>
                                </span>
                                <span style="text-decoration: line-through" class="differPrice">
                                    (<?=$differPrice?>)
                                </span>
                                <br />
                                <span style="font-size: 20px; color: red; font-weight: 700;" class="sellPrice">
                                    <?=$sellPrice?>
                                </span>
                                <span style="display: none" class="sellPriceAjax">
                                    <?=$sellPrice?>
                                </span>
                                <a href="#" style="background-color: red; color: white;">Coupone</a>
                            </div>
                            <div class="col-sm-3 col-md-3 col-lg-3 text-center">
                                <h4 style="background: #0026ff; color: white; margin-top: 0px;">
                                    <?=$discountRate?> %
                                    <i class="glyphicon glyphicon-arrow-down"></i>
                                </h4>
                            </div>
                        </div>
                    </div>

                    <!--G마켓카드 현대카드-->
                    <div class="col-sm-12 col-md-12 col-lg-12" style="height: 100%; border-bottom: 1px solid rgba(128, 128, 128, 0.16); border-left: 1px solid rgba(128, 128, 128, 0.16); border-right: 1px solid rgba(128, 128, 128, 0.16); padding-top: 10px;">
                        <div class="row" style="margin-left: 0px; margin-top: 5px;">
                            <div class="col-sm-4 col-md-4 col-lg-4">
                                <span>GMaketCard</span>
                            </div>

                            <div class="col-sm-4 col-md-4 col-lg-4">
                                <span>$110.99 </span>
                                <br />
                            </div>
                            <div class="col-sm-4 col-md-4 col-lg-4">
                                <span>
                                    Max15%
                                    <a href="#">Apply?</a>
                                </span>
                                <br />
                            </div>
                        </div>
                        <div class="row" style="margin-left: 0px; margin-top: 5px;">
                            <div class="col-sm-4 col-md-4 col-lg-4">
                                <span>HyundaiCard</span>
                            </div>

                            <div class="col-sm-4 col-md-4 col-lg-4">
                                <span>$130.99 </span>
                            </div>
                            <div class="col-sm-4 col-md-4 col-lg-4">
                                <span>
                                    Max5$
                                    <a href="#">Apply?</a>
                                </span>
                            </div>
                        </div>

                        <!--슈퍼카드-->
                        <div class="row">
                            <div class="col-sm-12 col-md-12 col-lg-12">
                                <div class="row" style="background-color: rgba(0, 148, 255, 0.66); margin: 10px; line-height: 30px; vertical-align: middle;">
                                    <div class="col-sm-10 col-md-10 col-lg-10">
                                        <div>
                                            <a href="#">Super Card IN This Month + No Interest</a>
                                        </div>
                                    </div>
                                    <div class="col-sm-2 col-md-2 col-lg-2">
                                        <div>
                                            <span></span>
                                            <a href="#">
                                                Go
                                                <span>></span>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!--직접 콘택-->
                    <div class="row">
                        <div class="col-sm-12 col-md-12 col-lg-12">
                            <div class="row" style="margin: 10px;">
                                <div class="col-sm-4 col-md-4 col-lg-4">
                                    <div class="directContactQues">
                                        <span>Direct Contact</span>
                                        <a href="#">&nbsp;?</a>
                                        <div class="directContactQuesSub text-center" style="border-top: 1px solid #0026ff; border-bottom: 1px solid #0026ff; border-right: 1px solid #0026ff; border-left: 1px solid #0026ff;">
                                            <span>dsdfsfdfsfdfdsdf</span>
                                            <br />
                                            <span>dsdfsfdfsfdfdsdf</span>
                                            <br />
                                            <span>dsdfsfdfsfdfdsdf</span>
                                            <br />
                                            <span>dsdfsfdfsfdfdsdf</span>
                                            <br />
                                            <span>dsdfsfdfsfdfdsdf</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-8 col-md-8 col-lg-8">
                                    <span style="color: #00ff21;">Stamp2(Max)</span>
                                    <span>&nbsp;SMailePoint0.3%</span>
                                    <span style="font-size: 15px; color : #0094ff">&nbsp;&nbsp;Pay</span>
                                    <a href="#">&nbsp;?</a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <hr style="margin-top: 5px; margin-bottom: 15px;" />

                    <!--배송료-->
                    <div class="row">
                        <div class="col-sm-12 col-md-12 col-lg-12">
                            <div class="row" style="margin-left: 10px;">
                                <div class="col-sm-4 col-md-4 col-lg-4">
                                    <span>Delivery Charge</span>
                                </div>
                                <div class="col-sm-8 col-md-8 col-lg-8">
                                    <span>Free</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <hr style="margin-top: 10px; margin-bottom: 10px;" />

                    <!--옵션 상품 선택-->
                    <div class="row">
                        <div class="col-sm-12 col-md-12 col-lg-12">
                            <div style="height: 100%; background-color: rgba(128, 128, 128, 0.09); border-top: 1px solid rgba(128, 128, 128, 0.16); border-bottom: 1px solid rgba(128, 128, 128, 0.16); border-left: 1px solid rgba(128, 128, 128, 0.16); border-right: 1px solid rgba(128, 128, 128, 0.16); padding-top: 5px;">
                                <div class="row" style="margin-left: 10px;">
                                    <div class="col-sm-4 col-md-4 col-lg-4">
                                        <span style="color: rgba(0, 38, 255, 0.76);">
                                            필수선택
                                            <i class="glyphicon glyphicon-ok-circle"></i>
                                        </span>
                                    </div>
                                    <div class="col-sm-8 col-md-8 col-lg-8">
                                        <span>(상품옵션을 선택해 주세요)</span>
                                    </div>
                                </div>
                                <div class="row" style="margin-left: 10px; padding-top: 10px; padding-bottom: 10px;">
                                    <div class="col-sm-4 col-md-4 col-lg-4">
                                        <span>본상품필수옵션</span>
                                    </div>
                                    <div class="col-sm-8 col-md-8 col-lg-8">
                                        <div style="border: 1px solid rgba(0, 38, 255, 0.76); width: 95%;">
                                            <a href="#" class="select_option">
                                                <span>선택하세요</span>
                                                <span style="padding-left: 170px;">
                                                    <i class="glyphicon glyphicon-chevron-down"></i>
                                                </span>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="hiddenAreaBox_option">
                        <!--옵션을 클릭하면 화면에 차례대로 보여준다-->
                        <!--아래 들어갈 내용은 Jquery에서 처리하였음-->
                        <div id="addOption_list"></div>

                        <!-- 총상품금액-->
                        <!--아래 들어갈 내용은 Jquery에서 처리하였음-->
                        <div class="row">
                            <div style="display: none;" class="amount_option">
                                <div class="col-sm-5 col-md-5 col-lg-5"></div>
                                <div class="col-sm-3 col-md-3 col-lg-3">
                                    <span>
                                        총상품금액
                                        <a href="#">
                                            <i class="glyphicon glyphicon-question-sign"></i>
                                        </a>
                                    </span>
                                </div>
                                <div class="col-sm-4 col-md-4 col-lg-4">
                                    <span id="totalAmount" style="font-size: 20px; color: red;"></span>
                                    <span>원</span>
                                    <span class="totalAmountNumber" style="display: none;"></span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!--옵션 상품리스트 보여줄 줄 자리. 처음에는 숨겨놓는다-->
                    <div class="row" style="margin-left: 30px; margin-right: 0px;">
                        <div class="col-sm-12 col-md-12 col-lg-12">
                            <div style="display: none; width: 106.8%;" class="option_list">
                                <div class="row">
                                    <div style="background: #ffd800; width: 94%; min-height: 40px; overflow: hidden; line-height: 40px; vertical-align: central; border-top: 2px solid black; border-left: 2px solid black; border-right: 2px solid black;">
                                        <div class="col-sm-8 col-md-8 col-lg-8">
                                            <span>
                                                <b>옵션포함상품가:</b>
                                            </span>
                                            <span style="color: #0026ff;">
                                                <b>000,000원</b>
                                            </span>
                                        </div>
                                        <div class="col-sm-3 col-md-3 col-lg-3">
                                            <a href="#" style="background: gray; color: white;">
                                                <span>전체옵션보기</span>
                                            </a>
                                        </div>
                                        <div class="col-sm-1 col-md-1 col-lg-1">
                                            <a href="#" class="remove_list">
                                                <span>
                                                    <i class="glyphicon glyphicon-remove"></i>
                                                </span>
                                            </a>
                                        </div>
                                    </div>
                                    <div style="background: white; border: 2px solid black; width: 94%; height: 200px; overflow-y: scroll; overflow-x: hidden;">
                                        <div class="row">
                                            <div class="col-sm-10 col-md-10 col-lg-10">
                                                <?php
                                                foreach ($resultOp as $item)
                                                {
                                                ?>
                                                <div class="productList_option">
                                                    <a href="#" class="click_option">
                                                        <span class="modelName_option">
                                                            <?=$item->modelName?>
                                                        </span>
                                                        <span style="display: none;" class="productId_option">
                                                            <?=$item->id?>
                                                        </span>
                                                        <span class="sellPrice_option_txt">
                                                            <?=$item->sellPrice?>
                                                        </span>
                                                        <span style="display: none;" class="originPrice_option_txt">
                                                            <?=$item->originPrice?>
                                                        </span>
                                                        <span style="display: none" class="sellPrice_option">
                                                            <?=$item->sellPrice?>
                                                        </span>
                                                        <span style="display: none" class="originPrice_option">
                                                            <?=$item->originPrice?>
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

                    <!--해외 발송 가능 국가 조회-->
                    <hr style="margin-top: 5px; margin-bottom: 15px;" />

                    <div class="row">
                        <div class="col-sm-12 col-md-12 col-lg-12">
                            <div class="row" style="margin-left: 10px;">
                                <div class="col-sm-4 col-md-4 col-lg-4">
                                    <span>
                                        <i class="glyphicon glyphicon-plane" style="color: blue;"></i>Overseas
                                    </span>
                                    <a href="#">
                                        &nbsp;
                                        <i class="glyphicon glyphicon-question-sign"></i>
                                    </a>
                                </div>
                                <div class="col-sm-8 col-md-8 col-lg-8">
                                    <a href="#">
                                        <span>Available Country&nbsp;></span>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <hr style="margin-top: 10px; margin-bottom: 20px;" />

                    <!--Buy Now  Add Cart  Pay Now-->
                    <div class="row">
                        <div class="col-sm-12 col-md-12 col-lg-12">
                            <div class="row" style="margin-left: -8px;">
                                <div class="col-sm-4 col-md-4 col-lg-4 text-center">
                                    <div>
                                        <a style="background: green; font-size: 20px; color: white;" class="buyNow_Click btn btn-lg btn-default" href="#">
                                            <span>BUY NOW</span>
                                        </a>
                                    </div>
                                </div>
                                <div class="col-sm-4 col-md-4 col-lg-4 text-center">
                                    <div>
                                        <a style="font-size: 20px;" href="#" class="addCart_Click btn btn-lg btn-primary">
                                            <span>ADD CART</span>
                                        </a>
                                    </div>
                                </div>
                                <div class="col-sm-4 col-md-4 col-lg-4 text-center">
                                    <div>
                                        <a style="color: black; font-size: 20px; background: #ff00dc;" class="btn btn-lg btn-default" href="#">
                                            <span>PAY NOW</span>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>


        <?php
        $pictures = $product->pictures->first();
        if ($pictures)
        {
            $fileName = $pictures->fileName;
        }
        else
        {
            $fileName = "";
        }
        ?>


        <!--productId 값을 얻기위해 데이터를 숨긴다(Ajax에서 사용)...-->
        <div style="display: none; " class="hidden_productId">
            <?=$productId?>
        </div>
        <!--fileName 값을 얻기위해 데이터를 숨긴다(Ajax에서 사용)...-->     
        <div style="display: none; " class="hidden_fileName">
            <?=$fileName?>
        </div>       
      

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
        Cookie::queue($myCookie, $fileName, +10, '/'); //+10은 분을 의미
        ?>


        <!--좌측 화면의 좌우 구분이 끝나고 좌측의 한 화면으로 모아진다.-->
        <!--상품정보 상품분석평 배송반품/상품고시 메뉴표시 칸-->
        <div class="row fixedPosition" style="z-index: 3;">
            <div class="col-sm-12 col-md-12 col-lg-12">
                <table class="" style="margin-top: 10px; margin-bottom: 0px; min-height: 40px; width: 100%; background: rgba(128, 128, 128, 0.17); border-bottom: 2px solid blue;">
                    <tr>
                        <td style="width: 20%; text-align: center;">
                            <a href="#">
                                <div class="productInfo" style="min-height: 40px; line-height: 40px; vertical-align: middle;">상품정보</div>
                            </a>
                        </td>
                        <td style="width: 30%; text-align: center;">
                            <a href="#productAnalysis">
                                <div class="productAnalysis" style="min-height: 40px; line-height: 40px; vertical-align: middle;">상품분석평(0000)/판매자문의</div>
                            </a>
                        </td>
                        <td style="width: 47%; text-align: center;">
                            <a href="#backDelivery">
                                <div class="backDelivery" style="min-height: 40px; line-height: 40px; vertical-align: middle;">배송반품/상품고시</div>
                            </a>
                        </td>
                        <td style="width: 3%; text-align: center;">
                            <a href="#">TOP</a>
                        </td>
                    </tr>
                </table>
            </div>
        </div>

        <!--상품정보-->
        <div class="row dis_productInfo">
            <div class="col-sm-12 col-md-12 col-lg-12">
                <div style="margin-top: 10px; height: 1800px; width: 100%; border: 1px solid black;" id="productInfo">
                    상품정보
                    <br />                   
                    <?= $productImage ?> <!--for test 16/04/2019-->
                    상품정보
                </div>
            </div>
        </div>
        <!--상품분석평-->
        <div class="row dis_productAnalysis">
            <div class="col-sm-12 col-md-12 col-lg-12">
                <div style="margin-top: 10px; height: 800px; width: 100%; border: 1px solid green;" id="productAnalysis">
                    상품분석평
                    <br />
                    상품분석평
                </div>
            </div>
        </div>
        <!--배송반품-->
        <div class="row dis_backDelivery">
            <div class="col-sm-12 col-md-12 col-lg-12">
                <div style="margin-top: 10px; height: 800px; width: 100%; border: 1px solid #b200ff;" id="backDelivery">
                    배송반품
                    <br />
                    배송반품
                </div>
            </div>
        </div>

    </div><!--여기까지가 전체 화면의 좌측에 속한다-->

    <!--여기부터가 전체 화면의 우측이다.-->
    <!--현재 보여지는 상품의 형제 상품들 보여 줄 자리(화면의 우측)-->
    <div class="col-sm-2 col-md-2 col-lg-2" style="padding-right: 30px; padding-left: 0px;">
        <?php
        foreach ($resultBr as $item)
        {
            $pictures = $item->pictures;
            foreach($pictures as $picture)
            {
                if ($pictures)
                {
                    $fileName = $picture->fileName;
                }
                else
                {
                    $fileName = "";
                }
            }
        ?>
        <div style="width: 100%; min-height: 200px; border: 1px solid red;">
            <div>               
                <a href="/product/details/<?=$item->id?>" target="_blank">
                    <!--<img style="width: 100%; height: 50%; padding-left: 0px;" src="http://hdkwonnz.cdn2.cafe24.com/uploadFiles/pictures/sellers/<?=$fileName?>" class="img-responsive" />-->
                    <img style="width: 100%; height: 50%; padding-left: 0px;" src="/uploadFiles/pictures/sellers/<?=$fileName?>" alt="<?=$fileName?>" class="img-responsive" />
                </a>             
            </div>
            <div>
                <span class="">
                    <?=$item->modelName?>
                </span>
            </div>
            <div>
                <span class="sellPriceBrother">
                    <?=$item->sellPrice?>ì›
                </span>
            </div>
        </div>
        <?php
        }
        ?>
    </div>

</div>


<!--로그인을 위한 모달-->
<div class="modal fade" tabindex="-1" role="dialog" aria-labelledby="gridSystemModalLabel" id="dialogForLogin2">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <div class='col-sm-4 col-md-4 col-lg-4'></div>
                <div class='col-sm-5 col-md-5 col-lg-5'>
                    <h4 class="modal-title" id="gridSystemModalLabel">로그인이 필요합니다</h4>
                </div>
            </div>
            <div class="modal-body">
                <!--action="/account/loginByAjax"-->
                <form name="form" id="form" action="#" method="post" class='form-horizontal' enctype="multipart/form-data">
                    {{ csrf_field() }}
                    <div class="row">
                        <div class="form-group">
                            <label class='col-sm-4 col-md-4 col-lg-4 control-label'>USER NAME</label>
                            <div class='col-sm-5 col-md-5 col-lg-5'>
                                <input type='email' id='txtEmail2' name='txtEmail2' class='form-control' maxlength='50' value='{{ old("txtEmail") }}' required />
                            </div>
                        </div>
                    </div>
                    <div class='row'>
                        <div class='form-group'>
                            <label class='col-sm-4 col-md-4 col-lg-4 control-label'>PASSWORD</label>
                            <div class='col-sm-5 col-md-5 col-lg-5'>
                                <input type='password' id='txtPassword2' name='txtPassword2' class='form-control' value='' required />
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class='form-group'>
                            <div class='col-sm-offset-4 col-md-offset-4 col-lg-offset-4 col-sm-2 col-md-2 col-lg-2'>
                                <button type='button' id="create" name="create" class='btn btn-default btn-danger' data-dismiss="modal">
                                    취소
                                </button>
                            </div>
                            <div class='col-sm-offset-1 col-md-offset-1 col-lg-offset-1 col-sm-2 col-md-2 col-lg-2'>
                                <button type='submit' id="create" name="create" class='btn btn-default btn-primary'>
                                    로그인
                                </button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <!--<div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" id="create" name="create">Save changes</button>
            </div>-->
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div><!--로그인을 위한 모달-->
<!-- /.modal -->


<!--장바구니담기를 위한 다이얼로그용 화면(숨겨져 있다가 이벤트 발생시 보여진다)-->
<div id="dialogForCart" title="장바구니에 담기">
    <div style="margin-top: 20px; margin-bottom: 20px;" class="text-center">
        <span>
            <span class="text_blue">장바구니</span>에 상품을 담았습니다
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

<!--'/static/user/myjs/myHomeIndex.js'-->
<script>   
    $(function () {   //메뉴바 밑에 가로로 펼쳐있는 메뉴에 마우를 대면 그에 해당하는 서브 메뉴가 펼쳐 진다.
        $('.menu_map_parent1').mouseover(function () {
            $('.menu_map_child1').show()
        });
        $('.menu_map_parent1').mouseout(function () {
            $('.menu_map_child1').hide()
        });

        $('.menu_map_parent2').mouseover(function () {
            $('.menu_map_child2').show()
        });
        $('.menu_map_parent2').mouseout(function () {
            $('.menu_map_child2').hide()
        });

        $('.menu_map_parent3').mouseover(function () {
            $('.menu_map_child3').show()
        });
        $('.menu_map_parent3').mouseout(function () {
            $('.menu_map_child3').hide()
        });
        //상품사진 우측의 direct contact 에 마우스를 대면 그에 해당하는 내용이 보여진다.
        $('.directContactQues').mouseover(function () {
            $('.directContactQuesSub').show()
        });
        $('.directContactQues').mouseout(function () {
            $('.directContactQuesSub').hide()
        });
    });
</script>

<!--금액 편집-->
<script>
    $(function () {
        var value = $('.originPrice').text();
        var txtValue = "";
        txtValue = formatNumber(value);
        $('.originPrice').empty().append(txtValue);

        var value = $('.differPrice').text();
        var txtValue = "";
        txtValue = formatNumber(value);
        $('.differPrice').empty().append(txtValue);

        var value = $('.sellPrice').text();
        var txtValue = "";
        txtValue = formatNumber(value);
        $('.sellPrice').empty().append(txtValue);

        $('.sellPriceBrother').each(function () {
            txtValue = formatNumber($(this).text());
            $(this).text(txtValue);
        });
    });

    $(function () {
        $('.productList_option').each(function (i) {
            var value = $(this).children().find('.sellPrice_option_txt').text();
            var txtValue = "";
            txtValue = formatNumber(value);
            $(this).children().find('.sellPrice_option_txt').empty().append(txtValue);

            var value = $(this).children().find('.originPrice_option_txt').text();
            var txtValue = "";
            txtValue = formatNumber(value);
            $(this).children().find('.originPrice_option_txt').empty().append(txtValue);
        });
    });
    //편집하는 함수
    function formatNumber(num) {
        return num.toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, "$1,")
    }
</script>

<!--상품정보, 상품분석평, 배송반품등을 콘트롤-->
<script>
    var sw = false;  //상품정보, 상품분석평, 배송반품을 거쳐오면 true로 바뀐다
    $(function(){
        $('.productInfo').addClass("blue_white"); //화면 처음 로드시에는
        $(window).scroll(function () {                      //스크롤을 시작하면
            var h = $('.contentHeight').height();           //해당 영역의 높이를 측정하여
            if ($(document).scrollTop() >= h + 140) {       //높이에 조정값(시행착오로 얻은 값)을 더하고
                $(".fixedPosition").addClass("fixed");      //메뉴 칸을 고정 시키다.
            } else {
                $(".fixedPosition").removeClass("fixed");
            }
            if (sw == true)                     //상품정보, 상품분석평, 배송반품을 거쳐 왔는지를 체크
            {
                $(document).scrollTop(h + 139); //해당 화면을 메뉴 칸 바로 밑에 고정시킨다.
                sw = false;                     //로그인 할 경우 상품정보 메뉴 칸의 위치가 유저이름높이 만큼 아래로 내려온다...
            }

        });
        $('.productInfo').click(function(){        //상품정보를 클릭하면...
            $(this).addClass("blue_white");
            $('.productAnalysis').removeClass("blue_white");
            $('.backDelivery').removeClass("blue_white");
            sw = true;
            $('.dis_productAnalysis').show();
            $('.dis_backDelivery').show();
            $('.dis_productInfo').show();
        });
        $('.productAnalysis').click(function(){    //상품분석평을 클릭하면...
            $(this).addClass("blue_white");
            $('.productInfo').removeClass("blue_white");
            $('.backDelivery').removeClass("blue_white");
            $('.dis_productInfo').hide();
            $('.dis_backDelivery').hide();
            sw = true;
            $('.dis_productAnalysis').show();
        });
        $('.backDelivery').click(function(){        //배송반품을 클릭하면...
            $(this).addClass("blue_white");
            $('.productAnalysis').removeClass("blue_white");
            $('.productInfo').removeClass("blue_white");
            $('.dis_productAnalysis').hide();
            $('.dis_productInfo').hide();
            sw = true;
            $('.dis_backDelivery').show();
        });
    });
</script>

<!--옵션상품 선택에 대한 콘트롤-->
<script>
    $(function () {
        var existSW = false;   //옵션 상품이 이미 선택되었는지를 체크할때 사용한다. 선택되었으면 true가 된다.
        var addOptionSw = false; //옵션 상품을 하나라도 선택하였는지 체크할때 사용한다. 선택했으면 true.
        //선택하세요를 클릭 했을때
        $('.select_option').click(function () {
            //var height = $('#addOption_list').height();    //필수선택 박스의 탑으로 부터 바텀 까지의 길이를 구하여
            var height = $('.hiddenAreaBox_option').height(); //필수선택 박스의 탑으로 부터 바텀 까지의 길이를 구하여
            var realHeight = 0 - (height + 70);           //늘어나는 길이에 상관 없이 항상 박스 탑에 위치 시킨다.
            $('.option_list').css('top', realHeight + 'px').css('left', '-15px').css('position', 'absolute').css('z-index', '2').show()
        });

        $('.remove_list').click(function () {               //펼쳐진 상태에서 우측 상단의 "X" 마크 클릭시 숨긴다.
            $('.option_list').hide();       //옵션 리스트를 숨긴다.
        });

        //옵션 리스트가 펼쳐진 상태에서 원하는 상품 클릭하면...
        $('.productList_option').each(function () {
            $(this).click(function () {
                var totalAmountSellPrice = 0;
                var totalIndex = $('.selectedOption_row').length; //선택된 옵션 상품이 몇개인지 체크해서
                //alert("totalIndex : " + totalIndex);              //한개 이상이면 현재 보여지는 총상품금액을 가져온다.
                if (totalIndex > 0) {
                    totalAmountSellPrice = parseFloat($('.totalAmountNumber').text()); //현상태의 총상품금액(숫자로 바꾸었음)
                    //alert("1.totalAmountSellPrice " + totalAmountSellPrice);
                }
                var modelName = $(this).children().children().html();   //model Name
                var productId = $(this).children().children().next().html();  // productId
                var sellPrice = $(this).children().children().next().next().html();                    //편집된 상태의 sellPrice
                var originPrice = $(this).children().children().next().next().next().html();           //편집된 상태의 originPrice
                var sellPriceString = $(this).children().children().next().next().next().next().html();   //스트링 상태의 sellPrice
                var originPriceString = $(this).children().children().next().next().next().next().next().html();   //스트링 상태의 originPrice
                var sellPriceNumber = parseFloat(sellPriceString);      //숫자 상태의 sellPrice
                var originPriceNumber = parseFloat(originPriceString);      //숫자 상태의 originPrice

                //옵션상품을 클릭시 이미 선택하였나 체크한다.
                $('.selectedOption_list').each(function () {
                    //alert($(this).children().next().next().next().html());
                    var existPorductId = $(this).children().next().next().next().html();
                    if (existPorductId == productId) {
                        existSW = true;
                        return false;     //단지 each loop만 빠져나가고 뒤에 코드는 수행된다...
                    }
                });
                if (existSW == true)  //선택되었다면 뒤에 코드는 실행하지 않는다.
                {
                    alert("이미 선택하셨습니다...");
                    $('.option_list').hide();  //옵션 리스트를 숨긴다.
                    $('.selectedOption_row').show();   //기존 선택된 옵션 상품들을 보여준다
                    existSW = false;   //다시 false로 바꾸어 놓는다...
                    return false;
                }

                totalAmountSellPrice = totalAmountSellPrice + sellPriceNumber;    //총상품금액을 구한다

                $('.option_list').hide();   //상품선택하고 다시 숨긴다

                $('#addOption_list')        //클릭된 상품들의 옵션상품 리스트를  차례대로 만든다
                    .append(                //맨먼저 내용이 들어갈 공간을 만든다
                            '<div class="row selectedOption_row" style="padding-left: 15px; display: none;">' +
                                '<div class="selectedOption_list" style="border: 1px solid rgba(128, 128, 128, 0.42); min-height: 50px; overflow: hidden; width: 97%;">' +
                                    '<div class="col-sm-6 col-md-6 col-lg-6">' +
                                        '<span class="selectedOption_list_name"></span>' +   //모델 이름
                                    '</div>' +
                                    '<div class="col-sm-3 col-md-3 col-lg-3">' +
                                        '<span class="spinner"></span><span class="removeX"></span>' +  //"X" 마크 와 숫자선택 spinner
                                    '</div>' +
                                    '<div class="col-sm-3 col-md-3 col-lg-3">' +                                      
                                        '<span class="selectedOption_list_originPrice text-right"></span><span>원</span><br />' +  //편집된 originPrice
                                        '<span class="selectedOption_list_sellPrice text-right"></span><span>원</span>' +  //편집된 sellPrice
                                    '</div>' +
                                    '<div class="selectedOption_list_productId" style="display: none;">' +   //productId

                                    '</div>' +
                                    '<div class="selectedOption_list_sellPriceNumber" style="display: none;">' +   //숫자상태의 한개당 sellPrice

                                    '</div>' +
                                    '<div class="selectedOption_list_originPriceNumber" style="display: none;">' + //숫자상태의 한개당 originPrice

                                    '</div>' +
                                    '<div class="selectedOption_list_sellPriceNumberAmount" style="display: none;">' +  //숫자상태의 갯수만큼의 sellPrice

                                    '</div>' +
                                    '<div class="selectedOption_list_originPriceNumberAmount" style="display: none;">' + //숫자상태의 갯수만큼의 originPrice

                                    '</div>' +
                                '</div>' +
                            '</div>');

                $('.selectedOption_list_name').last().prepend(modelName).css('word-break', 'break-all');  //상품이름

                $('.selectedOption_list_originPrice').last().prepend(originPrice).css('text-decoration', 'line-through');  //편집된 originPrice

                $('.selectedOption_list_sellPrice').last().prepend(sellPrice);   //편집된 sellPrce

                $('.selectedOption_list_productId').last().prepend(productId);   //productId

                $('.selectedOption_list_sellPriceNumber').last().prepend(sellPriceNumber);  //숫자상태의 한개당 sellPrice

                $('.selectedOption_list_originPriceNumber').last().prepend(originPriceNumber);  //숫자상태의 한개당 originPrice

                $('.selectedOption_list_sellPriceNumberAmount').last().prepend(sellPriceNumber);  //숫자상태의 갯수만큼의 sellPrice(맨처음 실행시는 한개당하고 동일)

                $('.selectedOption_list_originPriceNumberAmount').last().prepend(originPriceNumber);  //숫자상태의 갯수만큼의 originPrice(맨처음 실행시는 한개당하고 동일)

                $('.spinner').last().append('<input class="orderQty" name="orderQty"  value="1" readonly style="width: 15px;"/>' + '&nbsp;개 &nbsp;');  //갯수 박스 spinner

                $m('.orderQty').spinner({      //갯수 박스에 대한 스피너 UI를 선언한다.(반드시 현 위치 해야 한다...)
                    min: 1,
                    max: 20,
                    step: 1
                });

                $('.removeX').last().append('<a href="#" style=""><span class="xButton" style="background: black; color: white; font-size: 20px;">X</span></a>');  //"X" 마크

                var totalAmount_txt = formatNumber(totalAmountSellPrice);      //함수를 불러 편집한다.
                //alert(totalAmount_txt);

                $('.selectedOption_row').show();   //선택된 옵션 상품들을 보여준다

                $('.totalAmountNumber').empty().append(totalAmountSellPrice); //총상품금액란에 숫자 내용을 넣는다(계산시 사용을 위해서)
                $('#totalAmount').empty().append(totalAmount_txt);  //총상품금액란에 편집된 내용을 넣는다.

                addOptionSw = true; //옵션 상품을 선택 했으니 true로 만든다.
                $('.amount_option').show();     //총상품금액을 보여준다...
                $m('.ui-icon-triangle-1-s').text('-');

                //갯수 조정 박스를 눌렀을때...
                $('.spinner').each(function () {     //function(i)처럼 "i"를 사용하면 중간에 remove된 경우에는 문제가 생겨
                    $(this).unbind().click(function () {    //***여기서는 반드시 unbind()를 사용해야함. 그렇지않을 경우 루핑을 돈다***
                        var qty = $(this).parent().parent().children().children().parent().next().children().children().children().val(); //spinner value(선택한개수)
                        var sellP = $(this).parent().parent().children().next().next().next().next().html(); //숫자 한개당 sellPrice
                        var originP = $(this).parent().parent().children().next().next().next().next().next().html(); //숫자 한개당 originPrice
                        var currentSellPrice = $(this).parent().parent().children().next().next().next().next().next().next().html(); //숫자 갯수만큼 sellPrice
                        //alert(currentSellPrice);
                        var currentOriginPrice = $(this).parent().parent().children().next().next().next().next().next().next().html(); //숫자 갯수만큼 originPrice
                        var currentTotalAmountNumber = $('.totalAmountNumber').text(); //현상태의 총상품금액
                        //alert(currentTotalAmountNumber);
                        var totalAmountSellPrice = parseFloat(currentTotalAmountNumber) - parseFloat(currentSellPrice); //현상태의 총상품금액에서 숫자갯수만큼의 sellPrice를 빼준다
                        //alert(totalAmountSellPrice);
                        var newSellPrice = qty * sellP; //새로 선택한 갯수에 숫자 한개당 sellPrice를 곱한다
                        var newSellPrice_txt = formatNumber(newSellPrice); //새로운 갯수만큼의 sellPrice를 편집
                        var newOriginPrice = qty * originP; //새로 선택한 갯수에 숫자 한개당 originPrice를 곱한다
                        var newOriginPrice_txt = formatNumber(newOriginPrice); //새로운 갯수만큼의 originPrice를 편집
                        totalAmountSellPrice = totalAmountSellPrice + newSellPrice; //새로운 총상품금액을 구한다

                        //alert($(this).parent().parent().children().children().next().children().children().parent().parent().parent().next().html());
                        $(this).parent().parent().children().children().next().children().children().parent().parent().parent().next().find('span').eq(0).empty().prepend(newOriginPrice_txt).css('text-decoration', 'line-through');  //편집된 originPrice
                        $(this).parent().parent().children().children().next().children().children().parent().parent().parent().next().find('span').eq(2).empty().prepend(newSellPrice_txt);  //편집된 sellPrice
                        //alert($(this).parent().parent().find('.selectedOption_list_sellPriceNumberAmount').html()); //숫자 갯수만큼 sellPrice
                        $(this).parent().parent().find('.selectedOption_list_sellPriceNumberAmount').empty().prepend(newSellPrice);  //숫자상태의 갯수만큼의 sellPrice
                        $(this).parent().parent().find('.selectedOption_list_originPriceNumberAmount').empty().prepend(newOriginPrice);  //숫자상태의 갯수만큼의 originPrice
                        var totalAmount_txt = formatNumber(totalAmountSellPrice);      //총상품금액 : 함수를 불러 편집한다.
                        $('.totalAmountNumber').empty().append(totalAmountSellPrice); //총상품금액란에 숫자 내용을 넣는다(계산시 사용을 위해서)
                        $('#totalAmount').empty().append(totalAmount_txt);  //총상품금액란에 내용을 넣는다
                    });
                });


                //옵션선택 리스트에서 "X"마크를 눌렀을때
                var currentTotalAmountNumber = 0;
                var currentSellPricexx = 0;
                var totalAmountSellPricexx = 0;
                var totalAmount_txt = 0;
                $('.xButton').unbind().click(function () {      //***여기서는 반드시 unbind()를 사용해야함. 그렇지않을 경우 두번 루핑을 돈다***
                    currentTotalAmountNumber = $('.totalAmountNumber').text();//현상태의 총상품금액
                    //alert("currentTotalAmountNumber= " + currentTotalAmountNumber); //
                    //alert($(this).parent().parent().parent().parent().children().next().next().closest('.selectedOption_list_sellPriceNumberAmount').html());
                    currentSellPricexx = $(this).parent().parent().parent().parent().children().next().next().closest('.selectedOption_list_sellPriceNumberAmount').html(); //현 상태의 갯수만큼의 숫자
                    //alert("currentSellPricexx= ", + currentSellPricexx);        //
                    totalAmountSellPricexx = parseFloat(currentTotalAmountNumber) - parseFloat(currentSellPricexx);
                    //alert("parseFloat(currentTotalAmountNumber)" + parseFloat(currentTotalAmountNumber));  //
                    //alert("parseFloat(currentSellPricexx)" + parseFloat(currentSellPricexx)); //
                    //alert("totalAmountSellPricexx= ", + totalAmountSellPricexx); //
                    totalAmount_txt = formatNumber(totalAmountSellPricexx);      //함수를 불러 편집한다.
                    $('.totalAmountNumber').empty().append(totalAmountSellPricexx); //총상품금액란에 숫자 내용을 넣는다(계산시 사용을 위해서)
                    $('#totalAmount').empty().append(totalAmount_txt);  //총상품금액란에 내용을 넣는다
                    //alert($(this).parent().parent().parent().parent().parent().html());
                    $(this).parent().parent().parent().parent().parent().remove();
                    if (totalAmountSellPricexx == 0) {
                        addOptionSw = false; //선택된 옵션 상품이 하나도 없으니 false로 만든다
                        $('.amount_option').hide();
                    }
                });


                //옵션 상품이 있는 상태에서 Add Cart(Buy Now)를 클릭해서 멀티플데이터를 처리하는 로직(테스트용)
                $('.buyNow_Click').unbind().click(function () {
                    var cnt = 0;
                    var cartInfos = [];   //cartInfos가 동일하게 controller에서도 사용해야 한다.
                    $('.selectedOption_list').each(function (index) {
                        //alert(index);
                        //alert($(this).html());
                        //alert($(this).find('.selectedOption_list_productId').html());
                        var productId = $(this).find('.selectedOption_list_productId').html().trim(); //trim추가...
                        //alert($(this).find('.orderQty').val());
                        //alert(productId);
                        var qty = $(this).find('.orderQty').val().trim(); //trim추가...
                        //alert(qty);
                        var originPrice = $(this).find('.selectedOption_list_originPriceNumber').html().trim();
                        var sellPrice = $(this).find('.selectedOption_list_sellPriceNumber').html().trim();
                        //alert(originPrice + '   ' + sellPrice);
                        cartInfos.push({
                            "productId": productId,
                            "quantity": qty,
                            "originPrice": originPrice,
                            "sellPrice": sellPrice
                        });

                        cnt++;
                        //debugger;
                    });

                    //alert(cnt);
                    if (cnt < 1) {
                        alert("선택하신 상품이 없습니다...");
                        return;
                    }

                    //cartInfos가 동일하게 controller에서도 사용해야 한다.
                    //어레이 형태로 콘트롤에 보내고 싶으면 이부분을 코멘트할것
                    cartInfos = JSON.stringify({ 'cartInfos': cartInfos });
                    //alert(cartInfos);
                    $.ajax({
                        //contentType: 'application/json; charset=utf-8', //어레이 형태로 콘트롤에 보내고 싶으면 이부분을 코멘트할것
                        //dataType: 'json',  //어레이 형태로 콘트롤에 보내고 싶으면 이부분을 코멘트할것
                        type: 'POST',
                        contentType: "json",
                        processData: false,
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        url: '/shoppingcart/addToCartByMultiItems',
                        data: cartInfos,  //cartInfos가 동일하게 controller에서도 사용해야 한다.//어레이 형태로 콘트롤에 보내고 싶으면 이부분을 코멘트할것
                        //data: { arr: cartInfos },  //어레이 형태로 콘트롤에 보내고 싶으면 이부분을 사용할것
                        cache: false,
                        async: false,
                        success: function (data) {
                            if (data != 1) {
                                alert("'/shoppingcart/addToCartByMultiItems data = " + data + " 연결후 에러...");
                            }
                            else {
                                displayNumInCart2();  //Add Cart를 누른후 장바구니 메뉴에 현재 장바구니에 들어있는 총 건수를 보여준다.

                                $m('#dialogForCart').dialog({
                                    autoOpen: true, modal: true, resizable: false, draggable: false,
                                    closeOnEscape: false,
                                    open: function (event, ui) { $(".ui-dialog-titlebar-close").hide(); },
                                    show: {
                                        //effect: "blind",
                                        //duration: 1000
                                    },
                                    hide: {
                                        effect: "explode",
                                        duration: 1000
                                    },
                                    buttons: {
                                        "계속쇼핑하기": function () {
                                            $m(this).dialog("close");
                                            $m('.addCart_Click').prop('disabled', false);
                                        },
                                        "장바구니로": function () {
                                            $m(this).dialog("close");
                                            $m('.addCart_Click').prop('disabled', false)
                                            //window.open('/ShoppingCarts/CartList'); //이렇게 하면 새로운 창이 뜬다...
                                            window.location.href = '/shoppingcart/cartList';
                                        }
                                    }
                                });
                            }
                            //debugger;
                        },
                        error: function (data) {
                            alert("'/shoppingcart/addToCartByMultiItems data = " + data + " 시스템에러...");
                            //debugger;
                        }
                    });
                    return false;  /////////////////
                });

            });
        });

        //장바구니에 들어있는 총건수를 구하여 장바구니 메뉴 옆에 보여준다
        //세션값을 가져온다...중요한 예제임.....
        function displayNumInCart2() {
            //세션값을 가져온다...중요한 예제임.....
            var isLogin = "<?php echo (Auth::guest());?>";

            if (isLogin != true) //로그인이 된 상태이면 수행한다.
            {
                $.ajax({
                    type: "Post",
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    url: "/home/countInCart",
                    //data: { emailName: email },   //emailName 은 콘트롤에서 똑같이 사용해야 한다..
                    cache: false,
                    success: function (data) {
                        if (data.success == true) {
                            numOfProducts = data.count;
                            //alert(numOfProducts);
                            $('.num_cart').empty().append(numOfProducts);
                        }
                    },
                    error: function (data) {
                        alert("/home/countInCart 시스템에러 장바구니 속 상품수...");
                    }
                });
            }
        }

        //편집하는 함수
        function formatNumber(num) {
            return num.toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, "$1,")
        }

        //선택된 옵션 상품이 있는지 체크...
        $('.buyNow_Click').click(function () {
            if (addOptionSw == false) {
                alert("선택하신 상품이 없습니다...");
            }
        });
    });
</script>


<!--관심상품 클릭-->
<script>
    $(function () {
        $('.interestProduct').click(function () {
            var isLogin = "<?php echo (Auth::guest());?>";
            if (isLogin != true) {
                $('.interestProductChild').show()
            }
            else {   //아래 attr을 주어야 모달이 열린다...
                $(this).attr("data-toggle", "modal");
                $(this).attr("data-target", "#dialogForLogin2");
                $('#dialogForLogin2').modal(show); //show를 넣어야함
            }
        });
    });

    //관심상품 창이 열린 상테에서 창 닫기(X)마크 누르면 창을 숨긴다
    $('.interestProductChildX').click(function () {
        $('.interestProductChild').hide()
    });

    //로그인 창에서 확인 키를 눌렀으면 로그인 실행
    $(function () {
        $('#form').submit(function (e) {

            e.preventDefault();

            token = $('input[name=_token]').val().trim();

            $.ajax({
                method: 'post',
                url: '/login/loginAjax', 
                headers: { 'X-CSRF-TOKEN': token },
                data: {
                    email: $('#txtEmail2').val().trim(),
                    password: $('#txtPassword2').val().trim()
                },
                cache: false,
                async: false,
                success: function (data) {
                    if (data == 1) {
                        alert("로그인이 되었습니다...");
                        window.location.reload();
                    }
                    else
                        if (data == 0) {
                            alert("로그인에 실패 했습니다...");
                        }
                        else {
                            //alert(data); //data를 end user에게 보여주지 않는다.10/04/2019
                            alert("로그인되었으나 내부 에러...");
                        }
                },
                error: function (data) {
                    alert('시스템에러.../login/loginAjax')
                }
            });
        });
    });
</script>


<!--JQuery UI사용시 conflict가 발생하여 $m으로 재정의 하였음-->
<script type="text/javascript">
    $m = jQuery.noConflict();

    $m(function () {

        $m('#dialogForCart').dialog({ autoOpen: false });
       
    });
</script>

<!--Add Cart 클릭시 처리 로직-->
<script>
    $m(function () {
        $m('.addCart_Click').click(function () {
            productId = $m('.hidden_productId').text().trim();  //위에서 숨긴 값...
            originPrice = $m('.originPriceAjax').text().trim();
            sellPrice = $m('.sellPriceAjax').text().trim();
            //alert(sellPrice + '    ' + originPrice);
            $m(this).prop('disabled', true);
            $m.ajax({
                type: "Post",
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: "/shoppingcart/addToCart",
                data: { productId: productId, quantity: 1, originPrice: originPrice, sellPrice: sellPrice },
                cash: false,  //
                async: false,  //
                success: function (data) {
                    if (data != 1) {
                        alert("/shoppingcart/addToCart = " + data + " 연결 후 에러...");
                    }
                    else {
                        displayNumInCart(); //Add Cart를 누른후 장바구니 메뉴에 현재 장바구니에 들어있는 총 건수를 보여준다.

                        $m('#dialogForCart').dialog({
                            autoOpen: true, modal: true, resizable: false, draggable: false,
                            closeOnEscape: false,
                            open: function(event, ui) { $(".ui-dialog-titlebar-close").hide(); },
                            //position: [($m(window).width() / 2) - (dialogWidth / 2), 150],
                            //position: 'top',
                            //position:[-500,-500],
                            //position: { my: 'center', at: 'center-500' },
                            //position: ['center', 'top+100'],
                            //position: { my: "left top", at: "left bottom", of: button },
                            show: {
                                //effect: "blind",
                                //duration: 1000
                            },
                            hide: {
                                effect: "explode",
                                duration: 1000
                            },
                            buttons: {
                                "계속쇼핑하기": function () {
                                    $m(this).dialog("close");
                                    $m('.addCart_Click').prop('disabled', false);
                                },
                                "장바구니로": function () {
                                    $m(this).dialog("close");
                                    $m('.addCart_Click').prop('disabled', false)
                                    //window.open('/ShoppingCarts/CartList'); //이렇게 하면 새로운 창이 뜬다...
                                    window.location.href = '/shoppingcart/cartList';
                                }
                            }
                        });
                    }
                },
                error: function (data) {
                    alert("/shoppingcart/addToCart 시스템에러...");
                }
            });
            return false;  /////////////////////////////
        });

        //장바구니에 들어있는 총건수를 구하여 장바구니 메뉴 옆에 보여준다
        //세션값을 가져온다...중요한 예제임.....
        function displayNumInCart() {
            //세션값을 가져온다...중요한 예제임.....
            var isLogin = "<?php echo (Auth::guest());?>";

            if (isLogin != true) //로그인 된 상태이면
            {
                $.ajax({
                    type: "Post",
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    url: "/home/countInCart",
                    cache: false,
                    //data: { emailName: email },  //emailName 은 콘트롤에서 똑같이 사용해야 한다.
                    success: function (data) {
                        if (data.success == true) {
                            numOfProducts = data.count;
                            //alert(numOfProducts);
                            $('.num_cart').empty().append(numOfProducts);
                        }
                    },
                    error: function (data) {
                        alert("/home/countInCart 시스템에러 장바구니 속 상품수...");
                    }
                });
            }
        }
    });
</script>

@endsection