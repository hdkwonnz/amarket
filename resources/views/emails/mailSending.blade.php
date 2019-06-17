<h3>상품 주문 내역</h3>
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
                <a href="http://amarket.test/product/details/{{    $item->product_id }}" target="_blank">
                    <img style="width: 30%; height: 23%; padding-left: 0px;" src="http://amarket.test/uploadFiles/pictures/sellers/<?=$fileName?>" class="img-responsive" />
                    <!--<img style="width: 100%; height: 23%; padding-left: 0px;" src="http://hdkwonnz.cdn2.cafe24.com/uploadFiles/pictures/sellers/<?=$fileName?>" class="img-responsive" />-->
                </a>
            </td>
            <td class="title_width">
                <a href="http://amarket.test/product/details/{{ $item->product_id }}" target="_blank">
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