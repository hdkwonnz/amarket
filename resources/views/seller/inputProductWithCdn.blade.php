@extends('layouts.seller')

@section('title')
Seller-inputProduct
@endsection

@section('content')

<div class="big_page_section">

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
        opacity: .25;
    }
</style>
<!--test for loading spinner 26/04/2019-->
<script>
    $(window).on(function () {
        $(".my_loader").fadeOut("slow");
    });

    ! function (a)
    { ////////아래 "form1"은 해당 form tag에 따라 바뀐다...15/05/2019...중요함/////////////////////////////////
            jQuery(window).bind("unload", function () { }), a(document).ready(function () {
                a(".my_loader").hide(), a("form1").on("submit", function () {
                    a("form1").validate(), a("form1").valid() ? (a(".my_loader").show(), a("form1").valid() || a(".my_loader").hide()) : a(".my_loader").hide()
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

<!--test for loading spinner 26/04/2019-->
<div class="my_loader"></div>

<!--판매 상품 등록-->
<div class="row" style="margin-right: 0px;">
    <div class='col-sm-12 col-md-12 col-lg-12'>
        <div style="border-top: 2px solid blue; min-height: 40px;
                    line-height: 40px; vertical-align: central;
                    background-color: rgba(128, 128, 128, 0.42);
                    margin-top: 10px; margin-bottom: 10px;"
             class="text-center">
            <span style="font-size: 25px;">판매 상품 등록</span>
        </div>
    </div>
    <div class='col-sm-12 col-md-12 col-lg-12'>
        <div class="noticeWords">
            <!--blink를 원하면 아래를 사용...-->
            <span style="color: blue;" class="blink_me">카테고리를 선택하세요...</span>
            <!--blink를 원하지 않으면 아래를 사용...-->
            <!--<span style="color: blue;" class="">카테고리를 선택하세요...</span>-->
        </div>
    </div>
</div>

<!--카테고리 섹션-->
<div class="categorySection">
    <div class="row" style="margin-right: 0px;">
        <!--카테고리A: 첫번째로 화면에 보여준다.-->
        <div class="categoryASection">
            <div class="col-sm-3 col-md-3 col-lg-3">
                <span style="font-size: 20px;">
                    <b>카테고리 A</b>
                </span>
                <div style="max-height: 200px; width: 99.9%; overflow-y: auto;
                    border: 1px solid blue;">
                    <?php
                    foreach($categoryas as $item) {
                    ?>

                    <div style='margin-top: 5px; margin-left: 10px;'>
                        <a href='javascript:void()' style='font-size: 20px;' onclick="selectCategoryB(<?=$item->id?>, '<?=$item->name?>'); return false;">
                            <div class='hoverLightBlue clickA' style='border: 1px solid white; width: 100%; min-height: 30px;'>
                                <?=$item->name?>
                            </div>
                        </a>
                    </div>

                    <?php
                    }
                    ?>
                </div>
            </div>
        </div>
        <!--카태고리B,C,D 섹션: Ajax에서 데이터를 로드한다.-->
        <div class="categoryBSection">
            
        </div>
        <div class="categoryCSection">
           
        </div>
        <div class="categoryDSection">
            
        </div>
    </div>
</div>

<!--선택된 카테고리-->
<div class="row" style="margin-top: 20px;">
    <div class='col-sm-12 col-md-12 col-lg-12' style="font-size: 17px;">
        <div style='float: left; margin-right: 10px;'>
            <span style="color: red;">
                <b>선택된 카테고리 ==> </b>
            </span>
        </div>
        <div style='float: left; margin-right: 10px;' class="categoryAName"></div>
        <div style='float: left; margin-right: 10px;' class="divider1"></div>
        <div style='float: left; margin-right: 10px;' class="categoryBName"></div>
        <div style='float: left; margin-right: 10px;' class="divider2"></div>
        <div style='float: left; margin-right: 10px;' class="categoryCName"></div>
        <div style='float: left; margin-right: 10px;' class="divider3"></div>
        <div style='float: left; margin-right: 10px;' class="categoryDName"></div>
        <div style='clear: both;'></div>
    </div>
</div>

<!--input 섹션-->
<div class="inputSection" style="display: none;">

    <!--입력 완료 후 조회시 사용. /16/04/2019-->
    <div>
        <input type="hidden" value="" id="txtProductNo" name="txtProductNo" />
    </div>

    <!--상품내역 입력섹션-->
    <div class="row" style="margin-left: 0px; margin-right: 15px;">
        <div class='col-sm-12 col-md-12 col-lg-12'>         
            <form name="form1" id="form1" action='/seller/insertProduct' method='post' class='form-horizontal' enctype="multipart/form-data">
                  {{ csrf_field() }}
                <div class="form-group">
                    <input type="hidden" value="" id="categoryAId" name="categoryAId" />
                    <input type="hidden" value="" id="categoryBId" name="categoryBId" />
                    <input type="hidden" value="" id="categoryCId" name="categoryCId" />
                    <input type="hidden" value="" id="categoryDId" name="categoryDId" />
                </div>

                <div class='row'>
                    <div class='form-group'>                      
                        <label class='col-sm-1 col-md-1 col-lg-1 control-label'>상품 이름</label>
                        <div class='col-sm-5 col-md-5 col-lg-5'>
                            <input type='text' id='txtModelName' name='txtModelName' class='form-control' maxlength='50' value='{{old("txtModelName")}}' required />
                        </div>
                        <label class='col-sm-1 col-md-1 col-lg-1 control-label'>제조 회사</label>
                        <div class='col-sm-5 col-md-5 col-lg-5'>
                            <input type='text' id='txtCompany' name='txtCompany' class='form-control' maxlength='50' value='{{old("txtCompany")}}' required />
                        </div>
                    </div>
                </div>

                <div class='row'>
                    <div class='form-group'>
                        <label class='col-sm-1 col-md-1 col-lg-1 control-label'>제조 국가</label>
                        <div class='col-sm-5 col-md-5 col-lg-5'>
                            <select name="txtCountryOfProduct" id="txtCountryOfProduct" class="form-control">                                
                                <option value="한국">한국</option>
                                <option value="중국">중국</option>
                                <option value="인도">인도</option>
                                <option value="베트남">베트남</option>
                                <option value="미국">미국</option>
                                <option value="영국">영국</option>
                                <option value="독일">독일</option>
                                <option value="프랑스">프랑스</option>
                                <option value="이탈리아">이탈리아</option>
                                <option value="기타유럽">기타유럽</option>
                                <option value="동남아시아">동남아시아</option>            
                            </select>                          
                        </div>
                        <label class='col-sm-1 col-md-1 col-lg-1 control-label'>행사 이름</label>
                        <div class='col-sm-5 col-md-5 col-lg-5'>
                            <input type='text' id='txtEventName' name='txtEventName' class='form-control' maxlength='30' value='{{old("txtEventName")}}' />
                        </div>                  
                    </div>
                </div>

                <div class='row'>
                    <div class='form-group'>                       
                        <label class='col-sm-1 col-md-1 col-lg-1 control-label'>상품 가격</label>
                        <div class='col-sm-2 col-md-2 col-lg-2'>
                            <input type='number' id='txtOriginPrice' name='txtOriginPrice' class='form-control' value='{{old("txtOriginPrice")}}' min='1' step="1" required />
                        </div>
                        <label class='col-sm-1 col-md-1 col-lg-1 control-label'>판매 가격</label>
                        <div class='col-sm-2 col-md-2 col-lg-2'>
                            <input type='number' id='txtSellPrice' name='txtSellPrice' class='form-control' value='{{old("txtSellPrice")}}' min='1' step="1" required />
                        </div>
                        <label class='col-sm-1 col-md-1 col-lg-1 control-label'>판매 기한</label>
                        <div class='col-sm-2 col-md-2 col-lg-2'>
                            <select name="txtSellTerm" id="txtSellTerm" class="form-control">                                
                                <option value="30">30일</option>
                                <option value="60">60일</option>
                                <option value="90">90일</option>
                                <option value="120">120일</option>
                                <option value="150">150일</option>
                                <option value="180">180일</option>                         
                            </select>
                        </div>
                         <label class='col-sm-1 col-md-1 col-lg-1 control-label'>재고 수량</label>
                        <div class='col-sm-2 col-md-2 col-lg-2'>
                            <input type='number' id='txtStock' name='txtStock' class='form-control' value='{{old("txtStock")}}' min='1' step="1" required />
                        </div>
                    </div>
                </div>
                            
                <div class="row">
                    <div class='form-group'>
                        <label class='col-sm-1 col-md-1 col-lg-1 control-label'>해외배송?</label>
                        <div class='col-sm-1 col-md-1 col-lg-1'>
                            <input type='checkbox' id='txtOverseasDelivery' name='txtOverseasDelivery' class='form-control' />
                        </div>
                        <label class='col-sm-1 col-md-1 col-lg-1 control-label'>유료배송?</label>
                        <div class='col-sm-1 col-md-1 col-lg-1'>
                            <input type='checkbox' id='txtDeliveryCode' name='txtDeliveryCode' class='form-control' onclick="deliveryCode()" />
                        </div>
                        <!--jquery에서 다시체크할것...15/05/2019-->
                        <div id="delivery_cost" style="display: none;">
                            <label class='col-sm-1 col-md-1 col-lg-1 control-label'>배송 금액</label>
                            <div class='col-sm-3 col-md-3 col-lg-3'>
                                <input type='number' id='txtDeliveryCost' name='txtDeliveryCost' class='form-control' value='{{old("txtDeliveryCost")}}' />
                            </div>
                            <label class='col-sm-1 col-md-1 col-lg-1 control-label'>최소 구매</label>
                            <div class='col-sm-3 col-md-3 col-lg-3'>
                                <input type='number' id='txtDeliveryFreeMinimum' name='txtDeliveryFreeMinimum' class='form-control' value='{{old("txtDeliveryFreeMinimum")}}' />
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="row">
                    <div class='form-group'>
                        <label class='col-sm-1 col-md-1 col-lg-1 control-label'>배송 알림</label>
                        <div class='col-sm-11 col-md-11 col-lg-11'>
                            <input type='text' id='txtDeliveryNotice' name='txtDeliveryNotice' class='form-control' value='{{old("txtDeliveryNotice")}}' required />
                        </div>                      
                    </div>
                </div>

                <div class="row">
                    <div class='form-group'> 
                        <label class='col-sm-1 col-md-1 col-lg-1 control-label'>인증정보?</label>
                        <div class='col-sm-1 col-md-1 col-lg-1'>
                            <input type='checkbox' id='txtCertifyYes' name='txtCertifyYes' class='form-control' onclick="certifyYes()"/>
                        </div>
                        <div id="certify_yes" style="display: none;">
                            <label class='col-sm-1 col-md-1 col-lg-1 control-label'>인증 이름</label>
                            <div class='col-sm-3 col-md-3 col-lg-3'>
                                <input type='text' id='txtCertifyTitle' name='txtCertifyTitle' class='form-control' value='{{old("txtCertifyTitle")}}' />
                            </div>
                        </div>               
                        <label class='col-sm-1 col-md-1 col-lg-1 control-label'>옵션사용?</label>
                        <div class='col-sm-1 col-md-1 col-lg-1'>
                            <input type='checkbox' id='txtOptionYes' name='txtOptionYes' class='form-control' onclick="optionYes()" />
                        </div>
                        <div id="option_yes" style="display: none;">
                            <label class='col-sm-1 col-md-1 col-lg-1 control-label'>옵션 1개</label>                     
                            <div class='col-sm-1 col-md-1 col-lg-1'>
                               <input type="radio" id="txtOptionOne" name="txtOptionSelectRadio" class="form-control" checked value="1"/>
                            </div>
                            <label class='col-sm-1 col-md-1 col-lg-1 control-label'>옵션 2개</label>
                            <div class='col-sm-1 col-md-1 col-lg-1'>
                               <input type="radio" id="txtOptionTwo" name="txtOptionSelectRadio" class="form-control" value="2"/>
                            </div>
                        </div>
                    </div>
                </div>
               
                <div class='row'>
                    <div class='form-group'>
                        <label class='col-sm-1 col-md-1 col-lg-1 control-label'>
                            대표 사진
                            <br />HTML
                        </label>
                        <div class='col-sm-5 col-md-5 col-lg-5'>
                            <!--<input type='text' id='txtSearchImage' name='txtSearchImage' class='form-control' maxlength='30' value='{{old("txtSearchImage")}}' required />-->
                            <!--아래는 반드시 한 줄로 표기해야 한다. 그렇지 않을 경우 내용의 앞 여러 칸이 비어진 상태로 보여진다-->
                            <textarea id='txtSearchImage' name='txtSearchImage' class='form-control' rows="10" required>{{old("txtSearchImage")}}</textarea>
                        </div>
                        <label class='col-sm-1 col-md-1 col-lg-1 control-label'>
                            <span>상품 사진</span>
                            <br />
                            <span>HTML</span>
                        </label>
                        <div class='col-sm-5 col-md-5 col-lg-5'>
                            <!--<input type='text' id='txtProductImage' name='txtProductImage' class='form-control' maxlength='30' value='{{old("txtProductImage")}}' required />-->
                            <!--아래는 반드시 한 줄로 표기해야 한다. 그렇지 않을 경우 내용의 앞 여러 칸이 비어진 상태로 보여진다-->
                            <textarea id='txtProductImage' name='txtProductImage' class='form-control' rows="10" required>{{old("txtProductImage")}}</textarea>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="form-group">
                        <label class='col-sm-1 col-md-1 col-lg-1 control-label'>
                            상세 사진
                            <br />HTML
                        </label>
                        <div class='col-sm-5 col-md-5 col-lg-5'>
                            <!--<input type='text' id='txtDescription' name='txtDescription' class='form-control' maxlength='30' value='{{old("txtDescription")}}' required />-->
                            <!--아래는 반드시 한 줄로 표기해야 한다. 그렇지 않을 경우 내용의 앞 여러 칸이 비어진 상태로 보여진다-->
                            <textarea id='txtDescription' name='txtDescription' class='form-control' rows="10" required>{{old("txtDescription")}}</textarea>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class='form-group'>                       
                        <!--<div class='col-sm-offset-1 col-md-offset-1 col-lg-offset-1 col-sm-5 col-md-5 col-lg-5'>
                            <input type='submit' id="register" name="register" class='btn btn-lg btn-primary' value='등록하기' />
                        </div>-->
                         <div class='col-sm-offset-1 col-md-offset-1 col-lg-offset-1 col-sm-5 col-md-5 col-lg-5'>
                            <a href="javascript:void()" class="register">
                                <input type='submit' id="register" name="register" class='btn btn-lg btn-primary' value='등록하기' />
                            </a>               
                        </div>
                    </div>
                </div>
            </form>           
        </div>
    </div>
</div>

<!--버튼 섹션-->
<div class="row buttonShowAndHide" style="display: none; margin-top: 50px; margin-bottom: 50px;">
    <div style="color: blue; font-size: 30px; margin-left: 15px; margin-bottom: 100px; margin-top: 100px;">
        <span>
            상품 입력이 완료 되었습니다. 아래 버튼을 클릭 하세요... 
        </span>
    </div>   
    <div>
        <div class='col-sm-2 col-md-2 col-lg-2'>
            <button type='button' id="goProductDetails" class='btn btn-success'>입력한내용보기</button>
        </div>
        <div class='col-sm-offset-1 col-md-offset-1 col-lg-offset-1 col-sm-2 col-md-2 col-lg-2'>
            <button type='button' id="continueInput" class='btn btn-info'>계속입력하기</button>
        </div>
    </div>
</div>

<!--판매가격이 상품가격보다 크면 error-->
<!--기타다른 아이템도 validation check 할 것. 19/05/2019-->

<script src="/myJs/inputProduct.js"></script>

<!--유료배송,옵션사용,인증정보 check box를 클릭했으때-->
<script>
    
</script>

<!--화면상단의 카테고리A를 클릭하면 카테고리B가 만들어진다.
    이때 기존에 존재하던 카테고리B,C,D 섹션은 모두 지운다.-->
<script>
    
</script>

<!--blink 기능 구현-->
<script>
    
</script>

<!--화면 하단의 서브밋 버튼 누르면 상품 등록이 시작된다.-->
<script>
    
</script>

</div><!--class="big_page_section"-->
@endsection
