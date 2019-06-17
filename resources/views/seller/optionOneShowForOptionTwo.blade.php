
<!--optionOneShowForOptionTwo-->

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
        opacity: .25;
    }
</style>
<!--test for loading spinner 26/04/2019-->
<script>
    $(window).on(function () {
        $(".my_loader").fadeOut("slow");
    });

    ! function (a) { //아래"a("form")"의 form은 해당 form tag 이름에 따라 바뀐다...
        jQuery(window).bind("unload", function () { }), a(document).ready(function () {
            a(".my_loader").hide(), a("form").on("submit", function () {
                a("form").validate(), a("form").valid() ? (a(".my_loader").show(), a("form").valid() || a(".my_loader").hide()) : a(".my_loader").hide()
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

<!--옵션2를 위한 옵션1 내용-->
<div class="row" style="margin-right: 0px;">
    <div class='col-sm-12 col-md-12 col-lg-12'>
        <div style="border-top: 2px solid blue; min-height: 40px;
                    line-height: 40px; vertical-align: central;
                    background-color: rgba(128, 128, 128, 0.42);
                    margin-top: 10px; margin-bottom: 10px;"
            class="text-center">
            <span style="font-size: 20px;">{{ $modelName }} => 옵션2 등록</span>
        </div>
    </div>
</div>

<div class="row">
    <div class='col-sm-4 col-md-4 col-lg-4'>
        <label>옵션1내용</label>
        @foreach ($optionOnes as $item)
        <div class="optionOne_show">
            <a href="javascript:void()">
                <span class="description" style="font-size: 17px;">{{ $item->description }}</span>
                <span class="optionOne_id" style="display: none;">{{ $item->id }}</span>
                <span class="product_id" style="display: none;">{{ $item->product_id }}</span>
            </a>
        </div>             
        @endforeach
    </div>
    
    <div class="optionTwoCreate_section">
        <!--data from ajax-->
    </div>

</div>

<script src="/myJs/optionTwoStore.js"></script>
