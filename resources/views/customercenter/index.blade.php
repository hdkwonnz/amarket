@extends('layouts.app')

@section('title')

Customercenter-index

@endsection

@section('content')

<!--맨 위 긴 메뉴박스-->
<div class="row" style="margin-right: 0px;">
    <div class="col-sm-12 col-md-12 col-lg-12">
        <div style="border-top: 2px solid rgba(0, 38, 255, 0.71); min-height: 40px;
                border-bottom: 1px solid rgba(128, 128, 128, 0.72);
                background-color: rgba(0, 38, 255, 0.35);">
            <div class="col-sm-2 col-md-2 col-lg-2" style="padding-right: 8px;">
                <div style="border-right: 1px solid rgba(128, 128, 128, 0.72);
                    height: 38px; text-align: left; line-height: 40px; vertical-align: central;">
                    <a href="#" class="customerCenterShowAll">
                        <div style="height: 40px;">
                            고객센터전체보기
                            <span class="plus" style="display: none;">
                                <i style="margin-left: 30px;" class="glyphicon glyphicon-plus"></i>
                            </span>
                            <span class="minus">
                                <i style="margin-left: 30px;" class="glyphicon glyphicon-minus"></i>
                            </span>
                        </div>
                    </a>
                </div>
            </div>
            <div class="col-sm-2 col-md-2 col-lg-2" style="padding-left: 0px;">
                <div style="text-align:center; line-height: 40px; vertical-align: central;">
                    <a href="/customercenter/index">
                        <div style="height: 40px; width: 60%;">
                            고객센터 홈
                        </div>
                    </a>
                </div>
            </div>
            <div class="col-sm-8 col-md-8 col-lg-8"></div>
        </div>
    </div>
    <!--위 메뉴박스의 고객센터전체보기를 클릭하면 나오는 내용-->
    <div class="col-sm-12 col-md-12 col-lg-12">
        <div style="border: 2px solid black; width: 100%; min-height: 400px; 
                    z-index: 2; padding-left: 0px; display: none; z-index: 2;
                    top: -2px; position: absolute; background-color: white; width: 97.4%;"
            class="customerCenterAllMenu">
            <div style="margin: 160px;">
                <span>준비중...</span>
            </div>
        </div>
    </div>
</div><!--맨 위 긴 메뉴박스-->

<!--맨 위 긴 메뉴박스 바로 밑 중앙에 있는 메인 화면-->
<div class="row" style="margin-right: 0px;">
    <!--왼쪽의 메뉴박스 중 청색, 녹색 : 구매관련FAQ, 고객센터이용안내...-->
    <div class="col-sm-2 col-md-2 col-lg-2" style="padding-right: 0px;">
        <!--구매관련FAQ, 판매관련FAQ, 그에 딸린 숨은 메뉴들-->
        <div style="border: 1px solid rgba(0, 38, 255, 0.61); min-height: 200px; 
                    background-color: rgba(0, 38, 255, 0.81);"
            class="phurchseRelatedShow">
            <div style="border-bottom: 1px solid rgba(128, 128, 128, 0.36); 
                        border-right: 1px solid rgba(128, 128, 128, 0.36); 
                        height: 40px; width: 50%; float: left; vertical-align: central; 
                        line-height: 40px; text-align: center;">
                <a href="#" style="color: #ffffff;">
                    <div style="height: 40px; width: 100%">구매관련FAQ</div>
                </a>
            </div>
            <div style="border-bottom: 1px solid rgba(128, 128, 128, 0.36); 
                        height: 40px; width: 50%; float: left; 
                        vertical-align: central; line-height: 40px; text-align: center; background: #ffffff;"
                ;>
                <a href="#" style="color: black" class="saleRelated">
                    <div style="height: 40px; width: 100%">판매관련FAQ</div>
                </a>
            </div>
            <div style="clear: both;"></div>
            <div class="member">
                <div style="border-bottom: 1px solid rgba(128, 128, 128, 0.36);
                        height: 40px; width: 100%;
                        vertical-align: central; line-height: 40px; text-align: left;">
                    <a href="#" style="color: #ffffff;">
                        <div style="height:40px; width: 100%; padding-left: 10px;" class="memberManage">회원 관리</div>
                    </a>
                </div>
                <div style="display: none; border: 2px solid black; width: 150px; min-height: 242px;
                        z-index: 2; left: 190px; top: 40px;  position: absolute; background-color: white;"
                    class="memberManageChild">
                    <div style="border-bottom: 1px solid rgba(128, 128, 128, 0.33); height: 30px; background-color: rgba(128, 128, 128, 0.20);">
                        <div style="margin-left: 5px; text-align: center; line-height: 30px; vertical-align: central;">
                            <a href="#">고객정보</a>
                            <br />
                        </div>
                    </div>
                    <div style="margin: 5px;">
                        <a href="#">
                            <span>가입/관리</span>
                        </a>
                        <br />
                        <a href="#">
                            <span>정보수정</span>
                        </a>
                        <br />
                        <a href="#">
                            <span>탈퇴</span>
                        </a>
                        <br />
                        <a href="#">
                            <span>회원전환</span>
                        </a>
                        <br />
                    </div>
                </div>
            </div>
            <div class="order">
                <div style="border-bottom: 1px solid rgba(128, 128, 128, 0.36);
                        height: 40px; width: 100%;
                        vertical-align: central; line-height: 40px; text-align: left;">
                    <a href="#" style="color: #ffffff;">
                        <div style="height:40px; width: 100%; padding-left: 10px;" class="orderManage">주문/결제/영수증</div>
                    </a>
                </div>
                <div style="display: none; border: 2px solid black; width: 150px; min-height: 242px;
                        z-index: 2; left: 190px; top: 40px;  position: absolute; background-color: white;"
                    class="orderChild">
                    <div style="border-bottom: 1px solid rgba(128, 128, 128, 0.33); height: 30px; background-color: rgba(128, 128, 128, 0.20);">
                        <div style="margin-left: 5px; text-align: center; line-height: 30px; vertical-align: central;">
                            <a href="#">주문/결제</a>
                            <br />
                        </div>
                    </div>
                    <div style="margin: 5px;">
                        <a href="#">
                            <span>주문관련</span>
                        </a>
                        <br />
                        <a href="#">
                            <span>입금관련</span>
                        </a>
                        <br />
                        <a href="#">
                            <span>결제방법</span>
                        </a>
                        <br />
                        <a href="#">
                            <span>은행송금(전용계좌)</span>
                        </a>
                        <br />
                        <a href="#">
                            <span>기타결제</span>
                        </a>
                        <br />
                        <a href="#">
                            <span>카드결제</span>
                        </a>
                        <br />
                        <a href="#">
                            <span>실시간계좌이체</span>
                        </a>
                        <br />
                        <a href="#">
                            <span>영수증</span>
                        </a>
                        <br />
                    </div>
                </div>
            </div>
            <div style="border-bottom: 1px solid rgba(128, 128, 128, 0.36);
                        height: 40px; width: 100%;
                        vertical-align: central; line-height: 40px; text-align: left; padding-left: 10px;">
                <a href="#" style="color: #ffffff;">
                    <div style="height:40px; width: 100%;">배송</div>
                </a>
            </div>
            <div style="border-bottom: 1px solid rgba(128, 128, 128, 0.36);
                        height: 40px; width: 100%;
                        vertical-align: central; line-height: 40px; text-align: left; padding-left: 10px;">
                <a href="#" style="color: #ffffff;">
                    <div style="height:40px; width: 100%;">취소/반품/환불/교환</div>
                </a>
            </div>
            <div style="border-bottom: 1px solid rgba(128, 128, 128, 0.36);
                        height: 40px; width: 100%; 
                        vertical-align: central; line-height: 40px; text-align: left; padding-left: 10px;">
                <a href="#" style="color: #ffffff;">
                    <div style="height:40px; width: 100%;">G통장/상품평/기타</div>
                </a>
            </div>
            <div style="border-bottom: 1px solid rgba(128, 128, 128, 0.36);
                        height: 40px; width: 100%; 
                        vertical-align: central; line-height: 40px; text-align: left; padding-left: 10px;">
                <a href="#" style="color: #ffffff;">
                    <div style="height:40px; width: 100%;">전세계배송/쿠폰티켓여행</div>
                </a>
            </div>
        </div><!--구매관련FAQ, 판매관련FAQ, 그에 딸린 숨은 메뉴들-->

        <!--왼쪽의 메뉴박스 중 청색 : 판매관련FAQ-->
        <div style="border: 1px solid rgba(0, 38, 255, 0.61); min-height: 200px;
                    background-color: rgba(0, 38, 255, 0.81); display: none;"
            class="saleRelatedShow">
            <div style="border-bottom: 1px solid rgba(128, 128, 128, 0.36);
                        border-right: 1px solid rgba(128, 128, 128, 0.36);
                        height: 40px; width: 50%; float: left; vertical-align: central;
                        line-height: 40px; text-align: center; background-color: #ffffff;">
                <a href="#" style="color: black;" class="phurchseRelated">
                    <div style="height: 40px; width: 100%">구매관련FAQ</div>
                </a>
            </div>
            <div style="border-bottom: 1px solid rgba(128, 128, 128, 0.36);
                        height: 40px; width: 50%; float: left;
                        vertical-align: central; line-height: 40px; text-align: center;">
                <a href="#" style="color: #ffffff;">
                    <div style="height: 40px; width: 100%">판매관련FAQ</div>
                </a>
            </div>
            <div style="clear: both;"></div>
            <div class="member">
                <div style="border-bottom: 1px solid rgba(128, 128, 128, 0.36);
                        height: 40px; width: 100%;
                        vertical-align: central; line-height: 40px; text-align: left;">
                    <a href="#" style="color: #ffffff;">
                        <div style="height:40px; width: 100%; padding-left: 10px;" class="memberManage">회원 관리</div>
                    </a>
                </div>
                <div style="display: none; border: 2px solid black; width: 150px; min-height: 242px;
                        z-index: 2; left: 190px; top: 40px;  position: absolute; background-color: white;"
                    class="memberManageChild">
                    <div style="border-bottom: 1px solid rgba(128, 128, 128, 0.33); height: 30px; background-color: rgba(128, 128, 128, 0.20);">
                        <div style="margin-left: 5px; text-align: center; line-height: 30px; vertical-align: central;">
                            <a href="#">회원관리</a>
                            <br />
                        </div>
                    </div>
                    <div style="margin: 5px;">
                        <a href="#">
                            <span>사업자가입</span>
                        </a>
                        <br />
                        <a href="#">
                            <span>사업자전환</span>
                        </a>
                        <br />
                        <a href="#">
                            <span>제한/탈퇴</span>
                        </a>
                        <br />
                        <a href="#">
                            <span>등급/상태</span>
                        </a>
                        <br />
                        <a href="#">
                            <span>정보변경</span>
                        </a>
                        <br />
                    </div>
                </div>
            </div>
            <div style="border-bottom: 1px solid rgba(128, 128, 128, 0.36);
                        height: 40px; width: 100%;
                        vertical-align: central; line-height: 40px; text-align: left; padding-left: 10px;">
                <a href="#" style="color: #ffffff;">
                    <div style="height:40px; width: 100%;">상품관리</div>
                </a>
            </div>
            <div style="border-bottom: 1px solid rgba(128, 128, 128, 0.36);
                        height: 40px; width: 100%;
                        vertical-align: central; line-height: 40px; text-align: left; padding-left: 10px;">
                <a href="#" style="color: #ffffff;">
                    <div style="height:40px; width: 100%;">배송/취소/반품/교환</div>
                </a>
            </div>
            <div style="border-bottom: 1px solid rgba(128, 128, 128, 0.36);
                        height: 40px; width: 100%;
                        vertical-align: central; line-height: 40px; text-align: left; padding-left: 10px;">
                <a href="#" style="color: #ffffff;">
                    <div style="height:40px; width: 100%;">이용료/정산/부가세</div>
                </a>
            </div>
            <div style="border-bottom: 1px solid rgba(128, 128, 128, 0.36);
                        height: 40px; width: 100%;
                        vertical-align: central; line-height: 40px; text-align: left; padding-left: 10px;">
                <a href="#" style="color: #ffffff;">
                    <div style="height:40px; width: 100%;">광고/기획전</div>
                </a>
            </div>
            <div style="border-bottom: 1px solid rgba(128, 128, 128, 0.36);
                        height: 40px; width: 100%;
                        vertical-align: central; line-height: 40px; text-align: left; padding-left: 10px;">
                <a href="#" style="color: #ffffff;">
                    <div style="height:40px; width: 100%;">ESM Plus/미니샾</div>
                </a>
            </div>
        </div>

        <!--왼쪽의 메뉴박스 중 녹색 : 구매관련FAQ와 연동-->
        <div style="border: 1px solid rgba(0, 38, 255, 0.61); min-height: 200px;
                    background-color:#5cff00; margin-top: 5px;"
            class="phurchseRelatedShow">
            <div style="border-bottom: 1px solid rgba(128, 128, 128, 0.36);
                        height: 40px; width: 100%;
                        vertical-align: central; line-height: 40px; text-align: left; padding-left: 10px;">
                <a href="#" style="color: #ffffff;">
                    <div style="height: 40px; width: 100%">
                        <i class="glyphicon glyphicon-phone-alt" style="margin-right: 12px;"></i>고객센터이용안내
                    </div>
                </a>
            </div>
            <div style="border-bottom: 1px solid rgba(128, 128, 128, 0.36);
                        height: 40px; width: 100%;
                        vertical-align: central; line-height: 40px; text-align: left; padding-left: 10px;">
                <a href="#" style="color: #ffffff;">
                    <div style="height: 40px; width: 100%">
                        <i class="glyphicon glyphicon-question-sign" style="margin-right: 12px;"></i>A마켓에 문의하기
                    </div>
                </a>
            </div>
            <div style="border-bottom: 1px solid rgba(128, 128, 128, 0.36);
                        height: 40px; width: 100%;
                        vertical-align: central; line-height: 40px; text-align: left; padding-left: 10px;">
                <a href="#" style="color: #ffffff;">
                    <div style="height: 40px; width: 100%">
                        <i class="glyphicon glyphicon-envelope" style="margin-right: 12px;"></i>문의내역 확인
                    </div>
                </a>
            </div>
            <div style="border-bottom: 1px solid rgba(128, 128, 128, 0.36);
                        height: 40px; width: 100%;
                        vertical-align: central; line-height: 40px; text-align: left; padding-left: 10px;">
                <a href="#" style="color: #ffffff;">
                    <div style="height: 40px; width: 100%">
                        <i class="glyphicon glyphicon-lock" style="margin-right: 12px;"></i>아이디찾기
                    </div>
                </a>
            </div>
            <div style="border-bottom: 1px solid rgba(128, 128, 128, 0.36);
                        height: 40px; width: 100%;
                        vertical-align: central; line-height: 40px; text-align: left; padding-left: 10px;">
                <a href="#" style="color: #ffffff;" class="forgotPassword">
                    <div style="height: 40px; width: 100%">
                        <i class="glyphicon glyphicon-eye-open" style="margin-right: 12px;"></i>
                        비밀번호찾기
                    </div>
                </a>
            </div>
            <div style="border-bottom: 1px solid rgba(128, 128, 128, 0.36);
                        height: 40px; width: 100%;
                        vertical-align: central; line-height: 40px; text-align: left; padding-left: 10px;">
                <a href="#" style="color: #ffffff;">
                    <div style="height: 40px; width: 100%">
                        <i class="glyphicon glyphicon-modal-window" style="margin-right: 12px;"></i>화면공유상담
                    </div>
                </a>
            </div>
            <div style="border-bottom: 1px solid rgba(128, 128, 128, 0.36);
                        height: 40px; width: 100%;
                        vertical-align: central; line-height: 40px; text-align: left; padding-left: 10px;">
                <a href="#" style="color: #ffffff;">
                    <div style="height: 40px; width: 100%">
                        <i class="glyphicon glyphicon-inbox" style="margin-right: 12px;"></i>이벤트당첨확인
                    </div>
                </a>
            </div>
            <div style="border-bottom: 1px solid rgba(128, 128, 128, 0.36);
                        height: 40px; width: 100%;
                        vertical-align: central; line-height: 40px; text-align: left; padding-left: 10px;">
                <a href="#" style="color: #ffffff;">
                    <div style="height: 40px; width: 100%">
                        <i class="glyphicon glyphicon-alert" style="margin-right: 12px;"></i>웹접근성신고센터
                    </div>
                </a>
            </div>
        </div><!--왼쪽의 메뉴박스 중 녹색 : 구매관련FAQ와 연동-->

        <!--왼쪽의 메뉴박스 중 녹색 : 판매관련FAQ와 연동-->
        <div style="border: 1px solid rgba(0, 38, 255, 0.61); min-height: 200px;
                    background-color:#5cff00; margin-top: 5px; display: none;"
            class="saleRelatedShow">
            <div style="border-bottom: 1px solid rgba(128, 128, 128, 0.36);
                        height: 40px; width: 100%;
                        vertical-align: central; line-height: 40px; text-align: left; padding-left: 10px;">
                <a href="#" style="color: #ffffff;">
                    <div style="height: 40px; width: 100%">
                        <i class="glyphicon glyphicon-phone-alt" style="margin-right: 12px;"></i>고객센터이용안내
                    </div>
                </a>
            </div>
            <div style="border-bottom: 1px solid rgba(128, 128, 128, 0.36);
                        height: 40px; width: 100%;
                        vertical-align: central; line-height: 40px; text-align: left; padding-left: 10px;">
                <a href="#" style="color: #ffffff;">
                    <div style="height: 40px; width: 100%">
                        <i class="glyphicon glyphicon-question-sign" style="margin-right: 12px;"></i>A마켓에 문의하기
                    </div>
                </a>
            </div>
            <div style="border-bottom: 1px solid rgba(128, 128, 128, 0.36);
                        height: 40px; width: 100%;
                        vertical-align: central; line-height: 40px; text-align: left; padding-left: 10px;">
                <a href="#" style="color: #ffffff;">
                    <div style="height: 40px; width: 100%">
                        <i class="glyphicon glyphicon-envelope" style="margin-right: 12px;"></i>문의내역 확인
                    </div>
                </a>
            </div>
            <div style="border-bottom: 1px solid rgba(128, 128, 128, 0.36);
                        height: 40px; width: 100%;
                        vertical-align: central; line-height: 40px; text-align: left; padding-left: 10px;">
                <a href="#" style="color: #ffffff;">
                    <div style="height: 40px; width: 100%">
                        <i class="glyphicon glyphicon-lock" style="margin-right: 12px;"></i>로그인/비밀번호변경
                    </div>
                </a>
            </div>
            <div style="border-bottom: 1px solid rgba(128, 128, 128, 0.36);
                        height: 40px; width: 100%;
                        vertical-align: central; line-height: 40px; text-align: left; padding-left: 10px;">
                <a href="#" style="color: #ffffff;">
                    <div style="height: 40px; width: 100%">
                        <i class="glyphicon glyphicon-modal-window" style="margin-right: 12px;"></i>화면공유상담
                    </div>
                </a>
            </div>
            <div style="border-bottom: 1px solid rgba(128, 128, 128, 0.36);
                        height: 40px; width: 100%;
                        vertical-align: central; line-height: 40px; text-align: left; padding-left: 10px;">
                <a href="#" style="color: #ffffff;">
                    <div style="height: 40px; width: 100%">
                        <i class="glyphicon glyphicon-refresh" style="margin-right: 12px;"></i>판매자 1:1 채팅상담
                    </div>
                </a>
            </div>
            <div style="border-bottom: 1px solid rgba(128, 128, 128, 0.36);
                        height: 40px; width: 100%;
                        vertical-align: central; line-height: 40px; text-align: left; padding-left: 10px;">
                <a href="#" style="color: #ffffff;">
                    <div style="height: 40px; width: 100%">
                        <i class="glyphicon glyphicon-home" style="margin-right: 12px;"></i>미니샾 관리
                    </div>
                </a>
            </div>
            <div style="border-bottom: 1px solid rgba(128, 128, 128, 0.36);
                        height: 40px; width: 100%;
                        vertical-align: central; line-height: 40px; text-align: left; padding-left: 10px;">
                <a href="#" style="color: #ffffff;">
                    <div style="height: 40px; width: 100%">
                        <i class="glyphicon glyphicon-blackboard" style="margin-right: 12px;"></i>판매자 교육센터
                    </div>
                </a>
            </div>
        </div><!--왼쪽의 메뉴박스 중 녹색 : 판매관련FAQ와 연동-->

    </div><!--왼쪽의 메뉴박스 중 청색, 녹색 : 구매관련FAQ, 고객센터이용안내...-->

    <!--오른쪽의 중앙 메인 화면-->
    <div class="col-sm-10 col-md-10 col-lg-10" style="padding-left: 15px; padding-right: 0px;">
        <div class="customer_section">

            <!--Ajax에서 로딩한다-->

            <span>데이터를 로딩 중입니다...</span>

        </div>
        <!--<div class="deails_section" style="z-index: 2; top: 200px; position: relative;"></div>-->
        <div class="noticeBoard_section">

            <!--Ajax에서 로딩한다-->

            <!--현재는 준비 중...11/03/2019-->

        </div>
    </div><!--오른쪽의 중앙 메인 화면-->
</div><!--맨 위 긴 메뉴박스 바로 밑 중앙에 있는 메인 화면-->

<!--<script src="/lib/jquery/jquery-2.2.3.min.js"></script>-->
<script src="https://code.jquery.com/jquery-3.1.0.min.js" integrity="sha256-cCueBR6CsyA4/9szpPfrX3s49M9vUU5BgtiJj06wt/s=" crossorigin="anonymous"></script>
<script>
    $(function () {
        //화면로드시 BEST FAQ, 공지사항 대한 내용을 준비해 놓는다
        //위의 div tag의 class=customer_section, class=noticeBoard_section
        //안에  Ajax로 원하는 데이터를 보여준다
        $(function () {
            getBestFAQBoard();
        });

        // getBestFAQBoard();
        function getBestFAQBoard() {
            $.ajax({
                url: "/customercenter/indexAjax",
                type: 'get',
                //data: { value: selectedValue },
                data:{},
                success: function (data) {
                    $(".customer_section").empty().append(data);
                },
                error: function () {
                    alert("/customercenter/indexAjax something seems wrong==>index");
                }
            });

            return false;  //매우 중요함...
        }
               
        //고객센터전체메뉴 보여주기
        var sw = false;
        $('.customerCenterShowAll').click(function () {
            if (sw == false) {
                $('.minus').hide();
                $('.plus').show();
                $('.customerCenterAllMenu').show();
                sw = true;
            }
            else {
                $('.minus').show();
                $('.plus').hide();
                $('.customerCenterAllMenu').hide();
                sw = false;
            }
        });

        //구매관련FAQ, 판매관련FAQ
        $('.saleRelated').click(function () {
            $('.phurchseRelatedShow').hide();
            $('.saleRelatedShow').show();
        });
        $('.phurchseRelated').click(function () {
            $('.saleRelatedShow').hide();
            $('.phurchseRelatedShow').show();
        });

        //구매관련FAQ, 판매관련FAQ의 하위메뉴에 마우스온 했을때.
        $('.member').mouseover(function () {
            $('.memberManage').css('background-color', 'black');
            $('.memberManageChild').show();
        })
        $('.member').mouseout(function () {
            $('.memberManage').css('background-color', '');
            $('.memberManageChild').hide();
        })

        $('.order').mouseover(function () {
            $('.orderManage').css('background-color', 'black');
            $('.orderChild').show();
        })
        $('.order').mouseout(function () {
            $('.orderManage').css('background-color', '');
            $('.orderChild').hide();
        })

        //비밀번호 찾기를 클릭하면...
        //시스템에서 리턴되는 메시지를 받을 수 없어 사용 중지.12/03/2019
        $('.forgotPassword').click(function () {
            //window.location = '/password/reset';
            $.ajax({
                url: "/customercenter/forgotpassword",
                type: 'get',
                //data: {},
                data: {},
                success: function (data) {
                    $(".customer_section").empty().append(data);
                },
                error: function () {
                    alert("/customercenter/forgotpassword something seems wrong==>index");
                }
            });

            return false;  //매우 중요함...
        });        
    });
</script>

@endsection