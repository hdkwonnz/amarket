////<!--카테고리B를 클릭하면 카테고리C가 만들어진다.
////이때 기존에 존재하던 카테고리C,D 섹션은 모두 지운다.-->
function selectCategoryC(id, id2, name) {
    $('.noticeWords').show();
    $('.inputSection').hide();

    //$('.categoryBSection').empty();
    $('.categoryCSection').empty();
    $('.categoryCSection').append('<span style="color: red;">category C loading 중 입니다...</span>');
    $('.categoryDSection').empty();
    //$('.categoryAName').empty();
    $('.categoryBName').empty();
    $('.categoryCName').empty();
    $('.categoryDName').empty();
    //$('.divider1').empty();
    $('.divider2').empty();
    $('.divider3').empty();

    $.ajax({
        type: "post",
        //아래를 꼭 삽입해야 post로 보낼수 있다...
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        url: "/seller/selectCategoryC",
        data: { id: id, id2: id2 },
        chche: false,
        success: function (data) {
            $('.my_loader').hide();////////////////////////////
            $('.categoryCSection').empty().append(data);
            $('.categoryBName').empty().append(name);
            $('.divider2').empty().append('>');
        },
        error: function (data) {
            alert("/seller/selectCategoryC 시스템에러...");
        }
    });
}