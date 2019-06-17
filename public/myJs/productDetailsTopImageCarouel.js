//product details view에서 맨 위의 대표 상품 이미지 carousel에 관한 코드.18/04/2019

$d = jQuery.noConflict();  //충돌로 인해서 재정의 하였음(object...error)

//carousel image는 최대 3개로 제한 한다고 가정 하자.
//carousel에서 data image를 찾아 순서별로 썸네일 칸으로 보내준다.
$d(function () {
    //carousel에 보여질 image 수를 count 한다.
    var topImagesLength = $d('.top_images').length; 
    
    //carousel image를 thumb nail로 보낸다.
    $d('.top_images').each(function (j) { //carousel

        var top_image = $d(this).find('a').html();

        $d('.top_images_thum').each(function (jj) { //thumb nail
            if (j == jj) {
                $d(this).empty().append(top_image);
            }            
        });
    });

    //만약 image가 3개 보다 적다면 나머지 thumb nail 공간을 지우자.
    if (topImagesLength < 3)
    {
        $d('.top_images_thum').each(function (jjj) {     
            if (jjj >= topImagesLength) { //jjj 시작은 0 부터 이니까...
                $d(this).remove();
            }
        });
    }    
})

//thumb nail에 mouse over하면 carousel에 image가 보인다.
$d(function () {
    //thumb nail에서 mouse over한 element를 찾는다. (i ==> 해당 index)
    $d('.top_images_thum').each(function (i) { 
        $d(this).mouseover(function () {
            //현재 indicator에서 active class 제거
            $d("#my-carousel .carousel-indicators").find("li[class=active]").removeClass("active");
            //elements를 찾는 방법은 위 아래 코드 모두 가능 하다
            //현재 indicator에 active clss 제거
            //$n("#home_shopping_show .carousel-indicators").find(".active").removeClass("active");
            //mouse over한 이름의 indicator에 active calss add
            $d("#my-carousel .carousel-indicators li").eq(i).addClass('active');

            //현재 inner에서 active class 제거
            $d("#my-carousel .carousel-inner").find(".active").removeClass("active");
            //mouse over한 이름의 inner에 active calss add
            $d("#my-carousel .carousel-inner .item").eq(i).addClass('active');
        });
    });
})