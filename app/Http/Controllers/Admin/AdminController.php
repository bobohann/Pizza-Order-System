<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AdminController extends Controller
{

    //direct admin profile
    public function profile(){
        $id=auth()->user()->id;
        $userData=User::where('id',$id)->first();

        return view('admin.profile.index')->with(['user'=>$userData]);
    }

    //update profile
    public function updateProfile($id,Request $request){
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required',
            'phone' => 'required',
            'address' => 'required',
        ]);

        if ($validator->fails()) {
            return back()
                        ->withErrors($validator)
                        ->withInput();
        }
        $updateData=$this->requestUserData($request);
        // dd($updateData);

        User::where('id',$id)->update($updateData);
        return back()->with(['success'=>'User Profile Updated...']);
    }

    //change password
    public function changePassword($id,Request $request){
        // dd($id);
        // dd($request->all());
        $validator = Validator::make($request->all(), [
            'oldPassword' => 'required',
            'newPassword' => 'required|min:6',
            'confirmPassword' => 'required|min:6',
        ]);

        if ($validator->fails()) {
            return back()
                        ->withErrors($validator)
                        ->withInput();
        }

        // dd('success');


        $data=User::where('id',$id)->first();

        $oldPassword=$request->oldPassword;
        $newPassword=$request->newPassword;
        $confirmPassword=$request->confirmPassword;
        // dd($data->toArray());
        $hashValue=$data['password'];
        // dd($hashValue);

        if(Hash::check($oldPassword, $hashValue)){
            // dd('password same');
            if($newPassword != $confirmPassword){
                return back()->with(['notMatchError'=>'Confrim Password Do not Match with New Password, try again!!']);
            }else{ //password change
                // dd('ok');
                $hash=Hash::make($newPassword);

                $passwordData=[
                    'password'=>$hash
                ];
                User::where('id',$id)->update($passwordData);
                return back()->with(['success'=>'Congrate Your password updated']);
            }
        }else{
            // dd('not match');
            return back()->with(['notMatchError'=>'your old Password not correct, try again!!!']);

        }
    }

    public function changePasswordPage(){
        return view('admin.profile.changePassword');
    }


    private function requestUserData($request){
        return [
            'name'=>$request->name,
            'email'=>$request->email,
            'phone'=>$request->phone,
            'address'=>$request->address,
        ];
    }
}