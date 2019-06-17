<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

//use App\Http\Requests;
use App\Categorya;
use App\Categoryb;
use App\Categoryc;
use App\Categoryd;
//use DB;

class ManagerController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct() //반드시 admin으로 login 후에 ManagerController에 들어 올 수 있다...21/03/2019
    {
        $this->middleware('auth:admin');
    }

    public function updateCategoryD(Request $request)
    {
        $id = $request->id;
        $id2 = $request->id2;
        $id3 = $request->id3;
        $id4 = $request->id4;

        $name = $request->name;

        $categoryd = Categoryd::findOrFail($id4);

        if ($categoryd)
        {
            $categoryd->name = $name;
            $categoryd->update();
            return 1;
        }
        else
        {
            return 0;
        }
    }

    public function updateCategoryC(Request $request)
    {
        $id = $request->id;
        $id2 = $request->id2;
        $id3 = $request->id3;

        $name = $request->name;

        $categoryc = Categoryc::findOrFail($id3);

        if ($categoryc)
        {
            $categoryc->name = $name;
            $categoryc->update();
            return 1;
        }
        else
        {
            return 0;
        }
    }

    public function updateCategoryB(Request $request)
    {
        $id = $request->id;
        $id2 = $request->id2;

        $name = $request->name;

        $categoryb = Categoryb::findOrFail($id2);

        if ($categoryb)
        {
            $categoryb->name = $name;
            $categoryb->update();
            return 1;
        }
        else
        {
            return 0;
        }
    }

    public function updateCategoryA(Request $request)
    {
        $id = $request->id;
        $name = $request->name;

        $categorya = Categorya::findOrFail($id);

        if ($categorya)
        {
            $categorya->name = $name;
            $categorya->update();
            return 1;
        }
        else
        {
            return 0;
        }
    }

    public function deleteCategoryD(Request $request)
    {
        $id = $request->id;
        $id2 = $request->id2;
        $id3 = $request->id3;
        $id4 = $request->id4;

        $categoryd = Categoryd::findOrFail($id4);

        if ($categoryd)
        {
            $categoryd::destroy($id4);
            return 1;
        }
        else
        {
            return 0;
        }
    }

    public function deleteCategoryC(Request $request)
    {
        $id = $request->id;
        $id2 = $request->id2;
        $id3 = $request->id3;

        $categoryc = Categoryc::findOrFail($id3);

        if ($categoryc)
        {
            $categoryc::destroy($id3);
            return 1;
        }
        else
        {
            return 0;
        }
    }

    public function deleteCategoryB(Request $request)
    {
        $id = $request->id;
        $id2 = $request->id2;

        $categoryb = Categoryb::findOrFail($id2);

        if ($categoryb)
        {
            $categoryb::destroy($id2);
            return 1;
        }
        else
        {
            return 0;
        }
    }

    public function deleteCategoryA(Request $request)
    {
        $id = $request->id;
        //$name = $request->name;

        $categorya = Categorya::findOrFail($id);

        if ($categorya)
        {
            $categorya::destroy($id);
            return 1;
        }
        else
        {
            return 0;
        }
    }

    public function insertCategoryD(Request $request)
    {
        $id = $request->id;
        $id2 = $request->id2;
        $id3 = $request->id3;

        $name = $request->txtCategoryD;

        $categoryd = new Categoryd;

        $categoryd->categorya_id = $id;
        $categoryd->categoryb_id = $id2;
        $categoryd->categoryc_id = $id3;
        $categoryd->name = $name;

        $return = $categoryd->save();

        if ($return)
        {
            return 1;
        }
        else
        {
            return 0;
        }
    }

    public function insertCategoryC(Request $request)
    {
        $id = $request->id;
        $id2 = $request->id2;

        $name = $request->txtCategoryC;

        $categoryc = new Categoryc;

        $categoryc->categorya_id = $id;
        $categoryc->categoryb_id = $id2;
        $categoryc->name = $name;

        $return = $categoryc->save();

        if ($return)
        {
            return 1;
        }
        else
        {
            return 0;
        }
    }

    public function insertCategoryB(Request $request)
    {
        $id = $request->id;

        $name = $request->txtCategoryB;

        $categoryb = new Categoryb;

        $categoryb->categorya_id = $id;
        $categoryb->name = $name;

        $return = $categoryb->save();

        if ($return)
        {
            return 1;
        }
        else
        {
            return 0;
        }
    }

    public function insertCategoryA(Request $request)
    {
        $name = $request->txtCategoryA;

        $categorya = new Categorya;

        //$date = date('Y-m-d H:i:s');
        //$categorya->createdDate = $date;
        $categorya->name = $name;

        $return = $categorya->save();

        if ($return)
        {
            return 1;
        }
        else
        {
            return 0;
        }
    }

    public function categoryCrud()
	{
        ////필료한 데이터를 가져온다.
        $categoryas = Categorya::all();
        $categorybs = Categoryb::all();
        $categorycs = Categoryc::all();
        $categoryds = Categoryd::all();

        return view('manager/categoryCrud', compact('categoryas','categorybs','categorycs','categoryds'));
	}

    public function selectCategoryBCD()
    {
        $id = $_GET['id'];

        $categoryas = Categorya::
           where('id', '=', $id)
           ->get();
        $categorybs = Categoryb::
           where('categorya_id', '=', $id)
           ->get();
        $categorycs = Categoryc::
           where('categorya_id', '=', $id)
           ->get();
        $categoryds = Categoryd::
           where('categorya_id', '=', $id)
           ->get();
        return (string) view('manager/selectCategoryBCD', compact('categoryas','categorybs','categorycs','categoryds'));
    }

    public function selectCategoryACD()
    {
        $id = $_GET['id'];
        $id2 = $_GET['id2'];

        $categoryas = Categorya::
           where('id', '=', $id)
           ->get();
        $categorybs = Categoryb::
           where('categorya_id', '=', $id)
           ->where('id', '=', $id2)
           ->get();
        $categorycs = Categoryc::
           where('categorya_id', '=', $id)
           -> where('categoryb_id', '=', $id2)
           ->get();
        $categoryds = Categoryd::
           where('categorya_id', '=', $id)
           -> where('categoryb_id', '=', $id2)
           ->get();
        return (string) view('manager/selectCategoryACD', compact('categoryas','categorybs','categorycs','categoryds'));
    }

    public function selectCategoryABD()
    {
        $id = $_GET['id'];
        $id2 = $_GET['id2'];
        $id3 = $_GET['id3'];

        $categoryas = Categorya::
           where('id', '=', $id)
           ->get();
        $categorybs = Categoryb::
           where('categorya_id', '=', $id)
           ->where('id', '=', $id2)
           ->get();
        $categorycs = Categoryc::
           where('categorya_id', '=', $id)
           -> where('categoryb_id', '=', $id2)
           -> where('id', '=', $id3)
           ->get();
        $categoryds = Categoryd::
           where('categorya_id', '=', $id)
           -> where('categoryb_id', '=', $id2)
            -> where('categoryc_id', '=', $id3)
           ->get();
        return (string) view('manager/selectCategoryABD', compact('categoryas','categorybs','categorycs','categoryds'));
    }

    public function selectCategoryABC()
    {
        $id = $_GET['id'];
        $id2 = $_GET['id2'];
        $id3 = $_GET['id3'];
        $id4 = $_GET['id4'];

        $categoryas = Categorya::
           where('id', '=', $id)
           ->get();
        $categorybs = Categoryb::
           where('categorya_id', '=', $id)
           ->where('id', '=', $id2)
           ->get();
        $categorycs = Categoryc::
           where('categorya_id', '=', $id)
           -> where('categoryb_id', '=', $id2)
           -> where('id', '=', $id3)
           ->get();
        $categoryds = Categoryd::
           where('categorya_id', '=', $id)
           -> where('categoryb_id', '=', $id2)
           -> where('categoryc_id', '=', $id3)
           -> where('id', '=', $id4)
           ->get();
        return (string) view('manager/selectCategoryABC', compact('categoryas','categorybs','categorycs','categoryds'));
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
