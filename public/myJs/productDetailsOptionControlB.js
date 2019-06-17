////product details에서 옵션의 갯수에 따라 판매리스트를 만드는 코드
////productDetailsOptionControl.js를 copy 하였다.24/05/2019
$(function () {
    if (($('.option_code').text().trim() == 1) || ($('.option_codeB').text().trim() == 1)) {
        optionCode1();
    } else if (($('.option_code').text().trim() == 2) || ($('.option_codeB').text().trim() == 2)) {
        optionCode2();
    }
});

///////////////////////////////////////////////////////////////////////////////////////////
//////optionCode1//////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////////
function optionCode1() {
    //option code=1 일때(옵션선택box가 1개일때)실행되는 코드이다.28/04/2019
    var existSW = false;   //옵션 상품이 이미 선택되었는지를 체크할때 사용한다. 선택되었으면 true가 된다.
    //아래 addOptionSw 변수를 한번도 사용 않해서 제거해야함.08/05/2019
    var addOptionSw = false; //옵션 상품을 하나라도 선택하였는지 체크할때 사용한다. 선택했으면 true.
    var option11_selected_sw = false; //옵션21이 선택되어지면 true로 바뀐다.    
    var select_option11_click_sw = false; //check 마크 up down toggle switch. 
    var option11_discription_member; //option21의 품목이름   
    var option11_amout; //option22의 가감금액
    var sell_price; //실제판매매금액(세일이면 세일가격 아니면 원래가격)
    var real_price_option; //option 금액을 가감한 실 판매 금액(판매갯수에따라 바뀐다)
    var each_real_price_option; //option 금액을 가감한 실 판매 금액(1 개당 금액)
    var totalAmountSellPrice; //총 판매금액
    var option11_first_options_id; //선택되어진 두번째 옵션에 해당하는 첫번째 옵션 ID   
    var option_product_id; //선택되어진 옵션에 해당하는 product ID
    //옵션11을 클릭하면(첫번째 option box) 옵션1 리스트를 보여준다.        
    $('.select_option11').click(function () {
        //옵션11(첫번째 option box)을 클릭 
        $('.option_list11').hide();
        $('.chevron_up_option11').css('display', 'none'); //체크마크를 위 아래로 보여준다
        $('.chevron_down_option11').css('display', 'inline-block');

        if (!select_option11_click_sw) { //select_option11_click_sw가 false라면//check 마크 up down toggle switch.        
            $('.chevron_down_option11').css('display', 'none'); //체크마크를 위 아래로 보여준다
            $('.chevron_up_option11').css('display', 'inline-block');

            ////지우지 말 것.20/05/2019
            ////var height = $('.show_option11_list').height(); //박스의 탑으로 부터 바텀 까지의 길이를 구하여
            ////var realHeight = 0 - (height - 560);           //늘어나는 길이에 상관 없이 항상 박스 탑에 위치 시킨다. 650 580 635
            ////$('.option_list11').css('top', realHeight + 'px').css('left', '-15px')
            ////    .css('position', 'absolute').css('z-index', '2').show();
            ////select_option11_click_sw = true;//check 마크 up down toggle switch.

            $('.option_list11').css('left', '-15px')
                .css('position', 'absolute').css('z-index', '2').show();
            select_option11_click_sw = true;
        }
        else {
            $('.chevron_up_option11').css('display', 'none'); //체크마크를 위 아래로 보여준다
            $('.chevron_down_option11').css('display', 'inline-block');
            select_option11_click_sw = false;//check 마크 up down toggle switch.
            $('.option_list11').hide();
        }

        //편집함수로 금액을 편집한다.           
        $('.option11_stock_text').each(function () {
            txtValue = formatNumber($(this).text());
            $(this).text(txtValue);
        });
    });

    ////B routine///////////////////////////////////////////////////////////
    $('.select_option11B').click(function () {
        //옵션11(첫번째 option box)을 클릭 
        $('.option_list11B').hide();
        $('.chevron_up_option11B').css('display', 'none'); //체크마크를 위 아래로 보여준다
        $('.chevron_down_option11B').css('display', 'inline-block');

        if (!select_option11_click_sw) { //select_option11_click_sw가 false라면//check 마크 up down toggle switch.        
            $('.chevron_down_option11B').css('display', 'none'); //체크마크를 위 아래로 보여준다
            $('.chevron_up_option11B').css('display', 'inline-block');

            ////지우지 말 것.20/05/2019
            ////var height = $('.show_option11_list').height(); //박스의 탑으로 부터 바텀 까지의 길이를 구하여
            ////var realHeight = 0 - (height - 560);           //늘어나는 길이에 상관 없이 항상 박스 탑에 위치 시킨다. 650 580 635
            ////$('.option_list11').css('top', realHeight + 'px').css('left', '-15px')
            ////    .css('position', 'absolute').css('z-index', '2').show();
            ////select_option11_click_sw = true;//check 마크 up down toggle switch.

            $('.option_list11B').css('left', '-15px')
                .css('position', 'absolute').css('z-index', '2').show();
            select_option11_click_sw = true;
        }
        else {
            $('.chevron_up_option11B').css('display', 'none'); //체크마크를 위 아래로 보여준다
            $('.chevron_down_option11B').css('display', 'inline-block');
            select_option11_click_sw = false;//check 마크 up down toggle switch.
            $('.option_list11B').hide();
        }

        //편집함수로 금액을 편집한다.           
        $('.option11_stock_textB').each(function () {
            txtValue = formatNumber($(this).text());
            $(this).text(txtValue);
        });
    });
    ////end of B routine////////////////////////////////////////////////////

    //옵션11 리스트가 펼쳐진 상태에서 원하는 상품 클릭하면...
    $('.productList_option11').each(function () {
        $(this).click(function () {
            $('.chevron_up_option11').css('display', 'none'); //check 표시 up-down
            $('.chevron_down_option11').css('display', 'inline-block');
            select_option11_click_sw = false;
            $('.option_list11').hide(); //option1의 리스트를 숨긴다
            //$('.option01_01_description').empty().append("옵션명11"); //옵션11 box를 initializing한다.
            option11_selected_sw = false;

            //현재 선택된 option1 ID
            option11_first_options_id = $(this).find('.option11_first_options_id').text().trim();//option1 ID            
            ////$(this).find = $(this).find('.option_product_id').text().trim();//product ID

            //옵션상품을 클릭시 이미 선택하였나 체크한다.
            //$('.selectedOption_list').each(function () {
            $('.selectedOption_row').each(function () {
                //이미 선택된 option1 ID
                var existOption1Id = $(this).find('.selected_option1_id').text().trim();
                //이미 선택된 product ID
                ////var existPorductId = $(this).find('.selected_option_productId').text().trim();

                if (existOption1Id == option11_first_options_id) {
                    existSW = true;
                    return false;     //단지 each loop만 빠져나가고 뒤에 코드는 수행된다...
                }
            });
            if (existSW == true)  //선택되었다면 뒤에 코드는 실행하지 않는다.
            {
                alert("이미 선택하셨습니다...");
                //$('.selectedOption_list').show();   //기존 선택된 상품들을 보여준다
                $('.selectedOption_row').show();   //기존 선택된 상품들을 보여준다  
                existSW = false;   //다시 false로 바꾸어 놓는다...
                return false;
            }

            //////////각종 금액, 옵션11 상품 이름을 구하는 루틴////////                
            option11_discription_member = $(this).find('.option01_01_description_member').text().trim();//option2 품목명
            option11_amount = $(this).find('.option11_amount').text().trim(); //option 가감액 
            option11_stock = $(this).find('.option11_stock').text().trim(); //option 재고 
            sell_price = parseFloat($('.sellPriceAjax').text().trim()); //실판매금액(디스카운트 된 금액)
            real_price_option = sell_price + parseFloat(option11_amount); //옴션을 가감한 금액.(갯수에 따라 바뀐다.)    
            each_real_price_option = sell_price + parseFloat(option11_amount); //옴션을 가감한 금액.(1 개당금액.)

            //총 판매금액을 구한다.                
            totalAmountSellPrice = 0;
            var totalIndex = $('.selectedOption_row').length; //선택된 옵션 상품이 몇개인지 체크해서                         
            if (totalIndex > 0) { //한개 이상이면 현재 보여지는(실제는 숨겨져있다) 총상품금액을 가져온다.
                totalAmountSellPrice = parseFloat($('.totalAmountNumber11').text().trim()); //현상태의 총상품금액(숫자로 바꾸었음)                    
                //alert("1.totalAmountSellPrice " + totalAmountSellPrice);//////////////
            }
            //총상품금액을 구한다
            totalAmountSellPrice = totalAmountSellPrice + real_price_option;

            //최종 선택 되어진 옵션에따라 판매 리스트를 만든다.
            //판매리스트를 수정 삭제, 장바구니,바로구매등이 이루어진다...
            buildingOptionList1();
            ////for B routine////////////////////
            buildingOptionList1B();
        });
    });

    ////B routine/////////////////////////////////////////////////////////
    $('.productList_option11B').each(function () {
        $(this).click(function () {
            $('.chevron_up_option11B').css('display', 'none'); //check 표시 up-down
            $('.chevron_down_option11B').css('display', 'inline-block');
            select_option11_click_sw = false;
            $('.option_list11B').hide(); //option1의 리스트를 숨긴다
            //$('.option01_01_description').empty().append("옵션명11"); //옵션11 box를 initializing한다.
            option11_selected_sw = false;

            //현재 선택된 option1 ID
            option11_first_options_id = $(this).find('.option11_first_options_idB').text().trim();//option1 ID            
            ////$(this).find = $(this).find('.option_product_id').text().trim();//product ID

            //옵션상품을 클릭시 이미 선택하였나 체크한다.
            //$('.selectedOption_list').each(function () {
            $('.selectedOption_rowB').each(function () {
                //이미 선택된 option1 ID
                var existOption1Id = $(this).find('.selected_option1_idB').text().trim();
                //이미 선택된 product ID
                ////var existPorductId = $(this).find('.selected_option_productId').text().trim();

                if (existOption1Id == option11_first_options_id) {
                    existSW = true;
                    return false;     //단지 each loop만 빠져나가고 뒤에 코드는 수행된다...
                }
            });
            if (existSW == true)  //선택되었다면 뒤에 코드는 실행하지 않는다.
            {
                alert("이미 선택하셨습니다...");
                //$('.selectedOption_list').show();   //기존 선택된 상품들을 보여준다
                $('.selectedOption_rowB').show();   //기존 선택된 상품들을 보여준다  
                existSW = false;   //다시 false로 바꾸어 놓는다...
                return false;
            }

            //////////각종 금액, 옵션11 상품 이름을 구하는 루틴////////                
            option11_discription_member = $(this).find('.option01_01_description_memberB').text().trim();//option2 품목명
            option11_amount = $(this).find('.option11_amountB').text().trim(); //option 가감액 
            option11_stock = $(this).find('.option11_stockB').text().trim(); //option 재고 
            sell_price = parseFloat($('.sellPriceAjax').text().trim()); //실판매금액(디스카운트 된 금액)
            real_price_option = sell_price + parseFloat(option11_amount); //옴션을 가감한 금액.(갯수에 따라 바뀐다.)    
            each_real_price_option = sell_price + parseFloat(option11_amount); //옴션을 가감한 금액.(1 개당금액.)

            //총 판매금액을 구한다.                
            totalAmountSellPrice = 0;
            var totalIndex = $('.selectedOption_rowB').length; //선택된 옵션 상품이 몇개인지 체크해서                         
            if (totalIndex > 0) { //한개 이상이면 현재 보여지는(실제는 숨겨져있다) 총상품금액을 가져온다.
                totalAmountSellPrice = parseFloat($('.totalAmountNumber11B').text().trim()); //현상태의 총상품금액(숫자로 바꾸었음)                    
                //alert("1.totalAmountSellPrice " + totalAmountSellPrice);//////////////
            }
            //총상품금액을 구한다
            totalAmountSellPrice = totalAmountSellPrice + real_price_option;

            //최종 선택 되어진 옵션에따라 판매 리스트를 만든다.
            //판매리스트를 수정 삭제, 장바구니,바로구매등이 이루어진다...
            buildingOptionList1B();
            ////for top////
            buildingOptionList1();
        });
    });
    ////end of B routine//////////////////////////////////////////////////

    ////최종 선택 되어진 옵션에따라 판매 리스트를 만든다.
    ////맨먼저 내용이 들어갈 공간을 만든다.그리고 그곳에 필요한 데이터를 넣고 갯수 수정 삭제등을 한다
    ////장바구니,바로구매등이 이루어진다...
    function buildingOptionList1() {
        $('.attach_option_list11').append(
            '<div class="selectedOption_row"style="border: 1px solid rgba(128, 128, 128, 0.10); background-color: rgba(128, 128, 128, 0.1); min-height: 50px; line-height: 50px; padding-left: 15px; margin-right: 0px; margin-top: 5px;">' +
                '<div class="row selectedOption_list">' + //selectedOption_list
                    '<div class="col-sm-12 col-md-12 col-lg-12">' +
                        '<span class="selected_option_productId" style="display: none;"> </span>' + //product ID
                        '<span class="selected_option1_description"> </span>' + //옵션1 품목네임
                        '<span class="selected_option1_id" style="display:none;"> </span>' + //옵션1 품목 id                                              
                        '<span>(</span>' + //(
                        '<span class="plus_sign" style="display:none;">+</span>' + //+ 표시
                        '<span class="selected_option1_amount_text"></span>' + //옵션1 편집된 가감가격
                        '<span>원)-재고</span>' + //원) - 재고
                        '<span class="selected_option1_stock_text"></span>' + //옵션1 편집된 재고
                        '<span>개</span>' + //개                        
                        '<span class="real_price_option_number" style="display:none;"> </span>' + //갯수에 의한 실제판매금액(숫자)
                        '<span class="each_real_price_option_number" style="display:none;"> </span>' + //개당실제판매금액(숫자)
                    '</div>' +
                '</div>' + //////////////
                '<div class="row">' + //selectedOption_list class removed here...
                    '<div class="col-sm-12 col-md-12 col-lg-12">' +
                        '<div style="border-top: 1px solid rgba(128, 128, 128, 0.10); margin-right: 0px; margin-left: -15px;">' +
                            '<div class="col-sm-3 col-md-3 col-lg-3">' + //spinner style
                                '<span class="spinner" style="height: 40px; line-height: 40px;"></span>' + //spinner
                            '</div>' +
                            '<div class="col-sm-8 col-md-8 col-lg-8" style="text-align: right; font-size: 20px;">' +
                                '<span class="real_price_option_text"></span>원' + //편집된 실제 판매 금액                              
                                '<span class="real_price_option_number" style="display:none;"> </span>' + //갯수에 의한 실제판매금액(숫자)
                                '<span class="each_real_price_option_number" style="display:none;"> </span>' + //개당실제판매금액(숫자)
                            '</div>' + //취소X버튼
                            '<div class="col-sm-1 col-md-1 col-lg-1" style="text-align: right; font-size: 20px;">' + //취소X버튼
                                '<a href="javascript:void(0)" return false;" class="xButton" style="font-size: 20px; opacity: 0.5;"> X</a>' +
                            '</div>' +
                        '</div>' +
                    '</div>' + ///////////
                '</div>' +
            '</div>'
            );

        ////위에서 만들어진 레이어 안에 해당 사항을 넣는다
        //option1의 품목명을 넣는다.
        $('.selected_option1_description').last().prepend(option11_discription_member).css('word-break', 'break-all');
        //product ID
        $('.selected_option_productId').last().prepend(option_product_id);
        //option1 ID
        $('.selected_option1_id').last().prepend(option11_first_options_id);
        //option1 amount
        $('.selected_option1_amount_text').last().prepend(option11_amount);
        if (option11_amount > 0) {
            $('.plus_sign').show();
        }
        //option1 stock
        $('.selected_option1_stock_text').last().prepend(option11_stock);
        //jquery-ui spinner를 추가
        $('.spinner').last().append('<input class="orderQty" name="orderQty"  value="1" readonly style="width: 20px; height: 15px;"/>' + '&nbsp;개 &nbsp;');  //갯수 박스 spinner
        //아래 $m에 주의 할 것($m = jQuery.noConflict();을 선언 했음)
        $m('.orderQty').spinner({ //갯수 박스에 대한 스피너 UI를 선언한다.(반드시 현 위치 해야 한다...)
            min: 1,
            max: 20,
            step: 1
        });
        //sell실제금액(할인된금액)을 편집하여 주입한다.
        $('.real_price_option_text').last().prepend(real_price_option).css('word-break', 'break-all');
        //sell실제금액(할인된금액)을 숫자상태로 주입한다.(판매갯수에 따라 바뀐다)
        $('.real_price_option_number').last().prepend(real_price_option).css('word-break', 'break-all');
        //sell실제금액(할인된금액)을 숫자상태로 주입한다.(1 개당 금액)
        $('.each_real_price_option_number').last().prepend(each_real_price_option).css('word-break', 'break-all');
        ////총금액을 주입
        $('.totalAmountNumber11').empty().append(totalAmountSellPrice); //총상품금액란에 number를 넣는다.
        $('#totalAmount11_text').empty().append(totalAmountSellPrice);  //총상품금액란에 편집된 내용을 넣는다.
        $('.grand_real_sell_amount11').show(); //총상품금액을 보여준다.

        //옵션 상품을 선택 했으니 true로 만든다.
        addOptionSw = true; //addOptionSw 변수를 한번도 사용 않해서 제거해야함.08/05/2019

        //편집함수로 금액을 편집한다.
        $('.real_price_option_text').each(function () {
            txtValue = formatNumber($(this).text());
            $(this).text(txtValue);
        });
        $('#totalAmount11_text').each(function () {
            txtValue = formatNumber($(this).text());
            $(this).text(txtValue);
        });
        $('.selected_option1_amount_text').each(function () {
            txtValue = formatNumber($(this).text());
            $(this).text(txtValue);
        });
        $('.selected_option1_stock_text').each(function () {
            txtValue = formatNumber($(this).text());
            $(this).text(txtValue);
        });

        //갯수 조정 박스를 눌렀을때...//spinner value(선택한개수)
        $('.spinner').each(function () {     //function(i)처럼 "i"를 사용하면 중간에 remove된 경우에는 문제가 생겨
            $(this).unbind().click(function () {    //***여기서는 반드시 unbind()를 사용해야함. 그렇지않을 경우 루핑을 돈다***
                //현재의 실제 판매금액을 save(spinner적용 전 상태의)
                var currentSellPrice = parseFloat($(this).parent().parent().find('.real_price_option_number').text().trim());
                //현상태의 총상품금액 save(spinner적용 전 상태의)
                var currentTotalAmountNumber = parseFloat($('.totalAmountNumber11').text().trim());
                //현상태의 총상품금액에서 숫자갯수만큼의 sellPrice를 빼준다(spinner적용 전 상태의)
                var totalAmountSellPriceTemp = currentTotalAmountNumber - currentSellPrice;

                //alert($(this).children().html());//이렇게 alert로 확인 한 다음 아래처럼 찾으면 된다.23/04/2019
                //변경된 갯수를 찾는다(spinner에서)
                var qty = parseFloat($(this).find('input').attr("aria-valuenow")); //integer
                //변경된 option1_id를 찾는다(spinner에서)//for B routine////
                selectedOptionOneIdForB = $(this).parent().parent().parent().parent().parent().find('.selected_option1_id').text().trim();               
                //selected_option1_id를 찾아 B routine 에도 주입 시킨다.               
                $('.selectedOption_listB').each(function () {
                    if (selectedOptionOneIdForB == ($(this).find('.selected_option1_idB').text().trim())) {
                        $(this).find('.selected_option1_idB').parent().parent().parent().find('input[aria-valuenow]').val(qty);
                    }
                })
                ////$('.spinnerB').find('input[aria-valuenow]').val(qty);////중요한 예제...
                //개당 실제판매 금액 
                var each_real_price_option_number = parseFloat($(this).parent().parent().find('.each_real_price_option_number').text().trim());
                //새로 선택한 갯수에 숫자 한개당 sellPrice를 곱한다(새로운 판매 금액)
                var newSellPrice = qty * each_real_price_option_number;
                //새로운 총상품금액을 구한다
                var totalAmountSellPriceNew = totalAmountSellPriceTemp + newSellPrice;

                //sell실제금액(할인된금액)을 편집하여 주입한다.
                $(this).parent().parent().find('.real_price_option_text').empty().prepend(newSellPrice).css('word-break', 'break-all');
                //sell실제금액(할인된금액)을 편집하여 주입한다.////for B routine               
                //selected_option1_id를 찾아 B routine 에도 주입 시킨다.               
                $('.selectedOption_listB').each(function () {
                    if (selectedOptionOneIdForB == ($(this).find('.selected_option1_idB').text().trim())) {                     
                        $(this).parent().find('.real_price_option_textB').empty().prepend(newSellPrice).css('word-break', 'break-all');
                    }
                })
                //sell실제금액(할인된금액)을 숫자상태로 주입한다.(판매갯수에 따라 바뀐다)
                $(this).parent().parent().find('.real_price_option_number').empty().prepend(newSellPrice).css('word-break', 'break-all');
                //sell실제금액(할인된금액)을 숫자상태로 주입한다.(판매갯수에 따라 바뀐다)////for B routine                                           
                //selected_option1_id를 찾아 B routine 에도 주입 시킨다.               
                $('.selectedOption_listB').each(function () {
                    if (selectedOptionOneIdForB == ($(this).find('.selected_option1_idB').text().trim())) {
                        $(this).parent().find('.real_price_option_numberB').empty().prepend(newSellPrice).css('word-break', 'break-all');
                    }
                })               
                ////총금액을 주입
                //총상품금액란에 number를 넣는다.
                $('.totalAmountNumber11').empty().append(totalAmountSellPriceNew);
                //총상품금액란에 number를 넣는다.////for B routine////
                $('.totalAmountNumber11B').empty().append(totalAmountSellPriceNew);
                //총상품금액란에 편집된 내용을 넣는다.
                $('#totalAmount11_text').empty().append(totalAmountSellPriceNew);
                //총상품금액란에 편집된 내용을 넣는다.//for B routine////
                $('#totalAmount11_textB').empty().append(totalAmountSellPriceNew);
                //총상품금액을 보여준다.
                $('.grand_real_sell_amount11').show();
                //총상품금액을 보여준다.//for B routine
                $('.grand_real_sell_amount11B').show();

                //편집함수로 금액을 편집한다.
                $('.real_price_option_text').each(function () {
                    txtValue = formatNumber($(this).text());
                    $(this).text(txtValue);
                });
                $('#totalAmount11_text').each(function () {
                    txtValue = formatNumber($(this).text());
                    $(this).text(txtValue);
                });
                //편집함수로 금액을 편집한다.//for B routine////
                $('.real_price_option_textB').each(function () {
                    txtValue = formatNumber($(this).text());
                    $(this).text(txtValue);
                });
                $('#totalAmount11_textB').each(function () {
                    txtValue = formatNumber($(this).text());
                    $(this).text(txtValue);
                });
            });
        });

        ////옵션선택 리스트에서 "X"마크를 눌렀을때
        var currentTotalAmountNumber = 0;
        var currentSellPricexx = 0;
        var totalAmountSellPricexx = 0;
        var totalAmount_txt = 0;
        $('.xButton').unbind().click(function () { //***여기서는 반드시 unbind()를 사용해야함. 그렇지않을 경우 두번 루핑을 돈다*** 
            //현상태의 총상품금액
            currentTotalAmountNumber = parseFloat($('.totalAmountNumber11').text().trim());
            //현 상태의 갯수만큼의 판매 금액
            currentSellPricexx = parseFloat($(this).parent().parent().find('.real_price_option_number').text().trim());
            //총상품금액에서 빠져나갈 금액을 뺀다(실제로 남아있을 총 금액)                
            totalAmountSellPricexx = parseFloat(currentTotalAmountNumber) - parseFloat(currentSellPricexx);
            ////총금액을 주입
            //총상품금액란에 number를 넣는다.
            $('.totalAmountNumber11').empty().append(totalAmountSellPricexx);
            //총상품금액란에 number를 넣는다.//for B routine////
            $('.totalAmountNumber11B').empty().append(totalAmountSellPricexx);
            //총상품금액란에 편집된 내용을 넣는다.
            $('#totalAmount11_text').empty().append(totalAmountSellPricexx);
            //총상품금액란에 편집된 내용을 넣는다.//for B routine////
            $('#totalAmount11_textB').empty().append(totalAmountSellPricexx);
            //총상품금액을 보여준다.//for B routine////
            $('.grand_real_sell_amount11B').show();

            //편집함수로 금액을 편집한다.           
            $('#totalAmount11_text').each(function () {
                txtValue = formatNumber($(this).text());
                $(this).text(txtValue);
            });
            //편집함수로 금액을 편집한다.//for B routine////         
            $('#totalAmount11_textB').each(function () {
                txtValue = formatNumber($(this).text());
                $(this).text(txtValue);
            });

            //해당 정보를 삭제하고 선택된 상품이 하나도 없으면 총상춤금액란을 숨긴다.
            $(this).parent().parent().parent().parent().parent().remove();
            //for B routine////
            //selected_option1_id를 찾아 B에서도 remove 시킨다.
            selectedOptionOneIdForB = $(this).parent().parent().parent().parent().parent().find('.selected_option1_id').text().trim();
            $('.selectedOption_listB').each(function () {                
                if (selectedOptionOneIdForB == ($(this).find('.selected_option1_idB').text().trim()))
                {
                    $(this).find('.selected_option1_idB').parent().parent().parent().remove();                  
                }                                     
            })

            if (totalAmountSellPricexx == 0) {
                //아래 addOptionSw 변수를 한번도 사용 않해서 제거해야함.08/05/2019
                addOptionSw = false; //선택된 옵션 상품이 하나도 없으니 false로 만든다
                $('.grand_real_sell_amount11').hide();
                //for B routine////
                $('.grand_real_sell_amount11B').hide();
            }
        });
    } //end of function buildingOptionList1()

    ////B routine//////////////////////////////////////////////////////////////////////////
    function buildingOptionList1B() {
        $('.attach_option_list11B').append(
            '<div class="selectedOption_rowB"style="border: 1px solid rgba(128, 128, 128, 0.10); background-color: rgba(128, 128, 128, 0.1); min-height: 50px; line-height: 50px; padding-left: 15px; margin-right: 0px; margin-top: 5px;">' +
                '<div class="row selectedOption_listB">' + //selectedOption_list
                    '<div class="col-sm-12 col-md-12 col-lg-12">' +
                        '<span class="selected_option_productIdB" style="display: none;"> </span>' + //product ID
                        '<span class="selected_option1_descriptionB"> </span>' + //옵션1 품목네임
                        '<span class="selected_option1_idB" style="display:none;"> </span>' + //옵션1 품목 id                                              
                        '<span>(</span>' + //(
                        '<span class="plus_signB" style="display:none;">+</span>' + //+ 표시
                        '<span class="selected_option1_amount_textB"></span>' + //옵션1 편집된 가감가격
                        '<span>원)-재고</span>' + //원) - 재고
                        '<span class="selected_option1_stock_textB"></span>' + //옵션1 편집된 재고
                        '<span>개</span>' + //개                        
                        '<span class="real_price_option_numberB" style="display:none;"> </span>' + //갯수에 의한 실제판매금액(숫자)
                        '<span class="each_real_price_option_numberB" style="display:none;"> </span>' + //개당실제판매금액(숫자)
                    '</div>' +
                '</div>' + //////////////
                '<div class="row">' + //selectedOption_list class removed here...
                    '<div class="col-sm-12 col-md-12 col-lg-12">' +
                        '<div style="border-top: 1px solid rgba(128, 128, 128, 0.10); margin-right: 0px; margin-left: -15px;">' +
                            '<div class="col-sm-4 col-md-4 col-lg-4">' + //spinner style
                                '<span class="spinnerB" style="height: 30px; line-height: 30px;"></span>' + //spinner
                            '</div>' +
                            '<div class="col-sm-6 col-md-6 col-lg-6" style="text-align: right; font-size: 15px;">' +
                                '<span class="real_price_option_textB"></span>원' +  //편집된 실제 판매 금액                                
                                '<span class="real_price_option_numberB" style="display:none;"> </span>' + //갯수에 의한 실제판매금액(숫자)
                                '<span class="each_real_price_option_numberB" style="display:none;"> </span>' + //개당실제판매금액(숫자)
                            '</div>' + //취소X버튼
                            '<div class="col-sm-2 col-md-2 col-lg-2" style="text-align: right; font-size: 15px;">' + //취소X버튼
                                '<a href="javascript:void(0)" return false;" class="xButtonB" style="font-size: 15px; opacity: 0.5;"> X</a>' +
                            '</div>' +
                        '</div>' +
                    '</div>' + ///////////
                '</div>' +
            '</div>'
            );

        ////위에서 만들어진 레이어 안에 해당 사항을 넣는다
        //option1의 품목명을 넣는다.
        $('.selected_option1_descriptionB').last().prepend(option11_discription_member).css('word-break', 'break-all');
        //product ID
        $('.selected_option_productIdB').last().prepend(option_product_id);
        //option1 ID
        $('.selected_option1_idB').last().prepend(option11_first_options_id);
        //option1 amount
        $('.selected_option1_amount_textB').last().prepend(option11_amount);
        if (option11_amount > 0) {
            $('.plus_sign').show();
        }
        //option1 stock
        $('.selected_option1_stock_textB').last().prepend(option11_stock);
        //jquery-ui spinner를 추가
        $('.spinnerB').last().append('<input class="orderQtyB" name="orderQty"  value="1" readonly style="width: 20px; height: 15px;"/>' + '&nbsp;개 &nbsp;');  //갯수 박스 spinner
        //아래 $m에 주의 할 것($m = jQuery.noConflict();을 선언 했음)
        $m('.orderQtyB').spinner({ //갯수 박스에 대한 스피너 UI를 선언한다.(반드시 현 위치 해야 한다...)
            min: 1,
            max: 20,
            step: 1
        });
        //sell실제금액(할인된금액)을 편집하여 주입한다.
        $('.real_price_option_textB').last().prepend(real_price_option).css('word-break', 'break-all');
        //sell실제금액(할인된금액)을 숫자상태로 주입한다.(판매갯수에 따라 바뀐다)
        $('.real_price_option_numberB').last().prepend(real_price_option).css('word-break', 'break-all');
        //sell실제금액(할인된금액)을 숫자상태로 주입한다.(1 개당 금액)
        $('.each_real_price_option_numberB').last().prepend(each_real_price_option).css('word-break', 'break-all');
        ////총금액을 주입
        $('.totalAmountNumber11B').empty().append(totalAmountSellPrice); //총상품금액란에 number를 넣는다.
        $('#totalAmount11_textB').empty().append(totalAmountSellPrice);  //총상품금액란에 편집된 내용을 넣는다.
        $('.grand_real_sell_amount11B').show(); //총상품금액을 보여준다.

        //옵션 상품을 선택 했으니 true로 만든다.
        addOptionSw = true; //addOptionSw 변수를 한번도 사용 않해서 제거해야함.08/05/2019

        //편집함수로 금액을 편집한다.
        $('.real_price_option_textB').each(function () {
            txtValue = formatNumber($(this).text());
            $(this).text(txtValue);
        });
        $('#totalAmount11_textB').each(function () {
            txtValue = formatNumber($(this).text());
            $(this).text(txtValue);
        });
        $('.selected_option1_amount_textB').each(function () {
            txtValue = formatNumber($(this).text());
            $(this).text(txtValue);
        });
        $('.selected_option1_stock_textB').each(function () {
            txtValue = formatNumber($(this).text());
            $(this).text(txtValue);
        });

        //갯수 조정 박스를 눌렀을때...//spinner value(선택한개수)
        $('.spinnerB').each(function () {     //function(i)처럼 "i"를 사용하면 중간에 remove된 경우에는 문제가 생겨
            $(this).unbind().click(function () {    //***여기서는 반드시 unbind()를 사용해야함. 그렇지않을 경우 루핑을 돈다***
                //현재의 실제 판매금액을 save(spinner적용 전 상태의)
                var currentSellPrice = parseFloat($(this).parent().parent().find('.real_price_option_numberB').text().trim());
                //현상태의 총상품금액 save(spinner적용 전 상태의)
                var currentTotalAmountNumber = parseFloat($('.totalAmountNumber11B').text().trim());
                //현상태의 총상품금액에서 숫자갯수만큼의 sellPrice를 빼준다(spinner적용 전 상태의)
                var totalAmountSellPriceTemp = currentTotalAmountNumber - currentSellPrice;

                //alert($(this).children().html());//이렇게 alert로 확인 한 다음 아래처럼 찾으면 된다.23/04/2019
                //변경된 갯수를 찾는다(spinner에서)
                var qty = parseFloat($(this).find('input').attr("aria-valuenow")); //integer
                //변경된 option1_id를 찾는다(spinner에서)//for Top routine////
                selectedOptionOneIdForTop = $(this).parent().parent().parent().parent().parent().find('.selected_option1_idB').text().trim();
                //selected_option1_id를 찾아 Top routine 에도 주입 시킨다.               
                $('.selectedOption_list').each(function () {
                    if (selectedOptionOneIdForTop == ($(this).find('.selected_option1_id').text().trim())) {
                        $(this).find('.selected_option1_id').parent().parent().parent().find('input[aria-valuenow]').val(qty);
                    }
                })
                //개당 실제판매 금액 
                var each_real_price_option_number = parseFloat($(this).parent().parent().find('.each_real_price_option_numberB').text().trim());
                //새로 선택한 갯수에 숫자 한개당 sellPrice를 곱한다(새로운 판매 금액)
                var newSellPrice = qty * each_real_price_option_number;
                //새로운 총상품금액을 구한다
                var totalAmountSellPriceNew = totalAmountSellPriceTemp + newSellPrice;

                //sell실제금액(할인된금액)을 편집하여 주입한다.
                $(this).parent().parent().find('.real_price_option_textB').empty().prepend(newSellPrice).css('word-break', 'break-all');
                //sell실제금액(할인된금액)을 편집하여 주입한다.////for Top routine               
                //selected_option1_id를 찾아 Top routine 에도 주입 시킨다.               
                $('.selectedOption_list').each(function () {
                    if (selectedOptionOneIdForTop == ($(this).find('.selected_option1_id').text().trim())) {
                        $(this).parent().find('.real_price_option_text').empty().prepend(newSellPrice).css('word-break', 'break-all');
                    }
                })
                //sell실제금액(할인된금액)을 숫자상태로 주입한다.(판매갯수에 따라 바뀐다)
                $(this).parent().parent().find('.real_price_option_numberB').empty().prepend(newSellPrice).css('word-break', 'break-all');
                //sell실제금액(할인된금액)을 숫자상태로 주입한다.(판매갯수에 따라 바뀐다)////for Top routine                                           
                //selected_option1_id를 찾아 Top routine 에도 주입 시킨다.               
                $('.selectedOption_list').each(function () {
                    if (selectedOptionOneIdForTop == ($(this).find('.selected_option1_id').text().trim())) {
                        $(this).parent().find('.real_price_option_number').empty().prepend(newSellPrice).css('word-break', 'break-all');
                    }
                })
                ////총금액을 주입
                //총상품금액란에 number를 넣는다.
                $('.totalAmountNumber11B').empty().append(totalAmountSellPriceNew);
                //총상품금액란에 number를 넣는다.////for Top routine////
                $('.totalAmountNumber11').empty().append(totalAmountSellPriceNew);
                //총상품금액란에 편집된 내용을 넣는다.
                $('#totalAmount11_textB').empty().append(totalAmountSellPriceNew);
                //총상품금액란에 편집된 내용을 넣는다.//for Top routine////
                $('#totalAmount11_text').empty().append(totalAmountSellPriceNew);
                //총상품금액을 보여준다.
                $('.grand_real_sell_amount11B').show();
                //총상품금액을 보여준다.//for Top routine
                $('.grand_real_sell_amount11').show();

                //편집함수로 금액을 편집한다.
                $('.real_price_option_textB').each(function () {
                    txtValue = formatNumber($(this).text());
                    $(this).text(txtValue);
                });
                $('#totalAmount11_textB').each(function () {
                    txtValue = formatNumber($(this).text());
                    $(this).text(txtValue);
                });
                //편집함수로 금액을 편집한다.//for Top routine////
                $('.real_price_option_text').each(function () {
                    txtValue = formatNumber($(this).text());
                    $(this).text(txtValue);
                });                
                $('#totalAmount11_text').each(function () {
                    txtValue = formatNumber($(this).text());
                    $(this).text(txtValue);
                });
            });
        });

        ////옵션선택 리스트에서 "X"마크를 눌렀을때
        var currentTotalAmountNumber = 0;
        var currentSellPricexx = 0;
        var totalAmountSellPricexx = 0;
        var totalAmount_txt = 0;
        $('.xButtonB').unbind().click(function () { //***여기서는 반드시 unbind()를 사용해야함. 그렇지않을 경우 두번 루핑을 돈다*** 
            //현상태의 총상품금액
            currentTotalAmountNumber = parseFloat($('.totalAmountNumber11B').text().trim());
            //현 상태의 갯수만큼의 판매 금액
            currentSellPricexx = parseFloat($(this).parent().parent().find('.real_price_option_numberB').text().trim());
            //총상품금액에서 빠져나갈 금액을 뺀다(실제로 남아있을 총 금액)                
            totalAmountSellPricexx = parseFloat(currentTotalAmountNumber) - parseFloat(currentSellPricexx);
            ////총금액을 주입
            //총상품금액란에 number를 넣는다. //for B routine////
            $('.totalAmountNumber11B').empty().append(totalAmountSellPricexx);
            //총상품금액란에 number를 넣는다.//for Top routine////
            $('.totalAmountNumber11').empty().append(totalAmountSellPricexx);
            //총상품금액란에 편집된 내용을 넣는다.//for B routine////
            $('#totalAmount11_textB').empty().append(totalAmountSellPricexx);
            //총상품금액란에 편집된 내용을 넣는다.//for Top routine////
            $('#totalAmount11_text').empty().append(totalAmountSellPricexx);
            //총상품금액을 보여준다.//for Top routine////
            $('.grand_real_sell_amount11').show();

            //편집함수로 금액을 편집한다.//for B routine////           
            $('#totalAmount11_textB').each(function () {
                txtValue = formatNumber($(this).text());
                $(this).text(txtValue);
            });
            //편집함수로 금액을 편집한다.//for Top routine////         
            $('#totalAmount11_text').each(function () {
                txtValue = formatNumber($(this).text());
                $(this).text(txtValue);
            });

            //해당 정보를 삭제하고 선택된 상품이 하나도 없으면 총상춤금액란을 숨긴다.
            $(this).parent().parent().parent().parent().parent().remove();
            //for Top routine////
            //selected_option1_id를 찾아 Top에서도 remove 시킨다.
            selectedOptionOneIdForTop = $(this).parent().parent().parent().parent().parent().find('.selected_option1_idB').text().trim();
            $('.selectedOption_list').each(function () {
                if (selectedOptionOneIdForTop == ($(this).find('.selected_option1_id').text().trim())) {
                    $(this).find('.selected_option1_id').parent().parent().parent().remove();
                }
            })

            if (totalAmountSellPricexx == 0) {
                //아래 addOptionSw 변수를 한번도 사용 않해서 제거해야함.08/05/2019
                addOptionSw = false; //선택된 옵션 상품이 하나도 없으니 false로 만든다
                $('.grand_real_sell_amount11B').hide();//for B routine////
                //for Top routine////
                $('.grand_real_sell_amount11').hide();
            }
        });
    } //end of function buildingOptionList1B()
    ////end of B routine///////////////////////////////////////////////////////////////////
} //end of function optionCode1()

///////////////////////////////////////////////////////////////////////////////////////////
//////optionCode2//////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////////
function optionCode2() {
    //option code=2 일때(옵션선택box가 2개일때)실행되는 코드이다.21/04/2019
    $(function () {
        var existSW = false;   //옵션 상품이 이미 선택되었는지를 체크할때 사용한다. 선택되었으면 true가 된다.
        //아래 addOptionSw 변수를 한번도 사용 않해서 제거해야함.08/05/2019
        var addOptionSw = false; //옵션 상품을 하나라도 선택하였는지 체크할때 사용한다. 선택했으면 true.
        var option21_selected_sw = false; //옵션21이 선택되어지면 true로 바뀐다.    
        var select_option21_click_sw = false; //check 마크 up down toggle switch. 
        var option21_discription_member; //option21의 품목이름
        var option22_discription_member; //option22의 품목이름
        var option22_amout; //option22의 가감금액
        var sell_price; //실제판매매금액(세일이면 세일가격 아니면 원래가격)
        var real_price_option; //option 금액을 가감한 실 판매 금액(판매갯수에따라 바뀐다)
        var each_real_price_option; //option 금액을 가감한 실 판매 금액(1 개당 금액)
        var totalAmountSellPrice; //총 판매금액
        var option22_first_options_id; //선택되어진 두번째 옵션에 해당하는 첫번째 옵션 ID
        var second_option_id; //선택되어진 두번째 옵션 ID
        var option_product_id; //선택되어진 옵션에 해당하는 product ID

        //옵션21을 클릭하면(첫번째 option box) 옵션1 리스트를 보여준다.        
        $('.select_option21').click(function () {
            //옵션21(첫번째 option box)을 클릭 할때는 무조건 옵션22(두번째 box)를 숨긴다.
            $('.option_list22').hide();
            $('.chevron_up_option22').css('display', 'none'); //체크마크를 위 아래로 보여준다
            $('.chevron_down_option22').css('display', 'inline-block');

            if (!select_option21_click_sw) { //select_option21_click_sw가 false라면//check 마크 up down toggle switch.        
                $('.chevron_down_option21').css('display', 'none'); //체크마크를 위 아래로 보여준다
                $('.chevron_up_option21').css('display', 'inline-block');

                ////지우지 말 것.20/05/2019
                ////var height = $('.show_option21_list').height(); //박스의 탑으로 부터 바텀 까지의 길이를 구하여
                ////var realHeight = 0 - (height - 560);           //늘어나는 길이에 상관 없이 항상 박스 탑에 위치 시킨다. 650 580
                ////$('.option_list21').css('top', realHeight + 'px').css('left', '-15px')
                ////    .css('position', 'absolute').css('z-index', '2').show();
                ////select_option21_click_sw = true;//check 마크 up down toggle switch.

                $('.option_list21').css('left', '-15px')
                    .css('position', 'absolute').css('z-index', '2').show();
                select_option21_click_sw = true;//check 마크 up down toggle switch.
            }
            else {
                $('.chevron_up_option21').css('display', 'none'); //체크마크를 위 아래로 보여준다
                $('.chevron_down_option21').css('display', 'inline-block');
                select_option21_click_sw = false;//check 마크 up down toggle switch.
                $('.option_list21').hide();
            }
        });

        ////B routine//////////////////////////////////////////////////////////////////////
        //옵션21을 클릭하면(첫번째 option box) 옵션1 리스트를 보여준다.        
        $('.select_option21B').click(function () {
            //옵션21(첫번째 option box)을 클릭 할때는 무조건 옵션22(두번째 box)를 숨긴다.
            $('.option_list22B').hide();
            $('.chevron_up_option22B').css('display', 'none'); //체크마크를 위 아래로 보여준다
            $('.chevron_down_option22B').css('display', 'inline-block');

            if (!select_option21_click_sw) { //select_option21_click_sw가 false라면//check 마크 up down toggle switch.        
                $('.chevron_down_option21B').css('display', 'none'); //체크마크를 위 아래로 보여준다
                $('.chevron_up_option21B').css('display', 'inline-block');

                ////지우지 말 것.20/05/2019
                ////var height = $('.show_option21_list').height(); //박스의 탑으로 부터 바텀 까지의 길이를 구하여
                ////var realHeight = 0 - (height - 560);           //늘어나는 길이에 상관 없이 항상 박스 탑에 위치 시킨다. 650 580
                ////$('.option_list21').css('top', realHeight + 'px').css('left', '-15px')
                ////    .css('position', 'absolute').css('z-index', '2').show();
                ////select_option21_click_sw = true;//check 마크 up down toggle switch.

                $('.option_list21B').css('left', '-15px')
                    .css('position', 'absolute').css('z-index', '2').show();
                select_option21_click_sw = true;//check 마크 up down toggle switch.
            }
            else {
                $('.chevron_up_option21B').css('display', 'none'); //체크마크를 위 아래로 보여준다
                $('.chevron_down_option21B').css('display', 'inline-block');
                select_option21_click_sw = false;//check 마크 up down toggle switch.
                $('.option_list21B').hide();
            }
        });
        ////end of B routine///////////////////////////////////////////////////////////////

        //옵션21(첫번째 option box) 리스트가 펼쳐진 상태에서 원하는 상품 클릭하면 선택된 옵션이 사각box 안에 놓인다.     
        $('.productList_option21').each(function () {
            $(this).click(function () {
                var option21_first_options_id = $(this).find('.option21_first_options_id').text().trim(); //클릭된 옵션1의 id 를 save          
                option21_discription_member = $(this).find('.option02_01_description_member').text().trim();//품목명 save
                $('.option02_01_description').empty().append(option21_discription_member); //옵션1 box에 놓는다.
                $('.option02_01_descriptionB').empty().append(option21_discription_member); //옵션1 boxB에 놓는다.
                $('.chevron_up_option21').css('display', 'none');
                $('.chevron_down_option21').css('display', 'inline-block');
                select_option21_click_sw = false; //check 마크 up down toggle switch.           
                option21_selected_sw = true; //옵션21이 선택 되었으니 true로 바뀐다.           
                $('.option_list21').hide();

                //옵션21이 선택 되었으면 전 실행에서 숨어있을지 모를 모든 옵션22를 보이도록 한후에
                //아래에서 다시 옵션21에 해당하지 않는 품목은 숨긴다.           
                $('.productList_option22').each(function () {
                    $(this).children().show();
                })

                //선택되어진 옵션21에 해당하지 않는 옵션22의 품목을 찾아 숨긴다.
                $('.productList_option22').each(function () {
                    var option22_first_options_id = $(this).find('.option22_first_options_id').text().trim();
                    if (option21_first_options_id != option22_first_options_id) {
                        $(this).children().hide(); //옵션21에 해당하지 않는 품목은 숨긴다.                                      
                    }
                });
            });
        });

        ////B routine/////////////////////////////////////////////////////////////////////////
        //옵션21(첫번째 option box) 리스트가 펼쳐진 상태에서 원하는 상품 클릭하면 선택된 옵션이 사각box 안에 놓인다.     
        $('.productList_option21B').each(function () {
            $(this).click(function () {
                var option21_first_options_id = $(this).find('.option21_first_options_idB').text().trim(); //클릭된 옵션1의 id 를 save          
                option21_discription_member = $(this).find('.option02_01_description_memberB').text().trim();//품목명 save
                $('.option02_01_descriptionB').empty().append(option21_discription_member); //옵션1 boxB에 놓는다.
                $('.option02_01_description').empty().append(option21_discription_member); //옵션1 box에 놓는다.
                $('.chevron_up_option21B').css('display', 'none');
                $('.chevron_down_option21B').css('display', 'inline-block');
                select_option21_click_sw = false; //check 마크 up down toggle switch.           
                option21_selected_sw = true; //옵션21이 선택 되었으니 true로 바뀐다.           
                $('.option_list21B').hide();

                //옵션21이 선택 되었으면 전 실행에서 숨어있을지 모를 모든 옵션22를 보이도록 한후에
                //아래에서 다시 옵션21에 해당하지 않는 품목은 숨긴다.           
                $('.productList_option22B').each(function () {
                    $(this).children().show();
                })

                //선택되어진 옵션21에 해당하지 않는 옵션22의 품목을 찾아 숨긴다.
                $('.productList_option22B').each(function () {
                    var option22_first_options_id = $(this).find('.option22_first_options_idB').text().trim();
                    if (option21_first_options_id != option22_first_options_id) {
                        $(this).children().hide(); //옵션21에 해당하지 않는 품목은 숨긴다.                                      
                    }
                });
            });
        });
        ////end of B routine//////////////////////////////////////////////////////////////////

        //옵션21에서의 선택이 끝났으면 옵션22(두번째box)를 클릭하자!!!
        //옵션22을 클릭하면(두번째 option box) 위의 옵션1에 해당하는 품목 리스트가 보여진다. 
        var select_option22_click_sw = false;
        $('.select_option22').click(function () {
            if (option21_selected_sw) { //옵션1을 먼저 선택하고 옵션2를 선택해야한다
                if (!select_option22_click_sw) {
                    $('.chevron_down_option22').css('display', 'none'); //체크마크를 위 아래로 보여준다
                    $('.chevron_up_option22').css('display', 'inline-block');

                    var height = $('.show_option22_list').height(); //박스의 탑으로 부터 바텀 까지의 길이를 구하여
                    var realHeight = 0 - (height - 45);           //늘어나는 길이에 상관 없이 항상 박스 탑에 위치 시킨다. 650 580
                    $('.option_list22').css('top', realHeight + 'px').css('left', '-15px')
                        .css('position', 'absolute').css('z-index', '2').show();
                    select_option22_click_sw = true;
                }
                else {
                    $('.chevron_up_option22').css('display', 'none'); //체크마크를 위 아래로 보여준다
                    $('.chevron_down_option22').css('display', 'inline-block');
                    select_option22_click_sw = false;
                    $('.option_list22').hide();
                }
            } else {
                //alert("선택하신 옵션1이 없습니다..."); //check mark를 클릭시 세번의 alert가 나와 stop.
            }
        });

        ////B routine///////////////////////////////////////////////////////////////////////////
        //옵션21에서의 선택이 끝났으면 옵션22(두번째box)를 클릭하자!!!
        //옵션22을 클릭하면(두번째 option box) 위의 옵션1에 해당하는 품목 리스트가 보여진다. 
        var select_option22_click_sw = false;
        $('.select_option22B').click(function () {
            if (option21_selected_sw) { //옵션1을 먼저 선택하고 옵션2를 선택해야한다
                if (!select_option22_click_sw) {
                    $('.chevron_down_option22B').css('display', 'none'); //체크마크를 위 아래로 보여준다
                    $('.chevron_up_option22B').css('display', 'inline-block');

                    var height = $('.show_option22_listB').height(); //박스의 탑으로 부터 바텀 까지의 길이를 구하여
                    var realHeight = 0 - (height - 45);           //늘어나는 길이에 상관 없이 항상 박스 탑에 위치 시킨다. 650 580
                    $('.option_list22B').css('top', realHeight + 'px').css('left', '-15px')
                        .css('position', 'absolute').css('z-index', '2').show();
                    select_option22_click_sw = true;
                }
                else {
                    $('.chevron_up_option22B').css('display', 'none'); //체크마크를 위 아래로 보여준다
                    $('.chevron_down_option22B').css('display', 'inline-block');
                    select_option22_click_sw = false;
                    $('.option_list22B').hide();
                }
            } else {
                //alert("선택하신 옵션1이 없습니다..."); //check mark를 클릭시 세번의 alert가 나와 stop.
            }
        });
        ////end of B routine//////////////////////////////////////////////////////////////////

        //옵션22 리스트가 펼쳐진 상태에서 원하는 상품 클릭하면...
        $('.productList_option22').each(function () {
            $(this).click(function () {
                $('.chevron_up_option22').css('display', 'none'); //check 표시 up-down
                $('.chevron_down_option22').css('display', 'inline-block');
                select_option22_click_sw = false;
                $('.option_list22').hide(); //option2의 리스트를 숨긴다
                $('.option02_01_description').empty().append("옵션명21"); //옵션21 box를 initializing한다.
                $('.option02_01_descriptionB').empty().append("옵션명21"); //옵션21 boxB를 initializing한다.
                option21_selected_sw = false;

                //현재 선택된 option1 ID
                option22_first_options_id = $(this).find('.option22_first_options_id').text().trim();//option1 ID
                //현재 선택된 option2 ID
                second_option_id = $(this).find('.second_option_id').text().trim();//option2 ID
                //현재 선택된 product ID
                ////$(this).find = $(this).find('.option_product_id').text().trim();//product ID

                //옵션상품을 클릭시 이미 선택하였나 체크한다.
                //$('.selectedOption_list').each(function () {
                $('.selectedOption_row').each(function () {
                    //이미 선택된 option1 ID
                    var existOption1Id = $(this).find('.selected_option1_id').text().trim();
                    //이미 선택된 option2 ID
                    var existOption2Id = $(this).find('.selected_option2_id').text().trim();
                    //이미 선택된 product ID
                    ////var existPorductId = $(this).find('.selected_option_productId').text().trim();

                    if (existOption1Id == option22_first_options_id && existOption2Id == second_option_id) {
                        existSW = true;
                        return false;     //단지 each loop만 빠져나가고 뒤에 코드는 수행된다...
                    }
                });
                if (existSW == true)  //선택되었다면 뒤에 코드는 실행하지 않는다.
                {
                    alert("이미 선택하셨습니다...");
                    $('.option_list22').hide(); //option2의 리스트를 숨긴다
                    //$('.selectedOption_list').show();   //기존 선택된 상품들을 보여준다
                    $('.selectedOption_row').show();   //기존 선택된 상품들을 보여준다  
                    existSW = false;   //다시 false로 바꾸어 놓는다...
                    return false;
                }

                //////////각종 금액, 옵션22 상품 이름을 구하는 루틴////////                
                option22_discription_member = $(this).find('.option02_02_description_member').text().trim();//option2 품목명
                option22_amount = $(this).find('.option22_amount').text().trim(); //option 가감액 
                option22_stock = $(this).find('.option22_stock').text().trim(); //option 재고 
                sell_price = parseFloat($('.sellPriceAjax').text().trim()); //실판매금액(디스카운트 된 금액)
                real_price_option = sell_price + parseFloat(option22_amount); //옴션을 가감한 금액.(갯수에 따라 바뀐다.)    
                each_real_price_option = sell_price + parseFloat(option22_amount); //옴션을 가감한 금액.(1 개당금액.)

                //총 판매금액을 구한다.                
                totalAmountSellPrice = 0;
                var totalIndex = $('.selectedOption_row').length; //선택된 옵션 상품이 몇개인지 체크해서                         
                if (totalIndex > 0) { //한개 이상이면 현재 보여지는(실제는 숨겨져있다) 총상품금액을 가져온다.
                    totalAmountSellPrice = parseFloat($('.totalAmountNumber22').text().trim()); //현상태의 총상품금액(숫자로 바꾸었음)                    
                    //alert("1.totalAmountSellPrice " + totalAmountSellPrice);//////////////
                }
                //총상품금액을 구한다
                totalAmountSellPrice = totalAmountSellPrice + real_price_option;

                //최종 선택 되어진 옵션에따라 판매 리스트를 만든다.
                //판매리스트를 수정 삭제, 장바구니,바로구매등이 이루어진다...
                buildingOptionList2();
                ////for B routine////
                buildingOptionList2B();
            });
        });

        ////B routine//////////////////////////////////////////////////////////////////////////
        //옵션22 리스트가 펼쳐진 상태에서 원하는 상품 클릭하면...
        $('.productList_option22B').each(function () {
            $(this).click(function () {
                $('.chevron_up_option22B').css('display', 'none'); //check 표시 up-down
                $('.chevron_down_option22B').css('display', 'inline-block');
                select_option22_click_sw = false;
                $('.option_list22B').hide(); //option2의 리스트를 숨긴다
                $('.option02_01_descriptionB').empty().append("옵션명21"); //옵션21 boxB를 initializing한다.
                $('.option02_01_description').empty().append("옵션명21"); //옵션21 box를 initializing한다.
                option21_selected_sw = false;

                //현재 선택된 option1 ID
                option22_first_options_id = $(this).find('.option22_first_options_idB').text().trim();//option1 ID
                //현재 선택된 option2 ID
                second_option_id = $(this).find('.second_option_idB').text().trim();//option2 ID
                //현재 선택된 product ID
                ////$(this).find = $(this).find('.option_product_id').text().trim();//product ID

                //옵션상품을 클릭시 이미 선택하였나 체크한다.
                //$('.selectedOption_list').each(function () {
                $('.selectedOption_rowB').each(function () {
                    //이미 선택된 option1 ID
                    var existOption1Id = $(this).find('.selected_option1_idB').text().trim();
                    //이미 선택된 option2 ID
                    var existOption2Id = $(this).find('.selected_option2_idB').text().trim();
                    //이미 선택된 product ID
                    ////var existPorductId = $(this).find('.selected_option_productId').text().trim();

                    if (existOption1Id == option22_first_options_id && existOption2Id == second_option_id) {
                        existSW = true;
                        return false;     //단지 each loop만 빠져나가고 뒤에 코드는 수행된다...
                    }
                });
                if (existSW == true)  //선택되었다면 뒤에 코드는 실행하지 않는다.
                {
                    alert("이미 선택하셨습니다...");
                    $('.option_list22B').hide(); //option2의 리스트를 숨긴다
                    //$('.selectedOption_list').show();   //기존 선택된 상품들을 보여준다
                    $('.selectedOption_rowB').show();   //기존 선택된 상품들을 보여준다  
                    existSW = false;   //다시 false로 바꾸어 놓는다...
                    return false;
                }

                //////////각종 금액, 옵션22 상품 이름을 구하는 루틴////////                
                option22_discription_member = $(this).find('.option02_02_description_memberB').text().trim();//option2 품목명
                option22_amount = $(this).find('.option22_amountB').text().trim(); //option 가감액 
                option22_stock = $(this).find('.option22_stockB').text().trim(); //option 재고
                ////아래 ==>"sellPriceAjaxB" 하면 error... "sellPriceAjax" 사용할것
                sell_price = parseFloat($('.sellPriceAjax').text().trim()); //실판매금액(디스카운트 된 금액)
                real_price_option = sell_price + parseFloat(option22_amount); //옴션을 가감한 금액.(갯수에 따라 바뀐다.)    
                each_real_price_option = sell_price + parseFloat(option22_amount); //옴션을 가감한 금액.(1 개당금액.)

                //총 판매금액을 구한다.                
                totalAmountSellPrice = 0;
                var totalIndex = $('.selectedOption_rowB').length; //선택된 옵션 상품이 몇개인지 체크해서                         
                if (totalIndex > 0) { //한개 이상이면 현재 보여지는(실제는 숨겨져있다) 총상품금액을 가져온다.
                    totalAmountSellPrice = parseFloat($('.totalAmountNumber22B').text().trim()); //현상태의 총상품금액(숫자로 바꾸었음)                    
                    //alert("1.totalAmountSellPrice " + totalAmountSellPrice);//////////////
                }
                //총상품금액을 구한다
                totalAmountSellPrice = totalAmountSellPrice + real_price_option;

                //최종 선택 되어진 옵션에따라 판매 리스트를 만든다.
                //판매리스트를 수정 삭제, 장바구니,바로구매등이 이루어진다...
                buildingOptionList2();
                ////for B routine
                buildingOptionList2B();
            });
        });
        ////end of B routine///////////////////////////////////////////////////////////////////

        ////최종 선택 되어진 옵션에따라 판매 리스트를 만든다.
        ////맨먼저 내용이 들어갈 공간을 만든다.그리고 그곳에 필요한 데이터를 넣고 갯수 수정 삭제등을 한다
        ////장바구니,바로구매등이 이루어진다...
        function buildingOptionList2() {
            $('.attach_option_list22').append(
                '<div class="selectedOption_row"style="border: 1px solid rgba(128, 128, 128, 0.10); background-color: rgba(128, 128, 128, 0.1); min-height: 50px; line-height: 50px; padding-left: 15px; margin-right: 0px; margin-top: 5px;">' +
                    '<div class="row selectedOption_list">' + //selectedOption_list
                        '<div class="col-sm-12 col-md-12 col-lg-12">' +
                            '<span class="selected_option_productId" style="display: none;"> </span>' + //product ID
                            '<span class="selected_option1_description"> </span>' + //옵션1 품목네임
                            '<span class="selected_option1_id" style="display:none;"> </span>' + //옵션1 품목 id
                            '<span> + </span>' + //+
                            '<span class="selected_option2_description"></span>' + //옵션2 품목네임
                            '<span>(</span>' + //(
                            '<span class="plus_sign" style="display:none;">+</span>' + //+ 표시
                            '<span class="selected_option2_amount_text"></span>' + //옵션2 편집된 가감가격
                            '<span>원)-재고</span>' + //원) - 재고
                            '<span class="selected_option2_stock_text"></span>' + //옵션2 편집된 재고
                            '<span>개</span>' + //개
                            '<span class="selected_option2_id" style="display:none;"> </span>' + //옵션2 품목 id
                            '<span class="real_price_option_number" style="display:none;"> </span>' + //갯수에 의한 실제판매금액(숫자)
                            '<span class="each_real_price_option_number" style="display:none;"> </span>' + //개당실제판매금액(숫자)
                        '</div>' +
                    '</div>' + //////////////
                    '<div class="row">' + //selectedOption_list class removed here...
                        '<div class="col-sm-12 col-md-12 col-lg-12">' +
                            '<div style="border-top: 1px solid rgba(128, 128, 128, 0.10); margin-right: 0px; margin-left: -15px;">' +
                                '<div class="col-sm-3 col-md-3 col-lg-3">' + //spinner style
                                    '<span class="spinner" style="height: 40px; line-height: 40px;"></span>' + //spinner
                                '</div>' +
                                '<div class="col-sm-8 col-md-8 col-lg-8" style="text-align: right; font-size: 20px;">' +
                                    '<span class="real_price_option_text"> </span>원' + //편집된 실제 판매 금액                                  
                                    '<span class="real_price_option_number" style="display:none;"> </span>' + //갯수에 의한 실제판매금액(숫자)
                                    '<span class="each_real_price_option_number" style="display:none;"> </span>' + //개당실제판매금액(숫자)
                                '</div>' + //취소X버튼
                                '<div class="col-sm-1 col-md-1 col-lg-1" style="text-align: right; font-size: 20px;">' + //취소X버튼
                                    '<a href="javascript:void(0)" return false;" class="xButton" style="font-size: 20px; opacity: 0.5;"> X</a>' +
                                '</div>' +
                            '</div>' +
                        '</div>' + ///////////
                    '</div>' +
                '</div>'
                );

            ////위에서 만들어진 레이어 안에 해당 사항을 넣는다
            //option1의 품목명을 넣는다.
            $('.selected_option1_description').last().prepend(option21_discription_member).css('word-break', 'break-all');
            //option2의 품목명을 넣는다.
            $('.selected_option2_description').last().prepend(option22_discription_member).css('word-break', 'break-all');
            //product ID
            $('.selected_option_productId').last().prepend(option_product_id);
            //option1 ID
            $('.selected_option1_id').last().prepend(option22_first_options_id);
            //option2 ID
            $('.selected_option2_id').last().prepend(second_option_id);
            //option 2 amount
            $('.selected_option2_amount_text').last().prepend(option22_amount);
            if (option22_amount > 0) {
                $('.plus_sign').show();
            }
            //option 2 stock
            $('.selected_option2_stock_text').last().prepend(option22_stock);
            //jquery-ui spinner를 추가
            $('.spinner').last().append('<input class="orderQty" name="orderQty"  value="1" readonly style="width: 20px; height: 15px;"/>' + '&nbsp;개 &nbsp;');  //갯수 박스 spinner
            //아래 $m에 주의 할 것($m = jQuery.noConflict();을 선언 했음)
            $m('.orderQty').spinner({ //갯수 박스에 대한 스피너 UI를 선언한다.(반드시 현 위치 해야 한다...)
                min: 1,
                max: 20,
                step: 1
            });
            //sell실제금액(할인된금액)을 편집하여 주입한다.
            $('.real_price_option_text').last().prepend(real_price_option).css('word-break', 'break-all');
            //sell실제금액(할인된금액)을 숫자상태로 주입한다.(판매갯수에 따라 바뀐다)
            $('.real_price_option_number').last().prepend(real_price_option).css('word-break', 'break-all');
            //sell실제금액(할인된금액)을 숫자상태로 주입한다.(1 개당 금액)
            $('.each_real_price_option_number').last().prepend(each_real_price_option).css('word-break', 'break-all');
            ////총금액을 주입
            $('.totalAmountNumber22').empty().append(totalAmountSellPrice); //총상품금액란에 number를 넣는다.
            $('#totalAmount22_text').empty().append(totalAmountSellPrice);  //총상품금액란에 편집된 내용을 넣는다.
            $('.grand_real_sell_amount22').show(); //총상품금액을 보여준다.

            //옵션 상품을 선택 했으니 true로 만든다.
            addOptionSw = true; //addOptionSw 변수를 한번도 사용 않해서 제거해야함.08/05/2019

            //편집함수로 금액을 편집한다.                        
            $('.real_price_option_text').each(function () {
                txtValue = formatNumber($(this).text());
                $(this).text(txtValue);
            });
            $('#totalAmount22_text').each(function () {
                txtValue = formatNumber($(this).text());
                $(this).text(txtValue);
            });
            $('.selected_option2_amount_text').each(function () {
                txtValue = formatNumber($(this).text());
                $(this).text(txtValue);
            });
            $('.selected_option2_stock_text').each(function () {
                txtValue = formatNumber($(this).text());
                $(this).text(txtValue);
            });

            //갯수 조정 박스를 눌렀을때...//spinner value(선택한개수)
            $('.spinner').each(function () {     //function(i)처럼 "i"를 사용하면 중간에 remove된 경우에는 문제가 생겨
                $(this).unbind().click(function () {    //***여기서는 반드시 unbind()를 사용해야함. 그렇지않을 경우 루핑을 돈다***
                    //현재의 실제 판매금액을 save(spinner적용 전 상태의)
                    var currentSellPrice = parseFloat($(this).parent().parent().find('.real_price_option_number').text().trim());
                    //현상태의 총상품금액 save(spinner적용 전 상태의)
                    var currentTotalAmountNumber = parseFloat($('.totalAmountNumber22').text().trim());
                    //현상태의 총상품금액에서 숫자갯수만큼의 sellPrice를 빼준다(spinner적용 전 상태의)
                    var totalAmountSellPriceTemp = currentTotalAmountNumber - currentSellPrice;

                    //alert($(this).children().html());//이렇게 alert로 확인 한 다음 아래처럼 찾으면 된다.23/04/2019
                    //변경된 갯수를 찾는다(spinner에서)
                    var qty = parseFloat($(this).find('input').attr("aria-valuenow")); //integer
                    //변경된 option2_id를 찾는다(spinner에서)//for B routine////
                    selectedOptionTwoIdForB = $(this).parent().parent().parent().parent().parent().find('.selected_option2_id').text().trim();
                    //selected_option2_id를 찾아 B routine 에도 주입 시킨다.               
                    $('.selectedOption_listB').each(function () {
                        if (selectedOptionTwoIdForB == ($(this).find('.selected_option2_idB').text().trim())) {
                            $(this).find('.selected_option2_idB').parent().parent().parent().find('input[aria-valuenow]').val(qty);
                        }
                    })
                    ////$('.spinnerB').find('input[aria-valuenow]').val(qty);////중요한 예제...
                    //개당 실제판매 금액 
                    var each_real_price_option_number = parseFloat($(this).parent().parent().find('.each_real_price_option_number').text().trim());
                    //새로 선택한 갯수에 숫자 한개당 sellPrice를 곱한다(새로운 판매 금액)
                    var newSellPrice = qty * each_real_price_option_number;
                    //새로운 총상품금액을 구한다
                    var totalAmountSellPriceNew = totalAmountSellPriceTemp + newSellPrice;

                    //sell실제금액(할인된금액)을 편집하여 주입한다.
                    $(this).parent().parent().find('.real_price_option_text').empty().prepend(newSellPrice).css('word-break', 'break-all');
                    //sell실제금액(할인된금액)을 편집하여 주입한다.////for B routine               
                    //selected_option2_id를 찾아 B routine 에도 주입 시킨다.               
                    $('.selectedOption_listB').each(function () {
                        if (selectedOptionTwoIdForB == ($(this).find('.selected_option2_idB').text().trim())) {
                            $(this).parent().find('.real_price_option_textB').empty().prepend(newSellPrice).css('word-break', 'break-all');
                        }
                    })
                    //sell실제금액(할인된금액)을 숫자상태로 주입한다.(판매갯수에 따라 바뀐다)
                    $(this).parent().parent().find('.real_price_option_number').empty().prepend(newSellPrice).css('word-break', 'break-all');
                    //sell실제금액(할인된금액)을 숫자상태로 주입한다.(판매갯수에 따라 바뀐다)////for B routine                                           
                    //selected_option2_id를 찾아 B routine 에도 주입 시킨다.               
                    $('.selectedOption_listB').each(function () {
                        if (selectedOptionTwoIdForB == ($(this).find('.selected_option2_idB').text().trim())) {
                            $(this).parent().find('.real_price_option_numberB').empty().prepend(newSellPrice).css('word-break', 'break-all');
                        }
                    })
                    ////총금액을 주입
                    //총상품금액란에 number를 넣는다.
                    $('.totalAmountNumber22').empty().append(totalAmountSellPriceNew);
                    //총상품금액란에 number를 넣는다.////for B routine////
                    $('.totalAmountNumber22B').empty().append(totalAmountSellPriceNew);
                    //총상품금액란에 편집된 내용을 넣는다.
                    $('#totalAmount22_text').empty().append(totalAmountSellPriceNew);
                    //총상품금액란에 편집된 내용을 넣는다.//for B routine////
                    $('#totalAmount22_textB').empty().append(totalAmountSellPriceNew);
                    //총상품금액을 보여준다.
                    $('.grand_real_sell_amount22').show();
                    //총상품금액을 보여준다.//for B routine
                    $('.grand_real_sell_amount22B').show();

                    //편집함수로 금액을 편집한다.
                    $('.real_price_option_text').each(function () {
                        txtValue = formatNumber($(this).text());
                        $(this).text(txtValue);
                    });
                    $('#totalAmount22_text').each(function () {
                        txtValue = formatNumber($(this).text());
                        $(this).text(txtValue);
                    });
                    //편집함수로 금액을 편집한다.//for B routine////
                    $('.real_price_option_textB').each(function () {
                        txtValue = formatNumber($(this).text());
                        $(this).text(txtValue);
                    });
                    $('#totalAmount22_textB').each(function () {
                        txtValue = formatNumber($(this).text());
                        $(this).text(txtValue);
                    });
                });
            });

            ////옵션선택 리스트에서 "X"마크를 눌렀을때
            var currentTotalAmountNumber = 0;
            var currentSellPricexx = 0;
            var totalAmountSellPricexx = 0;
            var totalAmount_txt = 0;
            $('.xButton').unbind().click(function () { //***여기서는 반드시 unbind()를 사용해야함. 그렇지않을 경우 두번 루핑을 돈다*** 
                //현상태의 총상품금액
                currentTotalAmountNumber = parseFloat($('.totalAmountNumber22').text().trim());
                //현 상태의 갯수만큼의 판매 금액
                currentSellPricexx = parseFloat($(this).parent().parent().find('.real_price_option_number').text().trim());
                //총상품금액에서 빠져나갈 금액을 뺀다(실제로 남아있을 총 금액)                
                totalAmountSellPricexx = parseFloat(currentTotalAmountNumber) - parseFloat(currentSellPricexx);
                ////총금액을 주입
                //총상품금액란에 number를 넣는다.
                $('.totalAmountNumber22').empty().append(totalAmountSellPricexx);
                //총상품금액란에 number를 넣는다.//for B routine////
                $('.totalAmountNumber22B').empty().append(totalAmountSellPricexx);
                //총상품금액란에 편집된 내용을 넣는다.
                $('#totalAmount22_text').empty().append(totalAmountSellPricexx);
                //총상품금액란에 편집된 내용을 넣는다.//for B routine////
                $('#totalAmount22_textB').empty().append(totalAmountSellPricexx);
                //총상품금액을 보여준다.//for B routine////
                $('.grand_real_sell_amount22B').show(); 

                //편집함수로 금액을 편집한다.           
                $('#totalAmount22_text').each(function () {
                    txtValue = formatNumber($(this).text());
                    $(this).text(txtValue);
                });
                //편집함수로 금액을 편집한다.//for B routine////         
                $('#totalAmount22_textB').each(function () {
                    txtValue = formatNumber($(this).text());
                    $(this).text(txtValue);
                });

                //해당 정보를 삭제하고 선택된 상품이 하나도 없으면 총상춤금액란을 숨긴다.
                $(this).parent().parent().parent().parent().parent().remove();
                //for B routine////
                //selected_option2_id를 찾아 B에서도 remove 시킨다.
                selectedOptionTwoIdForB = $(this).parent().parent().parent().parent().parent().find('.selected_option2_id').text().trim();
                $('.selectedOption_listB').each(function () {
                    if (selectedOptionTwoIdForB == ($(this).find('.selected_option2_idB').text().trim())) {
                        $(this).find('.selected_option2_idB').parent().parent().parent().remove();
                    }
                })

                if (totalAmountSellPricexx == 0) {
                    //아래 addOptionSw 변수를 한번도 사용 않해서 제거해야함.08/05/2019
                    addOptionSw = false; //선택된 옵션 상품이 하나도 없으니 false로 만든다
                    $('.grand_real_sell_amount22').hide();
                    //for B routine////
                    $('.grand_real_sell_amount22B').hide();
                }
            });
        }//end of function buildingOptionList2()

        ////B routine///////////////////////////////////////////////////////////////////////////
        ////최종 선택 되어진 옵션에따라 판매 리스트를 만든다.
        ////맨먼저 내용이 들어갈 공간을 만든다.그리고 그곳에 필요한 데이터를 넣고 갯수 수정 삭제등을 한다
        ////장바구니,바로구매등이 이루어진다...
        function buildingOptionList2B() {
            $('.attach_option_list22B').append(
                '<div class="selectedOption_rowB"style="border: 1px solid rgba(128, 128, 128, 0.10); background-color: rgba(128, 128, 128, 0.1); min-height: 25px; line-height: 25px; padding-left: 15px; margin-right: 0px; margin-top: 5px;">' +
                    '<div class="row selectedOption_listB">' + //selectedOption_list
                        '<div class="col-sm-12 col-md-12 col-lg-12">' +
                            '<span class="selected_option_productIdB" style="display: none;"> </span>' + //product ID
                            '<span class="selected_option1_descriptionB"> </span>' + //옵션1 품목네임
                            '<span class="selected_option1_idB" style="display:none;"> </span>' + //옵션1 품목 id
                            '<span> + </span>' + //+
                            '<span class="selected_option2_descriptionB"></span>' + //옵션2 품목네임
                            '<span>(</span>' + //(
                            '<span class="plus_signB" style="display:none;">+</span>' + //+ 표시
                            '<span class="selected_option2_amount_textB"></span>' + //옵션2 편집된 가감가격
                            '<span>원)-재고</span>' + //원) - 재고
                            '<span class="selected_option2_stock_textB"></span>' + //옵션2 편집된 재고
                            '<span>개</span>' + //개
                            '<span class="selected_option2_idB" style="display:none;"> </span>' + //옵션2 품목 id
                            '<span class="real_price_option_numberB" style="display:none;"> </span>' + //갯수에 의한 실제판매금액(숫자)
                            '<span class="each_real_price_option_numberB" style="display:none;"> </span>' + //개당실제판매금액(숫자)
                        '</div>' +
                    '</div>' + //////////////
                    '<div class="row">' + //selectedOption_list class removed here...
                        '<div class="col-sm-12 col-md-12 col-lg-12">' +
                            '<div style="border-top: 1px solid rgba(128, 128, 128, 0.10); margin-right: 0px; margin-left: -15px;">' +
                                '<div class="col-sm-4 col-md-4 col-lg-4">' + //spinner style
                                    '<span class="spinnerB" style="height: 30px; line-height: 30px;"></span>' + //spinner
                                '</div>' +
                                '<div class="col-sm-6 col-md-6 col-lg-6" style="text-align: right; font-size: 15px;">' +
                                    '<span class="real_price_option_textB"> </span>원' + //편집된 실제 판매 금액 
                                    '<span class="real_price_option_numberB" style="display:none;"> </span>' + //갯수에 의한 실제판매금액(숫자)
                                    '<span class="each_real_price_option_numberB" style="display:none;"> </span>' + //개당실제판매금액(숫자)
                                '</div>' + //취소X버튼
                                '<div class="col-sm-2 col-md-2 col-lg-2" style="text-align: right; font-size: 15px;">' + //취소X버튼
                                    '<a href="javascript:void(0)" return false;" class="xButtonB" style="font-size: 15px; opacity: 0.5;"> X</a>' +
                                '</div>' +
                            '</div>' +
                        '</div>' + ///////////
                    '</div>' +
                '</div>'
                );

            ////위에서 만들어진 레이어 안에 해당 사항을 넣는다
            //option1의 품목명을 넣는다.
            $('.selected_option1_descriptionB').last().prepend(option21_discription_member).css('word-break', 'break-all');
            //option2의 품목명을 넣는다.
            $('.selected_option2_descriptionB').last().prepend(option22_discription_member).css('word-break', 'break-all');
            //product ID
            $('.selected_option_productIdB').last().prepend(option_product_id);
            //option1 ID
            $('.selected_option1_idB').last().prepend(option22_first_options_id);
            //option2 ID
            $('.selected_option2_idB').last().prepend(second_option_id);
            //option 2 amount
            $('.selected_option2_amount_textB').last().prepend(option22_amount);
            if (option22_amount > 0) {
                $('.plus_signB').show();
            }
            //option 2 stock
            $('.selected_option2_stock_textB').last().prepend(option22_stock);
            //jquery-ui spinner를 추가
            $('.spinnerB').last().append('<input class="orderQtyB" name="orderQty"  value="1" readonly style="width: 20px; height: 15px;"/>' + '&nbsp;개 &nbsp;');  //갯수 박스 spinner
            //아래 $m에 주의 할 것($m = jQuery.noConflict();을 선언 했음)
            $m('.orderQtyB').spinner({ //갯수 박스에 대한 스피너 UI를 선언한다.(반드시 현 위치 해야 한다...)
                min: 1,
                max: 20,
                step: 1
            });
            //sell실제금액(할인된금액)을 편집하여 주입한다.
            //alert("***==>   " + real_price_option);
            $('.real_price_option_textB').last().prepend(real_price_option).css('word-break', 'break-all');
            //sell실제금액(할인된금액)을 숫자상태로 주입한다.(판매갯수에 따라 바뀐다)
            $('.real_price_option_numberB').last().prepend(real_price_option).css('word-break', 'break-all');
            //sell실제금액(할인된금액)을 숫자상태로 주입한다.(1 개당 금액)
            $('.each_real_price_option_numberB').last().prepend(each_real_price_option).css('word-break', 'break-all');
            ////총금액을 주입
            $('.totalAmountNumber22B').empty().append(totalAmountSellPrice); //총상품금액란에 number를 넣는다.
            $('#totalAmount22_textB').empty().append(totalAmountSellPrice);  //총상품금액란에 편집된 내용을 넣는다.
            $('.grand_real_sell_amount22B').show(); //총상품금액을 보여준다.

            //옵션 상품을 선택 했으니 true로 만든다.
            addOptionSw = true; //addOptionSw 변수를 한번도 사용 않해서 제거해야함.08/05/2019

            //편집함수로 금액을 편집한다.                                    
            ////for B routin                              
            $('.real_price_option_textB').each(function () {
                txtValue = formatNumber($(this).text());
                $(this).text(txtValue);
            });
            $('#totalAmount22_textB').each(function () {
                txtValue = formatNumber($(this).text());
                $(this).text(txtValue);
            });
            $('.selected_option2_amount_textB').each(function () {
                txtValue = formatNumber($(this).text());
                $(this).text(txtValue);
            });
            $('.selected_option2_stock_textB').each(function () {
                txtValue = formatNumber($(this).text());
                $(this).text(txtValue);
            });

            //갯수 조정 박스를 눌렀을때...//spinner value(선택한개수)
            $('.spinnerB').each(function () {     //function(i)처럼 "i"를 사용하면 중간에 remove된 경우에는 문제가 생겨
                $(this).unbind().click(function () {    //***여기서는 반드시 unbind()를 사용해야함. 그렇지않을 경우 루핑을 돈다***
                    //현재의 실제 판매금액을 save(spinner적용 전 상태의)
                    var currentSellPrice = parseFloat($(this).parent().parent().find('.real_price_option_numberB').text().trim());
                    //현상태의 총상품금액 save(spinner적용 전 상태의)
                    var currentTotalAmountNumber = parseFloat($('.totalAmountNumber22B').text().trim());
                    //현상태의 총상품금액에서 숫자갯수만큼의 sellPrice를 빼준다(spinner적용 전 상태의)
                    var totalAmountSellPriceTemp = currentTotalAmountNumber - currentSellPrice;

                    //alert($(this).children().html());//이렇게 alert로 확인 한 다음 아래처럼 찾으면 된다.23/04/2019
                    //변경된 갯수를 찾는다(spinner에서)
                    var qty = parseFloat($(this).find('input').attr("aria-valuenow")); //integer
                    //변경된 option2_id를 찾는다(spinner에서)//for Top routine////
                    selectedOptionTwoIdForTop = $(this).parent().parent().parent().parent().parent().find('.selected_option2_idB').text().trim();
                    //selected_option1_id를 찾아 Top routine 에도 주입 시킨다.               
                    $('.selectedOption_list').each(function () {
                        if (selectedOptionTwoIdForTop == ($(this).find('.selected_option2_id').text().trim())) {
                            $(this).find('.selected_option2_id').parent().parent().parent().find('input[aria-valuenow]').val(qty);
                        }
                    })
                    //개당 실제판매 금액 
                    var each_real_price_option_number = parseFloat($(this).parent().parent().find('.each_real_price_option_numberB').text().trim());
                    //새로 선택한 갯수에 숫자 한개당 sellPrice를 곱한다(새로운 판매 금액)
                    var newSellPrice = qty * each_real_price_option_number;
                    //새로운 총상품금액을 구한다
                    var totalAmountSellPriceNew = totalAmountSellPriceTemp + newSellPrice;

                    //sell실제금액(할인된금액)을 편집하여 주입한다.
                    $(this).parent().parent().find('.real_price_option_textB').empty().prepend(newSellPrice).css('word-break', 'break-all');
                    //sell실제금액(할인된금액)을 편집하여 주입한다.////for Top routine               
                    //selected_option2_id를 찾아 Top routine 에도 주입 시킨다.               
                    $('.selectedOption_list').each(function () {
                        if (selectedOptionTwoIdForTop == ($(this).find('.selected_option2_id').text().trim())) {
                            $(this).parent().find('.real_price_option_text').empty().prepend(newSellPrice).css('word-break', 'break-all');
                        }
                    })
                    //sell실제금액(할인된금액)을 숫자상태로 주입한다.(판매갯수에 따라 바뀐다)
                    $(this).parent().parent().find('.real_price_option_numberB').empty().prepend(newSellPrice).css('word-break', 'break-all');
                    //sell실제금액(할인된금액)을 숫자상태로 주입한다.(판매갯수에 따라 바뀐다)////for Top routine                                           
                    //selected_option2_id를 찾아 Top routine 에도 주입 시킨다.               
                    $('.selectedOption_list').each(function () {
                        if (selectedOptionTwoIdForTop == ($(this).find('.selected_option2_id').text().trim())) {
                            $(this).parent().find('.real_price_option_number').empty().prepend(newSellPrice).css('word-break', 'break-all');
                        }
                    })
                    ////총금액을 주입
                    //총상품금액란에 number를 넣는다.
                    $('.totalAmountNumber22B').empty().append(totalAmountSellPriceNew);
                    //총상품금액란에 number를 넣는다.////for Top routine////
                    $('.totalAmountNumber22').empty().append(totalAmountSellPriceNew);
                    //총상품금액란에 편집된 내용을 넣는다.
                    $('#totalAmount22_textB').empty().append(totalAmountSellPriceNew);
                    //총상품금액란에 편집된 내용을 넣는다.//for Top routine////
                    $('#totalAmount22_text').empty().append(totalAmountSellPriceNew);
                    //총상품금액을 보여준다.
                    $('.grand_real_sell_amount22B').show(); 
                    //총상품금액을 보여준다.//for Top routine
                    $('.grand_real_sell_amount22').show();

                    //편집함수로 금액을 편집한다.
                    $('.real_price_option_textB').each(function () {
                        txtValue = formatNumber($(this).text());
                        $(this).text(txtValue);
                    });
                    $('#totalAmount22_textB').each(function () {
                        txtValue = formatNumber($(this).text());
                        $(this).text(txtValue);
                    });
                    //편집함수로 금액을 편집한다.//for Top routine////
                    $('.real_price_option_text').each(function () {
                        txtValue = formatNumber($(this).text());
                        $(this).text(txtValue);
                    });
                    $('#totalAmount22_text').each(function () {
                        txtValue = formatNumber($(this).text());
                        $(this).text(txtValue);
                    });
                });
            });

            ////옵션선택 리스트에서 "X"마크를 눌렀을때
            var currentTotalAmountNumber = 0;
            var currentSellPricexx = 0;
            var totalAmountSellPricexx = 0;
            var totalAmount_txt = 0;
            $('.xButtonB').unbind().click(function () { //***여기서는 반드시 unbind()를 사용해야함. 그렇지않을 경우 두번 루핑을 돈다*** 
                //현상태의 총상품금액
                currentTotalAmountNumber = parseFloat($('.totalAmountNumber22B').text().trim());
                //현 상태의 갯수만큼의 판매 금액
                currentSellPricexx = parseFloat($(this).parent().parent().find('.real_price_option_numberB').text().trim());
                //총상품금액에서 빠져나갈 금액을 뺀다(실제로 남아있을 총 금액)                
                totalAmountSellPricexx = parseFloat(currentTotalAmountNumber) - parseFloat(currentSellPricexx);
                ////총금액을 주입
                //총상품금액란에 number를 넣는다. //for B routine////
                $('.totalAmountNumber22B').empty().append(totalAmountSellPricexx);
                //총상품금액란에 number를 넣는다.//for Top routine////
                $('.totalAmountNumber22').empty().append(totalAmountSellPricexx);
                //총상품금액란에 편집된 내용을 넣는다.//for B routine////
                $('#totalAmount22_textB').empty().append(totalAmountSellPricexx);
                //총상품금액란에 편집된 내용을 넣는다.//for Top routine////
                $('#totalAmount22_text').empty().append(totalAmountSellPricexx);
                //총상품금액을 보여준다.//for Top routine////
                $('.grand_real_sell_amount22').show();

                //편집함수로 금액을 편집한다.//for B routine////           
                $('#totalAmount22_textB').each(function () {
                    txtValue = formatNumber($(this).text());
                    $(this).text(txtValue);
                });
                //편집함수로 금액을 편집한다.//for Top routine////         
                $('#totalAmount22_text').each(function () {
                    txtValue = formatNumber($(this).text());
                    $(this).text(txtValue);
                });

                //해당 정보를 삭제하고 선택된 상품이 하나도 없으면 총상춤금액란을 숨긴다.
                $(this).parent().parent().parent().parent().parent().remove();
                //for Top routine////
                //selected_option2_id를 찾아 Top에서도 remove 시킨다.
                selectedOptionTwoIdForTop = $(this).parent().parent().parent().parent().parent().find('.selected_option2_idB').text().trim();
                $('.selectedOption_list').each(function () {
                    if (selectedOptionTwoIdForTop == ($(this).find('.selected_option2_id').text().trim())) {
                        $(this).find('.selected_option2_id').parent().parent().parent().remove();
                    }
                })

                if (totalAmountSellPricexx == 0) {
                    //아래 addOptionSw 변수를 한번도 사용 않해서 제거해야함.08/05/2019
                    addOptionSw = false; //선택된 옵션 상품이 하나도 없으니 false로 만든다
                    $('.grand_real_sell_amount22B').hide();//for B routine////
                    //for Top routine////
                    $('.grand_real_sell_amount22').hide();
                }
            });
        }//end of function buildingOptionList2B()
        ////end of B routin/////////////////////////////////////////////////////////////////////
    });
}

//편집하는 함수
function formatNumber(num) {
    return num.toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, "$1,")
}
