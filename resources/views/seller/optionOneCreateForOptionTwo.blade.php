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

    ! function (a) { //아래"a("form4")"의 form4은 해당 form tag 이름에 따라 바뀐다...
        jQuery(window).bind("unload", function () { }), a(document).ready(function () {
            a(".my_loader").hide(), a("form4").on("submit", function () {
                a("form4").validate(), a("form4").valid() ? (a(".my_loader").show(), a("form4").valid() || a(".my_loader").hide()) : a(".my_loader").hide()
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

<!--판매 상품 옵션1 등록-->
<div class="row" style="margin-right: 0px;">
    <div class='col-sm-12 col-md-12 col-lg-12'>
        <div style="border-top: 2px solid blue; min-height: 40px;
                    line-height: 40px; vertical-align: central;
                    background-color: rgba(128, 128, 128, 0.42);
                    margin-top: 10px; margin-bottom: 10px;"
            class="text-center">
            <span style="font-size: 20px;">{{ $modelName }} => 옵션2를 위한 옵션1 등록</span>
        </div>
    </div>
</div>

<div class="row" style="margin-right: 0px;">
    <div class='col-sm-12 col-md-12 col-lg-12'>
        <div class='col-sm-4 col-md-4 col-lg-4'>
            <label>옵션 내용</label>
        </div>
        <div class='col-sm-4 col-md-4 col-lg-4'>
            
        </div>
        <div class='col-sm-4 col-md-4 col-lg-4'>
            
        </div>
    </div>
    @foreach ($optionOnes as $item)
    <div class='col-sm-12 col-md-12 col-lg-12 description_row'>
        <div class='col-sm-12 col-md-12 col-lg-12 delete_description'>
            <a href="javascript:void()">
                <span class="selected_id" style="display: none;">{{ $item->id }}</span>
                <span>{{ $item->description }}</span>
            </a>
        </div>       
    </div>
    @endforeach
</div>

<div class="row" style="margin-right: 0px;">
    <div class='col-sm-12 col-md-12 col-lg-12'>
        <form name="form4" id="form4" action='/seller/optionOneStore' method='post' class='form-horizontal' enctype="multipart/form-data">
            {{ csrf_field() }}
            <div class="row form-group" style="display: none;">
                <input type="hidden" value={{ $productId }} name="txtProductId" class="txtProductId" />
                <input type="hidden" value={{ $modelName }} name="txtModelName" class="txtModelName" />
                <input type="hidden" value={{ $optionCode }} name="txtOptionCode" class="txtOptionCode" />
                <input type="hidden" value={{ $numOfRow }} name="txtNumOfRow" class="txtNumOfRow" />
            </div>
           
            <!--옵션이 10개라고 가정하자-->
            @for ($i = 0; $i< (10 - $numOfRow); $i++)
            <div class="row form-group">                
                <div class='col-sm-12 col-md-12 col-lg-12'>
                    <input type='text' name='txtName[]' class='form-control' maxlength='50' value='{{old("txtName")}}' />
                </div>               
            </div>
            @endfor
            
            <!--옵션이 10개라고 가정하자-->          
            <!--for loading spinner-->
            <div class="row form-group">
                @if ((10 - $numOfRow) > 0)
                <div class='col-sm-offset-1 col-md-offset-1 col-lg-offset-1 col-sm-5 col-md-5 col-lg-5'>
                    <a href="javascript:void()" class="register">
                        <input type='submit' id="register" name="register" class='btn btn-lg btn-primary' value='등록하기' />
                    </a>
                </div>
                @endif
                <div class='col-sm-offset-1 col-md-offset-1 col-lg-offset-1 col-sm-5 col-md-5 col-lg-5'>
                    <a href="javascript:void()" class="next_step">
                        <input type='button' name="next_step" class='btn btn-lg btn-primary' value="옵션2등록하기" />
                    </a>
                </div>
            </div>
           
        </form>
    </div>
</div>

<script src="/myJs/optionOneCreateForOptionTwo.js"></script>

<!--화면 하단의 서브밋 버튼 누르면 상품 등록이 시작된다.-->
<script>    
</script>
