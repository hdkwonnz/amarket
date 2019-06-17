<!--Table CSS-->
<style type="text/css">
    .webgrid-table {
        font-family: "Trebuchet MS", Arial, Helvetica, sans-serif;
        font-size: 1.2em;
        width: 100%;
        display: table;
        border-collapse: separate;
    }

    .webgrid-table th {
        background: rgba(128, 128, 128, 0.25);
    }

    .webgrid-table td {
        border-bottom: solid 1px rgba(128, 128, 128, 0.26);
        padding-top: 10px;
        padding-bottom: 10px;
    }

    .webgrid-header {
        padding-bottom: 4px;
        padding-top: 5px;
        text-align: left;
    }

    .webgrid-footer {
    }

    .webgrid-row-style {
    }

    .webgrid-alternating-row {
    }

    .image_width {
        width: 15%;
    }

    .title_width {
        width: 55%;
        padding-left: 10px;
        word-break: break-all;
        text-align: left;
    }

    .price_width {
        width: 15%;
    }

    .quantity_width {
        width: 15%;
    }
</style>

<div class='col-sm-12 col-md-12 col-lg-12' style="padding-left: 0px; margin-right: 0px;">    
    <!--searchTerm 을 Ajax에서 사용하기위해 숨긴다: 콘트롤러에서 넘어온값이다-->
    <div>
        <input type="hidden" value="<?=$searchTerm?>" id="searchTermAjax" />
    </div>

    <table class="webgrid-table" id="checkableGrid">
        <tbody>
            @foreach($products as $item)           
            <tr class="webgrid-row-style">                
                <td class="image_width">                    
                    <a href="/product/detailsWithCdn/{{ $item->id }}" target="_blank">
                        <div style="width: 150px; height: 150px;">
                            <?=$item->searchImage?>
                        </div>                                                                  
                    </a>                  
                </td>               
                <td class="title_width">
                    <a href="/product/detailsWithCdn/{{ $item->id }}" target="_blank">
                        <?=$item->modelName?>
                    </a>
                </td>
                <td class="price_width">
                    <span style="display: none;" class="originPrice"><?=$item->originPrice?></span>                                           
                    <?php
                    //$differPrice = $item->originPrice - $item->sellPrice;
                    $discountRate = round((100 - ($item->sellPrice / $item->originPrice * 100)),2);
                    ?>
                    <span class="originPrice_txt" style="text-decoration: line-through; font-size: 12px;"></span>원
                    <span style="color: blue;">
                        <?=$discountRate?>%
                        <i class="glyphicon glyphicon-arrow-down" style="font-size: 12px;"></i>
                    </span>
                    <br />
                    <span style="display: none; " class="sellPrice">
                        <?=$item->sellPrice?>
                    </span>
                    <span class="sellPrice_txt" style="font-size: 20px; "></span>원
                </td>
                <td class="quantity_width">
                    <span>추후 생성 예정</span>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <div class="page_footer">
        <!--{!!$products->render() !!}--><!--18/04/2019-->
        {{ $products->onEachSide(2)->links() }}
    </div>
</div>

<!-- Scripts -->
<script src="https://code.jquery.com/jquery-3.1.0.min.js" integrity="sha256-cCueBR6CsyA4/9szpPfrX3s49M9vUU5BgtiJj06wt/s=" crossorigin="anonymous"></script>
<!--금액 편집-->
<script>
    $(function () {
        $('.originPrice').each(function () {
            var txtValue = "";
            txtValue = formatNumber($(this).text());
            $(this).next().empty().append(txtValue);
        })

        $('.sellPrice').each(function () {
            var txtValue = "";
            txtValue = formatNumber($(this).text());
            $(this).next().empty().append(txtValue);
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
        $('.page_footer').on('click', 'a', function () {
            if (this.href == "") { return; } //잘못 클릭했을 경우 아무것도 하지 않는다...
            var searchTerm = $('#searchTermAjax').val().trim(); //위에서 숨겨놓은 값을 참조한다...  ////
            $.ajax({
                url: this.href,
                type: 'GET',
                data: { searchTerm: searchTerm},
                cache: false,
                success: function (data) {
                    //$('.contents2').html(data);
                    $('.contents1').empty().append(data); //이렇게 코딩해도 실행된다...
                },
                error: function () {
                    alert("errors from home/searchTwo...");
                }
            });
            return false;  //매우 중요함...
        });
    });
</script>