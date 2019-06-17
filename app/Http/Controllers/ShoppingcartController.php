<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use Session;
use App\Shoppingcart;
use App\Exceptions\ShoppingCartException; ////08/04/2019
use Illuminate\Support\Str; ////11/04/2019
use App\First_option; ////29/04/2019
use App\Second_option; ////29/04/2019
use App\Product; ////29/04/2019

class ShoppingcartController extends Controller
{
    //주문결제 버튼 클릭 후에 실제 user(cartNum: 이메일번호)를
    //shoppingcarts에 업데이트 시킨다.
    //\vendor\laravel\framework\src\Illuminate\Foundation\Auth\AuthenticatesUsers.php로 옮김.
    //현재는 이곳에서 사용하지 않는다.지우지말것...
    public function cartMigrate()
    {
        //로그인 된 상태이면 email 번호가 cart 번호가 된다.
        $cartNum = '';
        if (!(Auth::guest()))
        {
            $cartNum = Auth::user()->email;
        }
        else
        {
            return "로그인이 필요합니다...";
        }

        // 인증되지 않은 사용자이지만, 쿠키값이 있다면,
        if (Session::get('laravelShoppingCartID'))
        {
            $oldCartNum = Session::get('laravelShoppingCartID');
        }
        else
        {
            return "해당 쿠키가 없습니다... ";
        }

        if ($cartNum == '')
        {
            return "장바구니 번호가 없읍니다...";
        }

        $carts = Shoppingcart::
            select('id','product_id','quantity')
            ->where('cartNum', '=', $oldCartNum)
            ->get();

        if ($carts){
            foreach ($carts as $cart)
            {
                $cart->cartNum = $cartNum;

                $cart->update();
            }
        }
    }

    //product/details View에서 Add Cart 버튼을 클릭하면 실행된다.
    //선택한 상품이 이미 장바구니에 있으면 찾아서 수량을 합산한다..
    public function addToCart(Request $request)
    {
        try{
            //$this->middleware('auth'); //왜 사용 했는지 몰라 코멘트 처리. 10/04/2019

            //로그인 된 상태이면 email 번호가 cart 번호가 된다.
            $cartNum = '';
            if (!(Auth::guest()))
            {
                $cartNum = Auth::user()->email;
            }
            else
            {
                // 인증되지 않은 사용자이지만, 쿠키값이 있다면,
                if (session()->has('laravelShoppingCartID'))
                {
                    $cartNum = session()->get('laravelShoppingCartID', 'default_value');
                }
                else
                {
                    // 비회원일 때에는 랜덤한 문자열을 받는다.
                    // 랜덤함 GUID 값 생성
                    //$tempCartId = $this->getGUID(); //향후 이부분을 hash함수로 대체 할 것.09/04/2019

                    $tempCartId = (String)str::uuid(); //추가 11/04/2019

                    // 쿠키에 tempCartId 값 저장
                    session()->put('laravelShoppingCartID',$tempCartId);
                    //위에서 저장한 후 다시 읽었다. test 할려고. 나중에 코멘트 처리 하고 아래 코드를 써도 된다. 10/04/2019
                    $cartNum = session()->get('laravelShoppingCartID', 'default_value');
                    // tempCartId 반환
                    //$cartNum = $tempCartId; //위를 코멘트 처리하고 이코드를 써도된다.
                }
            }

            //$date = date('Y-m-d H:i:s');
            $productId = $request->productId;;
            $quantity =  $request->quantity;;
            $originPrice = $request->originPrice;
            $sellPrice = $request->sellPrice;

            if (is_numeric($productId) && is_numeric($quantity) &&
                is_numeric($originPrice) && is_numeric($sellPrice) &&
                ($productId > 0) && ($quantity > 0) &&
                ($originPrice > 0) && ($sellPrice > 0))
            {
                //Nothing...
            }
            else
            {
                return "입력 데이터에 문제가 있습니다...";
            }

            $cart = Shoppingcart::
                select('id','product_id','quantity')
                ->where('cartNum', '=', $cartNum)
                ->where('product_id', '=', $productId)
                ->first();

            if ($cart){
                $cart->quantity = $cart->quantity + $quantity;

                $cart->update();
            }
            else
            {
                $cart = new Shoppingcart;

                $cart->product_id = $productId;
                $cart->quantity = $quantity;
                $cart->originPrice = $originPrice;
                $cart->sellPrice = $sellPrice;
                $cart->cartNum = $cartNum;

                $cart->save();
            }

            return 1;
        }
        catch(\Throwable $exception){
            //dd('Exception block', $exception); //working
            //echo $exception->getMessage(); //working ==>2nd option...
            throw new ShoppingCartException; //best option...실제로는 이렇게 처리해야 한다.

            //$errorMessage = $exception->getMessage();
            //echo '<h3 style="color: blue;">Throwable Errors...</h3>' . '<span style="color: red; font-size: 30px;">' . $errorMessage . '</span>';
        }
        catch (\Exception $exception) {
            //dd('Exception block', $exception); //working
            //echo $exception->getMessage(); //working ==>2nd option...
            throw new ShoppingCartException; //best option...실제로는 이렇게 처리해야 한다.

            //$errorMessage = $exception->getMessage();
            //echo '<h3 style="color: blue;">Exception Errors...</h3>' . '<span style="color: red; font-size: 30px;">' . $errorMessage . '</span>';
        }

        //return 0;
    }

    ////////////중요예제//////////////////////////////////////////////////////////////////////////////////////
    //product/details View의  옵션 상품이 있는 상태에서 장바구니 버튼을//////////////////////////////////////////
    //클릭하여 멀티플데이터를 처리하는 코드(view에서 json data로 넘어온다)////////////////////////////////////////
    ////////////////////////////////////////////////////////////////////////////////////////////////////////
    public function addToCartByMultiItems(Request $request)
    {
        //이곳은 json data가 view로 부터 오는 관계로 dd($request)를 사용하면 절대않됨.26/04/2019

        //로그인 된 상태이면 email 번호가 cart 번호가 된다.
        $cartNum = '';
        if (!(Auth::guest()))
        {
            $cartNum = Auth::user()->email;
        }
        else
        {
            // 인증되지 않은 사용자이지만, 쿠키값이 있다면,
            if (session()->has('laravelShoppingCartID'))
            {
                $cartNum = session()->get('laravelShoppingCartID', 'default_value');
            }
            else
            {
                // 비 회원일 때에는 랜덤한 문자열을 받는다.
                // 랜덤함 GUID 값 생성
                //$tempCartId = $this->getGUID(); //향후 이부분을 hash함수로 대체 할 것.09/04/2019

                $tempCartId = (String)str::uuid(); //추가 11/04/2019

                // 쿠키에 tempCartId 값 저장
                session()->put('laravelShoppingCartID',$tempCartId);
                //위에서 저장한 후 다시 읽었다. test 할려고. 나중에 코멘트 처리 하고 아래 코드를 써도 된다. 10/04/2019
                $cartNum = session()->get('laravelShoppingCartID', 'default_value');
                // tempCartId 반환
                //$cartNum = $tempCartId; //위를 코멘트 처리하고 이코드를 써도된다.
            }
        }

        if ($cartNum == '')
        {
            return "장바구니 번호가 없읍니다...";
        }

        /////////////////////////////////////////////////////////////////////////////////////////////
        ////product/details 뷰에서 post(json)로 넘어온 값==>중요한 예제
        /////////////////////////////////////////////////////////////////////////////////////////////
        $inputData = '';
        if (count($request->json()->all())) {
            $inputData = $request->json()->all();
        }
        else
        {
            return "입력 내용이 없습니다...";
        }

        //$date = date('Y-m-d H:i:s'); //stop but do not delete 29/04/2019

        $option_id = NULL;
        $quantity = 0;
        $numOfErrors = 0;
        $productId = 0;
        $option1_id = NULL;
        $option2_id = NULL;
        $option2Amount = 0;
        $option1Amount = 0;
        $originPrice = 0;
        $sellPrice = 0;

        foreach($inputData as $item)
        {
            for ($i = 0; $i < count($item); $i++)
            {
                $quantity = $item[$i]['quantity'];
                $optionCode = $item[$i]['optionCode'];
                $option_id = $item[$i]['option_id'];

                if (is_numeric($quantity) &&  is_numeric($option_id)  &&
                   ($quantity > 0) && ($option_id > 0))
                {
                    if ($optionCode == 1){
                        $option1 = First_option::findOrFail($option_id);
                        if ($option1){
                            $option1Amount = $option1->amount;
                            $option2Amount = 0;
                            $option1_id = $option_id;
                            $option2_id = NULL;
                            $productId = $option1->product_id;
                        }
                        else
                        {
                            return "First_option table not found...";
                        }
                    }

                    if ($optionCode == 2){
                        $option2 = Second_option::findOrFail($option_id);
                        if ($option2){
                            $option2Amount = $option2->amount;
                            $option1Amount = 0;
                            $option1_id = $option2->first_option_id;
                            $option2_id = $option_id;
                            $productId = $option2->product_id;
                        }
                        else
                        {
                            return "Second_option table not found...";
                        }
                    }

                    $product = Product::findOrFail($productId);
                    if ($product){
                        $originPrice = $product ->originPrice;
                        $sellPrice = $product->sellPrice;
                    }
                    else{
                        return "product table not found...";
                    }

                    //cart에 동일 상품이 있으면 수량을 합산한다.
                    $cart = Shoppingcart::
                    select('id','quantity')
                    ->where('cartNum', '=', $cartNum)
                    ->where('product_id', '=', $productId)
                    ->where('first_option_id', '=', $option1_id)
                    ->where('second_option_id', '=', $option2_id)
                    ->first();
                    if ($cart){
                        $cart->quantity = $cart->quantity + $quantity;

                        $cart->update();
                    }
                    else{ //cart에 동일 상품이 없으면 새로 만든다
                        $cart = new Shoppingcart;
                        $cart->product_id = $productId;
                        $cart->optionCode = $optionCode;
                        $cart->first_option_id = $option1_id;
                        $cart->second_option_id = $option2_id;
                        $cart->quantity = $quantity;
                        $cart->firstOptionAmount = $option1Amount;
                        $cart->secondOptionAmount = $option2Amount;
                        $cart->originPrice = $originPrice;
                        $cart->sellPrice = $sellPrice;
                        $cart->cartNum = $cartNum;

                        $return = $cart->save();
                        if (!$return)
                        {
                            $numOfErrors++;
                        }
                    }
                }
                else
                {
                    $numOfErrors++;
                }
            }
        }

        if ($numOfErrors > 0){
            return "입력 DATA에 문제가 있습니다...";
        }
        else{
            return 1;
        }
    }

    ////사용 중지. 11/04/2019 GUID
    ////GUID 발생 함수가 시스템에 없어 임시로 만든 함수임.
    ////추후에 시스템에서 제공하는 함수로 교체할것...
    //protected function getGUID(){
    //    if (function_exists('com_create_guid')){
    //        return com_create_guid();
    //    }else{
    //        mt_srand((double)microtime()*10000);//optional for php 4.2.0 and up.
    //        $charid = strtoupper(md5(uniqid(rand(), true)));
    //        $hyphen = chr(45);// "-"
    //        $uuid = chr(123)// "{"
    //            .substr($charid, 0, 8).$hyphen
    //            .substr($charid, 8, 4).$hyphen
    //            .substr($charid,12, 4).$hyphen
    //            .substr($charid,16, 4).$hyphen
    //            .substr($charid,20,12)
    //            .chr(125);// "}"
    //        return $uuid;
    //    }
    //}

    ////cartList 장바구니 보여주기에서 수량을 선택하면
    ////해당 상품을 shoppingcarts에서 찾아 갱신한다
    public function changeToCart(Request $request)
    {
        $productId = $request->productId;
        $cartId = $request->cartId;
        $quantity = $request->quantity;

        //로그인 된 상태이면 email 번호가 cart 번호가 된다.
        $cartNum = '';
        if (!(Auth::guest()))
        {
            $cartNum = Auth::user()->email;
        }
        else
        {
            // 인증되지 않은 사용자이지만, 쿠키값이 있다면,
            if (session()->has('laravelShoppingCartID'))
            {
                $cartNum = session()->get('laravelShoppingCartID', 'default_value');
            }
        }

        if ($cartNum == '')
        {
            return "장바구니 번호가 없읍니다...";
        }

        if (is_numeric($cartId) && is_numeric($quantity) &&
                     ($cartId > 0) && ($quantity > 0))
        {
            //Nothing...
        }
        else
        {
            return "입력 데이터에 문제가 있습니다...";
        }

        $cart = Shoppingcart::findOrFail($cartId);

        if ($cart){
            $cart->quantity = $quantity;

            $cart->update();

            ////$cart = Shoppingcart::findOrFail($cartId);/////

            //return 1;/////

            ////아래는 보류...10/05/2019
            ////로컬서버에서 문제가 있어 중단 하였으나 실서버에는 문제가 없어
            ////작동 중.25/05/2019
            $qry = Shoppingcart::
            select('shoppingcarts.id AS cartId','products.id AS productId',
                'shoppingcarts.quantity','shoppingcarts.originPrice','shoppingcarts.optionCode',
                'shoppingcarts.sellPrice','shoppingcarts.firstOptionAmount','shoppingcarts.secondOptionAmount',
                'products.searchImage AS searchImage','products.owner AS owner','products.deliveryCode AS deliveryCode',
                'products.deliveryCost AS deliveryCost','products.deliveryFreeMinimum AS deliveryFreeMinimum',
                'products.modelName AS modelName','first_options.description AS firstDescription',
                'second_options.description AS secondDescription')
            ->join('products', 'products.id','=','shoppingcarts.product_id')
            ->leftjoin('first_options','first_options.id','=','shoppingcarts.first_option_id')
            ->leftjoin('second_options','second_options.id','=','shoppingcarts.second_option_id')
            ->where('cartNum', '=', $cartNum)
            ->orderBy('products.owner', 'asc')
            ->orderBy('products.id', 'asc');

            ////dd($qry->get());

            $numRows = $qry->count();

            $carts = $qry->paginate(1000);

            return (string) view('shoppingcart/cartListWithCdnForAjax', compact('carts','numRows'));
        }
        else
        {
            return "갱신에 실패 했습니다...";
        }
    }

    ////cartList 장바구니 보여주기에서 체크박스 선택후 삭제버튼을 누르면
    ////해당 상품을 shoppingcarts에서 찾아 지운다.
    ////(복수도 가능:어레이사용)/////////////////////////////////////
    public function deleteSelected(Request $request)
    {
        //로그인 된 상태이면 email 번호가 cart 번호가 된다.
        $cartNum = '';
        if (!(Auth::guest()))
        {
            $cartNum = Auth::user()->email;
        }
        else
        {
            // 인증되지 않은 사용자이지만, 쿠키값이 있다면,
            if (session()->has('laravelShoppingCartID'))
            {
                $cartNum = session()->get('laravelShoppingCartID', 'default_value');
            }
        }

        if ($cartNum == '')
        {
            return "장바구니 번호가 없읍니다...";
        }

        $input = $request->ids;

        if (count($input) < 1)
        {
            return "No Item(s) to Delete...";
        }
        else
        {
            try
            {
                for ($i = 0; $i < count($input); $i++)
                {
                   $id = $input[$i];

                   Shoppingcart::destroy($id);
                   //Shoppingcart:: findOrFail($id)
                   //               ->delete();
                }
            }
            catch (Exception $e)
            {
                return $e->getMessage();
            }

            $qry = Shoppingcart::
            select('shoppingcarts.id AS cartId','products.id AS productId',
                'shoppingcarts.quantity','shoppingcarts.originPrice','shoppingcarts.optionCode',
                'shoppingcarts.sellPrice','shoppingcarts.firstOptionAmount','shoppingcarts.secondOptionAmount',
                'products.searchImage AS searchImage','products.owner AS owner','products.deliveryCode AS deliveryCode',
                'products.deliveryCost AS deliveryCost','products.deliveryFreeMinimum AS deliveryFreeMinimum',
                'products.modelName AS modelName','first_options.description AS firstDescription',
                'second_options.description AS secondDescription')
            ->join('products', 'products.id','=','shoppingcarts.product_id')
            ->leftjoin('first_options','first_options.id','=','shoppingcarts.first_option_id')
            ->leftjoin('second_options','second_options.id','=','shoppingcarts.second_option_id')
            ->where('cartNum', '=', $cartNum)
            ->orderBy('products.owner', 'asc')
            ->orderBy('products.id', 'asc');

            ////dd($qry->get());

            $numRows = $qry->count();

            $carts = $qry->paginate(1000);

            ////쇼핑카트 속의 카운트 수를 구하여 세션에 저장한다.
            session()->put('laravelCartCount',$numRows);

            return (string) view('shoppingcart/cartListWithCdnForAjax', compact('carts','numRows'));
        }

        ////json으로 post 된 경우의 코드...지우지 말 것.
        ////cartList 뷰에서 post(json)로 넘어온 값
        //$inputData = '';
        //if (count($request->json()->all())) {
        //    $inputData = $request->json()->all();
        //}
        //else
        //{
        //    return "입력 내용이 없습니다...";
        //}
        //foreach($inputData as $item)
        //{
        //    for ($i = 0; $i < count($item); $i++)
        //    {
        //        $ids = $item[$i]['ids'];

        //        if (is_numeric($ids) && ($ids > 0))
        //        {

        //        }
        //        else
        //        {

        //        }
        //    }
        //}
    }

    //메인메뉴의 장바구니를 클릭하면 실행된다.
    //product/details에서 장바구니를 클릭하면 ajax에서 콜한다
    public function cartListWithCdn()
    {
        //로그인 된 상태이면 email 번호가 cart 번호가 된다.
        $cartNum = '';
        if (!(Auth::guest()))
        {
            $cartNum = Auth::user()->email;
        }
        else
        {
            // 인증되지 않은 사용자이지만, 쿠키값이 있다면,
            if (session()->has('laravelShoppingCartID'))
            {
                $cartNum = session()->get('laravelShoppingCartID', 'default_value');
            }
        }
        //if ($cartNum == '')
        //{
        //    return "장바구니 번호가 없읍니다...";
        //}

        $qry = Shoppingcart::
            select('shoppingcarts.id AS cartId','products.id AS productId',
                'shoppingcarts.quantity','shoppingcarts.originPrice','shoppingcarts.optionCode',
                'shoppingcarts.sellPrice','shoppingcarts.firstOptionAmount','shoppingcarts.secondOptionAmount',
                'products.searchImage AS searchImage','products.owner AS owner','products.deliveryCode AS deliveryCode',
                'products.deliveryCost AS deliveryCost','products.deliveryFreeMinimum AS deliveryFreeMinimum',
                'products.modelName AS modelName','first_options.description AS firstDescription',
                'second_options.description AS secondDescription')
            ->join('products', 'products.id','=','shoppingcarts.product_id')
            ->leftjoin('first_options','first_options.id','=','shoppingcarts.first_option_id')
            ->leftjoin('second_options','second_options.id','=','shoppingcarts.second_option_id')
            ->where('cartNum', '=', $cartNum)
            ->orderBy('products.owner', 'asc')
            ->orderBy('products.id', 'asc');

        //dd($qry->get());

        $numRows = $qry->count();

        $carts = $qry->paginate(1000);

        return view('shoppingcart/cartListWithCdn', compact('carts','numRows'));
    }

    //메인메뉴의 장바구니를 클릭하면 실행된다.
    //product/details에서 장바구니를 클릭하면 ajax에서 콜한다
    //사용중지....03/05/2019
    public function cartList()
    {
        //로그인 된 상태이면 email 번호가 cart 번호가 된다.
        $cartNum = '';
        if (!(Auth::guest()))
        {
            $cartNum = Auth::user()->email;
        }
        else
        {
            // 인증되지 않은 사용자이지만, 쿠키값이 있다면,
            if (session()->has('laravelShoppingCartID'))
            {
                $cartNum = session()->get('laravelShoppingCartID', 'default_value');
            }
        }
        //if ($cartNum == '')
        //{
        //    return "장바구니 번호가 없읍니다...";
        //}

        $qry = Shoppingcart::
            //select('id','product_id','quantity','originPrice','sellPrice')
            select('*')
            ->where('cartNum', '=', $cartNum);

        //$sellPriceSum = $qry->sum('sellPrice');

        $numRows = $qry->count();

        $carts = $qry->paginate(1000);

        return view('shoppingcart/cartList', compact('carts','numRows'));
    }

    ////ajax로 controller에 접근시 middleware(auth)문제를 해결 하지 못해
    ////임시로 사용. 26/05/2019
    public function buyNowWithoutLogin(Request $request)
    {
        //이곳은 json data가 view로 부터 오는 관계로 dd($request)를 사용하면 절대않됨.26/04/2019

        //로그인 된 상태이면 email 번호가 cart 번호가 된다.
        $cartNum = '';
        if (!(Auth::guest()))
        {
            $cartNum = Auth::user()->email;
        }
        else
        {
            // 인증되지 않은 사용자이지만, 쿠키값이 있다면,
            if (session()->has('laravelShoppingCartID'))
            {
                $cartNum = session()->get('laravelShoppingCartID', 'default_value');
            }
            else
            {
                // 비 회원일 때에는 랜덤한 문자열을 받는다.
                // 랜덤함 GUID 값 생성
                //$tempCartId = $this->getGUID(); //향후 이부분을 hash함수로 대체 할 것.09/04/2019

                $tempCartId = (String)str::uuid(); //추가 11/04/2019

                // 쿠키에 tempCartId 값 저장
                session()->put('laravelShoppingCartID',$tempCartId);
                //위에서 저장한 후 다시 읽었다. test 할려고. 나중에 코멘트 처리 하고 아래 코드를 써도 된다. 10/04/2019
                $cartNum = session()->get('laravelShoppingCartID', 'default_value');
                // tempCartId 반환
                //$cartNum = $tempCartId; //위를 코멘트 처리하고 이코드를 써도된다.
            }
        }

        if ($cartNum == '')
        {
            return "장바구니 번호가 없읍니다...";
        }

        /////////////////////////////////////////////////////////////////////////////////////////////
        ////product/details 뷰에서 post(json)로 넘어온 값==>중요한 예제
        /////////////////////////////////////////////////////////////////////////////////////////////
        $inputData = '';
        if (count($request->json()->all())) {
            $inputData = $request->json()->all();
        }
        else
        {
            return "입력 내용이 없습니다...";
        }

        //$date = date('Y-m-d H:i:s'); //stop but do not delete 29/04/2019

        $option_id = NULL;
        $quantity = 0;
        $numOfErrors = 0;
        $productId = 0;
        $option1_id = NULL;
        $option2_id = NULL;
        $option2Amount = 0;
        $option1Amount = 0;
        $originPrice = 0;
        $sellPrice = 0;

        foreach($inputData as $item)
        {
            for ($i = 0; $i < count($item); $i++)
            {
                $quantity = $item[$i]['quantity'];
                $optionCode = $item[$i]['optionCode'];
                $option_id = $item[$i]['option_id'];

                if (is_numeric($quantity) &&  is_numeric($option_id)  &&
                   ($quantity > 0) && ($option_id > 0))
                {
                    if ($optionCode == 1){
                        $option1 = First_option::findOrFail($option_id);
                        if ($option1){
                            $option1Amount = $option1->amount;
                            $option2Amount = 0;
                            $option1_id = $option_id;
                            $option2_id = NULL;
                            $productId = $option1->product_id;
                        }
                        else
                        {
                            return "First_option table not found...";
                        }
                    }

                    if ($optionCode == 2){
                        $option2 = Second_option::findOrFail($option_id);
                        if ($option2){
                            $option2Amount = $option2->amount;
                            $option1Amount = 0;
                            $option1_id = $option2->first_option_id;
                            $option2_id = $option_id;
                            $productId = $option2->product_id;
                        }
                        else
                        {
                            return "Second_option table not found...";
                        }
                    }

                    $product = Product::findOrFail($productId);
                    if ($product){
                        $originPrice = $product ->originPrice;
                        $sellPrice = $product->sellPrice;
                    }
                    else{
                        return "product table not found...";
                    }

                    //cart에 동일 상품이 있으면 수량을 합산한다.
                    $cart = Shoppingcart::
                    select('id','quantity')
                    ->where('cartNum', '=', $cartNum)
                    ->where('product_id', '=', $productId)
                    ->where('first_option_id', '=', $option1_id)
                    ->where('second_option_id', '=', $option2_id)
                    ->first();
                    if ($cart){
                        $cart->quantity = $cart->quantity + $quantity;

                        $cart->update();
                    }
                    else{ //cart에 동일 상품이 없으면 새로 만든다
                        $cart = new Shoppingcart;
                        $cart->product_id = $productId;
                        $cart->optionCode = $optionCode;
                        $cart->first_option_id = $option1_id;
                        $cart->second_option_id = $option2_id;
                        $cart->quantity = $quantity;
                        $cart->firstOptionAmount = $option1Amount;
                        $cart->secondOptionAmount = $option2Amount;
                        $cart->originPrice = $originPrice;
                        $cart->sellPrice = $sellPrice;
                        $cart->cartNum = $cartNum;

                        $return = $cart->save();
                        if (!$return)
                        {
                            $numOfErrors++;
                        }
                    }
                }
                else
                {
                    $numOfErrors++;
                }
            }
        }

        if ($numOfErrors > 0){
            return "입력 DATA에 문제가 있습니다...";
        }
        else{
            //return 1;
            $qry = Shoppingcart::
            select('shoppingcarts.id AS cartId','products.id AS productId',
                'shoppingcarts.quantity','shoppingcarts.originPrice','shoppingcarts.optionCode',
                'shoppingcarts.sellPrice','shoppingcarts.firstOptionAmount','shoppingcarts.secondOptionAmount',
                'products.searchImage AS searchImage','products.owner AS owner','products.deliveryCode AS deliveryCode',
                'products.deliveryCost AS deliveryCost','products.deliveryFreeMinimum AS deliveryFreeMinimum',
                'products.modelName AS modelName','first_options.description AS firstDescription',
                'second_options.description AS secondDescription')
            ->join('products', 'products.id','=','shoppingcarts.product_id')
            ->leftjoin('first_options','first_options.id','=','shoppingcarts.first_option_id')
            ->leftjoin('second_options','second_options.id','=','shoppingcarts.second_option_id')
            ->where('cartNum', '=', $cartNum)
            ->orderBy('products.owner', 'asc')
            ->orderBy('products.id', 'asc');

            //dd($qry->get());

            $numRows = $qry->count();

            $carts = $qry->paginate(1000);

            return (String) view('shoppingcart/buyNowWithoutLogin', compact('carts','numRows'));
        }
    }
}
