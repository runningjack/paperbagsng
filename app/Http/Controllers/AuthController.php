<?php
/*
=================================================
CMS Name  :  DOPTOR
CMS Version :  v1.2
Available at :  www.doptor.org
Copyright : Copyright (coffee) 2011 - 2014 Doptor. All rights reserved.
License : GNU/GPL, visit LICENSE.txt
Description :  Doptor is Opensource CMS.
===================================================
*/

namespace paperbagsng\Http\Controllers;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use paperbagsng\User;
use Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;
class AuthController extends Controller {



    /**
     * View for the login page
     * @return View
     */
    public function getLogin()
    {
        if (\Auth::check()) {
            return Redirect::intended('backend/dashboard/index');
            // return Redirect::to('your_default_logged_in_page')->with('success', 'You have logged in successfully');
            //return Redirect::to("dashboard");
        }else{
            return View::make('backend.login');
        }
    }

    public function getAccountLogin()
    {
        try
        {
        if (\Auth::account()->check()) {

            return Redirect::intended('account/index')->with("categories",DB::table("categories")->get());

        }else{
            //
            \Session::put("error_message","Invalid username or password");
            //return \Redirect::back();
            return Redirect::to('account/login')->with("categories",DB::table("categories")->get());
        }
        }catch (Exception $e){
            \Session::put("error_message",$e->getMessage());
            return \Redirect::back();
        }


    }

    /**
     * Login action
     * @return Redirect
     */
    public function postLogin(Request $request,$target='backend')
    {
        $input = $request->all();
        try{
            $auth = auth()->guard('user');
            $credentials = [
                'email' =>  $input['email'],
                'password' =>  $input['password'],
            ];
            if ($auth->attempt($credentials)) {
                if ($redirect = Session::get('redirect')) {
                    return Redirect::to($redirect);
                } else {
                    return Redirect::intended('backend/dashboard/index');
                }
            } else {
                Session::flash("error_message","Unexpected Error! Login was not successful");
                return Redirect::back();
            }
        }catch(\Exception $ex){
            Session::flash("error_message",$ex->getMessage());
            return Redirect::back();

        }

    }


    /**
     * Logout action
     * @return Redirect
     */
    public function getLogout()
    {
        Auth::logout();
        Session::flush();
        return Redirect::to('/login/backend/');
    }

    public function getAccountLogout(){
        Auth::account()->logout();
        return Redirect::to("/");
    }

    public function postForgotPassword()
    {
        $input = Input::all();
        $validator = User::validate_reset($input);
        if ($validator->passes()) {
            $user = User::whereEmail($input['email'])->first();
            if ($user) {
                $user = Sentry::findUserByLogin($user->username);
                $resetCode = $user->getResetPasswordCode();
                $data = array('user_id'=> $user->id,'resetCode' => $resetCode);
                Mail::queue('backend.'.$this->current_theme.'.reset_password_email', $data, function($message) use($input, $user) {
                    $message->from(get_setting('email_username'), Setting::value('website_name'))
                            ->to($input['email'], "{$user->first_name} {$user->last_name}")
                            ->subject('Password reset ');
                });
                return Redirect::back()->with('success_message', 'Password reset code has been sent to the email address. Follow the instructions in the email to reset your password.');
            } else {
                return Redirect::back()->with('error_message', 'No user exists with the specified email address');
            }
        } else {
            return Redirect::back()->withInput()->with('error_message', implode('<br>', $validator->messages()->get('email')));
        }
    }

    public function getResetPassword($id, $token, $target='backend')
    {
        if (Sentry::check()) {
            return Redirect::to($target);
        }
        try {
            $user = Sentry::findUserById($id);

            $this->layout = View::make($target . '.'.$this->current_theme.'._layouts._login');
            $this->layout->title = 'Reset Password';

            if ($user->checkResetPasswordCode($token)) {
                $this->layout->content = View::make($target . '.'.$this->current_theme.'.reset_password')
                                                ->with('id', $id)
                                                ->with('token', $token)
                                                ->with('target', $target)
                                                ->with('user', $user);
            } else {
                $this->layout->content = View::make($target . '.'.$this->current_theme.'.reset_password')
                                                ->withErrors(array(
                                                        'invalid_reset_code'=>'The provided password reset code is invalid'
                                                    ));
            }
        } catch (Cartalyst\Sentry\Users\UserNotFoundException $e) {
            $this->layout->content = View::make($target . '.'.$this->current_theme.'.reset_password')
                                            ->withErrors('The specified user doesn\'t exist');
        }
    }

    public function postResetPassword()
    {
        $input = Input::all();

        try {
            $user = Sentry::findUserById($input['id']);

            if ($input['username'] != $user->username
                || $input['security_answer'] != $user->security_answer
                ) {
                return Redirect::back()
                                    ->withInput()
                                    ->with('error_message', 'Either the username or security answer is incorrect');
            }

            if ($user->checkResetPasswordCode($input['token'])) {
                if ($user->attemptResetPassword($input['token'], $input['password'])) {

                    $data = array(
                            'user_id'      => $user->id,
                            'created_at' => strtotime($user->created_at) * 1000
                        );

                    Mail::queue('backend.'.$this->current_theme.'.reset_password_confirm_email', $data, function($message) use($input, $user) {
                        $message->from(get_setting('email_username'), Setting::value('website_name'))
                                ->to($user->email, "{$user->first_name} {$user->last_name}")
                                ->subject('Password Reset Confirmation');
                    });

                    $user->last_pw_changed = date('Y-m-d h:i:s');
                    $user->save();

                    return Redirect::to("login/${input['target']}")
                                        ->with('success_message', 'Password reset is successful. Now you can log in with your new password');
                } else {
                    return Redirect::back()
                                    ->with('error_message', 'Password reset failed');
                }
            } else {
                return Redirect::back()
                                    ->withErrors(array(
                                            'invalid_reset_code'=>'The provided password reset code is invalid'
                                        ));
            }
        } catch (Cartalyst\Sentry\Users\UserNotFoundException $e) {
            return Redirect::back()
                                ->with('error_message', 'The specified user doesn\'t exist');
        }
    }

    public function suspendUser($user_id, $created_at)
    {
        $user = Sentry::findUserById($user_id);

        if (strtotime($user->created_at) * 1000 == $created_at) {
            $this->user_manager->deactivateUser($user_id);

            return Redirect::to('login/backend')
                                ->with('success_message', 'The user has been suspended.');
        } else {
            return Redirect::to('login/backend')
                                ->with('error_message', 'The user cannot be suspended.');
        }
    }
}
