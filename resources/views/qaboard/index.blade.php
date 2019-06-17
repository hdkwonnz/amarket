@extends('layouts.app')

@section('title')
    Qaboard-index
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
            padding-top: 3px;
            padding-bottom: 3px;
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

    tr:nth-child(even) { /*alternating-row 관리*/
        background-color: rgba(0, 255, 255, 0.11);
    }

    .number_width {
        width: 5%;
    }

    .date_width {
        width: 10%;
        padding-left: 10px;
        word-break: break-all;
        text-align: left;
    }

    .title_width {
        padding-left: 20px;
        width: 80%;
        word-break: break-all;
        text-align: left;
    }

    .count_width {
        width: 5%;
    }
</style>   

<div class="row" style="margin-right: 0px;">
    <div class="col-sm-12 col-md-12 col-lg-12">
        <table class="webgrid-table" id="checkableGrid">           
            <tbody>              
                @foreach($result as $item)               
                <tr class="webgrid-row-style">
                    <td class="number_width">
                        {{ $item->id }}
                    </td>
                    <td class="date_width">
                        <?php
                            $str = $item->postDate;
                            $str2 = new DateTime(str_replace("_","",$str));
                            $date = $str2->format('Y-m-d');  //날짜
                            $now = date('Y-m-d');
                            if ($date == $now)
                            {
                                //$date = $str2->format('h:i:s');  //시간을 시분초로 표시(am pm 구분없음)
                                $date = $str2->format('h:i A');    //시간을 시분(am pm 구분)
                            }
                            else
                            {
                                $date = $str2->format('Y-m-d');  //날짜
                            }

                        ?>
                        <?=$date?>
                    </td> 
                    <td class="title_width">
                        <input type="hidden" value="<?php echo $item->id?>" id="boardIdAjax" />
                        <!--<a href="/qaboard/show/<?=$item->id?>" target="_blank">-->
                        <a href="/qaboard/show/<?=$item->id?>" target="">
                            <?php

                                //echo $this->qaBoardModel->funcStep($item->step);

                                //지우지 말것...
                                $re = $item->step * 15;
                            ?>
                            <!--여기를 실현하는 방법은 위처럼 function을 이용하는 방법과 아니면
                            아래처럼 html tag를 사용하고 그안에 위에서 계산된 $re 값을 대응
                            시키는 두가지가 있다.지우지 말것...-->
                            <img src=/imageOwner/blank.gif height=0 width=<?=$re?> />
                            <?php
                            if ($re > 0)
                            {
                            ?>
                            <img src=/imageOwner/re.gif />
                            <?php
                            }
                            ?>

                            <!--타이틀을 원하는 글자수 만큼 줄여서 보여주기===>지우지 말것...
                            아래는 모델에 function을 만들어서 하는 방법. 현재는 중단...-->
                            <?php
                                //echo $this->qaBoardModel->funcCutString($item->title, 10)
                            ?>

                            <!--타이틀을 원하는 글자수 만큼 줄여서 보여주기-->
                            <?php
                                if (strlen($item->title) > 7)
                                {
                                    $strTemp = "";
                                    //$strTemp = substr(($item->title),0, 7); //한글에 문제 있음...
                                    $strTemp = mb_substr(($item->title),0, 25, "utf-8");
                                    $strTemp .= "...";

                                    echo $strTemp;
                                }
                                else
                                {
                                    echo $item->title;
                                }
                            ?>

                            <?php
                                $postDate = $item->postDate;  //24시간이 지나지 않았으면  New를 보여준다.
                                $now = date('Y-m-d H:i:s');
                                $t1 = StrToTime($postDate);
                                $t2 = StrToTime($now);
                                $diff = $t2 - $t1;
                                $hours = $diff / (60 * 60);
                                if ($hours <= 24)
                                {
                            ?>
                            <img src=/imageOwner/new.gif alt="new" />
                            <?php
                                }
                            ?>
                        </a>

                    </td>            
                    <td class="count_width">
                        <?=$item->readCount?>
                    </td>
                </tr>                
                @endforeach               
            </tbody>
        </table>
        <br />
        <div>
            {!! $result->render() !!}
        </div>
        
    </div>
</div>

<div class="row">
    <div class="col-sm-1 col-md-1 col-lg-1">
        <!--<a href="/qaboard/create" class="btn btn-primary">글쓰기</a>-->
        <!--<a href="#" class="btn btn-primary go_write" data-toggle="modal" data-target="#dialogForLogin">글쓰기</a>-->
        <a href="#" class="btn btn-primary go_write">글쓰기</a>
    </div>
    <div class="col-sm-3 col-md-3 col-lg-3">
        <form name="form" id="form" action="#" method="get">
            <div class="input-group search_box_color">
                <input type="text" class="form-control" name="qaSearchTerm" id="qaSearchTerm" value="{{old('qasearchTerm') }}" placeholder="검색단어 입력" required />
                <div class="input-group-btn">
                    <button class="btn btn-default" id="btnQaSerach" type="submit" style="font-size: 14px;">
                        <i class="glyphicon glyphicon-search" style="font-size: 13px; color: green;"></i>
                    </button>
                </div>
            </div>
        </form>
    </div>
    <div class="col-sm-3 col-md-3 col-lg-3"></div>
</div>

<!-아래 script를 코멘트하면 jquery가 작동 않함. app.blade.php에 있습에도 불구하구. 원인 모름. 09/03/2019--->
<script src="https://code.jquery.com/jquery-3.1.0.min.js" integrity="sha256-cCueBR6CsyA4/9szpPfrX3s49M9vUU5BgtiJj06wt/s=" crossorigin="anonymous"></script>

<!--글쓰기로 갈때-->
<script>
    $(function () {
        $('.go_write').click(function () {            
            window.location = '/qaboard/create';
        });
    });
</script>

<!--서치할때-->
<script>
    $(function () {
        $('#form').submit(function (e) {
            e.preventDefault();
            var qaSearchTerm = $('#qaSearchTerm').val().trim();
            if (qaSearchTerm == "") {
                alert("내용을 입력하세요...");
                return false;
            }
            if ($('#qaSearchTerm').val().trim().length < 2) {
                $('#qaSearchTerm').focus();
                alert("최소 두글짜를 입력하세요...")
                return false;
            }

            window.location = '/qaboard/search/' + qaSearchTerm;
        });
    });    
</script>

@endsection