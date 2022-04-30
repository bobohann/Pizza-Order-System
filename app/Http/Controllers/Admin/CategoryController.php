<?php

namespace App\Http\Controllers\Admin;


use App\Models\User;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;


class CategoryController extends Controller
{

    //direct admin addCategory page
    public function addCategory(){
        return view('admin.category.addCategory');
    }

    public function createCategory(Request $request){

        $validator = Validator::make($request->all(), [
            'name' => 'required',
        ]);

        if ($validator->fails()) {
            return back()
                        ->withErrors($validator)
                        ->withInput();
        }

        $data=[
            'category_name'=>$request->name,
        ];

        Category::create($data);
        return redirect()->route('admin#category')->with(['success'=>"Category Added..."]);
    }

    //direct admin category page
    public function category(){
        $data=Category::select('categories.*',DB::raw('COUNT(pizzas.category_id) as count'))
                        ->leftJoin('pizzas','pizzas.category_id','categories.category_id')
                        ->groupBy('categories.category_id')
                        ->paginate(7);

        // dd($data->toArray());

        if(count($data)==0){
            $empty_status=0;
        }else{
            $empty_status=1;

        }
        return view('admin.category.list')->with(['category'=>$data,'status'=>$empty_status]);
    }

    //direct delete category
    public function deleteCategory($id){
        Category::where('category_id',$id)->delete();
        return back()->with(['success'=>'Category Deleted....']);
    }

    //direct edit category page
    public function editCategory($id){
        $data=Category::where('category_id',$id)->first();
        return view('admin.category.update')->with(['category'=>$data]);
    }

    //update category
    public function updateCategory(Request $request){
        $validator = Validator::make($request->all(), [
            'name' => 'required',
        ]);

        if ($validator->fails()) {
            return back()
                        ->withErrors($validator)
                        ->withInput();
        }

        $updateData=[
            'category_name'=>$request->name
        ];

        Category::where('category_id',$request->id)->update($updateData);
        return redirect()->route('admin#category')->with(['success'=>'Category Update Success...']);
    }

    //search category
    public function searchCategory(Request $request){
        // dd($request->all());
        $data=Category::where('category_name','like','%'.$request->searchData.'%')->paginate(7);
        $data->appends($request->all());
        if(count($data)==0){
            $empty_status=0;
        }else{
            $empty_status=1;

        }

        // dd($data->toArray());
        return view('admin.category.list')->with(['category'=>$data,'status'=>$empty_status]);
        // return redirect()->route('admin#category')->with(['category'=>$data]);
    }

}