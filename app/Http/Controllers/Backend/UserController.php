<?php
/**
 * Created by PhpStorm.
 * User: Amedora
 * Date: 12/31/14
 * Time: 1:41 PM
 */

namespace Backend;


class UserController extends BackendController {
    public function getUserIndex(){
        return \View::make("backend.administrators.index")->with("page_title","Users")
            ->with("users",\User::all());
    }

    public function getAddUser(){
        return \View::make("backend.administrators.addnew");
    }

    public function postAddUser(){
        $validation = \User::validate(\Input::all());
        $input = \Input::all();
       if($validation->fails()){

            return \Redirect::back()->withErrors($validation)->withInput();
        }else{

            $user = new \User();
            $user->firstname = $input['firstname'];
            $user->lastname  = $input['lastname'];
            $user->phone    =   $input['phone'];
            $user->username = $input['username'];
            $user->email    =   $input['email'];
            $user->middlename    =   $input['middlename'];
            $user->status       =   $input['status'];
            $user->password     =  \Hash::make(\Input::get("password"));


            try{
                $user->save();
\Session::put("message","New User added to database");
            return \Redirect::back();

            }catch(\Illuminate\Database\QueryException $e){
                \Session::put("error_message",$e->getMessage());
                return \Redirect::back();
            }catch(\PDOException $e){
                \Session::put("error_message",$e->getMessage());
                return \Redirect::back();
            }catch(\Exception $e){
                \Session::put("error_message",$e->getMessage());
                return \Redirect::back();
            }
       }
    }

    public function getEditUser($id){
        $user = \User::find($id);
        return \View::make("backend.administrators.edituser")->with("title","Edit User")
            ->with("myuser",$user);
    }

    public function postEditUser($id){
        $validation = \User::validate(\Input::all());
        $input = \Input::all();
        if(isset($_POST['action']) && $_POST['action'] == "change password"){
            $user = \User::find($input['id']);
            $user->password = \Hash::make(\Input::get("password"));
            if($user->update()){
                echo "Password changed successfully";
            }else{
                echo "Unexpected Error!  Password change was not successfully";
            }
            exit;
        }


            $user = \User::find($input['id']);
            $user->firstname        = $input['firstname'];
            $user->lastname         = $input['lastname'];
            $user->phone            = $input['phone'];
            $user->username         = $input['username'];
            $user->email            = $input['email'];
            $user->middlename       = $input['middlename'];
            $user->status           = isset($input['status']) ? $input['status'] :"inactive";



            try{
                $user->update();
                \Session::put("message","User record updated");
                return \Redirect::back();

            }catch(\Illuminate\Database\QueryException $e){
                \Session::put("error_message",$e->getMessage());
                return \Redirect::back();
            }catch(\PDOException $e){
                \Session::put("error_message",$e->getMessage());
                return \Redirect::back();
            }catch(\Exception $e){
                \Session::put("error_message",$e->getMessage());
                return \Redirect::back();
            }
        }

} 