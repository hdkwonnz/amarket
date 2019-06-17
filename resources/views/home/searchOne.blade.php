@extends('layouts.app')

@section('title')
Home-search
@endsection

@section('content')

<div class='col-sm-12 col-md-12 col-lg-12' style="padding-left: 0px;">
    <!--<a href="/home/index">Home</a>&nbsp;&nbsp;&nbsp; > &nbsp;&nbsp;    
    <a href="#">
        <b>Search</b>
    </a>-->

    <div class="{{ Request::is('/') ? " active" : "" }}">
        <a href="/">Home</a>&nbsp;&nbsp;&nbsp; > &nbsp;&nbsp;
        <a href="#">
            <b>Search</b>
        </a>
    </div>
    <br />

    <span style='font-size: 15px; '>
        검색한 단어 :
        <span style="color: blue; ">
            {{ $searchTerm }}
        </span>
        <span>
            ({{ $numRows }}건)
        </span>
    </span>
    <br />

    <!--category_b 그룹별로 집계하여 화면 좌측 상단에 보여주고
        해당 그룹을 조회 할 수도 있다-->
    <div class='col-sm-6 col-md-6 col-lg-6' style="padding-left: 0px;">
        @foreach ($group as $item)
        <?php
            $bId = $item->categoryb_id;
            $bName = $item->categoryb->name;
        ?>
        <div style="float: left; width: 33.3%; border: 1px solid rgba(128, 128, 128, 0.56);">
            <a href="/home/searchByCategoryBId/<?=$bId?>/{{ $bName }}/<?=$searchTerm?>" target="_blank">
                {{ $bName }}({{ $item->subCount }}건)
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
</div>
    

<div class='col-sm-12 col-md-12 col-lg-12' style="padding-left: 0px;">
    <div class="contents1">
        <div style="color: blue;">
            데이터 로딩중...
        </div>
    </div>
</div>

<div class='col-sm-12 col-md-12 col-lg-12' style="padding-left: 0px;">
    <div class="contents2">
        <div style="color: blue;">
            데이터 로딩중...
        </div>
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
        getContents1();
        //getContents2();
    });

    function getContents1()
    {
        var selectedValue = $('#searchTermAjax').val().trim(); ////
        //alert(selectedValue);
        $.ajax({
            url: "/home/searchTwo",
            type: 'get',
            cache: false,
            data: { searchTerm: selectedValue },
            success: function (data) {
                //$(".contents2").html(data);
                $('.contents1').empty().append(data);
                getContents2();
            },
            error: function () {
                alert(data + "   /home/searchTwo something seems wrong...");
            }
        });

        return false;  //매우 중요함...
    }

    function getContents2() {
        var selectedValue = $('#searchTermAjax').val().trim(); ////

        $.ajax({
            url: "/home/searchThree",
            type: 'get',
            cache: false,
            data: { searchTerm: selectedValue },
            success: function (data) {
                //$(".contents2").html(data);
                $('.contents2').empty().append(data);                
            },
            error: function () {
                alert(data + "   /home/searchThree something seems wrong...");
            }
        });

        return false;  //매우 중요함...
    }
</script>

@endsection
