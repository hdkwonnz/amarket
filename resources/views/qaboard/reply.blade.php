@extends('layouts.app')

@section('title')
    qaboard-reply
@endsection

@section('content')

<!--action="/qaboard/addReply"-->
<form name="form" id="form" action="#" method="post" class='form-horizontal' enctype="multipart/form-data">

    {{csrf_field() }}

    <!--boardId를 Ajax에서 사용하기 위해 숨긴다-->
    <input type="hidden" id="boardId" name="id" value="<?=$result->id?>" />

    <div class="row">
        <div class="form-group">
            <label class='col-sm-1 col-md-1 col-lg-1 control-label'>제목</label>
            <div class='col-sm-8 col-md-8 col-lg-8'>
                <input type='text' id='txtTitle' name='txtTitle' class='form-control' value='Re(NO : <?=$result->id?>) :  <?=$result->title?>' readonly />
            </div>
            <label class='col-sm-1 col-md-1 col-lg-1 control-label'>글번호</label>
            <div class='col-sm-1 col-md-1 col-lg-1'>
                <input type='text' id='txtBoardId' name='txtBoardId' class='form-control' value='<?=$result->id?>' readonly />
            </div>
        </div>
    </div>
    <div class='row'>
        <div class='form-group'>
            <label class='col-sm-1 col-md-1 col-lg-1 control-label'>내용</label>
            <div class='col-sm-10 col-md-10 col-lg-10'>
                <!--<input type='text' id='txtContent' name='txtContent' class='form-control' value='' required />-->
                <textarea id='txtContent' name='txtContent'>
                    질문 내용 : (글번호(<?=$result->id?>)) <?=$result->content?>
                                        {{ old('txtContent') }}
                </textarea>
            </div>
        </div>
    </div>
    <div class="row">
        <div class='form-group'>
            <div class='col-sm-offset-1 col-md-offset-1 col-lg-offset-1 col-sm-1 col-md-1 col-lg-1'>
                <input type='submit' id="create" name="create" class='btn btn-default btn-primary' value='답변' />
            </div>
            <div class='col-sm-offset-1 col-md-offset-1 col-lg-offset-1 col-sm-8 col-md-8 col-lg-8'>
                <a href="/qaboard/index" class="btn btn-success">목록</a>
                <!--<a href="#" class="btn btn-success qaBoardIndex">목록</a>-->
            </div>
        </div>
    </div>
</form>

<script src="https://code.jquery.com/jquery-3.1.0.min.js" integrity="sha256-cCueBR6CsyA4/9szpPfrX3s49M9vUU5BgtiJj06wt/s=" crossorigin="anonymous"></script>
<script src="/lib/ckeditor/ckeditor.js"></script>
<!--CKeditor 사용을 선언-->
<script>
        CKEDITOR.replace('txtContent');
</script>
<!--입역화면 하단의 쓰기 버튼-->
<script>
    $(function () {
        $('#form').submit(function (e) {

            e.preventDefault();

            var txtContent = CKEDITOR.instances.txtContent.getData();  //CKEditor에서 값을 가져온다...

            if (txtContent == "") {
                alert("내용을 입력하세요...");
                return false;
            }

            token = $('input[name=_token]').val().trim();

            $.ajax({
                method: 'post',
                url: '/qaboard/addReply',
                headers: { 'X-CSRF-TOKEN': token },
                //headers: {
                //    'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                //},

                data: {
                    id: $('#boardId').val().trim(),
                    txtTitle: $('#txtTitle').val().trim(),
                    txtContent: txtContent.trim()
                },
                //datatype: 'JSON',
                cache: false,
                async: false,
                success: function (data) {
                    if (data == 1) {
                        alert("입력이 완료되었습니다...");
                        window.location = '/qaboard/index';
                    }
                    else
                        if (data == 0) {
                            alert("입력에 실패 했습니다...");
                        }
                        else {
                            alert(data);
                        }
                },
                error: function (data) {
                    alert('시스템에러.../qaboard/addReply')
                }
            });
        });
    });
</script>

@endsection