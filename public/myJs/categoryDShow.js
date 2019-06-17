////<!--카테고리D를 클릭하여 최종적으로 선택되어진 카테고리의
////내용을 inputProductsView에서 선언한 변수에 저장한다-->
function sendToView(id, id2, id3, id4, name) {
    //$('.categoryDSection').empty().append(data);
    $('.categoryDName').empty().append(name);
    $('#categoryAId').val(id);
    $('#categoryBId').val(id2);
    $('#categoryCId').val(id3);
    $('#categoryDId').val(id4);

    $('.noticeWords').hide();
    $('.inputSection').show();
}