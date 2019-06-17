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
            padding-top: 3px;
            padding-bottom: 3px;
        }

    .webgrid-header {
        padding-bottom: 0px;
        padding-top: 0px;
        text-align: center;
    }

    .webgrid-footer {
    }

    .webgrid-row-style {
    }

    .webgrid-alternating-row {
    }

    .image_width {
        width: 10%;
    }

    .title_width {
        width: 50%;
        padding-left: 3px;
        word-break: break-all;
    }

    .status_width {
        width: 20%;
    }

    .confirm_width {
        width: 20%;
    }

    .colspan_width {
        width: 60%;
    }
</style>

<div style="height: 700px; overflow-y: scroll;">    
    <table class="webgrid-table" id="checkableGrid" style="margin-top: 0px;">
        <thead>
            <tr class="webgrid-header">
                <th colspan="2" class="colspan_width">주문 상품</th>
                <th class="status_width">결제 금액</th>
                <th class="confirm_width">상 태</th>
            </tr>
        </thead>
        <tbody>           
            @foreach($orderDetails as $item) 
            <?php
            $product = $item->product;
            $modelName = $product->modelName;
            $pictures = $product->pictures->first();
            $fileName = $pictures->fileName;
            ?>       
            <tr class="webgrid-row-style">
                <td class="image_width">
                    <a href="/product/details/{{ $item->product_id }}" target="_blank">
                        <img style="width: 100%; height: 23%; padding-left: 0px;" src="/uploadFiles/pictures/sellers/{{ $fileName }}" class="img-responsive" />
                        <!--<img style="width: 100%; height: 23%; padding-left: 0px;" src="http://hdkwonnz.cdn2.cafe24.com/uploadFiles/pictures/sellers/<?=$fileName?>" class="img-responsive" />-->
                    </a>
                </td>
                <td class="title_width">
                    <a href="/product/details/{{ $item->product_id }}" target="_blank">
                        <?=$modelName?>
                    </a>
                    <br />
                    <span class="sellPrice">
                        <?=$item->price?>
                    </span>
                    원/
                    <span>
                        <?=$item->quantity?>개
                    </span>
                </td>
                <td class="status_width">
                    <span>추후 생성 예정</span>
                </td>
                <td class="confirm_width">
                    <span>추후 생성 예정</span>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>

<!--script-->

<!--금액 편집-->
<script>
    $(function () {
        $('.sellPrice').each(function () {
            var txtValue = "";
            txtValue = formatNumber($(this).text());
            $(this).empty().append(txtValue);
        })
    });

    //편집하는 함수
    function formatNumber(num) {
        return num.toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, "$1,")
    }
</script>