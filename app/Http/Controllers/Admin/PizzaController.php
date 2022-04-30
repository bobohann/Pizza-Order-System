<?php

namespace App\Http\Controllers\Admin;

use App\Models\Pizza;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;

class PizzaController extends Controller
{
    //direct pizza list page
    public function pizza(){
        $data=Pizza::paginate(7);

        if(count($data)==0){
            $empty_status=0;
        }else{
            $empty_status=1;

        }
        return view('admin.pizza.list')->with(['pizza'=>$data,'status'=>$empty_status]);
    }

    //direct create pizza page
    public function createPizza(){

        $category=Category::get();
        // dd($category->toArray());
        return view('admin.pizza.create')->with(['category'=>$category]);
    }

    //insert pizza
    public function insertPizza(Request $request){


        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'image'=>'required',
            'price'=>'required',
            'publish'=>'required',
            'category'=>'required',
            'discount'=>'required',
            'buyOneGetOne'=>'required',
            'waitingTime'=>'required',
            'description'=>'required',
        ]);

        if ($validator->fails()) {
            return back()
                        ->withErrors($validator)
                        ->withInput();
        }

        $file=$request->file('image');
        // dd($file);
        $fileName=uniqid().'_bb'.$file->getClientOriginalName();
        // dd($fileName);
        $file->move(public_path().'/uploads/',$fileName);

        // dd($request->all);
        $data=$this->requestPizzaData($request,$fileName);
        Pizza::create($data);
        return redirect()->route('admin#pizza')->with(['success'=>'Pizza Created...']);
    }

    //delete pizza
    public function deletePizza($id){
        $data=Pizza::select('image')->where('pizza_id',$id)->first();
        // dd($data);
        $fileName=$data['image'];

        Pizza::where('pizza_id',$id)->delete(); //delete database

        //delete public image
        if(File::exists(public_path().'/uploads/'.$fileName)){
            File::delete(public_path().'/uploads/'.$fileName);
        }
        return back()->with(['success'=>"Pizza deleted success..."]);
    }

    //direct pizza info
    public function pizzaInfo($id){
        $data=Pizza::where('pizza_id',$id)->first();
        return view('admin.pizza.info')->with(['pizza'=>$data]);
    }

    //edit pizza
    public function editPizza($id){
        // dd($id);
        $category=Category::get();

        $data=Pizza::select()
            ->join('categories','pizzas.category_id','categories.category_id')
            ->where('pizza_id',$id)
            ->first();

        // dd($data);
        return view('admin.pizza.edit')->with(['pizza'=>$data,'category'=>$category]);
    }

    //update pizza
    public function updatePizza($id,Request $request){
        // dd($id);
        // dd($request);
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'price'=>'required',
            'publish'=>'required',
            'category'=>'required',
            'discount'=>'required',
            'buyOneGetOne'=>'required',
            'waitingTime'=>'required',
            'description'=>'required',
        ]);

        if ($validator->fails()) {
            return back()
                        ->withErrors($validator)
                        ->withInput();
        }

        $updateData=$this->requestUpdatePizzaData($request);

        if(isset($updateData['image'])){
            // dd('Yes');
            //get old image name
            $data=Pizza::select('image')->where('pizza_id',$id)->first();
            $fileName=$data['image'];

            //delete old image
            if(File::exists(public_path().'/uploads/'.$fileName)){
                File::delete(public_path().'/uploads/'.$fileName);
            }

            //get new image data
            $file=$request->file('image');
            $fileName=uniqid().'_bb'.$file->getClientOriginalName();
            $file->move(public_path().'/uploads/',$fileName);
            $updateData['image']=$fileName;
            // dd($updateData['image']);
            }
                Pizza::where('pizza_id',$id)->update($updateData);
                return redirect()->route('admin#pizza')->with(['success'=>'Pizza Updated...']);

    }

    //search pizza
    public function searchPizza(Request $request){
        // dd($request->all());
        $searchKey=$request->table_search;

        $searchData=Pizza::orWhere('pizza_name','like','%'.$searchKey.'%')
                            ->orWhere('price','like','%'.$searchKey.'%')
                            ->paginate(7);
        $searchData->appends($request->all());

        //for no data check
        if(count($searchData)==0){
            $empty_status=0;
        }else{
            $empty_status=1;

        }

        return view('admin.pizza.list')->with(['pizza'=>$searchData,'status'=>$empty_status]);
    }

    public function categoryItem($id){
        // dd($id);
        $data=Pizza::select('pizzas.*','categories.category_name as categoryName')
                    ->join('categories','categories.category_id','pizzas.category_id')
                    ->where('pizzas.category_id',$id)
                    ->paginate(5);
        // dd($data->toArray());
        return view('admin.category.item')->with(['pizza'=>$data]);

        
    }

    private function requestUpdatePizzaData($request){
        $arr=[
            'pizza_name'=>$request->name,
            'price'=>$request->price,
            'publish_status'=>$request->publish,
            'category_id'=>$request->category,
            'discount_price'=>$request->discount,
            'buy_one_get_one_status'=>$request->buyOneGetOne,
            'waiting_time'=>$request->waitingTime,
            'description'=>$request->description,
        ];

        if(isset($request->image)){
            $arr['image']=$request->image;
        }

        return $arr;
    }



    private function requestPizzaData($request,$fileName){
        return[
            'pizza_name'=>$request->name,
            'image'=>$fileName,
            'price'=>$request->price,
            'publish_status'=>$request->publish,
            'category_id'=>$request->category,
            'discount_price'=>$request->discount,
            'buy_one_get_one_status'=>$request->buyOneGetOne,
            'waiting_time'=>$request->waitingTime,
            'description'=>$request->description,
        ];
    }


}