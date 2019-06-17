<!--test for loading spinner 26/04/2019-->
<style>
        .my_loader {
            position: fixed;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            z-index: 9999;
            background: url(/files/loader.gif) 50% 50% no-repeat #000;
            opacity: .15;
        }
</style>
<!--test for loading spinner 26/04/2019-->
<script>
        $(window).on(function () {
            $(".my_loader").fadeOut("slow");
        });

        ! function (a)
        { ////////아래 "form1"은 해당 form tag에 따라 바뀐다...15/05/2019...중요함/////////////////////////////////
              jQuery(window).bind("unload", function () { }), a(document).ready(function () {
                  a(".my_loader").hide(), a("form1").on("submit", function () {
                      a("form1").validate(), a("form1").valid() ? (a(".my_loader").show(), a("form1").valid() || a(".my_loader").hide()) : a(".my_loader").hide()
                  }), a('a:not([href^="#"])').on("click", function () {
                      "" != a(this).attr("href") && a(".my_loader").show(), a(this).is('[href*="Download"]') && a(".my_loader").hide()
                  }), a("a:not([href])").click(function () {
                      a(".my_loader").hide()
                  }), a('a[href*="javascript:void(0)"]').click(function () {
                      a(".my_loader").hide()
                  }), a(".export").click(function () {
                      setTimeout(function () {
                          a(".my_loader").fadeOut("fast")
                      }, 1e3)
                  })
              })
        }(jQuery);
</script>

<!--test for loading spinner 26/04/2019-->
<div class="my_loader"></div>

<div class="col-sm-3 col-md-3 col-lg-3">
    <span style="font-size: 20px;">
        <b>카테고리 C</b>
    </span>
    <div style="max-height: 200px; width: 100%; overflow-y: auto;
                    border: 1px solid blue;">
        <?php
        foreach($categorycs as $item) {
        ?>

        <div style='margin-top: 5px; margin-left: 10px;'>
            <a href='javascript:void()' style='font-size: 20px;' onclick="selectCategoryD(<?=$item->categorya_id?>, <?=$item->categoryb_id?>, <?=$item->id?>, '<?=$item->name?>'); return false;">
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

<script src="/myJs/categoryCShow.js"></script>

<!--카테고리C를 클릭하면 카테고리D가 만들어진다.
이때 기존에 존재하던 카테고리D 섹션은 모두 지운다.-->
<script>
</script>