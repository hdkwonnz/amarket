@extends('layouts.seller')

@section('title')
Seller-modifyProduct
@endsection

@section('content')

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

<!--판매할 상품 수정-->
<div class="row" style="margin-right: 0px;">
    <div class='col-sm-12 col-md-12 col-lg-12'>
        <div style="border-top: 2px solid blue; min-height: 40px; 
                    line-height: 40px; vertical-align: central;
                    background-color: rgba(128, 128, 128, 0.42);
                    margin-top: 10px; margin-bottom: 10px;"
            class="text-center">
            <span style="font-size: 25px;">판매할 상품 수정</span>
        </div>
    </div>
    <div class='col-sm-12 col-md-12 col-lg-12'>
        <div class="noticeWords">
            <!--<span style="color: blue;" class="blink_me">카테고리를 선택하세요...</span>-->
            <span style="color: blue;" class="">수정할 카테고리를 선택하세요...</span>
        </div>
    </div>
</div>

<!--카테고리 A-->
<div class="categorySection">
    <div class="row" style="margin-right: 0px;">
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
        <!--Ajax에서 데이터를 로드한다.-->
        <div class="categoryBSection"></div>
        <div class="categoryCSection"></div>
        <div class="categoryDSection"></div>
    </div>
</div>

<?php
    $modelNumber = $product->modelNumber;
    $modelName = $product->modelName;
    $company = $product->company;
    $originPrice = $product->originPrice;
    $sellPrice = $product->sellPrice;
    $eventName = $product->eventName;
    $explaination = $product->explaination;
    $description = $product->description;

    $productId = $product->id;
    $categoryAId = $product->categorya_id;
    $categoryBId = $product->categoryb_id;
    $categoryCId = $product->categoryc_id;
    $categoryDId = $product->categoryd_id;

    //Model Product에서 categorya,b,c,d를 콜 한후 field name을 가져옴.
    $categoryAname = $product->categorya->name;
    $categoryBname = $product->categoryb->name;
    $categoryCname = $product->categoryc->name;
    $categoryDname = $product->categoryd->name;
?>

<div style="display: none;" class="currentProductId">
    <?=$productId?>
</div>

<!--현재의 카테고리 ==>-->
<div class="row" style="margin-top: 20px;">
    <div class='col-sm-12 col-md-12 col-lg-12'>
        <div style='float: left; margin-right: 10px;'>
            <span style="">
                <b>현재의 카테고리 ==> </b>
            </span>
        </div>
        <div style='float: left; margin-right: 10px;' class="">
            <?=$categoryAname?>
        </div>
        <div style='float: left; margin-right: 10px;' class="">> </div>
        <div style='float: left; margin-right: 10px;' class="">
            <?=$categoryBname?>
        </div>
        <div style='float: left; margin-right: 10px;' class="">> </div>
        <div style='float: left; margin-right: 10px;' class="">
            <?=$categoryCname?>
        </div>
        <div style='float: left; margin-right: 10px;' class="">> </div>
        <div style='float: left; margin-right: 10px;' class="">
            <?=$categoryDname?>
        </div>
        <div style='clear: both;'></div>
    </div>
</div>

<!--수정된 카테고리 ==>-->
<div class="row" style="margin-top: 20px;">
    <div class='col-sm-12 col-md-12 col-lg-12'>
        <div style='float: left; margin-right: 5px;'>
            <span style="color: red;">
                <b>수정된 카테고리 ==> </b>
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

<!--입력 섹션-->
<div class="inputSection" style="">
    <!--이미지 업로드 폼-->
    <div class="imageUploadSection">
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
                    $pictures = $product->pictures;
                    if ($pictures)
                    {
                        foreach ($pictures as $item)
                        {
                    ?>

                    <div class="selectedImage">
                        <!--<a href="#">-->
                        <div class="selectedImageShow">
                            <!--<img src="http://hdkwonnz.cdn2.cafe24.com/uploadFiles/pictures/sellers/<?=$item->fileName?>" alt="" class="img-responsive" />-->
                            <img src="/uploadFiles/pictures/sellers/<?=$item->fileName?>" alt="<?=$item->fileName?>" class="img-responsive" />
                            <!--</a>-->
                        </div>
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
                                <div style="border: 1px solid blue; width: 20px; height: 20px;">
                                    <span style="color: white;">X</span>
                                </div>
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
    </div>

    <!--파일 업로드 중 입니다-->
    <div class="row upload_msg" style="display: none; margin-top: 50px; margin-bottom: 50px;">
        <div class='col-sm-12 col-md-12 col-lg-12'>
            <span style="color: red; font-size: 30px;">파일 업로드 중 입니다. 잠시만 기다리세요...</span>
        </div>
    </div>

    <!--업로드된 이미지 보기 버튼-->
    <div class="row refreshButton" style="display: none; margin-top: 10px;">
        <div>
            <div class='col-sm-offset-1 col-md-offset-1 col-lg-offset-1 col-sm-5 col-md-5 col-lg-5'>
                <button type="button" id="refresh" class='btn btn-default btn-success'>
                    업로드된 이미지 보기
                </button>
            </div>
        </div>
    </div>

    <!--상품내역 입력 폼-->
    <div class="row" style="margin-left: 0px; margin-right: 15px;">
        <div class='col-sm-12 col-md-12 col-lg-12'>
            <!--action 지정시 sublime texter하고 다름. 'products/insertProducts' 라고 쓰지 말것...-->
            <form name="form1" id="form1" action='#' method='post' class='form-horizontal' enctype="multipart/form-data">
                <div class="form-group">
                    <input type="hidden" value="<?=$categoryAId?>" id="categoryAId" name="categoryAId" />
                    <input type="hidden" value="<?=$categoryBId?>" id="categoryBId" name="categoryBId" />
                    <input type="hidden" value="<?=$categoryCId?>" id="categoryCId" name="categoryCId" />
                    <input type="hidden" value="<?=$categoryDId?>" id="categoryDId" name="categoryDId" />
                </div>

                <div class='row'>
                    <div class='form-group'>
                        <label class='col-sm-1 col-md-1 col-lg-1 control-label'>상품 번호</label>
                        <div class='col-sm-5 col-md-5 col-lg-5'>
                            <input type='text' id='txtModelNumber' name='txtModelNumber' class='form-control' maxlength='50' value='<?php echo $modelNumber; ?>' required />
                        </div>
                        <label class='col-sm-1 col-md-1 col-lg-1 control-label'>상품 이름</label>
                        <div class='col-sm-5 col-md-5 col-lg-5'>
                            <input type='text' id='txtModelName' name='txtModelName' class='form-control' maxlength='50' value='<?php echo $modelName; ?>' required />
                        </div>
                    </div>
                </div>

                <div class='row'>
                    <div class='form-group'>
                        <label class='col-sm-1 col-md-1 col-lg-1 control-label'>제조 회사</label>
                        <div class='col-sm-5 col-md-5 col-lg-5'>
                            <input type='text' id='txtCompany' name='txtCompany' class='form-control' maxlength='50' value='<?php echo $company; ?>' required />
                        </div>
                        <label class='col-sm-1 col-md-1 col-lg-1 control-label'>상품 가격</label>
                        <div class='col-sm-5 col-md-5 col-lg-5'>
                            <input type='number' id='txtOriginPrice' name='txtOriginPrice' class='form-control' value='<?php echo $originPrice; ?>' min='0.1' step="0.01" required />
                        </div>
                    </div>
                </div>

                <div class='row'>
                    <div class='form-group'>
                        <label class='col-sm-1 col-md-1 col-lg-1 control-label'>판매 가격</label>
                        <div class='col-sm-5 col-md-5 col-lg-5'>
                            <input type='number' id='txtSellPrice' name='txtSellPrice' class='form-control' value='<?php echo$sellPrice; ?>' min='0.1' step="0.01" required />
                        </div>
                        <label class='col-sm-1 col-md-1 col-lg-1 control-label'>행사 이름</label>
                        <div class='col-sm-5 col-md-5 col-lg-5'>
                            <input type='text' id='txtEventName' name='txtEventName' class='form-control' maxlength='30' value='<?php echo $eventName; ?>' required />
                        </div>
                    </div>
                </div>

                <div class='row'>
                    <div class='form-group'>
                        <label class='col-sm-1 col-md-1 col-lg-1 control-label'>상품 설명</label>
                        <div class='col-sm-5 col-md-5 col-lg-5'>
                            <!--아래는 반드시 한 줄로 표기해야 한다. 그렇지 않을 경우 내용의 앞 여러 칸이 비어진 상태로 보여진다-->                          
                            <textarea id='txtExplaination' name='txtExplaination' class='form-control' rows="10" required>{{ $explaination }}</textarea>                                                          
                        </div>
                        <label class='col-sm-1 col-md-1 col-lg-1 control-label'>상세 설명</label>
                        <div class='col-sm-5 col-md-5 col-lg-5'>
                            <!--아래는 반드시 한 줄로 표기해야 한다. 그렇지 않을 경우 내용의 앞 여러 칸이 비어진 상태로 보여진다-->                        
                            <textarea id='txtDescription' name='txtDescription' class='form-control' rows="10" required>{{ $description }}</textarea>                                                                                           
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class='form-group'>
                        <div class='col-sm-offset-1 col-md-offset-1 col-lg-offset-1 col-sm-2 col-md-2 col-lg-2'>
                            <input type='button' id="cancel" name="cancel" class='btn btn-danger' value='cancel' />
                        </div>
                        <div class='col-sm-offset-1 col-md-offset-1 col-lg-offset-1 col-sm-5 col-md-5 col-lg-5'>
                            <input type='submit' id="register" name="register" class='btn btn-default btn-primary' value='Submit' />
                        </div>
                    </div>
                </div>
            </form>            
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.1.0.min.js" integrity="sha256-cCueBR6CsyA4/9szpPfrX3s49M9vUU5BgtiJj06wt/s=" crossorigin="anonymous"></script>

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
                                alert("/seller/deletePicture 01_시스템에러...");
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
                alert("/seller/currentPicture 01_시스템에러...");
            }
        });
    }
</script>

<!--<img src="" id="image">--><!--리사이즈 할 때 그림 보여주기. 아래 jquery에서 사용-->
<!--<input id="input" type="file" multiple onchange="handleFiles()">-->

<!--멀티파일 프리뷰예제 ==> 지우지 말것-->
<!--<input id="browse" type="file" onchange="previewFiles()" multiple>
<div id="previewA"></div>-->
<!--멀티파일 프리뷰예제 ==> 지우지 말것-->
<script>
    //function previewFiles() {

    //    var preview = document.querySelector('#previewA');
    //    //var files = document.querySelector('input[type=file]').files;
    //    var files = document.getElementById('browse').files;

    //    function readAndPreview(file) {

    //        // Make sure `file.name` matches our extensions criteria
    //        if (/\.(jpe?g|png|gif)$/i.test(file.name)) {
    //            var reader = new FileReader();

    //            reader.addEventListener("load", function () {
    //                var image = new Image();
    //                image.height = 100;
    //                image.title = file.name;
    //                image.src = this.result;
    //                preview.appendChild(image);
    //            }, false);

    //            reader.readAsDataURL(file);
    //        }

    //    }

    //    if (files) {
    //        [].forEach.call(files, readAndPreview);
    //    }

    //}
</script>


<!--리사이즈예제임 ==> 지우지 말것...-->
<script>
//function handleFiles()
//{
    //var filesToUpload = document.getElementById('input').files;
    //var fileA = filesToUpload[0];

    //// Create an image
    //var img = document.createElement("img");
    //// Create a file reader
    //var reader = new FileReader();
    //////Load files into file reader
    ////reader.readAsDataURL(file);
    //// Set the image once loaded into file reader
    //    reader.onload = function(e)
    //    {
    //        img.src = e.target.result;

    //        var canvas = document.createElement("canvas");
    //        //var canvas = $("<canvas>", {"id":"testing"})[0];
    //        var ctx = canvas.getContext("2d");
    //        ctx.drawImage(img, 0, 0);

    //        //var MAX_WIDTH = 400;
    //        //var MAX_HEIGHT = 300;
    //        //var width = img.width;
    //        //var height = img.height;

    //        var MAX_WIDTH = 400;
    //        var MAX_HEIGHT = 300;
    //        var width = 400;
    //        var height = 400;

    //        //if (width > height) {
    //        //  if (width > MAX_WIDTH) {
    //        //    height *= MAX_WIDTH / width;
    //        //    width = MAX_WIDTH;
    //        //  }
    //        //} else {
    //        //  if (height > MAX_HEIGHT) {
    //        //    width *= MAX_HEIGHT / height;
    //        //    height = MAX_HEIGHT;
    //        //  }
    //        //}

    //        canvas.width = width;
    //        canvas.height = height;
    //        var ctx = canvas.getContext("2d");
    //        ctx.drawImage(img, 0, 0, width, height);

    //        var dataurl = canvas.toDataURL("image/png");
    //        document.getElementById('image').src = dataurl;
    //    }
    //    // Load files into file reader
    //    reader.readAsDataURL(fileA);  //위 부분으로 옮겨도 된다.

    /////////////////////////////////////////////////////////////////////////////////////

    //var filesToUpload = document.getElementById('input').files;
    //for (var i = 0; i < filesToUpload.length; i++) {
    //    var fileB = filesToUpload[i];

    //    // Create an image
    //    var img = document.createElement("img");
    //    // Create a file reader
    //    var reader = new FileReader();
    //    ////Load files into file reader
    //    //reader.readAsDataURL(file);
    //    // Set the image once loaded into file reader
    //    reader.onload = function (e) {
    //        img.src = e.target.result;

    //        var canvas = document.createElement("canvas");
    //        //var canvas = $("<canvas>", {"id":"testing"})[0];
    //        var ctx = canvas.getContext("2d");
    //        ctx.drawImage(img, 0, 0);

    //        //var MAX_WIDTH = 400;
    //        //var MAX_HEIGHT = 300;
    //        //var width = img.width;
    //        //var height = img.height;

    //        var MAX_WIDTH = 400;
    //        var MAX_HEIGHT = 300;
    //        var width = 400;
    //        var height = 400;

    //        //if (width > height) {
    //        //  if (width > MAX_WIDTH) {
    //        //    height *= MAX_WIDTH / width;
    //        //    width = MAX_WIDTH;
    //        //  }
    //        //} else {
    //        //  if (height > MAX_HEIGHT) {
    //        //    width *= MAX_HEIGHT / height;
    //        //    height = MAX_HEIGHT;
    //        //  }
    //        //}

    //        canvas.width = width;
    //        canvas.height = height;
    //        var ctx = canvas.getContext("2d");
    //        ctx.drawImage(img, 0, 0, width, height);

    //        var dataurl = canvas.toDataURL("image/png");
    //        document.getElementById('image').src = dataurl;
    //    }
    //    // Load files into file reader
    //    reader.readAsDataURL(fileB);  //위 부분으로 옮겨도 된다.

    //}


    // Post the data
    /*
    var fd = new FormData();
    fd.append("name", "some_filename.jpg");
    fd.append("image", dataurl);
    fd.append("info", "lah_de_dah");
    */
//}
</script>


<!--업로드할 파일의 preview 와 width, height, size, 이미지 갯수 체크를 한다-->
<script>
    window.URL = window.URL || window.webkitURL;
    var elBrowse = document.getElementById("file"),
        elPreview = document.getElementById("preview"),
        useBlob = false && window.URL; // `true` to use Blob instead of Data-URL

    //내가추가: 기존에 몇개의 이미지가 있는지 체크
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

                ////파일 사이즈 체크
                ////내가 추가                   //1024 byte * 1024 * 2 = 2,097,152 byte(2MB)
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

<!--화면상단의 카테고리A를 클릭하면 카테고리B가 만들어진다.
    이때 기존에 존재하던 카테고리B,C,D 섹션은 모두 지운다.-->
<script>
    function selectCategoryB(id, name)
    {
        $('.noticeWords').show();
        $('.inputSection').hide();

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

<!--<script> 
    //화면이 로드됨 과 동시에 Model Number에 커서거 놓여진다
    $(function () {
        $('#txtModelNumber').focus();      
    });
</script>-->

<!--blink 기능 구현-->
<script>
    function blinker() {
        $('.blink_me').fadeOut(500);
        $('.blink_me').fadeIn(500);
    }
    setInterval(blinker, 1000); //Runs every second
</script>

<!--입역화면 하단의 cancel 버튼을 누르면 내용이 리로드된다.-->
<script>
    $(function () {
        $('#cancel').click(function () {
            window.location.reload();
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

            submitForm1();

            return false;

        });
    });

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
            //$('.currentImageShow').hide();
            $('.imageUploadSection').hide();
            //$('.refreshButton').show();

            return false;
        });
    });

    //products 테이블 수정
    function submitForm1() {
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

        updateProductByAjax();
    }

    //입력 데이터를 콘트롤(product/updateProduct) 으로 보낸다.
    function updateProductByAjax()
    {
        productId = $('.currentProductId').text().trim();

        $.ajax({
            type: 'POST',
            //아래를 꼭 삽입해야 post로 보낼수 있다...
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url: "/seller/updateProduct",
            data: {
                productId: productId,
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
                if (data == 1) {
                    alert("상품 수정 완료...");  //
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
                    submitButton.prop('disabled', false);  //서브밋 버튼을 활성화 시킨다.  //
                    return false;
                }
                else {
                    alert("상품 수정 실패...")
                    submitButton.prop('disabled', false);  //서브밋 버튼을 활성화 시킨다.
                }
            },
            error: function (data) {
                alert('시스템에러.../seller/updateProduct...')
                submitButton.prop('disabled', false);  //서브밋 버튼을 활성화 시킨다.
            }
        });

        return false;
    }
    
    //업로드 하기 전에 원하는 크기로 리사이징한다
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
                        alert('시스템에러.../seller/upload...');
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