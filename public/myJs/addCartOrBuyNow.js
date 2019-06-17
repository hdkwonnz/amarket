////product details에서 장바구니,바로구매를 처리하는 코드
////loading spinner 사용은 포기했음. $('.my_loader').hide(); 이 not working...27/04/2019
////loading spinner 포기했다 다시 사용 중(test 중)...11/05/2019
$('.addCart_Click').click(function () {
    if ($('.selectedOption_row').length < 1) {       
        alert("선택하신 상품이 없습니다...");
        window.location.reload(); //spinner 사용을 위해 reaload를 시킨다.             
        return false;        
    }

    ////var productId = parseFloat($('.hidden_productId').text().trim());//detailsWithCdn.blade.php에서 숨긴 productId...       
    var cnt = 0;
    var cartInfos = [];   //cartInfos가 동일하게 controller에서도 사용해야 한다.
    $('.selectedOption_list').each(function (index, element) {
        //alert("index: " + index + "   " + $(element).html()); //지우지 말것.25/04/2019              
        //sellPrice = parseFloat($(this).parent().find('.real_price_option_number').text().trim());
        qty = parseFloat($(this).parent().find('input').attr("aria-valuenow").trim())
        optionCode = $('.option_code').text().trim();
        if (optionCode == 1) {
            option_id = parseFloat($(this).parent().find('.selected_option1_id').text().trim());
        } else if (optionCode == 2) {
            option_id = parseFloat($(this).parent().find('.selected_option2_id').text().trim());
        }
        cartInfos.push({           
            "quantity": qty,
            "optionCode" : optionCode,
            "option_id": option_id           
        });
        cnt++;
        //debugger;              
    });

    if (cnt < 1) {
        alert("선택하신 상품이 없습니다...");
        window.location.reload(); //spinner 사용을 위해 reaload를 시킨다.
        return false;
    }
   
    //어레이 형태로 콘트롤에 보내고 싶으면 아래 부분을 코멘트할것
    cartInfos = JSON.stringify({ 'cartInfos': cartInfos });

    $.ajax({
        //contentType: 'application/json; charset=utf-8', //어레이 형태로 콘트롤에 보내고 싶으면 이부분을 코멘트할것
        //dataType: 'json',  //어레이 형태로 콘트롤에 보내고 싶으면 이부분을 코멘트할것
        type: 'POST',
        contentType: "json",
        processData: false,
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        url: '/shoppingcart/addToCartByMultiItems',
        data: cartInfos, //어레이 형태로 콘트롤에 보내고 싶으면 이부분을 코멘트할것
        //data: { arr: cartInfos },  //어레이 형태로 콘트롤에 보내고 싶으면 이부분을 사용할것       
        cache: false,
        //async: false,//stop 11/05/2019
        success: function (data) {
            if (data != 1) {                
                alert("/shoppingcart/addToCartByMultiItems data = " + data + " 연결후 에러...");                
            }
            else {
                $('.my_loader').hide();//loding spinner를 숨긴다.26/04/2019
                //Add Cart를 누른후 장바구니 메뉴에 현재 장바구니에 들어있는 총 건수를 보여준다.
                displayNumInCart(); 

                $m('#dialogForCart').dialog({
                    autoOpen: true, modal: true, resizable: false, draggable: false,
                    closeOnEscape: false,
                    open: function (event, ui) { $(".ui-dialog-titlebar-close").hide(); },
                    show: {
                        //effect: "blind",
                        //duration: 1000
                    },
                    hide: {
                        effect: "explode",
                        duration: 1000
                    },
                    buttons: {
                        "계속쇼핑하기": function () {
                            $m(this).dialog("close");
                            //$m('.addCart_Click').prop('disabled', false);//stop26/04/2019                           
                            $m('.attach_option_list11').empty();
                            $m('.attach_option_list22').empty();
                            $m('.grand_real_sell_amount11').empty();
                            $m('.grand_real_sell_amount22').empty();
                            $m('.attach_option_list11B').empty();
                            $m('.attach_option_list22B').empty();
                            $m('.grand_real_sell_amount11B').empty();
                            $m('.grand_real_sell_amount22B').empty();
                        },
                        "장바구니로": function () {
                            $m(this).dialog("close");
                            $m('.attach_option_list11').empty();
                            $m('.attach_option_list22').empty();
                            $m('.grand_real_sell_amount11').empty();
                            $m('.grand_real_sell_amount22').empty();
                            $m('.attach_option_list11B').empty();
                            $m('.attach_option_list22B').empty();
                            $m('.grand_real_sell_amount11B').empty();
                            $m('.grand_real_sell_amount22B').empty();
                            //$m('.addCart_Click').prop('disabled', false);//stop26/04/2019
                            //window.open("/ShoppingCarts/CartList","_blank"); //이렇게 하면 새로운 창이 뜬다...
                            window.location.href = '/shoppingcart/cartListWithCdn';                           
                        }
                    }
                });
            }           
            //debugger;
        },
        error: function (data) {           
            alert("/shoppingcart/addToCartByMultiItems data = " + data + " 시스템에러...");
            window.location.reload(); //spinner 사용을 위해 reaload를 시킨다.
            //debugger;
        }
    });
    return false;    
});

//장바구니에 들어있는 총건수를 구하여 장바구니 메뉴 옆에 보여준다
//세션값을 가져온다...중요한 예제임.....
function displayNumInCart() {
    //세션값을 가져온다...중요한 예제임.....
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

////buyNow_Click(구매하기)를 click 했을때
////wep.php의 middleware 문제를 해결 못했음.26/05/2019
$(function () {
    $('.buyNow_Click').click(function () {
        if ($('.selectedOption_row').length < 1) {
            alert("선택하신 상품이 없습니다...");
            window.location.reload(); //spinner 사용을 위해 reaload를 시킨다.             
            return false;
        }

        var cnt = 0;
        var cartInfos = [];   //cartInfos가 동일하게 controller에서도 사용해야 한다.
        $('.selectedOption_list').each(function (index, element) {
            //alert("index: " + index + "   " + $(element).html()); //지우지 말것.25/04/2019              
            //sellPrice = parseFloat($(this).parent().find('.real_price_option_number').text().trim());
            qty = parseFloat($(this).parent().find('input').attr("aria-valuenow").trim())
            optionCode = $('.option_code').text().trim();
            if (optionCode == 1) {
                option_id = parseFloat($(this).parent().find('.selected_option1_id').text().trim());
            } else if (optionCode == 2) {
                option_id = parseFloat($(this).parent().find('.selected_option2_id').text().trim());
            }
            cartInfos.push({
                "quantity": qty,
                "optionCode": optionCode,
                "option_id": option_id
            });
            cnt++;
            //debugger;              
        });

        if (cnt < 1) {
            alert("선택하신 상품이 없습니다...");
            window.location.reload(); //spinner 사용을 위해 reaload를 시킨다.
            return false;
        }
      
        //어레이 형태로 콘트롤에 보내고 싶으면 아래 부분을 코멘트할것
        cartInfos = JSON.stringify({ 'cartInfos': cartInfos });

        $.ajax({
            //contentType: 'application/json; charset=utf-8', //어레이 형태로 콘트롤에 보내고 싶으면 이부분을 코멘트할것
            //dataType: 'json',  //어레이 형태로 콘트롤에 보내고 싶으면 이부분을 코멘트할것
            type: 'post',
            contentType: "json",
            processData: false,
            headers: {                
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url: '/order/buyNow',
            data: cartInfos, //어레이 형태로 콘트롤에 보내고 싶으면 이부분을 코멘트할것
            //data: { arr: cartInfos },  //어레이 형태로 콘트롤에 보내고 싶으면 이부분을 사용할것       
            cache: false,
            //async: false,//stop 11/05/2019
            success: function (data) {
                displayNumInCart()////
                $('.mainLayout_container').empty().append(data);
                $('.my_loader').hide();//loding spinner를 숨긴다.26/04/2019
                //if (data != 1) {
                //    alert("/order/buyNow" + data + " 연결후 에러...");
                //    $('.my_loader').hide();//loding spinner를 숨긴다.26/04/2019
                //}
                //else {
                //    $('.my_loader').hide();//loding spinner를 숨긴다.26/04/2019
                //    //Add Cart를 누른후 장바구니 메뉴에 현재 장바구니에 들어있는 총 건수를 보여준다.
                //    //displayNumInCart2();//잠시 보류...25/05/2019
                //    //window.location.href = '/shoppingcart/cartListWithCdn';
                //    window.location.href = '/order/orderPaymentForWebGridWithCdn';  //
                //}
                ////debugger;
            },
            error: function (data) {
                buyNowWithoutLogin(cartInfos);
                //alert("로그인이 필요합니다...");//임시사용...26/05/2019
                //window.location.href = '/login';//임시사용...26/05/2019
                //$('.my_loader').hide();//loding spinner를 숨긴다.26/04/2019                
                //window.open("/login", "_blank");//새로운 창 열때               
                //alert("/order/buyNow" + data + " 시스템에러...");
                //$('.my_loader').hide();//loding spinner를 숨긴다.26/04/2019
                //window.location.reload(); //spinner 사용을 위해 reaload를 시킨다.
                //debugger;
            }
        });
        return false;
    })
    ////Ajax로 middleware(auth)가 걸린 콘트롤러(OrderController) 접근시 
    ////자동으로 redirect(login page)가 않되고 에러가 나는 문제를 해결하지 못해
    ////임시로 사용 중...26/05/2019
    function buyNowWithoutLogin(cartInfos)
    {
        $.ajax({
            //contentType: 'application/json; charset=utf-8', //어레이 형태로 콘트롤에 보내고 싶으면 이부분을 코멘트할것
            //dataType: 'json',  //어레이 형태로 콘트롤에 보내고 싶으면 이부분을 코멘트할것
            type: 'post',
            contentType: "json",
            processData: false,
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url: '/shoppingcart/buyNowWithoutLogin',
            data: cartInfos, //어레이 형태로 콘트롤에 보내고 싶으면 이부분을 코멘트할것
            //data: { arr: cartInfos },  //어레이 형태로 콘트롤에 보내고 싶으면 이부분을 사용할것       
            cache: false,
            //async: false,//stop 11/05/2019
            success: function (data) {
                displayNumInCart()////
                $('.mainLayout_container').empty().append(data);
                $('.my_loader').hide();//loding spinner를 숨긴다.26/04/2019               
            },
            error: function (data) {                    
                alert("/shoppingcart/buyNowWithoutLogin" + data + " 시스템에러...");
                $('.my_loader').hide();//loding spinner를 숨긴다.26/04/2019                
            }
        });
        return false;
    }
})

////지우지 말 것.11/05/2019
//$('.addCart_Click').click(function () {
//    if ($('.selectedOption_row').length < 1) {
//        alert("선택하신 상품이 없습니다...");
//        return false;
//    } else {
//        $m('#dialogForCart').dialog({
//            autoOpen: true, modal: true, resizable: false, draggable: false,
//            closeOnEscape: false,
//            open: function (event, ui) { $(".ui-dialog-titlebar-close").hide(); },
//            show: {
//                //effect: "blind",
//                //duration: 1000
//            },
//            hide: {
//                effect: "explode",
//                duration: 1000
//            },
//            buttons: {
//                "계속쇼핑하기": function () {
//                    createShoppingCart() //create shopping cart
//                    $m(this).dialog("close");
//                    //$m('.addCart_Click').prop('disabled', false);//stop26/04/2019                           
//                    $m('.attach_option_list11').empty();
//                    $m('.attach_option_list22').empty();
//                    $m('.grand_real_sell_amount11').empty();
//                    $m('.grand_real_sell_amount22').empty();
//                },
//                "장바구니로": function () {                   
//                    createShoppingCart() //create shopping cart
//                    $m(this).dialog("close");
//                    //$m('.addCart_Click').prop('disabled', false);//stop26/04/2019
//                    //window.open('/ShoppingCarts/CartList'); //이렇게 하면 새로운 창이 뜬다...
//                    window.location.href = '/shoppingcart/cartListWithCdn';
//                }
//            }
//        });
//    }
//
//    function createShoppingCart() {
//        //var productId = parseFloat($('.hidden_productId').text().trim());//detailsWithCdn.blade.php에서 숨긴 productId...       
//        var cnt = 0;
//        var cartInfos = [];   //cartInfos가 동일하게 controller에서도 사용해야 한다.
//        $('.selectedOption_list').each(function (index, element) {
//            //alert("index: " + index + "   " + $(element).html()); //지우지 말것.25/04/2019              
//            //sellPrice = parseFloat($(this).parent().find('.real_price_option_number').text().trim());
//            qty = parseFloat($(this).parent().find('input').attr("aria-valuenow").trim())
//            optionCode = $('.option_code').text().trim();
//            if (optionCode == 1) {
//                option_id = parseFloat($(this).parent().find('.selected_option1_id').text().trim());
//            } else if (optionCode == 2) {
//                option_id = parseFloat($(this).parent().find('.selected_option2_id').text().trim());
//            }
//
//            cartInfos.push({
//                "quantity": qty,
//                "optionCode": optionCode,
//                "option_id": option_id
//            });
//            cnt++;
//            //debugger;              
//        });
//
//        if (cnt < 1) {
//            alert("선택하신 상품이 없습니다...");
//            return false;
//        }
//
//        //cartInfos가 동일하게 controller에서도 사용해야 한다.
//        //어레이 형태로 콘트롤에 보내고 싶으면 아래 부분을 코멘트할것
//        cartInfos = JSON.stringify({ 'cartInfos': cartInfos });
//
//        $.ajax({
//            //contentType: 'application/json; charset=utf-8', //어레이 형태로 콘트롤에 보내고 싶으면 이부분을 코멘트할것
//            //dataType: 'json',  //어레이 형태로 콘트롤에 보내고 싶으면 이부분을 코멘트할것
//            type: 'POST',
//            contentType: "json",
//            processData: false,
//            headers: {
//                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
//            },
//            url: '/shoppingcart/addToCartByMultiItems',
//            data: cartInfos,  //cartInfos가 동일하게 controller에서도 사용해야 한다.//어레이 형태로 콘트롤에 보내고 싶으면 이부분을 코멘트할것
//            //data: { arr: cartInfos },  //어레이 형태로 콘트롤에 보내고 싶으면 이부분을 사용할것       
//            cache: false,
//            async: false,
//            success: function (data) {
//                if (data != 1) {
//                    alert("'/shoppingcart/addToCartByMultiItems data = " + data + " 연결후 에러...");
//                }
//                else {
//                    $('.my_loader').hide();//loding spinner를 숨긴다.26/04/2019
//                    //Add Cart를 누른후 장바구니 메뉴에 현재 장바구니에 들어있는 총 건수를 보여준다.
//                    displayNumInCart2();                   
//                }
//                //debugger;
//            },
//            error: function (data) {
//                alert("'/shoppingcart/addToCartByMultiItems data = " + data + " 시스템에러...");
//                //debugger;
//            }
//        });
//        return false;
//    }
//
//    //장바구니에 들어있는 총건수를 구하여 장바구니 메뉴 옆에 보여준다
//    //세션값을 가져온다...중요한 예제임.....
//    function displayNumInCart2() {
//        //세션값을 가져온다...중요한 예제임.....
//        var isLogin = "<?php echo (Auth::guest());?>";
//        if (isLogin != true) //로그인이 된 상태이면 수행한다.
//        {
//            $.ajax({
//                type: "Post",
//                headers: {
//                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
//                },
//                url: "/home/countInCart",
//                //data: { emailName: email },   //emailName 은 콘트롤에서 똑같이 사용해야 한다..
//                cache: false,
//                success: function (data) {
//                    if (data.success == true) {
//                        numOfProducts = data.count;
//                        //alert(numOfProducts);
//                        $('.num_cart').empty().append(numOfProducts);
//                    }
//                },
//                error: function (data) {
//                    alert("/home/countInCart 시스템에러 장바구니 속 상품수...");
//                }
//            });
//            return false //추가.09/05/2019
//        }
//    }
//});
