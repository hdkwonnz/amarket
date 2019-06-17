<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Categorya;
use App\Categoryb;
use App\Categoryc;
use App\Categoryd;
use App\Product;
use App\Picture;
use Auth;
use App\First_option;
use App\Second_option;

use App\Admin;

//use Illuminate\Support\Facades\Input as Input;

class SellerController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    //Access Level Control를 위해 추가.  22/03/2019
    public function __construct()
    {
        $this->middleware('auth:admin');
        $this->middleware('seller');  //이렇게 하면 seller로 login한 사람만 들어 올수 있다.
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    //Access Level Control를 위해 추가.  22/03/2019
    public function index()
    {
        return view('seller.index');
    }

    public function updateProduct(Request $request)
    {
        //validation...18/04/2019

        $productId = $request->productId;

        $product = Product::findOrfail($productId);

        $product->categorya_id = $request->categoryAId;
        $product->categoryb_id = $request->categoryBId;
        $product->categoryc_id = $request->categoryCId;
        $product->categoryd_id = $request->categoryDId;
        $product->modelNumber  = $request->txtModelNumber;
        $product->modelName    = $request->txtModelName;
        $product->company      = $request->txtCompany;
        $product->originPrice  = $request->txtOriginPrice;
        $product->sellPrice    = $request->txtSellPrice;
        $product->eventName    = $request->txtEventName;
        $product->searchImage = $request->txtsearchImage;
        $product->productImage = $request->txtproductImage;
        //$product->explaination = $request->txtExplaination; //18/04/2019
        $product->description  = $request->txtDescription;

        $result = $product->update();

        if ($result)
        {
            return 1;
        }
        else
        {
            return 0;
        }

    }

    public function currentPicture()
    {
        $productId = $_GET['productId'];

        //$pictures = Picture::select('*')
        //    ->where('product_id','=',$productId)
        //    ->get();

        $pictures = Picture::
            where('product_id','=',$productId)
            ->get();

        return (string) view('seller/currentPicture', compact('pictures'));
    }

    public function deletePicture(Request $request)
    {
        $pictureId = $request->pictureId;
        $fileName = $request->fileName;

        $return = Picture::destroy($pictureId);

        if ($return)
        {
            unlink(public_path().'/uploadFiles/pictures/sellers/'.$fileName);

            return 1;
        }
        else
        {
            return 0;
        }
    }

    public function countPicture()
    {
        $productId = $_GET['productId'];

        $count = Picture::select('id')
            ->where('product_id','=',$productId)
            ->count();

        return response(['success' => true,'count' => $count]);//
    }

    //
    public function showMyProduct()
    {
        $owner = Auth::user()->email;

        $products = Product::
            select('id','categorya_id','categoryb_id',
                   'categoryc_id','categoryd_id',
                   'modelName','originPrice','sellPrice')
            ->where('owner','=', $owner)
            ->orderBy('products.id', 'desc')
            ->paginate(3);

        return view('seller/myProduct', compact('products'));
    }

    public function modifyProduct(Request $request)
    {
        $productId = $request->id;

        //$product = Product::
        //  where('id', '=', $productId)
        //  ->get();

        $product = Product::findOrFail($productId);

        $categoryas = Categorya::all();

        return view('seller/modifyProduct', compact('product','categoryas'));
    }

    //사용 중지 07/04/2019
    public function inputProduct()
    {
        $categoryas = Categorya::all();

        return view('seller/inputProduct', compact('categoryas'));
    }

    //사용 중지 18/04/2019
    public function inputProductWithProgressBar()
    {
        $categoryas = Categorya::all();

        return view('seller/inputProductWithProgressBar', compact('categoryas'));
    }

    //
    public function inputProductWithCdn()
    {
        $categoryas = Categorya::all();

        return view('seller/inputProductWithCdn', compact('categoryas'));
    }

    public function selectCategoryB(Request $request)
	{
        $id = $request->id;

        $categorybs = Categoryb::
           where('categorya_id', '=', $id)
           ->get();

        return (string) view('seller/categoryBShow', compact('categorybs'));
    }

    public function selectCategoryC(Request $request)
	{
        $id = $request->id;
        $id2 = $request->id2;

        $categorycs = Categoryc::
           where('categorya_id', '=', $id)
           ->where('categoryb_id', '=', $id2)
           ->get();

        return (string) view('seller/categoryCShow', compact('categorycs'));
    }

    public function selectCategoryD(Request $request)
	{
        $id = $request->id;
        $id2 = $request->id2;
        $id3 = $request->id3;

        $categoryds = Categoryd::
           where('categorya_id', '=', $id)
           ->where('categoryb_id', '=', $id2)
           ->where('categoryc_id', '=', $id3)
           ->get();

        return (string) view('seller/categoryDShow', compact('categoryds'));
    }

    ////optionOneCreate Ajax에서 어레이로 넘어온 데이터
    ////deleteOptionOne
    public function deleteOptionOne(Request $request)
    {
        ////어레이로 넘어온 데이터/////////중요항 예제///////
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

                    First_option::destroy($id);

                }
            }
            catch (Exception $e)
            {
                return $e->getMessage();
            }

            return 1;
        }
    }

    ////optionOneCreate Ajax에서 어레이로 넘어온 데이터
    ////deleteOptionOne
    public function deleteOptionTwo(Request $request)
    {
        ////어레이로 넘어온 데이터/////////중요항 예제///////
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

                    Second_option::destroy($id);

                }
            }
            catch (Exception $e)
            {
                return $e->getMessage();
            }

            return 1;
        }
    }

    ////optionOneCreate
    ////public function optionOneCreate($productId)
    public function optionOneCreate()
    {
        //if (!$productId)
        //{
        //    return "No ProductId...";
        //}

        if ($_GET['productId'])
        {
            $productId = $_GET['productId'];
            $modelName = $_GET['modelName'];
            $optionCode = $_GET['optionCode'];
        }
        else
        {
            return "No ProductId...";

        }

        $query = First_option::
            select('*')
            ->where('first_options.product_id','=',$productId)
            ->orderBy('description','asc');

        $numOfRow = $query->count();
        $optionOnes = $query->get();

        return view('seller.optionOneCreate', compact('optionOnes','productId','modelName','numOfRow','optionCode'));
        //return (String) view('seller.optionOneCreate', compact('productId','modelName','optionCode'));
    }

    ////optionTwoCreate
    ////public function optionOneCreate($productId)
    public function optionTwoCreate()
    {
        //if (!$productId)
        //{
        //    return "No ProductId...";
        //}

        if ($_GET['productId'] && $_GET['optionOneId'])
        {
            $productId = $_GET['productId'];
            $optionOneId = $_GET['optionOneId'];
            $description = $_GET['description'];
        }
        else
        {
            return "No ProductId Or No optionOneId...";
        }

       $query = Second_option::
           select('*')
           ->where('first_option_id','=', $optionOneId)
           ->where('product_id','=',$productId)
           ->orderBy('description', 'asc');

       $numOfRow = $query->count();
       $optionTwos = $query->get();

       return (String) view('seller.optionTwoCreate', compact('numOfRow','optionTwos','productId','description','optionOneId'));
    }

    ////optionOneCreateForOptionTwo
    ////public function optionOneCreate($productId)
    public function optionOneCreateForOptionTwo()
    {
        //if (!$productId)
        //{
        //    return "No ProductId...";
        //}

        if ($_GET['productId'])
        {
            $productId = $_GET['productId'];
            $modelName = $_GET['modelName'];
            $optionCode = $_GET['optionCode'];
        }
        else
        {
            return "No ProductId...";

        }

        $query = First_option::
            select('*')
            ->where('first_options.product_id','=',$productId)
            ->orderBy('description','asc');

        $numOfRow = $query->count();
        $optionOnes = $query->get();

        return (String) view('seller.optionOneCreateForOptionTwo', compact('optionOnes','numOfRow','productId','modelName','optionCode'));
    }

    ////optionOneStore
    public function optionOneStore(Request $request)
    {
        //dd($request->all());         //do not delete...16/05/2019
        ////return $request->txtName[2]; //do not delete...16/05/2019

        if (!(Auth::guest()))
        {
            $owner = Auth::user()->email;
        } else {
            //return "login error...";
            return response(['success' => false, 'errorMessage' => 'login error...']);
            //return response(['success' => false, 'lastProductNo' => '',
            //       'optionCode' => '', 'errorMessage' => '로그인이 필요합니다...']);
        }

        $productId = $request->txtProductId;

        $product = Product::findOrFail($productId);

        if ($owner != $product->owner)
        {
            //return "상품 오너가 아닙니다...";
            return response(['success' => false, 'errorMessage' => '상품 오너가 아닙니다...']);
        }

        $modelName = $request->txtModelName;
        $optionCode = $request->txtOptionCode;
        $numOfRow = $request->txtNumOfRow;
        $NumOfErrors = 0;

        if (is_numeric($request->txtProductId))
        {
           //ok...
        }
        else{
            //return "No ProductId...";
            return response(['success' => false, 'errorMessage' => 'No ProductId...']);
        }

        ////옵션 갯수다 10개라고 가정
        for ($i = 0; $i < (10 - $numOfRow); $i++) //반드시 page에 나열된 (수 - 1) 만큼 i를 줄것
        {
            if ($request->txtName[$i] == null ||
                $request->txtStock[$i] < 0 || $request->txtProductId == 0)
            {
                $NumOfErrors++;
                break;
            }
            else{
                $optionOne = new First_option;

                $optionOne->product_id = $request->txtProductId;
                $optionOne->description = $request->txtName[$i];

                if ($request->txtPrice[$i] == "")
                {
                    $optionOne->amount = 0;
                }
                else{
                    $optionOne->amount = $request->txtPrice[$i];
                }

                if ($request->txtStock[$i] == "")
                {
                    $optionOne->stock = 0;
                }
                else{
                    $optionOne->stock = $request->txtStock[$i];
                }

                $optionOne->save();
            }
        }

        if ($NumOfErrors > 1)
        {
            //return "입력 실패 입니다...";
            return response(['success' => false, 'errorMessage' => '입력 실패 입니다...']);
        }
        ////////redirect ===> parameter를 passing 한다./////////////////////////
        /////////////////////////중요한 예제////////////////////////////////////
        if ($optionCode == 1)
        {
            //return redirect()->action('SellerController@optionOneShow', ['productId' => $productId, 'modelName' => $modelName, 'optionCode' => $optionCode]);
            return response(['success' => true, 'errorMessage' => '']);
        }
        elseif ($optionCode == 2){
            //return redirect()->action('SellerController@optionOneShowForOptionTwo', ['productId' => $productId, 'modelName' => $modelName]);
            return response(['success' => true, 'errorMessage' => '']);
        }else{
            return "준비중...";
        }
    }

    ////optionTwoStore
    public function optionTwoStore(Request $request)
    {
        ////dd($request->all());         //do not delete...16/05/2019
        ////return $request->txtName[2]; //do not delete...16/05/2019

        if (!(Auth::guest()))
        {
            $owner = Auth::user()->email;
        } else {
            return response(['success' => false, 'errorMessage' => 'login error...']);
            //return response(['success' => false, 'lastProductNo' => '',
            //       'optionCode' => '', 'errorMessage' => '로그인이 필요합니다...']);
        }

        $productId = $request->txtProductId;

        $product = Product::findOrFail($productId);

        if ($owner != $product->owner)
        {
            return response(['success' => false, 'errorMessage' => '상품 오너가 아닙니다...']);
        }

        $modelName = $request->txtModelName;
        ////$optionCode = $request->txtOptionCode;
        $numOfRow = $request->txtNumOfRow;
        $optionOneId = $request->txtOptionOneId;
        $NumOfErrors = 0;

        if (is_numeric($request->txtProductId) && is_numeric($request->txtOptionOneId))
        {
            //ok...
        }
        else{
            //return "No ProductId Or No OptionOneId...";
            return response(['success' => false, 'errorMessage' => 'No ProductId Or No OptionOneId...']);
        }

        ////옵션을 10개 까지만 허용한다고 가정하자...
        for ($i = 0; $i < (10 - $numOfRow); $i++) //반드시 page에 나열된 (수 - 1) 만큼 i를 줄것
        {
            if ($request->txtName[$i] == null ||
                $request->txtStock[$i] < 0 || $request->txtProductId == 0)
            {
                $NumOfErrors++;
                break;
            }
            else{
                $optionTwo = new Second_option;

                $optionTwo->first_option_id = $request->txtOptionOneId;
                $optionTwo->product_id = $request->txtProductId;
                $optionTwo->description = $request->txtName[$i];

                if ($request->txtPrice[$i] == "")
                {
                    $optionTwo->amount = 0;
                }
                else{
                    $optionTwo->amount = $request->txtPrice[$i];
                }

                if ($request->txtStock[$i] == "")
                {
                    $optionTwo->stock = 0;
                }
                else{
                    $optionTwo->stock = $request->txtStock[$i];
                }

                $optionTwo->save();
            }
        }
        ////////redirect ===> parameter를 passing 한다./////////////////////////
        /////////////////////////중요한 예제////////////////////////////////////
        //if ($optionCode == 1)
        //{
        //    return redirect()->action('SellerController@optionOneShow', ['productId' => $productId, 'modelName' => $modelName]);
        //}
        //elseif ($optionCode == 2){
        //    return redirect()->action('SellerController@optionOneShowForOptionTwo', ['productId' => $productId, 'modelName' => $modelName]);
        //}else{
        //    return "준비중...";
        //}
        //return "good...";
        if ($NumOfErrors > 1){
            return response(['success' => false, 'errorMessage' => '입력 실패 입니다...']);
        }else{
            return response(['success' => true, 'errorMessage' => '입력 완료 되었습니다...']);
        }
    }

    ////optionOneShow
    public function optionOneShow($productId, $modelName,$optionCode)
    {
        if (!$productId)
        {
            return "No ProductId...";
        }

        $query = First_option::
            select('*')
            ->where('first_options.product_id','=',$productId)
            ->orderBy('description','asc');

        $numOfRow = $query->count();
        $optionOnes = $query->get();

        return view('seller.optionOneShow', compact('optionOnes','productId','modelName','numOfRow','optionCode'));
    }

    ////optionOneShowForOptionTwo
    //public function optionOneShowForOptionTwo($productId, $modelName)
    public function optionOneShowForOptionTwo()
    {
        if ($_GET['productId'])
        {
            $productId = $_GET['productId'];
            $modelName = $_GET['modelName'];
        }
        else
        {
            return "No ProductId...";

        }

        if (!$productId)
        {
            return "No ProductId...";
        }

        $optionOnes = First_option::
            select('*')
            ->where('first_options.product_id','=',$productId)
            ->get();

        //return view('seller.optionOneShowForOptionTwo', compact('optionOnes','productId','modelName'));
        return (String) view('seller.optionOneShowForOptionTwo', compact('optionOnes','productId','modelName'));
    }

    ////처리 결과를 어레이로 return 한다.//////////////////////////////////////
    ////중요한 예제...///////////////////////////////////////////////////////
    public function insertProduct(Request $request)
	{
        //dd($request->all());

        ////validaton check ==>must have...16/04/2019/////////////////////
        $owner = '';
        if (!(Auth::guest()))
        {
            $owner = Auth::user()->email;
        } else {
            //return 0;
            return response(['success' => false, 'lastProductNo' => '',
                   'optionCode' => '', 'errorMessage' => '로그인이 필요합니다...']);
        }

        $product = new Product;

        $date = date('Y-m-d H:i:s');

        $product->categorya_id = $request->categoryAId;
        $product->categoryb_id = $request->categoryBId;
        $product->categoryc_id = $request->categoryCId;
        $product->categoryd_id = $request->categoryDId;
        ////$product->modelNumber  = $request->txtModelNumber;//to be sobsoleted..14/05/2019
        $product->modelName    = $request->txtModelName;
        $product->company      = $request->txtCompany;
        $product->countryOfProduct = $request->input('txtCountryOfProduct');//html select에서 온 값...
        $product->originPrice  = $request->txtOriginPrice;
        $product->sellPrice    = $request->txtSellPrice;
        $sellLastDate = $request->input('txtSellTerm'); //html select에서 온 값...
        $sellTerm = date("Y-m-d", strtotime("+$sellLastDate days")); //오늘로부터 며칠후 구하기.
        $product->sellTerm = $sellTerm;
        $product->eventName    = $request->txtEventName;
        $product->searchImage = $request->txtSearchImage;
        $product->productImage = $request->txtProductImage;
        ////$product->explaination = $request->txtExplaination; //to be sobsoleted..18/04/2019
        $product->description  = $request->txtDescription;
        $product->registDate   = $date;
        $product->productCount = $request->txtStock;

        if ($request->txtOverseasDelivery == "on"){ //html check box
            $product->overseasDelivery = 1;
        } else{
            $product->overseasDelivery = 0;
        }

        if ($request->txtDeliveryCode == "on"){
            if ( $request->txtDeliveryCost < 2500 || $request->txtDeliveryFreeMinimum < 2500)
            {
                //return 0;
                return response(['success' => false, 'lastProductNo' => '',
                   'optionCode' => '', 'errorMessage' => '배송금액 혹은 최소구매 입력오류...']);
            }
            else{
                $product->deliveryCode = 1;
                $product->deliveryCost = $request->txtDeliveryCost;
                $product->deliveryFreeMinimum = $request->txtDeliveryFreeMinimum;
            }

        } else{
            $product->deliveryCode = 0;
            $product->deliveryCost = 0;
            $product->deliveryFreeMinimum = 0;
        }

        if ($request->txtDeliveryNotice == "")
        {
            //return 0;
            return response(['success' => false, 'lastProductNo' => '',
                  'optionCode' => '', 'errorMessage' => '배송알림 입력오류...']);
        }else{
            $product->deliveryNotice = $request->txtDeliveryNotice;
        }

        if ($request->txtCertifyYes == "on"){
            if ($request->txtCertifyTitle != "")
            {
                $product->certifyCode = 1;
                $product->certifyTitle = $request->txtCertifyTitle;
            }
            else{
                //return 0;
                return response(['success' => false, 'lastProductNo' => '',
                  'optionCode' => '', 'errorMessage' => '인증이름 입력오류...']);
            }
        } else{
            $product->certifyCode = 0;
            $product->certifyTitle = "";
        }

        if ($request->txtOptionYes == "on"){
            if ($request->input('txtOptionSelectRadio') == 1) //html radio button
            {
                $product->optionCode = 1;
            }
            elseif ($request->input('txtOptionSelectRadio') == 2){
                $product->optionCode = 2;
            }

        } else{
            $product->optionCode = 0;
        }

        $product->owner = $owner;

        $result = $product->save();

        ////최근 생성된 Order 번호
        $lastProductNo = $product->id;

        if ($result)
        {
            //return $lastProductNo;
            return response(['success' => true, 'lastProductNo' => $lastProductNo,
                  'optionCode' => $product->optionCode, 'modelName' => $product->modelName]);
        }
        else{
            //return 0;
            return response(['success' => false, 'lastProductNo' => '',
                  'optionCode' => '', 'errorMessage' => '테이블 생성 실패...']);
        }
    }

    public function upload(Request $request) //stopped 15/05/2019
	{
        $productNo = $request->txtProductNo;
        $files = $_FILES; //File inputs are not put into $_POST, they're only in $_FILES.
        $number_of_files = count($_FILES['file']['name']);  //'file input name="file(file[])"...

        $image = $request->file('file');

        $errors = 0;

        for ($i = 0; $i < $number_of_files; $i++)
        {
            $_FILES['file']['name'] = $files['file']['name'][$i];

            //파일이름 앞에 상품 아이디를 첨가하여 업로드하는 파일 명을 다시 만든다(중복방지를 위해)
            $fileName = $productNo . "_";
            $fileName .= $_FILES['file']['name'];

            $type = $files['file']['type'][$i];
            $size = $files['file']['size'][$i];
            if (($type != "image/jpeg") && ($type != "image/png" ) &&
                ($type != "image/jpg" ) && ($type != "image/gif" ))
            {
                //return "wrong file type...";
                $errors++;
            }

            if ($size > 1024000) //byte
            {
                //return "too big size...";
                $errors++;
            }

            //$_FILES['file']['type'] = $files['file']['type'][$i];
            //$_FILES['file']['tmp_name'] = $files['file']['tmp_name'][$i];
            //$_FILES['file']['error'] = $files['file']['error'][$i];
            //$_FILES['file']['size'] = $files['file']['size'][$i];

            if ($errors == 0)
            {
                $image[$i]->move(public_path().'/uploadFiles/pictures/sellers/', $fileName);

                //$image->move(storage_path('files'), $fileName);
                //$request->file('file')->store('files');
                //$image->file('file')->store('files');
                //$thumbnail->move(storage_path().'/files/', $newFileName);

                $picture = new Picture;

                $picture->fileName = $fileName;
                $picture->product_id = $productNo;

                $picture->save();
            }
        }
        if ($errors > 0)
        {
            return 0;
        }
        else
        {
            return 1;
        }
    }
}
