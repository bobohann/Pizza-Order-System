<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class UserController extends Controller
{
    //direct user list page
    public function userList(){
        $userData=User::where('role','user')->paginate(7);
        // dd($userData->toArray());
        if(count($userData)==0){
            $empty_status=0;
        }else{
            $empty_status=1;

        }

        return view('admin.user.userList')->with(['user'=>$userData,'status'=>$empty_status]);
    }

    //direct Admin list page
    public function adminList(){
        $adminData=User::where('role','admin')->paginate(7);
        // dd($adminData->toArray());
        if(count($adminData)==0){
            $empty_status=0;
        }else{
            $empty_status=1;

        }

        return view('admin.user.adminList')->with(['admin'=>$adminData,'status'=>$empty_status]);
    }

    //user search
    public function userSearch(Request $request){
        // dd($request->all());
        $response=$this->search('user',$request);


        if(count($response)==0){
            $empty_status=0;
        }else{
            $empty_status=1;

        }

        return view('admin.user.userList')->with(['user'=>$response,'status'=>$empty_status]);
    }

    //admin search
    public function adminSearch(Request $request){
        // dd($request->all());
        $response=$this->search('admin',$request);

        if(count($response)==0){
            $empty_status=0;
        }else{
            $empty_status=1;

        }

        return view('admin.user.adminList')->with(['admin'=>$response,'status'=>$empty_status]);
    }

    //user delete
    public function userDelete($id){
        User::where('id',$id)->delete();
        return back()->with(['success'=>"user data deleteed..."]);
    }

     //data search
    private function search($role,$request){
        $searchData=User::where('role',$role)
        ->where(function ($query) use ($request) {
            $query->orWhere('name','like','%'.$request->searchData.'%')
            ->orWhere('email','like','%'.$request->searchData.'%')
            ->orWhere('phone','like','%'.$request->searchData.'%')
            ->orWhere('address','like','%'.$request->searchData.'%');
        })
        ->paginate(7);
        $searchData->appends($request->all());
        return $searchData;

    }
}
