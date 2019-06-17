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

    ! function (a) { //아래"a("form2")"의 form은 해당 form tag 이름에 따라 바뀐다...
        jQuery(window).bind("unload", function () { }), a(document).ready(function () {
            a(".my_loader").hide(), a("form2").on("submit", function () {
                a("form2").validate(), a("form2").valid() ? (a(".my_loader").show(), a("form2").valid() || a(".my_loader").hide()) : a(".my_loader").hide()
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


<div class='col-sm-8 col-md-8 col-lg-8'>
    <div class="row">
        <div class='col-sm-12 col-md-12 col-lg-12'>
            <span style="font-size: 18px;">
                선택된 옵션1 : 
            </span>
            <span class="optionOne_description" style="background-color: blue; color: white; vertical-align: middle; font-size: 20px;">
                {{ $description }}
            </span>
            <span class="optionOne_productId" style="display: none;">{{ $productId }}</span>
            <span class="optionOne_optionOneId" style="display: none;">{{ $optionOneId }}</span>
        </div>               
    </div>   
</div>

<div class='col-sm-8 col-md-8 col-lg-8'>
    <div class="row">
        <label style="text-align: left;" class='col-sm-3 col-md-3 col-lg-3 control-label'>옵션 내용</label>
        <div class='col-sm-3 col-md-3 col-lg-3'></div>
        <label style="text-align: left;" class='col-sm-3 col-md-3 col-lg-3 control-label'>옵션 금액</label>
        <label style="text-align: left;" class='col-sm-2 col-md-2 col-lg-2 control-label'>옵션 재고</label>
        <div class='col-sm-1 col-md-1 col-lg-1'></div>
    </div>

    @foreach ($optionTwos as $item)
    <div class="row description_row" style="margin-right: 0px;">
        <div class='col-sm-6 col-md-6 col-lg-6 delete_description'>            
            <a href="javascript:void()">
                <span class="selected_id" style="display: none;">{{ $item->id }}</span>
                <span>{{ $item->description }}</span>
            </a>
        </div>
        <div class='col-sm-3 col-md-3 col-lg-3'>
            <span>{{ $item->amount }}</span>
        </div>
        <div class='col-sm-3 col-md-3 col-lg-3'>
            <span>{{ $item->stock }}</span>
        </div>
    </div>
    @endforeach
    
    <form name="form2" id="form2" action='/seller/optionTwoStore' method='post' class='form-horizontal' enctype="multipart/form-data">
        {{ csrf_field() }}
        <!--insert somthing..-->
        <div class="row form-group" style="display: none;">
            <input type="hidden" value="" id="txtOptionOneId" name="txtOptionOneId" class="txtOptionOneId" />
            <input type="hidden" value={{ $productId }} name="txtProductId" class="txtProductId" />
            <input type="hidden" value={{ $numOfRow }} name="txtNumOfRow" />            
        </div>

        <!--옵션이 10개라고 가정하자-->
        @for ($i = 0; $i < (10 - $numOfRow); $i++)
         <div class="row form-group" style="margin-right: 0px;">
            <div class='col-sm-6 col-md-6 col-lg-6'>
                <input type='text' name='txtName[]' class='form-control' maxlength='50' value='{{old("txtName[]")}}' />
            </div>
            <div class='col-sm-3 col-md-3 col-lg-3'>
                <input type='number' name='txtPrice[]' class='form-control' value='{{old("txtPrice[]")}}' step="1" />
            </div>
            <div class='col-sm-3 col-md-3 col-lg-3'>
                <input type='number' name='txtStock[]' class='form-control' value='{{old("txtStock[]")}}' min='0' step="1" />
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

<script src="/myJs/optionTwoCreate.js"></script>

<!--화면 하단의 서브밋 버튼 누르면 상품 등록이 시작된다.-->
<script>       
</script>
