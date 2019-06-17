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
        <span style="font-size: 25px;">BEST FQA</span>
        <hr style="margin-top: 0px; margin-bottom: 10px;" />
    </div>
</div>

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
                        <a href="#">
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

        <!--아래 style에서 z-index가 5 보다 낮으면 page-footer 의 파랑색 숫자가 오버랩되어 나온다.원인모름 11/03/2019-->
        <div class="col-sm-12 col-md-12 col-lg-12 deails_section" style="padding-left: 0px; z-index: 5; background-color: white;">

            <!--이곳에 게시판 제목에 해당하는 내용이 보여진다. Ajax에서 구현함-->

        </div>

        <div class="page_footer">
            {!! $result->render() !!}
        </div>

    </div>
</div>

<!-아래 script를 코멘트하면 jquery가 작동 않함. app.blade.php에 있습에도 불구하구. 원인 모름. 09/03/2019--->
<script src="https://code.jquery.com/jquery-3.1.0.min.js" integrity="sha256-cCueBR6CsyA4/9szpPfrX3s49M9vUU5BgtiJj06wt/s=" crossorigin="anonymous"></script>

<!--Page 번호(Footer)를 클릭했을때 Ajax로 해당 데이터를 보낸다-->
<!--pagination을 Ajax로 구현할때 master page를 통하지 않고 바로
원하는 부분으로 보낼때 사용된다===>중요함...-->
<script>
    $(function () {
        $('.page_footer').on('click', 'a', function () {            
            if (this.href == "") { return; } //잘못 클릭했을 경우 아무것도 하지 않는다...           
            $.ajax({
                url: this.href,
                type: 'GET',
                //data: {},
                cache: false,
                success: function (data) {
                    //$('.customer_section').html(data);
                    $(".customer_section").empty().append(data); //이렇게 코딩해도 실행된다...
                },
                error: function () {
                    alert("/customercenter/indexAjax something seems wrong==>indexAjax");
                }
            });
            return false;  //매우 중요함...
        });
    });
</script>

<!--타이틀을 클릭하면 Top으로 부터 현 위치 까지의 offset을 구하여 
details를 보여준다-->
<script>
    var sw = false;
    $('.title_width').each(function () {
        $(this).unbind().click(function () {
            if (sw == false) {
                var $boardIdAjax = $(this).find('#boardIdAjax').val().trim();//게시글의 id를 구한다.11/03/2019                
                var offset = $(this).offset().top;  //Top으로 부터 현 위치까지의 offset을 구한다...
                $.ajax({
                    url: '/customercenter/detailsAjax',
                    type: 'get',
                    data: { id: $boardIdAjax },
                    cache: false,
                    success: function (data) {          //아래의 170은 시행착오로 구한 값...
                        $(".deails_section").css('top', (offset - 170) + 'px').css('position', 'absolute').show();
                        $(".deails_section").empty().append(data);
                    },
                    error: function () {
                        alert("/customercenter/detailsAjax something seems wrong==>indexAjax");
                    }
                });
                sw = true;
                return false;  //매우 중요함...
            }
            else {
                $(".deails_section").empty().hide();
                sw = false;
            }

        });
    });
</script>