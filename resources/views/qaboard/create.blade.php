@extends('layouts.app')

@section('title')
    qaboard-create
@endsection

@section('content')

<form name="form" id="form" action="#" method="post" class='form-horizontal' enctype="multipart/form-data">

    {{csrf_field() }}

    <div class="row">
        <div class="form-group">
            <label class='col-sm-1 col-md-1 col-lg-1 control-label'>제목</label>
            <div class='col-sm-10 col-md-10 col-lg-10'>
                <input type='text' id='txtTitle' name='txtTitle' class='form-control' maxlength='50' value='{{old(' title') }}' required />
            </div>
        </div>
    </div>
    <div class='row'>
        <div class='form-group'>
            <label class='col-sm-1 col-md-1 col-lg-1 control-label'>내용</label>
            <div class='col-sm-10 col-md-10 col-lg-10'>
                <!--<input type='text' id='txtContent' name='txtContent' class='form-control' value='' required />-->
                <textarea id='txtContent' name='txtContent'>{{old('txtContent') }}</textarea>
            </div>
        </div>
    </div>
    <div class="row">
        <div class='form-group'>
            <div class='col-sm-offset-1 col-md-offset-1 col-lg-offset-1 col-sm-1 col-md-1 col-lg-1'>
                <input type='submit' id="create" name="create" class='btn btn-default btn-primary' value='쓰기' />
            </div>
            <div class='col-sm-offset-1 col-md-offset-1 col-lg-offset-1 col-sm-8 col-md-8 col-lg-8'>
                <a href="/qaboard/index" class="btn btn-success">목록</a>
                <!--<a href="#" class="btn btn-success qaBoardIndex">목록</a>-->
            </div>
        </div>
    </div>
</form>

@if($errors->any())
<div class="alert alert-danger" role="alert">
    <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
    <span class="sr-only">Error:</span>
    @foreach ($errors->all() as $message)
    <p>{{    $message}}</p>
    @endforeach
</div>
@endif

<!--아래 jquery script 코멘트하면 jquery 작동 않함. app.blade.php에 이미 있음에도 불구하고.09/03/2019-->
<script src="https://code.jquery.com/jquery-3.1.0.min.js" integrity="sha256-cCueBR6CsyA4/9szpPfrX3s49M9vUU5BgtiJj06wt/s=" crossorigin="anonymous"></script>
<script src="/lib/ckeditor/ckeditor.js"></script>
<!--<script src="https://cdn.ckeditor.com/4.11.3/standard/ckeditor.js"></script>-->

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
                url: '/qaboard/store',
                headers: { 'X-CSRF-TOKEN': token },
                //headers: {
                //    'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                //},

                data: {

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
                    alert('시스템에러.../qaboard/store')
                }
            });
        });
    });
</script>

@endsection