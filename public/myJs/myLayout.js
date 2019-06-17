////<!--처음 화면 로드시에 전체메뉴를 준비해서 숨겨놓는다-->
$.ajax({
    url: "/home/categoryAmenu",
    type: 'get',
    //data: { value: selectedValue },
    success: function (data) {
        $("#detailMenu_section").empty().append(data);
    },
    error: function () {
        //alert("/home/categoryAmenu something seems wrong");
    }
});

//메뉴바 가장 왼쪽의 전체 메뉴를 클릭했을 때.
$(function () {
    var sw = false;
    $('.allMenu').click(function () {
        if (sw == false) {
            $('.allMenu_text').addClass("blue_white");
            $('#chevron_down').css('display', 'none')
            $('#chevron_up').css('display', 'inline-block')
            sw = true;
            //$('.detailMenu').css('top', '0px').css('left', '0px').css('position', 'relative').show()
            $('.detailMenu').show()

            //아래 ajax는 화면 로드시 첫 부분으로 옮김==>위 부분 참조 할 것
            //$.ajax({
            //    url: "/home/categoryAmenu",
            //    type: 'get',
            //    //data: { value: selectedValue },
            //    success: function (data) {
            //        $("#detailMenu_section").empty().append(data);
            //    },
            //    error: function () {
            //        //alert("/home/categoryAmenu something seems wrong");
            //    }
            //});
        }
        else {
            $('.allMenu_text').removeClass("blue_white");
            $('#chevron_up').css('display', 'none')
            $('#chevron_down').css('display', 'inline-block')
            sw = false;
            $('.detailMenu').hide();
        }
    });
});

////// 페이지 로드시 현재 보고 있는 페이지 메뉴에 active 속성 부여
//$(document).ready(function () {
//    var url = window.location;
//    //alert(url);
//    //밑에 upper_nav는 내가 추가 시켰음. 상단 nav bar만 액티브로 만들기 위해...
//    $('.upper_nav ul.nav li a').each(function () {
//        if (this.href == url) {
//            $("ul.nav li").each(function () {
//                if ($(this).hasClass("active")) {
//                    $(this).removeClass("active");
//                }
//            });
//            $(this).parent().addClass('active');
//        }
//    });
        
//    //내가 추가
//    //드롭다운메뉴에서 서브메뉴 선택시 메인메뉴를 액티브로 바꿔줌
//    $('ul.dropdown-menu li a').each(function () {
//        if (this.href == url) {
//            $(this).parent().parent().parent().addClass('active');
//        }
//    });
//});

///////푸터를 맨 아래에 고정
//$(document).ready(function () {
//    var docHeight = $(window).height();
//    var footerHeight = $('#footer').height();
//    var footerTop = $('#footer').position().top + footerHeight;

//    if (footerTop < docHeight) {  //아래 숫자를 조정하여 원하는 위치를 맞출것...
//        $('#footer').css('margin-top', 30 + (docHeight - footerTop) + 'px');
//    }
//});
//바텀메뉴를 지움
$(function () {
    $('.nav_cross').click(function () {
        $('#secondNavBar').hide()
    });
});

////<!--서치필드의 글자수를 체크 하고 문자 시작 과 끝의 공백을 제거한다.-->
//상단 서치바 체크
function checkFields() {
    var trimSearchTerm = ($('#searchTerm').val()).trim();
    $('#searchTerm').val(trimSearchTerm);
    if ($('#searchTerm').val().length < 2) {
        $('#searchTerm').focus();
        alert("최소 두글짜를 입력하세요...")
        return false;
    }
}
//하단 서치바 체크
function checkFields2() {
    var trimSearchTerm = ($('#searchTerm2').val()).trim();
    $('#searchTerm2').val(trimSearchTerm);
    if ($('#searchTerm2').val().length < 2) {
        $('#searchTerm2').focus();
        alert("최소 두글짜를 입력하세요...")
        return false;
    }
    //하단 서치바에 입력된 내용을 상단의 입력으로 바꾼다.
    //(동일한 name value를 사용하기위해)
    $('#searchTerm').val('trimSearchTerm');
}

//// <!--최근에 조회한 상품을 보여준다.-->
////<!--바텀메뉴바에 있는 "최근본상품"을 클릭하면 내용을 보여 주거나 숨긴다.-->
var cookieExist = false;
if ($('.cookieExist').text().trim() == 'Y')  //위에서 숨겨 놓은 값(쿠키가 있으면)
{
    cookieExist = true;
}
$(function () {
    var sw = false;
    $('.click_latestWatch').click(function () {
        if (sw == false) {
            $('.latestMenu_text').addClass("blue_white");
            $('#chevron_down_latest').css('display', 'none')
            $('#chevron_up_latest').css('display', 'inline-block')
            $('#latestWatchProduct').show();
            sw = true;
            productMouseOver(); //클릭한 상태(상품이미지가 보임)에서 마우스오버 할경우...
        }
        else {
            $('.latestMenu_text').removeClass("blue_white");
            $('#chevron_up_latest').css('display', 'none')
            $('#chevron_down_latest').css('display', 'inline-block')
            $('#latestWatchProduct').hide();
            sw = false;
        }
        if (cookieExist == false) {
            $('.latestMenu_text').removeClass("blue_white");
            $('#chevron_up_latest').css('display', 'none')
            $('#chevron_down_latest').css('display', 'inline-block')
            $('#latestWatchProduct').hide();
            alert("최근에 검색한 상품이 없습니다...")
        }
    });
});

function productMouseOver() {
    $('.watchProduct').each(function () {
        $(this).mouseover(function () {
            var saveProduct = $(this); //현재 마우스온 상태인 상품을 세이브한다
            $(this).children().closest('.watchProductClose').show(); //이미지위에 "X" 마크를 보여준다
            var saveId = ($(this).children().closest('.watchProductId').text().trim()); //상품 아이디를 세이브
            //alert(saveId);
            $(this).children().closest('.watchProductClose').unbind().click(function () {  //"X"마크를 클릭하면 ==> 반드시 "unbind" 사용할것
                ////선택된 상품을 삭제한다.
                $.ajax({
                    url: "/home/deletCookieProduct",
                    type: 'Post',
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    data: { id: saveId },  //왼쪽의 "id" 를 "/home/deletCookieProduct" 에서도 같은글자("id")사용해야함
                    success: function (data) {
                        if (data != 1) {
                            alert("/home/deletCookieProduct 연결후 에러...");
                        }
                        else {
                            $(saveProduct).hide(); //위 프로그램(/Home/DeletCookieProduct)에서 해당상품을 삭제후 숨긴다
                        }                          //reload하기 전 까지는 메모리에 남아 있다.
                    },
                    error: function (data) {
                        alert("something seems wrong___DeletCookieProduct");
                    }
                });
                return false; //추가 11/05/2019

                ////아래 코드가 작동되지 않아 위의 Ajax로 실행중. 지우지 말것...
                //var myCookie = 'myProducts' + '[' + saveId + ']';
                //document.cookie = myCookie + "=" + escape("") + ";expires=Thu, 01 Jan 1970 00:00:01 GMT;" + "path=" + "/" + ";";
                ////위의 escape 괄호 자리에 value가 들어가야하나 지금은 비어두었다. 나중에 문제가 생기면 채워 넣을 것...
                $(saveProduct).hide();//위에서 해당상품을 삭제후 숨긴다.reload하기 전 까지는 메모리에 남아 있다.
            });
        });

        $(this).mouseout(function () { //상품 이미지에서 마우스가 아웃되면 "X"마크를 숨긴다
            $(this).children().closest('.watchProductClose').hide();
        });
    });
}

////<!--아래는 탑메뉴의 장바구니에 현재 쇼핑카트에 들어있는 총건수를 보여주는 코드-->
////이부분은 app.blade.php에 삽입하였음. 이곳에 삽입할경우 작동 불가...22/05/2019

////<!--아래는 매우 중요 절대 지우지 말 것.10/05/2019-->
////<!--thumb nail  있는 자리를 trim 해 주어야 thumb nail이 보인다.-->
$(function () {
    $('.thumb_nail_show').each(function () {
        trimedText = ($(this).text().trim());
        $(this).empty().append(trimedText);
    })
});        