//product details에서 장바구니,바로구매를 처리하는 코드
//loading spinner 사용은 포기했음. $('.my_loader').hide(); 이 not working...27/04/2019
$('.addCart_Click').click(function () {
    if ($('.selectedOption_row').length < 1) {
        alert("선택하신 상품이 없습니다...");
        //$('.my_loader').css('display', 'none');        
        $('.my_loader').hide();//loding spinner를 숨긴다.26/04/2019        
        return false;
    }

    //var productId = parseFloat($('.hidden_productId').text().trim());//detailsWithCdn.blade.php에서 숨긴 productId...       
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
        return false;
    }

    //cartInfos가 동일하게 controller에서도 사용해야 한다.
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
        data: cartInfos,  //cartInfos가 동일하게 controller에서도 사용해야 한다.//어레이 형태로 콘트롤에 보내고 싶으면 이부분을 코멘트할것
        //data: { arr: cartInfos },  //어레이 형태로 콘트롤에 보내고 싶으면 이부분을 사용할것       
        cache: false,
        async: false,
        success: function (data) {
            if (data != 1) {
                alert("'/shoppingcart/addToCartByMultiItems data = " + data + " 연결후 에러...");
            }
            else {
                $('.my_loader').hide();//loding spinner를 숨긴다.26/04/2019
                //Add Cart를 누른후 장바구니 메뉴에 현재 장바구니에 들어있는 총 건수를 보여준다.
                displayNumInCart2();

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
                        },
                        "장바구니로": function () {
                            $m(this).dialog("close");
                            //$m('.addCart_Click').prop('disabled', false);//stop26/04/2019
                            //window.open('/ShoppingCarts/CartList'); //이렇게 하면 새로운 창이 뜬다...
                            window.location.href = '/shoppingcart/cartListWithCdn';
                        }
                    }
                });
            }
            //debugger;
        },
        error: function (data) {
            alert("'/shoppingcart/addToCartByMultiItems data = " + data + " 시스템에러...");
            //debugger;
        }
    });

    return false;

    //장바구니에 들어있는 총건수를 구하여 장바구니 메뉴 옆에 보여준다
    //세션값을 가져온다...중요한 예제임.....
    function displayNumInCart2() {
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
                        //alert(numOfProducts);
                        $('.num_cart').empty().append(numOfProducts);
                    }
                },
                error: function (data) {
                    alert("/home/countInCart 시스템에러 장바구니 속 상품수...");
                }
            });
        }
    }
});
