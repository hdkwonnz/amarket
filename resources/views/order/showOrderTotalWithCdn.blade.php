@extends('layouts.app')

@section('title')
Order-showOrderTotal
@endsection

@section('content')

<link href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.css" rel="stylesheet" />

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
            /*border-bottom: solid 1px rgba(128, 128, 128, 0.26);*/ /*및줄귿기*/
            padding-top: 0px;
            padding-bottom: 10px;
        }

    .date_width, .info_width {
        border-bottom: solid 1px rgba(128, 128, 128, 0.26); /*및줄귿기*/
    }

    .webgrid-header {
        padding-bottom: 4px;
        padding-top: 5px;
        text-align: left;
    }

    .webgrid-footer {
    }

    .webgrid-row-style td {
    }

    .webgrid-alternating-row {
    }

    .date_width {
        width: 14%;
        word-break: break-all;
        vertical-align: top;
    }

    .info_width {
        width: 86%;
        word-break: break-all;
    }

    .image_width {
        width: 15%;
        border-bottom: none;
        padding-top: 0px;
        padding-bottom: 0px;
    }

    .name_width {
        width: 60%;
        border-bottom: none;
        word-break: break-all;
    }

    .recipient_width {
        width: 15%;
        word-break: break-all;
    }

    .confirm_width {
        width: 10%;
        word-break: break-all;
    }
</style>

<!--화면 좌측 박스메뉴에 대한 CSS 재정의(list-group-item: bootstrap class)-->
<style>
    .list-group-item div:hover {
        background-color: black;
        color: white;
    }

    .list-group-item {
        margin: 0px;
        padding: 0px;
    }
</style>

<div class="row">
    <!--왼쪽사이드 메뉴-->
    <div class="col-sm-2 col-md-2 col-lg-2 leftSideMenu">
        <div class="allOrderShow">
            <div class="allOrderShowChildren">
                <a href="/order/showOrderTotal" class="list-group-item">
                    <div style="height: 60px; line-height: 60px; font-size: 20px; color: white; padding-left: 10px;" class="color_dark_blue">
                        전체 주문 내역
                    </div>
                </a>
            </div>
        </div>

        <div class="smilePay">
            <a href="#" class="list-group-item  color_light_blue">
                <div style="padding-left: 15px; height: 60px; line-height: 60px; vertical-align: central; font-size: 20px; color: white;">
                    Smile Pay&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;>
                </div>
            </a>
            <div class="smilePayChildren"
                style="border: 2px solid blue; min-height: 30px; width: 170px; background-color: white;
                        left: 179px; top: 62px; position: absolute; z-index: 2; display: none;">
                <div style="height: 40px; border-bottom: 1px solid rgba(128, 128, 128, 0.25); margin-left: 10px; margin-right: 5px;">
                    <a href="#">
                        <div style="width: 100%; height: 100%; line-height: 40px; vertical-align: central;">
                            Smile Cach 내역
                        </div>
                    </a>
                </div>
                <div style="height: 40px; border-bottom: 1px solid rgba(128, 128, 128, 0.25); margin-left: 10px; margin-right: 5px;">
                    <a href="#">
                        <div style="width: 100%; height: 100%; line-height: 40px; vertical-align: central;">
                            Smile Point 내역
                        </div>
                    </a>
                </div>
                <div style="height: 40px; border-bottom: 1px solid rgba(128, 128, 128, 0.25); margin-left: 10px; margin-right: 5px;">
                    <a href="#">
                        <div style="width: 100%; height: 100%; line-height: 40px; vertical-align: central;">
                            Gift Card
                        </div>
                    </a>
                </div>
            </div>
        </div>

        <div class="coupon">
            <a href="#" class="list-group-item  color_light_blue">
                <div style="padding-left: 15px; height: 60px; line-height: 60px; vertical-align: central; font-size: 20px; color: white;">
                    쿠 폰&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;>
                </div>
            </a>
            <div class="couponChildren"
                style="border: 2px solid blue; min-height: 30px; width: 170px; background-color: white;
                        left: 179px; top: 124px; position: absolute; z-index: 2; display: none;">
                <div style="height: 40px; border-bottom: 1px solid rgba(128, 128, 128, 0.25); margin-left: 10px; margin-right: 5px;">
                    <a href="#">
                        <div style="width: 100%; height: 100%; line-height: 40px; vertical-align: central;">
                            쿠 폰
                        </div>
                    </a>
                </div>
                <div style="height: 40px; border-bottom: 1px solid rgba(128, 128, 128, 0.25); margin-left: 10px; margin-right: 5px;">
                    <a href="#">
                        <div style="width: 100%; height: 100%; line-height: 40px; vertical-align: central;">
                            G 스탬프
                        </div>
                    </a>
                </div>
            </div>
        </div>

        <div class="myInterest">
            <a href="#" class="list-group-item  color_light_blue">
                <div style="padding-left: 15px; height: 60px; line-height: 60px; vertical-align: central; font-size: 20px; color: white;">
                    나의관심&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;>
                </div>
            </a>
            <div class="myInterestChildren"
                style="border: 2px solid blue; min-height: 30px; width: 170px; background-color: white;
                        left: 179px; top: 186px; position: absolute; z-index: 2; display: none;">
                <div style="height: 40px; border-bottom: 1px solid rgba(128, 128, 128, 0.25); margin-left: 10px; margin-right: 5px;">
                    <a href="#">
                        <div style="width: 100%; height: 100%; line-height: 40px; vertical-align: central;">
                            관심 상품
                        </div>
                    </a>
                </div>
                <div style="height: 40px; border-bottom: 1px solid rgba(128, 128, 128, 0.25); margin-left: 10px; margin-right: 5px;">
                    <a href="#">
                        <div style="width: 100%; height: 100%; line-height: 40px; vertical-align: central;">
                            구매 매장
                        </div>
                    </a>
                </div>
                <div style="height: 40px; border-bottom: 1px solid rgba(128, 128, 128, 0.25); margin-left: 10px; margin-right: 5px;">
                    <a href="#">
                        <div style="width: 100%; height: 100%; line-height: 40px; vertical-align: central;">
                            관심매장
                        </div>
                    </a>
                </div>
                <div style="height: 40px; border-bottom: 1px solid rgba(128, 128, 128, 0.25); margin-left: 10px; margin-right: 5px;">
                    <a href="#">
                        <div style="width: 100%; height: 100%; line-height: 40px; vertical-align: central;">
                            최근 본 상품
                        </div>
                    </a>
                </div>
                <div style="height: 40px; border-bottom: 1px solid rgba(128, 128, 128, 0.25); margin-left: 10px; margin-right: 5px;">
                    <a href="#">
                        <div style="width: 100%; height: 100%; line-height: 40px; vertical-align: central;">
                            이벤트 응모/당첨
                        </div>
                    </a>
                </div>
            </div>
        </div>

        <div class="myMessage">
            <a href="#" class="list-group-item  color_light_blue">
                <div style="padding-left: 15px; height: 60px; line-height: 60px; vertical-align: central; font-size: 20px; color: white;">
                    내가쓴글&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;>
                </div>
            </a>
            <div class="myMessageChildren"
                style="border: 2px solid blue; min-height: 30px; width: 170px; background-color: white;
                        left: 179px; top: 248px; position: absolute; z-index: 2; display: none;">
                <div style="height: 40px; border-bottom: 1px solid rgba(128, 128, 128, 0.25); margin-left: 10px; margin-right: 5px;">
                    <a href="#">
                        <div style="width: 100%; height: 100%; line-height: 40px; vertical-align: central;">
                            문의 답변
                        </div>
                    </a>
                </div>
                <div style="height: 40px; border-bottom: 1px solid rgba(128, 128, 128, 0.25); margin-left: 10px; margin-right: 5px;">
                    <a href="#">
                        <div style="width: 100%; height: 100%; line-height: 40px; vertical-align: central;">
                            상품평
                        </div>
                    </a>
                </div>
                <div style="height: 40px; border-bottom: 1px solid rgba(128, 128, 128, 0.25); margin-left: 10px; margin-right: 5px;">
                    <a href="#">
                        <div style="width: 100%; height: 100%; line-height: 40px; vertical-align: central;">
                            MY 쪽찌함
                        </div>
                    </a>
                </div>
            </div>
        </div>

        <div class="myInfo">
            <a href="#" class="list-group-item  color_light_blue">
                <div style="padding-left: 15px; height: 60px; line-height: 60px; vertical-align: central; font-size: 20px; color: white;">
                    나의설정&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;>
                </div>
            </a>
            <div class="myInfoChildren"
                style="border: 2px solid blue; min-height: 30px; width: 170px; background-color: white;
                        left: 179px; top: 310px; position: absolute; z-index: 2; display: none;">
                <div style="height: 40px; border-bottom: 1px solid rgba(128, 128, 128, 0.25); margin-left: 10px; margin-right: 5px;">
                    <a href="#" class="memberClick">
                        <div style="width: 100%; height: 100%; line-height: 40px; vertical-align: central;">
                            회원 정보 설정
                        </div>
                    </a>
                </div>
                <div style="height: 40px; border-bottom: 1px solid rgba(128, 128, 128, 0.25); margin-left: 10px; margin-right: 5px;">
                    <a href="#" class="addressClick">
                        <div style="width: 100%; height: 100%; line-height: 40px; vertical-align: central;">
                            주서록 설정
                        </div>
                    </a>
                </div>
                <div style="height: 40px; border-bottom: 1px solid rgba(128, 128, 128, 0.25); margin-left: 10px; margin-right: 5px;">
                    <a href="#" class="siteClick">
                        <div style="width: 100%; height: 100%; line-height: 40px; vertical-align: central;">
                            사이트 관련 설정
                        </div>
                    </a>
                </div>
                <div style="height: 40px; border-bottom: 1px solid rgba(128, 128, 128, 0.25); margin-left: 10px; margin-right: 5px;">
                    <a href="#" class="orderPayClick">
                        <div style="width: 100%; height: 100%; line-height: 40px; vertical-align: central;">
                            주문/결제 관련 설정
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </div><!--왼쪽사이드 메뉴-->

    <!--화면 중앙메뉴-->
    <div class="col-sm-10 col-md-10 col-lg-10">
        <div class="row">
            <div class="col-sm-7 col-md-7 col-lg-7">
                <!--메인메뉴바에서 나의쇼핑을 클릭 하면 class="first_title"이 보인다-->
                <div class="first_title">
                    <!--class="first_title"-->
                    <span style="font-size: 30px;">최근주문내역</span>
                    <span style="margin-left: 10px;">1개월</span>
                    <span style="margin-left: 10px;">
                        <a href="#" class="click_first_title">
                            <span style="border: 1px solid black;">
                                지난 주문내역 더보기 >
                            </span>
                        </a>
                    </span>
                </div><!--class="first_title"-->

                <!--위의 "지난 주문내역 더보기"를 클릭하면 class="first_title"가 숨겨지고-->
                <!--아래의 class="second_title"가 보인다-->
                <div class="second_title" style="display: none; font-size: 30px;">
                    <!--class="second_title"-->
                    <span>주문내역</span>
                </div><!--class="second_title"-->
            </div>
            <div class="col-sm-2 col-md-2 col-lg-2">
                <div style="border: 1px solid rgba(128, 128, 128, 0.62); width: 95%; height: auto; background: rgba(128, 128, 128, 0.31); margin-top: 30px;" class="text-center">
                    <a href="#">
                        <span>
                            <i class="glyphicon glyphicon-print"></i>영수증/계산서
                        </span>
                    </a>
                </div>
            </div>
            <div class="col-sm-3 col-md-3 col-lg-3" style="padding-right: 30px;">
                <div style="border: 1px solid rgba(128, 128, 128, 0.62); width: 90%; height: auto; margin-top: 30px; float: left;">
                    <div class="show_all_status" style="display: none; background: white; border: 1px solid black; width: 88%; height: auto; z-index: 2; position: absolute;">
                        <span>최근 주문 내역(0)건</span>
                        <br />
                        <span>주문 진행 중(0)건</span>
                        <br />
                        <span>취소/반품/교환 중(0)건</span>
                        <br />
                        <span>배송 완료(0)건</span>
                        <br />
                        <span>취소/반품/교환 완료(0)건</span>
                        <br />
                    </div>
                    <div>최근 주문내역(0)건</div>

                </div>
                <div class="show_status text-center" style="border: 1px solid rgba(128, 128, 128, 0.62); width: 10%; height: auto; margin-top: 30px; float: left;">
                    <div>
                        <i class="glyphicon glyphicon-chevron-down"></i>
                    </div>
                </div>

            </div>
        </div><!--class="row"(화면 중앙메뉴 바로 아래)-->

        <?php   //지우지 말것...
//$month = date("Y-m-d H:i:s", strtotime("-6 months"));
//$day = date("Y-m-d H:i:s", strtotime("-6 days"));
//$today_yymmdd = date('Y-m-d');  //오늘
//$today_yymmddhis = date('Y-m-d H:i:s');  //오늘 + 시간
//$yymmddhis = date("Y-m-d H:i:s", strtotime("-1 months"));  //한달전 yymmddhis
//$yymmdd = date("Y-m-d", strtotime("-1 months"));  //한달전 yymmdd
//$mm = date("m", strtotime("-1 months"));  //한달전 mm
//$current_month=date('m');  //이달
////$letter_month = date('M', strtotime($current_month . '01'));  //달을 문자로????=>틀림
//$current_year=date('Y');  //금년
//$first_day_this_month = date('m-01-Y');  // 이달 첫 날(mmddYY)
//$first_day_this_month2 = date('Y-m-01');  // 이달 첫 날(YYmmdd)
//$first_day_this_month3 = date('Y-m-01',strtotime("-1 months"));  // 전달 첫 날(YYmmdd)
//$first_day_this_month4 = date('Y-m-01 00:00:00',strtotime("-1 months"));  // 전달 첫 날(YYmmddHis)
//$last_day_this_month  = date('m-t-Y');   //이달 마지막 날(mmddYY)
//$last_day_this_month2  = date('Y-m-t');   //이달 마지막 날(YYTmmdd)
//$last_day_this_month3  = date('Y-m-t', strtotime("-1 months"));   //전달 마지막 날(YYTmmdd)
        ?>

        <?php
        ////"Y"가 소문자이면 yymmdd로나오고 대문자이면 YYYYMMDD로 나온다...
        $oneMonthFirst = date('Y-m-01',strtotime("-1 months"));  // 전달 첫 날(YYmmdd)
        $oneMonthLast = date('Y-m-t 23:59:59', strtotime("-1 months"));   //전달 마지막 날(YYTmmdd)
        $twoMonthFirst = date('Y-m-01',strtotime("-2 months"));
        $twoMonthLast = date('Y-m-t 23:59:59', strtotime("-2 months"));
        $threeMonthFirst = date('Y-m-01',strtotime("-3 months"));
        $threeMonthLast = date('Y-m-t 23:59:59', strtotime("-3 months"));
        $fourMonthFirst = date('Y-m-01',strtotime("-4 months"));
        $fourMonthLast = date('Y-m-t 23:59:59', strtotime("-4 months"));
        $fiveMonthFirst = date('Y-m-01',strtotime("-5 months"));
        $fiveMonthLast = date('Y-m-t 23:59:59', strtotime("-5 months"));
        $sixMonthFirst = date('Y-m-01',strtotime("-6 months"));
        $sixMonthLast = date('Y-m-t 23:59:59', strtotime("-6 months"));

        $oneMonthBeforeYMD = date("Y-m-d", strtotime("-15 days"));  //한달전 YYYYMMDD, 상품평쓰기에 사용

        ////2019년 3월에 3일 아침까지 A방법을 사용하다 3월3일 오후 부터 B방법으로 다시 전환
        ////원래 B방법은 2016년에 코딩 하였으나 2월이 나와야 할때 3월이 다시 나와 사용 중지 했음
        ////**********B방법************
        $oneMonthBefore = date("m", strtotime("-1 months"));   //한달전 mm (현재시점으로 2016년4월)
        $twoMonthBefore = date("m", strtotime("-2 months"));   //(현재시점으로 3월)
        $threeMonthBefore = date("m", strtotime("-3 months")); //이렇게 헸을 경우 3월이 다시나옴. php bug????
        $fourMonthBefore = date("m", strtotime("-4 months"));  //(현재시점으로 1월)
        $fiveMonthBefore = date("m", strtotime("-5 months"));  //(현재시점으로 12월)
        $sixMonthBefore = date("m", strtotime("-6 months"));   //(현재시점으로 11월)

        ////**********A방법(임시방법)*********
        ////현재(03/03/2019) 까지 아래 코드를 사용했으나 한달전mm($oneMonthBefore)이 2월이 나오지 않고
        ////1월이 나와 사용 중지. 위 코드로 대치 했으나 다음 달 4월에 bug를 체크해야 함...
        //$oneMonthBefore = date("m", strtotime("-31 days"));  //한달전 mm
        //$oneMonthBeforeYMD = date("Y-m-d", strtotime("-15 days"));  //한달전 YYYYMMDD
        //$twoMonthBefore = date("m", strtotime("-62 days"));
        //$threeMonthBefore = date("m", strtotime("-93 days"));
        //$fourMonthBefore = date("m", strtotime("-124 days"));
        //$fiveMonthBefore = date("m", strtotime("-155 days"));
        //$sixMonthBefore = date("m", strtotime("-186 days"));
        ?>

        <!--Aajx에서 사용하기 위해 데이터를 숨긴다.-->
        <div>
            <input type="hidden" value="<?php echo $oneMonthFirst ?>" id="oneMonthFirst" />
            <input type="hidden" value="<?php echo $oneMonthLast ?>" id="oneMonthLast" />
            <input type="hidden" value="<?php echo $twoMonthFirst ?>" id="twoMonthFirst" />
            <input type="hidden" value="<?php echo $twoMonthLast ?>" id="twoMonthLast" />
            <input type="hidden" value="<?php echo $threeMonthFirst ?>" id="threeMonthFirst" />
            <input type="hidden" value="<?php echo $threeMonthLast ?>" id="threeMonthLast" />
            <input type="hidden" value="<?php echo $fourMonthFirst ?>" id="fourMonthFirst" />
            <input type="hidden" value="<?php echo $fourMonthLast ?>" id="fourMonthLast" />
            <input type="hidden" value="<?php echo $fiveMonthFirst ?>" id="fiveMonthFirst" />
            <input type="hidden" value="<?php echo $fiveMonthLast ?>" id="fiveMonthLast" />
            <input type="hidden" value="<?php echo $sixMonthFirst ?>" id="sixMonthFirst" />
            <input type="hidden" value="<?php echo $sixMonthLast ?>" id="sixMonthLast" />
        </div>

        <!--"최근 주문내역"에서 "지난 주문내역 더보기"를 클릭 하면 class="first_title"가 숨겨지고-->
        <!--아래 class="show_term_title"를 보여 준다.-->
        <div style="width: 100%; height: auto; background: rgba(128, 128, 128, 0.16); 
                    line-height: 40px; vertical-align: central; display: none; margin-left: -15px;"
            class="show_term_title">
            <div class="row">
                <div class="col-sm-7 col-md-7 col-lg-7">
                    <div>

                        <table style="font-size: 18px;">
                            <tr>
                                <td>
                                    <span>기간별 조회</span>
                                </td>
                                <td>
                                    <span>&nbsp;&nbsp;</span>
                                </td>
                                <td>
                                    <a href="#" style="background: white;">
                                        <span class="oneWeek">1주일</span>
                                    </a>
                                </td>
                                <td>
                                    <span>&nbsp;</span>
                                </td>
                                <td>
                                    <a href="#" style="background: white;">
                                        <span class="fifteenDays">15일</span>
                                    </a>
                                </td>
                                <td>
                                    <span>&nbsp;</span>
                                </td>
                                <td>
                                    <a href="#" style="background: white;">
                                        <span class="oneMonth">1개월</span>
                                    </a>
                                </td>
                                <td>
                                    <span>&nbsp;&nbsp;&nbsp;</span>
                                </td>
                                <td>
                                    <a href="#" style="background: white;">
                                        <span class="oneMonthBefore">
                                            <?=$oneMonthBefore?>월
                                        </span>
                                    </a>
                                </td>
                                <td>
                                    <span>&nbsp;</span>
                                </td>
                                <td>
                                    <a href="#" style="background: white;">
                                        <span class="twoMonthBefore">
                                            <?=$twoMonthBefore?>월
                                        </span>
                                    </a>
                                </td>
                                <td>
                                    <span>&nbsp;</span>
                                </td>
                                <td>
                                    <a href="#" style="background: white;">
                                        <span class="threeMonthBefore">
                                            <?=$threeMonthBefore?>월
                                        </span>
                                    </a>
                                </td>
                                <td>
                                    <span>&nbsp;</span>
                                </td>
                                <td>
                                    <a href="#" style="background: white;">
                                        <span class="fourMonthBefore">
                                            <?=$fourMonthBefore?>월
                                        </span>
                                    </a>
                                </td>
                                <td>
                                    <span>&nbsp;</span>
                                </td>
                                <td>
                                    <a href="#" style="background: white;">
                                        <span class="fiveMonthBefore">
                                            <?=$fiveMonthBefore?>월
                                        </span>
                                    </a>
                                </td>
                            </tr>
                        </table>

                    </div>
                </div>
                <div class="col-sm-2 col-md-2 col-lg-2" style="padding-left: 0; padding-right: 0px; padding-top: 10px;">
                    <input type="text" id="txtFromDate" name="txtFromDate" value="" readonly style="width: 80%; height: 30px;" placeholder="Start Date" />
                    <span>&nbsp;&nbsp;~</span>
                </div>
                <div class="col-sm-2 col-md-2 col-lg-2" style="padding-left: 0; padding-top: 10px;">
                    <input type="text" id="txtToDate" name="txtToDate" value="" readonly style="width: 80%; height: 30px;" placeholder="End Date" />
                </div>
                <div class="col-sm-1 col-md-1 col-lg-1" style="padding-left: 0;">
                    <button type="button" id="btnBtn" name="btnBtn" value="" class="btn btn-sm btn-info" style="margin-top: 7px;">조회</button>
                </div>
            </div>
        </div><!--class="show_term_title"-->

        <!--<div style="margin-top: 7px;"></div>-->

        <!--기간별 Order 내역을 보여준다.(showOrderTotalByTermView에서 사용)-->
        <!--맨처음 로드시에는 Order/showOrderTotal에서 보내준 데이터로 로드한다-->
        <!--<!--테이블 타이틀(테이블 헤더로 사용)-->
        <!--테이블 헤더 : thead를 사용하지 않고 별도로 코딩-->
        <div class="row" style="background-color: rgba(128, 128, 128, 0.62); margin-right: 15px;">
            <div class="col-md-2">
                <b>날짜/주문번호</b>
            </div>
            <div class="col-md-3 text-left">
                <b>상품정보/모델이름/금액</b>
            </div>
            <div class="col-md-5 text-right">
                <b>배 송</b>
            </div>
            <div class="col-md-2 text-right">
                <b>확인/신청</b>
            </div>
        </div>

        <!--데이터 로딩중...==>메시지 처음 화면 로딩시에는 숨긴다.-->
        <div class="dataLoadingNotice" style="display: none;">
            <span style="color: blue;">데이터 로딩중...</span>
        </div>


        <div id="partialContent" style="padding-right: 0px;">
            <?php
            if ($numRows < 1)
                echo "<span style='color: red; font-size: 25px; '>
                    검색을 원하시는 상품이 없습니다...</span><br />";
            ?>

            <table class="webgrid-table" id="table1" style="padding-right: 15px" ;>
                <tbody>
                    <?php                   
                    $save_orderId = "";
                    ?>
                    @foreach($orderdetails as $item)
                    <?php
                    $str = $item->created_at;
                    $str2 = new DateTime(str_replace("_","",$str));
                    $date = $str2->format('Y-m-d');
                    $orderId = $item->order_id;
                    ?>
                    <tr class="webgrid-row-style">                       
                        <td class="date_width">                                                       
                            @if ($orderId != $save_orderId)
                            <b class="oderDate">
                                <?=$date?>
                            </b>
                            <br />
                            <!--<a href="#" class="btn_details"><div style="background: #ff6a00; width: 58%; text-align: center"><span>DETAILS ></span></div></a>-->
                            <a href="#" class="btn_details" data-toggle="modal" data-target=".bs-example-modal-lg">
                                <div style="background: #ff6a00; width: 58%; text-align: center">
                                    <div>DETAILS ></div>
                                </div>
                            </a>
                            <span style="opacity: 0.5;">Order#:</span>
                            <span class="order_num" style="opacity: 0.5;">
                                <?=$item->order_id?>
                            </span>
                            @endif
                        </td>
                        <td class="info_width">                                                     
                            <?php
                            $quantity = $item->quantity; //orderdetails table의 quantity 값
                            $price = $item->sellPrice; //orderdetails table의 price 값                          
                            $productId = $item->product_id; //products table의 id                          
                            $fileName = $item->product->searchImage; //위에서 얻은 $pictures로 pictures table의 fileName 값                          
                            $modelName = $item->product->modelName;
                            ?>
                            <table id="table2">
                                <tr>
                                    <td class="image_width search_image">
                                        <div>
                                            {{ $fileName }}
                                        </div>
                                    </td>
                                    <td class="name_width">
                                        <input type="hidden" id="productIdAjax" value="<?php echo $productId?>" />
                                        <span>
                                            <?=$modelName?>
                                        </span>
                                        <br />
                                        <span style="opacity: 0.5;">
                                            QTY: <?=$quantity?>개
                                        </span>
                                        <br />
                                        <span style="font-size: 17px;" class="totalPrice_txt">
                                            <?=$price * $quantity?>
                                        </span>
                                        <span>원</span>
                                    </td>
                                    <td class="recipient_width">
                                        <span>추후생성</span>
                                    </td>
                                    <td class="confirm_width">
                                        <?php
                                        if($date >= $oneMonthBeforeYMD)
                                        {
                                        ?>
                                        <a href="/products/initReview?productId=<?=$productId?>" class="btn btn-primary">
                                            프리미엄
                                            <br />
                                            상품평쓰기
                                        </a>
                                        <?php
                                        }
                                        ?>
                                    </td>
                                </tr>
                            </table>
                            
                        </td>
                    </tr>
                    <?php                    
                    $save_orderId = $orderId;
                    ?>
                    @endforeach
                </tbody>
            </table>

            <div class="page_footer">
                {!!$orderdetails->render() !!}
            </div>
        </div><!--id="partialContent"-->

    </div><!--화면 중앙메뉴-->
</div><!--class="row"(맨 처음)-->

<!-- Large modal -->
<!--<button type="button" class="btn btn-primary" data-toggle="modal" data-target=".bs-example-modal-lg">Large modal</button>-->
<div class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <!--<button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <div class='col-sm-4 col-md-4 col-lg-4'></div>
                <div class='col-sm-5 col-md-5 col-lg-5'>
                    <h4 class="modal-title" id="myLargeModalLabel" style="color: blue;">주문상세</h4>
                </div>-->

                <div class='col-sm-11 col-md-11 col-lg-11' style="padding-left: 0px;">
                    <div style="background-color: blue; color: white; line-height: 30px;
                                border: 1px solid blue; min-height: 30px; width: 110%;
                                vertical-align: central;"
                        class="modal-title" id="myLargeModalLabel">
                        <span style="font-size: 20px; margin-right: 10px; margin-left: 10px;">주문상세</span>
                        <span style="margin-left: 10px;">
                            >
                            <span class="modal_oderDate"></span>
                        </span>
                        <span style="margin-left: 10px;">
                            주문번호 :
                            <span class="modal_orderId"></span>
                        </span>
                    </div>
                </div>
                <div class='col-sm-1 col-md-1 col-lg-1' style="padding-left: 0px;">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                </div>
            </div>

            <!--아래 div tag는 원래 modal form에는 없으나 controller에서 테이터가 전송되기 전에-->
            <!--메시지를 보여주기 위해 임의 적으로 추가 하였음. 추후 혹시 문제가 될 수도 있음.04/Mar/2019-->
            <div class="modalNotice" style="display: none; margin-left: 15px;">
                <span>데이터를 로드 중입니다...</span>
            </div>

            <div class="modal-body">
                <!--Ajax에서 data가 들어온다...-->



            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<!--script-->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script
    src="https://code.jquery.com/ui/1.11.4/jquery-ui.min.js"
    integrity="sha256-xNjb53/rY+WmG+4L6tTl9m6PpqknWZvRt0rO1SRnJzw="
    crossorigin="anonymous"></script>
<script src="/myJs/showOrderTotal.js"></script>

<!--금액 편집-->
<script>  
</script>

<!--화면 왼쪽 메뉴박스에 마우스오버하면 하위 메뉴를 보여준다-->
<script>    
</script>

<!--지난 주문내역 더보기를 클릭했을때 그 하위 메뉴에서 실행되는 내용들-->
<script>
</script>

<!--화면좌측 박스메뉴에서 나의설정에서-->
<script>
</script>

<!--
    ////$로 하면 에러가 나서 $m으로 재정의(Jquery UI 사용을 위하여...)
    //// DatePicker의 UI(특히 prev, next 표시)를 바로 쓰기 위해서는 Jquery Ui에서 다운 받은 images파일을
    ////jquery-ui.css가 있는 같은 경로에 두어야한다. 예를들면 아래와 같다.
    ////<link href="~/Content/jquery-ui.css" rel="stylesheet" /> 가 Content 밑에 있으니 images 파일도 Content 도 밑에 있어야 한다... 
-->
<script>        
</script>

<!--아래는 매우 중요 절대 지우지 말 것.13/05/2019-->
<!--이미지값을 trim 해 준다.-->
<script>
</script>
@endsection