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

    ! function (a) { //아래"a("form5")"의 form5은 해당 form tag 이름에 따라 바뀐다...
        jQuery(window).bind("unload", function () { }), a(document).ready(function () {
            a(".my_loader").hide(), a("form5").on("submit", function () {
                a("form5").validate(), a("form5").valid() ? (a(".my_loader").show(), a("form5").valid() || a(".my_loader").hide()) : a(".my_loader").hide()
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
            <span style="font-size: 20px;">{{ $modelName }} => 옵션1 등록</span>
            <span class="optionOne_productId" style="display: none;">{{ $productId }}</span>            
        </div>
    </div>   
</div>

<div class="row" style="margin-right: 0px;">
    <div class='col-sm-12 col-md-12 col-lg-12'>
        <label class='col-sm-6 col-md-6 col-lg-6'>
            <label>옵션내용</label>
        </label>
        <label class='col-sm-3 col-md-3 col-lg-3'>
            <label>가감금액</label>
        </label>
        <label class='col-sm-3 col-md-3 col-lg-3'>
            <label>재고수량</label>
        </label>
    </div>
    @foreach ($optionOnes as $item)
    <div class='col-sm-12 col-md-12 col-lg-12 description_row'>
        <div class='col-sm-6 col-md-6 col-lg-6 delete_description'>
            <a href="javascript:void()">
                <span class="selected_id" style="display: none;">{{ $item->id }}</span>
                <span>{{ $item->description }}</span>
            </a>
        </div>
        <div class='col-sm-3 col-md-3 col-lg-3'>
            {{ $item->amount }}
        </div>
        <div class='col-sm-3 col-md-3 col-lg-3'>
            {{ $item->stock }}
        </div>
    </div>
    @endforeach
</div>

<div class="row" style="margin-right: 0px;">
    <div class='col-sm-12 col-md-12 col-lg-12'>
        <form name="form5" id="form5" action='/seller/optionOneStore' method='post' class='form-horizontal' enctype="multipart/form-data">
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
                <div class='col-sm-6 col-md-6 col-lg-6'>
                    <input type='text' name='txtName[]' class='form-control' maxlength='50' value='{{old("txtName")}}' />
                </div>              
                <div class='col-sm-3 col-md-3 col-lg-3'>
                    <input type='number' name='txtPrice[]' class='form-control' value='{{old("txtPrice")}}' step="1" />
                </div>               
                <div class='col-sm-3 col-md-3 col-lg-3'>
                    <input type='number' name='txtStock[]' class='form-control' value='{{old("txtStock")}}' min='0' step="1" />
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
                    <a href="javascript:void()" class="register">
                        <input type='button' id="confirm_product" class='btn btn-lg btn-success' value='등록완료하기' />
                    </a>
                </div>
            </div>
          
        </form>
    </div>
</div>

<script src="/myJs/optionOneCreate.js"></script>

<!--화면 하단의 서브밋 버튼 누르면 상품 등록이 시작된다.-->
<script>   
</script>
