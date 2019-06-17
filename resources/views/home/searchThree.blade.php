<!--searchTerm 을 Ajax에서 사용하기위해 숨긴다: 콘트롤러에서 넘어온값이다-->
<div>
    <input type="hidden" value="<?=$searchTerm?>" id="searchTermAjax" />
</div>

<div class="row" style="margin-right: 0px;">
    <div class="col-sm-12 col-md-12 col-lg-12">
        @foreach ($products2 as $item)
        <div style="width: 222px; height: 330px; border: 1px solid rgba(128, 128, 128, 0.56); word-break: break-all; float: left;">
            <a href="/product/detailsWithCdn/{{ $item->id }}" target="_blank">
                <?=$item->searchImage?>
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
                </b>원
            </span>
        </div>
        @endforeach
    </div>
</div>

<div class="page_footer2">
    <!--18/04/2019-->
    {{ $products2->onEachSide(2)->links() }}
</div>

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
<!--pagination을 Ajax로 구현할때 master page를 통하지 않고 바로
원하는 부분으로 보낼때 사용된다===>중요함...-->
<script>
    $(function () {
        $('.page_footer2').on('click', 'a', function () {
            //alert(this.href);
            if (this.href == "") { return; } //잘못 클릭했을 경우 아무것도 하지 않는다...
            var searchTerm = $('#searchTermAjax').val().trim(); //위에서 숨겨놓은 값을 참조한다...  ////
            $.ajax({
                url: this.href,
                type: 'GET',
                data: { searchTerm: searchTerm },
                cache: false,
                success: function (data) {
                    //$('.contents2').html(data);
                    $('.contents2').empty().append(data); //이렇게 코딩해도 실행된다...
                },
                error: function () {
                    alert("errors from searchTree...");
                }
            });
            return false;  //매우 중요함...
        });
    });
</script>