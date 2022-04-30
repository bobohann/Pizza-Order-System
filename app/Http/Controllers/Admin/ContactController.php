<?php

namespace App\Http\Controllers\Admin;

use App\Models\Contact;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class ContactController extends Controller
{
    public function createContact(Request $request){
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required',
            'message' => 'required',
        ]);

        if ($validator->fails()) {
            return back()
                        ->withErrors($validator)
                        ->withInput();
        }

        // dd($request->all());
        $data=$this->requestUserData($request);
        // dd($data);
        Contact::create($data);
        return back()->with(['success'=>'Your message sended...']);

    }

    //direct contact message list page
    public function contactList(){
        $data =Contact::orderBy('contact_id','desc')->paginate(7);

        if(count($data)==0){
            $empty_status=0;
        }else{
            $empty_status=1;

        }

        return view('admin.contact.list')->with(['contact'=>$data,'status'=>$empty_status]);
    }

    //search contact message
    public function contactSearch(Request $request){
        $searchData=Contact::orwhere('name','like','%'.$request->searchData.'%')
                        ->orwhere('email','like','%'.$request->searchData.'%')
                        ->orwhere('message','like','%'.$request->searchData.'%')
                        ->paginate(7);
        $searchData->appends($request->all());

        if(count($searchData)==0){
            $empty_status=0;
        }else{
            $empty_status=1;

        }

        return view('admin.contact.list')->with(['contact'=>$searchData,'status'=>$empty_status]);

    }

    private function requestUserData($request){
        return [
            'user_id'=>auth()->user()->id,
            'name'=>$request->name,
            'email'=>$request->email,
            'message'=>$request->message,
        ];
    }
}
