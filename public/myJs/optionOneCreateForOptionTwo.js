//////////<!--화면 하단의 서브밋 버튼 누르면 상품 등록이 시작된다.-->
$(function () {
    $('#form4').on('submit', function (e) {
        e.preventDefault();

        var sw = true;
        var i = 0;
        $("input[name='txtName[]']").each(function (i) {
            if ((i == 0) && (this.value == "")) {
                sw = false
                alert('첫번째 입력 항목이 비었습니다...');
                //window.location.reload(); //spinner 사용을 위해 reaload를 시킨다
                optionOneCreateForOptionTwo();//spinner 사용을 위해 reaload를 시킨다
            }
            if (sw == false || i > 0) {
                return false;
            }
        });

        ////ajax가 수행되지 않도록 return false 한다.
        if (sw == false || i > 0) {
            return false;
        }

        $.ajax({
            type: "POST",
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url: "/seller/optionOneStore",
            data: $(this).serialize(),
            cache: false,
            success: function (data) {
                if (data.success == true) {
                    ////alert(data.errorMessage);
                    ////$('#form4')[0].reset(); ////form 안에 있는 모든 data를 지운다.

                    ////입력 후 내용을 보여준다.
                    //optionCode = $('.txtOptionCode').val().trim();
                    //productId = $('.txtProductId').val().trim();
                    //modelName = $('.txtModelName').val().trim();
                    ////numOfRow = $('txtNumOfRow').val().trim();

                    optionOneCreateForOptionTwo();

                    //$.ajax({
                    //    type: "get",
                    //    url: "/seller/optionOneCreateForOptionTwo",
                    //    data: { productId: productId, modelName: modelName, optionCode: optionCode },
                    //    chche: false,
                    //    success: function (data) {
                    //        $('.big_page_section').empty().append(data);
                    //        $('.my_loader').hide();
                    //    },
                    //    error: function (data) {
                    //        alert("/seller/optionOneCreateForOptionTwo 시스템에러...");
                    //        $('.my_loader').hide();
                    //    }
                    //});
                    //return false;                       
                }
                else {
                    alert(data.errorMessage);
                    $('.my_loader').hide();
                }
            },
            error: function (data) {
                alert('시스템에러.../seller/optionOneStore')
                $('.my_loader').hide();
            }
        });
        return false;
    });

    
});

////
function optionOneCreateForOptionTwo() {
    optionCode = $('.txtOptionCode').val().trim();
    productId = $('.txtProductId').val().trim();
    modelName = $('.txtModelName').val().trim();
    $.ajax({
        type: "get",
        url: "/seller/optionOneCreateForOptionTwo",
        data: { productId: productId, modelName: modelName, optionCode: optionCode },
        chche: false,
        success: function (data) {
            $('.big_page_section').empty().append(data);
            $('.my_loader').hide();
        },
        error: function (data) {
            alert("/seller/optionOneCreateForOptionTwo 시스템에러...");
            $('.my_loader').hide();
        }
    });
    return false;
}

////
$(function () {
    $('.next_step').click(function () {
        if ($('.description_row').length < 1) {
            alert("옵션1을 먼저 입력 하세요...");
            //window.location.reload(); //spinner 사용을 위해 reaload를 시킨다.
            optionOneCreateForOptionTwo();//spinner 사용을 위해 reaload를 시킨다
            return false;
        }

        productId = $('.txtProductId').val().trim();
        modelName = $('.txtModelName').val().trim();

        $.ajax({
            type: "get",
            url: "/seller/optionOneShowForOptionTwo",
            data: { productId: productId, modelName: modelName },
            chche: false,
            success: function (data) {
                $('.big_page_section').empty().append(data);
                $('.my_loader').hide();
            },
            error: function (data) {
                alert("/seller/optionOneShowForOptionTwo 시스템에러...");
                $('.my_loader').hide();
            }
        });
        return false;
    })
});

////
$('.delete_description').each(function () {
    $(this).click(function () {
        var message = "클릭하신 항목을 지우시겠습니까?";
        var result = confirm(message);
        if (result == true) {
            var selectedId = $(this).find('.selected_id').text().trim();

            eachDeleteItem(selectedId);

        } else {
            optionOneCreateForOptionTwo(); //spinner 사용을 위해 reaload를 시킨다.
        }
    })
})

////어레이로 포스트한다.//////////////////////////////////////
////중요한 예제//////////////////////////////////////////////
function eachDeleteItem(ids) {
    ////declare array
    var arrayIds = [];
    ////push to array
    arrayIds.push(ids);

    $.ajax({
        type: "Post",
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        url: "/seller/deleteOptionOne", ////
        data: { ids: arrayIds },
        cache: false,
        success: function (data) {
            if (data != 1) {
                alert(data);
            }
            else {
                optionOneCreateForOptionTwo();
            }
        },
        error: function (data) {
            alert("/seller/deleteOptionOne 시스템에러...");
            $('.my_loader').hide();//loding spinner를 숨긴다.
        }
    });
    return false;
}
