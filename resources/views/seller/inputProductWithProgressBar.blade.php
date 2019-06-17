@extends('layouts.seller')

@section('title')
Seller-inputProduct
@endsection

@section('content')

<!--선택한 이미지를 보여줄 CSS...-->
<style>
    #preview img {
        height: 100px;
        width: 100px;
        float: left;
        margin: 3px;
    }
</style>

<!--판매할 상품 등록-->
<div class="row" style="margin-right: 0px;">
    <div class='col-sm-12 col-md-12 col-lg-12'>
        <div style="border-top: 2px solid blue; min-height: 40px;
                    line-height: 40px; vertical-align: central;
                    background-color: rgba(128, 128, 128, 0.42);
                    margin-top: 10px; margin-bottom: 10px;"
             class="text-center">
            <span style="font-size: 25px;">판매할 상품 등록</span>
        </div>
    </div>
    <div class='col-sm-12 col-md-12 col-lg-12'>
        <div class="noticeWords">
            <!--blink를 원하면 아래를 사용...-->
            <span style="color: blue;" class="blink_me">카테고리를 선택하세요...</span>
            <!--blink를 원하지 않으면 아래를 사용...-->
            <!--<span style="color: blue;" class="">카테고리를 선택하세요...</span>-->
        </div>
    </div>
</div>

<!--카테고리 섹션-->
<div class="categorySection">
    <div class="row" style="margin-right: 0px;">
        <!--카테고리A: 첫번째로 화면에 보여준다.-->
        <div class="categoryASection">
            <div class="col-sm-3 col-md-3 col-lg-3">
                <span style="font-size: 20px;">
                    <b>카테고리 A</b>
                </span>
                <div style="max-height: 200px; width: 99.9%; overflow-y: auto;
                    border: 1px solid blue;">
                    <?php
                    foreach($categoryas as $item) {
                    ?>

                    <div style='margin-top: 5px; margin-left: 10px;'>
                        <a href='#' style='font-size: 20px;' onclick="selectCategoryB(<?=$item->id?>, '<?=$item->name?>'); return false;">
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
        </div>
        <!--카태고리B,C,D 섹션: Ajax에서 데이터를 로드한다.-->
        <div class="categoryBSection">
            
        </div>
        <div class="categoryCSection">
           
        </div>
        <div class="categoryDSection">
            
        </div>
    </div>
</div>

<!--선택된 카테고리-->
<div class="row" style="margin-top: 20px;">
    <div class='col-sm-12 col-md-12 col-lg-12'>
        <div style='float: left; margin-right: 10px;'>
            <span style="color: red;">
                <b>선택된 카테고리 ==> </b>
            </span>
        </div>
        <div style='float: left; margin-right: 10px;' class="categoryAName"></div>
        <div style='float: left; margin-right: 10px;' class="divider1"></div>
        <div style='float: left; margin-right: 10px;' class="categoryBName"></div>
        <div style='float: left; margin-right: 10px;' class="divider2"></div>
        <div style='float: left; margin-right: 10px;' class="categoryCName"></div>
        <div style='float: left; margin-right: 10px;' class="divider3"></div>
        <div style='float: left; margin-right: 10px;' class="categoryDName"></div>
        <div style='clear: both;'></div>
    </div>
</div>

<!--input 섹션-->
<div class="inputSection" style="display: none;">
    <!--파일 업로드-->
    <div class="row" style="margin-left: 0px; margin-top: 30px;">
        <div class='col-sm-12 col-md-12 col-lg-12'>
            <form name="form2" id="form2" action="{{ url('seller/upload') }}" method='post' class='form-horizontal' enctype="multipart/form-data">
                {{ csrf_field() }}
                <div class='row' style="margin-right: 15px;">
                    <div class='form-group'>
                        <label class='col-sm-1 col-md-1 col-lg-1 control-label' for='file'>
                            <b>UploadPhoto</b>
                        </label>
                        <div class='col-sm-11 col-md-11 col-lg-11' id='formDataInput'>
                            <!-- pictures 테이블에 producId를 저장하기위해 prodcuts 테이블 인서트시에 리턴값으로 받아
                             juqery Script submitForm2()에서 값을 주입시킨다.-->
                            <input type="hidden" value="" id="txtProductNo" name="txtProductNo" />
                            <input class='form-control text-box multi-line' type='file' name='file[]' multiple id='file' accept="image/.gif,.jpg,.png" required />
                            <output id="filesInfo"></output>
                            <div id="preview"></div><!--선택한 사진을 보여주기 위해 준비(프리뷰)-->
                            <div class="thumbnail_msg"></div><!--썸네일 준비중 메세지 보여주기-->
                        </div>
                    </div>
                </div>                
            </form>
            <div class="progress" style="margin-left: -15px; margin-right: 15px;">
                <div class="progress-bar" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"></div>
            </div>
            <div id="targetLayer" style="display:none;"></div>
            <div id="loader-icon" style="display:none;"><img src="/files/loader.gif" /></div>
        </div>
    </div>
       
    <!--상품내역 입력섹션-->
    <div class="row" style="margin-left: 0px; margin-right: 15px;">
        <div class='col-sm-12 col-md-12 col-lg-12'>
            <!--action 지정시 sublime texter하고 다름. 'products/insertProducts' 라고 쓰지 말것...-->
            <form name="form1" id="form1" action='#' method='post' class='form-horizontal' enctype="multipart/form-data">
                <div class="form-group">
                    <input type="hidden" value="" id="categoryAId" name="categoryAId" />
                    <input type="hidden" value="" id="categoryBId" name="categoryBId" />
                    <input type="hidden" value="" id="categoryCId" name="categoryCId" />
                    <input type="hidden" value="" id="categoryDId" name="categoryDId" />
                </div>

                <div class='row'>
                    <div class='form-group'>
                        <label class='col-sm-1 col-md-1 col-lg-1 control-label'>상품 번호</label>
                        <div class='col-sm-5 col-md-5 col-lg-5'>
                            <input type='text' id='txtModelNumber' name='txtModelNumber' class='form-control' maxlength='50' value='{{old("txtModelNumber")}}' required />
                        </div>
                        <label class='col-sm-1 col-md-1 col-lg-1 control-label'>상품 이름</label>
                        <div class='col-sm-5 col-md-5 col-lg-5'>
                            <input type='text' id='txtModelName' name='txtModelName' class='form-control' maxlength='50' value='{{old("txtModelName")}}' required />
                        </div>
                    </div>
                </div>

                <div class='row'>
                    <div class='form-group'>
                        <label class='col-sm-1 col-md-1 col-lg-1 control-label'>제조 회사</label>
                        <div class='col-sm-5 col-md-5 col-lg-5'>
                            <input type='text' id='txtCompany' name='txtCompany' class='form-control' maxlength='50' value='{{old("txtCompany")}}' required />
                        </div>
                        <label class='col-sm-1 col-md-1 col-lg-1 control-label'>상품 가격</label>
                        <div class='col-sm-5 col-md-5 col-lg-5'>
                            <input type='number' id='txtOriginPrice' name='txtOriginPrice' class='form-control' value='{{old("txtOriginPrice")}}' min='0.1' step="0.01" required />
                        </div>
                    </div>
                </div>

                <div class='row'>
                    <div class='form-group'>
                        <label class='col-sm-1 col-md-1 col-lg-1 control-label'>판매 가격</label>
                        <div class='col-sm-5 col-md-5 col-lg-5'>
                            <input type='number' id='txtSellPrice' name='txtSellPrice' class='form-control' value='{{old("txtSellPrice")}}' min='0.1' step="0.01" required />
                        </div>
                        <label class='col-sm-1 col-md-1 col-lg-1 control-label'>행사 이름</label>
                        <div class='col-sm-5 col-md-5 col-lg-5'>
                            <input type='text' id='txtEventName' name='txtEventName' class='form-control' maxlength='30' value='{{old("txtEventName")}}' required />
                        </div>
                    </div>
                </div>

                <div class='row'>
                    <div class='form-group'>
                        <label class='col-sm-1 col-md-1 col-lg-1 control-label'>상품 설명</label>
                        <div class='col-sm-5 col-md-5 col-lg-5'>
                            <!--<input type='text' id='txtExplaination' name='txtExplaination' class='form-control' maxlength='30' value='{{old("txtExplaination")}}' required />-->
                            <!--아래는 반드시 한 줄로 표기해야 한다. 그렇지 않을 경우 내용의 앞 여러 칸이 비어진 상태로 보여진다-->
                            <textarea id='txtExplaination' name='txtExplaination' class='form-control' rows="10" required>{{old("txtExplaination")}}</textarea>                                                            
                        </div>
                        <label class='col-sm-1 col-md-1 col-lg-1 control-label'>상세 설명</label>
                        <div class='col-sm-5 col-md-5 col-lg-5'>
                            <!--<input type='text' id='txtDescription' name='txtDescription' class='form-control' maxlength='30' value='{{old("txtDescription")}}' required />-->
                            <!--아래는 반드시 한 줄로 표기해야 한다. 그렇지 않을 경우 내용의 앞 여러 칸이 비어진 상태로 보여진다-->
                            <textarea id='txtDescription' name='txtDescription' class='form-control' rows="10" required>{{old("txtDescription")}}</textarea>                                                           
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class='form-group'>
                        <div class='col-sm-offset-1 col-md-offset-1 col-lg-offset-1 col-sm-2 col-md-2 col-lg-2'>
                            <input type='button' id="cancel" name="cancel" class='btn btn-danger' value='cancel' />
                        </div>
                        <div class='col-sm-offset-1 col-md-offset-1 col-lg-offset-1 col-sm-5 col-md-5 col-lg-5'>
                            <input type='submit' id="register" name="register" class='btn btn-default btn-primary' value='Register' />
                        </div>
                    </div>
                </div>
            </form>           
        </div>
    </div>
</div>

<!--파일 업로드 중 입니다-->
<div class="row upload_msg" style="display: none; margin-top: 50px; margin-bottom: 50px;">
    <div class='col-sm-12 col-md-12 col-lg-12'>
        <span style="color: red; font-size: 30px;">파일 업로드 중 입니다. 잠시만 기다리세요...</span>
    </div>
</div>

<!--버튼 섹션-->
<div class="row buttonShowAndHide" style="display: none; margin-top: 50px; margin-bottom: 50px;">
    <div style="color: blue; font-size: 30px; margin-left: 15px; margin-bottom: 100px; margin-top: 100px;">
        <span>
            상품 입력이 완료 되었습니다. 아래 버튼을 클릭 하세요... 
        </span>
    </div>   
    <div>
        <div class='col-sm-2 col-md-2 col-lg-2'>
            <button type='button' id="goProductDetails" class='btn btn-success'>입력한내용보기</button>
        </div>
        <div class='col-sm-offset-1 col-md-offset-1 col-lg-offset-1 col-sm-2 col-md-2 col-lg-2'>
            <button type='button' id="continueInput" class='btn btn-info'>계속입력하기</button>
        </div>
    </div>
</div>

<script src=https://cdnjs.cloudflare.com/ajax/libs/jquery.form/4.2.2/jquery.form.js></script>

<!--업로드할 파일의 preview 와 width, height, size 체크를 한다-->
<!--파일선택을 클릭했을때 선택되어진 파일들을 썸네일로 보여준다-->
<script>
    window.URL = window.URL || window.webkitURL;
    var elBrowse = document.getElementById("file"),
        elPreview = document.getElementById("preview"),
        useBlob = false && window.URL; // `true` to use Blob instead of Data-URL

    // 2.
    function readImage(file) {
       
        // 2.1
        // Create a new FileReader instance
        // https://developer.mozilla.org/en/docs/Web/API/FileReader
        var reader = new FileReader();

        // 2.3
        // Once a file is successfully readed:
        reader.addEventListener("load", function () {
            
            // At this point `reader.result` contains already the Base64 Data-URL
            // and we've could immediately show an image using
            // `elPreview.insertAdjacentHTML("beforeend", "<img src='"+ reader.result +"'>");`
            // But we want to get that image's width and height px values!
            // Since the File Object does not hold the size of an image
            // we need to create a new image and assign it's src, so when
            // the image is loaded we can calculate it's width and height:
            var image  = new Image();
            image.addEventListener("load", function () {

                // Concatenate our HTML image info
                var imageInfo = file.name    +' '+ // get the value of `name` from the `file` Obj
                                image.width  +'×'+ // But get the width from our `image`
                                image.height +' '+
                                file.type    +' '+
                                Math.round(file.size/1024) +'KB';

                ////width, height 체크(내가 추가)...
                //if (image.width > 400 || image.height > 400)
                //{
                //    alert(file.name + " is width or height more than 400px.");
                //    $('#preview').empty();
                //    $('#file').val('');
                //    return;
                //}

                ////파일 사이즈 체크...
                ////내가 추가                   //1024 byte * 1024 * 2 = 2,097,152 byte(2MB)
                //if (file.size > 2097152) {   //1024 byte * 1024 * 2.5 = 2,621,440 byte(2.5MB)
                //    alert(file.name + ' => Filesize must 2MB or below');
                //    $('#preview').empty();
                //    $('#file').val('');
                //    return;
                //}

                //if (i == 0) {
                //    $('#preview').empty();
                //}
                
                // Finally append our created image and the HTML info string to our `#preview`                
                elPreview.appendChild(this);

                //썸네일 준비중이라는 메세지 지우기
                $('.thumbnail_msg').empty()

                //아래는 내가 코멘트했음. 그렇지 않으면 imageInfo가 사진옆에 출력된다.
                //elPreview.insertAdjacentHTML("beforeend", imageInfo +'<br>');
            });

            image.src = useBlob ? window.URL.createObjectURL(file) : reader.result;

            // If we set the variable `useBlob` to true:
            // (Data-URLs can end up being really large
            // `src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAADAAAAA...........etc`
            // Blobs are usually faster and the image src will hold a shorter blob name
            // src="blob:http%3A//example.com/2a303acf-c34c-4d0a-85d4-2136eef7d723"
            if (useBlob) {
                // Free some memory for optimal performance
                window.URL.revokeObjectURL(file);
            }
        });

        // 2.2
        // https://developer.mozilla.org/en-US/docs/Web/API/FileReader/readAsDataURL
        reader.readAsDataURL(file);

    }

    // 1.
    // Once the user selects all the files to upload
    // that will trigger a `change` event on the `#browse` input
    elBrowse.addEventListener("change", function() {
        //업로드 버튼을 누르면 기존에 보여준 사진을 지운다.
        $('#preview').empty();
       
        // Let's store the FileList Array into a variable:
        // https://developer.mozilla.org/en-US/docs/Web/API/FileList
        var files  = this.files;
        // Let's create an empty `errors` String to collect eventual errors into:
        var errors = "";

        if (!files) {
            errors += "File upload not supported by your browser.";
        }

        // Check for `files` (FileList) support and if contains at least one file:
        if (files && files[0]) {

            // Iterate over every File object in the FileList array
            for(var i=0; i<files.length; i++) {

                //내개 추가 했음...
                if (files.length > 3)
                {
                    alert("3개 까지 업로드 할 수 있습니다...");
                    $('#preview').empty();
                    $('#file').val('');
                    return;
                }

                // Let's refer to the current File as a `file` variable
                // https://developer.mozilla.org/en-US/docs/Web/API/File
                var file = files[i];

                // Test the `file.name` for a valid image extension:
                // (pipe `|` delimit more image extensions)
                // The regex can also be expressed like: /\.(png|jpe?g|gif)$/i
                if ( (/\.(png|jpeg|jpg|gif)$/i).test(file.name) ) {
                    // SUCCESS! It's an image!
                    // Send our image `file` to our `readImage` function!
                    readImage(file);

                    //썸네일 준비중 메세지
                    $('.thumbnail_msg').empty().append('<span style="color:red;">썸네일 준비중. 잠시 기다리세요...</span>');
                } else {
                    errors += file.name +" Unsupported Image extension\n";
                }
            }
        }

        // Notify the user for any errors (i.e: try uploading a .txt file)
        if (errors) {
            alert(errors);
        }

    });
</script>

<!--화면상단의 카테고리A를 클릭하면 카테고리B가 만들어진다.
    이때 기존에 존재하던 카테고리B,C,D 섹션은 모두 지운다.-->
<script>
    function selectCategoryB(id, name)
    {
        $('.noticeWords').show();
       
        $('.categoryBSection').empty();
        $('.categoryBSection').append('<span style="color: red;">category B loading 중 입니다...</span>');
        $('.categoryCSection').empty();
        $('.categoryDSection').empty();
        $('.categoryAName').empty();
        $('.categoryBName').empty();
        $('.categoryCName').empty();
        $('.categoryDName').empty();
        $('.divider1').empty();
        $('.divider2').empty();
        $('.divider3').empty();
       
        $.ajax({
            type: "post",
            //아래를 꼭 삽입해야 post로 보낼수 있다...
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url: "/seller/selectCategoryB",
            data: { id: id },
            chche: false,
            success: function (data) {
                $('.categoryBSection').empty().append(data);
                $('.categoryAName').empty().append(name);
                $('.divider1').empty().append('>');
            },
            error: function (data) {
                alert("/seller/selectCategoryB 시스템에러...");
            }
        });
    }
</script>

<!--blink 기능 구현-->
<script>
    function blinker() {
        $('.blink_me').fadeOut(500);
        $('.blink_me').fadeIn(500);
    }
    setInterval(blinker, 1000); //Runs every second
</script>

<!--입역화면 하단의 cancel 버튼을 누르면 입력내용이 지워진다.-->
<script>
    $(function () {
        $('#cancel').click(function () {
            $('#txtModelNumber').val("");
            $('#txtModelName').val("");
            $('#txtCompany').val("");
            $('#txtOriginPrice').val("");
            $('#txtSellPrice').val("");
            $('#txtEventName').val("");
            $('#txtExplaination').val("");
            $('#txtDescription').val("");
            $('#file').val("");
            $('#txtProductNo').val("");
            $('#preview').empty(); ////
        });
    });
</script>

<script>
    //입역화면 하단의 서브밋 버튼 누르면 상품 등록이 시작된다.
    var submitButton = null;  //서브밋 버튼의 동작을 제어하기 위해(중복입력방지)사용.

    $(function () {
        $('#form1').submit(function (event) {

            submitButton = $(this).find("input[type='submit']");

            submitButton.prop('disabled', true);  //버튼을 누른 후에는 더이상 작동하지 않는다.

            submitForm2();

            return false;

        });
    });

    //products 테이블에 인서트 시킨후 pictures 테이블에
    //인서트하기위해 doSubmitForm2()을 콜한다
    function submitForm2() {

        if (($('#file').val()).trim() == "") {
            alert("Please choose Picture(s) to Upload...");
            submitButton.prop('disabled', false);  //서브밋 버튼을 활성화 시킨다.
            return false;
        }

        //var inputFile = $('input#file');
        //var filesToUpload = inputFile[0].files;
        //if (filesToUpload.length > 3) {
        //    alert("파일 업로드는 3개 까지 가능 합니다...");
        //    submitButton.prop('disabled', false);  //서브밋 버튼을 활성화 시킨다.
        //    return false;
        //}

        //for (var i = 0; i < filesToUpload.length; i++) {
        //    var file = filesToUpload[i]; //1024 byte * 1024 * 2 = 2,097,152 byte(2MB)
        //    if (file.size > 2097152) {   //1024 byte * 1024 * 2.5 = 2,621,440 byte(2.5MB)
        //        alert(file.name + ' => Filesize must 2MB or below');
        //        submitButton.prop('disabled', false);  //서브밋 버튼을 활성화 시킨다.
        //        return false;
        //    }
        //}  //for loop

        insertProductByAjax();
    }

    //입력 데이터를 콘트롤(seller/insertProduct) 으로 보낸다.
    function insertProductByAjax()
    {       
        $.ajax({
            type: 'POST',
            //아래를 꼭 삽입해야 post로 보낼수 있다...
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url: "/seller/insertProduct",
            data: {
                categoryAId: $('#categoryAId').val().trim(),  ////
                categoryBId: $('#categoryBId').val().trim(),  ////
                categoryCId: $('#categoryCId').val().trim(),  ////
                categoryDId: $('#categoryDId').val().trim(),  ////
                txtModelNumber: ($('#txtModelNumber').val()).trim(),
                txtModelName: $.trim($('#txtModelName').val()),
                txtCompany: $.trim($('#txtCompany').val()),
                txtOriginPrice: $.trim($('#txtOriginPrice').val()),
                txtSellPrice: $.trim($('#txtSellPrice').val()),
                txtEventName: $.trim($('#txtEventName').val()),
                txtExplaination: $.trim($('#txtExplaination').val()),
                txtDescription: $.trim($('#txtDescription').val())
            },
            cache: false,
            async: false,
            success: function (data) {
                if (data != 0) {
                    //products 테이블 인서트시에 리턴된 productId 값을 txtProductNo 에 주입시킨다.
                    $('#txtProductNo').val(data);
                    
                    doSubmitForm2xxx();                
                                                           
                    //alert("상품 등록 완료aaaaaaaaaa...");  //    

                    //submitButton.prop('disabled', false);  //서브밋 버튼을 활성화 시킨다.  //

                    //$('.inputSection').hide();
                    //$('.buttonShowAndHide').show();                   
                }
                else {
                    alert("처리중 에러가 발생...insertProduct...")
                    submitButton.prop('disabled', false);  //서브밋 버튼을 활성화 시킨다.
                }
            },
            error: function (data) {
                alert('시스템에러...insertProduct...')
                submitButton.prop('disabled', false);  //서브밋 버튼을 활성화 시킨다.
            }
        });

        return false;
    }

    //입력한내용보기, 계속입력하기 버튼 클릭 했을때
    $('#goProductDetails').click(function () {
        //아래는 일반적으로 사용하는 파라미터 전달 방법
        //var txtProductId = $('#txtProductNo').val().trim();
        //window.location = '/sllers/productDetails?productId=' + txtProductId;

        //아래는 route(web.php)에 특화된 파라미터 전달 방법
        var txtProductId = $('#txtProductNo').val().trim();
        //window.location = '/product/details/' + txtProductId; //중요한 예제
        window.open ('/product/details/' + txtProductId); //중요한 예제
    });

    $('#continueInput').click(function () {
        $('.categorySection').show() ////
        $('#txtProductNo').val('');
        $('.inputSection').show();
        $('.buttonShowAndHide').hide();
    });
   
    //업로드 하기 전에 원하는 크기로 리사이징한다
    //pictures 테이블에 인서트시키기 위해 멀티로 입력된 업로드될 파일 이름을
    //formData로 가공한다. 또한 파일이 아닌 txtProductNo도 formData에 추가한다.
    function doSubmitForm2xxx() {

        var txtProductId = $('#txtProductNo').val().trim();
              
        //var inputFile = $('input#file');
        //var files = inputFile[0].files;  //for multiple files...
        var files = document.getElementById('file').files;

        function resizeAndUpload(file) {

            //파일 업로드 중 입니다... 메세지 보여주기
            //$('.upload_msg').show();

            // Create a file reader
            var reader = new FileReader();

            reader.addEventListener("load", function (e) {

                var formData = new FormData();

                var img = new Image();  //

                // Create an image
                //var img = document.createElement("img");
                //img.src = e.target.result;
                img.src = this.result;  //

                var canvas = document.createElement("canvas");
                var ctx = canvas.getContext("2d");
                ctx.drawImage(img, 0, 0);

                var width = 460;
                var height = 400;

                canvas.width = width;
                canvas.height = height;
                var ctx = canvas.getContext("2d");
                ctx.drawImage(img, 0, 0, width, height);

                var dataurl = canvas.toDataURL("image/jpeg");
                //document.getElementById('image').src = dataurl;  //위 div 태그에서 그림보여주기

                var blob = dataURLtoBlob(dataurl);

                //formData.append("txtProductNo", $('#txtProductNo').val().trim());

                formData.append("txtProductNo", txtProductId);
                formData.append("file[]", blob, file.name);
                                   
                ////alert("fileName=  " + file.name + "productId=  " + txtProductId);               

                ////아래는 json object를 dynamic하게 만드는 예제이다.06/04/2019
                ////json object는 binary(eg: blob)는 no accept                           
                // var products =  {productData:[]};
                // var fileName = file.name;
                // products.productData.push({
                //     "txtProductNo": txtProductId, 
                //     "fileName": fileName, 
                //     "blob": dataurl
                // });

                                    
                $.ajax({
                    type: 'POST',
                    //아래를 꼭 삽입해야 post로 보낼수 있다...
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    url: "/seller/upload",
                    data: formData,
                    cache: false,
                    //async: false, //이게 있으면 아래의 xhr가 not working...06/04/2019
                    processData: false,
                    contentType: false,

                    xhr: function ()
                    {
                        var jqXHR = null;
                        if ( window.ActiveXObject )
                        {
                            jqXHR = new window.ActiveXObject( "Microsoft.XMLHTTP" );
                        }
                        else
                        {
                            jqXHR = new window.XMLHttpRequest();
                        }
                        //Upload progress                     
                        $('#loader-icon').show(); ////
                        $('#targetLayer').hide(); ////왜 있는지 모름.06/04/2019
                        $('.progress-bar').width('50%'); ////
                        jqXHR.upload.addEventListener( "progress", function ( evt )
                        {
                            if ( evt.lengthComputable )
                            {
                                var percentComplete = Math.round( (evt.loaded * 100) / evt.total );
                                //Do something with upload progress
                                $('.progress-bar').animate({ ////
                                    width: percentComplete + '%' },
                                    {
                                        duration: 1000
                                });
                               
                                // $('#loader-icon').hide(); ////
                                // $('#targetLayer').show(); ////
                                //console.log( 'Uploaded percent', percentComplete );
                            }
                        }, false );
                        //Download progress
                        jqXHR.addEventListener( "progress", function ( evt )
                        {
                            if ( evt.lengthComputable )
                            {
                                var percentComplete = Math.round( (evt.loaded * 100) / evt.total );
                                //Do something with download progress
                                //console.log( 'Downloaded percent', percentComplete );
                            }
                        }, false );

                        return jqXHR;
                    },

                    success: function (data) {
                        if (data == 1) {                            
                            //alert("상품 등록 완료xxxxxxx...");                             
                            $('#txtModelNumber').val("");
                            $('#txtModelName').val("");
                            $('#txtCompany').val("");
                            $('#txtOriginPrice').val("");
                            $('#txtSellPrice').val("");
                            $('#txtEventName').val("");
                            $('#txtExplaination').val("");
                            $('#txtDescription').val("");
                            $('#file').val("");
                            //$('#txtProductNo').val("");
                            $('#preview').empty();
                            $('.categorySection').hide() ////

                            $('#loader-icon').hide(); ////
                            $('#targetLayer').show(); ////                                                     
                            $('.progress-bar').width('0%'); ////                            
                            
                            //파일 업로드 중 입니다... 메세지 숨기기
                            //$('.upload_msg').hide();
                            //input section 숨기기 06/04/2019
                            $('.inputSection').hide();
                            //button section 보여주기
                            $('.buttonShowAndHide').show();

                            submitButton.prop('disabled', false);  //서브밋 버튼을 활성화 시킨다.
                        }
                        else {
                            alert("파일 업로드 실패...");
                            //파일 업로드 중 입니다... 메세지 숨기기
                            //$('.upload_msg').hide();
                            //submitButton.prop('disabled', false);  //서브밋 버튼을 활성화 시킨다.
                        }
                    },
                    error: function (data) {
                        alert('시스템에러.../seller/upload...')
                        //파일 업로드 중 입니다... 메세지 숨기기
                        //$('.upload_msg').hide();
                        //submitButton.prop('disabled', false);  //서브밋 버튼을 활성화 시킨다.
                    }
                });


            }, false);

            reader.readAsDataURL(file);
        }

        if (files) {            
            [].forEach.call(files, resizeAndUpload);          
        }


        //var elements = document.querySelectorAll('.buttons');
        //for (var i = 0; i < elements.length; i++) {
        //    elements[i].addEventListener('click', function () {
        //        console.log(this.innerHTML);
        //    });
        //}



        //for (var i = 0; i < files.length; i++) {
        //    resizeAndUpload(files[i]);
        //    alert("i    " + i);
        //}
        
    }
        
    /* Utility function to convert a canvas to a BLOB */
    var dataURLtoBlob = function (dataURL) {
        var BASE64_MARKER = ';base64,';
        if (dataURL.indexOf(BASE64_MARKER) == -1) {
            var parts = dataURL.split(',');
            var contentType = parts[0].split(':')[1];
            var raw = parts[1];

            return new Blob([raw], { type: contentType });
        }

        var parts = dataURL.split(BASE64_MARKER);
        var contentType = parts[0].split(':')[1];
        var raw = window.atob(parts[1]);
        var rawLength = raw.length;

        var uInt8Array = new Uint8Array(rawLength);

        for (var i = 0; i < rawLength; ++i) {
            uInt8Array[i] = raw.charCodeAt(i);
        }

        return new Blob([uInt8Array], { type: contentType });
    }
    /* End Utility function to convert a canvas to a BLOB      */
</script>


@endsection