
<link href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.css" rel="stylesheet" />

<!--Table CSS-->
<style type="text/css">
    .webgrid-table {
        font-family: "Trebuchet MS", Arial, Helvetica, sans-serif;
        font-size: 1.2em;
        width: 100%;
        display: table;
        border-collapse: separate;
    }

    .webgrid-table th {
        background: rgba(128, 128, 128, 0.25);
    }

    .webgrid-table td {
        /*border-bottom: solid 1px rgba(128, 128, 128, 0.26);*/ /*및줄귿기*/
        padding-top: 0px;
        padding-bottom: 10px;
    }

    .date_width, .info_width {
        border-bottom: solid 1px rgba(128, 128, 128, 0.26); /*및줄귿기*/
    }

    .webgrid-header {
        padding-bottom: 4px;
        padding-top: 5px;
        text-align: left;
    }

    .webgrid-footer {
    }

    .webgrid-row-style td {
    }

    .webgrid-alternating-row {
    }

    .date_width {
        width: 14%;
        word-break: break-all;
        vertical-align: top;
    }

    .info_width {
        width: 86%;
        word-break: break-all;
    }

    .image_width {
        width: 15%;
        border-bottom: none;
        padding-top: 0px;
        padding-bottom: 0px;
    }

    .name_width {
        width: 60%;
        border-bottom: none;
        word-break: break-all;
    }

    .recipient_width {
        width: 15%;
        word-break: break-all;
    }

    .confirm_width {
        width: 10%;
        word-break: break-all;
    }
</style>

<!--startDate 와 endDate를 Ajax에서 사용하기위해 숨긴다: 콘트롤러에서 넘어온값이다-->
<div>
    <input type="hidden" value="<?=$startDate2?>" id="startDate2" />
    <input type="hidden" value="<?=$endDate2?>" id="endDate2" />
</div>

<?php
if ($numRows < 1)
    echo "<span style='color: red; font-size: 25px; '>
                    검색을 원하시는 상품이 없습니다...</span><br />";
?>
<?php
//상품평 쓰기에서 사용
$oneMonthBeforeYMD = date("Y-m-d", strtotime("-15 days"));  //한달전 YYYYMMDD      
?>

<table class="webgrid-table" id="table1" style="padding-right: 15px" ;>    
    <tbody>
        @foreach($orders as $item)
        <?php
        $str = $item->orderDate;
        $str2 = new DateTime(str_replace("_","",$str));
        $date = $str2->format('Y-m-d');
        ?>
        <tr class="webgrid-row-style">
            <td class="date_width">
                <b class="oderDate">
                    <?=$date?>
                </b>
                <br />
                <!--<a href="#" class="btn_details"><div style="background: #ff6a00; width: 58%; text-align: center"><span>DETAILS ></span></div></a>-->
                <a href="#" class="btn_details" data-toggle="modal" data-target=".bs-example-modal-lg">
                    <div style="background: #ff6a00; width: 58%; text-align: center">
                        <span>DETAILS ></span>
                    </div>
                </a>
                <span style="opacity: 0.5;">Order#:</span>
                <span class="order_num" style="opacity: 0.5;">
                    <?=$item->id?>
                </span>
            </td>
            <td class="info_width">
                <?php
                $details = $item->orderdetails; //Order model에서 orderdetails function call
                ?>
                @foreach($details as $detail)
                <?php
                $quantity = $detail->quantity; //orderdetails table의 quantity 값
                $price = $detail->price; //orderdetails table의 price 값
                $product = $detail->product; //Orderdetail 모델에서 product function call
                $productId = $product->id; //products table의 id
                $pictures = $product->pictures->first(); //Product model에서 picture function call.첫번째 row
                $fileName = $pictures->fileName; //위에서 얻은 $pictures로 pictures table의 fileName 값
                $modelName = $detail->product->modelName; //Orderdetail 모델에서 product function call하여 midelName 값
                ?>
                <table id="table2">
                    <tr>
                        <td class="image_width">
                            <div>
                                <img style="width: 100%; height: 100%; padding-left: 0px;" src="/uploadFiles/pictures/sellers/<?=$fileName?>" class="img-responsive">
                                <!--<img style="width: 100%; height: 100%; padding-left: 0px;" src="http://hdkwonnz.cdn2.cafe24.com/uploadFiles/pictures/sellers/<?=$fileName?>" class="img-responsive" />-->
                            </div>
                        </td>
                        <td class="name_width">
                            <input type="hidden" id="productIdAjax" value="<?php echo $productId?>" />
                            <span>
                                <?=$modelName?>
                            </span>
                            <br />
                            <span style="opacity: 0.5;">
                                QTY: <?=$quantity?> EA
                            </span>
                            <br />
                            <span style="font-size: 17px;" class="totalPrice_txt">
                                <?=$price * $quantity?>
                            </span>
                            <span>원</span>
                        </td>
                        <td class="recipient_width">
                            <span>추후생성</span>
                        </td>
                        <td class="confirm_width">
                            <?php
                            if($date >= $oneMonthBeforeYMD)
                            {
                            ?>
                            <a href="/products/initReview?productId=<?=$productId?>" class="btn btn-primary">
                                프리미엄
                                <br />
                                상품평쓰기
                            </a>
                            <?php
                            }
                            ?>
                        </td>
                    </tr>
                </table>
                @endforeach
            </td>
        </tr>
        @endforeach
    </tbody>
</table>

<div class="page_footer">
    {!! $orders->render() !!}
</div>


<!-- Large modal -->
<!--<button type="button" class="btn btn-primary" data-toggle="modal" data-target=".bs-example-modal-lg2">Large modal</button>-->
<div class="modal fade bs-example-modal-lg2" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <!--<button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <div class='col-sm-4 col-md-4 col-lg-4'></div>
                <div class='col-sm-5 col-md-5 col-lg-5'>
                    <h4 class="modal-title" id="myLargeModalLabel" style="color: blue;">주문상세</h4>
                </div>-->

                <div class='col-sm-11 col-md-11 col-lg-11' style="padding-left: 0px;">
                    <div style="background-color: blue; color: white; line-height: 30px;
                                border: 1px solid blue; min-height: 30px; width: 110%;
                                vertical-align: central;"
                        class="modal-title" id="myLargeModalLabel">
                        <span style="font-size: 20px; margin-right: 10px; margin-left: 10px;">주문상세</span>
                        <span style="margin-left: 10px;">
                            >
                            <span class="modal_oderDate"></span>
                        </span>
                        <span style="margin-left: 10px;">
                            주문번호 :
                            <span class="modal_orderId"></span>
                        </span>
                    </div>
                </div>
                <div class='col-sm-1 col-md-1 col-lg-1' style="padding-left: 0px;">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                </div>
            </div>

            <!--아래 div tag는 원래 modal form에는 없으나 controller에서 테이터가 전송되기 전에-->
            <!--메시지를 보여주기 위해 임의 적으로 추가 하였음. 추후 혹시 문제가 될 수도 있음.04/Mar/2019-->
            <div class="modalNotice" style="display: none; margin-left: 15px;">
                <span>데이터를 로드 중입니다...</span>
            </div>

            <div class="modal-body">
                <!--Ajax에서 data가 들어온다...-->

                

            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<!--script-->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script
    src="https://code.jquery.com/ui/1.11.4/jquery-ui.min.js"
    integrity="sha256-xNjb53/rY+WmG+4L6tTl9m6PpqknWZvRt0rO1SRnJzw="
    crossorigin="anonymous"></script>

<!--금액 편집-->
<script>
    $(function () {
        $('.totalPrice_txt').each(function () {
            var txtValue = "";
            txtValue = formatNumber($(this).text());
            $(this).text(txtValue);
        })
    });

    //편집하는 함수
    function formatNumber(num) {
        return num.toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, "$1,")
    }
</script>

<!--세부항목 보기-->
<script>
    $(function () {
        $('.btn_details').click(function () {
            $('.modalNotice').show()  //데이터를 로딩 중... 메시지 보여주기
            $('.modal-body').empty()  //전에 보여준 화면을 clear 한다
            ////alert($(this).next().next().text())
            var orderId = $(this).next().next().text().trim();
            var oderDate = $(this).prev().prev().text();
            ////    alert("ssssssssss " + orderId);

            //아래처럼 윈도우를 새로 열다가 모달다이얼로그로 바꾸었음.
            //아래 Ajax에서 data를 전송받아 모달로 다시 전송한다.
            //window.open('/orders/showOrderDetailsByChild?orderId=' + orderId, 'PopupWindow2', 'resizable=no,scrollbars=yes,width=600px,height=600px');

            $.ajax({
                type: "get",
                url: "/order/showOrderDetailsByChild",
                data: { orderId: orderId, oderDate: oderDate },
                success: function (data) {
                    $('.modal_oderDate').empty().append(oderDate);
                    $('.modal_orderId').empty().append(orderId);
                    $('.modalNotice').hide(); //데이터를 로딩 중... 메시지 숨기기
                    $('.modal-body').empty().append(data);
                    $('.bs-example-modal-lg2').modal();
                },
                error: function (data) {
                    alert("/order/showOrderDetailsByChild 시스템에러...")
                }
            });           
        });
    });
</script>

<!--Page 번호(Footer)를 클릭했을때 Ajax로 해당 데이터를 보낸다-->
<script>
    $(function () {
        $('.page_footer').on('click', 'a', function () {
            if (this.href == "") { return; } //잘못 클릭했을 경우 아무것도 하지 않는다...
            var sDate = $('#startDate2').val().trim(); //위에서 숨겨놓은 값을 참조한다...////
            var eDate = $('#endDate2').val().trim();   //위에서 숨겨놓은 값을 참조한다...////
            $.ajax({
                url: this.href,
                type: 'GET',
                data: { startDate: sDate, endDate: eDate },
                cache: false,
                success: function (data) {
                    $('#partialContent').html(data);
                    //alert(data);
                    //$('#partialContent').empty().append(data); //이렇게 코딩해도 실행된다...
                    //debugger;
                },
                error: function () {
                    alert("errors from ShowOrderTotalByTermPv...");
                }
            });
            return false;
        });
    });
</script>