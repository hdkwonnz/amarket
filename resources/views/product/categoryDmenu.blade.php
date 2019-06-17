@extends('layouts.app')

@section('title')
Product-categoryDmenu
@endsection

@section('content')
<!--Table CSS-->
<style type="text/css">
    .webgrid-table {
        font-family: "Trebuchet MS", Arial, Helvetica, sans-serif;
        font-size: 1.2em;
        width: 100%;
        display: table;
        border-collapse: separate;
    }

    .webgrid-table th {
        background: rgba(128, 128, 128, 0.25);
    }

    .webgrid-table td {
        border-bottom: solid 1px rgba(128, 128, 128, 0.26);
        padding-top: 10px;
        padding-bottom: 10px;
    }

    .webgrid-header {
        padding-bottom: 4px;
        padding-top: 5px;
        text-align: left;
    }

    .webgrid-footer {
    }

    .webgrid-row-style {
    }

    .webgrid-alternating-row {
    }

    .image_width {
        width: 15%;
    }

    .title_width {
        width: 55%;
        padding-left: 10px;
        word-break: break-all;
        text-align: left;
    }

    .price_width {
        width: 15%;
    }

    .quantity_width {
        width: 15%;
    }
</style>

<!--id, id2, id3, id4를 Ajax에서 사용하기위해 숨긴다: 콘트롤러에서 넘어온값이다-->
<div>
    <input type="hidden" value="<?=$id?>" id="idAjax" />
    <input type="hidden" value="<?=$id2?>" id="id2Ajax" />
    <input type="hidden" value="<?=$id3?>" id="id3Ajax" />
    <input type="hidden" value="<?=$id4?>" id="id4Ajax" />
</div>

<!--맨위 메뉴 설정하는 세개의 박스만드는 로직-->
<div class="row">
    <div class="col-sm-12 col-md-12 col-lg-12" style="margin-top: 10px;">
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
            <div class="children_category" style="background: white; z-index: 4; 
                                                  position: absolute; padding-left: 5px; 
                                                  padding-right: 5px; margin-top: 20px; 
                                                  width: 170px; height: 200px; 
                                                  border: 1px solid #808080; clear: both; 
                                                  overflow-y: scroll;">
                <?php
                foreach ($categorybs as $item)
                {
                ?>
                <div>
                    <a href="/product/categoryBmenu/<?=$item->categorya_id?>/<?=$item->id?>/<?=$item->name?>">
                        <?=$item->name?>
                    </a>
                </div>
                <?php
                }
                ?>
            </div>
            <span style="float: left">&nbsp; > &nbsp;</span>
        </div>
        <div style="float: left">
            <div class="showCategory2" style="width: 150px; height: auto; border: 1px solid #808080; float: left;">
                <div>
                    <a href="#">
                        <?=$nameC?>&nbsp;&nbsp;
                    </a>
                </div>
            </div>
            <div class="showCategory2" style="width: 20px; height: auto; border: 1px solid #808080; float: left;">
                <a href="#">
                    <sapn id="collaps_sign2">
                        <i class="glyphicon glyphicon-chevron-down" style="padding-left: 3px;"></i>
                    </sapn>
                </a>
            </div>
            <div class="children_category2" style="background: white; z-index: 4; 
                                                   position: absolute; padding-left: 5px; 
                                                   padding-right: 5px; margin-top: 20px; 
                                                   width: 170px; height: 200px; 
                                                   border: 1px solid #808080; clear: both; 
                                                   overflow-y: scroll;">
                <?php
                foreach ($categorycs as $item)
                {
                    //$nameB = $item->categoryb->name;////////////////////////////////////////////////
                    $nameB = $item->bname;
                ?>
                <div>                                                                                <!--$item->id?-->            <!--$item->name-->
                    <a href="/product/categoryCmenu/<?=$item->categorya_id?>/<?=$item->categoryb_id?>/<?=$item->cid?>/<?=$nameB?>/<?=$item->cname?>">
                        <?=$item->cname?> <!--$item->name-->
                    </a>
                </div>
                <?php
                }
                ?>
            </div>
            <span style="float: left">&nbsp; > &nbsp;</span>
        </div>
        <div style="float: left">
            <div class="showCategory3" style="width: 150px; height: auto; border: 1px solid #808080; float: left;">
                <div>
                    <a href="#">
                        <?=$nameD?>&nbsp;&nbsp;
                    </a>
                </div>
            </div>
            <div class="showCategory3" style="width: 20px; height: auto; border: 1px solid #808080; float: left;">
                <a href="#">
                    <sapn id="collaps_sign3">
                        <i class="glyphicon glyphicon-chevron-down" style="padding-left: 3px;"></i>
                    </sapn>
                </a>
            </div>
            <div class="children_category3" style="background: white; z-index: 4; position: absolute; padding-left: 5px; padding-right: 5px; margin-top: 20px; width: 170px; height: 200px; border: 1px solid #808080; clear: both; overflow-y: scroll;">
                <?php
                foreach ($categoryds as $item)
                {
                    //$nameB = $item->categoryb->name;/////////////////////////////////////////////
                    //$nameC = $item->categoryc->name;/////////////////////////////////////////////
                    $nameB = $item->bname;
                    $nameC = $item->cname;
                ?>
                <div>                                                                                                           <!--$item->id-->                       <!--$item->name-->
                    <a href="/product/categoryDmenu/<?=$item->categorya_id?>/<?=$item->categoryb_id?>/<?=$item->categoryc_id?>/<?=$item->did?>/<?=$nameB?>/<?=$nameC?>/<?=$item->dname?>">
                        .<?=$item->dname?> <!--$item->name-->
                    </a>
                </div>
                <?php
                }
                ?>
            </div>
        </div>
    </div>
</div>

<!--위에서 두번째 상세메뉴 박스 만드는 로직-->
<div class="row" style="margin-right: 0px;">
    <div class="col-sm-12 col-md-12 col-lg-12">
        <div style="border: 1px solid rgba(0, 38, 255, 0.63); width: 100%; min-height: 50px; overflow: hidden; margin-top: 10px;">
            <?php
            foreach ($categoryds as $item)
            {
                //$nameB = $item->categoryb->name;///////////////////////////////////////////////////
                //$nameC = $item->categoryc->name;///////////////////////////////////////////////////
                $nameB = $item->bname;
                $nameC = $item->cname;
            ?>
            <div class="col-sm-3 col-md-3 col-lg-3" style="padding: 10px;">                                                <!--$item->did-->                      <!--$item->name-->
                <a href="/product/categoryDmenu/<?=$item->categorya_id?>/<?=$item->categoryb_id?>/<?=$item->categoryc_id?>/<?=$item->did?>/<?=$nameB?>/<?=$nameC?>/<?=$item->dname?>">
                    .<?=$item->dname?><!--$item->name-->
                </a>
            </div>
            <?php
            }
            ?>
        </div>
    </div>
</div>
<br />

<!--파워클릭(광고)-->
<div class="row" style="margin-right: 0px;">
    <div class="col-sm-2 col-md-2 col-lg-2">
        <span>파워클릭(광고)</span>
    </div>
    <div class="col-sm-9 col-md-9 col-lg-9"></div>
    <div class="col-sm-1 col-md-1 col-lg-1">
        <a href="#">신청하기></a>
    </div>
</div>
<hr style="margin-bottom: 3px; margin-right: 15px;" />

<!--판매 순위별 탑5 보여주기-->
<div class="row" style="margin-right: 0px;">
    <div class="col-sm-12 col-md-12 col-lg-12">
        <table class="webgrid-table" id="checkableGrid">           
            <tbody>
                <?php
                foreach($orderdetails as $item)
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
                <tr class="webgrid-row-style">
                    <td class="image_width">
                        <a href="/product/detailsWithCdn/{{ $id }}" target="_blank">
                            <!--<img style="width: 100%; height: 50%; padding-left: 0px;" src="/uploadFiles/pictures/sellers/<?=$item->fileName?>" class="img-responsive" />-->
                            <!--<img style="width: 100%; height: 50%; padding-left: 0px;" src="http://hdkwonnz.cdn2.cafe24.com/uploadFiles/pictures/sellers/<?=$fileName?>" class="img-responsive" />-->
                            <?=$fileName?>
                        </a>
                    </td>
                    <td class="title_width">
                        <a href='#' onclick="javascript:productDetails(<?=$item->productId?>,<?=$item->categoryAId?>,<?=$item->categoryBId?>,<?=$item->categoryCId?>,<?=$item->categoryDId?>);">
                            <?=$modelName?>
                        </a>
                    </td>
                    <td class="price_width">
                        <span style="display: none;" class="originPrice">
                            <?=$originPrice?>
                        </span>
                        <?php
                        //$differPrice = $item->originPrice - $item->sellPrice;
                        $discountRate = round((100 - ($sellPrice / $originPrice * 100)),2);
                        ?>
                        <span class="originPrice_txt" style="text-decoration: line-through; font-size: 12px;"></span>
                        원
                        <span style="color: blue;">
                            <?=$discountRate?>%
                            <i class="glyphicon glyphicon-arrow-down" style="font-size: 12px;"></i>
                        </span>
                        <br />
                        <span style="display: none; " class="sellPrice">
                            <?=$sellPrice?>
                        </span>
                        <span class="sellPrice_txt" style="font-size: 20px; "></span>
                        원
                    </td>
                    <td class="quantity_width">
                        <span>추후 생성 예정</span>
                    </td>
                </tr>
                <?php
                }
                ?>
            </tbody>
        </table>
    </div>
</div>

<br />

<!--categoryD 상품을 보여준다-->
<!--Ajax에서 콜하여 appending 한다-->
<div class="categoryDproducts">

    <span style="color: blue;">데이터 로딩중...</span>

</div>

<!--script-->
<script src="https://code.jquery.com/jquery-3.1.0.min.js" integrity="sha256-cCueBR6CsyA4/9szpPfrX3s49M9vUU5BgtiJj06wt/s=" crossorigin="anonymous"></script>
<!--<script src="/lib/jquery/jquery-2.2.3.min.js"></script>-->

<!--금액 편집-->
<script>
    $(function () {
        $('.originPrice').each(function () {
            var txtValue = "";
            txtValue = formatNumber($(this).text());
            $(this).next().empty().append(txtValue);
        })

        $('.sellPrice').each(function () {
            var txtValue = "";
            txtValue = formatNumber($(this).text());
            $(this).next().empty().append(txtValue);
        })
    });

    //편집하는 함수
    function formatNumber(num) {
        return num.toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, "$1,")
    }
</script>

<!--화면 맨위 세개의 박스 메뉴를 콘트롤하는 로직-->
<script>
    $(function () {
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

        /////////////////////////////////////////////////////////////////

        $('.children_category2').hide();
        var hide_sw = true;
        $('.showCategory2').click(function () {
            if (hide_sw == true) {
                $('.children_category2').show();
                //$('#collaps_sign2').text("<");
                $('#collaps_sign2').empty().append("<i class='glyphicon glyphicon-chevron-up' style='padding-left: 3px;'></i>");
                hide_sw = false;
            }
            else {
                $('.children_category2').hide();
                //$('#collaps_sign2').text(">");
                $('#collaps_sign2').empty().append("<i class='glyphicon glyphicon-chevron-down' style='padding-left: 3px;'></i>");
                hide_sw = true;
            }
        });

        //////////////////////////////////////////////////////////////////

        $('.children_category3').hide();
        var hide_sw = true;
        $('.showCategory3').click(function () {
            if (hide_sw == true) {
                $('.children_category3').show();
                //$('#collaps_sign3').text("<");
                $('#collaps_sign3').empty().append("<i class='glyphicon glyphicon-chevron-up' style='padding-left: 3px;'></i>");
                hide_sw = false;
            }
            else {
                $('.children_category3').hide();
                //$('#collaps_sign3').text(">");
                $('#collaps_sign3').empty().append("<i class='glyphicon glyphicon-chevron-down' style='padding-left: 3px;'></i>");
                hide_sw = true;
            }
        });
    });
</script>

<!--layoutView class="contents2" 안에 Pagination을 사용하여-->
<!--Ajax로 원하는 데이터를 보여준다-->
<script>
    $(function () {
        getMultiColumn();
    });

    function getMultiColumn() {
        var idAjax = $('#idAjax').val().trim();  ////
        var id2Ajax = $('#id2Ajax').val().trim();  ////
        var id3Ajax = $('#id3Ajax').val().trim();  ////
        var id4Ajax = $('#id4Ajax').val().trim();  ////

        $.ajax({
            url: "/product/categoryDAll",
            type: 'Get',
            cache: false,
            data: { id: idAjax, id2: id2Ajax, id3: id3Ajax, id4: id4Ajax },
            success: function (data) {
                //$(".categoryDproducts").html(data);
                $(".categoryDproducts").empty().append(data);
            },
            error: function () {
                alert(data + "   /products/categoryDAll something seems wrong...");
            }
        });

        return false;  //매우 중요함...
    }
</script>

@endsection