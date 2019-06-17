@extends('layouts.app')

@section('title')
Shoppingcart-cartList
@endsection

@section('content')

<link href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.11.4/jquery-ui.css" rel="stylesheet" />

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
            border-bottom: solid 1px rgba(128, 128, 128, 0.26);
            padding-top: 10px;
            padding-bottom: 10px;
        }

    .webgrid-header {
        padding-bottom: 4px;
        padding-top: 5px;
        text-align: left;
    }

    .webgrid-footer {
    }

    .webgrid-row-style {
    }

    .webgrid-alternating-row {
    }

    .checkbox_width {
        width: 6%;
        padding-left: 10px;
    }

    .image_width {
        width: 10%;
    }

    .title_width {
        width: 40%;
        padding-left: 10px;
        word-break: break-all;
        text-align: left;
    }

    .quantity_width {
        width: 19%;
    }

    .price_width {
        width: 15%;
    }

    .productInfo {
        width: 59%;
        text-align: center;
    }

    .delivery_width {
        width: 10%;
    }
</style>

<style>
    #table1 {
        width: 100%;
        margin-bottom: 20px;
    }

        #table1 tr {
            line-height: 70px;
            width: 100%;
            background-color: rgba(0, 148, 255, 0.13);
        }

        #table1 .td1 {
            font-size: 30px;
            width: 60%;
            padding-left: 10px;
        }

        #table1 .td2 {
            font-size: 20px;
            width: 10%;
            color: blue;
        }

        #table1 .td3 {
            font-size: 20px;
            width: 5%;
            opacity: 0.3;
        }

        #table1 .td4 {
            font-size: 20px;
            width: 10%;
            opacity: 0.3;
        }

        #table1 .td5 {
            font-size: 20px;
            width: 5%;
            opacity: 0.3;
        }

        #table1 .td6 {
            font-size: 20px;
            width: 10%;
            opacity: 0.3;
        }
</style>

<?php
$originSumPrice = 0;
$originGrandTotal = 0;
$sumPrice = 0;
$grandTotal = 0;
?>

<!--<a href="/home/index">Home</a>&nbsp;&nbsp;&nbsp; > &nbsp;&nbsp;-->
<a href="/">Home</a>&nbsp;&nbsp;&nbsp; > &nbsp;&nbsp;
<a href="#">
    <b>cartList</b>
</a>
<br />

<div class="row" style="margin-right: 0px;">
    <div class='col-sm-12 col-md-12 col-lg-12'>
        <table id="table1">
            <tr>
                <td class="td1">
                    장바구니
                </td>
                <td class="td2">
                    장바구니
                </td>
                <td class="td3">
                    >
                </td>
                <td class="td4">
                    주문결제
                </td>
                <td class="td5">
                    >
                </td>
                <td class="td6">
                    주문완료
                </td>
            </tr>
        </table>
    </div>
</div>

<div class="display_section">
    <div class='col-sm-12 col-md-12 col-lg-12' style="padding-left: 0px;">
        <?php
        if ($numRows < 1)
            echo "<span style='color: red; font-size: 25px; '>
                    검색을 원하시는 상품이 없습니다...</span>";
        ?>

        <table class="webgrid-table" id="checkableGrid">
            <thead>
                <tr class="webgrid-header">
                    <!--<th class="checkbox_width">{checkall}</th>-->
                    <th class="checkbox_width">
                        <input type="checkbox" id="cbSelectAll" />삭제
                    </th>
                    <th colspan="2" class="productInfo">상 품 내 역</th>
                    <th class="quantity_width">수 량</th>
                    <th class="price_width">가 격</th>
                    <th class="delivery_width">배송정보</th>
                </tr>
            </thead>
            <tbody>
                <?php
                foreach($carts as $item) {
                    //$cartId = $item->id;
                    //$product = $item->product; //Shoppingcart model class에서 product function call
                    //$modelName = $product->modelName;
                    //$originPrice = $item->originPrice;
                    //$sellPrice = $item->sellPrice;
                    ////18/04/2019
                    ////$pictures = $product->pictures->first(); //$product(Product model class에서 pictures function call
                    //$fileName = $product->searchImage; ////18/04/2019

                    $cartId = $item->cartId;
                    $modelName = $item->modelName;
                    $originPrice = $item->originPrice;
                    $sellPrice = $item->sellPrice;
                    $fileName = $item->searchImage;
                ?>
                <tr class="webgrid-row-style">
                    <td class="checkbox_width">
                        <input type="checkbox" name="cartIds" id="" class="cartIds" value="<?=$item->id?>" />
                    </td>
                    <td class="image_width">
                        <!--<a href="/product/detailsWithCdn/{{ $item->productId }}" target="_blank">-->
                        <a href="/product/detailsWithCdn/{{ $item->productId }}">
                            <?=$fileName?>
                        </a>
                    </td>
                    <td class="title_width">
                        <!--<a href="/product/detailsWithCdn/{{ $item->productId }}" target="_blank">-->
                        <a href="/product/detailsWithCdn/{{ $item->productId }}">
                            <?=$modelName?>
                        </a>
                    </td>
                    <td class="quantity_width">
                        <span class="spinner">
                            <input class="orderQty" name="orderQty" value="<?=$item->quantity?>" readonly style="width: 30px;" />개
                        </span>
                    </td>
                    <td class="price_width">
                        <span style="display: none;" class="originPrice">
                            <?=$originPrice * $item->quantity?>
                        </span>
                        <?php
                    $originSumPrice = $originPrice * $item->quantity;
                    $originGrandTotal = $originGrandTotal + $originSumPrice;
                    $sumPrice = $sellPrice * $item->quantity;
                    $grandTotal = $grandTotal + $sumPrice;

                    $discountRate = round((100 - (($sellPrice * $item->quantity) /
                                            ($originPrice * $item->quantity) * 100)),2);
                        ?>

                        <span class="originPrice_txt" style="text-decoration: line-through; font-size: 12px;"></span>원
                        <span style="color: blue;">
                            <?=$discountRate?>%
                            <i class="glyphicon glyphicon-arrow-down" style="font-size: 12px;"></i>
                        </span>
                        <br />
                        <span style="display: none;" class="sellPrice">
                            <?=$sellPrice * $item->quantity?>
                        </span>
                        <span class="sellPrice_txt" style="font-size: 20px;"></span>원

                        <!--ProcductId를 Ajax에서 사용하기위하여 save해 놓는다...-->
                        <span style="display: none;" class="productIdxx">
                            <?=$item->productId?>
                        </span>
                        <span style="display: none;" class="cartIdxx">
                            <?=$cartId?>
                        </span>
                    </td>
                    <td class="delivery_width">
                        2,500원
                    </td>
                </tr>
                <?php
                }
                ?>
            </tbody>
        </table>
        <br />
    </div>
</div>

<div class='col-sm-12 col-md-12 col-lg-12' style="padding-left: 10px;">
    <input type="checkbox" id="cbSelectAll2" value="" />
    <button type="button" class="btn btn-sm btn-danger delete_selected">삭제</button>
</div>

<div class="page_footer">
    {!! $carts->render() !!}

</div>

<div class='col-sm-12 col-md-12 col-lg-12' style="padding-left: 0px;">
    <div class="col-sm-8 col-md-8 col-lg-8">
        <hr class="hr_thicker" />
    </div>
    <div class="col-sm-4 col-md-4 col-lg-4">
        <hr style="margin-bottom: 0px;" />
        <div style="width: 100%; border-top: solid 2px #0026ff; border-bottom: solid 2px #0026ff; border-left: solid 2px #0026ff; border-right: solid 2px #0026ff;">
            <div class="text-center" style="background: #0026ff; color: white; font-size: 25px;">
                <span>결제 예정 금액</span>
            </div>

            <div class="row" style="font-size: 20px; margin-top: 10px;">
                <div class="col-sm-6 col-md-6 col-lg-6">
                    <b>&nbsp;&nbsp;-상품가격:</b>
                </div>
                <div class="col-sm-6 col-md-6 col-lg-6 originGrandTotal_Text">
                    <?=$originGrandTotal?>
                    <span>원</span>
                </div>
                <!--Ajax에서 사용하기위해 숨긴다...-->
                <div style="display: none;" class="originGrandTotal_Text2">
                    <?=$originGrandTotal?>
                </div>
            </div>
            <hr style="margin: 10px;" />
            <div class="row" style="font-size: 20px; margin-top: 10px;">
                <div class="col-sm-6 col-md-6 col-lg-6">
                    <b>&nbsp;&nbsp;-할인금액:</b>
                </div>
                <div class="col-sm-6 col-md-6 col-lg-6 grandTotal_Text">
                    <?=$grandTotal?>
                    <span>원</span>
                </div>
            </div>
            <hr style="margin: 10px;" />
            <div class="row" style="font-size: 20px; margin-top: 10px;">
                <div class="col-sm-6 col-md-6 col-lg-6">
                    <b>&nbsp;&nbsp;-배송비:</b>
                </div>
                <div class="col-sm-6 col-md-6 col-lg-6">
                    xxx.xxx.xx
                </div>
            </div>
            <hr style="margin: 10px;" />
            <div class="row" style="font-size: 20px; margin-top: 10px;">
                <div class="col-sm-4 col-md-4 col-lg-4"></div>
                <div class="col-sm-8 col-md-8 col-lg-8">
                    <span style="color: red; font-size: 30px;">
                        <b>x.xxx.xxx.xx</b>
                    </span>
                </div>
            </div>
        </div>
    </div>
</div>

<hr />
<div class="row">
    <div class="col-sm-4 col-md-4 col-lg-4"></div>
    <div class="col-sm-4 col-md-4 col-lg-4">
        <a href="javascript:void()" style="font-size: 35px;" class="btn btn-lg btn-primary order_and_pay">주문 결제</a>
    </div>
    <div class="col-sm-4 col-md-4 col-lg-4"></div>
</div>
<br />
<br />

<script
    src="https://code.jquery.com/jquery-2.2.4.min.js"
    integrity="sha256-BbhdlvQf/xTY9gja0Dq3HiwQF8LaCRTXxZKRutelT44="
    crossorigin="anonymous"></script>
<!--<script src="/lib/jquery-ui-1.11.4.custom/jquery-ui.min.js"></script>-->
<script
    src="https://code.jquery.com/ui/1.11.4/jquery-ui.min.js"
    integrity="sha256-xNjb53/rY+WmG+4L6tTl9m6PpqknWZvRt0rO1SRnJzw="
    crossorigin="anonymous"></script>

<!--금액 편집-->
<script>
    $(function () {
        $('.originPrice').each(function () {
            var txtValue = "";
            txtValue = formatNumber($(this).text());
            $(this).next().empty().append(txtValue);
        })

        $('.sellPrice').each(function () {
            var txtValue = "";
            txtValue = formatNumber($(this).text());
            $(this).next().empty().append(txtValue);
        })

        var txtValue = "";
        txtValue = formatNumber($('.originGrandTotal_Text').text());
        $('.originGrandTotal_Text').text(txtValue);

        var txtValue = "";
        txtValue = formatNumber($('.grandTotal_Text').text());
        $('.grandTotal_Text').text(txtValue);

    });

    //편집하는 함수
    function formatNumber(num) {
        return num.toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, "$1,")
    }
</script>

<!--아래는 절대로 지우지 말것. spinner 사용시 에러가 나옴-->
<script>
    $('.orderQty').spinner({ //갯수 박스에 대한 스피너 UI를 선언한다.(반드시 현 위치 해야 한다...)
        min: 1,
        max: 20,
        step: 1
    });
</script>

<!--테이블 체크박스 선택에 대한 코드-->
<script>
    $(function () {
        //테이블 상 하에 있는 체크박스(전체선택)
        $("#cbSelectAll").bind("click", function () {
            var ischecked = this.checked;
            $('#checkableGrid').find("input:checkbox").each(function () {
                this.checked = ischecked;
            });
            $('#cbSelectAll2').each(function () {    //삭제버튼 옆에있는 체크박스도 동시에 바꾸어준다.
                this.checked = ischecked;
            })
        });

        //각각의  행에 있는 체크박스를 선택(개별선택)
        $("input[name='cartIds']").click(function () {
            var totalRows = $("#checkableGrid td :checkbox").length;
            var checked = $("#checkableGrid td :checkbox:checked").length;
            //alert('totalRows = ' + totalRows + 'checked = ' + checked);/////
            if (checked == totalRows) {
                $("#checkableGrid").find("input:checkbox").each(function () {
                    this.checked = true;
                    $('#cbSelectAll2').each(function () {    //삭제버튼 옆에있는 체크박스도 동시에 바꾸어준다.
                        this.checked = true;
                    })
                });
            }
            else {
                $('#cbSelectAll').each(function () {    //헤더에 있는 체크박스도 동시에 바꾸어준다.
                    this.checked = false;
                })
                $('#cbSelectAll2').each(function () {    //삭제버튼 옆에있는 체크박스도 동시에 바꾸어준다.
                    this.checked = false;
                })
                //$("#cbSelectAll").removeAttr("checked");
                //$("#cbSelectAll2").removeAttr("checked"); //삭제버튼 옆에있는 체크박스도 동시에 바꾸어준다.
            }
        });

        //삭제버튼 옆에있는 체크박스를 클릭시 헤더에있는 체크박스도 동시에 바꾸어준다.
        $("#cbSelectAll2").bind("click", function () {
            var ischecked = this.checked;
            $('#checkableGrid').find("input:checkbox").each(function () {
                this.checked = ischecked;
            });
            $('#cbSelectAll').each(function () {    //
                this.checked = ischecked;
            })
        });
    });
</script>

<!--Quantity 조정에 따른 Total Price 구하는 코드-->
<!--체크된 아이템을 딜리트하는 코드(삭제 버튼을 눌렀을때)-->
<script>
    ////Quantity 조정에 따른 Total Price 구하는 코드
    $(function () {
        $('td .selectQty').each(function (i) {
            $(this).change(function () {
                productId = $(this).parent().parent().find('.productIdxx').text().trim();  //productId ////
                cartId = $(this).parent().parent().find('.cartIdxx').text().trim();  //cartId ///
                qty = $(this).val().trim(); //selected value  ////
                //debugger;
                $.ajax({
                    type: "Post",
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    url: "/shoppingcart/changeToCart",
                    data: { productId: productId, cartId: cartId, quantity: qty },  //productId, quantity 는 콘트롤에서 똑같이 사용해야 한다.
                    success: function (data) {
                        if (data != 1) {
                            alert(data);
                        }
                        else {
                            window.location.reload();
                        }
                        //debugger;
                    },
                    error: function (data) {
                        alert(data + "  /shoppingcart/changeToCart 시스템에러...");
                        //debugger;
                    }
                });
            });
        });
    });

    //////////////////////////////////////////////////////////////////////
    ////체크된 아이템을 딜리트하는 로직(삭제 버튼을 눌렀을때)
    $(function () {
        var sw = "";
        $('.delete_selected').click(function () {
            $('td .cartIds').each(function () {
                if ($(this).prop('checked') == true) {
                    sw = 'Y'
                }
            });

            if (sw == "Y") {
                var message = "Do you want to delete selected item(s)?";
                var result = confirm(message);
                if (result == true) {
                    deleteItems();  //
                }
            }
            else {
                alert("Please select any item(s)...");
            }

        });
    });

    //어레이로 포스트한다.
    function deleteItems() {
        var arrayIds = [];
        $('.cartIds:checked').each(function () {
            var ids = $(this).val().trim();
            arrayIds.push(ids);
        });

        $.ajax({
            type: "Post",
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url: "/shoppingcart/deleteSelected",
            data: { ids: arrayIds },
            cache: false,
            async: false,
            success: function (data) {
                if (data != 1) {
                    alert(data);
                }
                else {
                    window.location.reload();
                }
            },
            error: function (data) {
                alert("/shoppingcart/deleteSelected 시스템에러...");
            }
        });
    }


    ////json으로 post 할 경우...지우지말것
    //function deleteItems() {
    //    var arrayIds = [];
    //    $('.cartIds').each(function () {
    //        var ids = $(this).val().trim();
    //        arrayIds.push({"ids": ids});  ////
    //    });

    //    arrayIds = JSON.stringify({ 'arrayIds': arrayIds });

    //    $.ajax({
    //        type: "Post",
    //        contentType: "json",
    //        processData: false,
    //        headers: {
    //            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    //        },
    //        url: "/shoppingcart/deleteSelected",
    //        data: arrayIds,
    //        cache: false,
    //        async: false,
    //        success: function (data) {
    //            if (data != 1) {
    //                alert(data);
    //            }
    //            else {
    //                window.location.reload();
    //            }
    //        },
    //        error: function (data) {
    //            alert("/shoppingcart/deleteSelected 시스템에러...");
    //        }
    //    });
    //}
</script>

<script>
    //주문결제 클릭시 코드
    $(function () {
        var orgnGT = $('.originGrandTotal_Text2').text().trim();  ////
        $('.order_and_pay').click(function () {
            if (orgnGT == 0) {
                alert("장바구니가 비었습니다...")
                $('.loader').hide();//loding spinner를 숨긴다.26/04/2019
            }
            else {
                window.location.href = '/order/orderPaymentForWebGrid';  //
            }
        });
    });
</script>

@endsection
