<?php

namespace paperbagsng\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use paperbagsng\Customer;


class RegistrationController extends Controller
{
    //

    public function getRegistration(){

    }

    public function postRegistration(Request $request){
        $input = $request->all();
        array_forget($input,"_token");
        array_forget($input,"confirm");
        $validator = Validator::make($input, [
            'first_name'  =>  'required|min:2',
            'last_name'  =>  'required|min:2',
            'email'=> 'required|min:4|unique:customers',
            'phone'  =>  'required|min:6|unique:customers',
            'password' =>  'required|min:5',

        ]);
        if ($validator->fails()) {
            if($request->ajax()){
                return response()->json($validator->messages());
            }else{
                return Redirect::back()
                    ->withErrors($validator)
                    ->withInput();
            }
        }else{
            $customer = new Customer();
            foreach($input as $key=>$value){
                $customer->$key = $value;
            }
            $customer->password = Hash::make($input['password']);
            if($customer->save()){
                if($request->ajax()){ // if request is ajax
                    return response()->json("Congratulations! Your registration on paperbagsng.com was successful");
                }else{
                    Session::flash("success_message","Congratulations! Your registration on paperbagsng.com was successful");
                    Redirect::back()->with("success_message","");
                }
            }else{ //record could not be created
                if($request->ajax()){ //if request is ajax
                    return response()->json("Congratulations! Your registration on paperbagsng.com was successful");
                }else{
                    Session::flash("success_message","Congratulations! Your registration on paperbagsng.com was successful");
                    Redirect::back()->with("success_message","");
                }
            }
        }
    }

}
