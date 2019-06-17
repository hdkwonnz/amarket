//아래 코드는 쇼핑몰 6개를 한개의 carousel로 만들어 쇼핑몰 이름위에 mouse over하면 해당하는 carousel-indicators 와
//carousel-inner를 찾아 그 번호에 active calss를 주면 자동으로 carosel이 작동되는 아주 중요한 코드이다.
//jquery에서 원하는 element를 찾아 가는 아주 중요한 예제이다......

$n = jQuery.noConflict();  //충돌로 인해서 재정의 하였음(object...error)
$n(function () {
    $n('.lotte_on').css('opacity', '1');  //처음 화면 로드 시에는 롯데백화점 이름만 진하게를 보여준다
    $n('.no_decoration').each(function (i) { //6개의 이름중 mouse over한 element를 찾는다. (i ==> 해당 index)
        $n(this).mouseover(function () {           
            //현재 indicator에서 active class 제거
            $n("#home_shopping_show .carousel-indicators").find("li[class=active]").removeClass("active");
            //elements를 찾는 방법은 위 아래 코드 모두 가능 하다
            //현재 indicator에 active clss 제거
            //$n("#home_shopping_show .carousel-indicators").find(".active").removeClass("active");
            //mouse over한 이름의 indicator에 active calss add
            $n("#home_shopping_show .carousel-indicators li").eq(i).addClass('active');

            //현재 inner에서 active class 제거
            $n("#home_shopping_show .carousel-inner").find(".active").removeClass("active");
            //mouse over한 이름의 inner에 active calss add
            $n("#home_shopping_show .carousel-inner .item").eq(i).addClass('active');

            $n(this).css('opacity', '1');

            //이름을 진하게 바꾸기
            $n(".name_on").each(function (iiii) {
                if (i == iiii) {
                    $n(this).css('opacity', '1').css('text-decoration', 'none');//a span:hover에서 test-decoration을 none으로 
                    //$n(this).css('text-decoration', 'none');//a span:hover에서 test-decoration을 none으로  
                }
                else {
                    $n(this).css('opacity', '0.5')
                }
            });

            //이름 옆에 화살 표 추가
            $n(".arrow_go").each(function (ii) {
                if (i == ii) {
                    $n(this).show()                    
                }
                else {
                    $n(this).hide()
                }
            });
            
            //이름 밑에 under bar 추가
            $n(".under_bar").each(function (iii) {
                if (i == iii) {
                    $n(this).show()
                }
                else {
                    $n(this).hide()
                }
            });
            
        });       
    });
})


//카루셀 양옆 좌우 화살표를 클릭 했을 때 사진이 이동 하는 방향에 따라 제목도 같이
//따라서 움직이게 하는 코드 임.
//아래 코드는 좌측 화살표를 클릭 했을 때
$n(function () {
    $n("#home_shopping_show .left").click(function () {  //좌측 화살표를 클릭        
        $n("#home_shopping_show .carousel-indicators li").each(function (i) { //indicator > li 를 모두 검색          
            if ($n(this).attr("class") == "active") {  // $n(this).(i)==>이렇게 사용하면 작동 않함. 위와 비교 할것             
                if (i == 0) {   //로테이션 방향에 따라 제목의 순서를 준다
                    $nextNum = 5;
                }
                if (i == 5) {
                    $nextNum = 4;
                }
                if (i == 4) {
                    $nextNum = 3;
                }
                if (i == 3) {
                    $nextNum = 2;
                }
                if (i == 2) {
                    $nextNum = 1;
                }
                if (i == 1) {
                    $nextNum = 0;
                }
                //이름을 진하게 바꾸기
                $n(".name_on").each(function (iiii) {
                    if ($nextNum == iiii) { //움직이는 순서에 해당하는 번호를 찾아 이름 밝기를 바꾸어 준다.
                        $n(this).css('opacity', '1').css('text-decoration', 'none');//a span:hover에서 test-decoration을 none으로 
                        //$n(this).css('text-decoration', 'none');//a span:hover에서 test-decoration을 none으로  
                    }
                    else {
                        $n(this).css('opacity', '0.5')
                    }
                });
                //이름 옆에 화살 표 추가
                $n(".arrow_go").each(function (ii) {
                    if ($nextNum == ii) {
                        $n(this).show()
                    }
                    else {
                        $n(this).hide()
                    }
                });
                //이름 밑에 under bar 추가
                $n(".under_bar").each(function (iii) {
                    if ($nextNum == iii) {
                        $n(this).show()
                    }
                    else {
                        $n(this).hide()
                    }
                });
            }            
        })
    });
})

//아래 코드는 우측 화살표를 클릭 했을 때
$n(function () {
    $n("#home_shopping_show .right").click(function () {  //좌측 화살표를 클릭      
        $n("#home_shopping_show .carousel-indicators li").each(function (i) { //indicator > li 를 모두 검색          
            if ($n(this).attr("class") == "active") {  // $n(this).(i)==>이렇게 사용하면 작동 않함. 위와 비교 할것             
                if (i == 0) {   //로테이션 방향에 따라 제목의 순서를 준다
                    $nextNum = 1;
                }
                if (i == 5) {
                    $nextNum = 0;
                }
                if (i == 4) {
                    $nextNum = 5;
                }
                if (i == 3) {
                    $nextNum = 4;
                }
                if (i == 2) {
                    $nextNum = 3;
                }
                if (i == 1) {
                    $nextNum = 2;
                }
                //이름을 진하게 바꾸기
                $n(".name_on").each(function (iiii) {
                    if ($nextNum == iiii) { //움직이는 순서에 해당하는 번호를 찾아 이름 밝기를 바꾸어 준다.
                        $n(this).css('opacity', '1').css('text-decoration', 'none');//a span:hover에서 test-decoration을 none으로 
                        //$n(this).css('text-decoration', 'none');//a span:hover에서 test-decoration을 none으로  
                    }
                    else {
                        $n(this).css('opacity', '0.5')
                    }
                });
                //이름 옆에 화살 표 추가
                $n(".arrow_go").each(function (ii) {
                    if ($nextNum == ii) {
                        $n(this).show()
                    }
                    else {
                        $n(this).hide()
                    }
                });
                //이름 밑에 under bar 추가
                $n(".under_bar").each(function (iii) {
                    if ($nextNum == iii) {
                        $n(this).show()
                    }
                    else {
                        $n(this).hide()
                    }
                });
            }
        })
    });
})

