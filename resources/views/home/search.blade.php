@extends('layouts.app')

@section('title')
Home-search
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

<div class='col-sm-12 col-md-12 col-lg-12' style="padding-left: 0px;">
    <a href="/home/index">Home</a>&nbsp;&nbsp;&nbsp; > &nbsp;&nbsp;
    <a href="#">
        <b>Search</b>
    </a>
    <br />

    <span style='font-size: 15px; '>
        검색한 단어 :
        <span style="color: blue; ">
            {{ $searchTerm }}
        </span>
        <span>
            ({{ $numRows }})건
        </span>
    </span>
    <br />

    <!--category_b 그룹별로 집계하여 화면 좌측 상단에 보여주고
        해당 그룹을 조회 할 수도 있다-->
    <div class='col-sm-6 col-md-6 col-lg-6' style="padding-left: 0px;">
        @foreach ($group as $item)
        <div style="float: left; width: 33.3%; border: 1px solid rgba(128, 128, 128, 0.56);">
            <a href="/home/searchByCategoryBId?id=<?=$item->categorya_id?>&id2=<?=$item->categoryb_id?>&nameB={{ $item->categoryb->name }}&searchTerm=<?=$searchTerm?>" target="_blank">
                {{ $item->categoryb->name }}{{    $item->subCount }}
            </a>
        </div>
        @endforeach
        <div style="clear: both;"></div>
        <?php
        if ($numRows < 1)
        {
        ?>
        <div style='color: red; font-size: 25px; '>
            검색을 원하시는 상품이 없습니다...
        </div>
        <?php
        }
        ?>
        <?php
        if ($searchTerm == "")
        {
        ?>
        <div style='color: red; font-size: 25px; '>
            검색창에 원하시는 단어를 입력하세요...
        </div>
        <?php
        }
        ?>
    </div>

    <!--searchTerm 을 Ajax에서 사용하기위해 숨긴다: 콘트롤러에서 넘어온값이다-->
    <div>
        <input type="hidden" value="<?=$searchTerm?>" id="searchTermAjax" />
    </div>

    <table class="webgrid-table" id="checkableGrid">
        <tbody>
            @foreach($products as $item)
            <?php
            $pictures = $item->pictures;
            foreach($pictures as $picture)
            {
                $fileName = $picture->fileName;
            }
            ?>
            <tr class="webgrid-row-style">
                <td class="image_width">
                    <a href="/product/details/{{ $item->id }}" target="_blank">
                        <!--<img style="width: 100%; height: 50%; padding-left: 0px;" src="/uploadFiles/pictures/sellers/<?=$item->fileName?>" class="img-responsive">-->
                        <img style="width: 100%; height: 40%; padding-left: 0px;" src="http://hdkwonnz.cdn2.cafe24.com/uploadFiles/pictures/sellers/{{ $fileName }}" class="img-responsive" />
                    </a>
                </td>
                <td class="title_width">
                    <a href="/product/details/{{ $item->id }}" target="_blank">
                        <?=$item->modelName?>
                    </a>
                </td>
                <td class="price_width">
                    <span style="display: none;" class="originPrice">
                        <?=$item->originPrice?>
                    </span>
                    <?php
                    //$differPrice = $item->originPrice - $item->sellPrice;
                    $discountRate = round((100 - ($item->sellPrice / $item->originPrice * 100)),2);
                    ?>
                    <span class="originPrice_txt" style="text-decoration: line-through; font-size: 12px;"></span>원
                    <span style="color: blue;">
                        <?=$discountRate?>%
                        <i class="glyphicon glyphicon-arrow-down" style="font-size: 12px;"></i>
                    </span>
                    <br />
                    <span style="display: none; " class="sellPrice">
                        <?=$item->sellPrice?>
                    </span>
                    <span class="sellPrice_txt" style="font-size: 20px; "></span>원
                </td>
                <td class="quantity_width">
                    <span>추후 생성 예정</span>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <div class="page_footer">
        {!!$products->render() !!}
    </div>
</div>

<div class='col-sm-12 col-md-12 col-lg-12' style="padding-left: 0px;">
    <div class="contents2">

    </div>
</div>

<!-- Scripts -->
<script src="https://code.jquery.com/jquery-3.1.0.min.js" integrity="sha256-cCueBR6CsyA4/9szpPfrX3s49M9vUU5BgtiJj06wt/s=" crossorigin="anonymous"></script>
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

<!--layoutView class="contents2" 안에 Pagination을 사용하여-->
<!--Ajax로 원하는 데이터를 보여준다-->
<script>
    $(function () {
        getMultiColumn();
    });

    function  getMultiColumn()
    {
        var selectedValue = $('#searchTermAjax').val().trim(); ////
        
        $.ajax({
            url: "/home/selectedProducts",
            type: 'get',
            cache: false,
            data: { searchTerm2: selectedValue },
            success: function (data) {                
                //$(".contents2").html(data);
                $('.contents2').empty().append(data);
            },
            error: function () {
                alert(data + "   /home/selectedProducts something seems wrong...");
            }
        });
       
        return false;  //매우 중요함...
    }
</script>

@endsection
