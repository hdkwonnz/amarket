////<!--금액 편집-->
$(function () {
    $('.sellPrice').each(function () {
        var txtValue = "";
        txtValue = formatNumber($(this).text());
        $(this).empty().append(txtValue);
    })
});
//편집하는 함수
function formatNumber(num) {
    return num.toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, "$1,")
}

////<!--아래는 매우 중요 절대 지우지 말 것.13/05/2019-->
////<!--이미지값을 trim 해 준다.-->
$(function () {
    $('.search_imageForDetails').each(function () {
        trimedText = ($(this).text().trim());
        $(this).empty().append(trimedText);
    })
});