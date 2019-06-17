<div class="row" style="margin-left: -15px; margin-top: 30px;">
    <div class="col-sm-6 col-md-6 col-lg-6">
        <span style="font-size: 20px;">
            <b>판매자</b>의
            <b>인기상품</b>
        </span>
    </div>
    <div class="col-sm-2 col-md-2 col-lg-2" style="margin-top: -20px;">
        <div class="page_footer2">
            {{ $products->onEachSide(2)->links() }}
        </div>
    </div>
    <div class="col-sm-4 col-md-4 col-lg-4"></div>
</div>
<div class="row" style="margin-top: 10px; margin-bottom: 100px;">
    <div class="col-sm-8 col-md-8 col-lg-8" style="margin-right: -30px;">
        @foreach ($products as $item)
        <div style="width: 137px; height: 137px; margin-right: 10px; word-break: break-all; float: left;">
            <a href="/product/detailsWithCdn/{{ $item->id }}" target="_blank">
                <?=$item->searchImage?>
            </a>
            <!--타이틀을 원하는 글자수 만큼 줄여서 보여주기-->
            @if (strlen($item->modelName) > 23)
            <?php
            $strTemp = "";
            ////$strTemp = substr(($item->modelName),0, 7); //한글에 문제 있음...
            $strTemp = mb_substr(($item->modelName),0, 20, "utf-8");
            $strTemp .= "...";
            ?>
            <span style="word-break: break-all;">
                {{ $strTemp }}
            </span>

            @else
            <span style="word-break: break-all;">
                <?=$item->modelName?>
            </span>
            @endif
            <br />
            <span>
                <b style="font-size: 18px;" class="sellPrice_others"><?=$item->sellPrice?></b>원                                   
            </span>
        </div>
        @endforeach
        <!--categoryAId 값을 얻기위해 데이터를 숨긴다(Ajax에서 사용)...-->
        <div style="display: none; " class="hidden_categoryAId2">
            {{ $item->categorya_id }}
        </div>
        <!--categoryBId 값을 얻기위해 데이터를 숨긴다(Ajax에서 사용)...-->
        <div style="display: none; " class="hidden_categoryBId2">
            {{ $item->categoryb_id }}
        </div>
    </div>
    <div class="col-sm-4 col-md-4 col-lg-4"></div>
</div>

<div style="clear: both;"></div>

<!--Page 번호(Footer)를 클릭했을때 Ajax로 해당 데이터를 보낸다-->
<!--pagination을 Ajax로 구현할때 master page를 통하지 않고 바로
원하는 부분으로 보낼때 사용된다===>중요함...-->
<script>
    $(function () {
        $('.page_footer2').on('click', 'a', function () {
            //alert(this.href);
            if (this.href == "") { return; } //잘못 클릭했을 경우 아무것도 하지 않는다...
            var aId = $('.hidden_categoryAId2').text().trim();
            var bId = $('.hidden_categoryBId2').text().trim();           
            $.ajax({
                type: "get",
                url: this.href, ////매우 중요....
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
    });

    ////금액편집
    $(function () {
        $('.sellPrice_others').each(function () {
            txtValue = formatNumber($(this).text());
            $(this).text(txtValue);
        });
    })
</script>