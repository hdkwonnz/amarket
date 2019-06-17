@extends('layouts.app')

@section('title')
    show
@endsection

@section('content')

    <!--Ajax에서 사용-->
<input type="hidden" id="boardIdAjax" value="<?php echo $result->id?>" />
<div class="row" style="margin: 0px;">
    <div class="col-sm-7 col-md-7 col-lg-7">
        <span>제목 : </span><?=$result->title?>
    </div>
    <div class="col-sm-2 col-md-2 col-lg-2">
        <span>글번호 : </span><?=$result->id?>
    </div>
    <div class="col-sm-3 col-md-3 col-lg-3" style="text-align: right;">
        <span>작성일 : </span><?=$result->postDate?>
    </div>
</div>
<div class="row" style="margin-right: 0px; margin-top: 10px;">
    <div class="col-sm-12 col-md-12 col-lg-12">
        <div style="border: 1px solid blue; width: 100%; height: 300px; overflow-y: scroll;">
            <?php
            $content = $result->content;                        //아래 $searchTerm은 콘트롤러에서 넘어온 값
            //$content = str_replace($qaSearchTerm, '<span style="color: red;">' . $qaSearchTerm . '</span>', $content);
            //echo $content;
            if (isset($qaSearchTerm))  //서치에서 넘어온 값이 있으면
            {
                //아래 $searchTerm은 콘트롤러에서 넘어온 값
                $content = str_replace($qaSearchTerm, '<span style="color: red;">' . $qaSearchTerm . '</span>', $content);
            }
            echo $content;
            ?>
        </div>
    </div>
</div>
<div class="row" style="margin-top: 35px;">
    <div class="col-sm-12 col-md-12 col-lg-12">
        <a href="/qaboard/create" class="btn btn-primary">글쓰기</a>
        <!--<button type="button" class="btn btn-primary go_write" data-toggle="modal" data-target="#dialogForLogin">글쓰기</button>-->
        <!--<button type="button" class="btn btn-primary go_write">글쓰기</button>-->
        <a href="/qaboard/reply/<?=$result->id?>" class="btn btn-danger" style="margin-left: 30px;">답변</a>
        <!--<a href="#>" class="btn btn-danger go_reply" style="margin-left: 30px;" data-toggle="modal" data-target="#dialogForLogin">답변</a>-->
        <!--<a href="#>" class="btn btn-danger go_reply" style="margin-left: 30px;" data-toggle="modal">답변</a>-->
        <a href="/qaboard/index" class="btn btn-success" style="margin-left: 30px;">목록</a>
        <!--<a href="#" class="btn btn-success qaBoardIndex" style="margin-left: 30px;">목록</a>-->
    </div>
</div>

@endsection