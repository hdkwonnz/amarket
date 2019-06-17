<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!--각기 다른 view에서 title을 가져온다-->
    <title>@yield('title')</title>
    
    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com"> 

    <!-- Styles -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.11.4/jquery-ui.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous" />

    <!--my Styles-->    
    <link href="/myCss/myLayout.css" rel="stylesheet" />

    <!--script-->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
               
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
            opacity: .5;
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
</head>

<body class="body_position">
    <!--test for loading spinner 26/04/2019-->
    <div class="my_loader"></div>
    <!--화면 맨위 로고 와 서치박스, 광고 -->
    <div class="navbar navbar-default navbar-fixed-top top_search_nav">
        <div class="container">
            <div class="row">
                <!--로고-->
                <div class="col-sm-4 col-md-4 col-lg-4">
                    <div class="navbar-header">
                        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-3">
                            <span class="sr-only">Toggle navigation</span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                        </button>
                        <div>
                            <a href="/">
                                <img class="img-responsive" src="/imageOwner/logo_1.JPG" />
                            </a>
                        </div>
                    </div>
                </div><!--로고-->
                <!--서치박스,광고-->
                <div class="col-sm-8 col-md-8 col-lg-8">
                    <div class="navbar-collapse collapse" id="bs-example-navbar-collapse-3">
                        <!--서치박스-->
                        <div class="col-sm-6 col-md-6 col-lg-6">
                            <!--action="/home/search"--><!--action="/home/searchMulti"--><!--action="/home/searchOne"-->
                            <form action="/home/searchOne" method="GET" name="mainSerach" id="mainSerach">
                                <div class="input-group search_box_color">
                                    <input type="text" class="form-control input-lg" name="searchTerm" id="searchTerm" value="{{old('searchTerm') }}" placeholder="검색단어 입력" required autofocus />
                                    <div class="input-group-btn">
                                        <button class="btn btn-default" id="btnSerach" type="submit" style="font-size: 23px;" onclick="return checkFields();">
                                            <!--<button class="btn btn-default" id="btnSerach" type="submit" style="font-size: 23px;">-->
                                            <i class="glyphicon glyphicon-search"></i>
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div><!--서치박스-->
                        <div class="col-sm-3 col-md-3 col-lg-3"></div>
                        <!--맨위 우측 광고  -->
                        
                    </div>
                </div><!--서치박스,광고-->
            </div>
        </div>
    </div><!--화면 맨위 로고 와 서치박스, 광고 -->

    <!--상단 메뉴바-->
    <nav class="navbar navbar-default navbar_position upper_nav">
        <div class="container">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <!--<a class="navbar-brand" href="#">전체메뉴<i class="glyphicon glyphicon-menu-hamburger"></i></a>-->
                <a class="allMenu" href="#">
                    <div style="font-size: 20px; min-height: 46px; line-height: 46px; vertical-align: middle;">
                        <div class="allMenu_text">
                            전체메뉴
                            <i class="glyphicon glyphicon-menu-hamburger"></i>
                            <i id="chevron_down" style="font-size: 30px; line-height: 46px; vertical-align: middle;" class="glyphicon glyphicon-chevron-down"></i>
                            <i id="chevron_up" style="font-size: 30px; line-height: 46px; vertical-align: middle; display: none;" class="glyphicon glyphicon-chevron-up"></i>
                        </div><!--class="allMenu_text"-->
                    </div>
                </a><!--class="allMenu"-->
            </div>

            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav">
                    <!--<li class="active"><a href="#">Link <span class="sr-only">(current)</span></a></li>-->
                    <!--아래 문장은 HOME을 클릭하면 HOME 글씨가 active를 의미하는 색갈로 된 box로 감싸주는 역할을 한다-->
                    <li class="{{ Request::is('/') ? " active" : "" }}">
                        <a href="/">HOME</a>
                    </li>
                    <li>
                        <a href="#">베스트</a>
                    </li>
                    <li>
                        <a href="#">출첵/쿠폰</a>
                    </li>
                    <li>
                        <a href="#">슈퍼딜</a>
                    </li>
                    <li>
                        <a href="#">스마트배송</a>
                    </li>
                    <li>
                        <a href="#">홈플러스</a>
                    </li>
                </ul>
                <ul class="nav navbar-nav navbar-right">
                    <!-- Authentication Links -->
                    @if (Auth::guest())
                    <!--Login 되어 있지 않으면 메뉴바에 Login 과 Register가 나타난다 -->
                    <!--아래 문장은 login을 클릭하면 login 글씨가 active를 의미하는 색갈로 된 box로 감싸주는 역할을 한다-->
                    <!--현재는 사용 중단-->
                    <!--<li class="{{ Request::is('login') ? "active" : "" }}">-->
                    <!--Login-->
                    <li>
                        <a href="{{url('/login') }}">Login</a>
                    </li>

                    <!--Register-->
                    <!--아래 문장은 Register을 클릭하면 Register 글씨가 active를 의미하는 색갈로 된 box로 감싸주는 역할을 한다-->
                    <!--현재는 사용 중단-->
                    <!--<li class="{{ Request::is('register') ? " active" : "" }}">
                        <a href="{{ url('/register') }}">Register</a>
                    </li>-->
                    <li>
                        <a href="{{ url('/register') }}">Register</a>
                    </li>

                    @else
                    <!--Login이 되어 있으면 메뉴바에 user 이름과 Logout이 나타난다-->
                    <!--user 이름-->
                    <li>
                        <a href="#">
                            <!--{{Auth::user()->name.' '.Auth::user()->lastname }}-->
                            {{Auth::user()->name }}
                        </a>
                    </li>
                    <!--Logout-->
                    <!--<li class="{{ Request::is('logout') ? "active" : "" }}">-->
                    <li>
                        <a href="{{ url('/logout') }}"
                            onclick="event.preventDefault();
                                            document.getElementById('logout-form').submit();">
                            Logout
                        </a>

                        <form id="logout-form" action="{{ url('/logout') }}" method="POST" style="display: none;">
                            {{csrf_field() }}
                        </form>
                    </li>
                    @endif

                    <!--나의쇼핑-->
                    <li class="{{ Request::is('order/showOrderTotal') ? " active" : "" }}">
                        <a href="/order/showOrderTotal" class="myShopping">나의쇼핑</a>
                    </li>
                    <!--아래 문장은 장바구니를 클릭하면 장바구니 글씨가 active를 의미하는 색갈로 된 box로 감싸주는 역할을 한다-->
                    <!--현재는 사용 중단-->
                    <!--<li class="{{ Request::is('shoppingcart/cartList') ? "active" : "" }}">-->
                    <!--장바구니-->
                    <li>
                        <!--장바구니 메뉴 우측에 상품 수를 보여 준다-->
                        <a href="/shoppingcart/cartListWithCdn">
                            장바구니
                            <!--<span style="top: -11px; position: relative; color: white; font-size: 11px; 
                                                 width: 20px; height: 20px; border-radius: 50%; background: blue;
                                                 text-align: center;"
                                class="num_cart"></span>-->
                            <!--위 코드를 사용 하다 중단 하고 아래 코드로 대치 했음. 장바구니 글자 위에-->
                            <!--숫자를 오버랩 하기 위해 z-index를 추가 했음. margin, display도 추가-->
                            <!--position, top도 변경 했음-->
                            <span style="top: 0px; position: absolute; color: white; font-size: 11px; 
                                                 width: 20px; height: 20px; border-radius: 50%; background: blue;
                                                 text-align: center; z-index: 2; margin-left: 30px; display: none;"
                                class="num_cart"></span>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!--하단 메뉴바-->
    <nav class="navbar navbar-default navbar-fixed-bottom" role="navigation" id="secondNavBar">
        <div class="container">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-2">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="/">HOME</a>
            </div>

            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-2">
                <ul class="nav navbar-nav">
                    <li>
                        <a href="#" class="nav_cross">X</a>
                    </li>
                </ul>
                <ul class="nav navbar-nav">
                    <!--myProducts라는 쿠키가 존재하면...-->
                    @if (Cookie::get('myProducts'))
                    <li>
                        <a href="#" class="click_latestWatch">
                            <div>
                                <div class="latestMenu_text">
                                    최근검색상품&nbsp;
                                    <i id="chevron_down_latest" class="glyphicon glyphicon-chevron-down"></i>
                                    <i id="chevron_up_latest" style="display: none;" class="glyphicon glyphicon-chevron-up"></i>
                                </div>
                            </div>
                        </a>
                    </li>
                    @endif
                </ul>
                <ul class="nav navbar-nav">
                    <li>
                        <a href="/customercenter/index">고객센터</a><!--임시 링크 10/03/2019-->
                    </li>
                </ul>
                <!--하단 메뉴바 내의 서치 박스-->
                <form action="/home/search" method="GET" class="navbar-form navbar-left" role="search">
                    <div class="form-group">
                        <!--<input type="text" class="form-control input-lg" placeholder="Search">-->
                        <input type="text" class="form-control input-lg" name="searchTerm" id="searchTerm2" value="{{old('searchTerm') }}" placeholder="Search" required />
                    </div>
                    <!--<button type="submit" class="btn btn-default" style="font-size: 22px;">Submit</button>-->
                    <button class="btn btn-default" id="btnSerach2" type="submit" style="font-size: 22px;" onclick="return checkFields2();">Submit</button>
                </form>
                <ul class="nav navbar-nav navbar-right">
                    <!--<li><a href="#" class="nav_cross">X</a></li>-->
                    <li>
                        <a href="/qaboard/index">질의응답</a>
                        <!--<a href="#" class="qaIndex">질의응답</a>-->
                    </li>
                    <li class="{{ Request::is('order/showOrderTotal') ? " active" : "" }}">
                        <a href="/order/showOrderTotal">나의쇼핑</a>
                    </li>
                    <li class="{{ Request::is('shoppingcart/cartListWithCdn') ? " active" : "" }}">
                        <a href="/shoppingcart/cartListWithCdn">
                            장바구니
                            <!--<span style="top: -11px; position: relative; color: white; font-size: 11px; 
                                                 width: 20px; height: 20px; border-radius: 50%; background: blue;
                                                 text-align: center;"
                                class="num_cart"></span>-->
                            <!--위 코드를 사용 하다 중단 하고 아래 코드로 대치 했음. 장바구니 글자 위에-->
                            <!--숫자를 오버랩 하기 위해 z-index를 추가 했음. margin, display도 추가-->
                            <!--position, top도 변경 했음-->
                            <span style="top: 0px; position: absolute; color: white; font-size: 11px; 
                                                 width: 20px; height: 20px; border-radius: 50%; background: blue;
                                                 text-align: center; z-index: 2; margin-left: 30px; display: none;"
                                class="num_cart"></span>
                        </a>
                    </li>
                    <li>
                        <a href="#">
                            <i class="glyphicon glyphicon-arrow-up nav_arrow_up"></i>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!--상단메뉴 와 하단메뉴 사이의 중앙뷰로 실질적인 내용이 담긴다-->
    <!--이 중앙뷰는 상단의 전체메뉴를 클릭시 오버랩되어 전체메뉴가 보여진다-->
    <div class="container">
        <!--전체메뉴를 보여줄 자리. 처음에는 숨겨 놓는다...-->
        <!--이부분을 수행 할 경우 모달다이얼로그가 작동하지 않음: 이유 찾는중...-->
        <div class="row detailMenu" style="display: none; margin-right: 0px;">
            <div class="col-sm-12 col-md-12 col-lg-12">
                <div id="detailMenu_section"
                    style="background-color: white; min-height: 420px; width: 97.35%; border: 2px solid black;
                     z-index: 19; position: absolute;">
                    <!--<span style="color: blue;">메뉴 데이터 로딩중...</span>-->
                </div>
            </div>
        </div>

        <!--각기 다른 view에서 만둘어진 내용이 이곳을 채운다-->
        <div class="mainLayout_container">

            @yield('content')

        </div>
        
    </div>
 
    <!--회사 소개, 채용정보, 이용약관 등... -->
    <div class="container">
        <div class="row" style="margin-right: 0px;">
            <div class="col-sm-12 col-md-12 col-lg-12">                
                <table class="table3333">
                    <tr class="tr">
                        <td class="td1">
                            <a href="javascript:void(0)">
                                <div>회사소개</div>
                            </a>
                        </td>
                        <td class="td1">
                            <a href="javascript:void(0)">
                                <div>
                                    <b>채용정보</b>
                                </div>
                            </a>
                        </td>
                        <td class="td3">
                            <a href="javascript:void(0)">
                                <div>이용약관</div>
                            </a>
                        </td>
                        <td class="td4">
                            <a href="javascript:void(0)">
                                <div>전자금융거래약관</div>
                            </a>
                        </td>
                        <td class="td5">
                            <a href="javascript:void(0)">
                                <div>
                                    <b>개인정보취급방침</b>.청소년보호정책
                                </div>
                            </a>
                        </td>
                        <td class="td1">
                            <a href="javascript:void(0)">
                                <div>제휴광고</div>
                            </a>
                        </td>
                        <td class="td1">
                            <a href="javascript:void(0)">
                                <div>판매자광고</div>
                            </a>
                        </td>
                        <td class="td1">
                            <a href="javascript:void(0)">
                                <div>판매자교육센터</div>
                            </a>
                        </td>
                        <td class="td1">
                            <a href="javascript:void(0)">
                                <div>판매관리</div>
                            </a>
                        </td>
                    </tr>
                </table>
            </div>
        </div>

        <!--고객센터 (주)이베이코리아 전자금융분쟁처리-->
        <div class="row" style="margin-right: 0px; word-break: break-all;">
            <div class="col-sm-12 col-md-12 col-lg-12">
                <div class="col-sm-4 col-md-4 col-lg-4 company_bottom_corp_margin">
                    <a href="#">
                        <b>고객센터 ></b>
                    </a>
                    <div class="company_bottom_box company_bottom_boder">
                        <a href="#">
                            sdsdsdsdsdsdsdeerr
                            <br />
                            sdsdsdsdsdsdrtrtrtrtrtrtrtrt
                            <br />
                            sdsdsdsdsdsdsdsdsdsdsdsd
                            <br />
                        </a>
                    </div>
                </div>
                <div class="col-sm-4 col-md-4 col-lg-4 company_bottom_corp_margin">
                    <a href="#">
                        <b>(주)이베이코리아 ></b>
                    </a>
                    <div class="company_bottom_box company_bottom_boder">
                        <a href="#">
                            sdsdsdsdsdsdsd
                            <br />
                            sdsdsdsdsdsd
                            <br />
                            sdsdsdsdsdsdsdsdsdsdsdsd
                            <br />
                        </a>
                    </div>
                </div>
                <div class="col-sm-4 col-md-4 col-lg-4 company_bottom_corp_margin">
                    <a href="#">
                        <b>전자금융분쟁처리 ></b>
                    </a>
                    <div class="company_bottom_box">
                        <a href="#">
                            sdsdsdsdsdsdsd
                            <br />
                            sdsdsdsdsdsd
                            <br />
                            sdsdsdsdsdsdsdsdsdsdsdsd
                            <br />
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <!--밑줄-->
        <div class="row" style="margin-right: 0px;">
            <div class="col-sm-12 col-md-12 col-lg-12">
                <hr />
            </div>
        </div>

        <!--최근에 본 상품 보여주기(쿠키 값["myProducts"]을 체크하여 값이 있으면 보여준다.) ==> 처음에는 숨긴다-->
        <div id="latestWatchProduct" style="display: none; background-color: white; z-index: 3; position: fixed; bottom: 60px; width: 60%;">
            <!--쿠키를 검색하여 최근에 본 상품이 앞에 오도록 어레이를 이용 재 가공한다.-->
            <?php
            $products = [];  //어레이 선언          
            if (Cookie::get('myProducts'))  //myProducts(product/details View에서 만든)라는쿠키가 있으면
            {
                $i = 0;

                foreach (Cookie::get('myProducts') as $name => $value)
                {
                    $name = htmlspecialchars($name);        //순서대로 읽어서 어레이에 저장한다.
                    $value = htmlspecialchars($value);
                    $products[$i]['pId'] = $name;
                    $products[$i]['fName'] = $value;
                    $i++;
                }
                ////$count = count($products);
                ////$ix = $count - 1;
                ////                                     //어레이에 저장된 내용을 역순으로 읽어
                ////for ($ii = $ix; $ii >= 0; $ii--) {   //맨 끝 내용이 맨 앞으로 오게 한다.
                ////    $pdId = $products[$ii]['pId'];
                ////    $flName = $products[$ii]['fName'];
                ////}
            ?>
            <!--Ajax에서 사용한다-->
            <span style="display: none;" class="cookieExist">
                Y
            </span>
            <?php
            }
            ?>

            <?php
            $count = count($products);
            $ix = $count - 1;
            ?>
            
            <div class="row">
                <div class="col-sm-12 col-md-12 col-lg-12">
                    <?php
                    for ($ii = $ix; $ii >= 0; $ii--)    //어레이에 저장된 내용을 역순으로 읽어
                    {                                   //맨 끝 내용이 맨 앞으로 오게 한다.
                        $pdId = $products[$ii]['pId'];  //수정해야함18/04/2019
                        $flName = $products[$ii]['fName'];                         
                    ?>
                    <!--썸네일로 보여준다-->
                    <!--class="thumb_nail_show" => jquery로 trim 하여야 썸네일이 보인다.중요.10/05/2019-->
                    <div style="border: 1px solid blue; width: 100px; height: 100px; margin-bottom: 3px; margin-right: 3px; float: left;" class="watchProduct">
                        <a href="/product/detailsWithCdn/{{ $pdId }}">
                            <div class="thumb_nail_show">
                                <?=$flName?>
                            </div>
                        </a>
                        <span style="display : none" class="watchProductId">
                            {{ $pdId }}
                        </span>
                        <div style="border: 1px solid blue; width: 20px; height: 20px; top: -100px;
                                right: -80px; z-index: 3; position: relative; background: blue;
                                text-align: center; display: none;"
                            class="watchProductClose">
                            <a class="clickWatchClose" href="#">
                                <span style="color: white;">X</span>
                            </a>
                        </div>
                    </div>

                    <?php
                    }
                    ?>
                </div>
            </div>
        </div><!--최근에 본 상품 보여주기 끝-->

        <div style="clear: both;"></div>
        <br />


        <!--footer-->
        <footer id="footer" class="myfooter_twoNavs">
            <p style="color: blue;">Copyright &copy; LaraVelMall Co.,Ltd. All right reserved.</p>
        </footer>

    </div><!--회사 소개, 채용정보, 이용약관 등...-->

    <hr />
        
    <script src="/myJs/myLayout.js"></script>
      
    <!--처음 화면 로드시에 전체메뉴를 준비해서 숨겨놓는다-->
    <script>       
    </script>

    <!--페이지 로드시 현재 보고 있는 페이지 메뉴에 active 속성 부여-->
    <script>        
    </script>

    <!--서치필드의 글자수를 체크 하고 문자 시작 과 끝의 공백을 제거한다.-->
    <script>       
    </script>
   
    <!--최근에 조회한 상품을 보여준다.-->
    <!--바텀메뉴바에 있는 "최근본상품"을 클릭하면 내용을 보여 주거나 숨긴다.-->
    <script>        
    </script>

    <!--아래는 탑메뉴의 장바구니에 현재 쇼핑카트에 들어있는 총건수를 보여주는 코드-->
    <!--아래는 별도 js file로 분리 할 경우 작동 불가...22/05/2019-->
    <script>
    $(function () {
        var email = "<?php if  (!Auth::guest())  echo Auth::user()->email ; ?>";      
        var cartCount = "<?php echo session()->get('laravelCartCount','default_value'); ?>";       
        if (email != '' && cartCount > 0)  //로그인되고 카트에 상품이 있을 때에만 상태에서만 보여준다.
        {
            $('.num_cart').empty().append(cartCount);
            $('.num_cart').show();  //새로 추가 04/Mar/2019
        }
    });      
    </script>
    
    <!--아래는 매우 중요 절대 지우지 말 것.10/05/2019-->
    <!--thumb nail  있는 자리를 trim 해 주어야 thumb nail이 보인다.-->
    <script>        
    </script>   
</body><!--class="body_position"-->

</html>
