
<div class="row" style="margin-right: 0px; margin-top: 10px; margin-bottom: 10px;">
    <div class="col-sm-12 col-md-12 col-lg-12 text-center">
        <div style="border-top: 2px solid blue; min-height: 40px; 
                    line-height: 40px; vertical-align: central;
                    background-color: rgba(128, 128, 128, 0.42);">
            <span style="font-size: 25px;">모든 카테고리 보기 </span>
        </div>
    </div>
</div>
<div class="row" style="margin-right: 0px; margin-top: 10px; margin-bottom: 10px;">
    <div class="col-sm-12 col-md-12 col-lg-12">
        <a href="/manager/categoryCrud" style="font-size: 20px;" class="btn btn-info">
            <!--<span>초기화면으로 > </span>-->
            초기화면으로
        </a>
    </div>
</div>

<div class="row" style="margin-right: 0px;">
    <div class="col-sm-3 col-md-3 col-lg-3">
        <span style="font-size: 20px;">
            <b>카테고리 A</b>
        </span>
        <div style="height: 400px; width: 100%; overflow-y: auto;
                    border: 1px solid blue;">
            <?php
            foreach($categoryas as $item) {
            ?>

            <div style='margin-top: 5px; margin-left: 10px;'>
                <!--<a href="/admin/selectCategoryBCD?id=<?=$item->categoryAId?>" style='font-size: 20px;'>-->
                <a href='#' style='font-size: 20px;' onclick="selectCategoryBCD(<?=$item->id?>); return false;">
                    <div class='hoverLightBlue clickA' style='border: 1px solid white; width: 100%; min-height: 30px;'>
                        <?=$item->name?>
                    </div>
                </a>
            </div>

            <?php
            }
            ?>
        </div>
    </div>
    <div class="col-sm-3 col-md-3 col-lg-3">
        <span style="font-size: 20px;">
            <b>카테고리 B</b>
        </span>
        <div style="height: 400px; width: 100%; overflow-y: auto;
                    border: 1px solid blue;">
            <?php
            foreach($categorybs as $item) {
            ?>

            <div style='margin-top: 5px; margin-left: 10px;'>
                <!--<a href="/admin/selectCategoryACD?id=<?=$item->categoryAId?>&id2=<?=$item->categoryBId?>" style='font-size: 20px;'>-->
                <a href='#' style='font-size: 20px;' onclick="selectCategoryACD(<?=$item->categorya_id?>, <?=$item->id?>); return false;">
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
    <div class="col-sm-3 col-md-3 col-lg-3">
        <span style="font-size: 20px;">
            <b>카테고리 C</b>
        </span>
        <div style="height: 400px; width: 100%; overflow-y: auto;
                    border: 1px solid blue;">
            <?php
            foreach($categorycs as $item) {
            ?>

            <div style='margin-top: 5px; margin-left: 10px;'>
                <!--<a href="/admin/selectCategoryABD?id=<?=$item->categoryAId?>&id2=<?=$item->categoryBId?>&id3=<?=$item->categoryCId?>" style='font-size: 20px;'>-->
                <a href='#' style='font-size: 20px;' onclick="selectCategoryABD(<?=$item->categorya_id?>, <?=$item->categoryb_id?>, <?=$item->id?>); return false;">
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
    <div class="col-sm-3 col-md-3 col-lg-3">
        <span style="font-size: 20px;">
            <b>카테고리 D</b>
        </span>
        <div style="height: 400px; width: 100%; overflow-y: auto;
                    border: 1px solid blue;">
            <?php
            foreach($categoryds as $item) {
            ?>

            <div style='margin-top: 5px; margin-left: 10px;'>
                <!--<a href="/admin/selectCategoryABC?id=<?=$item->categoryAId?>&id2=<?=$item->categoryBId?>&id3=<?=$item->categoryCId?>&id4=<?=$item->categoryDId?>" style='font-size: 20px;'>-->
                <a href='#' style='font-size: 20px;' onclick="selectCategoryABC(<?=$item->categorya_id?>, <?=$item->categoryb_id?>, <?=$item->categoryc_id?>, <?=$item->id?>); return false;">
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
</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

<script>
    function selectCategoryBCD(id)
    {
        $.ajax({
            type: "get",
            url: "/manager/selectCategoryBCD",
            data: { id: id },
            chche: false,
            success: function (data) {
                $('.displaySection').empty().append(data);
                //var html = '<span style="color: red;"><b>카테고리B</b></span>&nbsp;&nbsp;';
                //html += '<input type="text" id="txtCategoryB" />';
                //html += ' <button type="button" class="buttonB">확인</button>';
                //$('.inputSection').empty().append(html);
            },
            error: function (data) {
                alert("/manager/selectCategoryBCD 시스템에러...");
            }
        });
    }

    function selectCategoryACD(id, id2) {
        $.ajax({
            type: "get",
            url: "/manager/selectCategoryACD",
            data: { id: id, id2: id2 },
            cache: false,
            success: function (data) {
                $('.displaySection').empty().append(data);
                //var html = '<span style="color: red;"><b>카테고리C</b></span>&nbsp;&nbsp;';
                //html += '<input type="text" id="txtCategoryC" />';
                //html += ' <button type="button" class="buttonC">확인</button>';
                //$('.inputSection').empty().append(html);
            },
            error: function (data) {
                alert("/manager/selectCategoryACD 시스템에러...");
            }
        });
    }

    function selectCategoryABD(id, id2, id3) {
        $.ajax({
            type: "get",
            url: "/manager/selectCategoryABD",
            data: { id: id, id2: id2, id3: id3 },
            chche: false,
            success: function (data) {
                $('.displaySection').empty().append(data);
                //var html = '<span style="color: red;"><b>카테고리D</b></span>&nbsp;&nbsp;';
                //html += '<input type="text" id="txtCategoryD" />';
                //html += ' <button type="button" class="buttonD">확인</button>';
                //$('.inputSection').empty().append(html);
            },
            error: function (data) {
                alert("/manager/selectCategoryABD 시스템에러...");
            }
        });
    }

    function selectCategoryABC(id, id2, id3, id4) {
        $.ajax({
            type: "get",
            url: "/manager/selectCategoryABC",
            data: { id: id, id2: id2, id3: id3, id4: id4 },
            chche: false,
            success: function (data) {
                $('.displaySection').empty().append(data);
                $('.inputSection').empty();
            },
            error: function (data) {
                alert("/manager/selectCategoryABC 시스템에러...");
            }
        });
    }
</script>

<script>
    $(function () {
        $('.buttonA').click(function () {
            alert("buttonA");
        });
        $('.buttonB').click(function () {
            alert("buttonB");
        });
        $('.buttonC').click(function () {
            alert("buttonC");
        });
        $('.buttonD').click(function () {
            alert("buttonD");
        });
    });
</script>
<script>
    //$('.clickA').each(function () {
    //    $(this).unbind().click(function () {
    //        var html = '<span>카테고리B</span>';
    //        html += '<input type="text" id="txtCategoryB" />';
    //        html += ' <button type="submit">확인</button>';
    //        $('.inputSection').empty().append(html);
    //    });
    //});
</script>