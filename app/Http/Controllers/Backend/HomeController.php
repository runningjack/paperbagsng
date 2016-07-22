<?php
/**
 * Created by PhpStorm.
 * User: Amedora
 * Date: 12/19/14
 * Time: 9:07 AM
 */

namespace paperbagsng\Http\Controllers\Backend;


use paperbagsng\Http\Controllers\Controller;

class HomeController extends Controller {
    public function getIndex(){
        return \View::make("backend.dashboard.index");
    }

    /*
      |--------------------------------------------------------------------------
      | Start Section to manage pages
      |--------------------------------------------------------------------------
    */
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

    public function postAddPage($type=""){
        $validation = \Post::validate(\Input::all());
        $input = \Input::all();
        if(\Request::ajax()){
            echo "file";
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

            $post = new \Post();
            if($type == "delete" && isset($_POST['update'])){
                $post = \Post::find($input["id"])->first();
                \Session::put("message",$post->title. " Succesfully Deleted");
                if($input['type'] == "slideshow"){
                    $image = \Slideshow::where("img_name",$input["oldimage"])->first();
                    //print_r($image);
                    $image->status =0;
               $image->img_name = $input['image'];
                    $image->save();
                    (isset($_POST['description'])) ? $post->description = \Input::get("description") : "";
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

            (isset($_POST['description'])) ? $post->description = \Input::get("description") : "";
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
            $post->audio                =  empty($filename_audio) ? $input['audio'] : $filename_audio;
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


    /*
      |--------------------------------------------------------------------------
      | Start Section to manage menu
      |--------------------------------------------------------------------------
    */

    public function getMenuHome(){
        $cats   = \DB::table("posts")->where("type","category")->get();
        $custs   = \DB::table("posts")->where("type","=","custom menu")->get();
        $pages  = \DB::table("posts")->where("type","page")->get();
        $allPages = \DB::table("posts")->get();

        $mymenus =\DB::table("menus")->get();
        $menus="";


        if($mymenus){
            foreach($mymenus as $menu){
                if($menu->menu_type =="mainmenu"){
                    $menus .='<li class="dd-item" data-title="'.$menu->title.'" data-id="'.$menu->id.'" data-parent="'.$menu->parent_id.'" data-link="'.$menu->link.'" data-post="'.$menu->post_id.'">
                                    <div class="dd-handle">'.
                        $menu->title
                                    .'</div>';
                    if($menu->has_child==1 && $menu->menu_type =="mainmenu"){
                        $menus .= '<ol class="dd-list" >';
                            $submenus = \Menu::where("parent_id","=",$menu->id)->get();
                            foreach($submenus as $submenu1){
                                $menus .='<li class="dd-item"  data-title ="'.$submenu1->title.'" data-id="'.$submenu1->id.' data-parent="'.$submenu1->parent_id.'" data-link="'.$submenu1->link.'" data-post="'.$submenu1->post_id.'">
                                    <div class="dd-handle">'.$submenu1->title.'</div>';
                                if($submenu1->has_child==1 && $submenu1->menu_type =="submenu1"){ //get second level menu for first level
                                    $menus .= '<ol class="dd-list" >';
                                    $submenus = \Menu::where("parent_id","=",$menu->id)->get();
                                    foreach($submenus as $submenu2){
                                        $menus .='<li class="dd-item"  data-title ="'.$submenu2->title.'" data-id="'.$submenu2->id.' data-parent="'.$submenu2->parent_id.'" data-link="'.$submenu2->link.'" data-post="'.$submenu2->post_id.'" >
                                    <div class="dd-handle">'.$submenu2->title.'</div>';
                                            if($submenu2->has_child==1 && $submenu2->menu_type == "submenu2"){
                                                foreach($submenus as $submenu3){
                                                    $menus .='<li class="dd-item"  data-title ="'.$submenu3->title.'" data-id="'.$submenu3->id.' data-parent="'.$submenu3->parent_id.'" data-link="'.$submenu3->link.'" data-post="'.$submenu3->post_id.'" >
                                                    <div class="dd-handle">'.$submenu3->title.'</div>';
                                                    $menus .='<i style="border-radius:13px; float:right; margin-top:-50px" class=" b fa fa-times-circle"></i></li>';
                                                }
                                                $menus .='</ol>';
                                            }
                                        $menus .='<i style="border-radius:13px; float:right; margin-top:-50px" class=" b fa fa-times-circle"></i></li>';
                                    }
                                    $menus .='</ol>';
                                }
                                $menus .='<i style="border-radius:13px; float:right; margin-top:-50px" class=" b fa fa-times-circle"></i></li>';
                            }
                        $menus .='</ol>';
                    }

                    $menus .='<i style="border-radius:13px; float:right; margin-top:-50px" class=" b fa fa-times-circle"></i></li>';
                }
            }
        }
        return \View::make("backend.menu.index")->with("categories",$cats)
            ->with("pages",$pages)->with("menus",$menus)
            ->with("customs",$custs)
            ->with("menupos",\DB::table("menupos")->get());
    }

    public function postMenuHome(){
        if(isset($_POST['title']) && isset($_POST['id'])){
            if($_POST['id'] =="" && !empty($_POST['id'])){

            }else{
                $id = $_POST['id'];
                $menu = \Menu::find($id);
                $postcheck = \Menu::where("parent_id","=",$id)->get();
                if($postcheck->count()>=1){
                    foreach($postcheck as $sub){
                        $sub->delete();
                    }
                }
                $menu->delete();
                echo "Menu Item Deleted";

            }

            $menupos = \Menupo::find(1);
            $menupos->menu_jsondata = \Input::get("val");
            $menupos->save();
            //echo (property_exists($data[2],"children"));//$data[2]->children);
            if( $menupos->save()){
                echo 1;
            }
            exit;
        }
        $pages  = \DB::table("posts")->where("type","page")->get();
        $data = array();

        $data=( json_decode(\Input::get("val")));
        $jjack = "";
        $mpos = 0;
        foreach($data as $dat){
            $post_id = $dat->post;
            $sort_order = $mpos;
            $menu_type = "mainmenu";
            $title = $dat->title;

            (property_exists($dat,"children")) ? $isparent= 1  : $isparent= 0 ;

            if(property_exists($dat,"id")){
                $menu = \Menu::find($dat->id);
            }else{
                $menu = new \Menu();
            }

            $menu->post_id = $post_id;
            $menu->sort_order = $sort_order;
            $menu->menu_type = $menu_type;
            $menu->title= $title;
            $menu->link = $dat->link;
            $menu->has_child = $isparent;
            $menu->position     = 0;

            $menu->save();
            $jjack .= $menu->id.",";
            if(property_exists($dat,"children")){ //1st level submenu
                $menu_type ="submenu1";
                $mcpos = 0;
                foreach($dat->children as $child1){
                    $post_id = $child1->post;
                    $sort_order = $mcpos;
                    $parent_id = $menu->id;
                    $title = $child1->title;
                    (property_exists($child1,"children")) ? $isparent= 1  : $isparent= 0 ;


                    if(property_exists($child1,"id")){
                        $submenu1               = \Menu::find($child1->id);
                    }else{
                        $submenu1               = new \Menu();
                    }
                    $submenu1->parent_id = $parent_id;
                    $submenu1->menu_type = $menu_type;
                    $submenu1->post_id = $post_id;
                    $submenu1->sort_order = $sort_order;
                    $submenu1->position     = 1;
                    $submenu1->link = $child1->link;
                    $submenu1->has_child     = $isparent;
                    $submenu1->title = $title;
                    $submenu1->save();



                    if(property_exists($submenu1,"children")){ // second level menu
                        $mccpos =0;
                        $menu_type ="submenu2";
                        foreach($submenu1->children as $child2){
                            $post_id                = $child2->id;
                            $title                = $child2->title;
                            $sort_order             = $mccpos;
                            (property_exists($child2,"children")) ? $isparent= 1  : $isparent= 0 ;
                            $parent_id              = $submenu1->id;

                            if(property_exists($child2,"id")){
                                $submenu1               = \Menu::find($child2->id);
                            }else{
                                $submenu1               = new \Menu();
                            }
                            $submenu1->parent_id    = $parent_id;
                            $submenu1->menu_type    = $menu_type;
                            $submenu1->post_id      = $post_id;
                            $submenu1->title        = $title;
                            $submenu1->has_child     = $isparent;
                            $submenu1->position     = 1;
                            $submenu1->link         = $child2->link;
                            $submenu1->sort_order   = $sort_order;

                            $submenu1->save();
                            $mccpos++;
                        }
                    }
                    $mcpos++;
                }
            }
            $mpos++;
        }

        $menupos = (\Menupo::find(1)) ? \Menupo::find(1) : new \Menupo() ;
        $menupos->menu_jsondata = \Input::get("val");
        $menupos->save();
        //echo (property_exists($data[2],"children"));//$data[2]->children);
        if( $menupos->save()){
            echo 1;
        }

        //print_r($pages);
    }


    /*
      |--------------------------------------------------------------------------
      | Start Section to manage slider
      |--------------------------------------------------------------------------
    */

    public function getSlideHome(){
        $sliders  = \DB::table("posts")->where("type","slideshow")->get();

        return \View::make("backend.sliders.index")
            ->with("slideshows",$sliders)
            ->with("slideimages",\Slideshow::all());
    }

    public function postSlideHome($type){
        if(\Request::ajax()){
            if(isset($_POST["action"]) && $_POST["action"] == "delete"){
                $post = \Post::find($_POST["id"]);
                $isparent = \Post::where("parent_id",$post->id);
                if(count($isparent) > 0){
                    echo "You cannot delete this record it is associated with a page or pageblock";

                }else{

                    if($post->delete()){
                        \Session::put("success_message",$post->title. " Succesfully Deleted");
                        if($_POST['type'] == "slideshow"){
                            $image = \Slideshow::where("img_name",$_POST["image"])->first();
                            $image->status =0;
                            $image->update();
                        }
                      echo "record successfully deleted";

                    }else{
                        \Session::put("error_message",$post->title. " Unexpected Error! Record could not be deleted");
                        echo "Unexpected Error! Record could not be deleted";
                    }



                }
            }

            if($type == "slideimage"){
                $ds          = DIRECTORY_SEPARATOR;  //1

                $storeFolder = './uploads/slideshow';   //stores file in slider folder in uploads

                if (!empty($_FILES)) {
                    $tempFile = $_FILES['file']['tmp_name'];          //3
                    $targetPath =$storeFolder . $ds;  //4
                    $targetFile =  $targetPath. $_FILES['file']['name'];  //5
                    if(move_uploaded_file($tempFile,$targetFile)){
                        $image = new \Slideshow();
                        $image->img_name = basename($_FILES['file']['name']);
                        $image->size =$_FILES['file']['size'];
                        $image->save();
                    }
                }
            }
           exit;
        }

        if($type=="slidepost"){ //not longeer function all post route through postAddPage method
            $validation = \Post::validate(\Input::all());
            $input = \Input::all();

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

                $post = new \Post();
                (isset($_POST['description'])) ? $post->description = \Input::get("description") : "";
                $post->title            =   $input['title'];
                $post->p_content        =   $input['p_content'];
                $post->permalink        =   $input['permalink'];
                $post->type             =   $input['type'];
                $post->parent_id        =   $input['parent_id'];
                $post->image            =   isset($_POST['image']) ? $input['image'] :"";
                //$post->view_status      =   $input['view_status'];
                $post->created_by       =   "Admin";
                $post->meta_keyword     =   $input['meta_keyword'];
                $post->meta_description =   $input['meta_description'];
                $post->meta_title       =   $input['meta_title'];
                //$post->image            =   (isset($file) && $file != "") ? $file : "";
                //var_dump($post);
                try {
                    $post = $post->save();

                    // $redirect = (isset($input['form_save'])) ? "backend/{$input['type']}s" : "backend/{$input['type']}s/create";

                    return \Redirect::back()
                        ->with('success_message', 'The ' . $input["type"] . ' was created.');
                } catch(ValidationException $e) {
                    return \Redirect::back()->withInput()->withErrors($e->getErrors());
                }
            }
        }elseif($type == "pageblockimage"){ // this procedure is used to add page block image
            $ds          = DIRECTORY_SEPARATOR;  //1

            $storeFolder = './uploads';   //stores file in slider folder in image

            if (!empty($_FILES)) {
                $tempFile = $_FILES['file']['tmp_name'];          //3
                $targetPath =$storeFolder . $ds;  //4
                $targetFile =  $targetPath. $_FILES['file']['name'];  //5
                if(move_uploaded_file($tempFile,$targetFile)){
                    echo "Image Uploaded";
                    exit;
                }
            }
        }
    }


    /*
      |--------------------------------------------------------------------------
      | Start Section to slide images
      |--------------------------------------------------------------------------
    */
    public function getSlideImages(){
        $sliders  = \DB::table("posts")->where("type","slideshow")->get();

        return \View::make("backend.sliders.manageimages")
            ->with("slideshows",$sliders)
            ->with("slideimages",\Slideshow::all());
    }

    public function postSlideImages($type){
        if($type=="delete"){
           $slideImg = \Slideshow::find($_POST['id']);
            if($slideImg->status == 0){
            if($slideImg->delete()){
                unlink("./uploads/slideshow/".$slideImg->img_name);
                echo "Record Successfully Deleted";
            }else{
                echo "Unexpeted error! Record was not deleted";
            }
            }else{
                echo "This image cannot be deleted. It is already in use by a slide";
            }
        }
    }


    public function getPageBlockIndex(){
        return \View::make("backend.pageblocks.index")->with("blocks",\DB::table("posts")->where("type","page block")->paginate(10))->with("title","All Pages");
    }

    public  function getAddPageBlock(){
        return \View::make("backend.pageblocks.addnew")->with("pages",\Post::where("type","!=","page block")->get());
    }

    public function postAddPageBlock($id=""){
       // $validation = \Post::validate(\Input::all());0041097427
        $input = \Input::all();
        $post ="";

            if($input['action']=="new"){
                $post = new \Post();

            }else if($input['action'] == "update"){
                $post = \Post::find($id);
            }else if($input['action'] == "delete"){
                $post = \Post::find($id);

                $post->delete();
                echo "Pageblock record deleted";

                exit;

            }

            if(isset($_POST['description'])) {
                $str =$_POST['description'];

                if(preg_match("/enter image description here/",$str) || preg_match("/enter image title here/",$str)|| preg_match("/\.bmp/",$str) || preg_match("/\.jpg/",$str) || preg_match("/\.jpeg/",$str) || preg_match("/\.gif/",$str) || preg_match("/\.png/",$str)){
                    $posStart = strpos($str,"(");
                    $posEnds  = strpos($str,")");
                    $httpcontent = substr($str,$posStart,$posEnds-$posStart);
                    $httpimglink = preg_replace(array('/"enter image title here"/',"/\(/"),"",$httpcontent);
                    $imgurl = explode("/",$httpimglink);
                    $imgpost = count($imgurl) -1;

                    $post->image            =   isset($_POST['image'])  ? $input['image'] :$imgurl[$imgpost];
                    $post->description = preg_replace(array("/![enter image description here]/","/\)/"),"",$str);
                    $post->description = \DB::connection()->getPdo()->quote(substr_replace($httpcontent,"",$post->description,strlen($httpcontent)));

                }elseif(preg_match("/linkmr/",$str) && preg_match("/%/",$str)){ // section for block listing
                   // [list text here](http://dsdsdsds.com)
                    //$listarray = explode("-",$str);

                   // echo $str ."<br/>";
                    //print_r($listarray);


                    $post->description = \DB::connection()->getPdo()->quote($str);
                    //print_r($post->description);
                   // exit;
                }else{
                    $post->description = $str;
                }

            }
            $post->title            =   $input['title'];
            if($input['parent_id'] ==""){
                $post->permalink        =   $input['permalink'];
            }
            $position = "";
            $position .= isset($input['home-top']) ?$input['home-top']."," :"";
            $position .= isset($input['home-bottom']) ?$input['home-bottom']."," :"";
            $position .= isset($input['inner-top']) ?$input['inner-top']."," :"";
            $position .= isset($input['inner-bottom']) ?$input['inner-bottom']."," :"";
            $position .= isset($input['sidebar-top']) ?$input['sidebar-top']."," :"";
            $position .= isset($input['sidebar-bottom']) ?$input['sidebar-bottom']."," :"";
            $position .= isset($input['footer']) ?$input['footer']."," :"";
            $post->post_meta        =   $position;
            $post->type             =   $input['type'];
            $post->parent_id        =   $input['parent_id'];

            //$post->view_status      =   $input['view_status'];
            $post->created_by       =   "Admin";



            try{
                $post->save();
                if($input['action']=='update'){
                    \Session::put("success_message","Pageblock record updated");
                    return \Redirect::back();
                }elseif($input['action']=='new'){
                    \Session::put("success_message","New pageblock record added successfully");
                    return \Redirect::back();
                }elseif($input['action']=='delete'){
                    \Session::put("success_message",$post->title." Record deleted");
                    return \Redirect::back();
                }


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

    public function getEditPageBlock($id){
        return \View::make("backend.pageblocks.editpage")
            ->with("mypage",\Post::find($id))
            ->with("pages",\DB::table("posts")->where("type","!=","page block")->get())->with("page_title","All Pageblocks")->with("title","Edit Page");
            //->with("menus",\DB::table("menus")->where)
    }

    public function getSettings(){
        return \View::make("backend.settings")->with("page_title","Settings")->with("settings",\DB::table("settings")->orderBy("name","asc")->paginate(10));
    }

    public function postSettings(){
        $input = \Input::all();

        if(\Request::ajax()){
            if($_POST['action'] == "update"){
                array_forget($input,"action");

                $setting = \Setting::find($input['id']);
                foreach($input as $key=>$value){
                    $setting->$key = $value;
                }

                if($setting->update){
                    echo "Setting Successfully Updated";
                }
            }
        }
    }


}


/** Define a Read Filter class implementing PHPExcel_Reader_IReadFilter */
///class MyReadFilter implements PHPExcel_Reader_IReadFilter {
   /// public function readCell($column, $row, $worksheetName = 'Data Sheet #1'){
    // Read rows 1 to 7 and columns A to E only
       /// if ($row >= 1 && $row <= 10000) {
          /// if (in_array($column,range('A','P'))) {
               /// return true;
           /// }
       /// } return false;
   /// }
///}


/** Define a Read Filter class implementing PHPExcel_Reader_IReadFilter
class MyReadFilter implements PHPExcel_Reader_IReadFilter {
    private $_startRow = 0;
    private $_endRow = 0;
    private $_columns = array();*/
    /** Get the list of rows and columns to read
    public function __construct($startRow, $endRow, $columns) {
        $this->_startRow = $startRow;
        $this->_endRow = $endRow;
        $this->_columns = $columns;
    }


    public function readCell($column, $row, $worksheetName = '') {
    // Only read the rows and columns that were configured
        if ($row >= $this->_startRow && $row <= $this->_endRow) {
            if (in_array($column,$this->_columns)) {
                return true;
            }
        } return false;
    }
}*/
    /** Create an Instance of our Read Filter, passing in the cell range **/



// NOTE! This duplicate key exception check uses MySQL codes so might not work with other DB's
// Check other DB's codes to get this to work.
function is_duplicate_key_exception (\Laravel\Database\Exception $e)
{
    Log::debug("(\$e=$e)");
    $duplicate = false;
    $entry      = $key = null;
    $inner      = $e->getInner();
    $info       = $inner->errorInfo;

    // Check if mysql error is for a duplicate key
    if (in_array($info[1], array(1062, 1022, 1558))) {
        $duplicate = true;
        preg_match("/'(.*)'.*'(.*)'/", $info[2], $matches);
        $entry = $matches[1];
        $key = $matches[2];
    }

    $ret = array($duplicate, $entry, $key, 'is_duplcate_key' => $duplicate, 'duplicate_entry' => $entry, 'for_key' => $key);

    Log::debug("Returning duplicate key details: " . json_encode($ret));
    return $ret;
}