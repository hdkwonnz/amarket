@extends('layouts.app')

@section('title')

Product-categoryBmenu

@endsection

@section('content')

<!--화면의 왼쪽 메뉴박스 스타일 쉬트-->
<style>
    a span:hover {
        text-decoration: underline;
        color: blue;
    }
</style>

<!--id, id2를 Ajax에서 사용하기위해 숨긴다: 콘트롤러에서 넘어온값이다-->
<div>
    <input type="hidden" value="<?=$id?>" id="idAjax" />
    <input type="hidden" value="<?=$id2?>" id="id2Ajax" />
</div>

<div class="row">
    <!--화면의 왼쪽 내용들...-->
    <div class="col-sm-2 col-md-2 col-lg-2">
        <!--메뉴박스 만들기-->
        <div style="width: 100%; height: auto;">
            <a href="#" style="color: white;">
                <div class="cMenuTop">
                    <span style="width: 90%; min-height: 60px; background: #0026ff; color: white; line-height: 60px; vertical-align: central; float: left;">
                        <?=$nameB?>
                    </span>
                    <div style="width: 10%; min-height: 60px; background: #0026ff; line-height: 60px; vertical-align: central; float: left;">
                        <div class="cMenuTop_open">> </div><div class="cMenuTop_close" style="display: none"><b>< </b></div>
                    </div>
                </div>
            </a>

            <?php
            foreach ($categorycs as $item) //foreach 1
            {               
                $bName = $item->bname;
                $cId = $item->cid;
            ?>                                                                               
            <a href="/product/categoryCmenu/<?=$item->categorya_id?>/<?=$item->categoryb_id?>/<?=$item->cid?>/{{ $bName }}/<?=$item->cname?>">
                <span class="cMenu_name"
                    style="width: 90%; min-height: 40px; background: rgba(128, 128, 128, 0.06);
                                        line-height: 40px; vertical-align: central; float: left; float: left;">                   
                    <?=$item->cname?>
                </span>
            </a>
            <div class="cMenuArea">
                <div style="width: 10%; min-height: 40px; background: rgba(128, 128, 128, 0.14); line-height: 40px; vertical-align: central; float: left;">
                    <div class="cMenu">
                        <a href="#">
                            <div class="cMenu_open">> </div>
                            <div class="cMenu_close" style="display: none;">
                                <b>
                                    < 
                                </b>
                            </div>
                        </a>
                    </div>
                </div>
                <div class="cMenuInfo"
                    style="width: 250px; min-height: 20px; background: white; border: 1px solid rgba(255, 0, 0, 0.71);
                                    z-index: 2; display: none; position: absolute;">
                    <span>                        
                        <?=$item->cname?>
                    </span>
                    <span>의 하위메뉴입니다</span>
                </div>
                <div class="cMenuDetails"
                    style="width: 180px; min-height: 40px; background: white; border: 1px solid black;
                                z-index: 2; display: none; position: absolute;">
                    <?php                    
                    foreach ($categoryds as $item2) //foreach 2
                    {                       
                    ?>                     
                        <?php
                        if ($cId == $item2->categoryc_id) //if
                        {
                            $bName = $item2->bname;
                            $cName = $item2->cname;
                            $dName = $item2->dname;
                        ?>
                        <div style="padding: 2px;">                                                    
                            <a href="/product/categoryDmenu/<?=$item2->categorya_id?>/<?=$item2->categoryb_id?>/<?=$item2->categoryc_id?>/<?=$item2->did?>/{{ $bName }}/{{ $cName }}/<?=$item2->dname?>">
                                <span>
                                    <?=$dName?>
                                </span>
                                <br />
                            </a>
                        </div>
                        <?php
                        } //if
                        ?>
                                                                  
                    <?php
                    } //foreach 2
                    ?>
                </div>
            </div>
            <?php
            } //foreach 1
            ?>
        </div>
        <div style="clear: both;"></div>

        <!--카테고리내검색-->
        <div style="margin-top: 10px; width: 100%; min-height: 100px; border: 1px solid rgba(128, 128, 128, 0.38);">
            <div style="height: 30px; line-height: 30px; vertical-align: central; background: rgba(128, 128, 128, 0.22);">
                <span>
                    <b>카테고리내 검색</b>
                </span>
            </div>
            <div>
                <div class="showCategory2" style="width: 142px; height: auto; border: 1px solid #808080; float: left">
                    <div>
                        <a href="javascript:void(0)">
                            <div class="dis_Bname">
                                <?=$nameB?>
                            </div>
                            <span class="dis_AId" style="display: none;">
                                <?=$id?>
                            </span>
                            <span class="dis_BId" style="display: none;">
                                <?=$id2?>
                            </span>
                        </a>
                    </div>
                </div>
                <div class="showCategory2" style="width: 20px; height: auto; border-top: 1px solid #808080; border-bottom: 1px solid #808080; float: left">
                    <a href="javascript:void(0)">
                        <sapn id="collaps_sign2">
                            <i class="glyphicon glyphicon-chevron-down" style="padding-left: 3px;"></i>
                        </sapn>
                    </a>
                </div>
                <div class="children_category2" style="background: white; z-index: 2; position: absolute; padding-left: 0px; padding-right: 5px; margin-top: 20px; width: 164px; height: 200px; border: 1px solid #808080; clear: both; overflow-y: scroll;">
                    <?php
                    foreach ($categorybs as $item)
                    {
                    ?>
                    <div>
                        <a class="click_BName" href="javascript:void(0)">
                            <span class="b_Name">
                                <?=$item->name?>
                            </span>
                            <span class="b_AId" style="display: none">
                                <?=$item->categorya_id?>
                            </span>
                            <span class="b_BId" style="display: none">
                                <?=$item->id?>
                            </span>
                        </a>
                    </div>
                    <?php
                    }
                    ?>
                </div>
            </div>
            <div style="clear: both;"></div>
            <div style="margin-top: 15px;">
                <input type="text" class="bNameSearch" style="width: 90%; float: left; background: #b6ff00;" />
                <a id="click_Bsearch" href="#">
                    <div style="width: 10%; background: rgba(0, 38, 255, 0.82); color: white; float: left;">
                        <i class="glyphicon glyphicon-search"></i>
                    </div>
                </a>
                <div style="clear: both;"></div>
                <div id="click_Bsearch_error" style="color: red;"></div>
            </div>
        </div>
    </div>
    <br />

    <!--화면 오른쪽 로직-->
    <div class="col-sm-10 col-md-10 col-lg-10">
        <!--화면 왼쪽 맨 위의 메뉴를 클릭하면 오른쪽 화면에 아래가 열린다-->
        <div class="row" style="margin: 0px;">
            <div class="col-sm-12 col-md-12 col-lg-12">
                <div class="cMenuAllDetail"
                    style="width: 100%; min-height: 150px; border: 2px solid black; z-index: 18;
                                    background: white; display: none;">
                    <div class="cMenuAllSearch"
                        style="width: 50%; min-height: 45px; 
                                    background: white; margin-bottom: 7px; margin-top: 7px; margin-left: 7px;">
                        <input type="text" name="dMenuSearch" id="dMenuSearch" placeholder="아이템 이름을 입력하세요"
                            style="width: 90%; height: 30px;" />
                        <a href="#">
                            <span class="dNameSearch_click">
                                <i style="font-size: 20px; color: blue; width: 30px; height: 27px; text-align: center; background: blue; color: white; border: 1px solid blue;" class="glyphicon glyphicon-search"></i>
                            </span>
                        </a>
                        <div class="dNameSearch_error" style="color: red;"></div>
                    </div>
                    <?php
                    foreach ($categorycs as $item) //foreach 3
                    {                        
                        $bName = $item->bname;
                        $cId = $item->cid;
                    ?>
                    <div style="width: 20%; min-height: 130px; float: left; padding-left: 5px;">         <!--$item->id-->             <!--$item->name-->
                        <a href="/product/categoryCmenu/<?=$item->categorya_id?>/<?=$item->categoryb_id?>/<?=$item->cid?>/{{ $bName }}/<?=$item->cname?>">
                            <div style="width: 98%; background: rgba(0, 0, 255, 0.20);">
                                <b> 
                                    <?=$item->cname?>
                                </b>
                            </div>
                        </a>
                        <?php                       
                        foreach ($categoryds as $item2) //foreach 4
                        {
                        ?>
                            <?php
                            if ($cId == $item2->categoryc_id) //if
                            {
                                $bName = $item2->bname;
                                $cName = $item2->cname;
                                $dName = $item2->dname;
                            ?>                       
                            <div style="padding-left: 7px;">                                                                                  
                                <a href="/product/categoryDmenu/<?=$item2->categorya_id?>/<?=$item2->categoryb_id?>/<?=$item2->categoryc_id?>/<?=$item2->did?>/{{ $bName }}/{{ $cName }}/<?=$item2->dname?>">
                                    <span class="dMenuName">
                                        <?=$dName?>
                                    </span>
                                    <br />
                                </a>
                            </div>
                            <?php
                            } //if
                            ?>
                        <?php
                        } //foreach 4
                        ?>
                    </div>
                    <?php
                    } //foreach 3
                    ?>
                    <div style="clear: both;"></div><!--float:left initializing-->
                    <div style="width: 100%; height: 35px; border: 1px solid white;">
                        <div style="width: 97%; border: 1px solid white; float: left;"></div>
                        <div style="width: 3%; border: 1px solid white; float: left; background: blue;">
                            <a href="#">
                                <div style="font-size: 20px; color: white; text-align: center;" class="dMenu_X">X</div>
                            </a>
                        </div>
                    </div>
                </div>

            </div>
        </div>
        <div class="row">
            <!--화면 오른쪽 맨위 1개의 메뉴박스 만들기-->
            <div class="col-sm-10 col-md-10 col-lg-10" style="padding-left: 0px;">
                <a href="/home/index" style="float: left;">Home</a>
                <span style="float: left">&nbsp; > &nbsp;</span>
                <div style="float: left">
                    <div class="showCategory" style="width: 150px; height: auto; border: 1px solid #808080; float: left">
                        <div>
                            <a href="#">
                                <?=$nameB?>&nbsp;&nbsp;
                            </a>
                        </div>
                    </div>
                    <div class="showCategory" style="width: 20px; height: auto; border: 1px solid #808080; float: left">
                        <a href="#">
                            <sapn id="collaps_sign">
                                <i class="glyphicon glyphicon-chevron-down" style="padding-left: 3px;"></i>
                            </sapn>
                        </a>
                    </div>
                    <div class="children_category" style="background: white; z-index: 2; position: absolute; padding-left: 5px; padding-right: 5px; margin-top: 20px; width: 170px; height: 200px; border: 1px solid #808080; clear: both; overflow-y: scroll;">
                        <?php
                        foreach ($categorybs as $item)
                        {
                        ?>
                        <div>
                            <!--<a href="/products/categoryBmenu?id=<?=$item->categorya_id?>&id2=<?=$item->id?>&nameB=<?=$item->name?>" class="hoverBlue">-->
                            <a href="/product/categoryBmenu/<?=$item->categorya_id?>/<?=$item->id?>/<?=$item->name?>" class="hoverBlue">
                                <?=$item->name?>
                            </a>
                        </div>
                        <?php
                        }
                        ?>
                    </div>
                </div>
            </div>
            <div class="col-sm-2 col-md-2 col-lg-2"></div>
        </div>

        <!--화면 오른쪽 메뉴박스 밑의 카루셀 만들기-->
        <div class="row" style="margin-top: 10px; margin-right: 0px;">
            <div class="col-sm-10 col-md-10 col-lg-10">
                <div class="row carousel_margin_right">
                    <div id="my-carousel" class="carousel slide" data-ride="carousel">
                        <ol class="carousel-indicators">
                            <li data-target="#my-carousel" data-slide-to="0" class="active"></li>
                            <li data-target="#my-carousel" data-slide-to="1"></li>
                            <li data-target="#my-carousel" data-slide-to="2"></li>
                            <li data-target="#my-carousel" data-slide-to="3"></li>
                            <li data-target="#my-carousel" data-slide-to="4"></li>
                        </ol>
                        <div class="carousel-inner">
                            <div class="item active">
                                <a href="#">
                                    <img src="/imageSeller/cateBcarousel/8Second.JPG" class="main_carousel" style="width:100%; height:260px;" />
                                </a>
                                <div class="carousel-caption">
                                    <h2></h2>
                                </div>
                            </div>
                            <div class="item">
                                <a href="#">
                                    <img src="/imageSeller/cateBcarousel/mango.JPG" class="main_carousel" style="width:100%; height:260px;" />
                                </a>
                                <div class="carousel-caption">
                                    <h2></h2>
                                </div>
                            </div>
                            <div class="item">
                                <a href="#">
                                    <img src="/imageSeller/cateBcarousel/mixxo.JPG" class="main_carousel" style="width:100%; height:260px;" />
                                </a>
                                <div class="carousel-caption">
                                    <h2></h2>
                                </div>
                            </div>
                            <div class="item">
                                <a href="#">
                                    <img src="/imageSeller/cateBcarousel/hejis.JPG" class="main_carousel" style="width:100%; height:260px;" />
                                </a>
                                <div class="carousel-caption">
                                    <h2></h2>
                                </div>
                            </div>
                            <div class="item">
                                <a href="#">
                                    <img src="/imageSeller/cateBcarousel/hyundai.JPG" class="main_carousel" style="width:100%; height:260px;" />
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
                    </div>
                </div>
            </div>

            <!--카루셀 오른쪽 작은 박스-->
            <div class="col-sm-2 col-md-2 col-lg-2" style="padding-left: 0px;">
                <a href="#">
                    <img src="/imageSeller/cateBcarousel/jumok.JPG" class="main_carousel" style="width:100%; height:260px;" />
                </a>
            </div>
        </div>
        <br />

        <!--카루셀 바로밑의 가로로된 긴 박스-->
        <div class="row" style="margin-right: 0px;">
            <div class="col-sm-12 col-md-12 col-lg-12" style="padding-left: 0px;">
                <a href="#">
                    <img src="/imageSeller/Lap.JPG" class="img-responsive" />
                </a>
            </div>
        </div>
        <br />

        <!--"베스트?"에 대한 내용을 처음에는 숨긴다-->
        <div class="row">
            <div class="col-sm-12 col-md-12 col-lg-12" style="margin: 0px;">
                <h4 style="margin-left: -15px;">
                    <?=$nameB?>
                    <span>
                        &nbsp;베스트
                        <a href="#">
                            &nbsp;
                            <span class="best_question">
                                <i class="glyphicon glyphicon-question-sign"></i>
                            </span>
                        </a>
                    </span>
                </h4>
                <div class="best_question_content" style="display: none; border: 1px solid rgba(128, 128, 128, 0.56); width: 180px; height: auto; z-index: 3; position: absolute; background: white;">
                    abcdefghijklmnopqr
                    abcdefghijklmnopqr
                    123456789012345678
                    123456789012345678
                </div>
            </div>
        </div>

        <!--화면 하단의 나열된 박스들("베스트?" 바로 밑에있음)-->
        <!--판매된 상품 중에서 가중 금액순으로 탑10만 보여준다-->
        <div class="row">
            <div class="col-sm-12 col-md-12 col-lg-12" style="padding-left: 0px;">

                <?php
                foreach ($orderdetails as $item)
                {
                    //$product = $item->product;
                    //$pictures = $product->pictures->first();
                    //$fileName = $pictures->fileName;
                    //$modelName = $product->modelName;
                    //$originPrice = $product->originPrice;
                    //$sellPrice = $product->sellPrice;
                    //$id = $product->id;
                    $fileName = $item->searchImage;
                    $modelName = $item->modelName;
                    $originPrice = $item->originPrice;
                    $sellPrice = $item->sellPrice;
                    $id = $item->productId;
                ?>
                <div style="width: 189px; height: 330px; border: 1px solid rgba(128, 128, 128, 0.56); word-break: break-all; float: left;">
                    <span style="color: #0026ff;">                       
                    </span>
                        <a href="/product/detailsWithCdn/{{ $id }}" target="_blank">                       
                            <!--<img style="width: 100%; height: 55%; padding-left: 0px;" src="/uploadFiles/pictures/sellers/<?=$item->fileName?>" class="img-responsive" />-->
                            <!--<img style="width: 100%; height: 55%; padding-left: 0px;" src="http://hdkwonnz.cdn2.cafe24.com/uploadFiles/pictures/sellers/<?=$fileName?>" class="img-responsive" />-->
                            <?=$fileName?>
                        </a>
                        <span style="word-break: break-all;">
                            <?=$modelName?>
                        </span>
                        <br />
                        <span style="text-decoration: line-through;" class="originPrice">
                            <?=$originPrice?>
                            <span>원</span>
                        </span>
                        <br />
                        <span>
                            <b style="font-size: 18px;" class="sellPrice">
                                <?=$sellPrice?>
                            </b>
                            원
                        </span>
                </div>                
                <?php
                }
                ?>

            </div>
        </div>

    </div>
</div>
<br />

<!--script-->
<script src="https://code.jquery.com/jquery-3.1.0.min.js" integrity="sha256-cCueBR6CsyA4/9szpPfrX3s49M9vUU5BgtiJj06wt/s=" crossorigin="anonymous"></script>
<!--<script src="/lib/jquery/jquery-2.2.3.min.js"></script>-->

<!--금액 편집-->
<script>
    $(function () {
        $('.originPrice').each(function () {
            var txtValue = "";
            txtValue = formatNumber($(this).text());
            $(this).text(txtValue);
        })

        $('.sellPrice').each(function () {
            var txtValue = "";
            txtValue = formatNumber($(this).text());
            $(this).text(txtValue);
        })
    });

    //편집하는 함수
    function formatNumber(num) {
        return num.toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, "$1,")
    }
</script>

<script>
    //화면 맨 왼쪽 최상단메뉴를 클릭하면 그것에 대한 하위메뉴가 화면 중앙(오른쪽)에 보여진다
    $(function () {
        var topSw = false;
        $('.cMenuTop').click(function () {
            if (topSw == false)
            {
                $('.cMenuAllDetail').css('top', '-20px').css('left', '-15px').css('position', 'absolute').show();
                $('.cMenuTop_open').hide();
                $('.cMenuTop_close').show();
                topSw = true;
                $('.dNameSearch_click').click(function () {      //서치마크를 클릭하면
                    var inputVal = $('#dMenuSearch').val().trim();
                    if (inputVal == "")
                    {
                        $('.dNameSearch_error').empty().append("아이템 이름을 입력하세요...");
                    }
                    else
                    {
                        $('.dNameSearch_error').empty();
                        //$('.dMenuName:contains(' + inputVal + ')').css("text-decoration", "underline");
                        $('.dMenuName:contains(' + inputVal + ')').css("color", "red");
                        //$('.dMenuName:contains(' + inputVal + ')').replaceWith('+ dName +' , '<span style="color: red;">' + inputVal + '</span>');
                        if ($('.dMenuName:contains(' + inputVal + ')').length < 1)
                        {
                            $('.dNameSearch_error').empty().append("찾으려는 아이템 이름이 없습니다 ...");
                        }
                        else
                        {
                            $('.dNameSearch_error').empty();
                        }
                    }
                });
            }
            else
            {
                $('.cMenuAllDetail').hide();
                $('.cMenuTop_open').show();
                $('.cMenuTop_close').hide();
                topSw = false;
            }

            $('.dMenu_X').click(function () {
                $('.cMenuAllDetail').hide();
                $('.cMenuTop_open').show();
                $('.cMenuTop_close').hide();
                topSw = false;
            });
        });

        //화면 맨 왼쪽 박스메뉴의 ">"에 마우스를 올리면 그것에 대한 하위메뉴가 보여진다
        var h = 0;
        $('.cMenu').each(function (i) {
            $('.cMenuArea').eq(i).mouseover(function () {
                h = (i + 1) * 40;
                $('.cMenuAllDetail').hide();     //화면 왼쪽 맨위 박스메뉴를 클릭해서 생긴 세부메뉴박스를 숨긴다.
                $('.cMenuTop_open').show();      //
                $('.cMenuTop_close').hide();     //
                topSw = false;                   //
                $('.cMenu_open').eq(i).hide();
                $('.cMenu_close').eq(i).show();
                $('.cMenuDetails').eq(i).css('top', (h + 20) + 'px').css('left', '180px').show();
                $('.cMenuInfo').eq(i).css('top', (h + 0) + 'px').css('left', '150px').show();
            });
            $('.cMenuArea').eq(i).mouseout(function () {
                $('.cMenu_close').eq(i).hide();
                $('.cMenu_open').eq(i).show();
                $('.cMenuInfo').eq(i).hide();
                $('.cMenuDetails').eq(i).hide();
            });
        });

        //화면 왼쪽 카테고리내 검색
        $('.children_category2').hide();  //먼저 펼친 메뉴를 숨긴다.
        var hide_sw = true;    //토글 스위치
        $('.showCategory2').click(function () {  //펼칠 메뉴를 클릭하여
            if (hide_sw == true) {               //스위치가 트루이면
                $('.children_category2').show(); //보여주고
                //$('#collaps_sign').text("<");
                $('#collaps_sign2').empty().append("<i class='glyphicon glyphicon-chevron-up' style='padding-left: 3px;'></i>");
                hide_sw = false;
            }
            else {                               //아니면
                $('.children_category2').hide(); //숨긴다
                //$('#collaps_sign').text(">");
                $('#collaps_sign2').empty().append("<i class='glyphicon glyphicon-chevron-down' style='padding-left: 3px;'></i>");
                hide_sw = true;
            }
            $('.click_BName').each(function (i) {    //B카테고리 박스가 펼쳐진 상태에서 카테고리 이름을 클릭하여
                $(this).click(function () {
                    var bName = $('.b_Name').eq(i).text();  //크릭한 이름과 그에 해당하는 카테고리 ID들을 변수에 받아
                    var aID = $('.b_AId').eq(i).text();
                    var bID = $('.b_BId').eq(i).text();
                    //alert(name + "    "  + aID + "     " + bID);
                    $('.dis_Bname').empty().append(bName); // 카테고리 검색박스로 올려보내 보여준다
                    $('.dis_AId').empty().append(aID);
                    $('.dis_BId').empty().append(bID);
                    $('.children_category2').hide();  //펼쳐진 메뉴는 다시 감춘다
                    $('#collaps_sign2').empty().append("<i class='glyphicon glyphicon-chevron-down' style='padding-left: 3px;'></i>");
                    hide_sw = true;
                });
            });
        });

        //카테고리내 검색창에서 검색을 클릭 했을때...
        $('#click_Bsearch').click(function () {
            var searchVal = $('.bNameSearch').val();
            if (searchVal == "")
            {
                $('#click_Bsearch_error').empty().append("검색단어입력하세요...");
            }
            else
            {
                $('#click_Bsearch_error').empty();
                var bName = $('.dis_Bname').text().trim();                
                var aID = $('.dis_AId').text().trim();
                var bID = $('.dis_BId').text().trim();                              
                window.open('/home/searchByCategoryBId/' + bID + '/'+ bName + '/' + searchVal, 'NewWindow');                
            }
        });

        //화면 중앙 1개의 메뉴박스
        $('.children_category').hide();
        var hide_sw = true;
        $('.showCategory').click(function () {
            if (hide_sw == true) {
                $('.children_category').show();
                //$('#collaps_sign').text("<");
                $('#collaps_sign').empty().append("<i class='glyphicon glyphicon-chevron-up' style='padding-left: 3px;'></i>");
                hide_sw = false;
            }
            else {
                $('.children_category').hide();
                //$('#collaps_sign').text(">");
                $('#collaps_sign').empty().append("<i class='glyphicon glyphicon-chevron-down' style='padding-left: 3px;'></i>");
                hide_sw = true;
            }
        });
        //"베스트?" 보여주기
        $('.best_question').mouseover(function(){
            $('.best_question_content').css('left', '100px').show();
        });
        $('.best_question').mouseout(function () {
            $('.best_question_content').hide();
        });
    });
</script>

@endsection