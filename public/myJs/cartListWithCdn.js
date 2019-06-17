//////////shopping cart가 비어 있으면 화면을 숨긴다/////////////////
$(function () {
    if (parseFloat($('.number_of_rows').text().trim()) < 1) {
        $('.display_section').hide();
    }    
});

//////////////////////<!--금액 편집-->////////////////////////////
$(function () {
    $('.grandTotalOrderAmount_text').each(function () {
        var txtValue = "";
        txtValue = formatNumber($(this).text());
        $(this).empty().append(txtValue);
    })

    $('.grandDeliveryCost_text').each(function () {
        var txtValue = "";
        txtValue = formatNumber($(this).text());
        $(this).empty().append(txtValue);
    })

    $('.grandDiscountedAmoun_text').each(function () {
        var txtValue = "";
        txtValue = formatNumber($(this).text());
        $(this).empty().append(txtValue);
    })

    $('.delivery_free_minimum_txt').each(function () {
        var txtValue = "";
        txtValue = formatNumber($(this).text());
        $(this).empty().append(txtValue);
    })

    $('.saveDeliveryCost_text').each(function () {
        var txtValue = "";
        txtValue = formatNumber($(this).text());
        $(this).empty().append(txtValue);
    })

    $('.saveDiscountedPriceByQtyTotal_text').each(function () {
        var txtValue = "";
        txtValue = formatNumber($(this).text());
        $(this).empty().append(txtValue);
    })

    $('.saveOriginalPriceByQtyTotal_text').each(function () {
        var txtValue = "";
        txtValue = formatNumber($(this).text());
        $(this).empty().append(txtValue);
    })

    $('.order_amount_text').each(function () {
        var txtValue = "";
        txtValue = formatNumber($(this).text());
        $(this).empty().append(txtValue);
    })

    $('.first_option_amount_text').each(function () {
        var txtValue = "";
        txtValue = formatNumber($(this).text());
        $(this).empty().append(txtValue);
    })

    $('.second_option_amount_text').each(function () {
        var txtValue = "";
        txtValue = formatNumber($(this).text());
        $(this).empty().append(txtValue);
    })

    $('.originPrice').each(function () {
        var txtValue = "";
        txtValue = formatNumber($(this).text());
        $(this).next().empty().append(txtValue);
    })

    //$('.sellPrice').each(function () {
    //    var txtValue = "";
    //    txtValue = formatNumber($(this).text());
    //    $(this).next().empty().append(txtValue);
    //})

    $('.sellPrice_txt').each(function () {
        var txtValue = "";
        txtValue = formatNumber($(this).text());
        $(this).empty().append(txtValue);
    })

    var txtValue = "";
    txtValue = formatNumber($('.originGrandTotal_Text').text());
    $('.originGrandTotal_Text').text(txtValue);

    var txtValue = "";
    txtValue = formatNumber($('.grandTotal_Text').text());
    $('.grandTotal_Text').text(txtValue);

});

//편집하는 함수
function formatNumber(num) {
    return num.toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, "$1,")
}

//////////////<!--갯수 박스에 대한 spinner UI를 선언한다.-->///////////
////이렇게 하면 충돌이 생겨 중단.25/05/2019
////$('.orderQty').spinner({
////    min: 1,
////    max: 20,
////    step: 1
////});

////////////////<!--체크박스 선택에 대한 코드-->///////////////////////////////////////////////////
////선택삭제 버튼을 hide,show하기 위해 코드가 복잡해졌다. 나중에 이 코드를 참고 할때는 선택삭제 버튼에///
////해당하는 부분은 지우고 사용할 것.08/05/2019////////////////////////////////////////////////////
$(function () {
    ////테이블 상 하에 있는 체크박스(전체선택)
    $("#cbSelectAll").bind("click", function () {                 
        var ischecked = this.checked;
        $('.checkableGrid').find("input:checkbox").each(function () {
            this.checked = ischecked;           
        });
        $('#cbSelectAll2').each(function () {    //하단의 삭제버튼 옆에있는 체크박스도 동시에 바꾸어준다.
            this.checked = ischecked;
        })

        var checked = $(".checkableGrid input:checkbox:checked").length;////이부분 지울 것
        if (checked > 0) { ////이부분 지울 것
            $('.delete_selected').each(function () {
                $(this).show();
            })
        } else {
            $('.delete_selected').each(function () {
                $(this).hide();
            })
        }
    });

    ////전체선택 문자를 클릭했을때
    $(".cbSelectAll_text").bind("click", function () {      
        var ischecked;
        $('#cbSelectAll').each(function () {
            ischecked = this.checked;
            this.checked = !ischecked;
        })
        $('.checkableGrid').find("input:checkbox").each(function () {
            this.checked = !ischecked;
        });
        $('#cbSelectAll2').each(function () {    //삭제버튼 옆에있는 체크박스도 동시에 바꾸어준다.
            this.checked = !ischecked;
        })

        var checked = $(".checkableGrid input:checkbox:checked").length;////이부분 지울 것
        if (checked > 0) { ////이부분 지울 것
            $('.delete_selected').each(function () {
                $(this).show();
            })
        } else {
            $('.delete_selected').each(function () {
                $(this).hide();
            })
        }
    });

    //각각의  행에 있는 체크박스를 선택(개별선택)
    $("input[name='cartIds']").click(function () {       
        //total check box 수를 구한다.
        var totalRows = $(".checkableGrid .each_check_box :checkbox").length;
        //checked 된 갯 수를 수한다.
        var checked = $(".checkableGrid input:checkbox:checked").length;
        //alert('totalRows = ' + totalRows + 'checked = ' + checked);
        if (checked == totalRows) {
            $(".checkableGrid").find("input:checkbox").each(function () {
                this.checked = true;
                $('#cbSelectAll2').each(function () {    //삭제버튼 옆에있는 체크박스도 동시에 바꾸어준다.
                    this.checked = true;
                })
                $('#cbSelectAll').each(function () {    //헤더에 있는 체크박스도 동시에 바꾸어준다.
                    this.checked = true;
                })
            });           
        }
        else {
            $('#cbSelectAll').each(function () {    //헤더에 있는 체크박스도 동시에 바꾸어준다.
                this.checked = false;
            })
            $('#cbSelectAll2').each(function () {    //삭제버튼 옆에있는 체크박스도 동시에 바꾸어준다.
                this.checked = false;
            })
            ////$("#cbSelectAll").removeAttr("checked");
            ////$("#cbSelectAll2").removeAttr("checked"); //삭제버튼 옆에있는 체크박스도 동시에 바꾸어준다.          
        }

        if (checked > 0) { ////이부분 지울 것
            $('.delete_selected').each(function () {
                $(this).show();
            })
        } else {
            $('.delete_selected').each(function () {
                $(this).hide();
            })
        }
    });

    //하단 삭제버튼 옆에있는 체크박스를 클릭시 헤더에있는 체크박스도 동시에 바꾸어준다.
    $("#cbSelectAll2").bind("click", function () {     
        var ischecked = this.checked;
        $('.checkableGrid').find("input:checkbox").each(function () {
            this.checked = ischecked;
        });
        $('#cbSelectAll').each(function () {    
            this.checked = ischecked;
        })

        var checked = $(".checkableGrid input:checkbox:checked").length;////이부분 지울 것
        if (checked > 0) { ////이부분 지울 것
            $('.delete_selected').each(function () {
                $(this).show();
            })
        } else {
            $('.delete_selected').each(function () {
                $(this).hide();
            })
        }
    });
});

////////////<!--갯수 박스에 대한 spinner UI를 선언한다.-->///////////
////반드시 $m 사용 할 것...23/05/2019///////////////////////////////
$m = jQuery.noConflict();
$m(function () {
    $m('.orderQty').spinner({
        min: 1,
        max: 20,
        step: 1
    });
})

////spinner는 실서버에서 문제없이 작동하나 로컬에서는 다른 page(cartListWithCdnForAjax.blade.php)를
////삽입시에 문제가 발생하고 있음.23/05/2019

/////////////<!--갯수 조정 박스(spinner)를 클릭했을때-->////////////
$('.spinner').each(function () {     //function(i)처럼 "i"를 사용하면 중간에 remove된 경우에는 문제가 생겨
    $(this).unbind().click(function () {    //***여기서는 반드시 unbind()를 사용해야함. 그렇지않을 경우 루핑을 돈다***
        ////변경된 갯수를 찾는다(spinner에서)
        var qty = parseFloat($(this).find('input').attr("aria-valuenow").trim());
        ////productId
        var productId = $(this).parent().parent().find('.productIdxx').text().trim();
        ////cartId 
        var cartId = $(this).parent().parent().find('.cartIdxx').text().trim();
        ////alert("qty=  " + qty + "  productId=  " + "  cartId=  " + cartId);
        ////debugger;
        $.ajax({
            type: "Post",
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url: "/shoppingcart/changeToCart",
            //productId,cartId,quantity 는 콘트롤에서 똑같이 사용해야 한다.
            data: { productId: productId, cartId: cartId, quantity: qty },
            success: function (data) {
                //if (data != 1) {
                //    alert(data);
                //}
                //else {
                //    window.location.reload();////              
                //}
                
                $('.display_section').empty().append(data); ////
                $('.my_loader').hide();               
            },
            error: function (data) {
                alert(data + "  /shoppingcart/changeToCart 시스템에러...");
                $('.my_loader').hide();//loding spinner를 숨긴다.
                //debugger;
            }
        });
        return false;
    });
});

//장바구니에 들어있는 총건수를 구하여 장바구니 메뉴 옆에 보여준다
//세션값을 가져온다...중요한 예제임.....
function displayNumInCart() {   
    //세션값을 가져온다...중요한 예제임.....
    ////아래 php 명령어가 not working...연구중...25/05/2019
    var isLogin = "<?php echo (Auth::guest());?>";    
    if (isLogin != true) //로그인이 된 상태이면 수행한다.
    {
        $.ajax({
            type: "Post",
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url: "/home/countInCart",
            //data: { emailName: email },   //emailName 은 콘트롤에서 똑같이 사용해야 한다..
            cache: false,
            success: function (data) {
                if (data.success == true) {
                    numOfProducts = data.count;
                    //alert(numOfProducts);////
                    $('.num_cart').empty().append(numOfProducts);
                    $('.num_cart').show();  //새로 추가 04/Mar/2019
                }
            },
            error: function (data) {
                alert("/home/countInCart 시스템에러 장바구니 속 상품수...");
            }
        });
    }
}


/////////체크된 아이템을 딜리트하는 코드(삭제 버튼을 클릭했을때)///////
///////////////////////어레이로 포스트한다./////////////////////////
$(function () {
    var sw = "";
    $('.delete_selected').click(function () {
        $('.cartIds').each(function () {
            if ($(this).prop('checked') == true) {
                sw = 'Y'
            }
        });

        if (sw == "Y") {
            var message = "Do you want to delete selected item(s)?";
            var result = confirm(message);
            if (result == true) {
                deleteItems();  ////
                displayNumInCart();////
            } else {
                window.location.reload(); //spinner 사용을 위해 reaload를 시킨다.
                //$('.my_loader').hide();//loding spinner를 숨긴다.
            }
        }
        else {
            alert("Please select any item(s)...");
            window.location.reload(); //spinner 사용을 위해 reaload를 시킨다.
            //$('.my_loader').hide();//loding spinner를 숨긴다.//maybe not working...10/05/2019
        }
    });
});

////어레이로 포스트한다.
function deleteItems() {
    var arrayIds = [];
    $('.cartIds:checked').each(function () {
        var ids = $(this).val().trim();
        arrayIds.push(ids);
    });

    $.ajax({
        type: "Post",
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        url: "/shoppingcart/deleteSelected",
        data: { ids: arrayIds },
        cache: false,
        //async: false, //stopped 10/05/2019
        success: function (data) {
            //if (data != 1) {
            //    alert(data);
            //}
            //else {
            //    window.location.reload();
            //}
            $('.display_section').empty().append(data); ////
            $('.my_loader').hide();
        },
        error: function (data) {
            alert("/shoppingcart/deleteSelected 시스템에러...");
            $('.my_loader').hide();//loding spinner를 숨긴다.
        }
    });
    return false;
}

////json으로 post 할 경우...지우지말것//////////////////////////////
//function deleteItems() {
//    var arrayIds = [];
//    $('.cartIds').each(function () {
//        var ids = $(this).val().trim();   
//        arrayIds.push({"ids": ids});  ////
//    });
//    arrayIds = JSON.stringify({ 'arrayIds': arrayIds });
//    $.ajax({
//        type: "Post",
//        contentType: "json",
//        processData: false,
//        headers: {
//            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
//        },
//        url: "/shoppingcart/deleteSelected",
//        data: arrayIds,
//        cache: false,
//        //async: false, //stopped 10/05/2019          
//        success: function (data) {
//            if (data != 1) {
//                alert(data);
//            }
//            else {
//                window.location.reload();
//            }              
//        },
//        error: function (data) {
//            alert("/shoppingcart/deleteSelected 시스템에러...");              
//        }
//    });
//}

//<!--장바구의 나열된 상품리스트에서 맨 우측 X 마크를 클릭 했을 때-->///
$(function () {
    $('.each_delete').each(function () {
        $(this).click(function () {
            var message = "Do you want to delete selected item(s)?";
            var result = confirm(message);
            if (result == true) {
                ////cartId
                var cartId = ($(this).parent().parent().parent().parent().find('.cartIdxx').text().trim());
                //alert(cartId);
                ////call function
                eachDeleteItem(cartId);////
                displayNumInCart();////
            } else {
                window.location.reload(); //spinner 사용을 위해 reaload를 시킨다.
            }

        })
    })
});

////어레이로 포스트한다.//////////////////////////////////////
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
        url: "/shoppingcart/deleteSelected",
        data: { ids: arrayIds },
        cache: false,
        //async: false, //stopped 10/05/2019
        success: function (data) {
            //if (data != 1) {
            //    alert(data);
            //}
            //else {
            //    window.location.reload();
            //}
            $('.display_section').empty().append(data); ////
            $('.my_loader').hide();
        },
        error: function (data) {
            alert("/shoppingcart/deleteSelected 시스템에러...");
            $('.my_loader').hide();//loding spinner를 숨긴다.
        }
    });
    return false;
}

///////////////////////////주문하기 클릭시//////////////////////////////////////////
$(function () {
    var orgnGT = $('.originGrandTotal_number').text().trim();  ////        
    $('.order_and_pay').click(function () {
        if (orgnGT == 0) {          
            alert("장바구니가 비었습니다...");
            window.location.reload(); //spinner 사용을 위해 reaload를 시킨다.                      
        }
        else {
            window.location.href = '/order/orderPaymentForWebGridWithCdn';  //
        }
    });  
});
