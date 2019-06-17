<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
use App\Shoppingcart;
use App\Categorya;
use Auth;
use Cookie;
use App\Exceptions\HomeSearchException; ////08/04/2019

class HomeController extends Controller
{
    /** HomeController.php
     * Create a new controller instance.
     *
     * @return void
     */
    //새로운 user가 register 하면 email verification 하라는 page로 강제 진입.12/04/2019
    //public function __construct()
    //{
    //    $this->middleware(['auth', 'verified']);
    //}

    public function index()
    {
        //$products = Product::all();
        //foreach ($products as $product)
        //{
        //    $picture = $product->pictures;
        //    $aa = 111;
        //}

        //$pictures = Picture::with('product')->get();
        ////var_dump($pictures->toArray());
        //\Log::info($pictures);
        //return view('home.index', compact('pictures'));

        //$products = Product::with('pictures')->get();
        //var_dump($products->toArray());
        //\Log::info($products);

        //$products = Product::with(['pictures' => function ($q) {
        //    $q->orderBy('fileName', 'desc');
        //}])->get();
        ////var_dump($products->toArray());
        //$xx = $products->toArray();
        //var_dump($xx);


        /////////////////////////////////////////////////////////////////////////////////////////////////
        //eager loading 예제 ==>home.index.blade.php에서 comment를 풀고  test 할수있다.
        //$products = Product::select('id','categorya_id','categoryb_id',
        //               'categoryc_id','categoryd_id',
        //               'modelName','originPrice','sellPrice')
        //                ->with(['pictures' => function ($q) {
        //                    $q->select('pictures.fileName',
        //                        'pictures.product_id') //'pictures.product_id'는 반드시 포함 시켜야 한다.
        //                    ->orderBy('fileName', 'desc')->take(1);  //only take one
        //                }])
        //            ->where('modelNumber','like','%' . '3758' . '%')
        //            ->get();
        //

        //$products = Product::select('id','categorya_id','categoryb_id',
        //               'categoryc_id','categoryd_id',
        //               'modelName','originPrice','sellPrice')
        //                ->with(['pictures' => function ($q) {
        //                    $q->select('pictures.fileName',
        //                        'pictures.product_id') //'pictures.product_id'는 반드시 포함 시켜야 한다.
        //                    ->orderBy('fileName', 'desc');
        //                }])
        //            ->where('modelNumber','like','%' . '3758' . '%')
        //            ->get();

        //위 $products에서 나온 값으로 해당되는 $pictures의 값을 구할수있다.product model에서 pictures는 hasmany 이다.
        //foreach($products as $product)
        //{
        //     $pictures = $product->pictures;
        //}

        //return view('home.index', compact('products'));

        //////////////////////////////////////////////////////////////////////////////////////////////////


        //var_dump($products->toArray());

        //$qry = LeadsModel::with(array('emails' => function ($q) use ($input) {
        //    $q->where('email','like',"%{$input}%");
        //}))->whereHas('emails', function ($q) use ($input) {
        //    $q->where('email','like',"%{$input}%");
        //});
        //$res = $qry->get();

        ////아래처럼 사용하다 stop==>eager loading 문제로.30/04/2019
        //$categoryas = Categorya::all();

        ////아래로 바꾸었음==>eager loading 문제로.30/04/2019
        $categoryas = Categorya::with('categorybs','categorycs','categoryds')->get();

        return view('home.index', compact('categoryas'));
    }

    public function categoryAmenu()
    {
        $categoryas = Categorya::all();

        return (string) view('home.categoryAmenu', compact('categoryas'));
    }

    //layout View에서 콜한다.
    public function deletCookieProduct(Request $request)
    {
        try{
            $id = $request->id;

            if (Cookie::get('myProducts'))   //myProducts라는 쿠키가 존재하면...
            {
                foreach (Cookie::get('myProducts') as $name => $value)   //쿠키를 순서대로 읽어서
                {
                    $name = htmlspecialchars($name);
                    $value = htmlspecialchars($value);
                    if ($name == $id) //삭제를 원하는 상품이 있으면 삭제한다.
                    {
                        $myCookie = 'myProducts' . '[' . $id . ']';
                        Cookie::queue($myCookie, $value,  -1, '/'); //-1은 분을 의미(1시간 = 60초 * 60초)
                    }                                                  //일분 전에 쿠키가 지워졌다는 의미...
                }
            }

            return 1;
        }
        catch(\Throwable $exception){
            //dd('Exception block', $exception); //working
            //echo $exception->getMessage(); //working ==>2nd option...
            throw new HomeSearchException; //best option...실제로는 이렇게 처리해야 한다.

            //$errorMessage = $exception->getMessage();
            //echo '<h3 style="color: blue;">Errors...</h3>' . '<span style="color: red; font-size: 30px;">' . $errorMessage . '</span>';
        }
        catch (\Exception $exception) {
            //dd('Exception block', $exception); //working
            //echo $exception->getMessage(); //working ==>2nd option...
            throw new HomeSearchException; //best option...실제로는 이렇게 처리해야 한다.

            //$errorMessage = $exception->getMessage();
            //echo '<h3 style="color: blue;">Errors...</h3>' . '<span style="color: red; font-size: 30px;">' . $errorMessage . '</span>';
        }

        //return 0;
    }

    //layoutView, product/details Ajax에서 콜한다.
    //로그인이 되어 있으면 장바구니에 들어있는 상품 수를 카운트하여세션에 저장한고
    //처리 결과를 어레이 형태로 Ajax로 넘긴다... //중요한 예제
    public function countInCart()
    {
        try{
            if (!(Auth::guest()))
            {
                $email = Auth::user()->email;
                $cartCount = Shoppingcart::select('id')
                 ->where('cartNum','=',$email)
                 ->count();

                ////session()->forget('laravelCartCount');
                ////session() 앞에 $request를 쓰지 말 것. 10/04/2019
                session()->put('laravelCartCount',$cartCount);
                return response(['success' => true,'count' => $cartCount]);
            }else
                return response(['success' => true,'count' => 0]);
        }
        catch(Exception $e)
        {
            return response(['success' => false,'count' => 0]);
        }
        //catch(\Throwable $exception){
        //    //dd('Exception block', $exception); //working
        //    //echo $exception->getMessage(); //working ==>2nd option...
        //    throw new HomeSearchException; //best option...실제로는 이렇게 처리해야 한다.

        //    //$errorMessage = $exception->getMessage();
        //    //echo '<h3 style="color: blue;">Errors...</h3>' . '<span style="color: red; font-size: 30px;">' . $errorMessage . '</span>';
        //}
        //catch (\Exception $exception) {
        //    //dd('Exception block', $exception); //working
        //    //echo $exception->getMessage(); //working ==>2nd option...
        //    throw new HomeSearchException; //best option...실제로는 이렇게 처리해야 한다.

        //    //$errorMessage = $exception->getMessage();
        //    //echo '<h3 style="color: blue;">Errors...</h3>' . '<span style="color: red; font-size: 30px;">' . $errorMessage . '</span>';
        //}
    }


    public function searchByCategoryBId($bId,$bName,$searchTerm)
    {
        try{
            if ($searchTerm == "")
            {
                return "검색창이 비었습니다...";
            }

            $qry = Product::
                select('id','categorya_id','categoryb_id',
                       'categoryc_id','categoryd_id',
                       'modelName','originPrice','sellPrice','searchImage')
                ->where(function($q) use($searchTerm)
                {
                    $q->where('modelName', 'LIKE', '%' . $searchTerm . '%')
                        ->orWhere('eventName', 'LIKE', '%' . $searchTerm . '%')
                        //->orWhere('explaination', 'LIKE', '%' . $searchTerm . '%')
                        //->orWhere('description', 'LIKE', '%' . $searchTerm . '%')
                        ->orWhere('company', 'LIKE', '%' . $searchTerm . '%')
                        ->orWhere('products.id', 'LIKE', '%' . $searchTerm . '%')
                        ->orWhereHas('categorya', function($qq) use($searchTerm){
                            $qq->where('name', 'LIKE', '%' . $searchTerm . '%');
                        })
                        ->orWhereHas('categoryb', function($qq) use($searchTerm){
                            $qq->where('name', 'LIKE', '%' . $searchTerm . '%');
                        })
                        ->orWhereHas('categoryc', function($qq) use($searchTerm){
                            $qq->where('name', 'LIKE', '%' . $searchTerm . '%');
                        })
                        ->orWhereHas('categoryd', function($qq) use($searchTerm){
                            $qq->where('name', 'LIKE', '%' . $searchTerm . '%');
                        });
                })
                ->where('categoryb_id','=', $bId);

            $numRows = $qry->count();
            $products = $qry->orderBy('products.id', 'desc')
                            ->paginate(3);

            return view('home.searchByCategoryBId', compact('products','searchTerm','bName','numRows'));
        }
        catch(Exception $e)
        {
            return "error : " + $e->getMessage();
        }
        //catch(\Throwable $exception){
        //    //dd('Exception block', $exception); //working
        //    //echo $exception->getMessage(); //working ==>2nd option...
        //    throw new HomeSearchException; //best option...실제로는 이렇게 처리해야 한다.

        //    //$errorMessage = $exception->getMessage();
        //    //echo '<h3 style="color: blue;">Errors...</h3>' . '<span style="color: red; font-size: 30px;">' . $errorMessage . '</span>';
        //}
        //catch (\Exception $exception) {
        //    //dd('Exception block', $exception); //working
        //    //echo $exception->getMessage(); //working ==>2nd option...
        //    throw new HomeSearchException; //best option...실제로는 이렇게 처리해야 한다.

        //    //$errorMessage = $exception->getMessage();
        //    //echo '<h3 style="color: blue;">Errors...</h3>' . '<span style="color: red; font-size: 30px;">' . $errorMessage . '</span>';
        //}

        //return 0;
    }

    public function searchOne(Request $request)
    {
        try{
            if ($request->searchTerm)
            {
                $searchTerm = $request->searchTerm;

            }
            else
            {
                $searchTerm = "";
            }

            if ($searchTerm == "")
            {
                return "검색창이 비었습니다...";
            }

            $qry = Product::
                select('categorya_id','categoryb_id', \DB::raw('count(*) as subCount'))
                ->where(function($q) use($searchTerm)
                {
                    $q->where('modelName', 'LIKE', '%' . $searchTerm . '%')
                      ->orWhere('eventName', 'LIKE', '%' . $searchTerm . '%')
                      //->orWhere('explaination', 'LIKE', '%' . $searchTerm . '%')
                      //->orWhere('description', 'LIKE', '%' . $searchTerm . '%')
                      ->orWhere('company', 'LIKE', '%' . $searchTerm . '%')
                      ->orWhere('products.id', 'LIKE', '%' . $searchTerm . '%');
                })
                ->orWhereHas('categorya', function($q) use($searchTerm){
                    $q->where('name', 'LIKE', '%' . $searchTerm . '%');
                })
                ->orWhereHas('categoryb', function($q) use($searchTerm){
                    $q->where('name', 'LIKE', '%' . $searchTerm . '%');
                })
                ->orWhereHas('categoryc', function($q) use($searchTerm){
                    $q->where('name', 'LIKE', '%' . $searchTerm . '%');
                })
                ->orWhereHas('categoryd', function($q) use($searchTerm){
                    $q->where('name', 'LIKE', '%' . $searchTerm . '%');
                });

            $numRows = $qry->count();
            $group = $qry->groupBy('categorya_id','categoryb_id')
                     ->orderBy('categorya_id', 'asc')
                     ->orderBy('categoryb_id', 'asc')
                     ->get();

            return view('home.searchOne', compact('numRows','group','searchTerm'));
        }
        catch(Exception $e)
        {
            return "error : " + $e->getMessage();
        }
        //catch(\Throwable $exception){
        //    //dd('Exception block', $exception); //working
        //    //echo $exception->getMessage(); //working ==>2nd option...
        //    throw new HomeSearchException; //best option...실제로는 이렇게 처리해야 한다.

        //    //end user에게 message 보여주기---위험한 방법 사용하지 말 것...
        //    //$errorMessage = $exception->getMessage();
        //    //echo '<h3 style="color: blue;">Throwable Errors...</h3>' . '<span style="color: red; font-size: 30px;">' . $errorMessage . '</span>';
        //}
        //catch (\Exception $exception) {
        //    //dd('Exception block', $exception); //working
        //    //echo $exception->getMessage(); //working ==>2nd option...
        //    throw new HomeSearchException; //best option...실제로는 이렇게 처리해야 한다.

        //    //end user에게 message 보여주기---위험한 방법 사용하지 말 것...
        //    //$errorMessage = $exception->getMessage();
        //    //echo '<h3 style="color: blue;">Exception Errors...</h3>' . '<span style="color: red; font-size: 30px;">' . $errorMessage . '</span>';
        //}

        //return "errors...";
    }

    public function searchTwo()
    {
        try{
            if ($_GET['searchTerm'])
            {
                $searchTerm = $_GET['searchTerm'];
            }
            else
            {
                $searchTerm = "";

            }

            if ($searchTerm == "")
            {
                return "검색창이 비었습니다...";
            }

            $products = Product::
                select('id','categorya_id','categoryb_id',
                       'categoryc_id','categoryd_id',
                       'modelName','originPrice','sellPrice','searchImage')
                ->where(function($q) use($searchTerm)
                {
                    $q->where('modelName', 'LIKE', '%' . $searchTerm . '%')
                      ->orWhere('eventName', 'LIKE', '%' . $searchTerm . '%')
                      //->orWhere('explaination', 'LIKE', '%' . $searchTerm . '%')
                      //->orWhere('description', 'LIKE', '%' . $searchTerm . '%')
                      ->orWhere('company', 'LIKE', '%' . $searchTerm . '%')
                      ->orWhere('products.id', 'LIKE', '%' . $searchTerm . '%');
                })
                ->orWhereHas('categorya', function($q) use($searchTerm){
                    $q->where('name', 'LIKE',  '%' . $searchTerm . '%');
                })
                ->orWhereHas('categoryb', function($q) use($searchTerm){
                    $q->where('name', 'LIKE',  '%' . $searchTerm . '%');
                })
                ->orWhereHas('categoryc', function($q) use($searchTerm){
                    $q->where('name', 'LIKE',  '%' . $searchTerm . '%');
                })
                ->orWhereHas('categoryd', function($q) use($searchTerm){
                    $q->where('name', 'LIKE',  '%' . $searchTerm . '%');
                })
                ->orderBy('products.id', 'desc')
                ->paginate(3);

            return (String) view('home.searchTwo', compact('products','searchTerm'));
        }
        catch(Exception $e)
        {
            return "error : " + $e->getMessage();
        }
        //catch(\Throwable $exception){
        //    //dd('Exception block', $exception); //working
        //    //echo $exception->getMessage(); //working ==>2nd option...
        //    throw new HomeSearchException; //best option...실제로는 이렇게 처리해야 한다.

        //    //end user에게 message 보여주기---위험한 방법 사용하지 말 것...
        //    //$errorMessage = $exception->getMessage();
        //    //echo '<h3 style="color: blue;">Errors...</h3>' . '<span style="color: red; font-size: 30px;">' . $errorMessage . '</span>';
        //}
        //catch (\Exception $exception) {
        //    //dd('Exception block', $exception); //working
        //    //echo $exception->getMessage(); //working ==>2nd option...
        //    throw new HomeSearchException; //best option...실제로는 이렇게 처리해야 한다.

        //    //end user에게 message 보여주기---위험한 방법 사용하지 말 것...
        //    //$errorMessage = $exception->getMessage();
        //    //echo '<h3 style="color: blue;">Errors...</h3>' . '<span style="color: red; font-size: 30px;">' . $errorMessage . '</span>';
        //}

        //return "errors...";
    }

    public function searchThree()
    {
        try{
            if ($_GET['searchTerm'])
            {
                $searchTerm = $_GET['searchTerm'];
            }
            else
            {
                $searchTerm = "";
            }

            if ($searchTerm == "")
            {
                return "검색창이 비었습니다...";
            }

            $products2 = Product::
                select('id','categorya_id','categoryb_id',
                       'categoryc_id','categoryd_id',
                       'modelName','originPrice','sellPrice','searchImage')
                ->where(function($q) use($searchTerm)
                {
                    $q->where('modelName', 'LIKE', '%' . $searchTerm . '%')
                      ->orWhere('eventName', 'LIKE', '%' . $searchTerm . '%')
                      ->orWhere('explaination', 'LIKE', '%' . $searchTerm . '%')
                      ->orWhere('description', 'LIKE', '%' . $searchTerm . '%')
                      ->orWhere('company', 'LIKE', '%' . $searchTerm . '%')
                      ->orWhere('products.id', 'LIKE', '%' . $searchTerm . '%');
                })
                ->orWhereHas('categorya', function($q) use($searchTerm){
                    $q->where('name', 'LIKE',  '%' . $searchTerm . '%');
                })
                ->orWhereHas('categoryb', function($q) use($searchTerm){
                    $q->where('name', 'LIKE',  '%' . $searchTerm . '%');
                })
                ->orWhereHas('categoryc', function($q) use($searchTerm){
                    $q->where('name', 'LIKE',  '%' . $searchTerm . '%');
                })
                ->orWhereHas('categoryd', function($q) use($searchTerm){
                    $q->where('name', 'LIKE',  '%' . $searchTerm . '%');
                })
                ->orderBy('products.id', 'desc')
                ->paginate(5);

            return (String) view('home.searchThree', compact('products2','searchTerm'));
        }
        catch(Exception $e)
        {
            return "error : " + $e->getMessage();
        }
        //catch(\Throwable $exception){
        //    //dd('Exception block', $exception); //working
        //    //echo $exception->getMessage(); //working ==>2nd option...
        //    throw new HomeSearchException; //best option...실제로는 이렇게 처리해야 한다.

        //    //end user에게 message 보여주기---위험한 방법 사용하지 말 것...
        //    //$errorMessage = $exception->getMessage();
        //    //echo '<h3 style="color: blue;">Errors...</h3>' . '<span style="color: red; font-size: 30px;">' . $errorMessage . '</span>';
        //}
        //catch (\Exception $exception) {
        //    //dd('Exception block', $exception); //working
        //    //echo $exception->getMessage(); //working ==>2nd option...
        //    throw new HomeSearchException; //best option...실제로는 이렇게 처리해야 한다.

        //    //end user에게 message 보여주기---위험한 방법 사용하지 말 것...
        //    //$errorMessage = $exception->getMessage();
        //    //echo '<h3 style="color: blue;">Errors...</h3>' . '<span style="color: red; font-size: 30px;">' . $errorMessage . '</span>';
        //}

        //return "errors...";
    }

    //아래는 동일화면에 두개의 pagination을 사용한 경우
    //ajax를 사용하지 않고 구현한경우.
    //두 페이지 중 한 페이지가 바뀌면 다른 쪽의 페이지도 리로드된다(단점)
    public function searchMulti(Request $request)
    {
        if ($request->searchTerm)
        {
            $searchTerm = $request->searchTerm;
        }
        else
        {
            $searchTerm = "";
        }

        if ($searchTerm == "")
        {
            return "검색창이 비었습니다...";
        }

        $products = Product::
            select('id','categorya_id','categoryb_id',
                   'categoryc_id','categoryd_id',
                   'modelName','originPrice','sellPrice')
            ->where(function($q) use($searchTerm)
            {
                $q->where('modelName', 'LIKE', '%' . $searchTerm . '%')
                  ->orWhere('eventName', 'LIKE', '%' . $searchTerm . '%')
                  ->orWhere('explaination', 'LIKE', '%' . $searchTerm . '%')
                  ->orWhere('description', 'LIKE', '%' . $searchTerm . '%')
                  ->orWhere('company', 'LIKE', '%' . $searchTerm . '%')
                  ->orWhere('products.id', 'LIKE', '%' . $searchTerm . '%');
            })
            ->orWhereHas('categorya', function($q) use($searchTerm){
                $q->where('name', 'LIKE',  '%' . $searchTerm . '%');
            })
            ->orWhereHas('categoryb', function($q) use($searchTerm){
                $q->where('name', 'LIKE',  '%' . $searchTerm . '%');
            })
            ->orWhereHas('categoryc', function($q) use($searchTerm){
                $q->where('name', 'LIKE',  '%' . $searchTerm . '%');
            })
            ->orWhereHas('categoryd', function($q) use($searchTerm){
                $q->where('name', 'LIKE',  '%' . $searchTerm . '%');
            })
            ->orderBy('products.id', 'desc')
            //->paginate(3);
           ->paginate(3,['*'],'products'); //동일 화면에 두 페이지 사용
        //->get();

        $qry = Product::
            select('categorya_id','categoryb_id', \DB::raw('count(*) as subCount'))
            ->where(function($q) use($searchTerm)
            {
                $q->where('modelName', 'LIKE', '%' . $searchTerm . '%')
                  ->orWhere('eventName', 'LIKE', '%' . $searchTerm . '%')
                  ->orWhere('explaination', 'LIKE', '%' . $searchTerm . '%')
                  ->orWhere('description', 'LIKE', '%' . $searchTerm . '%')
                  ->orWhere('company', 'LIKE', '%' . $searchTerm . '%')
                  ->orWhere('products.id', 'LIKE', '%' . $searchTerm . '%');
            })
            ->orWhereHas('categorya', function($q) use($searchTerm){
                $q->where('name', 'LIKE', '%' . $searchTerm . '%');
            })
            ->orWhereHas('categoryb', function($q) use($searchTerm){
                $q->where('name', 'LIKE', '%' . $searchTerm . '%');
            })
            ->orWhereHas('categoryc', function($q) use($searchTerm){
                $q->where('name', 'LIKE', '%' . $searchTerm . '%');
            })
            ->orWhereHas('categoryd', function($q) use($searchTerm){
                $q->where('name', 'LIKE', '%' . $searchTerm . '%');
            });

        $numRows = $qry->count();
        $group = $qry->groupBy('categorya_id','categoryb_id')
                 ->orderBy('categorya_id', 'asc')
                 ->orderBy('categoryb_id', 'asc')
                 ->get();

        ///////////////////////////////////////////////////////////////////

        $searchTerm2 = $searchTerm;

        if ($searchTerm2 == "")
        {
            return "검색창이 비었습니다...";
        }

        $products2 = Product::
            select('id','categorya_id','categoryb_id',
                   'categoryc_id','categoryd_id',
                   'modelName','originPrice','sellPrice')
            ->where(function($q) use($searchTerm2)
            {
                $q->where('modelName', 'LIKE', '%' . $searchTerm2 . '%')
                  ->orWhere('eventName', 'LIKE', '%' . $searchTerm2 . '%')
                  ->orWhere('explaination', 'LIKE', '%' . $searchTerm2 . '%')
                  ->orWhere('description', 'LIKE', '%' . $searchTerm2 . '%')
                  ->orWhere('company', 'LIKE', '%' . $searchTerm2 . '%')
                  ->orWhere('products.id', 'LIKE', '%' . $searchTerm2 . '%');
            })
            ->orWhereHas('categorya', function($q) use($searchTerm2){
                $q->where('name', 'LIKE',  '%' . $searchTerm2 . '%');
            })
            ->orWhereHas('categoryb', function($q) use($searchTerm2){
                $q->where('name', 'LIKE',  '%' . $searchTerm2 . '%');
            })
            ->orWhereHas('categoryc', function($q) use($searchTerm2){
                $q->where('name', 'LIKE',  '%' . $searchTerm2 . '%');
            })
            ->orWhereHas('categoryd', function($q) use($searchTerm2){
                $q->where('name', 'LIKE',  '%' . $searchTerm2 . '%');
            })
            ->orderBy('products.id', 'desc')
            //->paginate(5);
            ->paginate(5,['*'],'products2'); //동일 화면에 두 페이지 사용

        return view('home.searchMulti', compact('products','products2','numRows','group','searchTerm'));
    }

    public function selectedProducts()
    {
        //$searchTerm2 = $_GET['searchTerm2'];

        if ($_GET['searchTerm2'])
        {
            $searchTerm2 = $_GET['searchTerm2'];
        }
        else
        {
            $searchTerm2 = "";
        }

        ////if (Request::ajax())
        ////{
        ////    $searchTerm2 = $request->searchTerm2;
        ////}

        if ($searchTerm2 == "")
        {
            return "검색창이 비었습니다...";
        }

        //Paginator::setPageName('page_a');

        $products2 = Product::
            select('id','categorya_id','categoryb_id',
                   'categoryc_id','categoryd_id',
                   'modelName','originPrice','sellPrice')
            ->where(function($q) use($searchTerm2)
            {
                $q->where('modelName', 'LIKE', '%' . $searchTerm2 . '%')
                  ->orWhere('eventName', 'LIKE', '%' . $searchTerm2 . '%')
                  ->orWhere('explaination', 'LIKE', '%' . $searchTerm2 . '%')
                  ->orWhere('description', 'LIKE', '%' . $searchTerm2 . '%')
                  ->orWhere('company', 'LIKE', '%' . $searchTerm2 . '%')
                  ->orWhere('products.id', 'LIKE', '%' . $searchTerm2 . '%');
            })
            ->orWhereHas('categorya', function($q) use($searchTerm2){
                $q->where('name', 'LIKE',  '%' . $searchTerm2 . '%');
            })
            ->orWhereHas('categoryb', function($q) use($searchTerm2){
                $q->where('name', 'LIKE',  '%' . $searchTerm2 . '%');
            })
            ->orWhereHas('categoryc', function($q) use($searchTerm2){
                $q->where('name', 'LIKE',  '%' . $searchTerm2 . '%');
            })
            ->orWhereHas('categoryd', function($q) use($searchTerm2){
                $q->where('name', 'LIKE',  '%' . $searchTerm2 . '%');
            })
            ->orderBy('products.id', 'desc')
            ->paginate(5);
            //->paginate(5,['*'],'products2');

        return (String) view('home.selectedProducts', compact('products2','searchTerm2'));
    }

    public function search(Request $request)
    //public function search()
    {
        if ($request->searchTerm)
        {
            $searchTerm = $request->searchTerm;
        }
        else
        {
            $searchTerm = "";
        }

        if ($searchTerm == "")
        {
            return "검색창이 비었습니다...";
        }

        ////Paginator::setPageName('page_b');

        ////$users = DB::table('users')
        ////    ->join('contacts', 'users.id', '=', 'contacts.user_id')
        ////    ->join('orders', 'users.id', '=', 'orders.user_id')
        ////    ->select('users.*', 'contacts.phone', 'orders.price')
        ////    ->get();

        ////$result = DB::table('products')
        ////    ->join('categoryas', 'products.categorya_id', '=', 'categoryas.id')

        ////$products = DB::table('products')
        ////    ->where('modelName', 'LIKE', '%' . $searchTerm . '%')
        ////    ->orWhere('eventName', 'LIKE', '%' . $searchTerm . '%')
        ////    ->orWhere('explaination', 'LIKE', '%' . $searchTerm . '%')
        ////    ->orWhere('description', 'LIKE', '%' . $searchTerm . '%')
        ////    ->orWhere('company', 'LIKE', '%' . $searchTerm . '%')
        ////    ->orWhere('products.id', 'LIKE', '%' . $searchTerm . '%')
        ////    ->get();

        ////$products = Product::with('categorya','categoryb')
        ////    ->where(function($q) use($searchTerm)
        ////    {
        ////        $q->where('modelName', 'LIKE', '%' . $searchTerm . '%')
        ////          ->orWhere('eventName', 'LIKE', '%' . $searchTerm . '%')
        ////          ->orWhere('explaination', 'LIKE', '%' . $searchTerm . '%')
        ////          ->orWhere('description', 'LIKE', '%' . $searchTerm . '%')
        ////          ->orWhere('company', 'LIKE', '%' . $searchTerm . '%')
        ////          ->orWhere('products.id', 'LIKE', '%' . $searchTerm . '%');
        ////    })
        ////    ->orWhereHas('categorya', function($qq) use($searchTerm){
        ////        $qq->where('name', 'LIKE',  '%' . $searchTerm . '%');
        ////    })
        ////    ->orWhereHas('categoryb', function($qq) use($searchTerm){
        ////        $qq->where('name', 'LIKE',  '%' . $searchTerm . '%');
        ////    })
        ////    ->get();

        $products = Product::
            select('id','categorya_id','categoryb_id',
                   'categoryc_id','categoryd_id',
                   'modelName','originPrice','sellPrice')
            ->where(function($q) use($searchTerm)
            {
                $q->where('modelName', 'LIKE', '%' . $searchTerm . '%')
                  ->orWhere('eventName', 'LIKE', '%' . $searchTerm . '%')
                  ->orWhere('explaination', 'LIKE', '%' . $searchTerm . '%')
                  ->orWhere('description', 'LIKE', '%' . $searchTerm . '%')
                  ->orWhere('company', 'LIKE', '%' . $searchTerm . '%')
                  ->orWhere('products.id', 'LIKE', '%' . $searchTerm . '%');
            })
            ->orWhereHas('categorya', function($q) use($searchTerm){
                $q->where('name', 'LIKE',  '%' . $searchTerm . '%');
            })
            ->orWhereHas('categoryb', function($q) use($searchTerm){
                $q->where('name', 'LIKE',  '%' . $searchTerm . '%');
            })
            ->orWhereHas('categoryc', function($q) use($searchTerm){
                $q->where('name', 'LIKE',  '%' . $searchTerm . '%');
            })
            ->orWhereHas('categoryd', function($q) use($searchTerm){
                $q->where('name', 'LIKE',  '%' . $searchTerm . '%');
            })
            ->orderBy('products.id', 'desc')
            ->paginate(3);
            //->paginate(3,['*'],'products');
            //->get();

        $qry = Product::
            select('categorya_id','categoryb_id', \DB::raw('count(*) as subCount'))
            ->where(function($q) use($searchTerm)
            {
                $q->where('modelName', 'LIKE', '%' . $searchTerm . '%')
                  ->orWhere('eventName', 'LIKE', '%' . $searchTerm . '%')
                  ->orWhere('explaination', 'LIKE', '%' . $searchTerm . '%')
                  ->orWhere('description', 'LIKE', '%' . $searchTerm . '%')
                  ->orWhere('company', 'LIKE', '%' . $searchTerm . '%')
                  ->orWhere('products.id', 'LIKE', '%' . $searchTerm . '%');
            })
            ->orWhereHas('categorya', function($q) use($searchTerm){
                $q->where('name', 'LIKE', '%' . $searchTerm . '%');
            })
            ->orWhereHas('categoryb', function($q) use($searchTerm){
                $q->where('name', 'LIKE', '%' . $searchTerm . '%');
            })
            ->orWhereHas('categoryc', function($q) use($searchTerm){
                $q->where('name', 'LIKE', '%' . $searchTerm . '%');
            })
            ->orWhereHas('categoryd', function($q) use($searchTerm){
                $q->where('name', 'LIKE', '%' . $searchTerm . '%');
            });

        $numRows = $qry->count();
        $group = $qry->groupBy('categorya_id','categoryb_id')
                 ->orderBy('categorya_id', 'asc')
                 ->orderBy('categoryb_id', 'asc')
                 ->get();

        return view('home.search', compact('products','numRows','group','searchTerm'));
    }
}
