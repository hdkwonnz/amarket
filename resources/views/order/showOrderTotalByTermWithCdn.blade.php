
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
        <?php
        $save_orderId = "";
        ?>
        @foreach($orderdetails as $item)
        <?php
        $str = $item->created_at;
        $str2 = new DateTime(str_replace("_","",$str));
        $date = $str2->format('Y-m-d');
        $orderId = $item->order_id;
        ?>
        <tr class="webgrid-row-style">
            <td class="date_width">
                @if ($orderId != $save_orderId)
                <b class="oderDate">
                    <?=$date?>
                </b>
                <br />
                <!--<a href="#" class="btn_details"><div style="background: #ff6a00; width: 58%; text-align: center"><span>DETAILS ></span></div></a>-->
                <a href="#" class="btn_details" data-toggle="modal" data-target=".bs-example-modal-lg">
                    <div style="background: #ff6a00; width: 58%; text-align: center">
                        <div>DETAILS ></div>
                    </div>
                </a>
                <span style="opacity: 0.5;">Order#:</span>
                <span class="order_num" style="opacity: 0.5;">
                    <?=$item->order_id?>
                </span>
                @endif
            </td>
            <td class="info_width">                           
                <?php
                $quantity = $item->quantity; //orderdetails table의 quantity 값
                $price = $item->sellPrice; //orderdetails table의 price 값
                $productId = $item->product_id;  //products table의 id              
                $fileName = $item->product->searchImage; //위에서 얻은 $pictures로 pictures table의 fileName 값
                $modelName = $item->product->modelName;
                ?>
                <table id="table2">
                    <tr>
                        <td class="image_width search_image">
                            <div>
                                {{ $fileName }}
                            </div>
                        </td>
                        <td class="name_width">
                            <input type="hidden" id="productIdAjax" value="<?php echo $productId?>" />
                            <span>
                                <?=$modelName?>
                            </span>
                            <br />
                            <span style="opacity: 0.5;">
                                QTY: <?=$quantity?>개
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
            </td>
        </tr>
        <?php
        $save_orderId = $orderId;
        ?>
        @endforeach
    </tbody>
</table>

<div class="page_footer">
    {!! $orderdetails->render() !!}
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
<script src="/myJs/showOrderTotalByTerm.js"></script>

<!--금액 편집-->
<script>
</script>

<!--세부항목 보기-->
<script>
</script>

<!--Page 번호(Footer)를 클릭했을때 Ajax로 해당 데이터를 보낸다-->
<script>
</script>

<!--아래는 매우 중요 절대 지우지 말 것.13/05/2019-->
<!--이미지값을 trim 해 준다.-->
<script>
</script>
