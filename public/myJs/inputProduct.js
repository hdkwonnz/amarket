////<!--판매가격이 상품가격보다 크면 error check 요망.19/05/2019-->
////<!--기타다른 아이템도 validation check 할 것. 19/05/2019-->


////////<!--유료배송,옵션사용,인증정보 check box를 클릭했으때-->
////유료배송 check box를 클릭했으때
function deliveryCode() {
    var checkBox = document.getElementById("txtDeliveryCode");
    var text = document.getElementById("delivery_cost");
    if (checkBox.checked == true) {
        text.style.display = "block";
    } else {
        text.style.display = "none";
    }
}
////옵션사용 check box를 클릭했으때
function optionYes() {
    var checkBox = document.getElementById("txtOptionYes");
    var text = document.getElementById("option_yes");
    if (checkBox.checked == true) {
        text.style.display = "block";
    } else {
        text.style.display = "none";
    }
}
////인증정보 check box를 클릭했으때
function certifyYes() {
    var checkBox = document.getElementById("txtCertifyYes");
    var text = document.getElementById("certify_yes");
    if (checkBox.checked == true) {
        text.style.display = "block";
    } else {
        text.style.display = "none";
    }
}

////////<!--화면상단의 카테고리A를 클릭하면 카테고리B가 만들어진다.
////////이때 기존에 존재하던 카테고리B,C,D 섹션은 모두 지운다.-->
function selectCategoryB(id, name) {
    $('.noticeWords').show();

    $('.categoryBSection').empty();
    $('.categoryBSection').append('<span style="color: red;">category B loading 중 입니다...</span>');
    $('.categoryCSection').empty();
    $('.categoryDSection').empty();
    $('.categoryAName').empty();
    $('.categoryBName').empty();
    $('.categoryCName').empty();
    $('.categoryDName').empty();
    $('.divider1').empty();
    $('.divider2').empty();
    $('.divider3').empty();

    $.ajax({
        type: "post",
        //아래를 꼭 삽입해야 post로 보낼수 있다...
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        url: "/seller/selectCategoryB",
        data: { id: id },
        chche: false,
        success: function (data) {
            $('.categoryBSection').empty().append(data);
            $('.categoryAName').empty().append(name);
            $('.divider1').empty().append('>');
        },
        error: function (data) {
            alert("/seller/selectCategoryB 시스템에러...");
        }
    });
    return false;
}

////////<!--blink 기능 구현-->
function blinker() {
    $('.blink_me').fadeOut(500);
    $('.blink_me').fadeIn(500);
}
setInterval(blinker, 1000); //Running every second

////////<!--화면 하단의 서브밋 버튼 누르면 상품 등록이 시작된다.-->
////아래 방법은 메인 상품을 입력후 동일 페이지에서 옵션을 입력하는 방법이다.
$(function () {
    $('#form1').on('submit', function (e) {
        e.preventDefault();       
        $.ajax({
            type: "POST",
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url: "/seller/insertProduct",
            data: $(this).serialize(),
            cache: false,
            success: function (data) {
                //if (data != 0) {
                if (data.success == true) {
                    //alert("option_code..." + data.optionCode);
                    //alert(data.modelName);
                    productId = data.lastProductNo;
                    modelName = data.modelName;
                    optionCode = data.optionCode;
                    //if (data.optionCode == 1) {
                    //    window.open('/seller/optionOneCreate/' + productId); //중요한 예제
                    //}

                    if (data.optionCode == 1)
                    {
                        $.ajax({
                            type: "get",                            
                            url: "/seller/optionOneCreate",
                            data: { productId: productId, modelName: modelName, optionCode: optionCode },
                            chche: false,
                            success: function (data) {
                                $('.big_page_section').empty().append(data);
                            },
                            error: function (data) {
                                alert("/seller/optionOneCreate 시스템에러...");
                                $('.my_loader').hide();                               
                            }
                        });
                        return false;
                    } else if (data.optionCode == 2) {
                        $.ajax({
                            type: "get",
                            url: "/seller/optionOneCreateForOptionTwo",
                            data: { productId: productId, modelName: modelName, optionCode: optionCode },
                            chche: false,
                            success: function (data) {
                                $('.big_page_section').empty().append(data);
                            },
                            error: function (data) {
                                alert("/seller/optionOneCreateForOptionTwo 시스템에러...");
                                $('.my_loader').hide();                               
                            }
                        });
                        return false;                       
                    } else if (data.optionCode == 0) {
                        alert("준비중...");
                        $('.my_loader').hide();
                    }                                        
                }
                else {
                    //alert("입력 데이터 확인하세요...insertProduct...")
                    alert(data.errorMessage);
                    $('.my_loader').hide();                  
                }
            },
            error: function (data) {
                alert('시스템에러...insertProduct...xxx')
                $('.my_loader').hide();             
            }
        });      
        return false;
    });
});

//////입력한내용보기 버튼 클릭 했을때 //stopped 15/05/2019
//$('#goProductDetails').click(function () {
//    //아래는 일반적으로 사용하는 파라미터 전달 방법
//    //var txtProductId = $('#txtProductNo').val().trim();
//    //window.location = '/sllers/productDetails?productId=' + txtProductId;

//    //아래는 route(web.php)에 특화된 파라미터 전달 방법
//    var txtProductId = $('#txtProductNo').val().trim();
//    //window.location = '/product/details/' + txtProductId; //중요한 예제
//    window.open('/product/detailsWithCdn/' + txtProductId); //중요한 예제
//});

//////계속입력하기 버튼 클릭 했을때 //stopped 15/05/2019
//$('#continueInput').click(function () {
//    $('.categorySection').show() ////
//    $('#txtProductNo').val('');
//    $('.inputSection').show();
//    $('.buttonShowAndHide').hide();
//});