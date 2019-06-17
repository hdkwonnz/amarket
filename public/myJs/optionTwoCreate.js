//////////<!--화면 하단의 서브밋 버튼 누르면 상품 등록이 시작된다.-->
$(function () {
    $('#form2').on('submit', function (e) {
        e.preventDefault();

        var sw = true;
        var i = 0;
        $("input[name='txtName[]']").each(function (i) {
            if ((i == 0) && (this.value == "")) {
                sw = false
                alert('첫번째 입력 항목이 비었습니다...');
                //window.location.reload(); //spinner 사용을 위해 reaload를 시킨다
                optionTwoCreate(); //spinner 사용을 위해 reaload를 시킨다
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
            url: "/seller/optionTwoStore",
            data: $(this).serialize(),
            cache: false,
            success: function (data) {
                if (data.success == true) {
                    ////alert(data.errorMessage);
                    $('#form2')[0].reset(); ////form2 안에 있는 모든 data를 지운다.

                    optionTwoCreate()
                    
                }
                else {
                    alert(data.errorMessage);
                    $('.my_loader').hide();
                }
            },
            error: function (data) {
                alert('시스템에러.../seller/optionTwoStore')
                $('.my_loader').hide();
            }
        });
        return false;
    });    
});

////
function optionTwoCreate() {
    ////입력 후 내용을 보여준다.      
    optionOneId = $('.optionOne_optionOneId').text().trim();
    productId = $('.optionOne_productId').text().trim();
    description = $('.optionOne_description').text().trim();

    $.ajax({
        type: "get",
        url: "/seller/optionTwoCreate",
        data: { productId: productId, optionOneId: optionOneId, description: description },
        chche: false,
        success: function (data) {
            $('.optionTwoCreate_section').empty().append(data);
            $('#txtOptionOneId').val(optionOneId);
            $('.my_loader').hide();
        },
        error: function (data) {
            alert("/seller/optionTwoCreate 시스템에러...");
            $('.my_loader').hide();
        }
    });
    return false;
}

////
$('#confirm_product').click(function () {
    if ($('.description_row').length < 1) {
        alert("옵션1을 먼저 입력 하세요...");
        //window.location.reload(); //spinner 사용을 위해 reaload를 시킨다.
        optionTwoCreate();//spinner 사용을 위해 reaload를 시킨다
        return false;
    }

    productId = $('.optionOne_productId').text().trim();

    window.location.href = '/product/detailsWithCdn/' + productId;
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
            optionTwoCreate(); //spinner 사용을 위해 reaload를 시킨다.
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
        url: "/seller/deleteOptionTwo",
        data: { ids: arrayIds },
        cache: false,
        success: function (data) {
            if (data != 1) {
                alert(data);
            }
            else {
                optionTwoCreate();
            }
        },
        error: function (data) {
            alert("/seller/deleteOptionTwo 시스템에러...");
            $('.my_loader').hide();//loding spinner를 숨긴다.
        }
    });
    return false;
}
