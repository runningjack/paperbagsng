<?php

namespace paperbagsng\Http\Controllers\Backend;

use Illuminate\Http\Request;

use paperbagsng\Http\Requests;
use paperbagsng\Http\Controllers\Controller;
use paperbagsng\Post;

class PagesController extends Controller
{
    //

    public function getPagesList(){

        return \View::make("backend.pages.index")->with("pages",\DB::table("posts")->where("type","page")->paginate(10))->with("title","All Pages");
    }


    public function getPostsList(){
        return \View::make("backend.posts.index")
            ->with("posts",\DB::table("posts")->where("type","post")->get())
            ->with("categories",\DB::table("posts")->where("type","category")->get())
            ->with("title","All Posts");
    }

    public function  getEditPage($id){
        return \View::make("backend.pages.editpage")
            ->with("mypage",\DB::table("posts")->where("id",$id)->get())
            ->with("pages",\DB::table("posts")->where("type","page")->get())->with("title","All Pages")->with("title","Edit Page");
    }

    public function  postEditPage($id){
        $validation = \Post::validate(\Input::all());
        $input = \Input::all();
        /*
         |--------------------------------------------------------------------------
         | Ajax Delete only
         |--------------------------------------------------------------------------
       */if(\Request::ajax()){

            if(isset($_POST['action']) && $_POST['action'] == "delete"){
                $post = \Post::find($id);
                $postcheck = \Post::where("parent_id","=",$id)->get();
                if($postcheck->count()>=1){
                    echo"Record could not be deleted! This item has sub-items associated";
                    exit;
                }
                if($post->delete()){
                    \Session::put("message",$post->title. " Succesfully Deleted");

                    echo "Succesfully Deleted";
                }else{
                    \Session::put("message",$post->title. " Unexpected Error! Record Could not be deleted");
                    echo "Unexpected Error! Record Could not be deleted";
                }

            }


            $file = "./uploads/images/";
            if(isset($_FILES["files"]) && $_FILES["files"]!="" && $_FILES["files"]['tmp_name']!="") {
                $sign_name = $_FILES["files"]["name"];
                $File_Ext           = substr($sign_name, strrpos($sign_name, '.')); //get file extention
                $File_Name           = substr($sign_name,0, strrpos($sign_name, '.')); //get file extention
                $sign_tmp_name = $_FILES["files"]["tmp_name"];
                $NewFileNameSignature        = preg_replace("/\s/","_",$File_Name)."_".time().$File_Ext ;
                //move_uploaded_file($tmp_name, "$uploads_dir/$name");
                move_uploaded_file($sign_tmp_name,$file.basename($sign_name) );
                rename($file.basename($sign_name),$file.$NewFileNameSignature);
                echo "File successfully updated";
            }
            $file = "./uploads/audios/";
            if(isset($_FILES["audio"]) && $_FILES["audio"]!="" && $_FILES["audio"]['tmp_name']!="") {

                $sign_name = $_FILES["audio"]["name"];
                $File_Ext           = substr($sign_name, strrpos($sign_name, '.')); //get file extention
                $File_Name           = substr($sign_name,0, strrpos($sign_name, '.')); //get file extention
                $sign_tmp_name = $_FILES["audio"]["tmp_name"];
                $NewFileNameSignature        = preg_replace("/\s/","_",$File_Name)."_".time().$File_Ext ;
                //move_uploaded_file($tmp_name, "$uploads_dir/$name");
                move_uploaded_file($sign_tmp_name,$file.basename($sign_name) );
                rename($file.basename($sign_name),$file.$NewFileNameSignature);
                echo "File successfully updated";
            }


            exit;
        }
        if($validation->fails()){
            if($input['type']=="page"){
                return \Redirect::back();
            }elseif($input['type']=="post"){
                return \Redirect::back()->withErrors($validation)->withInput();
            }elseif($input['type'] == "category"){
                return \Redirect::back()->withErrors($validation)->withInput();
            }

        }else{
            $post =  \Post::find($id);
            $post->description      =   (isset($_POST['description'])) ?  \Input::get("description") : "";
            $post->title            =   $input['title'];
            $post->p_content        =   $input['p_content'];
            $post->permalink        =   $input['permalink'];
            $post->type             =   $input['type'];
            $post->parent_id        =   $input['parent_id'];
            //$post->view_status    =   $input['view_status'];
            $post->created_by       =   "Admin";
            $post->meta_keyword     =   $input['meta_keyword'];
            $post->meta_description =   $input['meta_description'];
            $post->meta_title       =   $input['meta_title'];
            $post->image            =   $input['image'];
            $post->audio            =   isset($input['audio']) ? $input['audio'] : "";
            $post->video            =   isset($input['video']) ? $input['video'] : "";
            $post->start_date           =   isset($input['start_date']) ? $input['start_date'] : "";
            $post->end_date             =   isset($input['end_date']) ? $input['end_date'] : "";
            $post->start_time           =   isset($input['start_time']) ? $input['start_time'] : "";
            $post->end_time             =   isset($input['end_time']) ? $input['end_time'] : "";
            $post->venue                =   isset($input['venue']) ? $input['venue'] : "";
            //var_dump($post);
            try {
                if($post->update()){
                    \Session::put("success_message",'The ' . $input["type"] . ' was successful updated.');
                    return \Redirect::back();
                }else{
                    \Session::put("error_message",' Unexpected Error! The ' . $input["type"] . ' was not updated.');
                    return \Redirect::back();
                }

            } catch(ValidationException $e) {
                \Session::put("error_message",$e->getMessage());
                return \Redirect::back()->withInput()->withErrors($e->getErrors());
            }catch(\Illuminate\Database\QueryException $e){
                \Session::put("error_message",$e->getMessage());
                return \Redirect::back();
                exit;
            }catch(\PDOException $e){
                \Session::put("error_message",$e->getMessage());
                return \Redirect::back();
                //exit;
            }catch(\Exception $e){
                \Session::put("error_message",$e->getMessage());
                return \Redirect::back();
                //exit;
            }

        }


    }

    public function getAddPage(){
        return \View::make("backend.pages.addnew")->with("pages",\DB::table("posts")->where("type","page")->get())->with("title","All Pages")->with("title","Add New Page");
    }

    public function getAddPost(){

        $cats = \DB::table("posts")->where("type","category")->get();
        return \View::make("backend.posts.addnew")->with("posts",\DB::table("posts")->where("type","post")->get())
            ->with("title","All Post")->with("title","Add New Post")
            ->with("categories",$cats);
    }

    public function  getEditPost($id){
        $cats = \DB::table("posts")->where("type","category")->get();
        return \View::make("backend.posts.editpost")
            ->with("mypage",\DB::table("posts")->where("id",$id)->first())
            ->with("pages",\DB::table("posts")->where("type","page")->get())
            ->with("title","All Pages")
            ->with("categories",$cats)
            ->with("title","Edit Post");
    }

    public function postAddPage(Request $request,$type=""){
        $input = $request->all();
        $validation = Post::validate($input);
        if($request->ajax()){

            $file = "./uploads/images/";
            if(isset($_FILES["files"]) && $_FILES["files"]['tmp_name']!="") {

                $sign_name                      = $_FILES["files"]["name"];
                $File_Ext                       = substr($sign_name, strrpos($sign_name, '.')); //get file extention
                $File_Name                      = substr($sign_name,0, strrpos($sign_name, '.')); //get file extention
                $sign_tmp_name                  = $_FILES["files"]["tmp_name"];
                $NewFileNameSignature           = preg_replace("/\s/","_",$File_Name)."_".time().$File_Ext ;
                //move_uploaded_file($tmp_name, "$uploads_dir/$name");
                move_uploaded_file($sign_tmp_name,$file.basename($sign_name) );
                rename($file.basename($sign_name),$file.$NewFileNameSignature);
            }
            exit;
        }
        //Section reserve to delete data
        // form the post table
        if($type =="delete" && isset($_POST['delete'])){
            $post = \Post::find($input["id"])->first();
            try{
                if($post->delete()){
                    \Session::put("success_message",$post->title. " Succesfully Deleted");
                    if($input['type'] == "slideshow"){
                        $image = \Slideshow::where("img_name",$input["image"])->first();
                        $image->status =0;
                        $image->update();
                    }
                    return \Redirect::back();
                }
            } catch(ValidationException $e) {
                return \Redirect::back()->withInput()->withErrors($e->getErrors());
                exit;
            }catch(\Illuminate\Database\QueryException $e){
                \Session::put("error_message",$e->getMessage());
                return \Redirect::back();
                exit;
            }catch(\PDOException $e){
                \Session::put("error_message",$e->getMessage());
                return \Redirect::back();
                //exit;
            }catch(\Exception $e){
                \Session::put("error_message",$e->getMessage());
                return \Redirect::back();
                //exit;
            }
            exit;
        }

        if($validation->fails()){
            if($input['type']=="page"){
                return \Redirect::back()->withErrors($validation)->withInput();
            }elseif($input['type']=="post"){
                return \Redirect::back()->withErrors($validation)->withInput();
            }elseif($input['type'] == "category"){
                return \Redirect::back()->withErrors($validation)->withInput();
            }elseif($input['type'] == "custom menu"){
                return \Redirect::back()->withErrors($validation)->withInput();
            }

        }else{

            $post = new Post();
            if($type == "delete" && isset($_POST['update'])){
                $post = Post::find($input["id"])->first();
                \Session::put("message",$post->title. " Succesfully Deleted");
                if($input['type'] == "slideshow"){
                    $image = \Slideshow::where("img_name",$input["oldimage"])->first();
                    //print_r($image);
                    $image->status =0;
                    $image->img_name = $input['image'];
                    $image->save();
                    (isset($_POST['description'])) ? $post->description = $input["description"] : "";
                    $post->title            =   $input['title'];
                    $post->p_content        =   $input['p_content'];
                    $post->permalink        =   $input['permalink'];
                    $post->type             =   $input['type'];
                    $post->parent_id        =   $input['parent_id'];
                    $post->image            =   isset($_POST['image']) ? $input['image'] :"";
                    $post->audio            =   $input['audio'];
                    $post->video            =   $input['video'];
                    //$post->view_status      =   $input['view_status'];
                    $post->created_by       =   "Admin";
                    $post->meta_keyword     =   $input['meta_keyword'];
                    $post->meta_description =   $input['meta_description'];
                    $post->meta_title       =   $input['meta_title'];
                    $post->start_date           =   isset($input['start_date']) ? $input['start_date'] : "";
                    $post->end_date             =   isset($input['end_date']) ? $input['end_date'] : "";
                    $post->start_time           =   isset($input['start_time']) ? $input['start_time'] : "";
                    $post->end_time             =   isset($input['end_time']) ? $input['end_time'] : "";
                    $post->venue                =   isset($input['venue']) ? $input['venue'] : "";

                    $post->save();
                }
                return \Redirect::back();
                exit;

            }

            if($type=="slidepost"){
                $post->description = $input['p_content'];
                $image = \Slideshow::where("img_name",$input["image"])->first();
                $image->status =1;
                $image->save();
            }
            $filename_audio  = "";
            $file = "./uploads/audios/";

            if(isset($_FILES["file_audio"]) && $_FILES["file_audio"]['tmp_name']!="") {



                $sign_name = $_FILES["file_audio"]["name"];
                $File_Ext           = substr($sign_name, strrpos($sign_name, '.')); //get file extention
                $File_Name           = substr($sign_name,0, strrpos($sign_name, '.')); //get file extention
                $sign_tmp_name = $_FILES["file_audio"]["tmp_name"];
                $NewFileNameSignature        = preg_replace("/\s/","_",$File_Name)."_".time().$File_Ext ;
                //move_uploaded_file($tmp_name, "$uploads_dir/$name");
                move_uploaded_file($sign_tmp_name,$file.basename($sign_name) );
                rename($file.basename($sign_name),$file.$NewFileNameSignature);
                $filename_audio = $NewFileNameSignature;
                echo "File successfully updated";
                exit;
            }

            (isset($_POST['description'])) ? $post->description = $input["description"] : "";
            $post->title                =   $input['title'];
            $post->p_content            =   $input['p_content'];
            $post->permalink            =   $input['permalink'];
            $post->type                 =   $input['type'];
            $post->parent_id            =   (isset($input['parent_id'])) ? $input['parent_id'] :"";
            $post->image                =   isset($_POST['image']) ? $input['image'] :"";
            //$post->view_status        =   $input['view_status'];
            $post->created_by           =   "Admin";
            $post->meta_keyword         =   $input['meta_keyword'];
            $post->meta_description     =   $input['meta_description'];
            $post->meta_title           =   $input['meta_title'];
          //  $post->audio                =  empty($filename_audio) ? $input['audio'] : $filename_audio;
            $post->video                =   isset($_POST['video']) ? $input['video'] :"";
            $post->start_date           =   isset($input['start_date']) ? $input['start_date'] : "";
            $post->end_date             =   isset($input['end_date']) ? $input['end_date'] : "";
            $post->start_time           =   isset($input['start_time']) ? $input['start_time'] : "";
            $post->end_time             =   isset($input['end_time']) ? $input['end_time'] : "";
            $post->venue                =   isset($input['venue']) ? $input['venue'] : "";

            //var_dump($post);
            try {

                if($post->save()){
                    \Session::put("success_message","Post Created");
                    return \Redirect::back()
                        ->with('success_message', 'The ' . $input["type"] . ' was created.');
                }else{
                    \Session::put("error_message","Unexpected Error! Post Not Created");
                    return \Redirect::back()
                        ->with('error_message', 'Unexpected Error! The ' . $input["type"] . ' was not created.');
                }

            } catch(ValidationException $e) {
                return \Redirect::back()->withInput()->withErrors($e->getErrors());
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


    /*
      |--------------------------------------------------------------------------
      | Start Section to manage post categories
      |--------------------------------------------------------------------------
    */
    public function getCategoriesIndex(){
        $cats = \DB::table("posts")->where("type","category")->where("id","!=",92)->where("id","!=",183)->get();
        return \View::make("backend.categories.index")->with("categories",$cats);
    }


    public function postCategory(){
        $validation = \Post::validate(\Input::all());
        $input = \Input::all();

        if($validation->fails()){
            if($input['type']=="page"){
                return \Redirect::Route("addnewpage")->withErrors($validation)->withInput();
            }elseif($input['type']=="post"){
                return \Redirect::Route("addnewpost")->withErrors($validation)->withInput();
            }elseif($input['type'] == "category"){
                return \Redirect::Route("listcat")->withErrors($validation)->withInput();
            }



        }else{
            $post = new \Post();
            $post->title            =   $input['title'];
            $post->p_content        =   $input['p_content'];
            $post->permalink        =   $input['permalink'];
            $post->type             =   $input['type'];
            $post->created_by       =   "Admin";
            //var_dump($post);
            try {
                $post = $post->save();
                return '<div class="alert alert-success fade in">
                                        <button class="close" data-dismiss="alert">×</button>
                                        <i class="fa-fw fa fa-times">Category created"</div>';
                // $redirect = (isset($input['form_save'])) ? "backend/{$input['type']}s" : "backend/{$input['type']}s/create";

                //return \Redirect::to($redirect)
                // ->with('success_message', 'The ' . $this->type . ' was created.');
            } catch(ValidationException $e) {
                return "Unexpected Error! Category not created";// \Redirect::back()->withInput()->withErrors($e->getErrors());
            }
        }
    }

}
