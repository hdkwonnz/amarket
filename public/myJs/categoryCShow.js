////<!--카테고리C를 클릭하면 카테고리D가 만들어진다.
////이때 기존에 존재하던 카테고리D 섹션은 모두 지운다.-->
function selectCategoryD(id, id2, id3, name) {
    $('.noticeWords').show();
    $('.inputSection').hide();

    //$('.categoryBSection').empty();
    //$('.categoryCSection').empty();
    $('.categoryDSection').empty();
    $('.categoryDSection').append('<span style="color: red;">category D loading 중 입니다...</span>');
    //$('.categoryAName').empty();
    //$('.categoryBName').empty();
    $('.categoryCName').empty();
    $('.categoryDName').empty();
    //$('.divider1').empty();
    //$('.divider2').empty();
    $('.divider3').empty();

    $.ajax({
        type: "post",
        //아래를 꼭 삽입해야 post로 보낼수 있다...
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        url: "/seller/selectCategoryD",
        data: { id: id, id2: id2, id3: id3 },
        chche: false,
        success: function (data) {
            $('.my_loader').hide();//////////////////////////////
            $('.categoryDSection').empty().append(data);
            $('.categoryCName').empty().append(name);
            $('.divider3').empty().append('>');
        },
        error: function (data) {
            alert("/seller/selectCategoryD 시스템에러...");
        }
    });
}