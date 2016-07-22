<?php

namespace App\Http\Controllers\Auth;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;


class AuthController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Registration & Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users, as well as the
    | authentication of existing users. By default, this controller uses
    | a simple trait to add these behaviors. Why don't you explore it?
    |
    */

    use AuthenticatesAndRegistersUsers, ThrottlesLogins;

    /**
     * Create a new authentication controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest', ['except' => 'getLogout']);
    }



    public function getLogin(){
        return View('auth.login');
    }

    public function getLogout(){
        Auth::logout();
        return View('account.auth.login');
    }

    public function postLogin(Request $request){

            $input =$request->all();
           // $input['email'] = $input['username'];
            $validator = Validator::make($input, [
                'email'  =>  'email|required|min:5',
                'password'  =>  'required|min:5'
            ]);
            if ($validator->fails()) {
                if($request->ajax()){ // if request is ajax
                    Session::flash("error_message","Email or Password field cannot be empty");
                    echo "Email or Password field cannot be empty";
                }else{
                    Session::flash("success_message","Email or Password field cannot be empty");
                    Redirect::back() ->withErrors($validator)->withInput();
                }
            }else{

                $username = $input['email'];
                $password = $input['password'];
                //dO AJAX LOGIN ONLY FOR ORDER FORM LOGIN
                if($request->ajax()){
                    if (Auth::attempt(array('email' => $username, 'password' => $password),true))
                    {
                        echo "Congratulations! Your login was successful";

                    }else{
                        echo "username and password combination not correct";
                    }
                    exit;
                }else{
                    //NON AJAX HERE FOR NORMAL LOGIN AND REDIRECT TO ACCOUNT HOME
                }
            }





        }


}
