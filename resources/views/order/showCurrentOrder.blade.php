@extends('layouts.app')

@section('title')
Order - showCurrentOrder
@endsection

@section('content')

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

    .image_width {
        width: 12%;
    }

    .title_width {
        width: 56%;
        padding-left: 10px;
        word-break: break-all;
        text-align: left;
    }

    .quantity_width {
        width: 15%;
    }

    .price_width {
        width: 17%;
    }
</style>

<a href="/home/index">Home</a>&nbsp;&nbsp;&nbsp; > &nbsp;&nbsp;
<a href="#">
    <b>showCurrentOrder</b>
</a>
<br />

<!--추후에 많은 수정을 해야함...13/05/2019-->

<?php
if (!($orderDetails))
    echo "<span style='color: red; font-size: 25px; '>
                    검색을 원하시는 상품이 없습니다...</span>";
?>

<div class='col-sm-12 col-md-12 col-lg-12' style="padding-left: 0px;">    
    <table class="webgrid-table" id="checkableGrid">
        <thead>
            <tr class="webgrid-header">
                <th class="image_width">IMAGE</th>
                <th class="title_width">PRDUCT NAME</th>
                <th class="quantity_width">QTY</th>
                <th class="price_width">PRICE</th>
            </tr>
        </thead>
        <tbody>
            <?php 
            $index = 0;
            foreach($orderDetails as $item) {
                $modelName = $item->modelName;
                $fileName = $item->searchImage;
            ?>

            @if ($index == 0)
            <tr>
                <td colspan="4">
                    <div class="row">
                        <div class="col-sm-4 col-md-4 col-lg-4" style="color: blue; font-size: 20px;">
                            주문날짜 : {{ $item->orderDate }}
                        </div>
                        <div class="col-sm-6 col-md-6 col-lg-6 totalPrice_txt" style="color :blue; font-size: 20px;">
                            주문총금액 : {{ $item->totalPrice }}
                            <span>원</span>
                        </div>
                    </div>
                </td>
            </tr>
            @endif

            <tr class="webgrid-row-style">
                <td class="image_width">
                    <a href="/product/details/{{ $item->productId }}" target="_blank" class="search_image">
                       {{ $fileName }}
                    </a>
                </td>
                <td class="title_width">
                    <a href="/product/details/{{ $item->productId }}" target="_blank">
                        <?=$modelName?>
                    </a>
                </td>
                <td class="quantity_width">
                    <?=$item->quantity?>
                </td>
                <td class="price_width">
                    <span class="sellPrice_txt">
                        <?=$item->sellPrice * $item->quantity?>
                    </span>
                    <span>원</span>
                </td>
            </tr>
            <?php
                $index++;
            }
            ?>
        </tbody>
    </table>
    <br />
</div>

<div class="page_footer">



</div>

<!--script-->

<!--금액 편집-->
<script>
    $(function () {
        $('.sellPrice_txt').each(function () {
            var txtValue = "";
            txtValue = formatNumber($(this).text());
            $(this).text(txtValue);
        })

        var txtValue = "";
        txtValue = formatNumber($('.totalPrice_txt').text());
        $('.totalPrice_txt').empty().append(txtValue);
    });

    //편집하는 함수
    function formatNumber(num) {
        return num.toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, "$1,")
    }
</script>

<!--아래는 매우 중요 절대 지우지 말 것.13/05/2019-->
<!--이미지값을 trim 해 준다.-->
<script>
        $(function () {
            $('.search_image').each(function () {
                trimedText = ($(this).text().trim());
                $(this).empty().append(trimedText);
            })
        });
</script>
@endsection
