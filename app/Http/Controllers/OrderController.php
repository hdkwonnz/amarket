<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Auth; ////
use App\Order; ////
use App\Orderdetail; ////
use App\Shoppingcart; ////
use App\Delivery;
use App\Product;
use App\First_option;
use App\Second_option;
use DB; ////
use Mail; ////
use App\Mail\MailSending; ////
use App\Jobs\SendReminderEmail; ////
use App\Exceptions\OrderException; ////13/04/2019

class OrderController extends Controller
{
    //만약 register 후에 verify을 하지 않은 상태로 진입을 못 하게 막아준다.12/04/2019
    public function __construct()
    {
        $this->middleware(['auth', 'verified']);
    }

    //중요한 예제...처리 결과를 어레이 형태로 받아 Ajax로 넘긴다...
    //shoppingcarts table에 담겨져 있는 내용을 oders 와 orderdetails table로 옮기고
    //shoppingcarts table은 지운다.
    //orderPaymentForWebGridWithCdn View Ajax에서 콜한다.
    //처리 결과를 어레이 형태로 받아 Ajax로 넘긴다... //중요한 예제
    public function checkOutWithCdn(Request $request)
    {
        if (Auth::guest())
        {
            return response(['success' => false, 'cartNum' => '',
                    'currentOrderId' => '', 'errorMessage' => '로그인이 필요합니다...']);
        }
        else
        {
            $cartNum = Auth::user()->email;
            //$firstname = Auth::user()->name; ////////////////////
        }

        $totalPrice = $request->totalPrice;

        if (is_numeric($totalPrice)  && ($totalPrice > 0) )
        {
            //Nothing...
        }
        else
        {
            return response(['success' => false, 'cartNum' => '',
                    'currentOrderId' => '', 'errorMessage' => '입력 데이터에 문제가 있습니다...']);
        }

        $date = date('Y-m-d H:i:s');////////////////
        $ip = $request->ip();

        $qry = Shoppingcart::
             select('shoppingcarts.id AS cartId','products.id AS productId',
                 'shoppingcarts.quantity','shoppingcarts.originPrice','shoppingcarts.optionCode',
                 'shoppingcarts.sellPrice','shoppingcarts.firstOptionAmount','shoppingcarts.secondOptionAmount',
                 'shoppingcarts.first_option_id','shoppingcarts.second_option_id',
                 'products.searchImage AS searchImage','products.owner AS owner','products.deliveryCode AS deliveryCode',
                 'products.deliveryCost AS deliveryCost','products.deliveryFreeMinimum AS deliveryFreeMinimum',
                 'products.modelName AS modelName',
                 'first_options.description AS firstDescription',
                 'second_options.description AS secondDescription')
             ->join('products', 'products.id','=','shoppingcarts.product_id')
             ->leftjoin('first_options','first_options.id','=','shoppingcarts.first_option_id')
             ->leftjoin('second_options','second_options.id','=','shoppingcarts.second_option_id')
             ->where('cartNum', '=', $cartNum)
             ->orderBy('products.owner', 'asc')
             ->orderBy('products.id', 'asc');

        $numRows = $qry->count();
        $carts = $qry ->get();

        //start the transaction
        DB::beginTransaction();

        try
        {
            ////orders table 생성
            $order = new Order;

            $order->customer_id = $cartNum;
            $order->orderDate = $date; /////////////////////
            $order->totalPrice = $totalPrice;
            $order->orderIP = $ip;

            $order->save();

            ////최근 생성된 Order 번호
            $lastOrderId = $order->id;

            ////지금부터는 cartListWithCdn.blade.php를 참조할것.13/05/2019
            $saveProductId = '';
            $saveOwner = '';
            $index = 0;
            $originSumPrice = 0;
            $originGrandTotal = 0;
            $sumPrice = 0;
            $grandTotal = 0;
            $discountRate = 0;
            $saveOriginalPriceByQtyTotal = 0;
            $originalPriceByQtyTotal = 0;
            $originalPriceByQty = 0;
            $originalPriceByOptions = 0;
            $firstOptionAmount = 0;
            $secondOptionAmount = 0;
            $sellPriceByOptions = 0;
            $sellPriceByQty = 0;
            $discountedPriceByQty = 0;
            $discountedPriceByQtyTotal = 0;
            $saveDiscountedPriceByQtyTotal = 0;
            $saveDeliveryCost = 0;
            $currentDeliveryCost = 0;
            $currentDeliveryFreeMinimum = 0;
            $saveDeliveryFreeMinimum = 0;
            $grandDiscountedAmount = 0;
            $grandDeliveryCost = 0;
            $grandTotalOrderAmount = 0;
            $orderAmount = 0;
            $orderAmountWithoutDeliveryCost = 0;

            ////orderdetails table 생성
            foreach($carts as $item) //foreach=>a start looping
            {
                $productId = $item->productId;
                $originPrice = $item->originPrice;
                $sellPrice = $item->sellPrice;
                //$quantity = $item->quantity;
                $firstOptionAmount = $item->firstOptionAmount;
                $secondOptionAmount = $item->secondOptionAmount;
                $owner = $item->owner;
                $deliveryCost = $item->deliveryCost;
                $deliveryFreeMinimum = $item->deliveryFreeMinimum;

                //product owner 별로 합계를 구한다
                if (($owner == $saveOwner)){
                    $originalPriceByOptions = $originPrice + $firstOptionAmount + $secondOptionAmount;
                    $originalPriceByQty = $originalPriceByOptions * $item->quantity;
                    $sellPriceByOptions = $sellPrice  + $firstOptionAmount + $secondOptionAmount;
                    $sellPriceByQty = $sellPriceByOptions * $item->quantity;
                    $discountedPriceByQty = $originalPriceByQty - $sellPriceByQty;
                    $originalPriceByQtyTotal = $originalPriceByQtyTotal + $originalPriceByQty;
                    $discountedPriceByQtyTotal = $discountedPriceByQtyTotal + $discountedPriceByQty;
                    if (($originalPriceByQtyTotal - $discountedPriceByQtyTotal) >= $deliveryFreeMinimum)
                    {
                        $currentDeliveryCost = 0;
                    }
                    else{
                        $currentDeliveryCost = $deliveryCost;
                        $currentDeliveryFreeMinimum = $deliveryFreeMinimum;
                    }
                    if ($index == ($numRows - 1)) //마지막 상품이면
                    {
                        $saveOriginalPriceByQtyTotal = $originalPriceByQtyTotal;
                        $saveDiscountedPriceByQtyTotal = $discountedPriceByQtyTotal;
                        $saveDeliveryCost = $currentDeliveryCost;
                        $saveDeliveryFreeMinimum = $currentDeliveryFreeMinimum;
                    }
                } //if (($owner == $saveOwner))
                else{
                    $saveOriginalPriceByQtyTotal = $originalPriceByQtyTotal;
                    $saveDiscountedPriceByQtyTotal = $discountedPriceByQtyTotal;
                    $saveDeliveryCost = $currentDeliveryCost;
                    $saveDeliveryFreeMinimum = $currentDeliveryFreeMinimum;
                    $originalPriceByQtyTotal = 0;
                    $discountedPriceByQtyTotal = 0;
                    $currentDeliveryCost = 0;
                    $currentDeliveryFreeMinimum = 0;
                    $originalPriceByOptions = $originPrice + $firstOptionAmount + $secondOptionAmount;
                    $originalPriceByQty = $originalPriceByOptions * $item->quantity;
                    $sellPriceByOptions = $sellPrice  + $firstOptionAmount + $secondOptionAmount;
                    $sellPriceByQty = $sellPriceByOptions * $item->quantity;
                    $discountedPriceByQty = $originalPriceByQty - $sellPriceByQty;
                    $originalPriceByQtyTotal = $originalPriceByQtyTotal + $originalPriceByQty;
                    $discountedPriceByQtyTotal = $discountedPriceByQtyTotal + $discountedPriceByQty;
                    if (($originalPriceByQtyTotal - $discountedPriceByQtyTotal) >= $deliveryFreeMinimum)
                    {
                        $currentDeliveryCost = 0;
                    }
                    else{
                        $currentDeliveryCost = $deliveryCost;
                        $currentDeliveryFreeMinimum = $deliveryFreeMinimum;
                    }
                } //if (($owner == $saveOwner)) else


                ////동일한 productId는 맨 처음 row 에만 사진을 보여준다.
                if ($saveProductId != $productId) //if ($saveProductId != $productId)
                {
                    //loop에 첫번째가 아니고 새로운 productId가 나오면 새로운 product를 보여주기 전에
                    //전 product에 대한 총상품금액,할인금액,배송비 등을 보여준다
                    //판매자가 동일하면 묶음 배송을 위해 productId가 달라도 맨 마지막에 합계를 보여준다
                    if (($index != 0) && ($saveOwner != $owner))
                    {
                        $orderAmount = $saveOriginalPriceByQtyTotal - $saveDiscountedPriceByQtyTotal + $saveDeliveryCost;
                        $orderAmountWithoutDeliveryCost = $saveOriginalPriceByQtyTotal - $saveDiscountedPriceByQtyTotal;
                        ////전체합계에 보여줄 내용
                        $originGrandTotal = $originGrandTotal + $saveOriginalPriceByQtyTotal;
                        $grandTotal = $grandTotal + $saveDiscountedPriceByQtyTotal;
                        $grandDiscountedAmount = $grandDiscountedAmount + $saveDiscountedPriceByQtyTotal;
                        if ($orderAmountWithoutDeliveryCost < $saveDeliveryFreeMinimum)
                        {
                            ////전체합계에 보여줄 내용
                            $grandDeliveryCost = $grandDeliveryCost + $saveDeliveryCost;

                            ////배송비: xxxx원 이상 구매시 무료////
                            ////$saveDeliveryFreeMinimum////////

                        } //($orderAmountWithoutDeliveryCost < $saveDeliveryFreeMinimum)

                        ////상품금액-할인금액+배송비=주문금액////
                        ////$saveOriginalPriceByQtyTotal-$saveDiscountedPriceByQtyTotal+////
                        ////$saveDeliveryCost=$orderAmount//////////////////////////////////

                        ////delivery table 생성
                        $delivery = new Delivery;
                        $delivery->order_id = $lastOrderId;
                        $delivery->product_owner = $saveOwner; /////////////////////
                        $delivery->cost = $saveDeliveryCost;
                        $delivery->save();

                    } //(($index != 0) && ($saveOwner != $owner))

                    ////상품이미지,상품명,옵션금액,수량,판매금액,X마크////

                } //if ($saveProductId != $productId)
                else //if ($saveProductId != $productId) else
                {

                    ////상품명,상품명,옵션금액,수량,판매금액,X마크////

                } //if ($saveProductId != $productId) else

                //맨 마지막 product에 대한 총상품금액,할인금액,배송비 등을 보여준다
                if ($index == ($numRows - 1))
                {
                    $saveOriginalPriceByQtyTotal = $originalPriceByQtyTotal;
                    $saveDiscountedPriceByQtyTotal = $discountedPriceByQtyTotal;
                    $saveDeliveryCost = $currentDeliveryCost;
                    $saveDeliveryFreeMinimum = $currentDeliveryFreeMinimum;
                    $orderAmount = $saveOriginalPriceByQtyTotal - $saveDiscountedPriceByQtyTotal + $saveDeliveryCost;
                    $orderAmountWithoutDeliveryCost = $saveOriginalPriceByQtyTotal - $saveDiscountedPriceByQtyTotal;
                    ////전체합계에 보여줄 내용
                    $originGrandTotal = $originGrandTotal + $saveOriginalPriceByQtyTotal;
                    $grandTotal = $grandTotal + $saveDiscountedPriceByQtyTotal;
                    $grandDiscountedAmount = $grandDiscountedAmount + $saveDiscountedPriceByQtyTotal;
                    if ($orderAmountWithoutDeliveryCost < $saveDeliveryFreeMinimum)
                    {
                        ////전체합계에 보여줄 내용
                        $grandDeliveryCost = $grandDeliveryCost + $saveDeliveryCost;

                        ////배송비: xxxx원 이상 구매시 무료////
                        ////$saveDeliveryFreeMinimum////////

                    } //($orderAmountWithoutDeliveryCost < $saveDeliveryFreeMinimum)

                    ////상품금액-할인금액+배송비=주문금액////
                    ////$saveOriginalPriceByQtyTotal-$saveDiscountedPriceByQtyTotal+////
                    ////$saveDeliveryCost=$orderAmount//////////////////////////////////

                    ////delivery table 생성
                    $delivery = new Delivery;
                    $delivery->order_id = $lastOrderId;
                    $delivery->product_owner = $saveOwner; /////////////////////
                    $delivery->cost = $saveDeliveryCost;
                    $delivery->save();

                } //($index == ($numRows - 1))

                ///////////////save orderDetails///////////////////////////////////
                $orderdetail = new Orderdetail;

                $orderdetail->order_id = $lastOrderId;
                $orderdetail->customer_id = $cartNum;
                $orderdetail->product_id = $item->productId; //not product_id...12/05/2019
                $orderdetail->optionCode = $item->optionCode;
                $orderdetail->first_option_id = $item->first_option_id;
                $orderdetail->second_option_id = $item->second_option_id;
                $orderdetail->firstOptionAmount = $item->firstOptionAmount;
                $orderdetail->secondOptionAmount = $item->secondOptionAmount;
                $orderdetail->quantity = $item->quantity;
                $orderdetail->sellPrice = $item->sellPrice;
                $orderdetail->originPrice = $item->originPrice;

                $orderdetail->save();

                ///////////////////////////////////////////////////////////////////////////

                $index++;
                $saveProductId = $productId;
                $saveOwner = $owner;
            } //foreach=>a

            ////전체합계/////////////////////////////////////
            ////상품금액,할인금액,배송비,전체주문금액
            ////$originGrandTotal,$grandDiscountedAmount,$grandDeliveryCost

            $grandTotalOrderAmount = $originGrandTotal - $grandDiscountedAmount + $grandDeliveryCost;

            ////Ajax로 입력된 총금액과 DB에 저장된 금액을 비교
            ////중요한 예제임.어레이 형태로 return 한다.26/04/2019
            if ($totalPrice != $grandTotalOrderAmount)
            {
                ////shoppingcarts table 삭제
                //Shoppingcart::where('cartNum','=',$cartNum)
                //            ->delete(); //이부분은 잠시 홀드.12/05/2019

                return response(['success' => false, 'cartNum' => '',
                   'currentOrderId' => '', 'errorMessage' => '매입 금액 불일치...']);
            }

            //shoppingcarts table 삭제
            Shoppingcart::where('cartNum','=',$cartNum)
                        ->delete();

            //make transaction commit
            DB::commit();

            //check out이 끝났으면 쇼핑카트 속의 상품 수를 0으로 만든다.
            session()->put('laravelCartCount',0); //13/04/2019

            //이메일 발송///수정할것...13/05/2019
            $orderDetails = Orderdetail::
                            select('id','order_id','product_id','sellPrice','quantity')
                            ->where('order_id', '=', $lastOrderId)
                            ->get();

            //아래 가상 Mail을 사용하기 위해서는 https://mailtrap.io (user:hyukdong@hotmail.com,password:wxxkhd71102)로
            //이동하여 Integrations section에서 mail_driver,host,port,username,password 등을 카피하여 .env파일에
            //등록하여야 한다. 물론 그전에 app/Mail folder를 만들고 필료한 코딩을 해야한다. 유튜브참조요망.07/03/2019
            //현재는 .env file에 mailtrap 과 gmail을 세팅 준비 하였다.(08/03/2019)
            //queue 사용을 위해 코멘트  처리. 25/03/2019

            //Mail::to($cartNum)->send(new MailSending($orderDetails)); //정상작동됨..07/03/2019

            //보낼 메일을 jobs table로 passing 한다. 25/03/2019
            //queue를 사용 중지하고 싶으면 아래를 코멘트 처리하고 위의 Mail::을 activation 할것.

            $job = (new SendReminderEmail($orderDetails, $cartNum))
                        //->delay(10);  //10은 초를 의미 ==>old version
                        ->delay(now()->addSeconds(5)); //current version 5.8 13/04/2019
            $this->dispatch($job);

            return response(['success' => true, 'cartNum' => $cartNum,
                    'currentOrderId' => $lastOrderId, 'errorMessage' => '']);
        }
        catch(Exception $e) //이 catch를 제거하고 아래 두개의 catch만 사용 해야 되는지 고민 중 13/04/2019
        {                   //이 catch를 제거하면 return이 없어져 문제가 될거 같다...
            //transaction rollback
            DB::rollback();

            return response(['success' => false, 'cartNum' => '',
                   'currentOrderId' => '', 'errorMessage' => $e->getMessage()]);
        }
        //catch(\Throwable $exception){
        //    DB::rollback();
        //    //dd('Exception block', $exception); //working
        //    //echo $exception->getMessage(); //working ==>2nd option...
        //    throw new OrderException; //best option...실제로는 이렇게 처리해야 한다.

        //    //$errorMessage = $exception->getMessage();
        //    //echo '<h3 style="color: blue;">Throwable Errors...</h3>' . '<span style="color: red; font-size: 30px;">' . $errorMessage . '</span>';
        //}
        //catch (\Exception $exception) {
        //    DB::rollback();
        //    //dd('Exception block', $exception); //working
        //    //echo $exception->getMessage(); //working ==>2nd option...
        //    throw new OrderException; //best option...실제로는 이렇게 처리해야 한다.

        //    //$errorMessage = $exception->getMessage();
        //    //echo '<h3 style="color: blue;">Exception Errors...</h3>' . '<span style="color: red; font-size: 30px;">' . $errorMessage . '</span>';
        //}
    }

    //중요한 예제...stopped.12/05/2019
    //shoppingcarts table에 담겨져 있는 내용을 oders 와 orderdetails table로 옮기고
    //shoppingcarts table은 지운다.
    //orderPaymentForWebGridView Ajax에서 콜한다.
    //처리 결과를 어레이 형태로 받아 Ajax로 넘긴다... //중요한 예제 stopped.12/05/2019
    public function checkOut(Request $request)
    {
        if (Auth::guest())
        {
            return response(['success' => false, 'cartNum' => '',
                    'currentOrderId' => '', 'errorMessage' => '로그인이 필요합니다...']);
        }
        else
        {
            $cartNum = Auth::user()->email;
            $firstname = Auth::user()->name;
        }

        $totalPrice = $request->totalPrice;

        if (is_numeric($totalPrice)  && ($totalPrice > 0) )
        {
            //Nothing...
        }
        else
        {
            return response(['success' => false, 'cartNum' => '',
                    'currentOrderId' => '', 'errorMessage' => '입력 데이터에 문제가 있습니다...']);
        }

        $date = date('Y-m-d H:i:s');
        $ip = $request->ip();

        $carts = Shoppingcart::
            select('id','product_id','quantity','originPrice','sellPrice')
            ->where('cartNum', '=', $cartNum)
            ->get();

        //start the transaction
        DB::beginTransaction();

        try
        {
            //orders table 생성
            $order = new Order;

            $order->customer_id = $cartNum;
            $order->orderDate = $date;
            $order->totalPrice = $totalPrice;
            $order->orderIP = $ip;

            $order->save();

            //최근 생성된 Order 번호
            $lastOrderId = $order->id;

            $totalAmt = 0;
            $gTotalAmt = 0;

            //orderdetails table 생성
            foreach($carts as $item)
            {
                $orderdetail = new Orderdetail;

                $orderdetail->order_id = $lastOrderId;
                $orderdetail->product_id = $item->product_id;
                $orderdetail->quantity = $item->quantity;
                $orderdetail->sellPrice = $item->sellPrice;

                $totalAmt = $item->quantity * $item->sellPrice;
                $gTotalAmt = $gTotalAmt + $totalAmt;

                $orderdetail->save();
            }

            //Ajax로 입력된 총금액과 DB에 저장된 금액을 비교
            //중요한 예제임.어레이 형태로 return 한다.26/04/2019
            if ($totalPrice != $gTotalAmt)
            {
                ////shoppingcarts table 삭제
                //Shoppingcart::where('cartNum','=',$cartNum)
                //            ->delete(); //이부분은 잠시 홀드.12/05/2019

                return response(['success' => false, 'cartNum' => '',
                   'currentOrderId' => '', 'errorMessage' => '매입 금액 불일치...']);
            }

            //shoppingcarts table 삭제
            Shoppingcart::where('cartNum','=',$cartNum)
                        ->delete();

            //make transaction commit
            DB::commit();

            //check out이 끝났으면 쇼핑카트 속의 상품 수를 0으로 만든다.
            session()->put('laravelCartCount',0); //13/04/2019

            //이메일 발송
            $orderDetails = Orderdetail::
                            select('id','order_id','product_id','price','quantity')
                            ->where('order_id', '=', $lastOrderId)
                            ->get();

            //아래 가상 Mail을 사용하기 위해서는 https://mailtrap.io (user:hyukdong@hotmail.com,password:wxxkhd71102)로
            //이동하여 Integrations section에서 mail_driver,host,port,username,password 등을 카피하여 .env파일에
            //등록하여야 한다. 물론 그전에 app/Mail folder를 만들고 필료한 코딩을 해야한다. 유튜브참조요망.07/03/2019
            //현재는 .env file에 mailtrap 과 gmail을 세팅 준비 하였다.(08/03/2019)
            //queue 사용을 위해 코멘트  처리. 25/03/2019

            //Mail::to($cartNum)->send(new MailSending($orderDetails)); //정상작동됨..07/03/2019

            //보낼 메일을 jobs table로 passing 한다. 25/03/2019
            //queue를 사용 중지하고 싶으면 아래를 코멘트 처리하고 위의 Mail::을 activation 할것.

            $job = (new SendReminderEmail($orderDetails, $cartNum))
                        //->delay(10);  //10은 초를 의미 ==>old version
                        ->delay(now()->addSeconds(5)); //current version 5.8 13/04/2019
            $this->dispatch($job);

            return response(['success' => true, 'cartNum' => $cartNum,
                    'currentOrderId' => $lastOrderId, 'errorMessage' => '']);
        }
        //catch(Exception $e) //이 catch를 제거하고 아래 두개의 catch만 사용 해야 되는지 고민 중 13/04/2019
        //{                   //이 catch를 제거하면 return이 없어져 문제가 될거 같다...
        //    //transaction rollback
        //    DB::rollback();

        //    return response(['success' => false, 'cartNum' => '',
        //           'currentOrderId' => '', 'errorMessage' => $e->getMessage()]);
        //}
        catch(\Throwable $exception){
            DB::rollback();
            //dd('Exception block', $exception); //working
            //echo $exception->getMessage(); //working ==>2nd option...
            throw new OrderException; //best option...실제로는 이렇게 처리해야 한다.

            //$errorMessage = $exception->getMessage();
            //echo '<h3 style="color: blue;">Throwable Errors...</h3>' . '<span style="color: red; font-size: 30px;">' . $errorMessage . '</span>';
        }
        catch (\Exception $exception) {
            DB::rollback();
            //dd('Exception block', $exception); //working
            //echo $exception->getMessage(); //working ==>2nd option...
            throw new OrderException; //best option...실제로는 이렇게 처리해야 한다.

            //$errorMessage = $exception->getMessage();
            //echo '<h3 style="color: blue;">Exception Errors...</h3>' . '<span style="color: red; font-size: 30px;">' . $errorMessage . '</span>';
        }
    }

    ////product/detailsWithCdn.blade.php에서 구매하기 버튼을 클릭 하면...
    ////ajax로 이곳을 access할시 middleware 문제가 미해결 상태임.26/05/2019
    public function buyNow(Request $request)
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
            return "로그인이 필요합니다...";
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

            $numRows = $qry->count();

            $carts = $qry ->get();

            ////쇼핑카트 속의 카운트 수를 구하여 세션에 저장한다.
            session()->put('laravelCartCount',$numRows);

            return (String) view('/order/orderPaymentForBuyNowByAjax', compact('carts','numRows'));
        }
    }

    //카트 마이그레이션 실행(쇼핑카트에 user(cartNum)를 등록)후
    //order할 내용을 shoppingcarts에서 찾아 보여준다.shoppingcart.cartList.blade.php ajax에서 콜.
    public function orderPaymentForWebGridWithCdn()
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

        $numRows = $qry->count();

        $carts = $qry ->get();

        return view('/order/orderPaymentForWebGridWithCdn', compact('carts','numRows'));
    }


    //카트 마이그레이션 실행(쇼핑카트에 user(cartNum)를 등록)후
    //order할 내용을 shoppingcarts에서 찾아 보여준다.shoppingcart.cartList.blade.php ajax에서 콜.
    ////stopped. 21/05/2019
    public function orderPaymentForWebGrid()
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

        $qry = Shoppingcart::
            select('id','product_id','quantity')
            ->where('cartNum', '=', $cartNum);

        $numRows = $qry->count();

        $carts = $qry ->get();

        return view('/order/orderPaymentForWebGrid', compact('carts','numRows'));
    }

    //지난 한달 동안의 모든 주문 내역
    public function showOrderTotal()
    {
        if (Auth::guest())
        {
            return "로그인이 필요합니다...";
        }
        else
        {
            $email = Auth::user()->email;
        }

        $yymmddhis = date("Y-m-d H:i:s", strtotime("-1 months"));  //한달전 yymmddhis

        //$qry = Order::
        //    select('id','orderDate')
        //    ->where('customer_id', '=', $email)
        //    ->where('orderDate', '>=', $yymmddhis);

        $qry = Orderdetail::with('product')
            ->select('*')
            ->where('customer_id', '=', $email)
            ->where('created_at', '>=', $yymmddhis);
            //->get();

        $numRows = $qry->count();

        //$orders = $qry->orderBy('orders.orderDate', 'desc')
        //              ->paginate(3);

        $orderdetails = $qry->orderBy('orderdetails.created_at', 'desc')
                            ->orderBy('orderdetails.product_id','asc')
                            ->paginate(3);

        return view('order/showOrderTotalWithCdn', compact('orderdetails','numRows'));
    }

    //showOrderTotalB View에서 Ajax Get으로 넘어온 값
    public function showOrderTotalByTerm()
    {
        if (Auth::guest())
        {
            return "로그인이 필요합니다...";
        }
        else
        {
            $email = Auth::user()->email;
        }

        $startDate = $_GET['startDate'];
        $endDate = $_GET['endDate'];
        $startDate1 = strtotime($startDate);
        $startDate2 = date('Y-m-d H:i:s',$startDate1);
        $endDate1 = strtotime($endDate);
        $endDate2 = date('Y-m-d H:i:s',$endDate1);

        //////////////지우지 말것.../////////////////////////////////////////////////////////////////////
        ////$today_yymmdd = date('Y-m-d');  //오늘
        ////$today_yymmddhis = date('Y-m-d H:i:s');  //오늘 + 시간
        ////$yymmddhis = date("Y-m-d H:i:s", strtotime("-1 months"));  //한달전 yymmddhis
        ////$yymmdd = date("Y-m-d", strtotime("-1 months"));  //한달전 yymmdd
        ////$mm = date("m", strtotime("-1 months"));  //한달전 mm
        ////$current_month=date('m');  //이달
        ////$current_year=date('Y');  //금년
        ////$first_day_this_month = date('m-01-Y');  // 이달 첫 날(mmddYY)
        ////$first_day_this_month2 = date('Y-m-01');  // 이달 첫 날(YYmmdd)
        ////$first_day_this_month3 = date('Y-m-01',strtotime("-1 months"));  // 전달 첫 날(YYmmdd)
        ////$first_day_this_month4 = date('Y-m-01 00:00:00',strtotime("-1 months"));  // 전달 첫 날(YYmmddHis)
        ////$last_day_this_month  = date('m-t-Y');   //이달 마지막 날(mmddYY)
        ////$last_day_this_month2  = date('Y-m-t');   //이달 마지막 날(YYTmmdd)
        ////$last_day_this_month3  = date('Y-m-t', strtotime("-1 months"));   //전달 마지막 날(YYTmmdd)
        ////$last_day_this_month4 = date('Y-m-t 23:59:59', strtotime("-1 months"));   //전달 마지막 날(YYTmmddHis)
        //////////////지우지 말것.../////////////////////////////////////////////////////////////////////


        //$qry = Order::
        //    select('id','orderDate')
        //    ->where('customer_id', '=', $email)
        //    ->where('orderDate', '>=', $startDate2)
        //    ->where('orderDate', '<=', $endDate2);

        $qry = Orderdetail::with('product')
           ->select('*')
           ->where('customer_id', '=', $email)
           ->where('created_at', '>=', $startDate2)
           ->where('created_at', '<=', $endDate2);

        //$qry = Orderdetail::
        //            select('orderdetails.id AS orderdetailsId','orderdetails.product_id AS productId',
        //                'orderdetails.quantity','orderdetails.originPrice','orderdetails.optionCode',
        //                'orderdetails.sellPrice','orderdetails.firstOptionAmount','orderdetails.secondOptionAmount',
        //                'orderdetails.created_at', 'orderdetails.order_id',
        //                'orders.orderDate AS orderDate','orders.totalPrice AS totalPrice',
        //                'products.searchImage AS searchImage','products.owner AS owner','products.deliveryCode AS deliveryCode',
        //                'products.deliveryCost AS deliveryCost','products.deliveryFreeMinimum AS deliveryFreeMinimum',
        //                'products.modelName AS modelName','first_options.description AS firstDescription',
        //                'second_options.description AS secondDescription')
        //            ->join('orders','orders.id','=','orderdetails.order_id')
        //            ->join('products','products.id','=','orderdetails.product_id')
        //            ->where('orderdetails.customer_id', '=', $email)
        //            ->where('orderdetails.created_at', '>=', $startDate2)
        //            ->where('orderdetails.created_at', '<=', $endDate2)
        //            ->leftjoin('first_options','first_options.id','=','orderdetails.first_option_id')
        //            ->leftjoin('second_options','second_options.id','=','orderdetails.second_option_id');

        $numRows = $qry->count();

        $orderdetails = $qry->orderBy('orderdetails.created_at', 'desc')
                            ->orderBy('orderdetails.product_id','asc')
                            ->paginate(3);

        return (string) view('order/showOrderTotalByTermWithCdn', compact('orderdetails','numRows','startDate2','endDate2'));
    }

    //showOrderTotal View 에서 콜한다.
    public function showOrderDetailsByChild()
    {
        $orderId = $_GET['orderId'];
        $oderDate = $_GET['oderDate'];

        //$qry = Orderdetail::
        //    select('id','order_id','product_id','price','quantity')
        //    ->where('order_id', '=', $orderId);

        $qry = Orderdetail::
            select('orderdetails.id AS orderdetailsId','orderdetails.product_id AS productId',
                'orderdetails.quantity','orderdetails.originPrice','orderdetails.optionCode',
                'orderdetails.sellPrice','orderdetails.firstOptionAmount','orderdetails.secondOptionAmount',
                'orders.orderDate AS orderDate','orders.totalPrice AS totalPrice',
                'orders.id AS orderId',
                'products.searchImage AS searchImage','products.owner AS owner','products.deliveryCode AS deliveryCode',
                'products.deliveryCost AS deliveryCost','products.deliveryFreeMinimum AS deliveryFreeMinimum',
                'products.modelName AS modelName','first_options.description AS firstDescription',
                'second_options.description AS secondDescription')
            ->join('orders','orders.id','=','orderdetails.order_id')
            ->join('products','products.id','=','orderdetails.product_id')
            ->where('orderdetails.order_id', '=', $orderId)
            ->leftjoin('first_options','first_options.id','=','orderdetails.first_option_id')
            ->leftjoin('second_options','second_options.id','=','orderdetails.second_option_id');

        $numRows = $qry->count();

        $orderDetails = $qry->get();

        return (string) view('order/showOrderDetailsByChildWithCdn', compact('orderDetails','numRows','oderDate'));
    }

    ////orders,orderdetails,products table로 join 할것..향후변경할것임.13/05/2019
    //orderPaymentForWebGridView Ajax에서 콜한다.
    public function showCurrentOrder($id)
    {
        //$order = Order::select('id','orderDate','totalPrice')
        //        ->findOrFail($id);

        $orderDetails = Orderdetail::
            select('orderdetails.id AS orderdetailsId','orderdetails.product_id AS productId',
                'orderdetails.quantity','orderdetails.originPrice','orderdetails.optionCode',
                'orderdetails.sellPrice','orderdetails.firstOptionAmount','orderdetails.secondOptionAmount',
                'orders.orderDate AS orderDate','orders.totalPrice AS totalPrice',
                'products.searchImage AS searchImage','products.owner AS owner','products.deliveryCode AS deliveryCode',
                'products.deliveryCost AS deliveryCost','products.deliveryFreeMinimum AS deliveryFreeMinimum',
                'products.modelName AS modelName','first_options.description AS firstDescription',
                'second_options.description AS secondDescription')
            ->join('orders','orders.id','=','orderdetails.order_id')
            ->join('products','products.id','=','orderdetails.product_id')
            ->where('orderdetails.order_id', '=', $id)
            ->leftjoin('first_options','first_options.id','=','orderdetails.first_option_id')
            ->leftjoin('second_options','second_options.id','=','orderdetails.second_option_id')
            ->orderBy('products.owner', 'asc')
            ->orderBy('products.id', 'asc')
            ->get();

        return (string) view('order/showCurrentOrder', compact('orderDetails'));
    }
}
