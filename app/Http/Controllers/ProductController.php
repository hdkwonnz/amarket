<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
use App\Categoryb;
use App\Categoryc;
use App\Categoryd;
use App\Orderdetail;
use App\First_option; //21/04/2019
use App\Second_option; //21/04/2019
use DB;

class ProductController extends Controller
{
    //categoryDmenu View의 Ajax에서 콜 한다. categoryD 전체를 보여 준다.
    public function categoryDAll()
    {
        $id = $_GET['id'];
        $id2 = $_GET['id2'];
        $id3 = $_GET['id3'];
        $id4 = $_GET['id4'];

        $qry = Product::select('*')
                    ->where('categorya_id','=',$id)
                    ->where('categoryb_id','=',$id2)
                    ->where('categoryb_id','=',$id3)
                    ->where('categoryc_id','=',$id4);
        $numRows = $qry->count();
        $products = $qry->orderBy('id','desc')
                        ->paginate(5);

        return (string) view('product.categoryDAll',
                                compact('id','id2','id3','id4',
                                        'numRows','products'));
    }

    //CategoryD에 해당하는 화면 만들기. product/details View에서 콜 한다.
    public function categoryDmenu($id,$id2,$id3,$id4,$nameB,$nameC,$nameD)
    {
        $categorybs = Categoryb::where('categorya_id','=',$id)
                                ->orderBy('categorya_id','asc')
                                ->orderBy('id','asc')
                                ->get();

        $categorycs = Categoryc::
           select('categorybs.name AS bname','categorycs.name AS cname','categorycs.id AS cid',
                   'categorycs.categorya_id','categorycs.categoryb_id')
           ->join('categorybs','categorybs.id','=','categorycs.categoryb_id')
           ->where('categorycs.categorya_id','=',$id)
           ->where('categorycs.categoryb_id','=',$id2)
           ->orderBy('categorycs.categorya_id','asc')
           ->orderBy('categorycs.categoryb_id','asc')
           ->orderBy('categorycs.id','asc')
           ->get();
        //dd($categorycs);

        $categoryds = Categoryd::
                  select('categoryds.name AS dname','categorycs.name AS cname','categorybs.name AS bname',
                           'categoryds.id AS did','categoryds.categorya_id','categoryds.categoryb_id',
                           'categoryds.categoryc_id')
                  ->join('categorybs','categorybs.id','=','categoryds.categoryb_id')
                  ->join('categorycs','categorycs.id','=','categoryds.categoryc_id')
                  ->where('categoryds.categorya_id','=',$id)
                  ->where('categoryds.categoryb_id','=',$id2)
                  ->where('categoryds.categoryc_id','=',$id3)
                  ->orderBy('categoryds.categorya_id','asc')
                  ->orderBy('categoryds.categoryb_id','asc')
                  ->orderBy('categoryds.categoryc_id','asc')
                  ->orderBy('categoryds.id','asc')
                  ->get();
        //dd($categoryds);

        ////아래의 groupBy를 사용 할 경우 다음과 같은 error가 나와
        ////config/database.php 에서 true를 false로 변경 했다.21/05/2019
        ////'mysql' => [
        ////...
        ////'strict' => false,
        ////...
        ////]
        ////SQLSTATE[42000]: Syntax error or access violation: 1055 'hdkwonnzlaravel.orderdetails.id' isn't in GROUP BY
        ////orderdetails 중에서 해당 카테고리를 추출하여 가중 금액이
        ////큰 순으로 정렬한다. 한번도 판매 않된 상품은 추출되지 않는다.
        $orderdetails = Orderdetail::
            select('orderdetails.product_id','products.modelName AS modelName',
                    'products.originPrice AS originPrice','products.sellPrice AS sellPrice',
                    'products.id AS productId','products.searchImage AS searchImage',
                DB::raw('sum(orderdetails.quantity * orderdetails.sellPrice) AS total'))
            ->join('products','orderdetails.product_id', '=', 'products.id')
            ->where('products.categorya_id','=',$id)
            ->where('products.categoryb_id','=',$id2)
            ->where('products.categoryc_id','=',$id3)
            ->where('products.categoryd_id','=',$id4)
            ->groupBy('orderdetails.product_id')
            ->orderBy('total', 'desc')
            ->take(5)
            ->get();
        //dd($orderdetails);

        return view('product.categoryDmenu', compact('categorybs','categorycs',
                                                     'categoryds','orderdetails',
                                                     'id','id2','id3','id4',
                                                     'nameB','nameC','nameD'));
    }

    //categoryCmenu View의 Ajax에서 콜한다. category 전체를 보여 준다.
    public function categoryCAll()
    {
        $id = $_GET['id'];
        $id2 = $_GET['id2'];
        $id3 = $_GET['id3'];

        $qry = Product::select('*')
                    ->where('categorya_id','=',$id)
                    ->where('categoryb_id','=',$id2)
                    ->where('categoryc_id','=',$id3);
        $numRows = $qry->count();
        $products = $qry->orderBy('id','desc')
                        ->paginate(5);

        return (string) view('product.categoryCAll',
                                compact('id','id2','id3',
                                        'numRows','products'));
    }

    //CategoryC에 해당하는 화면 만들기. product/details View에서 콜 한다.
    public function categoryCmenu($id,$id2,$id3,$nameB,$nameC)
    {
        $categorybs = Categoryb::where('categorya_id','=',$id)
                                ->orderBy('categorya_id','asc')
                                ->orderBy('id','asc')
                                ->get();

        $categorycs = Categoryc::
           select('categorybs.name AS bname','categorycs.name AS cname','categorycs.id AS cid',
                   'categorycs.categorya_id','categorycs.categoryb_id')
           ->join('categorybs','categorybs.id','=','categorycs.categoryb_id')
           ->where('categorycs.categorya_id','=',$id)
           ->where('categorycs.categoryb_id','=',$id2)
           ->orderBy('categorycs.categorya_id','asc')
           ->orderBy('categorycs.categoryb_id','asc')
           ->orderBy('categorycs.id','asc')
           ->get();
        //dd($categorycs);

        $categoryds = Categoryd::
                  select('categoryds.name AS dname','categorycs.name AS cname','categorybs.name AS bname',
                           'categoryds.id AS did','categoryds.categorya_id','categoryds.categoryb_id',
                           'categoryds.categoryc_id')
                  ->join('categorybs','categorybs.id','=','categoryds.categoryb_id')
                  ->join('categorycs','categorycs.id','=','categoryds.categoryc_id')
                  ->where('categoryds.categorya_id','=',$id)
                  ->where('categoryds.categoryb_id','=',$id2)
                  ->where('categoryds.categoryc_id','=',$id3)
                  ->get();
        //dd($categoryds);

        ////아래의 groupBy를 사용 할 경우 다음과 같은 error가 나와
        ////config/database.php 에서 true를 false로 변경 했다.21/05/2019
        ////'mysql' => [
        ////...
        ////'strict' => false,
        ////...
        ////]
        ////SQLSTATE[42000]: Syntax error or access violation: 1055 'hdkwonnzlaravel.orderdetails.id' isn't in GROUP BY
        ////orderdetails 중에서 해당 카테고리를 추출하여 가중 금액이
        ////큰 순으로 정렬한다. 한번도 판매 않된 상품은 추출되지 않는다.
        $orderdetails = Orderdetail::
            select('orderdetails.product_id','products.modelName AS modelName',
                    'products.originPrice AS originPrice','products.sellPrice AS sellPrice',
                    'products.id AS productId','products.searchImage AS searchImage',
                DB::raw('sum(orderdetails.quantity * orderdetails.sellPrice) AS total'))
            ->join('products','orderdetails.product_id', '=', 'products.id')
            ->where('products.categorya_id','=',$id)
            ->where('products.categoryb_id','=',$id2)
            ->where('products.categoryc_id','=',$id3)
            ->groupBy('orderdetails.product_id')
            ->orderBy('total', 'desc')
            ->take(5)
            ->get();
        //dd($orderdetails);
        return view('product.categoryCmenu', compact('categorybs','categorycs',
                                                     'categoryds','orderdetails',
                                                     'id','id2','id3',
                                                     'nameB','nameC'));
    }

    //CategoryB에 해당하는 화면 만들기. product/details View에서 콜 한다.
    public function categoryBmenu($id,$id2,$nameB)
    {
        $categorybs = Categoryb::
            select('*')
            ->orderBy('categorya_id','asc')
            ->orderBy('id','asc')
            ->get();

        $categorycs = Categoryc::
            select('categorybs.name AS bname','categorycs.name AS cname','categorycs.id AS cid',
                    'categorycs.categorya_id','categorycs.categoryb_id')
            ->join('categorybs','categorybs.id','=','categorycs.categoryb_id')
            ->where('categorycs.categorya_id','=',$id)
            ->where('categorycs.categoryb_id','=',$id2)
            ->orderBy('categorycs.categorya_id','asc')
            ->orderBy('categorycs.categoryb_id','asc')
            ->orderBy('categorycs.id','asc')
            ->get();

        //dd($categorycs);

        $categoryds = Categoryd::
                  select('categoryds.name AS dname','categorycs.name AS cname','categorybs.name AS bname',
                           'categoryds.id AS did','categoryds.categorya_id','categoryds.categoryb_id',
                           'categoryds.categoryc_id')
                  ->join('categorybs','categorybs.id','=','categoryds.categoryb_id')
                  ->join('categorycs','categorycs.id','=','categoryds.categoryc_id')
                  ->where('categoryds.categorya_id','=',$id)
                  ->where('categoryds.categoryb_id','=',$id2)
                  ->get();

        //dd($categoryds);

        ////아래의 groupBy를 사용 할 경우 다음과 같은 error가 나와
        ////config/database.php 에서 true를 false로 변경 했다.21/05/2019
        ////'mysql' => [
        ////...
        ////'strict' => false,
        ////...
        ////]
        ////SQLSTATE[42000]: Syntax error or access violation: 1055 'hdkwonnzlaravel.orderdetails.id' isn't in GROUP BY
        ////orderdetails 중에서 해당 카테고리를 추출하여 가중 금액이
        ////큰 순으로 정렬한다. 한번도 판매 않된 상품은 추출되지 않는다.
        $orderdetails = Orderdetail::
            select('orderdetails.product_id','products.modelName AS modelName',
                    'products.originPrice AS originPrice','products.sellPrice AS sellPrice',
                    'products.id AS productId','products.searchImage AS searchImage',
                DB::raw('sum(orderdetails.quantity * orderdetails.sellPrice) AS total'))
            ->join('products','orderdetails.product_id', '=', 'products.id')
            ->where('products.categorya_id','=',$id)
            ->where('products.categoryb_id','=',$id2)
            ->groupBy('orderdetails.product_id')
            ->orderBy('total', 'desc')
            ->take(10)
            ->get();
        //dd($orderdetails);
        return view('product.categoryBmenu', compact('categorybs','categorycs','categoryds',                                                    'orderdetails','id','id2','nameB'));
    }

    ////stopped 23/05/2019
    public function details($id)
    {
        $product = Product::findOrFail($id);

        $aId = $product->categorya_id;
        $bId = $product->categoryb_id;
        $cId = $product->categoryc_id;

        $resultB = Categoryb::
              where('categorya_id', '=', $aId)
            ->get();
        $resultC = Categoryc::
              where('categorya_id', '=', $aId)
            ->where('categoryb_id', '=', $bId)
            ->get();
        $resultD = Categoryd::
              where('categorya_id', '=', $aId)
            ->where('categoryb_id', '=', $bId)
            ->where('categoryc_id', '=', $cId)
            ->get();
        $resultOp = Product::
              where('categorya_id', '=', $aId)
            ->where('categoryb_id', '=', $bId)
            ->get();
        $resultBr = Product::
              where('categorya_id', '=', $aId)
            ->where('categoryb_id', '=', $bId)
            ->get();

        return view('product.details', compact('product','resultB','resultC',
                                              'resultD','resultOp','resultBr'));
    }

    ////아래는 임시사용...23/05/2019
    public function ownersPopularProducts()
    {
        $aId = $_GET['aId'];
        $bId = $_GET['bId'];

        $products = Product::
            select('id','modelName','sellPrice','searchImage','categorya_id','categoryb_id')
           ->where('products.categorya_id','=',$aId)
           ->where('products.categoryb_id','=',$bId)
           //->get();
           ->paginate(5);
      
        return (String) view('product.ownersPopularProducts', compact('products'));
    }


    //error 처리를 반드시 추가 해야 함. 30/04/2019
    public function detailsWithCdn($id)
    {
        //$product = Product::findOrFail($id);//stop 01/05/2019

        $product = Product::
           select('products.id AS productId','products.categorya_id','products.categoryb_id',
                    'products.categoryc_id','products.categoryd_id','products.certifyCode',
                    'modelName','originPrice','sellPrice','productImage','description',
                    'deliveryNotice','deliveryCode','deliveryCost','deliveryFreeMinimum',
                    'countryOfProduct','overseasDelivery','optionCode','searchImage',
                    'categorycs.name AS cname','categorybs.name AS bname','categoryds.name AS dname')
            ->join('categorybs','categorybs.id','=','products.categoryb_id')
            ->join('categorycs','categorycs.id','=','products.categoryc_id')
            ->join('categoryds','categoryds.id','=','products.categoryd_id')
            ->where('products.id','=',$id)
            ->get()
            ->first(); //반드시 first()가 있어야 함.매우중요...01/05/2019

        ////아래는 반드시 필요...14/05/2019
        if (!$product) {
            return ("Not Found...");
        }

        //dd($product);

        $aId = $product->categorya_id;
        $bId = $product->categoryb_id;
        $cId = $product->categoryc_id;

        $resultB = Categoryb::
            where('categorya_id', '=', $aId)
            ->get();

        $resultC = Categoryc::
           select('categorycs.name AS cname','categorybs.name AS bname','categorycs.id AS cid',
                    'categorycs.categorya_id','categorycs.categoryb_id')
           ->join('categorybs','categorybs.id','=','categorycs.categoryb_id')
           ->where('categorycs.categorya_id','=',$aId)
           ->where('categorycs.categoryb_id','=',$bId)
           ->get();

        //dd($resultC);

        $resultD = Categoryd::
           select('categoryds.name AS dname','categorycs.name AS cname','categorybs.name AS bname',
                    'categoryds.id AS did','categoryds.categorya_id','categoryds.categoryb_id',
                    'categoryds.categoryc_id')
           ->join('categorybs','categorybs.id','=','categoryds.categoryb_id')
           ->join('categorycs','categorycs.id','=','categoryds.categoryc_id')
           ->where('categoryds.categorya_id','=',$aId)
           ->where('categoryds.categoryb_id','=',$bId)
           ->where('categoryds.categoryc_id','=',$cId)
           ->get();

        //dd($resultD);

        $firstOptions = First_option::
              where('product_id', '=', $id)
              ->get();

        $secondOptions = Second_option::
              where('product_id', '=', $id)
              ->get();
        //dd($secondOptions);

        return view('product.detailsWithCdn', compact('product','resultB','resultC',
                                              'resultD','firstOptions','secondOptions'));
    }
}
