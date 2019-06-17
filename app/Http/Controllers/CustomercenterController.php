<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Qaboard;
use Validator;
use DB;

class CustomercenterController extends Controller
{
    //views/customercentrer/indexAjax.blade.php에서 사용
    //각 글의 제목을 Step별로  우측으로 들여쓰기 처리
    //$intStep : 위치할 step 숫자  //현재는 사용 중지 그러나 중요한 예제. 11/03/2019
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

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('customercenter.index');
    }


    public function indexAjax()
    {
        $result = Qaboard::orderBy('ref', 'desc')
                         ->orderBy('refOrder', 'asc')
                         ->paginate(10);

        return (String) view('customercenter.indexAjax', compact('result'));
    }

    public function detailsAjax()
    {
        $id = $_GET['id']; //Ajax에서  type:'get' 일때 받는 형식 11/03/2019

        $result = Qaboard::findOrFail($id);

        return (String) view('customercenter.detailsAjax', compact('result'));
    }

    //customercenter page 내에서 forgotpassword의 view를 보여 주고 입출력 처리를 시도 하였으나
    //입력처리 후 리턴 메시지를 customercenter page에서 받지 못하여 고민 중에 있음...
    //reset password 이메일은 잘 처리되고 있음. 아무튼 현재는 사용 중지.12/03/2019
    public function forgotpassword()
    {

        return (String) view('auth.passwords.emailAjax');

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
