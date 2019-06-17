@extends('layouts.app')

@section('title')
    search
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
        width: 80%;
        word-break: break-all;
        text-align: left;
    }

    .count_width {
        width: 5%;
    }
</style>

<div class="row">
    <div class="col-sm-12 col-md-12 col-lg-12">
        <span style='font-size: 15px; '>
            검색한 단어 :
            <span style="color: blue; ">
                <?= "$qaSearchTerm" ;?>
            </span>
            <span>
                (<?="$numRows"?>)건
            </span>
        </span>
    </div>
</div>

<div class="row" style="margin-right: 0px;">
    <div class="col-sm-12 col-md-12 col-lg-12">
        <table class="webgrid-table" id="checkableGrid">            
            <tbody>               
                @foreach($result as $item)                                
                <tr class="webgrid-row-style">
                    <td class="number_width">
                        <?=$item->id?>
                    </td>
                    <td class="date_width">
                        <?php
                    $str = $item->postDate;
                    $str2 = new DateTime(str_replace("_","",$str));
                    $date = $str2->format('Y-m-d');  //날짜
                    $now = date('Y-m-d');
                    if ($date == $now)
                    {
                        //$date = $str2->format('h:i:s');    //시간을 시분초로 표시(am pm 구분없음)
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
                        <a href="/qaboard/showSearch/<?=$item->id?>/<?=$qaSearchTerm?>" target="_blank">
                            <?php
                    //$this->load->helper('funcStep');  //function을 헬퍼나 라이브러리에
                    //$this->step();                    //등록하려다 실패해서(원인 모름)
                    //$this->load->library('funcstep'); //모델에 등록하고 사용중...
                    //$this->step();                    //지우지 말것...

                    //echo $this->qaBoardModel->funcStep($item->step);

                    //지우지 말것...
                    $re = $item->step * 15;
                            ?>
                            <!--여기를 실현하는 방법은 위처럼 function을 이용하는 방법과 아니면
                            아래처럼 html tag를 사용하고 그안에 위에서 계산된 $re 값을 대응
                            시키는 두가지가 있다.지우지 말것...-->
                            <img src=/imageOwner/blank.gif height=0  width=<?=$re?>>
                            <?php
                            if ($re > 0)
                            {
                            ?>
                            <img src=/imageOwner/re.gif>
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
                    if (strlen($item->title) > 25)
                    {
                        $strTemp = "";
                        //$strTemp = substr(($item->title),0, 7); //한글에 문제 있음...
                        $strTemp = mb_substr(($item->title),0, 25, "utf-8");
                        $strTemp .= "...";

                        //echo $strTemp;
                        $title = $strTemp;
                        $title = str_replace($qaSearchTerm, '<span style="color: red;">' . $qaSearchTerm . '</span>', $title);
                        echo $title;
                    }
                    else
                    {
                        $title = $item->title;
                        $title = str_replace($qaSearchTerm, '<span style="color: red;">' . $qaSearchTerm . '</span>', $title);
                        //echo $item->title;
                        echo $title;
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

<div class="row" style="margin-top: 35px;">
    <div class="col-sm-12 col-md-12 col-lg-12">
        <a href="/qaboard/create" class="btn btn-primary">글쓰기</a>
        <!--<a href="#" class="btn btn-primary go_write" data-toggle="modal" data-target="#dialogForLogin">글쓰기</a>-->
        <a href="/qaboard/index" class="btn btn-success" style="margin-left: 30px;">목록</a>
        <!--<a href="#" class="btn btn-success qaBoardIndex" style="margin-left: 30px;">목록</a>-->
    </div>
</div>

@endsection