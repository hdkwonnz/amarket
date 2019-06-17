
<link href="/lib/slickCarousel/css/slick.css" rel="stylesheet" />
<link href="/lib/slickCarousel/css/slick-theme.css" rel="stylesheet" />
<link href="/myCss/mySlick.css" rel="stylesheet" />

<!--브랜드 로고 Slick===>Slider4..-->
<div class="row" style="margin-left: 0px; margin-right: 15px;">
    <div class="col-sm-2 col-md-2 col-lg-2 text-center" style="padding-left: 0px; padding-right: 0px;">
        <div style="height: 94px; width: 100%; font-size: 25px; border-top: 3px solid rgba(128, 128, 128, 0.56); border-left: 2px solid rgba(128, 128, 128, 0.56); border-right: 2px solid rgba(128, 128, 128, 0.56);">
            <span style="">전체상품</span>
            <br />
            <span>
                (<?=$numRows?>)
            </span>
        </div>
    </div>
    <div class="col-sm-10 col-md-10 col-lg-10" style="min-height: 50px; overflow: hidden; border-top: 1px solid rgba(128, 128, 128, 0.56); border-bottom: 3px solid rgba(128, 128, 128, 0.56); border-left: 1px solid rgba(128, 128, 128, 0.56); border-right: 1px solid rgba(128, 128, 128, 0.56); margin-top: 10px;">
        <div class="slider_body">
            <div class="row">
                <div class="col-sm-12 col-md-12 col-lg-12">
                    <div class="slider4">
                        <div class="slider4_photo_size">
                            <a href="#">
                                <img src="/imageLogo/smallCarousel/akMall.JPG" />
                            </a>
                        </div>
                        <div class="slider4_photo_size">
                            <a href="#">
                                <img src="/imageLogo/smallCarousel/akPlaza.JPG" />
                            </a>
                        </div>
                        <div class="slider4_photo_size">
                            <a href="#">
                                <img src="/imageLogo/smallCarousel/cjMall.JPG" />
                            </a>
                        </div>
                        <div class="slider4_photo_size">
                            <a href="#">
                                <img src="/imageLogo/smallCarousel/fashion.JPG" />
                            </a>
                        </div>
                        <div class="slider4_photo_size">
                            <a href="#">
                                <img src="/imageLogo/smallCarousel/halfClub.JPG" />
                            </a>
                        </div>
                        <div class="slider4_photo_size">
                            <img src="/imageLogo/smallCarousel/homePluse.JPG" />
                        </div>

                        <div class="slider4_photo_size">
                            <a href="#">
                                <img src="/imageLogo/smallCarousel/homePluse.JPG" />
                            </a>
                        </div>
                        <div class="slider4_photo_size">
                            <a href="#">
                                <img src="/imageLogo/smallCarousel/hyundaiMall.JPG" />
                            </a>
                        </div>
                        <div class="slider4_photo_size">
                            <a href="#">
                                <img src="/imageLogo/smallCarousel/iPark.JPG" />
                            </a>
                        </div>
                        <div class="slider4_photo_size">
                            <a href="#">
                                <img src="/imageLogo/smallCarousel/iStyle.JPG" />
                            </a>
                        </div>
                        <div class="slider4_photo_size">
                            <a href="#">
                                <img src="/imageLogo/smallCarousel/lotteCom.JPG" />
                            </a>
                        </div>
                        <div class="slider4_photo_size">
                            <a href="#">
                                <img src="/imageLogo/smallCarousel/mario.JPG" />
                            </a>
                        </div>

                        <div class="slider4_photo_size">
                            <a href="#">
                                <img src="/imageLogo/smallCarousel/shinsegeMall.JPG" />
                            </a>
                        </div>
                        <div class="slider4_photo_size">
                            <a href="#">
                                <img src="/imageLogo/smallCarousel/widWiz.JPG" />
                            </a>
                        </div>
                        <div class="slider4_photo_size">
                            <a href="#">
                                <img src="/imageLogo/smallCarousel/galleria.JPG" />
                            </a>
                        </div>
                        <div class="slider4_photo_size">
                            <a href="#">
                                <img src="/imageLogo/smallCarousel/daegu.JPG" />
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row" style="margin-top: 20px;">
    <div class="col-sm-12 col-md-12 col-lg-12">
        <p>
            <a href="#">
                <b>G마켓 랭크순</b>
            </a>
            &nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;
            <a href="#">판매인기순</a>
            &nbsp;&nbsp;&nbsp;|
            <a href="#">가격낮은순</a>
            &nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;
            <a href="#">상품평순</a>
            &nbsp;&nbsp;&nbsp;|
            <a href="#">신규상품순</a>
            &nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;
            <a href="#">브랜드상품만보기</a>
        </p>
    </div>
</div>

<!--플러스 상품(광고)-->
<div class="row">
    <div class="col-sm-2 col-md-2 col-lg-2">
        <span>플러스 상품(광고)</span>
    </div>
    <div class="col-sm-10 col-md-10 col-lg-10"></div>
</div>

<!--id, id2, id3를 Ajax에서 사용하기위해 숨긴다: 콘트롤러에서 넘어온값이다-->
<div>
    <input type="hidden" value="<?=$id?>" id="idAjax" />
    <input type="hidden" value="<?=$id2?>" id="id2Ajax" />
    <input type="hidden" value="<?=$id3?>" id="id3Ajax" />
    <input type="hidden" value="<?=$id4?>" id="id4Ajax" />
</div>

<!--카테고리C의 상품을 보여준다-->
<div class="row" style="margin-right: 0px;">
    <div class="col-sm-12 col-md-12 col-lg-12">
        @foreach ($products as $item)
        <?php
        $id = $item->id;
        //$pictures = $item->pictures->first();
        //$fileName = $pictures->fileName;
        $fileName = $item->searchImage;
        ?>
        <div style="width: 225px; height: 330px; border: 1px solid rgba(128, 128, 128, 0.56); word-break: break-all; float: left;">
            <a href="/product/detailsWithCdn/{{ $id }}" target="_blank">
                <!--<img style="width: 90%; height: 60%; padding-left: 0px;" src="/uploadFiles/pictures/sellers/<?=$item->fileName?>" class="img-responsive" />-->
                <!--<img style="width: 90%; height: 60%; padding-left: 0px;" src="http://hdkwonnz.cdn2.cafe24.com/uploadFiles/pictures/sellers/<?=$fileName?>" class="img-responsive" />-->
                <?=$fileName?>
            </a>
            <span style="word-break: break-all;">
                <?=$item->modelName?>
            </span>
            <br />
            <span style="text-decoration: line-through;" class="originPrice">
                <?=$item->originPrice?>
                <span>원</span>
            </span>
            <br />
            <span>
                <b style="font-size: 18px;" class="sellPrice">
                    <?=$item->sellPrice?>
                </b>
                원
            </span>
        </div>
        @endforeach
    </div>
</div>

<div class="page_footer">
    {!! $products->render() !!}
</div>

<!--script-->
<script src="https://code.jquery.com/jquery-3.1.0.min.js" integrity="sha256-cCueBR6CsyA4/9szpPfrX3s49M9vUU5BgtiJj06wt/s=" crossorigin="anonymous"></script>
<!--<script src="/lib/jquery/jquery-2.2.3.min.js"></script>-->
<script src="/lib/slickCarousel/script/slick.min.js"></script>
<script src="/myJs/mySlick.js"></script>

<!--금액 편집-->
<script>
    $(function () {
        $('.originPrice').each(function () {
            var txtValue = "";
            txtValue = formatNumber($(this).text());
            $(this).text(txtValue);
        })

        $('.sellPrice').each(function () {
            var txtValue = "";
            txtValue = formatNumber($(this).text());
            $(this).text(txtValue);
        })
    });

    //편집하는 함수
    function formatNumber(num) {
        return num.toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, "$1,")
    }
</script>

<!--Page 번호(Footer)를 클릭했을때 Ajax로 해당 데이터를 보낸다-->
<script>
    $(function () {
        $('.page_footer').on('click', 'a', function () {
            if (this.href == "") { return; } //잘못 클릭했을 경우 아무것도 하지 않는다...
            var id = $('#idAjax').val().trim(); //위에서 숨겨놓은 값을 참조한다...////
            var id2 = $('#id2Ajax').val().trim(); //위에서 숨겨놓은 값을 참조한다...////
            var id3 = $('#id3Ajax').val().trim(); //위에서 숨겨놓은 값을 참조한다...////
            var id4 = $('#id4Ajax').val().trim(); //위에서 숨겨놓은 값을 참조한다...////
            $.ajax({
                url: this.href,
                type: 'GET',
                data: { id : id, id2 : id2, id3 : id3 },
                cache: false,
                success: function (data) {
                    $('.categoryDproducts').html(data);
                    //$('.categoryDproducts').empty().append(data); //이렇게 코딩해도 실행된다...
                },
                error: function () {
                    alert("errors from /product/categoryDAll...");
                }
            });
            return false;  //매우 중요함...
        });
    });
</script>

