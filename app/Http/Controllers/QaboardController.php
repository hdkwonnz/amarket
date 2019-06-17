<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Qaboard;
use Validator;
use DB;

class QaboardController extends Controller
{
    //만약 register 후에 verify을 하지 않은 상태로 진입을 못 하게 막아준다.12/04/2019
    public function __construct()
    {
        $this->middleware('verified',['only' => ['create','reply']]);
        //$this->middleware('verified',['only' => ['reply']]);
    }

    //migration file(database/migrations) 코딩시 반드시 숫자가 들어갈 칼럼들은
    //->default(0)를 추가 한 후 migration 할 것.
    //database/migrations/2019_03_08_135430_create_qaboards_table.php 참조
    //amaket을 참조. 13/04/2019
    //indexView에서 사용
    //각 글의 제목을 Step별로  우측으로 들여쓰기 처리
    //$intStep : 위치할 step 숫자
    public static function funcStep($intStep)
    {
        $strTemp = "";
        if ($intStep == 0)
        {
            $strTemp = "";
        }
        else
        {
            for ($i = 0; $i < $intStep; $i++) {
                $width = $intStep * 15;
                $strTemp = "<img src=/imageOwner/blank.gif height=0  width='".$width."'>";
            }
            $strTemp .= "<img src=/imageOwner/re.gif>";
        }


        return $strTemp;
    }

    public function search($qaSearchTerm)
    {
        $result = DB::table('qaboards')
            ->where('title', 'LIKE', '%' . $qaSearchTerm . '%')
            ->orWhere('content', 'LIKE', '%' . $qaSearchTerm . '%');
        $numRows = $result->count();
        $result = $result
            ->orderBy('ref', 'desc')
            ->orderBy('refOrder', 'asc')
            ->paginate(10);

        return view('qaboard.search', compact('result', 'qaSearchTerm', 'numRows'));
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $result = Qaboard::orderBy('ref', 'desc')
                         ->orderBy('refOrder', 'asc')
                         ->paginate(10);

        return view('qaboard.index', compact('result'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('qaboard.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        ////일반적인 폼 서브밋을 사용시 아래 처럼 체크한다.
        //$this->validate($request, array(
        //    'txtTitle'=>'required|max:255',
        //    'txtContent'=>'required'
        //    ));

        ////ajax로 서브밋을 사용시 아래처럼 체크한다.
        $validator = Validator::make(
            array(
                'txtTitle' => $request->txtTitle,
                'txtContent' => $request->txtContent
            ),
            array(
                'txtTitle'=>'required|max:255',
                'txtContent'=>'required'
            )
        );
        if ($validator->fails())
        {
            return "입력에 문제가 있습니다...";
        }

        $maxRef = Qaboard::select('ref')->orderBy('ref', 'desc')->first();

        if ($maxRef)
        {
            $ref = $maxRef->ref;
            $ref = $ref + 1;
        }
        else
        {
            $ref = 1;
        }

        $date = date('Y-m-d H:i:s');

        $qaboard = new Qaboard;

        $qaboard->title = $request->txtTitle;
        $qaboard->content = $request->txtContent;
        $qaboard->postIP = $request->ip();
        $qaboard->postDate = $date;
        $qaboard->ref = $ref;

        //$qaboard->save();

        $return = $qaboard->save();
        if(!$return)
        {
            //App::abort(500, 'Error');
            return 0;
        }
        else
        {
            return 1;
        }
    }

    public function reply($id)
    {
        $result = Qaboard::findOrFail($id);

        return view('qaboard.reply', compact('result'));
    }

    public function addReply(Request $request)
    {
        $validator = Validator::make(
             array(
                 'id' => $request->id,
                 'txtTitle' => $request->txtTitle,
                 'txtContent' => $request->txtContent
             ),
             array(
                 'id' =>'required',
                 'txtTitle'=>'required|max:255',
                 'txtContent'=>'required'
             )
         );
        if ($validator->fails())
        {
            return "입력에 문제가 있습니다...";
        }

        $id = $request->id;
        $title = $request->txtTitle;
        $content = $request->txtContent;
        $date = date('Y-m-d H:i:s');
        $ip = $request->ip();

        //$qaboard = Qaboard::find($id);
        //$qaboard->answerNum = $qaboard->answerNum + 1;
        //$qaboard->save();

        DB::beginTransaction();

        try
        {
            //[0] 변수 선언
            $maxRefOrder = 0;
            $maxRefAnswerNum = 0;
            $parentRef = 0;
            $parentStep = 0;

            //[1] 부모글의 답변수(AnswerNum)를 1증가
            $sql = "UPDATE qaboards
                    SET answerNum = answerNum + 1
                    WHERE id = '{$id}'";
            $qry = DB::statement($sql);
            if (!$qry)
            {
                throw new Exception("qaboards REPLY[1] Error...");  //catch로 보낸다.
            }

            //[2] 같은 글에 대해서 답변을 두 번 이상하면 먼저 답변한게 위에 나타나게 한다.
            $sql = "SELECT refOrder AS maxRefOrder, answerNum AS maxRefAnswerNum
                    FROM qaboards
	                WHERE parentNum = '{$id}' AND
                          refOrder = (SELECT MAX(refOrder) FROM qaboards WHERE parentNum = '{$id}')";
            $qry = DB::select($sql);
            if ($qry)
            {
                $maxRefOrder = $qry[0]->maxRefOrder;
                $maxRefAnswerNum = $qry[0]->maxRefAnswerNum;
            }
            else
            {
                $sql = "SELECT refOrder AS maxRefOrder FROM qaboards WHERE id = '{$id}'";
                $qry = DB::select($sql);
                $maxRefOrder = $qry[0]->maxRefOrder;
                $maxRefAnswerNum = 0;
            }

            //[3] 중간에 답변달 때(비집고 들어갈 자리 마련)
            $sql = "SELECT ref AS parentRef, step AS parentStep
                    FROM qaboards WHERE id = '{$id}'";
            $qry = DB::select($sql);

            $parentRef = $qry[0]->parentRef;
            $parentStep = $qry[0]->parentStep;

            $sql = "UPDATE qaboards SET refOrder = refOrder + 1
                    WHERE ref = '{$parentRef}' AND refOrder > ({$maxRefOrder} + {$maxRefAnswerNum})";
            $qry = DB::statement($sql);
            if (!$qry)
            {
                throw new Exception("qaboards REPLY[3] Error...");  //catch로 보낸다.
            }

            //[4] 최종저장
            $qaboard = new Qaboard;

            $qaboard->title = $title;
            $qaboard->content = $content;
            $qaboard->postIP = $ip;
            $qaboard->postDate = $date;
            $qaboard->ref = $parentRef;
            $qaboard->step = $parentStep + 1;
            $qaboard->refOrder = $maxRefOrder + $maxRefAnswerNum + 1;
            $qaboard->parentNum = $id;

            $return = $qaboard->save();
            if(!$return)
            {
                throw new Exception("qaboards REPLY[4] Error...");  //catch로 보낸다.
            }
            else
            {
                DB::commit();

                return 1;
            }
        }
        catch(Exception $e)
        {
            DB::rollback();

            return "Failed to Reply : " + $e->getMessage();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $result = Qaboard::findOrFail($id);

        return view('qaboard.show', compact('result'));
    }

    public function showSearch($id, $qaSearchTerm)
    {
        $result = Qaboard::findOrFail($id);

        return view('qaboard.show', compact('result', 'qaSearchTerm'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
