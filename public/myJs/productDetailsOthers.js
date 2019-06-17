////판매자 인기상품 load
$(function () {
    var aId = $('.hidden_categoryAId').text().trim();
    var bId = $('.hidden_categoryBId').text().trim();
    $.ajax({
        type: "get",
        url: "/product/ownersPopularProducts",
        data: { aId: aId, bId: bId },
        chche: false,
        success: function (data) {
            $('.ownersPopularProducts_section').empty().append(data);
            //$('.my_loader').hide();
        },
        error: function (data) {
            alert("/product/ownersPopularProducts 시스템에러...");
            //$('.my_loader').hide();
        }
    });
    return false;
});
////메뉴바 밑에 가로로 펼쳐있는 메뉴에 마우를 대면 그에 해당하는 서브 메뉴가 펼쳐 진다
$(function () {
    $('.menu_map_parent1').mouseover(function () {
        $('.menu_map_child1').show()
    });
    $('.menu_map_parent1').mouseout(function () {
        $('.menu_map_child1').hide()
    });

    $('.menu_map_parent2').mouseover(function () {
        $('.menu_map_child2').show()
    });
    $('.menu_map_parent2').mouseout(function () {
        $('.menu_map_child2').hide()
    });

    $('.menu_map_parent3').mouseover(function () {
        $('.menu_map_child3').show()
    });
    $('.menu_map_parent3').mouseout(function () {
        $('.menu_map_child3').hide()
    });
});

////택배회사에 마우스 온하면 내용이 보인다.
$(function () {
    $('.delivery_notice_block').mouseover(function () {
        $('.delivery_notice').show()
    });
    $('.delivery_notice_block').mouseout(function () {
        $('.delivery_notice').hide()
    });
});

////<!--금액 편집-->
$(function () {    
    $('.option22_amount_text').each(function () {
        txtValue = formatNumber($(this).text());
        $(this).text(txtValue);
    });
    var value = $('.originPrice').text();
    var txtValue = "";
    txtValue = formatNumber(value);
    $('.originPrice').empty().append(txtValue);

    var value = $('.differPrice').text();
    var txtValue = "";
    txtValue = formatNumber(value);
    $('.differPrice').empty().append(txtValue);

    var value = $('.sellPrice').text();
    var txtValue = "";
    txtValue = formatNumber(value);
    $('.sellPrice').empty().append(txtValue);

    var value = $('.delivery_free_minimum').text();
    var txtValue = "";
    txtValue = formatNumber(value);
    $('.delivery_free_minimum').empty().append(txtValue);

    $('.sellPriceBrother').each(function () {
        txtValue = formatNumber($(this).text());
        $(this).text(txtValue);
    });

    $('.delivery_cost_set').each(function () {
        txtValue = formatNumber($(this).text());
        $(this).text(txtValue);
    });

    $('.option11_amount_text').each(function () {
        txtValue = formatNumber($(this).text());
        $(this).text(txtValue);
    });
});
//수정해야한다.25/04/2019
$(function () { //수정해야한다.25/04/2019
    $('.productList_option').each(function (i) {
        var value = $(this).children().find('.sellPrice_option_txt').text();
        var txtValue = "";
        txtValue = formatNumber(value);
        $(this).children().find('.sellPrice_option_txt').empty().append(txtValue);

        var value = $(this).children().find('.originPrice_option_txt').text();
        var txtValue = "";
        txtValue = formatNumber(value);
        $(this).children().find('.originPrice_option_txt').empty().append(txtValue);
    });
});
//편집하는 함수
function formatNumber(num) {
    return num.toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, "$1,")
}

////<!--JQuery UI사용시 conflict가 발생하여 $m으로 재정의 하였음-->
////<!--아래는 절대로 지우지 말것. spinner 사용시 에러가 나옴-->
$m = jQuery.noConflict();
$m(function () {
    $m('#dialogForCart').dialog({ autoOpen: false });
});