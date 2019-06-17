@extends('layouts.app')

@section('title')

Home-index

@endsection

@section('content')

<!-- myStyles -->
<link href="/myCss/mySlick.css" rel="stylesheet" />
<link href="/myCss/myHomeIndex.css" rel="stylesheet" />

<div class="container"> 
    
    <!--proctuct에 딸린 pcitures를 보여주는 예제-->
    <!--Home controller index function에서 $products 값이 온다(test 용)-->   
    <!--{{--@foreach($products as $product)
         {{ $product->modelName }}  //왼쪽 문장 사용시 div(예를 들면) tag와 함께 사용 할 것     
        @foreach($product->pictures as $picture)            
            <div style="width: 222px; height: 330px; border: 1px solid rgba(128, 128, 128, 0.56); word-break: break-all; float: left;">{{ $picture->fileName }}</div>            
        @endforeach
        @endforeach--}}-->
    <!-- ---------------------------------------------------------------------------------------------------- -->
     
    <!--메뉴바 바로 밑에 있는 큰 Box로 왼쪽은 수직으로 된 메뉴가 있고 오른 쪽은 큰 그림의 carousel이 있다--> 
    <div class="row top_upper" style="margin-left: -15px;margin-right: 30px;">
        <!--상단 왼쪽 수직 박스메뉴-->
        <!--아래 class에 list-group 추가 on 26/02/2019 추가 전 하고 차이 없음. 지켜 보는 중.-->
        <div class="col-sm-3 col-md-3 col-lg-3 leftSideMenu list-group">
            <!--아래 class category01_sum category02_sum category03_sum ...category10_sum 들은 -->
            <!--우측의 펼쳐진 메뉴(카루셀 위에 펼치는 서부 메뉴) 에서도 같은 class 이름을 사용. 왜냐 면-->
            <!--mouseover, mouseout을 콘트롤 할때 사용하기 위해...-->
            <a href="#" class="list-group-item  color_blue category01 category01_sum">
                <b>브랜드패션</b>
            </a>
            <a href="#" class="list-group-item  color_blue category02 category02_sum">
                <b>패션의류.잡화.뷰티</b>
            </a>
            <a href="#" class="list-group-item  color_blue category03 category03_sum">
                <b>유아동</b>
            </a>
            <a href="#" class="list-group-item  color_blue category04 category04_sum">
                <b>식품.생필품</b>
            </a>
            <a href="#" class="list-group-item  color_blue category05 category05_sum">
                <b>홈테코.문구.취미</b>
            </a>
            <a href="#" class="list-group-item  color_blue category06 category06_sum">
                <b>컴퓨터.디지털.가전</b>
            </a>
            <a href="#" class="list-group-item  color_blue category07 category07_sum">
                <b>스포츠.건강</b>
            </a>
            <a href="#" class="list-group-item  color_blue category08 category08_sum">
                <b>자동차.공구</b>
            </a>
            <a href="#" class="list-group-item  color_blue category09 category09_sum">
                <b>여행.도서.티켓.e쿠폰</b>
            </a>
            <a href="#" class="list-group-item  color_blue category10 category10_sum">
                <b>기타</b>
            </a>
        </div> <!--상단 왼쪽 박스메뉴 끝-->

        <!--상단 오른쪽 메인 카루셀-->
        <div class="col-sm-9 col-md-9 col-lg-9" style="padding-right: 0px; padding-left: 0px;">
            <div class="row carousel_margin_right">
                <div id="my-carousel" class="carousel slide" data-ride="carousel">
                    <ol class="carousel-indicators">
                        <li data-target="#my-carousel" data-slide-to="0" class="active"></li>
                        <li data-target="#my-carousel" data-slide-to="1"></li>
                        <li data-target="#my-carousel" data-slide-to="2"></li>
                        <li data-target="#my-carousel" data-slide-to="3"></li>
                    </ol>
                    <div class="carousel-inner">
                        <div class="item active">
                            <a href="#">
                                <img src="http://hdkwonnz.cdn2.cafe24.com/imageOwner/carousel01.JPG" class="img-responsive" style="width:100%; height:370px;" />
                            </a>
                            <div class="carousel-caption">
                                <h2></h2>
                            </div>
                        </div>
                        <div class="item">
                            <a href="#">
                                <img src="http://hdkwonnz.cdn2.cafe24.com/imageOwner/carousel02.JPG" class="img-responsive" style="width:100%; height:370px;" />
                            </a>
                            <div class="carousel-caption">
                                <h2></h2>
                            </div>
                        </div>
                        <div class="item">
                            <a href="#">
                                <img src="http://hdkwonnz.cdn2.cafe24.com/imageOwner/carousel03.JPG" class="img-responsive" style="width:100%; height:370px;" />
                            </a>
                            <div class="carousel-caption">
                                <h2></h2>
                            </div>
                        </div>
                        <div class="item">
                            <a href="#">
                                <img src="http://hdkwonnz.cdn2.cafe24.com/imageOwner/carousel04.JPG" class="img-responsive" style="width:100%; height:370px;" />
                            </a>
                            <div class="carousel-caption">
                                <h2></h2>
                            </div>
                        </div>
                    </div>
                    <a class="left carousel-control" href="#my-carousel" data-slide="prev">
                        <span class="glyphicon glyphicon-chevron-left"></span>
                    </a>
                    <a class="right carousel-control" href="#my-carousel" data-slide="next">
                        <span class="glyphicon glyphicon-chevron-right"></span>
                    </a>
                </div><!--상단 오른쪽 메인 카루셀-->

                <!--카테고리메뉴 처음에는 숨겨 놓고 메뉴에 마우스온하면 펼친다 
                    myHomeIndex.css, myCtategorySub.js 참조-->
                <!--노란색 바탕화면에 왼쪽에 텍스트메뉴와 오른쪽에 광고사진이 나타난다 -->
                <!--브랜드패션-->
                <div id="category01Sub" class="categorySubBox">
                    <div class="category01SubArea category01_sum">
                        <div class="row">
                            <!--텍스트 메뉴-->
                            <div class="col-sm-7 col-md-7 col-lg-7">
                                <div class="row">
                                    <!--$categoryas는 HomeController에서 넘어옴-->
                                    <?php
                                    foreach ($categoryas as $item)
                                    {
                                        if ($item->id == 1)
                                        {
                                    ?>
                                    <div class="col-sm-3 col-md-3 col-lg-3" style="margin-top: 20px; margin-left: 0px;">
                                        <span>
                                            <b>
                                                <?=$item->name?>
                                            </b>
                                        </span>
                                    </div>
                                    <!--$categorybs는 $categoryas와 데이터베이스categoryb 와의 관계설정을
                                        기반으로(모델참조: hasMany) 추출 된 것 임-->
                                    <div class="col-sm-5 col-md-5 col-lg-5" style="margin-top: 20px; margin-left: 0px;">
                                        <?php
                                            $categorybs = $item->categorybs;
                                            foreach ($categorybs as $item2)
                                            {
                                                if ($item->id == $item2->categorya_id)
                                                {
                                        ?>
                                        <div style="">
                                            <a href="/product/categoryBmenu/<?=$item2->categorya_id?>/<?=$item2->id?>/<?=$item2->name?>" target="_blank">
                                                <span class="bMenuName">
                                                    <?=$item2->name?>
                                                </span>
                                                <br />
                                            </a>
                                        </div><?php
                                                }
                                            }
                                              ?>
                                    </div>
                                    <div class="col-sm-4 col-md-4 col-lg-4" style="background: rgba(128, 128, 128, 0.19); min-height: 410px;">
                                        <div style="margin-top: 20px; margin-left: 20px;">
                                            <span>
                                                <b>인기브랜드</b>
                                            </span>
                                            <div style="margin-top: 20px;">
                                                <?php
                                            foreach ($categorybs as $item2)
                                            {
                                                if ($item->id == $item2->categorya_id)
                                                {
                                                ?>
                                                <div style="">
                                                    <a href="/product/categoryBmenu/<?=$item2->categorya_id?>/<?=$item2->id?>/<?=$item2->name?>" target="_blank">
                                                        <span class="bMenuName">
                                                            <?=$item2->name?>
                                                        </span>
                                                        <br />
                                                    </a>
                                                </div><?php
                                                }
                                            }
                                                      ?>
                                            </div>
                                        </div>
                                    </div><?php
                                        }
                                    }
                                          ?>
                                </div>
                            </div>
                            <!--광고 사진-->
                            <div class="col-sm-5 col-md-5 col-lg-5">
                                <div class="col-sm-12 col-md-12 col-lg-12">
                                    <a href="#">
                                        <img class="margin_top20" src="http://hdkwonnz.cdn2.cafe24.com/imageSeller/catesubad01.JPG" />
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div><!--class="category01SubArea category01_sum"-->
                </div><!--브랜드패션 class="categorySubBox-->

                <!--패션의류.잡화.뷰티-->
                <div id="category02Sub" class="categorySubBox">
                    <div class="category02SubArea category02_sum">
                        <div class="row">
                            <div class="col-sm-7 col-md-7 col-lg-7">
                                <div class="row">
                                    <?php
                                    foreach ($categoryas as $item)
                                    {
                                        //한화면에 두개의 카테고리를 보여줄경우 categorya_id(2 다음에 3이런식으로)는 순서별로 찾아주어야 한다
                                        if ($item->id == 2)
                                        {
                                    ?>
                                    <div class="col-sm-3 col-md-3 col-lg-3" style="margin-top: 20px; margin-left: 0px;">
                                        <span>
                                            <b>
                                                <?=$item->name?>
                                            </b>
                                        </span>
                                    </div>
                                    <div class="col-sm-5 col-md-5 col-lg-5" style="margin-top: 20px; margin-left: 0px;">
                                        <?php
                                            $categorybs = $item->categorybs;
                                            foreach ($categorybs as $item2)
                                            {
                                                if ($item->id == $item2->categorya_id)
                                                {
                                        ?>
                                        <div style="">
                                            <a href="/product/categoryBmenu/<?=$item2->categorya_id?>/<?=$item2->id?>/<?=$item2->name?>" target="_blank">
                                                <span class="bMenuName">
                                                    <?=$item2->name?>
                                                </span>
                                                <br />
                                            </a>
                                        </div>
                                        <?php
                                                }
                                            }
                                        ?>
                                    </div>
                                    <div class="col-sm-4 col-md-4 col-lg-4" style="background: rgba(128, 128, 128, 0.19); min-height: 0px;">
                                        <div style="margin-top: 20px; margin-left: 20px;">
                                            <span>
                                                <b>인기브랜드</b>
                                            </span>
                                            <div style="margin-top: 20px;">
                                                <?php
                                            foreach ($categorybs as $item2)
                                            {
                                                if ($item->id == $item2->categorya_id)
                                                {
                                                ?>
                                                <div style="">
                                                    <a href="/product/categoryBmenu/<?=$item2->categorya_id?>/<?=$item2->id?>/<?=$item2->name?>" target="_blank">
                                                        <span class="bMenuName">
                                                            <?=$item2->name?>
                                                        </span>
                                                        <br />
                                                    </a>
                                                </div>
                                                <?php
                                                }
                                            }
                                                ?>
                                            </div>
                                        </div>
                                    </div>
                                    <?php
                                        }
                                    }
                                    ?>

                                    <?php
                                    foreach ($categoryas as $item)
                                    {
                                        if ($item->id == 3)
                                        {
                                    ?>
                                    <div class="col-sm-3 col-md-3 col-lg-3" style="margin-top: 20px; margin-left: 0px;">
                                        <span>
                                            <b>
                                                <?=$item->name?>
                                            </b>
                                        </span>
                                    </div>
                                    <div class="col-sm-5 col-md-5 col-lg-5" style="margin-top: 20px; margin-left: 0px;">
                                        <?php
                                            $categorybs = $item->categorybs;
                                            foreach ($categorybs as $item2)
                                            {
                                                if ($item->id == $item2->categorya_id)
                                                {
                                        ?>
                                        <div style="">
                                            <a href="/product/categoryBmenu/<?=$item2->categorya_id?>/<?=$item2->id?>/<?=$item2->name?>" target="_blank">
                                                <span class="bMenuName">
                                                    <?=$item2->name?>
                                                </span>
                                                <br />
                                            </a>
                                        </div>
                                        <?php
                                                }
                                            }
                                        ?>
                                    </div><!--아래 min-height는 수작업으로 계산헸으니 겨우에따라 바꾸어줄것-->
                                    <div class="col-sm-4 col-md-4 col-lg-4" style="background: rgba(128, 128, 128, 0.19); min-height: 270px;">
                                        <div style="margin-top: 20px; margin-left: 20px;">
                                            <span>
                                                <b>인기브랜드</b>
                                            </span>
                                            <div style="margin-top: 20px;">
                                                <?php
                                            $categorybs = $item->categorybs;
                                            foreach ($categorybs as $item2)
                                            {
                                                if ($item->id == $item2->categorya_id)
                                                {
                                                ?>
                                                <div style="">
                                                    <a href="/product/categoryBmenu/<?=$item2->categorya_id?>/<?=$item2->id?>/<?=$item2->name?>" target="_blank">
                                                        <span class="bMenuName">
                                                            <?=$item2->name?>
                                                        </span>
                                                        <br />
                                                    </a>
                                                </div>
                                                <?php
                                                }
                                            }
                                                ?>
                                            </div>
                                        </div>
                                    </div>
                                    <?php
                                        }
                                    }
                                    ?>
                                </div>
                            </div>
                            <div class="col-sm-5 col-md-5 col-lg-5">
                                <div class="col-sm-12 col-md-12 col-lg-12">
                                    <a href="#">
                                        <img class="margin_top20" src="http://hdkwonnz.cdn2.cafe24.com/imageSeller/catesubad02.JPG" />
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div><!--class="category02SubArea category02_sum"-->
                </div><!--패션의류.잡화.뷰티 class="categorySubBox"-->

                <!--유아동-->
                <div id="category03Sub" class="categorySubBox">
                    <div class="category03SubArea category03_sum">
                        <div class="row">
                            <div class="col-sm-7 col-md-7 col-lg-7">
                                <div class="row">
                                    <?php
                                    foreach ($categoryas as $item)
                                    {
                                        if ($item->id == 4)
                                        {
                                    ?>
                                    <div class="col-sm-3 col-md-3 col-lg-3" style="margin-top: 20px; margin-left: 0px;">
                                        <span>
                                            <b>
                                                <?=$item->name?>
                                            </b>
                                        </span>
                                    </div>
                                    <div class="col-sm-5 col-md-5 col-lg-5" style="margin-top: 20px; margin-left: 0px;">
                                        <?php
                                            $categorybs = $item->categorybs;
                                            foreach ($categorybs as $item2)
                                            {
                                                if ($item->id == $item2->categorya_id)
                                                {
                                        ?>
                                        <div style="">
                                            <a href="/product/categoryBmenu/<?=$item2->categorya_id?>/<?=$item2->id?>/<?=$item2->name?>" target="_blank">
                                                <span class="bMenuName">
                                                    <?=$item2->name?>
                                                </span>
                                                <br />
                                            </a>
                                        </div>
                                        <?php
                                                }
                                            }
                                        ?>
                                    </div>
                                    <div class="col-sm-4 col-md-4 col-lg-4" style="background: rgba(128, 128, 128, 0.19); min-height: 410px;">
                                        <div style="margin-top: 20px; margin-left: 20px;">
                                            <span>
                                                <b>인기브랜드</b>
                                            </span>
                                            <div style="margin-top: 20px;">
                                                <?php
                                            foreach ($categorybs as $item2)
                                            {
                                                if ($item->id == $item2->categorya_id)
                                                {
                                                ?>
                                                <div style="">
                                                    <a href="/product/categoryBmenu/<?=$item2->categorya_id?>/<?=$item2->id?>/<?=$item2->name?>" target="_blank">
                                                        <span class="bMenuName">
                                                            <?=$item2->name?>
                                                        </span>
                                                        <br />
                                                    </a>
                                                </div>
                                                <?php
                                                }
                                            }
                                                ?>
                                            </div>
                                        </div>
                                    </div>
                                    <?php
                                        }
                                    }
                                    ?>
                                </div>
                            </div>
                            <div class="col-sm-5 col-md-5 col-lg-5">
                                <div class="col-sm-12 col-md-12 col-lg-12">
                                    <a href="#">
                                        <img class="margin_top20" src="http://hdkwonnz.cdn2.cafe24.com/imageSeller/catesubad01.JPG" />
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div><!--class="category03SubArea category03_sum"-->
                </div><!--유아동 class="categorySubBox"-->

                <!--식품,생필품-->
                <div id="category04Sub" class="categorySubBox">
                    <div class="category04SubArea category04_sum">
                        <div class="row">
                            <div class="col-sm-7 col-md-7 col-lg-7">
                                <div class="row">
                                    <?php
                                    foreach ($categoryas as $item)
                                    {
                                        //한화면에 두개의 카테고리를 보여줄경우 CategoryAId(5 다음에 6이런식으로)는 순서별로 찾아주어야 한다
                                        if ($item->id == 5)
                                        {
                                    ?>
                                    <div class="col-sm-3 col-md-3 col-lg-3" style="margin-top: 20px; margin-left: 0px;">
                                        <span>
                                            <b>
                                                <?=$item->name?>
                                            </b>
                                        </span>
                                    </div>
                                    <div class="col-sm-5 col-md-5 col-lg-5" style="margin-top: 20px; margin-left: 0px;">
                                        <?php
                                            $categorybs = $item->categorybs;
                                            foreach ($categorybs as $item2)
                                            {
                                                if ($item->id == $item2->categorya_id)
                                                {
                                        ?>
                                        <div style="">
                                            <a href="/product/categoryBmenu/<?=$item2->categorya_id?>/<?=$item2->id?>/<?=$item2->name?>" target="_blank">
                                                <span class="bMenuName">
                                                    <?=$item2->name?>
                                                </span>
                                                <br />
                                            </a>
                                        </div>
                                        <?php
                                                }
                                            }
                                        ?>
                                    </div>
                                    <div class="col-sm-4 col-md-4 col-lg-4" style="background: rgba(128, 128, 128, 0.19); min-height: 0px;">
                                        <div style="margin-top: 20px; margin-left: 20px;">
                                            <span>
                                                <b>인기브랜드</b>
                                            </span>
                                            <div style="margin-top: 20px;">
                                                <?php
                                            foreach ($categorybs as $item2)
                                            {
                                                if ($item->id == $item2->categorya_id)
                                                {
                                                ?>
                                                <div style="">
                                                    <a href="/product/categoryBmenu/<?=$item2->categorya_id?>/<?=$item2->id?>/<?=$item2->name?>" target="_blank">
                                                        <span class="bMenuName">
                                                            <?=$item2->name?>
                                                        </span>
                                                        <br />
                                                    </a>
                                                </div>
                                                <?php
                                                }
                                            }
                                                ?>
                                            </div>
                                        </div>
                                    </div>
                                    <?php
                                        }
                                    }
                                    ?>

                                    <?php
                                    foreach ($categoryas as $item)
                                    {
                                        if ($item->id == 6)
                                        {
                                    ?>
                                    <div class="col-sm-3 col-md-3 col-lg-3" style="margin-top: 20px; margin-left: 0px;">
                                        <span>
                                            <b>
                                                <?=$item->name?>
                                            </b>
                                        </span>
                                    </div>
                                    <div class="col-sm-5 col-md-5 col-lg-5" style="margin-top: 20px; margin-left: 0px;">
                                        <?php
                                            $categorybs = $item->categorybs;
                                            foreach ($categorybs as $item2)
                                            {
                                                if ($item->id == $item2->categorya_id)
                                                {
                                        ?>
                                        <div style="">
                                            <a href="/product/categoryBmenu/<?=$item2->categorya_id?>/<?=$item2->id?>/<?=$item2->name?>" target="_blank">
                                                <span class="bMenuName">
                                                    <?=$item2->name?>
                                                </span>
                                                <br />
                                            </a>
                                        </div>
                                        <?php
                                                }
                                            }
                                        ?>
                                    </div><!--아래 min-height는 수작업으로 계산헸으니 겨우에따라 바꾸어줄것-->
                                    <div class="col-sm-4 col-md-4 col-lg-4" style="background: rgba(128, 128, 128, 0.19); min-height: 270px;">
                                        <div style="margin-top: 20px; margin-left: 20px;">
                                            <span>
                                                <b>인기브랜드</b>
                                            </span>
                                            <div style="margin-top: 20px;">
                                                <?php
                                            foreach ($categorybs as $item2)
                                            {
                                                if ($item->id == $item2->categorya_id)
                                                {
                                                ?>
                                                <div style="">
                                                    <a href="/product/categoryBmenu/<?=$item2->categorya_id?>/<?=$item2->id?>/<?=$item2->name?>" target="_blank">
                                                        <span class="bMenuName">
                                                            <?=$item2->name?>
                                                        </span>
                                                        <br />
                                                    </a>
                                                </div>
                                                <?php
                                                }
                                            }
                                                ?>
                                            </div>
                                        </div>
                                    </div>
                                    <?php
                                        }
                                    }
                                    ?>
                                </div>
                            </div>
                            <div class="col-sm-5 col-md-5 col-lg-5">
                                <div class="col-sm-12 col-md-12 col-lg-12">
                                    <a href="#">
                                        <img class="margin_top20" src="/imageSeller/catesubad02.JPG" />
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div><!--식품,생필품-->

                <!--홈데코.문구.취미-->
                <div id="category05Sub" class="categorySubBox">
                    <div class="category05SubArea category05_sum">
                        <div class="row">
                            <div class="col-sm-7 col-md-7 col-lg-7">
                                <div class="row">
                                    <?php
                                    foreach ($categoryas as $item)
                                    {
                                        //한화면에 두개의 카테고리를 보여줄경우 CategoryAId(5 다음에 6이런식으로)는 순서별로 찾아주어야 한다
                                        if ($item->id == 7)
                                        {
                                    ?>
                                    <div class="col-sm-3 col-md-3 col-lg-3" style="margin-top: 20px; margin-left: 0px;">
                                        <span>
                                            <b>
                                                <?=$item->name?>
                                            </b>
                                        </span>
                                    </div>
                                    <div class="col-sm-5 col-md-5 col-lg-5" style="margin-top: 20px; margin-left: 0px;">
                                        <?php
                                            $categorybs = $item->categorybs;
                                            foreach ($categorybs as $item2)
                                            {
                                                if ($item->id == $item2->categorya_id)
                                                {
                                        ?>
                                        <div style="">
                                            <a href="/product/categoryBmenu/<?=$item2->categorya_id?>/<?=$item2->id?>/<?=$item2->name?>" target="_blank">
                                                <span class="bMenuName">
                                                    <?=$item2->name?>
                                                </span>
                                                <br />
                                            </a>
                                        </div>
                                        <?php
                                                }
                                            }
                                        ?>
                                    </div>
                                    <div class="col-sm-4 col-md-4 col-lg-4" style="background: rgba(128, 128, 128, 0.19); min-height: 0px;">
                                        <div style="margin-top: 20px; margin-left: 20px;">
                                            <span>
                                                <b>인기브랜드</b>
                                            </span>
                                            <div style="margin-top: 20px;">
                                                <?php
                                            foreach ($categorybs as $item2)
                                            {
                                                if ($item->id == $item2->categorya_id)
                                                {
                                                ?>
                                                <div style="">
                                                    <a href="/product/categoryBmenu/<?=$item2->categorya_id?>/<?=$item2->id?>/<?=$item2->name?>" target="_blank">
                                                        <span class="bMenuName">
                                                            <?=$item2->name?>
                                                        </span>
                                                        <br />
                                                    </a>
                                                </div>
                                                <?php
                                                }
                                            }
                                                ?>
                                            </div>
                                        </div>
                                    </div>
                                    <?php
                                        }
                                    }
                                    ?>

                                    <?php
                                    foreach ($categoryas as $item)
                                    {
                                        if ($item->id == 9)
                                        {
                                    ?>
                                    <div class="col-sm-3 col-md-3 col-lg-3" style="margin-top: 20px; margin-left: 0px;">
                                        <span>
                                            <b>
                                                <?=$item->name?>
                                            </b>
                                        </span>
                                    </div>
                                    <div class="col-sm-5 col-md-5 col-lg-5" style="margin-top: 20px; margin-left: 0px;">
                                        <?php
                                            $categorybs = $item->categorybs;
                                            foreach ($categorybs as $item2)
                                            {
                                                if ($item->id == $item2->categorya_id)
                                                {
                                        ?>
                                        <div style="">
                                            <a href="/product/categoryBmenu/<?=$item2->categorya_id?>/<?=$item2->id?>/<?=$item2->name?>" target="_blank">
                                                <span class="bMenuName">
                                                    <?=$item2->name?>
                                                </span>
                                                <br />
                                            </a>
                                        </div>
                                        <?php
                                                }
                                            }
                                        ?>
                                    </div><!--아래 min-height는 수작업으로 계산헸으니 겨우에따라 바꾸어줄것-->
                                    <div class="col-sm-4 col-md-4 col-lg-4" style="background: rgba(128, 128, 128, 0.19); min-height: 230px;">
                                        <div style="margin-top: 20px; margin-left: 20px;">
                                            <span>
                                                <b>인기브랜드</b>
                                            </span>
                                            <div style="margin-top: 20px;">
                                                <?php
                                            foreach ($categorybs as $item2)
                                            {
                                                if ($item->id == $item2->categorya_id)
                                                {
                                                ?>
                                                <div style="">
                                                    <a href="/product/categoryBmenu/<?=$item2->categorya_id?>/<?=$item2->id?>/<?=$item2->name?>" target="_blank">
                                                        <span class="bMenuName">
                                                            <?=$item2->name?>
                                                        </span>
                                                        <br />
                                                    </a>
                                                </div>
                                                <?php
                                                }
                                            }
                                                ?>
                                            </div>
                                        </div>
                                    </div>
                                    <?php
                                        }
                                    }
                                    ?>
                                </div>
                            </div>
                            <div class="col-sm-5 col-md-5 col-lg-5">
                                <div class="col-sm-12 col-md-12 col-lg-12">
                                    <a href="#">
                                        <img class="margin_top20" src="http://hdkwonnz.cdn2.cafe24.com/imageSeller/catesubad02.JPG" />
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div><!--홈데코.문구.취미-->

                <!--컴퓨터.디지털.가전-->
                <div id="category06Sub" class="categorySubBox">
                    <div class="category06SubArea category06_sum">
                        <div class="row">
                            <div class="col-sm-7 col-md-7 col-lg-7">
                                <div class="row">
                                    <?php
                                    foreach ($categoryas as $item)
                                    {
                                        //한화면에 두개의 카테고리를 보여줄경우 CategoryAId(5 다음에 6이런식으로)는 순서별로 찾아주어야 한다
                                        if ($item->id == 14)
                                        {
                                    ?>
                                    <div class="col-sm-3 col-md-3 col-lg-3" style="margin-top: 20px; margin-left: 0px;">
                                        <span>
                                            <b>
                                                <?=$item->name?>
                                            </b>
                                        </span>
                                    </div>
                                    <div class="col-sm-5 col-md-5 col-lg-5" style="margin-top: 20px; margin-left: 0px;">
                                        <?php
                                            $categorybs = $item->categorybs;
                                            foreach ($categorybs as $item2)
                                            {
                                                if ($item->id == $item2->categorya_id)
                                                {
                                        ?>
                                        <div style="">
                                            <a href="/product/categoryBmenu/<?=$item2->categorya_id?>/<?=$item2->id?>/<?=$item2->name?>" target="_blank">
                                                <span class="bMenuName">
                                                    <?=$item2->name?>
                                                </span>
                                                <br />
                                            </a>
                                        </div>
                                        <?php
                                                }
                                            }
                                        ?>
                                    </div>
                                    <div class="col-sm-4 col-md-4 col-lg-4" style="background: rgba(128, 128, 128, 0.19); min-height: 0px;">
                                        <div style="margin-top: 20px; margin-left: 20px;">
                                            <span>
                                                <b>인기브랜드</b>
                                            </span>
                                            <div style="margin-top: 20px;">
                                                <?php
                                            foreach ($categorybs as $item2)
                                            {
                                                if ($item->id == $item2->categorya_id)
                                                {
                                                ?>
                                                <div style="">
                                                    <a href="/product/categoryBmenu/<?=$item2->categorya_id?>/<?=$item2->id?>/<?=$item2->name?>" target="_blank">
                                                        <span class="bMenuName">
                                                            <?=$item2->name?>
                                                        </span>
                                                        <br />
                                                    </a>
                                                </div>
                                                <?php
                                                }
                                            }
                                                ?>
                                            </div>
                                        </div>
                                    </div>
                                    <?php
                                        }
                                    }
                                    ?>

                                    <?php
                                    foreach ($categoryas as $item)
                                    {
                                        if ($item->id == 13)
                                        {
                                    ?>
                                    <div class="col-sm-3 col-md-3 col-lg-3" style="margin-top: 5px; margin-left: 0px;">
                                        <span>
                                            <b>
                                                <?=$item->name?>
                                            </b>
                                        </span>
                                    </div>
                                    <div class="col-sm-5 col-md-5 col-lg-5" style="margin-top: 5px; margin-left: 0px;">
                                        <?php
                                            $categorybs = $item->categorybs;
                                            foreach ($categorybs as $item2)
                                            {
                                                if ($item->id == $item2->categorya_id)
                                                {
                                        ?>
                                        <div style="">
                                            <a href="/product/categoryBmenu/<?=$item2->categorya_id?>/<?=$item2->id?>/<?=$item2->name?>" target="_blank">
                                                <span class="bMenuName">
                                                    <?=$item2->name?>
                                                </span>
                                                <br />
                                            </a>
                                        </div>
                                        <?php
                                                }
                                            }
                                        ?>
                                    </div><!--아래 min-height는 수작업으로 계산헸으니 겨우에따라 바꾸어줄것-->
                                    <div class="col-sm-4 col-md-4 col-lg-4" style="background: rgba(128, 128, 128, 0.19); min-height: 270px;">
                                        <div style="margin-top: 20px; margin-left: 20px;">
                                            <span>
                                                <b>인기브랜드</b>
                                            </span>
                                            <div style="margin-top: 20px;">
                                                <?php
                                            foreach ($categorybs as $item2)
                                            {
                                                if ($item->id == $item2->categorya_id)
                                                {
                                                ?>
                                                <div style="">
                                                    <a href="/product/categoryBmenu/<?=$item2->categorya_id?>/<?=$item2->id?>/<?=$item2->name?>" target="_blank">
                                                        <span class="bMenuName">
                                                            <?=$item2->name?>
                                                        </span>
                                                        <br />
                                                    </a>
                                                </div>
                                                <?php
                                                }
                                            }
                                                ?>
                                            </div>
                                        </div>
                                    </div>
                                    <?php
                                        }
                                    }
                                    ?>

                                    <?php
                                    foreach ($categoryas as $item)
                                    {
                                        if ($item->categoryAId == 12)
                                        {
                                    ?>
                                    <div class="col-sm-3 col-md-3 col-lg-3" style="margin-top: 20px; margin-left: 0px;">
                                        <span>
                                            <b>
                                                <?=$item->name?>
                                            </b>
                                        </span>
                                    </div>
                                    <div class="col-sm-5 col-md-5 col-lg-5" style="margin-top: 20px; margin-left: 0px;">
                                        <?php
                                            $categorybs = $item->categorybs;
                                            foreach ($categorybs as $item2)
                                            {
                                                if ($item->id == $item2->categorya_id)
                                                {
                                        ?>
                                        <div style="">
                                            <a href="/product/categoryBmenu/<?=$item2->categorya_id?>/<?=$item2->id?>/<?=$item2->name?>" target="_blank">
                                                <span class="bMenuName">
                                                    <?=$item2->name?>
                                                </span>
                                                <br />
                                            </a>
                                        </div>
                                        <?php
                                                }
                                            }
                                        ?>
                                    </div><!--아래 min-height는 수작업으로 계산헸으니 겨우에따라 바꾸어줄것-->
                                    <div class="col-sm-4 col-md-4 col-lg-4" style="background: rgba(128, 128, 128, 0.19); min-height: 185px;">
                                        <div style="margin-top: 5px; margin-left: 20px;">
                                            <span>
                                                <b>인기브랜드</b>
                                            </span>
                                            <div style="margin-top: 0px;">
                                                <?php
                                            foreach ($categorybs as $item2)
                                            {
                                                if ($item->id == $item2->categorya_id)
                                                {
                                                ?>
                                                <div style="">
                                                    <a href="/product/categoryBmenu/<?=$item2->categorya_id?>/<?=$item2->id?>/<?=$item2->name?>" target="_blank">
                                                        <span class="bMenuName">
                                                            <?=$item2->name?>
                                                        </span>
                                                        <br />
                                                    </a>
                                                </div>
                                                <?php
                                                }
                                            }
                                                ?>
                                            </div>
                                        </div>
                                    </div>
                                    <?php
                                        }
                                    }
                                    ?>
                                </div>
                            </div>
                            <div class="col-sm-5 col-md-5 col-lg-5">
                                <div class="col-sm-12 col-md-12 col-lg-12">
                                    <a href="#">
                                        <img class="margin_top20" src="http://hdkwonnz.cdn2.cafe24.com/imageSeller/catesubad02.JPG" />
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div><!--컴퓨터.디지털.가전-->

                <!--스포츠.건강-->
                <div id="category07Sub" class="categorySubBox">
                    <div class="category07SubArea category07_sum">
                        <div class="row">
                            <div class="col-sm-7 col-md-7 col-lg-7">
                                <div class="row">
                                    <?php
                                    foreach ($categoryas as $item)
                                    {
                                        //한화면에 두개의 카테고리를 보여줄경우 CategoryAId(5 다음에 6이런식으로)는 순서별로 찾아주어야 한다
                                        if ($item->id == 10)
                                        {
                                    ?>
                                    <div class="col-sm-3 col-md-3 col-lg-3" style="margin-top: 20px; margin-left: 0px;">
                                        <span>
                                            <b>
                                                <?=$item->name?>
                                            </b>
                                        </span>
                                    </div>
                                    <div class="col-sm-5 col-md-5 col-lg-5" style="margin-top: 20px; margin-left: 0px;">
                                        <?php
                                            $categorybs = $item->categorybs;
                                            foreach ($categorybs as $item2)
                                            {
                                                if ($item->id == $item2->categorya_id)
                                                {
                                        ?>
                                        <div style="">
                                            <a href="/product/categoryBmenu/<?=$item2->categorya_id?>/<?=$item2->id?>/<?=$item2->name?>" target="_blank">
                                                <span class="bMenuName">
                                                    <?=$item2->name?>
                                                </span>
                                                <br />
                                            </a>
                                        </div>
                                        <?php
                                                }
                                            }
                                        ?>
                                    </div>
                                    <div class="col-sm-4 col-md-4 col-lg-4" style="background: rgba(128, 128, 128, 0.19); min-height: 0px;">
                                        <div style="margin-top: 20px; margin-left: 20px;">
                                            <span>
                                                <b>인기브랜드</b>
                                            </span>
                                            <div style="margin-top: 20px;">
                                                <?php
                                            foreach ($categorybs as $item2)
                                            {
                                                if ($item->id == $item2->categorya_id)
                                                {
                                                ?>
                                                <div style="">
                                                    <a href="/product/categoryBmenu/<?=$item2->categorya_id?>/<?=$item2->id?>/<?=$item2->name?>" target="_blank">
                                                        <span class="bMenuName">
                                                            <?=$item2->name?>
                                                        </span>
                                                        <br />
                                                    </a>
                                                </div>
                                                <?php
                                                }
                                            }
                                                ?>
                                            </div>
                                        </div>
                                    </div>
                                    <?php
                                        }
                                    }
                                    ?>

                                    <?php
                                    foreach ($categoryas as $item)
                                    {
                                        if ($item->id == 8)
                                        {
                                    ?>
                                    <div class="col-sm-3 col-md-3 col-lg-3" style="margin-top: 20px; margin-left: 0px;">
                                        <span>
                                            <b>
                                                <?=$item->name?>
                                            </b>
                                        </span>
                                    </div>
                                    <div class="col-sm-5 col-md-5 col-lg-5" style="margin-top: 20px; margin-left: 0px;">
                                        <?php
                                            $categorybs = $item->categorybs;
                                            foreach ($categorybs as $item2)
                                            {
                                                if ($item->id == $item2->categorya_id)
                                                {
                                        ?>
                                        <div style="">
                                            <a href="/product/categoryBmenu/<?=$item2->categorya_id?>/<?=$item2->id?>/<?=$item2->name?>" target="_blank">
                                                <span class="bMenuName">
                                                    <?=$item2->name?>
                                                </span>
                                                <br />
                                            </a>
                                        </div>
                                        <?php
                                                }
                                            }
                                        ?>
                                    </div><!--아래 min-height는 수작업으로 계산헸으니 겨우에따라 바꾸어줄것-->
                                    <div class="col-sm-4 col-md-4 col-lg-4" style="background: rgba(128, 128, 128, 0.19); min-height: 210px;">
                                        <div style="margin-top: 20px; margin-left: 20px;">
                                            <span>
                                                <b>인기브랜드</b>
                                            </span>
                                            <div style="margin-top: 20px;">
                                                <?php
                                            foreach ($categorybs as $item2)
                                            {
                                                if ($item->id == $item2->categorya_id)
                                                {
                                                ?>
                                                <div style="">
                                                    <a href="/product/categoryBmenu/<?=$item2->categorya_id?>/<?=$item2->id?>/<?=$item2->name?>" target="_blank">
                                                        <span class="bMenuName">
                                                            <?=$item2->name?>
                                                        </span>
                                                        <br />
                                                    </a>
                                                </div>
                                                <?php
                                                }
                                            }
                                                ?>
                                            </div>
                                        </div>
                                    </div>
                                    <?php
                                        }
                                    }
                                    ?>
                                </div>
                            </div>
                            <div class="col-sm-5 col-md-5 col-lg-5">
                                <div class="col-sm-12 col-md-12 col-lg-12">
                                    <a href="#">
                                        <img class="margin_top20" src="http://hdkwonnz.cdn2.cafe24.com/imageSeller/catesubad02.JPG" />
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div><!--스포츠.건강-->

                <!--자동차.공구-->
                <div id="category08Sub" class="categorySubBox">
                    <div class="category08SubArea category08_sum">
                        <div class="row">
                            <div class="col-sm-7 col-md-7 col-lg-7">
                                <div class="row">
                                    <?php
                                    foreach ($categoryas as $item)
                                    {
                                        if ($item->id == 11)
                                        {
                                    ?>
                                    <div class="col-sm-3 col-md-3 col-lg-3" style="margin-top: 20px; margin-left: 0px;">
                                        <span>
                                            <b>
                                                <?=$item->name?>
                                            </b>
                                        </span>
                                    </div>
                                    <div class="col-sm-5 col-md-5 col-lg-5" style="margin-top: 20px; margin-left: 0px;">
                                        <?php
                                            $categorybs = $item->categorybs;
                                            foreach ($categorybs as $item2)
                                            {
                                                if ($item->id == $item2->categorya_id)
                                                {
                                        ?>
                                        <div style="">
                                            <a href="/product/categoryBmenu/<?=$item2->categorya_id?>/<?=$item2->id?>/<?=$item2->name?>" target="_blank">
                                                <span class="bMenuName">
                                                    <?=$item2->name?>
                                                </span>
                                                <br />
                                            </a>
                                        </div>
                                        <?php
                                                }
                                            }
                                        ?>
                                    </div>
                                    <div class="col-sm-4 col-md-4 col-lg-4" style="background: rgba(128, 128, 128, 0.19); min-height: 410px;">
                                        <div style="margin-top: 20px; margin-left: 20px;">
                                            <span>
                                                <b>인기브랜드</b>
                                            </span>
                                            <div style="margin-top: 20px;">
                                                <?php
                                            foreach ($categorybs as $item2)
                                            {
                                                if ($item->id == $item2->categorya_id)
                                                {
                                                ?>
                                                <div style="">
                                                    <a href="/product/categoryBmenu/<?=$item2->categorya_id?>/<?=$item2->id?>/<?=$item2->name?>" target="_blank">
                                                        <span class="bMenuName">
                                                            <?=$item2->name?>
                                                        </span>
                                                        <br />
                                                    </a>
                                                </div>
                                                <?php
                                                }
                                            }
                                                ?>
                                            </div>
                                        </div>
                                    </div>
                                    <?php
                                        }
                                    }
                                    ?>
                                </div>
                            </div>
                            <div class="col-sm-5 col-md-5 col-lg-5">
                                <div class="col-sm-12 col-md-12 col-lg-12">
                                    <a href="#">
                                        <img class="margin_top20" src="http://hdkwonnz.cdn2.cafe24.com/imageSeller/catesubad01.JPG" />
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div><!--자동차.공구-->

                <!--여행.도서.티켓.e쿠폰-->
                <div id="category09Sub" class="categorySubBox">
                    <div class="category09SubArea category09_sum">
                        <div class="row">
                            <div class="col-sm-7 col-md-7 col-lg-7">
                                <div class="row">
                                    <?php
                                    foreach ($categoryas as $item)
                                    {
                                        //한화면에 두개의 카테고리를 보여줄경우 CategoryAId(5 다음에 6이런식으로)는 순서별로 찾아주어야 한다
                                        if ($item->id == 15)
                                        {
                                    ?>
                                    <div class="col-sm-3 col-md-3 col-lg-3" style="margin-top: 20px; margin-left: 0px;">
                                        <span>
                                            <b>
                                                <?=$item->name?>
                                            </b>
                                        </span>
                                    </div>
                                    <div class="col-sm-5 col-md-5 col-lg-5" style="margin-top: 20px; margin-left: 0px;">
                                        <?php
                                            $categorybs = $item->categorybs;
                                            foreach ($categorybs as $item2)
                                            {
                                                if ($item->id == $item2->categorya_id)
                                                {
                                        ?>
                                        <div style="">
                                            <a href="/product/categoryBmenu/<?=$item2->categorya_id?>/<?=$item2->id?>/<?=$item2->name?>" target="_blank">
                                                <span class="bMenuName">
                                                    <?=$item2->name?>
                                                </span>
                                                <br />
                                            </a>
                                        </div>
                                        <?php
                                                }
                                            }
                                        ?>
                                    </div>
                                    <div class="col-sm-4 col-md-4 col-lg-4" style="background: rgba(128, 128, 128, 0.19); min-height: 0px;">
                                        <div style="margin-top: 20px; margin-left: 20px;">
                                            <span>
                                                <b>인기브랜드</b>
                                            </span>
                                            <div style="margin-top: 20px;">
                                                <?php
                                            foreach ($categorybs as $item2)
                                            {
                                                if ($item->id == $item2->categorya_id)
                                                {
                                                ?>
                                                <div style="">
                                                    <a href="/product/categoryBmenu/<?=$item2->categorya_id?>/<?=$item2->id?>/<?=$item2->name?>" target="_blank">
                                                        <span class="bMenuName">
                                                            <?=$item2->name?>
                                                        </span>
                                                        <br />
                                                    </a>
                                                </div>
                                                <?php
                                                }
                                            }
                                                ?>
                                            </div>
                                        </div>
                                    </div>
                                    <?php
                                        }
                                    }
                                    ?>

                                    <?php
                                    foreach ($categoryas as $item)
                                    {
                                        if ($item->id == 16)
                                        {
                                    ?>
                                    <div class="col-sm-3 col-md-3 col-lg-3" style="margin-top: 20px; margin-left: 0px;">
                                        <span>
                                            <b>
                                                <?=$item->name?>
                                            </b>
                                        </span>
                                    </div>
                                    <div class="col-sm-5 col-md-5 col-lg-5" style="margin-top: 20px; margin-left: 0px;">
                                        <?php
                                            $categorybs = $item->categorybs;
                                            foreach ($categorybs as $item2)
                                            {
                                                if ($item->id == $item2->categorya_id)
                                                {
                                        ?>
                                        <div style="">
                                            <a href="/product/categoryBmenu/<?=$item2->categorya_id?>/<?=$item2->id?>/<?=$item2->name?>" target="_blank">
                                                <span class="bMenuName">
                                                    <?=$item2->name?>
                                                </span>
                                                <br />
                                            </a>
                                        </div>
                                        <?php
                                                }
                                            }
                                        ?>
                                    </div><!--아래 min-height는 수작업으로 계산헸으니 겨우에따라 바꾸어줄것-->
                                    <div class="col-sm-4 col-md-4 col-lg-4" style="background: rgba(128, 128, 128, 0.19); min-height: 310px;">
                                        <div style="margin-top: 20px; margin-left: 20px;">
                                            <span>
                                                <b>인기브랜드</b>
                                            </span>
                                            <div style="margin-top: 20px;">
                                                <?php
                                            foreach ($categorybs as $item2)
                                            {
                                                if ($item->id == $item2->categorya_id)
                                                {
                                                ?>
                                                <div style="">
                                                    <a href="/product/categoryBmenu/<?=$item2->categorya_id?>/<?=$item2->id?>/<?=$item2->name?>" target="_blank">
                                                        <span class="bMenuName">
                                                            <?=$item2->name?>
                                                        </span>
                                                        <br />
                                                    </a>
                                                </div>
                                                <?php
                                                }
                                            }
                                                ?>
                                            </div>
                                        </div>
                                    </div>
                                    <?php
                                        }
                                    }
                                    ?>
                                </div>
                            </div>
                            <div class="col-sm-5 col-md-5 col-lg-5">
                                <div class="col-sm-12 col-md-12 col-lg-12">
                                    <a href="#">
                                        <img class="margin_top20" src="http://hdkwonnz.cdn2.cafe24.com/imageSeller/catesubad02.JPG" />
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div><!--여행.도서.티켓.e쿠폰-->
                       
            </div><!--row--><!--상단 오른쪽 메인 카루셀 밑에 있는 row-->

            <!--메인 카루셀 밑에있는 가로로 나열된 메뉴-->
            <div class="row main_carousel_bottom">
                <div class="col-sm-12 col-md-12 col-lg-12">
                    <div class="col-sm-2 col-md-2 col-lg-2">
                        <a href="#">GUITAR</a>
                    </div>
                    <div class="col-sm-2 col-md-2 col-lg-2">
                        <a href="#">DRUM/PERC.</a>
                    </div>
                    <div class="col-sm-2 col-md-2 col-lg-2">
                        <a href="#">PIANO/KEYB.</a>
                    </div>
                    <div class="col-sm-2 col-md-2 col-lg-2">
                        <a href="#">STRING</a>
                    </div>
                    <div class="col-sm-2 col-md-2 col-lg-2">
                        <a href="#">WIND</a>
                    </div>
                    <div class="col-sm-2 col-md-2 col-lg-2">
                        <a href="#">OTHER</a>
                    </div>
                </div><!--row 바로 밑-->
            </div><!--row--><!--메인 카루셀 밑에있는 가로 메뉴-->
        </div><!--상단 오른쪽 메인 카루셀-->
    </div><!--상단 왼쪽 세로메뉴와 상단 오른 쪽 큰 카루셀-->

    <br />

    <a href="#"><h4 class="color_red" style="margin-left:-15px;">A Market BEST ></h4></a>

    <!--G마켓 베스트 carousel(화면 좌측)과 스마일배송 광고(화면 우측)-->
    <div class="row">
        <!--G마켓 베스트-->
        <div class="col-md-8" style="margin-left:-30px; margin-right:0px;">
            <!--아래 오른쪽 data-interval을 "0"으로 놓으면 자동 sliding이 없어진다.-->
            <!--2초마다 슬라이딩 원할시 "2000"을 넣는다.-->
            <div id="carousel-g-market-best" class="carousel slide" data-interval="0"
                 data-ride="carousel" data-pause="hover" data-wrap="true">
                <!-- Indicators -->
                <ol class="carousel-indicators">
                <li data-target="#carousel-g-market-best" data-slide-to="0" class="active"></li>
                <li data-target="#carousel-g-market-best" data-slide-to="1"></li>
                <li data-target="#carousel-g-market-best" data-slide-to="2"></li>
                </ol>

                <!-- Wrapper for slides -->
                <div class="carousel-inner" role="listbox">
                    <div class="item active">
                        <div class="raw">
                            <div class="col-md-4">
                                <a href="javascript:void(0)">
                                    <img src="/uploadFiles/pictures/sellers/LG코드제로A9.JPG" alt="..." class="img-responsive" />
                                    <div class="carousel-caption">
                                        <h3></h3>
                                        <p></p>
                                    </div>
                                </a>
                                <br/>
                                <div>이곳에 상품 이름 과 가격이 들어갈 예정 이곳에 상품 제목 가격이 들어갈 예정</div>
                                <div><b>989,000</b>원</div>                           
                            </div>                           
                            <div class="col-md-4">
                                <a href="javascript:void(0)">
                                    <img src="/uploadFiles/pictures/sellers/글램공감.JPG" alt="..." class="img-responsive" />
                                    <div class="carousel-caption">
                                        <h3></h3>
                                        <p></p>
                                    </div>
                                </a>
                                 <br/>
                                <div>이곳에 상품 이름 과 가격이 들어갈 예정 이곳에 상품 제목 가격이 들어갈 예정</div>
                                <div><b>89,000</b>원</div>                            
                            </div>
                            <div class="col-md-4">
                                <a href="javascript:void(0)">
                                    <img src="/uploadFiles/pictures/sellers/디베아F7.JPG" alt="..." class="img-responsive" />
                                    <div class="carousel-caption">
                                        <h3></h3>
                                        <p></p>
                                    </div>
                                </a>
                                 <br/>
                                <div>이곳에 상품 이름 과 가격이 들어갈 예정 이곳에 상품 제목 가격이 들어갈 예정</div>
                                <div><b>189,000</b>원</div>                               
                            </div>
                        </div>                
                    </div>
                    <div class="item">
                        <div class="raw">
                            <div class="col-md-4">
                                <a href="javascript:void(0)">
                                    <img src="/uploadFiles/pictures/sellers/마츠 봄신상.JPG" alt="..." class="img-responsive" />
                                    <div class="carousel-caption">
                                        <h3></h3>
                                        <p></p>
                                    </div>
                                </a>
                                 <br/>
                                <div>이곳에 상품 이름 과 가격이 들어갈 예정 이곳에 상품 제목 가격이 들어갈 예정</div>
                                <div><b>9,900</b>원</div> 
                            </div>
                            <div class="col-md-4">
                                <a href="javascript:void(0)">
                                    <img src="/uploadFiles/pictures/sellers/봄신상.JPG" alt="..." class="img-responsive" />
                                    <div class="carousel-caption">
                                        <h3></h3>
                                        <p></p>
                                    </div>
                                </a>
                                 <br/>
                                <div>이곳에 상품 이름 과 가격이 들어갈 예정 이곳에 상품 제목 가격이 들어갈 예정</div>
                                <div><b>8,900</b>원</div> 
                            </div>
                            <div class="col-md-4">
                                <a href="javascript:void(0)">
                                    <img src="/uploadFiles/pictures/sellers/제로위니스.JPG" alt="..." class="img-responsive" />
                                    <div class="carousel-caption">
                                        <h3></h3>
                                        <p></p>
                                    </div>
                                </a>
                                 <br/>
                                <div>이곳에 상품 이름 과 가격이 들어갈 예정 이곳에 상품 제목 가격이 들어갈 예정</div>
                                <div><b>228,100</b>원</div> 
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Controls -->
                <a class="left carousel-control" href="#carousel-g-market-best" role="button" data-slide="prev">
                    <div class="glyphicon glyphicon-chevron-left" aria-hidden="true" style="margin-left:-45px;"></div>
                    <div class="sr-only">Previous</div>
                </a>
                <a class="right carousel-control" href="#carousel-g-market-best" role="button" data-slide="next">
                    <div class="glyphicon glyphicon-chevron-right" aria-hidden="true" style="margin-right: 0px;"></div>
                    <div class="sr-only">Next</div>
                </a>
            </div><!--G마켓 베스트 바로 밑에 있는 div-->
        </div> <!--G마켓 베스트-->

        <!--smile 배송 광고-->
        <div class="col-md-4" style="padding-left:0px; padding-right:15px;">
            <a href="javascript:void(0)">
                <img  src="/uploadFiles/pictures/sellers/smile배송.JPG" alt="..." class="img-responsive" + 
                      style="width: 220px; height: 280px; border: 1px solid rgba(128, 128, 128, 0.56); float:right;"/>                                
            </a>
        </div><!--smile 배송 광고-->
    </div><!--row-->

    <br/>
    
    <!--롯데백화점 신세계백화점 현대백화점 홈플러스당일배송 스마트배송 해외직구-->
    <div class="row">
        <!--백화점 이름 보여주기-->
        <div class="home_shopping_name" style="margin-right: 15px;margin-left:-30px;">
            <div class="col-sm-2 col-md-2 col-lg-2 text-center">
            <a href="javascript:void(0)">
                <span class="lotte_on name_on no_decoration" style="font-size: 20px; opacity: 0.5;">롯데백화점</span>
                <span class="arrow_go" style="font-size: 20px;"><i class="glyphicon glyphicon-chevron-right"></i></span>
            </a>      
            </div>
            <div class="col-sm-2 col-md-2 col-lg-2 text-center">
                <a href="javascript:void(0)">
                    <span class="name_on no_decoration" style="font-size: 20px; opacity: 0.5;">신세계백화점</span>
                    <span class="arrow_go" style="font-size: 20px; display: none;"><i class="glyphicon glyphicon-chevron-right"></i></span>
                </a>       
            </div>
            <div class="col-sm-2 col-md-2 col-lg-2 text-center">
                <a href="javascript:void(0)">
                    <span class="name_on no_decoration" style="font-size: 20px; opacity: 0.5;">현대백화점</span>
                    <span class="arrow_go" style="font-size: 20px; display: none;"><i class="glyphicon glyphicon-chevron-right"></i></span>
                </a>       
            </div>
            <div class="col-sm-2 col-md-2 col-lg-2 text-center">
                <a href="javascript:void(0)">
                    <span class="name_on no_decoration" style="font-size: 20px; opacity: 0.5;">홈플러스배송</span>
                    <span class="arrow_go" style="font-size: 20px; display: none;"><i class="glyphicon glyphicon-chevron-right"></i></span>
                </a>        
            </div>
            <div class="col-sm-2 col-md-2 col-lg-2 text-center">
                <a href="javascript:void(0)">
                    <span class="name_on no_decoration" style="font-size: 20px; opacity: 0.5;">스마트배송</span>
                    <span class="arrow_go" style="font-size: 20px; display: none;"><i class="glyphicon glyphicon-chevron-right"></i></span>
                </a>       
            </div>
            <div class="col-sm-2 col-md-2 col-lg-2 text-center">
                <a href="javascript:void(0)">
                    <span class="name_on no_decoration" style="font-size: 20px; opacity: 0.5;">해외직구</span>
                    <span class="arrow_go" style="font-size: 20px; display: none;"><i class="glyphicon glyphicon-chevron-right"></i></span>
                </a>        
            </div>
        </div><!--백화점 이름 보여주기-->        
    </div><!--row-->

    <!--위의 메뉴 밑에 보여줄 밑줄(숨겨 놓았다 마우스오버하면 보여준다)-->
    <div class="row">
        <div style="margin-right: 15px;margin-left:-30px;">
            <div class="col-sm-2 col-md-2 col-lg-2 text-center" style="margin-left: 15px;">
                <div class="under_bar" style="border:2px solid #ff6a00; z-index: 2; top: 0px; position: relative; width:125px;"></div>               
            </div>
            <div class="col-sm-2 col-md-2 col-lg-2 text-center">
                <div class="under_bar" style="border:2px solid #00ff21; z-index: 2; top: 0px; position: relative; display: none; width:135px;"></div>               
            </div>
            <div class="col-sm-2 col-md-2 col-lg-2 text-center">
                <div class="under_bar" style="border:2px solid #fffa00; z-index: 2; top: 0px; position: relative; display: none; width:125px;"></div>  
            </div>
            <div class="col-sm-2 col-md-2 col-lg-2 text-center">
                <div class="under_bar" style="border:2px solid #00ffff; z-index: 2; top: 0px; position: relative; display: none; width:135px;"></div>                
            </div>
            <div class="col-sm-2 col-md-2 col-lg-2 text-center">
                <div class="under_bar" style="border:2px solid #b200ff; z-index: 2; top: 0px; position: relative; display: none; width:130px;"></div>                
            </div>
            <!--아래는 col을 1 로 하였음. 2 로하면 밑줄이 밀려서 롯데백화점 밑으로 감...-->
            <div class="col-sm-1 col-md-1 col-lg-1 text-center" style="margin-left: 15px;">
                <div class="under_bar" style="border:2px solid #0026ff; z-index: 2; top: 0px; position: relative; display: none; width:105px;"></div>             
            </div>
        </div><!--row 바로 밑 div-->      
    </div><!--row--><!--이름밑에 밑줄 긎기-->
   
    <!--위의 메뉴에 해당하는 카루셀을 숨겨놓고 메뉴에 마우스온하면 해당화면을 보여준다-->
    <div class="row" style="margin-right:30px;margin-left:-15px;">
        <div class="col-sm-12 col-md-12 col-lg-12" style="background-color:rgba(128, 128, 128, 0.19);">           
            <div style="width: 100%; height: 320px;">
                <!--백화점 보여주기-->
                <div id="home_shopping_show" class="carousel slide" data-ride="carousel" data-interval="0">
                    <ol class="carousel-indicators">
                        <li data-target="#home_shopping_show" data-slide-to="0" class="active"></li>
                        <li data-target="#home_shopping_show" data-slide-to="1"></li>
                        <li data-target="#home_shopping_show" data-slide-to="2"></li>
                        <li data-target="#home_shopping_show" data-slide-to="3"></li>
                        <li data-target="#home_shopping_show" data-slide-to="4"></li>
                        <li data-target="#home_shopping_show" data-slide-to="5"></li>
                    </ol>
                    <div class="carousel-inner">
                        <div class="item active">
                            <a href="javascript:void(0)">
                                <!--<img src="http://hdkwonnz.cdn2.cafe24.com/imageOwner/carousel01.JPG" class="img-responsive" style="width:100%; height:370px;" />-->
                                <img src="/uploadFiles/pictures/sellers/GS프레쉬.JPG" alt="..." class="img-responsive" />
                            </a>
                            <div class="carousel-caption">
                                <h2></h2>
                            </div>
                        </div>
                        <div class="item">
                            <a href="javascript:void(0)">
                                <!--<img src="http://hdkwonnz.cdn2.cafe24.com/imageOwner/carousel02.JPG" class="img-responsive" style="width:100%; height:370px;" />-->
                                <img src="/uploadFiles/pictures/sellers/롯데슈퍼.JPG" alt="..." class="img-responsive" />
                            </a>
                            <div class="carousel-caption">
                                <h2></h2>
                            </div>
                        </div>
                        <div class="item">
                            <a href="javascript:void(0)">
                                <!--<img src="http://hdkwonnz.cdn2.cafe24.com/imageOwner/carousel03.JPG" class="img-responsive" style="width:100%; height:370px;" />-->
                                <img src="/uploadFiles/pictures/sellers/홈플러스.JPG" alt="..." class="img-responsive" />
                            </a>
                            <div class="carousel-caption">
                                <h2></h2>
                            </div>
                        </div>
                        <div class="item">
                            <a href="javascript:void(0)">
                                <!--<img src="http://hdkwonnz.cdn2.cafe24.com/imageOwner/carousel04.JPG" class="img-responsive" style="width:100%; height:370px;" />-->
                                <img src="/uploadFiles/pictures/sellers/롯데홈쇼핑.JPG" alt="..." class="img-responsive" />
                            </a>
                            <div class="carousel-caption">
                                <h2></h2>
                            </div>
                        </div>
                        <div class="item">
                            <a href="javascript:void(0)">
                                <!--<img src="http://hdkwonnz.cdn2.cafe24.com/imageOwner/carousel04.JPG" class="img-responsive" style="width:100%; height:370px;" />-->
                                <img src="/uploadFiles/pictures/sellers/CJ오쇼핑.JPG" alt="..." class="img-responsive" />
                            </a>
                            <div class="carousel-caption">
                                <h2></h2>
                            </div>
                        </div>
                        <div class="item">
                            <a href="javascript:void(0)">
                                <!--<img src="http://hdkwonnz.cdn2.cafe24.com/imageOwner/carousel04.JPG" class="img-responsive" style="width:100%; height:370px;" />-->
                                <img src="/uploadFiles/pictures/sellers/스마일배송2.JPG" alt="..." class="img-responsive" />
                            </a>
                            <div class="carousel-caption">
                                <h2></h2>
                            </div>
                        </div>
                    </div><!--carousel-inner-->
                    <a class="left carousel-control" href="#home_shopping_show" data-slide="prev">
                        <!--<span class="glyphicon glyphicon-chevron-left"></span>--><!--클릭시 under core-->
                        <dav class="glyphicon glyphicon-chevron-left"></dav><!--제거를 위해 span=>div-->
                    </a>
                    <a class="right carousel-control" href="#home_shopping_show" data-slide="next">
                        <!--<span class="glyphicon glyphicon-chevron-right"></span>--><!--클릭시 under core-->
                        <div class="glyphicon glyphicon-chevron-right"></div><!--제거를 위해 span=>div-->
                    </a>
                </div><!--백화점 보여 주기-->
            </div><!--백화점들 감싸고 있는 박스 div tag-->
        </div><!--row 바로 밑 div-->
    </div><!--row--><!--lotte_show-->
         
    <!--긴 그림 상자-->
    <div class="row" style="margin-top: 20px; margin-right: 15px ;margin-left:-30px;">
        <div class="col-sm-12 col-md-12 col-lg-12">
            <a href="javascript:void(0)"><img class="width100" src="http://hdkwonnz.cdn2.cafe24.com/imageSeller/midle01.JPG" /> </a>
        </div>
    </div><!--긴 그림 상자-->

    <!--중간 굵은 가로 선-->
    <div class="col-sm-12 col-md-12 col-lg-12" style="margin-left:-30px; padding-right: 0px;">
        <br/>
        <div style="border:2px solid black;"></div>
        <br/>
    </div><!--중간 굵은 가로 선-->

    <!--슈퍼딜 여러 아이콘들-->
    <div class="row" style="margin-right: 15px;">
        <div class="col-sm-4 col-md-4 col-lg-4">
            <a href="javascript:void(0)">
                <img src="http://hdkwonnz.cdn2.cafe24.com/imageOwner/super_deal_logo.JPG" />
            </a>
        </div>
        <div class="col-sm-8 col-md-8 col-lg-8" style="text-align: right;">
            <p>
                <a href="javascript:void(0)" class="super_deal_logo_size">
                    <img src="http://hdkwonnz.cdn2.cafe24.com/imageLogo/superLogo1.JPG" />
                </a>
                <a href="javascript:void(0)" class="super_deal_logo_size">
                    <img src="http://hdkwonnz.cdn2.cafe24.com/imageLogo/superLogo2.JPG" />
                </a>
                <a href="javascript:void(0)" class="super_deal_logo_size">
                    <img src="http://hdkwonnz.cdn2.cafe24.com/imageLogo/superLogo3.JPG" />
                </a>
                <a href="javascript:void(0)" class="super_deal_logo_size">
                    <img src="http://hdkwonnz.cdn2.cafe24.com/imageLogo/superLogo5.JPG" />
                </a>
                <a href="javascript:void(0)" class="super_deal_logo_size">
                    <img src="http://hdkwonnz.cdn2.cafe24.com/imageLogo/superLogo6.JPG" />
                </a>
                <a href="javascript:void(0)" class="super_deal_logo_size">
                    <img src="http://hdkwonnz.cdn2.cafe24.com/imageLogo/superLogo7.JPG" />
                </a>
                <a href="javascript:void(0)" class="super_deal_logo_size">
                    <img src="http://hdkwonnz.cdn2.cafe24.com/imageLogo/superLogo8.JPG" />
                </a>
                <a href="javascript:void(0)" class="super_deal_logo_size">
                    <img src="http://hdkwonnz.cdn2.cafe24.com/imageLogo/superLogo9.JPG" />
                </a>
            </p>
        </div>
    </div><!--슈퍼딜 여러 아이콘들-->

    <hr style="margin-right: 30px; margin-left: -15px;"/>

    <!--슈퍼딜 다음 여러 상품들-->
    <div class="row" style="margin: 0px;">
        <div class="col-sm-4 col-md-4 col-lg-4 text-center">
            <a href="javascript:void(0)">
                <img src="http://hdkwonnz.cdn2.cafe24.com/imageSeller/sel01.JPG" class="img-responsive">
                <span class="text-center">sdsdsd/sdsdsd/sdsdsd/</span><br />
                <span class="text-center">15,000원</span>
            </a>
        </div>
        <div class="col-sm-4 col-md-4 col-lg-4 text-center">
            <a href="javascript:void(0)">
                <img src="http://hdkwonnz.cdn2.cafe24.com/imageSeller/sel02.JPG" class="img-responsive">
                <span class="text-center">sdsdsd/sdsdsd/sdsdsd/</span><br />
                <span class="text-center">20,000원</span>
            </a>
        </div>
        <div class="col-sm-4 col-md-4 col-lg-4 text-center">
            <a href="javascript:void(0)">
                <img src="http://hdkwonnz.cdn2.cafe24.com/imageSeller/sel01.JPG" class="img-responsive">
                <span class="text-center">sdsdsd/sdsdsd/sdsdsd/</span><br />
                <span class="text-center">10,000원</span>
            </a>
        </div>
    </div>

    <hr style="margin-right: 30px; margin-left: -15px;"/>

    <div class="row" style="margin: 0px;">
        <div class="col-sm-4 col-md-4 col-lg-4 text-center">
            <a href="javascript:void(0)">
                <img src="http://hdkwonnz.cdn2.cafe24.com/imageSeller/sel04.JPG" class="img-responsive">
                <span class="text-center">sdsdsd/sdsdsd/sdsdsd/</span><br />
                <span class="text-center">30,000원</span>
            </a>
        </div>
        <div class="col-sm-4 col-md-4 col-lg-4 text-center">
            <a href="javascript:void(0)">
                <img src="http://hdkwonnz.cdn2.cafe24.com/imageSeller/sel05.JPG" class="img-responsive">
                <span class="text-center">sdsdsd/sdsdsd/sdsdsd/</span><br />
                <span class="text-center">50,000원</span>
            </a>
        </div>
        <div class="col-sm-4 col-md-4 col-lg-4 text-center">
            <a href="javascript:void(0)">
                <img src="http://hdkwonnz.cdn2.cafe24.com/imageSeller/sel06.JPG" class="img-responsive">
                <span class="text-center">sdsdsd/sdsdsd/sdsdsd/</span><br />
                <span class="text-center">35,000원</span>
            </a>
        </div>
    </div>

    <hr style="margin-right: 30px; margin-left: -15px;"/>

    <div class="row" style="margin: 0px;">
        <div class="col-sm-4 col-md-4 col-lg-4 text-center">
            <a href="javascript:void(0)">
                <img src="http://hdkwonnz.cdn2.cafe24.com/imageSeller/sel01.JPG" class="img-responsive">
                <span class="text-center">sdsdsd/sdsdsd/sdsdsd/</span><br />
                <span class="text-center">25,000원</span>
            </a>
        </div>
        <div class="col-sm-4 col-md-4 col-lg-4 text-center">
            <a href="javascript:void(0)">
                <img src="http://hdkwonnz.cdn2.cafe24.com/imageSeller/sel02.JPG" class="img-responsive">
                <span class="text-center">sdsdsd/sdsdsd/sdsdsd/</span><br />
                <span class="text-center">55,000원</span>
            </a>
        </div>
        <div class="col-sm-4 col-md-4 col-lg-4 text-center">
            <a href="javascript:void(0)">
                <img src="http://hdkwonnz.cdn2.cafe24.com/imageSeller/sel06.JPG" class="img-responsive">
                <span class="text-center">sdsdsd/sdsdsd/sdsdsd/</span><br />
                <span class="text-center">17,000원</span>
            </a>
        </div>
    </div><!--슈퍼딜 다음 여러 상품들-->

    <hr style="margin-right: 30px; margin-left: -15px;"/>
    
    <div class="row" style="margin-right: 0px;">   
        <!--파워미니샾-->
        <div class="col-sm-6 col-md-6 col-lg-6">
            <h4><b>파워미니샾</b></h4>
            <div class="col-sm-11 col-md-11 col-lg-11" style="margin-left: -15px;">
                <div id="powerMiniShop-carousel" class="carousel slide" data-ride="carousel">
                    <ol class="carousel-indicators">
                        <li data-target="powerMiniShop-carousel" data-slide-to="0" class="active"></li>
                        <li data-target="powerMiniShop-carousel" data-slide-to="1"></li>                      
                    </ol>
                    <div class="carousel-inner slider2">
                        <div class="item active slider2_photo_size">
                            <a href="javascript:void(0)">
                                <img src="http://hdkwonnz.cdn2.cafe24.com/imageSeller/minishop01.JPG" class="img-responsive" style="width:100%; height:370px;" />
                            </a>
                            <div class="carousel-caption">
                                <h2></h2>
                            </div>
                        </div>
                        <div class="item slider2_photo_size">
                            <a href="javascript:void(0)">
                                <img src="http://hdkwonnz.cdn2.cafe24.com/imageSeller/minishop02.JPG" class="img-responsive" style="width:100%; height:370px;" />
                            </a>
                            <div class="carousel-caption">
                                <h2></h2>
                            </div>
                        </div>                        
                    </div>
                    <a class="left carousel-control" href="#powerMiniShop-carousel" data-slide="prev">
                        <div class="glyphicon glyphicon-chevron-left"></div>
                    </a>
                    <a class="right carousel-control" href="#powerMiniShop-carousel" data-slide="next">
                        <div class="glyphicon glyphicon-chevron-right"></div>
                    </a>
                </div><!--id="powerMiniShop-carousel"-->
            </div><!--col-11-->
            <div class="col-sm-1 col-md-1 col-lg-1"></div>
        </div><!--파워미니샾-->

        <!--특가판매-->
        <div class="col-sm-6 col-md-6 col-lg-6">
            <h4>&nbsp;&nbsp;&nbsp;&nbsp;<b>특가판매</b></></h4>
            <!--아래 오른쪽 data-interval을 "0"으로 놓으면 자동 sliding이 없어진다.-->
            <!--2초마다 슬라이딩 원할시 "2000"을 넣는다.-->
            <div id="specialSell-carousel" class="carousel slide" data-interval="2000"
                 data-ride="carousel" data-pause="hover" data-wrap="true">
                <!-- Indicators -->
                <ol class="carousel-indicators">
                <li data-target="#specialSell-carousel" data-slide-to="0" class="active"></li>
                <li data-target="#specialSell-carousel" data-slide-to="1"></li>
                <li data-target="#specialSell-carousel" data-slide-to="2"></li>
                </ol>

                <!-- Wrapper for slides -->
                <div class="carousel-inner slider3" role="listbox">
                    <div class="item active slider3_photo_size">
                        <div class="raw">
                            <div class="col-sm-4 col-md-4 col-lg-4">
                                <a href="javascript:void(0)">
                                    <img src="http://hdkwonnz.cdn2.cafe24.com/imageSeller/special01.JPG" alt="..." class="img-responsive" />
                                    <div class="carousel-caption">
                                        <h3></h3>
                                        <p></p>
                                    </div>
                                </a>                               
                            </div>
                            <div class="col-sm-4 col-md-4 col-lg-4">
                                <a href="javascript:void(0)">
                                    <img src="http://hdkwonnz.cdn2.cafe24.com/imageSeller/special02.JPG" alt="..." class="img-responsive" />
                                    <div class="carousel-caption">
                                        <h3></h3>
                                        <p></p>
                                    </div>
                                </a>                               
                            </div>
                            <div class="col-sm-4 col-md-4 col-lg-4">
                                <a href="javascript:void(0)">
                                    <img src="http://hdkwonnz.cdn2.cafe24.com/imageSeller/special03.JPG" alt="..." class="img-responsive" />
                                    <div class="carousel-caption">
                                        <h3></h3>
                                        <p></p>
                                    </div>
                                </a>                               
                            </div>
                        </div>                
                    </div><!--class="carousel-inner"-->
                    <div class="item slider3_photo_size">
                        <div class="raw">
                            <div class="col-sm-4 col-md-4 col-lg-4">
                                <a href="javascript:void(0)">
                                    <img src="http://hdkwonnz.cdn2.cafe24.com/imageSeller/special04.JPG" alt="..." class="img-responsive" />
                                    <div class="carousel-caption">
                                        <h3></h3>
                                        <p></p>
                                    </div>
                                </a>
                            </div>
                            <div class="col-sm-4 col-md-4 col-lg-4">
                                <a href="javascript:void(0)">
                                    <img src="http://hdkwonnz.cdn2.cafe24.com/imageSeller/special05.JPG" alt="..." class="img-responsive" />
                                    <div class="carousel-caption">
                                        <h3></h3>
                                        <p></p>
                                    </div>
                                </a>
                            </div>
                            <div class="col-sm-4 col-md-4 col-lg-4">
                                <a href="javascript:void(0)">
                                    <img src="http://hdkwonnz.cdn2.cafe24.com/imageSeller/special06.JPG" alt="..." class="img-responsive" />
                                    <div class="carousel-caption">
                                        <h3></h3>
                                        <p></p>
                                    </div>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Controls -->
                <a class="left carousel-control" href="#specialSell-carousel" role="button" data-slide="prev">
                    <div class="glyphicon glyphicon-chevron-left" aria-hidden="true"></div>
                    <div class="sr-only">Previous</div>
                </a>
                <a class="right carousel-control" href="#specialSell-carousel" role="button" data-slide="next">
                    <div class="glyphicon glyphicon-chevron-right" aria-hidden="true"></div>
                    <div class="sr-only">Next</div>
                </a>
            </div><!--id="specialSell-carousel"-->
        </div><!--특가판매-->
    </div><!--row-->

    <br />
    <br />

    <!--A마켓 파트너스-->
    <div class="row" style="margin-right: 0px;">
        <div class="col-sm-12 col-md-12 col-lg-12">
            <h3 class="line_height_10">A마켓 파트너스</h3>            
        </div>
    </div><!--A마켓 파트너스-->

    <hr style="margin-right: 30px; margin-left: -15px;"/>

    <div class="row" style="margin-right: 0px;">
        <div class="col-sm-2 col-md-2 col-lg-2">
             <a href="javascript:void(0)" class="partners_logo_size">
                            <img src="http://hdkwonnz.cdn2.cafe24.com/imageLogo/lotte.JPG" class="img-responsive" />
                        </a>
        </div>
        <div class="col-sm-2 col-md-2 col-lg-2">
            <a href="javascript:void(0)" class="partners_logo_size">
                            <img src="http://hdkwonnz.cdn2.cafe24.com/imageLogo/shinsege.JPG" class="img-responsive" />
                        </a>
        </div>
        <div class="col-sm-2 col-md-2 col-lg-2">
            <a href="javascript:void(0)" class="partners_logo_size">
                            <img src="http://hdkwonnz.cdn2.cafe24.com/imageLogo/hyundai.JPG" class="img-responsive" />
                        </a>
        </div>
        <div class="col-sm-2 col-md-2 col-lg-2">
            <a href="javascript:void(0)" class="partners_logo_size">
                            <img src="http://hdkwonnz.cdn2.cafe24.com/imageLogo/galleria.JPG" class="img-responsive" />
                         </a>
        </div>
        <div class="col-sm-2 col-md-2 col-lg-2">
            <a href="javascript:void(0)" class="partners_logo_size">
                            <img src="http://hdkwonnz.cdn2.cafe24.com/imageLogo/homeplus.JPG" class="img-responsive" />
                        </a>      
        </div>
        <div class="col-sm-2 col-md-2 col-lg-2">
            <a href="javascript:void(0)" class="partners_logo_size">
                            <img src="http://hdkwonnz.cdn2.cafe24.com/imageLogo/cjmall.JPG" class="img-responsive" />
                        </a>
        </div>
    </div>

    <div class="row" style="margin-right: 0px; margin-top: 20px;">
        <div class="col-sm-2 col-md-2 col-lg-2">
            <a href="javascript:void(0)" class="partners_logo_size">
                            <img src="http://hdkwonnz.cdn2.cafe24.com/imageLogo/cocacola.JPG" class="img-responsive" />
                        </a>
        </div>
        <div class="col-sm-2 col-md-2 col-lg-2">
            <a href="javascript:void(0)" class="partners_logo_size">
                            <img src="http://hdkwonnz.cdn2.cafe24.com/imageLogo/microsoft.JPG" class="img-responsive" />
                        </a>
        </div>
        <div class="col-sm-2 col-md-2 col-lg-2">
            <a href="javascript:void(0)" class="partners_logo_size">
                            <img src="http://hdkwonnz.cdn2.cafe24.com/imageLogo/sk.JPG" class="img-responsive" />
                        </a>
        </div>
        <div class="col-sm-2 col-md-2 col-lg-2">
            <a href="javascript:void(0)" class="partners_logo_size">
                            <img src="http://hdkwonnz.cdn2.cafe24.com/imageLogo/uricard.JPG" class="img-responsive" />
                        </a>
        </div>
        <div class="col-sm-2 col-md-2 col-lg-2">
            <a href="javascript:void(0)" class="partners_logo_size">
                            <img src="http://hdkwonnz.cdn2.cafe24.com/imageLogo/shinhancard.JPG" class="img-responsive" />
                        </a>
        </div>
        <div class="col-sm-2 col-md-2 col-lg-2">
            <a href="javascript:void(0)" class="partners_logo_size">
                            <img src="http://hdkwonnz.cdn2.cafe24.com/imageLogo/livart.JPG" class="img-responsive" />
                        </a>
        </div>
    </div>

    <hr style="margin-right: 30px; margin-left: -15px;"/>

    <!--알립니다-->       
    <div class="row" style="margin-right: 0px;">
        <div class="col-sm-12 col-md-12 col-lg-12">
            <div style="margin-left: 20px; font-size: 16px;">
                <a href="javascript:void(0)"><b>알립니다</b> <i class="glyphicon glyphicon-chevron-right" style="opacity: 0.5"></i></a>
                <a href="javascript:void(0)">
                    <span style="margin-left: 20px;">
                        [당첨자공지]동서식품 Travel with Maximum 이벤트 당첨자 공지
                    </span>
                </a>
                <span style="opacity: 0.5"> | 2019-12-25</span>       
            </div>
        </div>
    </div><!--알립니다-->
    
    <br/>  
    
</div><!--container--> 

<script src="/lib/jquery/jquery-2.2.3.min.js"></script>
<script src="/myJs/myCategorySub.js"></script>
<script src="/myJs/homeShopping.js"></script>
<script src="/myJs/myHomeOthers.js"></script>
<!--아래 코드를 "/myJs/myCategorySub.js"에 추가 시키면 충돌로 인하여 작동불능 -->
<script>   
</script>
@endsection
