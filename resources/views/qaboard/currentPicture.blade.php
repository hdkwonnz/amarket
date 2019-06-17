<!--임시코드...-->
<style>
    /*원래 height가 100px 이었는데 이미지 저장시 400 X 400에서
    460 X 400으로 바꾸면서 87px로 변경하였음*/
    #preview img {
        height: 87px;
        width: 100px;
        float: left;
        margin: 3px;
    }

    .selectedImage {
        height: 87px;
        width: 100px;
        float: left;
        margin: 3px;
    }
</style>

<!--이미지 업로드 폼-->
<div class="currentImageShow">
    <!--현재의 이미지 보여주기-->
    <div class="row" style="margin-top: 20px;">
        <div class='col-sm-12 col-md-12 col-lg-12'>
            <div style='float: left; margin-right: 10px;'>
                <span style="">
                    <b>현재의 이미지 </b>
                </span>
            </div>
            <?php
            //$pictures = $product->pictures;
            if ($pictures)
            {
                foreach ($pictures as $item)
                {
            ?>

            <div class="selectedImage">
                <div class="selectedImageShow">
                    <!--<a href="#">-->
                    <!--<img src="http://hdkwonnz.cdn2.cafe24.com/uploadFiles/pictures/sellers/<?=$item->fileName?>" alt="" class="img-responsive" />-->
                    <img src="/uploadFiles/pictures/sellers/<?=$item->fileName?>" class="img-responsive" />
                </div>
                <!--</a>-->
                <span style="display : none" class="selectedProductId">
                    <?=$item->product_id?>
                </span>
                <span style="display : none" class="selectedPictureId">
                    <?=$item->id?>
                </span>
                <span style="display : none" class="selectedFileName">
                    <?=$item->fileName?>
                </span>
                <!--현재의 이미지에 마우스 온하면 X 마크가 생긴다.-->
                <div style="border: 1px solid blue; width: 20px; height: 20px; top: -87px; 
                                right: -78px; z-index: 3; position: relative; background: blue; 
                                text-align: center; display: none;"
                    class="selectedProductClose">
                    <a class="" href="#">
                        <span style="color: white;">X</span>
                    </a>
                </div>               
            </div>            
            <?php
                }
            }
            ?>
            <!--사진 삭제 중 입니다-->
            <div class="delete_msg" style="display: none; color: red;">
                <span>사진 삭제 중 입니다...</span>
            </div>
        </div>
    </div>
</div>

<!--사진추가-->
<div class="row" style="margin-left: 0px; margin-top: 20px;">
    <div class='col-sm-12 col-md-12 col-lg-12'>
        <form name="form2" id="form2" action='#' method='post' class='form-horizontal' enctype="multipart/form-data">
            <div class='row' style="margin-right: 15px;">
                <div class='form-group'>
                    <label class='col-sm-1 col-md-1 col-lg-1 control-label' for='file'>
                        <b>사진추가</b>
                    </label>
                    <div class='col-sm-11 col-md-11 col-lg-11'>
                        <!-- pictures 테이블에 producId를 저장하기위해 prodcuts 테이블 인서트시에 리턴값으로 받아
                             juqery Script submitForm2()에서 값을 주입시킨다.-->
                        <input type="hidden" value="" id="txtProductNo" name="txtProductNo" />
                        <input class='form-control text-box multi-line' type='file' name='file[]' multiple id='file' accept="image/.gif,.jpg,.png" />
                        <output id="filesInfo"></output>
                        <div id="preview"></div><!--선택한 사진을 보여주기 위해 준비(프리뷰)-->
                        <div class="thumbnail_msg"></div><!--썸네일 준비중 메세지 보여주기-->
                    </div>
                </div>
            </div>
            <div class="row">
                <div class='form-group'>
                    <div class='col-sm-offset-1 col-md-offset-1 col-lg-offset-1 col-sm-5 col-md-5 col-lg-5'>
                        <input type='submit' id="upload" name="upload" class='btn btn-default btn-success' value='Upload' />
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>

<!--파일 업로드 중 입니다-->
<div class="row upload_msg" style="display: none; margin-top: 50px; margin-bottom: 50px;">
    <div class='col-sm-12 col-md-12 col-lg-12'>
        <span style="color: red; font-size: 30px;">파일 업로드 중 입니다. 잠시만 기다리세요...</span>
    </div>
</div>

<!--현재이미지에 마우스를 올리면 "X" 마크가 나오고 사진을 삭제 할 수 있음 -->
<script>
    $(function () {
        $('.selectedImage').each(function () {
            $(this).mouseover(function () {
                var saveProduct = $(this); //현재 마우스온 상태인 상품을 세이브한다
                $(this).children().closest('.selectedProductClose').show(); //이미지위에 "X" 마크를 보여준다
                var saveId = ($(this).children().closest('.selectedPictureId').text().trim()); //이미지 아이디를 세이브
                var saveFileName = ($(this).children().closest('.selectedFileName').text().trim()); //이미지 이름을 세이브
                $(this).children().closest('.selectedProductClose').unbind().click(function () {  //"X"마크를 클릭하면 ==> 반드시 "unbind" 사용할것
                    var message = "사진을 제거 하시겠습니다?";
                    var result = confirm(message);
                    //alert(saveId);
                    //alert(saveFileName);
                    if (result == true) {
                        //사진 삭제 중 입니다 메세지 보여주기
                        $('.delete_msg').show();

                        $.ajax({
                            type: "post",
                            //아래를 꼭 삽입해야 post로 보낼수 있다...
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            },
                            url: "/seller/deletePicture",
                            data: { pictureId: saveId, fileName: saveFileName },
                            chche: false,
                            success: function (data) {
                                if (data == 1)
                                {
                                    //$(saveProduct).hide();//위 에서 해당상품을 삭제후 숨긴다.
                                    //window.location.reload();
                                    currentPictureShow();
                                }
                                else
                                {
                                    alert("이미지 삭제 실패...")
                                }
                            },
                            error: function (data) {
                                alert("/seller/deletePicture 02_시스템에러...");
                            }
                        });
                    }
                });
            });

            $(this).mouseout(function () { //상품 이미지에서 마우스가 아웃되면 "X"마크를 숨긴다
                $(this).children().closest('.selectedProductClose').hide();
            });
        });
    });
</script>

<!--업로드된 상품보기 버튼 누르면...업로드된 이미지가 보인다.-->
<script>
    $(function () {
        $('.refreshButton').click(function () {
            $(this).hide();
            currentPictureShow();
            //window.location.reload();
            //$('.currentImageShow').show();
            $('.imageUploadSection').show();
        });
    });

    //업로드된 이미지가 보여주기
    function currentPictureShow()
    {
        var productId = $('.currentProductId').text().trim();

        $.ajax({
            type: "get",
            url: "/seller/currentPicture",
            data: { productId: productId },
            chche: false,
            success: function (data) {
                $('.imageUploadSection').empty().append(data);
            },
            error: function (data) {
                alert("/seller/currentPicture 02_시스템에러...");
            }
        });
    }
</script>

<!--업로드할 파일의 preview 와 width, height, size, 이미지 갯수 체크를 한다-->
<script>
    window.URL = window.URL || window.webkitURL;
    var elBrowse = document.getElementById("file"),
        elPreview = document.getElementById("preview"),
        useBlob = false && window.URL; // `true` to use Blob instead of Data-URL

    //내가추가: 기존에 몇개의 이미지가 있는지 체크(중요한 예제)
    var numOfPictures = 0;
    var saveProductId = $('.currentProductId').text().trim(); //상품 아이디
    $.ajax({
        type: "get",
        url: "/seller/countPicture",
        data: { productId: saveProductId },
        chche: false,
        success: function (data) {
            if (data.success == true) {
                numOfPictures = data.count;
            }
        },
        error: function (data) {
            alert("/seller/countPicture 시스템에러...");
        }
    });

    // 2.
    function readImage (file) {

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

                ////내가 추가 : 사이즈 체크      //1024 byte * 1024 * 2 = 2,097,152 byte(2MB)
                //if (file.size > 2097152) {   //1024 byte * 1024 * 2.5 = 2,621,440 byte(2.5MB)
                //    alert(file.name + ' => Filesize must 2MB or below');
                //    $('#preview').empty();
                //    $('#file').val('');
                //    return;
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

                ////내개 추가 했음...
                //if (files.length > 3)
                //{
                //    alert("3개 까지 업로드 할 수 있습니다...");
                //    $('#preview').empty();
                //    $('#file').val('');
                //    return;
                //}

                //기존 이미지 갯수 와 업로드하려는 갯수를 합산
                if ((files.length + numOfPictures) > 3)
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

<script>
    //파일 업로드 버튼을 누르면 이미지 업로드 시작
    $(function () {
        $('#form2').submit(function (event) {

            submitButton = $(this).find("input[type='submit']");

            submitButton.prop('disabled', true);  //버튼을 누른 후에는 더이상 작동하지 않는다.

            if (($('#file').val()).trim() == "") {
                alert("Please choose Picture(s) to Upload...");
                submitButton.prop('disabled', false);  //서브밋 버튼을 활성화 시킨다.
                return false;
            }

            doSubmitForm2xxx();  //이미지 업로드

            //alert("파일 업로드 완료...");

            $('#file').val('');
            $('#preview').empty();
            //('.currentImageShow').hide();
            $('.imageUploadSection').hide();
            //$('.refreshButton').show();

            return false;
        });
    });

    //pictures 테이블에 인서트시키기 위해 멀티로 입력된 업로드될 파일 이름을
    //formData로 가공한다. 또한 파일이 아닌 txtProductNo도 formData에 추가한다.
    function doSubmitForm2xxx() {

        //var txtProductId = $('#txtProductNo').val().trim();
        var txtProductId = $('.currentProductId').text().trim();

        //var inputFile = $('input#file');
        //var files = inputFile[0].files;  //for multiple files...
        var files = document.getElementById('file').files;

        function resizeAndUpload(file) {

            //파일 업로드 중 입니다... 메세지 보여주기
            $('.upload_msg').show();

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
                //alert("fileName=  " + file.name + "productId=  " + txtProductId);
                $.ajax({
                    type: 'POST',
                    //아래를 꼭 삽입해야 post로 보낼수 있다...
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    url: "/seller/upload",
                    data: formData,
                    cache: false,
                    async: false,
                    processData: false,
                    contentType: false,
                    success: function (data) {
                        if (data == 1) {
                            //alert("상품 등록 완료...");
                            //$('#txtModelNumber').val("");
                            //$('#txtModelName').val("");
                            //$('#txtCompany').val("");
                            //$('#txtOriginPrice').val("");
                            //$('#txtSellPrice').val("");
                            //$('#txtEventName').val("");
                            //$('#txtExplaination').val("");
                            //$('#txtDescription').val("");
                            //$('#file').val("");
                            //$('#txtProductNo').val("");
                            //$('#preview').empty();

                            //파일 업로드 중 입니다... 메세지 숨기기
                            $('.upload_msg').hide();
                            //업로드된 이미지 보기 버튼 보여주기
                            $('.refreshButton').show();

                            submitButton.prop('disabled', false);  //서브밋 버튼을 활성화 시킨다.
                        }
                        else {
                            alert("파일 업로드 실패...");
                            //파일 업로드 중 입니다... 메세지 숨기기
                            $('.upload_msg').hide();
                            submitButton.prop('disabled', false);  //서브밋 버튼을 활성화 시킨다.
                        }
                    },
                    error: function (data) {
                        alert('시스템에러...insertPictures...');
                        //파일 업로드 중 입니다... 메세지 숨기기
                        $('.upload_msg').hide();
                        submitButton.prop('disabled', false);  //서브밋 버튼을 활성화 시킨다.
                    }
                });


            }, false);

            reader.readAsDataURL(file);
        }

        if (files) {
            [].forEach.call(files, resizeAndUpload);
        }
    }
</script>
