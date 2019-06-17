
<style>
    a span:hover {
        text-decoration: underline;
        color: blue;
    }
</style>

<div class="row">
    <div class="col-sm-12 col-md-12 col-lg-12">        
        @foreach ($categoryas as $item)      
        <div style="width: 12.5%; float: left; min-height:230px;">
            <div style="width: 100%; min-height: 30px; line-height: 30px; vertical-align: central; background: rgba(0, 0, 255, 0.20);">
                <span>
                    <b>
                        <?=$item->name?>
                    </b>
                </span>
            </div>
            <?php
            $categorybs = $item->categorybs;
            foreach ($categorybs as $item2)
            {                              
            ?>
            <div style="padding-left: 7px;">
                <a href="/product/categoryBmenu/<?=$item2->categorya_id?>/<?=$item2->id?>/<?=$item2->name?>" target="_blank">
                    <span class="bMenuName">
                        <?=$item2->name?>
                    </span>
                    <br />
                </a>
            </div>
            <?php
            }
            ?>          
        </div>
        @endforeach

        <div style="clear: both;"></div>
        <table style="width: 100%; min-height: 30px;">
            <tr>
                <td style="width: 98%;"></td>
                <td style="width: 2%;">
                    <a href="#" class="allBMenu_close">
                        <i style="font-size: 30px; text-align: center; background: blue; color: white;" class="glyphicon glyphicon-remove"></i>
                    </a>
                </td>
            </tr>
        </table>
    </div>
</div>

<!--<script src="/static/js/jquery-2.2.3.min.js"></script>-->

<!--전체메뉴를 펼친 상태에서 우측하단의 크로스마크 클릭시-->
<script>
    $(function () {
        $('.allBMenu_close').click(function () {
            $('.allMenu_text').removeClass("blue_white");
            $('#chevron_up').css('display', 'none')
            $('#chevron_down').css('display', 'inline-block')
            sw = false;
            $('.detailMenu').hide();
        });
    });
</script>
