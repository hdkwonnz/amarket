
<div class="col-sm-3 col-md-3 col-lg-3">
    <span style="font-size: 20px;">
        <b>카테고리 D</b>
    </span>
    <div style="max-height: 200px; width: 100%; overflow-y: auto;
                    border: 1px solid blue;">
        <?php
        foreach($categoryds as $item) {
        ?>

        <div style='margin-top: 5px; margin-left: 10px;'>
            <a href='javascript:void(0)' style='font-size: 20px;' onclick="sendToView(<?=$item->categorya_id?>, <?=$item->categoryb_id?>, <?=$item->categoryc_id?>, <?=$item->id?>, '<?=$item->name?>'); return false;">
                <div class='hoverLightBlue' style='border: 1px solid white; width: 100%; min-height: 30px;'>
                    <?=$item->name?>
                </div>
            </a>
        </div>

        <?php
        }
        ?>
    </div>
</div>

<script src="/myJs/categoryDShow.js"></script>

<!--카테고리D를 클릭하여 최종적으로 선택되어진 카테고리의
    내용을 inputProductsView에서 선언한 변수에 저장한다-->
<script>
</script>