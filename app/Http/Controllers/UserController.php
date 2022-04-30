<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Pizza;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    public function index(){
        $pizza=Pizza::where('publish_status',1)->paginate(9);
        // dd($pizza->toArray());
        $status=count($pizza)==0 ?0:1;
        $category=Category::get();


        return view('user.home')->with(['pizza'=>$pizza,'category'=>$category,'status'=>$status]);
    }


    //direct pizza detail
    public function pizzaDetail($id){

        // dd($id);
        $data=Pizza::where('pizza_id',$id)->first();
        Session::put('PIZZA_INFO',$data);
        return view('user.detail')->with(['pizza'=>$data]);
    }

    public function categorySearch($id){
        // dd($id);
        $data=Pizza::where('category_id',$id)->paginate(9);
        $status=count($data)==0 ?0:1;
        $category=Category::get();

        return view('user.home')->with(['pizza'=>$data,'category'=>$category,'status'=>$status]);
    }

    //search with pizza
    public function searchItem(Request $request){
        $data=Pizza::where('pizza_name','like','%'.$request->searchData.'%')->paginate(9);
        $data->appends($request->all());
        $status=count($data)==0 ?0:1;
        $category=Category::get();

        return view('user.home')->with(['pizza'=>$data,'category'=>$category,'status'=>$status]);

    }

    //search pizza with max-max price
    public function searchPizzaItem(Request $request){

        // dd($request->all());
        $startDate=$request->startDate;
        $endDate=$request->endDate;

        $min=$request->minPrice;
        $max=$request->maxPrice;

        $query=Pizza::select('*');

        if(!is_null($startDate) && is_null($endDate)){
            $query=$query->whereDate('created_at','>=',$startDate);
        }else if(is_null($startDate) && !is_null($endDate)){
            $query=$query->whereDate('created_at','<=',$endDate);

        }else if(!is_null($startDate) && !is_null($endDate)){
            $query=$query->whereDate('created_at','>=',$startDate)
                         ->whereDate('created_at','<=',$endDate);
        }


        if(!is_null($min) && is_null($max)){
            // dd('min have');
            $query=$query->where('price','>=',$min);
        }else if(is_null($min) && !is_null($max)){
            // dd('max have');
            $query=$query->where('price','<=',$max);

        }else if(!is_null($min) && !is_null($max)){
            // dd('both have');
            $query=$query->where('price','>=',$min)
                         ->where('price','<=',$max);
        }

        $query=$query->paginate(9);
        $query->appends($request->all());

        $status=count($query)==0 ?0:1;
        $category=Category::get();

        return view('user.home')->with(['pizza'=>$query,'category'=>$category,'status'=>$status]);

    }

    //order
    public function order(){
        $pizzaInfo=Session::get('PIZZA_INFO');
        // dd($pizzaInfo->toArray());
        return view('user.order')->with(['pizza'=>$pizzaInfo]);
    }

    public function placeOrder(Request $request){
        $validator = Validator::make($request->all(), [
            'pizzaCount' => 'required',
            'paymentType' => 'required',
        ]);

        if ($validator->fails()) {
            return back()
                        ->withErrors($validator)
                        ->withInput();
        }

        // dd($request->all());
        $pizzaInfo=Session::get('PIZZA_INFO');
        // dd($pizzaInfo->toArray());
        $userId=auth()->user()->id;
        $count=$request->pizzaCount;

        // dd('success');
        $orderData=$this->requestOrderData($pizzaInfo,$userId,$request);
        // dd($orderData);
        for($i=0; $i<$count; $i++){
            Order::create($orderData);
        }

        $waitingTime=$pizzaInfo['waiting_time'] * $count;
        return back()->with(['totalTime'=>$waitingTime]);

    }

    private function requestOrderData($pizzaInfo,$userId,$request){
        return [
            'customer_id'=>$userId,
            'pizza_id'=>$pizzaInfo['pizza_id'],
            'carrier_id'=>0,
            'payment_status'=>$request->paymentType,
            'order_time'=>Carbon::now(),

        ];
    }
}