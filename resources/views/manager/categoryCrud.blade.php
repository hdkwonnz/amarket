@extends('layouts.admin')

@section('title')
manager-categoryCrud
@endsection

@section('content')

<div class="displaySection">
    <div class="row" style="margin-right: 0px; margin-top: 10px; margin-bottom: 10px;">
        <div class="col-sm-12 col-md-12 col-lg-12 text-center">
            <div style="border-top: 2px solid blue; min-height: 40px; 
                    line-height: 40px; vertical-align: central;
                    background-color: rgba(128, 128, 128, 0.42);">
                <span style="font-size: 25px;">모든 카테고리 보기 </span>
            </div>
        </div>
    </div>
    <!--<div class="row" style="margin-right: 0px; margin-top: 10px; margin-bottom: 10px;">
        <div class="col-sm-12 col-md-12 col-lg-12">
            <a href="/admin/categoryCrud" style="font-size: 20px;">
                <span>초기화면으로 > </span>
            </a>
        </div>
    </div>-->

    <div class="row" style="margin-right: 0px;">
        <div class="col-sm-3 col-md-3 col-lg-3">
            <span style="font-size: 20px;">
                <b>카테고리 A</b>
            </span>
            <div style="height: 400px; width: 100%; overflow-y: auto;
                    border: 1px solid blue;">
                
                @foreach ($categoryas as $item)               
                <div style='margin-top: 5px; margin-left: 10px;'>
                    <!--<a href="/admin/selectCategoryBCD?id=<?=$item->categoryAId?>" style='font-size: 20px;'>-->
                    <a href='#' style='font-size: 20px; float: left;' onclick="selectCategoryBCD(<?=$item->id?>); return false;">
                        <div class='hoverLightBlue clickA' style='border: 1px solid white; width: 100%; min-height: 30px;'>
                            <?=$item->name?>
                        </div>
                    </a>                                                                <!--onclick으로 string type 보낼때 반드시 ''을 사용할것-->
                    <a href="#" class="modifyName" style="float:left; margin-left: 5px;" onclick="modifyCategoryA(<?=$item->id?>, '<?=$item->name?>'); return false;">
                        <span>수정</span>
                    </a>
                    <a href="#" class="deleteName" style="float:left; margin-left: 3px;" onclick="deleteCategoryA(<?=$item->id?>, '<?=$item->name?>'); return false;">
                        <span>삭제</span>
                    </a>
                </div>
                <div style="clear: both;"></div>
                @endforeach

            </div>
        </div>
        <div class="col-sm-3 col-md-3 col-lg-3">
            <span style="font-size: 20px;">
                <b>카테고리 B</b>
            </span>
            <div style="height: 400px; width: 100%; overflow-y: auto;
                    border: 1px solid blue;">
                <?php
                foreach($categorybs as $item) {
                ?>

                <div style='margin-top: 5px; margin-left: 10px;'>
                    <!--<a href="/admin/selectCategoryACD?id=<?=$item->categoryAId?>&id2=<?=$item->categoryBId?>" style='font-size: 20px;'>-->
                    <a href='#' style='font-size: 20px;' onclick="selectCategoryACD(<?=$item->categorya_id?>, <?=$item->id?>); return false;">
                        <div class='hoverLightBlue' style='border: 1px solid white; width: 100%; min-height: 30px;'>
                            <?=$item->name?>
                        </div>
                    </a>
                </div>

                <?php
                }
                ?>
            </div>
        </div>
        <div class="col-sm-3 col-md-3 col-lg-3">
            <span style="font-size: 20px;">
                <b>카테고리 C</b>
            </span>
            <div style="height: 400px; width: 100%; overflow-y: auto;
                    border: 1px solid blue;">
                <?php
                foreach($categorycs as $item) {
                ?>

                <div style='margin-top: 5px; margin-left: 10px;'>
                    <!--<a href="/admin/selectCategoryABD?id=<?=$item->categoryAId?>&id2=<?=$item->categoryBId?>&id3=<?=$item->categoryCId?>" style='font-size: 20px;'>-->
                    <a href='#' style='font-size: 20px;' onclick="selectCategoryABD(<?=$item->categorya_id?>, <?=$item->categoryb_id?>, <?=$item->id?>); return false;">
                        <div class='hoverLightBlue' style='border: 1px solid white; width: 100%; min-height: 30px;'>
                            <?=$item->name?>
                        </div>
                    </a>
                </div>

                <?php
                }
                ?>
            </div>
        </div>
        <div class="col-sm-3 col-md-3 col-lg-3">
            <span style="font-size: 20px;">
                <b>카테고리 D</b>
            </span>
            <div style="height: 400px; width: 100%; overflow-y: auto;
                    border: 1px solid blue;">
                <?php
                foreach($categoryds as $item) {
                ?>

                <div style='margin-top: 5px; margin-left: 10px;'>
                    <!--<a href="/admin/selectCategoryABC?id=<?=$item->categoryAId?>&id2=<?=$item->categoryBId?>&id3=<?=$item->categoryCId?>&id4=<?=$item->categoryDId?>" style='font-size: 20px;'>-->
                    <a href='#' style='font-size: 20px;' onclick="selectCategoryABC(<?=$item->categorya_id?>, <?=$item->categoryb_id?>, <?=$item->categoryc_id?>, <?=$item->id?>); return false;">
                        <div class='hoverLightBlue' style='border: 1px solid white; width: 100%; min-height: 30px;'>
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
    <div class="row" style="margin-right: 0px; margin-top: 10px; margin-bottom: 10px;">
        <div class="col-sm-12 col-md-12 col-lg-12 text-center">
            <div style="border-top: 2px solid blue; min-height: 40px; 
                    line-height: 40px; vertical-align: central;
                    background-color: rgba(128, 128, 128, 0.42);">
                <span style="font-size: 25px;">카테고리 입력하기</span>
            </div>
        </div>
    </div>
    <div class="row" style="margin-right: 0px; margin-top: 10px; margin-bottom: 10px;">
        <div class="col-sm-12 col-md-12 col-lg-12 text-center">
            <div class="inputSection">
                <form action="#" method="post" name="form" id="form">
                    <span style="color: red;">
                        <b>카테고리A 이름</b>&nbsp;&nbsp;
                    </span>
                    <input type="text" id="txtCategoryA" required />
                    <button type="submit" class="buttonA">확인</button>
                </form>
            </div>
        </div>
    </div>
</div>

<!--수정화면 위한 모달-->
<div class="modal fade" tabindex="-1" role="dialog" aria-labelledby="gridSystemModalLabel" id="modifyModal">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <div class='col-sm-4 col-md-4 col-lg-4'></div>
                <div class='col-sm-7 col-md-7 col-lg-7'>
                    <h4 class="modal-title" id="gridSystemModalLabel">카테고리 이름을 수정하세요</h4>
                </div>
            </div>
            <div class="modal-body">
                <!--action="/account/loginByAjax"-->
                <form name="form" id="form" action="#" method="post" class='form-horizontal' enctype="multipart/form-data">
                    <div class="row">
                        <div class="form-group">
                            <input type="hidden" id="idAjax" value="" />
                            <label class='col-sm-4 col-md-4 col-lg-4 control-label'>카테고리A 이름</label>
                            <div class='col-sm-5 col-md-5 col-lg-5'>
                                <input type='text' id='txtName' name='txtName' class='form-control' maxlength='15' value="{{old('txtName') }}" required />
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class='form-group'>
                            <div class='col-sm-offset-4 col-md-offset-4 col-lg-offset-4 col-sm-2 col-md-2 col-lg-2'>
                                <button type='button' id="create" name="create" class='btn btn-default btn-danger' data-dismiss="modal">
                                    취소
                                </button>
                            </div>
                            <div class='col-sm-offset-1 col-md-offset-1 col-lg-offset-1 col-sm-2 col-md-2 col-lg-2'>
                                <button type='submit' id="create" name="create" class='btn btn-default btn-primary' onclick="updateCategoryA(); return false;">
                                    확인
                                </button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <!--<div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" id="create" name="create">Save changes</button>
            </div>-->
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->

<!--삭제화면 위한 모달-->
<div class="modal fade" tabindex="-1" role="dialog" aria-labelledby="gridSystemModalLabel" id="deleteModal">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <div class='col-sm-4 col-md-4 col-lg-4'></div>
                <div class='col-sm-7 col-md-7 col-lg-7'>
                    <h4 class="modal-title" id="gridSystemModalLabel">다음 카테고리를 삭제합니다</h4>
                </div>
            </div>
            <div class="modal-body">
                <!--action="/account/loginByAjax"-->
                <form name="form" id="form" action="#" method="post" class='form-horizontal' enctype="multipart/form-data">
                    <div class="row">
                        <div class="form-group">
                            <input type="hidden" id="idDelAjax" value="" />
                            <label class='col-sm-4 col-md-4 col-lg-4 control-label'>카테고리A 이름</label>
                            <div class='col-sm-5 col-md-5 col-lg-5'>
                                <input type='text' id='txtDelName' name='txtName' class='form-control' maxlength='15' value="{{old('txtName') }}" required />
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class='form-group'>
                            <div class='col-sm-offset-4 col-md-offset-4 col-lg-offset-4 col-sm-2 col-md-2 col-lg-2'>
                                <button type='button' id="create" name="create" class='btn btn-default btn-danger' data-dismiss="modal">
                                    취소
                                </button>
                            </div>
                            <div class='col-sm-offset-1 col-md-offset-1 col-lg-offset-1 col-sm-2 col-md-2 col-lg-2'>
                                <button type='submit' id="create" name="create" class='btn btn-default btn-primary' onclick="deleteUpdateCategoryA(); return false;">
                                    확인
                                </button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <!--<div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" id="create" name="create">Save changes</button>
            </div>-->
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->

<script>
    function modifyCategoryA(id, name)
    {
        $('.modifyName').attr("data-toggle", "modal");
        $('.modifyName').attr("data-target", "#modifyModal");
        $('#txtName').empty().val(name);
        $('#idAjax').val(id);
        $('#modifyModal').modal(show); //show를 넣어야함
    }

    function deleteCategoryA(id, name)
    {
        $('.deleteName').attr("data-toggle", "modal");
        $('.deleteName').attr("data-target", "#deleteModal");
        $('#txtDelName').empty().val(name);
        $('#idDelAjax').val(id);
        $('#deleteModal').modal(show); //show를 넣어야함
    }

    function updateCategoryA()
    {
        var name = $('#txtName').val().trim();
        var id = $('#idAjax').val().trim();
        //alert(name + "   " + id);
        $.ajax({
            type: "post",
            //아래를 꼭 삽입해야 post로 보낼수 있다...
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url: "/manager/updateCategoryA",
            data: { id: id, name: name },
            chche: false,            
            success: function (data) {
                if (data == 1)
                {
                    alert("수정 완료...");
                    window.location.reload();
                }
                else
                {
                    alert("수정 실패...");
                }

            },
            error: function (data) {
                alert("/manager/updateCategoryA 시스템에러...");
            }
        });
    }

    function deleteUpdateCategoryA()
    {
        var name = $('#txtDelName').val().trim();
        var id = $('#idDelAjax').val().trim();
        //alert(name + "   " + id);
        $.ajax({
            type: "post",
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url: "/manager/deleteCategoryA",
            data: { id: id, name: name },
            chche: false,
            success: function (data) {
                if (data == 1) {
                    alert("삭제 완료...");
                    window.location.reload();
                }
                else {
                    alert("삭제 실패(하위 카테고리가 있습니다)...");
                }

            },
            error: function (data) {
                alert("/manager/deleteCategoryA 시스템에러...");
            }
        });
    }
</script>

<script>
    function selectCategoryBCD(id)
    {       
        $.ajax({
            type: "get",
            cache: false,
            url: "/manager/selectCategoryBCD",
            data: { id: id },
            chche: false,
            success: function (data) {
                $('.displaySection').empty().append(data);
            },
            error: function (data) {
                alert("/manager/selectCategoryBCD 시스템에러...");
            }
        });
    }

    function selectCategoryACD(id, id2) {       
        $.ajax({
            type: "get",
            url: "/manager/selectCategoryACD",
            data: { id: id, id2: id2 },
            cache: false,
            success: function (data) {
                $('.displaySection').empty().append(data);
            },
            error: function (data) {
                alert("/manager/selectCategoryACD 시스템에러...");
            }
        });
    }

    function selectCategoryABD(id, id2, id3) {
        $.ajax({
            type: "get",
            url: "/manager/selectCategoryABD",
            data: { id: id, id2: id2, id3: id3 },
            chche: false,
            success: function (data) {
                $('.displaySection').empty().append(data);
            },
            error: function (data) {
                alert("/manager/selectCategoryABD 시스템에러...");
            }
        });
    }

    function selectCategoryABC(id, id2, id3, id4) {
        $.ajax({
            type: "get",
            url: "/manager/selectCategoryABC",
            data: { id: id, id2: id2, id3: id3, id4: id4 },
            chche: false,
            success: function (data) {
                $('.displaySection').empty().append(data);
            },
            error: function (data) {
                alert("/manager/selectCategoryABC 시스템에러...");
            }
        });
    }
</script>

<script>
    $(function () {
        $('#form').submit(function () {
            var name = $('#txtCategoryA').val().trim();
            if (name.length < 1)
            {
                alert("한글자 이상 입력하세요...");
                return;
            }

            $.ajax({
                type: "post",
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: "/manager/insertCategoryA",
                data: { txtCategoryA: name },
                chche: false,
                success: function (data) {
                    if (data == 1) {
                        alert("등록 완료...");
                        //$('#txtCategoryA').val('');
                        window.location.reload();
                    }
                    else {
                        alert("등록 실패...");
                    }
                },
                error: function (data) {
                    alert("/manager/insertCategoryA 시스템에러...");
                }
            });
            return false;

        });
    });
</script>

@endsection