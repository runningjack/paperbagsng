<?php
/**
 * Created by PhpStorm.
 * User: Amedora
 * Date: 3/12/15
 * Time: 11:17 AM
 */
namespace Backend;
class CatalogueController extends BackendController {
    public function getCategoryIndex(){
        return \View::make("backend.pcategory.index")->with("p_title","Category")->with("subtitle",">Listing")
            ->with("categories",\DB::table("categories")->get());
    }

    public function getCategoryAddNew($id=""){
        if(\Request::ajax()){
            if(isset($_GET['input'])){
                $officers = \DB::table("categories")->where("title","LIKE","%".$_GET['input']."%")->get();//find("SELECT * FROM customers WHERE fname LIKE '%".$clientname."%'" );
                //print_r($officers);
                if($officers){
                    $outpt = "<ul id='mySearch'>";
                    foreach($officers as $pep){
                        $outpt .= "<li>";
                        $outpt .=" <div style='width:25%; float:left;z-index:1300' class='divvid' dress='' vid='$pep->id'> $pep->id </div><div  class='sch' style=' margin:.2em;width:70%; float:left; text-align:left; padding-left:5%'>".$pep->title."</div></H6> </li><div style='clear:both'></div>";
                    }
                    $outpt .= "</ul>";

                    echo $outpt;
                }
            }

            exit;
        }
        return \View::make("backend.pcategory.addnew")->with("p_title","Category")->with("subtitle","> Add New")
            ->with("categories",\DB::table("categories")->get());
    }

    public  function postCategoryAddNew($id=""){
        if(\Request::ajax()){
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
            ############ Configuration ##############
            $thumb_square_size 		= 200; //Thumbnails will be cropped to 200x200 pixels
            $max_image_size 		= 500; //Maximum image size (height and width)
            $thumb_prefix			= "thumb_"; //Normal thumb Prefix

            if(public_path()){
                $destination_folder		= public_path()."/uploads/images/"; //upload directory ends with / (slash)
                $image_invention_folder = public_path()."/uploads/images/";
            }else{
                $image_invention_folder = '/home/medicalng/public_html/uploads/images/';
                $destination_folder = '/home/medicalng/public_html/uploads/images/';
            }

            //$file =
            $jpeg_quality 			= 90; //jpeg quality
            ##########################################
            //continue only if $_POST is set and it is a Ajax request
            if(isset($_POST) && isset($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest'){
                // check $_FILES['ImageFile'] not empty
                if(!isset($_FILES['image_file']) || !is_uploaded_file($_FILES['image_file']['tmp_name'])){
                    die('Image file is Missing!'); // output error when above checks fail.
                    exit;
                }
                //uploaded file info we need to proceed
                $image_name = $_FILES['image_file']['name']; //file name
                $image_size = $_FILES['image_file']['size']; //file size
                $image_temp = $_FILES['image_file']['tmp_name']; //file temp
                $image_size_info 	= getimagesize($image_temp); //get image size

                if($image_size_info){
                    $image_width 		= $image_size_info[0]; //image width
                    $image_height 		= $image_size_info[1]; //image height
                    $image_type 		= $image_size_info['mime']; //image type
                }else{
                    die("Make sure image file is valid!");
                }

                //switch statement below checks allowed image type
                //as well as creates new image from given file
                switch($image_type){
                    case 'image/png':
                        $image_res =  imagecreatefrompng($image_temp); break;

                    case 'image/gif':
                        $image_res =  imagecreatefromgif($image_temp); break;
                    case 'image/jpeg': case 'image/pjpeg':
                    $image_res = imagecreatefromjpeg($image_temp); break;
                    default:
                        $image_res = false;
                }

                if($image_res){
                    //Get file extension and name to construct new file name
                    $image_info = pathinfo($image_name);
                    $image_extension = strtolower($image_info["extension"]); //image extension
                    $image_name_only = strtolower($image_info["filename"]);//file name only, no extension

                    //create a random name for new image (Eg: fileName_293749.jpg) ;
                    $mrand =rand(0, 9999999999);
                    $new_file_name = $image_name_only. '_' .  $mrand . '.' . $image_extension;

                    //folder path to save resized images and thumbnails
                    //$thumb_save_folder 	= $destination_folder . $thumb_prefix . $new_file_name;
                    $image_save_folder 	= $destination_folder . $new_file_name;

                    //call normal_resize_image() function to proportionally resize image
                    if(normal_resize_image($image_res, $image_save_folder, $image_type, $max_image_size, $image_width, $image_height, $jpeg_quality))
                    {

                        $img1 = \Image::make($image_invention_folder . $new_file_name);
                        $img1->resize(100,100);
                        $imageNewNameten = $image_name_only. '_' .$mrand."-100x100".".".$image_extension;
                        $img1->save($image_invention_folder."thumbs/".$imageNewNameten);


                        $img2 = \Image::make($image_invention_folder . $new_file_name);
                        $img2->resize(50,50);
                        $imageNewNameten = $image_name_only. '_' .$mrand."-50x50".".".$image_extension;
                        $img2->save($image_invention_folder."thumbs/".$imageNewNameten);
                        /* We have succesfully resized and created thumbnail image
                        We can now output image to user's browser or store information in the database.$destination_folder*/
                        echo '<div align="center">';

                        echo '<img src="'.url().'/uploads/images/' .$new_file_name.'" alt="Resized Image">';
                        echo '</div>@@'.$new_file_name;
                    }

                    imagedestroy($image_res); //freeup memory
                }
            }

            exit;
        }

        $validation = \Category::validate(\Input::all());
        $input = \Input::all();
        //print_r($input);
        if($validation->fails()){
            return \Redirect::back()->withErrors($validation)->withInput();
        }else{

            $parent_name = $input['parent_name'];
            array_forget($input,"parent_name");
            array_forget($input,"_token");
            try{
                if($id ==""){
                    $officer  = new  \Category();

                    foreach($input as $key=>$value){
                        $officer->$key = $value ;
                    }
                    if($officer->save()){
                        \Session::put("success_message","Record Saved");
                        return \Redirect::back();
                    }else{
                        \Session::put("error_message","Sorry, Unexpected Error! Record Could Not Be Saved");
                        return \Redirect::back();
                    }
                }else{
                    $officer  =  \Category::find($id);
                    $image = ($input['image']=="") ? $input['oldimage'] : $input['image'];
                    array_forget($input,"oldimage");
                    foreach($input as $key=>$value){
                        $officer->$key = $value ;
                    }
                    $officer->image = $image;
                    if($officer->update()){
                        \Session::put("success_message","Record Updated");
                        return \Redirect::back();
                    }else{
                        \Session::put("error_message","Sorry, Unexpected Error! Record Could Not Be Saved");
                        return \Redirect::back();
                    }
                }
            }catch(ValidationException $e) {
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

    public function getCategoryEdit($id=""){
        if(\Request::ajax()){
            if(isset($_GET['input'])){
                $officers = \DB::table("categories")->where("title","LIKE","%".$_GET['input']."%")->get();//find("SELECT * FROM customers WHERE fname LIKE '%".$clientname."%'" );
                //print_r($officers);
                if($officers){
                    $outpt = "<ul id='mySearch'>";
                    foreach($officers as $pep){
                        $outpt .= "<li>";
                        $outpt .=" <div style='width:25%; float:left;z-index:1300' class='divvid' dress='' vid='$pep->id'> $pep->id </div><div  class='sch' style=' margin:.2em;width:70%; float:left; text-align:left; padding-left:5%'>".$pep->title."</div></H6> </li><div style='clear:both'></div>";
                    }
                    $outpt .= "</ul>";

                    echo $outpt;
                }


            }

            exit;
        }
        return \View::make("backend.pcategory.edit")->with("p_title","Category Edit Page")->with("subtitle","")
            ->with("mycategory",\Category::find($id))
            ->with("categories",\DB::table("categories")->get());
    }

    public function getProductIndex(){
        return \View::make("backend.products.index")->with("p_title","Product")->with("subtitle","> Listing")
            ->with("products",\DB::table("products")->get());
    }

    public function getProductAddNew($id=""){
        if(\Request::ajax()){
            if(isset($_GET['input'])){
                $officers = \DB::table("categories")->where("title","LIKE","%".$_GET['input']."%")->get();//find("SELECT * FROM customers WHERE fname LIKE '%".$clientname."%'" );
                //print_r($officers);
                if($officers){
                    $outpt = "<ul id='mySearch'>";
                    foreach($officers as $pep){
                        $outpt .= "<li>";
                        $outpt .=" <div style='width:25%; float:left;z-index:1300' class='divvid' dress='' vid='$pep->id'> $pep->id </div><div  class='sch' style=' margin:.2em;width:70%; float:left; text-align:left; padding-left:5%'>".$pep->title."</div></H6> </li><div style='clear:both'></div>";
                    }
                    $outpt .= "</ul>";

                    echo $outpt;
                }
            }

            if(isset($_GET['optionvalues'])){
                $options = \DB::table("options_values")->where("title","=",$_GET['optionvalues'])->get();
                $outpt ="";
                foreach($options as $option){

                    $outpt.="<option value='".$option->id."'>$option->optvalue</option>";
                }

                echo $outpt;
            }

            exit;
        }
        return \View::make("backend.products.addnew")->with("p_title","Products")->with("subtitle","> Add New")
            ->with("brands",\DB::table("brands")->get())
            ->with("options",\DB::table("options_values")->groupBy("title")->get())
            ->with("categories",\DB::table("categories")->get());
    }

    public function postProductEdit($id=""){
        if(\Request::ajax()){

            if(isset($_POST['options'])){

                $options = \DB::table("options_values")->where("title","like","%".$_POST['options']."%")->get();
                $autoComplete = "";
                $autoComplete .="<ul style='list-style: none; margin: 0'>";
                foreach($options as $option){
                    $autoComplete .="<li>$option->title</li>";
                }
                $autoComplete .="</ul>";
                echo $autoComplete;
                exit;
            }
        }
    }

    public function postProductAddNew($id=""){
        if(\Request::ajax()){
            if(isset($_POST['options'])){

                $options = \DB::table("options_values")->where("title","like","%".$_POST['options']."%")->get();
                $autoComplete = "";
                $autoComplete .="<ul style='list-style: none; margin: 0'>";
                foreach($options as $option){
                    $autoComplete .="<li>$option->title</li>";
                }
                $autoComplete .="</ul>";
                echo $autoComplete;
                exit;
            }

            ############ Configuration ##############
            $thumb_square_size 		= 200; //Thumbnails will be cropped to 200x200 pixels
            $max_image_size 		= 500; //Maximum image size (height and width)
            $thumb_prefix			= "thumb_"; //Normal thumb Prefix
            if(public_path()){
                $destination_folder		= public_path()."/uploads/images/"; //upload directory ends with / (slash)
                $image_invention_folder = public_path()."/uploads/images/";
            }else{
                $image_invention_folder = '/home/medicalng/public_html/uploads/images/';
                $destination_folder = '/home/medicalng/public_html/uploads/images/';
            }

            //$file =
            $jpeg_quality 			= 90; //jpeg quality
            ##########################################
            //continue only if $_POST is set and it is a Ajax request
            if(isset($_POST) && isset($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest'){
                // check $_FILES['ImageFile'] not empty
                if(!isset($_FILES['image_file']) || !is_uploaded_file($_FILES['image_file']['tmp_name'])){
                    die('Image file is Missing!'); // output error when above checks fail.
                    exit;
                }
                //uploaded file info we need to proceed
                $image_name = $_FILES['image_file']['name']; //file name
                $image_size = $_FILES['image_file']['size']; //file size
                $image_temp = $_FILES['image_file']['tmp_name']; //file temp
                $image_size_info 	= getimagesize($image_temp); //get image size

                if($image_size_info){
                    $image_width 		= $image_size_info[0]; //image width
                    $image_height 		= $image_size_info[1]; //image height
                    $image_type 		= $image_size_info['mime']; //image type
                }else{
                    die("Make sure image file is valid!");
                }

                //switch statement below checks allowed image type
                //as well as creates new image from given file
                switch($image_type){
                    case 'image/png':
                        $image_res =  imagecreatefrompng($image_temp); break;
                    case 'image/gif':
                        $image_res =  imagecreatefromgif($image_temp); break;
                    case 'image/jpeg': case 'image/pjpeg':
                    $image_res = imagecreatefromjpeg($image_temp); break;
                    default:
                        $image_res = false;
                }

                if($image_res){
                    //Get file extension and name to construct new file name
                    $image_info = pathinfo($image_name);
                    $image_extension = strtolower($image_info["extension"]); //image extension
                    $image_name_only = strtolower($image_info["filename"]);//file name only, no extension

                    //create a random name for new image (Eg: fileName_293749.jpg) ;
                    $mrand =rand(0, 9999999999);
                    $new_file_name = $image_name_only. '_' .  $mrand . '.' . $image_extension;

                    //folder path to save resized images and thumbnails
                    //$thumb_save_folder 	= $destination_folder . $thumb_prefix . $new_file_name;
                    $image_save_folder 	= $destination_folder . $new_file_name;

                    //call normal_resize_image() function to proportionally resize image
                    if(normal_resize_image($image_res, $image_save_folder, $image_type, $max_image_size, $image_width, $image_height, $jpeg_quality))
                    {

                        $img1 = \Image::make($image_invention_folder . $new_file_name);
                        $img1->resize(262,311);
                        $imageNewNameten = $image_name_only. '_' .$mrand."-262x311".".".$image_extension;
                        $img1->save($image_invention_folder."thumbs/".$imageNewNameten);

                        $img3 = \Image::make($image_invention_folder . $new_file_name);
                        $img3->resize(100,100);
                        $imageNewNameten = $image_name_only. '_' .$mrand."-100x100".".".$image_extension;
                        $img3->save($image_invention_folder."thumbs/".$imageNewNameten);

                        $img3 = \Image::make($image_invention_folder . $new_file_name);
                        $img3->resize(50,80);
                        $imageNewNameten = $image_name_only. '_' .$mrand."-50x80".".".$image_extension;
                        $img3->save($image_invention_folder.$imageNewNameten);


                        $img2 = \Image::make($image_invention_folder . $new_file_name);
                        $img2->resize(50,50);
                        $imageNewNameten = $image_name_only. '_' .$mrand."-50x50".".".$image_extension;
                        $img2->save($image_invention_folder."thumbs/".$imageNewNameten);
                        /* We have succesfully resized and created thumbnail image
                        We can now output image to user's browser or store information in the database.$destination_folder */
                        echo '<div align="center">';

                        echo '<img src="'.url().'/uploads/images/'.$new_file_name.'" alt="Resized Image">';
                        echo '</div>@@'.$new_file_name;
                    }

                    imagedestroy($image_res); //freeup memory
                }
            }

            exit;
        }

        $validation = \Product::validate(\Input::all());
        $input = \Input::all();
        //print_r($input);
        if(isset($input['product_option'])){
            $data['product_option'] = $input['product_option'];
        }

        if($validation->fails()){
            return \Redirect::back()->withErrors($validation)->withInput();
        }else{

            $parent_name = $input['parent_name'];
            $categories = $input['cat'];
            array_forget($input,"parent_name");
            array_forget($input,"_token");
            array_forget($input,"parent_id");
            array_forget($input,"cat");
           // $data = $input['product_option'];
            array_forget($input,"product_option");
            $image = ($input['image']=="") ? $input['oldimage'] : $input['image'];
            array_forget($input,"oldimage");
            try{
                if($id ==""){
                    $product  = new  \Product();
                    foreach($input as $key=>$value){
                        if($key != 'product_option'){
                            $product->$key = $value ;
                        }
                    }
                    if($product->save()){
                        $cats = explode(",",$categories);
                        foreach($cats as $cat){
                            if($cat !=""){
                                $cid = \DB::table('categories')->where('title',$cat)->pluck('id');

                                \DB::table('categories_products')->insert(
                                    ['category_id' => $cid, 'product_id' => $product->id]
                                );
                            }
                        }

                        if (!empty($data['product_option']) && isset($data['product_option'])) {
                            $x=0;
                            foreach ($data['product_option'] as $product_option) {
                                // if ($product_option['product_option_value'][$x]['type'] == 'volume' || $product_option['product_option_value'][$x]['type'] == 'size' || $product_option['product_option_value'][$x]['type'] == 'select' || $product_option['product_option_value'][$x]['type'] == 'radio' || $product_option['product_option_value'][$x]['type'] == 'checkbox' || $product_option['product_option_value'][$x]['type'] == 'image') {
                                if (isset($product_option['product_option_value']) && count($product_option['product_option_value']) > 0 ) {
                                    foreach ($product_option['product_option_value'] as $product_option_value) {
                                        $option_value_id = (int)$product_option_value['option_value_id'];
                                        $quantity = (int)$product_option_value['quantity'];
                                        $price = $product_option_value['price'];
                                        $weight = $product_option_value['weight'];
                                        $weight_prefix = $product_option_value['weight_prefix'];
                                        $points_prefix = $product_option_value['points_prefix'];
                                        $price_prefix = $product_option_value['price_prefix'];
                                        $option_type = $product_option_value['option_type'];
                                        $points =$product_option_value['points'];
                                        $product_option_value_id = $product_option_value['product_option_value_id'];

                                        $objOptionValue = \Optionvalue::find($option_value_id);
                                        $option_value = $objOptionValue->optvalue;
                                        $option_id =$objOptionValue->option_id;

                                        \DB::table('products_options')->insert(
                                            ['product_id' => $product->id,'option_type'=>$option_type,'option_value_id' => $option_value_id,'option_value'=>$option_value,'option_id'=>$option_id, 'quantity'=>$quantity,'price'=>$price,'price_prefix'=>$price_prefix,'weight'=>$weight,'weight_prefix'=>$weight_prefix,'points'=>$points,'points_prefix'=>$points_prefix ]
                                        );


                                    }
                                }else{
                                    //DB::table('products_options')->where('product_option_value_id', '=',$product_option_value_id)->delete();
                                    // $this->db->query("DELETE FROM " . DB_PREFIX . "product_option WHERE product_option_id = '".$product_option_id."'");
                                }
                                //}
                                $x++;
                            }
                        }


                        \Session::put("success_message","Record Saved");
                        return \Redirect::back();
                    }else{
                        \Session::put("error_message","Sorry, Unexpected Error! Record Could Not Be Saved");
                        return \Redirect::back();
                    }
                }else{
                    $product  =  \Product::find($id);

                    array_forget($input,"_token");
                    foreach($input as $key=>$value){
                        $product->$key = $value ;
                    }
                    $product->image = $image;
                    if($product->update()){


                        if (!empty($data['product_option'])) {
                            $opt= \Productoptions::where("product_id",$product->id)->get();
                            if($opt){
                                \DB::table('products_options')->where('product_id', '=',$product->id)->delete();
                            }
                            $x=0;
                            foreach ($data['product_option'] as $product_option) {


                               // if ($product_option['product_option_value'][$x]['type'] == 'volume' || $product_option['product_option_value'][$x]['type'] == 'size' || $product_option['product_option_value'][$x]['type'] == 'select' || $product_option['product_option_value'][$x]['type'] == 'radio' || $product_option['product_option_value'][$x]['type'] == 'checkbox' || $product_option['product_option_value'][$x]['type'] == 'image') {
                                if (isset($product_option['product_option_value']) && count($product_option['product_option_value']) > 0 ) {
                                    foreach ($product_option['product_option_value'] as $product_option_value) {
                                        $option_value_id = (int)$product_option_value['option_value_id'];
                                        $quantity = (int)$product_option_value['quantity'];
                                        $price = $product_option_value['price'];
                                        $weight = $product_option_value['weight'];
                                        $option_type = $product_option_value['option_type'];
                                        $weight_prefix = $product_option_value['weight_prefix'];
                                        $points_prefix = $product_option_value['points_prefix'];
                                        $price_prefix = $product_option_value['price_prefix'];
                                        $points =$product_option_value['points'];
                                        $product_option_value_id = $product_option_value['product_option_value_id'];
                                        $objOptionValue = \Optionvalue::find($option_value_id);
                                        $option_value = $objOptionValue->optvalue;
                                        $option_id =$objOptionValue->option_id;


                                        \DB::table('products_options')->insert(
                                            ['product_id' => $product->id,'option_type'=>$option_type,'option_value_id' => $option_value_id,'option_value'=>$option_value,'option_id'=>$option_id, 'quantity'=>$quantity,'price'=>$price,'price_prefix'=>$price_prefix,'weight'=>$weight,'weight_prefix'=>$weight_prefix,'points'=>$points,'points_prefix'=>$points_prefix ]
                                        );

                                    }
                                }else{
                                    $opt= \Productoptions::where("product_id",$product->id)->get();
                                    if($opt){
                                        \DB::table('products_options')->where('product_id', '=',$product->id)->delete();
                                    }
                                }
                            //}
                                $x++;
                            }
                        }
                        \Session::put("success_message","Record Updated");
                        return \Redirect::back();
                    }else{
                        \Session::put("error_message","Sorry, Unexpected Error! Record Could Not Be Saved");
                        return \Redirect::back();
                    }
                }
            }catch(ValidationException $e) {
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


    public function getProductEdit($id=""){
        if(\Request::ajax()){

            if(isset($_GET['input'])){
                $officers = \DB::table("categories")->where("title","LIKE","%".$_GET['input']."%")->get();//find("SELECT * FROM customers WHERE fname LIKE '%".$clientname."%'" );
                //print_r($officers);
                if($officers){
                    $outpt = "<ul id='mySearch'>";
                    foreach($officers as $pep){
                        $outpt .= "<li>";
                        $outpt .=" <div style='width:25%; float:left;z-index:1300' class='divvid' dress='' vid='$pep->id'> $pep->id </div><div  class='sch' style=' margin:.2em;width:70%; float:left; text-align:left; padding-left:5%'>".$pep->title."</div></H6> </li><div style='clear:both'></div>";
                    }
                    $outpt .= "</ul>";

                    echo $outpt;
                }
            }

            if(isset($_GET['optionvalues'])){
                $options = \DB::table("options_values")->where("title","=",$_GET['optionvalues'])->get();
                $outpt ="";
                foreach($options as $option){

                    $outpt.="<option value='".$option->id."'>$option->optvalue</option>";
                }

                echo $outpt;
            }
            $file = "./uploads/images/";
            exit;
        }
        return \View::make("backend.products.edit")->with("p_title","Products")->with("page_title","Products")->with("subtitle","> Edit")
            ->with("brands",\DB::table("brands")->get())
            ->with("options",\DB::table("options_values")->groupBy("title")->get())
            ->with("myoptionvalues",\DB::table("products_options")->where("product_id",$id)->groupBy("option_type")->get())
            //->with("nogroupsoptionvalues",\DB::table("products_options")->where("product_id",$id))->get())
            ->with("myproduct",\Product::find($id));
    }

    //public function postProduct

    public function getBrandIndex(){
        return \View::make("backend.brands.index")->with("p_title","Brands")->with("subtitle",">Listing")
            ->with("brands",\DB::table("brands")->get());
    }

    public function getBrandAddNew($id=""){
        return \View::make("backend.brands.addnew")->with("p_title","Brands ")->with("subtitle",">Add New")
            ->with("brands",\DB::table("brands")->get());
    }


    public function postBrandAddNew($id=""){
        if(\Request::ajax()){
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

            ############ Configuration ##############
            $thumb_square_size 		= 200; //Thumbnails will be cropped to 200x200 pixels
            $max_image_size 		= 500; //Maximum image size (height and width)
            $thumb_prefix			= "thumb_"; //Normal thumb Prefix
            $destination_folder		= "./uploads/images/"; //upload directory ends with / (slash)
            //$file =
            $jpeg_quality 			= 90; //jpeg quality
            ##########################################
            //continue only if $_POST is set and it is a Ajax request
            if(isset($_POST) && isset($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest'){
                // check $_FILES['ImageFile'] not empty
                if(!isset($_FILES['image_file']) || !is_uploaded_file($_FILES['image_file']['tmp_name'])){
                    die('Image file is Missing!'); // output error when above checks fail.
                    exit;
                }
                //uploaded file info we need to proceed
                $image_name = $_FILES['image_file']['name']; //file name
                $image_size = $_FILES['image_file']['size']; //file size
                $image_temp = $_FILES['image_file']['tmp_name']; //file temp
                $image_size_info 	= getimagesize($image_temp); //get image size

                if($image_size_info){
                    $image_width 		= $image_size_info[0]; //image width
                    $image_height 		= $image_size_info[1]; //image height
                    $image_type 		= $image_size_info['mime']; //image type
                }else{
                    die("Make sure image file is valid!");
                }

                //switch statement below checks allowed image type
                //as well as creates new image from given file
                switch($image_type){
                    case 'image/png':
                        $image_res =  imagecreatefrompng($image_temp); break;
                    case 'image/gif':
                        $image_res =  imagecreatefromgif($image_temp); break;
                    case 'image/jpeg': case 'image/pjpeg':
                    $image_res = imagecreatefromjpeg($image_temp); break;
                    default:
                        $image_res = false;
                }

                if($image_res){
                    //Get file extension and name to construct new file name
                    $image_info = pathinfo($image_name);
                    $image_extension = strtolower($image_info["extension"]); //image extension
                    $image_name_only = strtolower($image_info["filename"]);//file name only, no extension

                    //create a random name for new image (Eg: fileName_293749.jpg) ;
                    $new_file_name = $image_name_only. '_' .  rand(0, 9999999999) . '.' . $image_extension;

                    //folder path to save resized images and thumbnails
                    $thumb_save_folder 	= $destination_folder . $thumb_prefix . $new_file_name;
                    $image_save_folder 	= $destination_folder . $new_file_name;

                    //call normal_resize_image() function to proportionally resize image
                    if(normal_resize_image($image_res, $image_save_folder, $image_type, $max_image_size, $image_width, $image_height, $jpeg_quality))
                    {
                        //call crop_image_square() function to create square thumbnails

                        // if(!crop_image_square($image_res, $thumb_save_folder, $image_type, $thumb_square_size, $image_width, $image_height, $jpeg_quality))
                        //{
                        //    die('Error Creating thumbnail');
                        // }

                        /* We have succesfully resized and created thumbnail image
                        We can now output image to user's browser or store information in the database*/
                        echo '<div align="center">';
                        // echo '<img src="/melkay/public/uploads/images/'.$thumb_prefix . $new_file_name.'" alt="Thumbnail">';
                        echo '<br />';
                        echo '<img src="/melkay/public/uploads/images/'.$new_file_name.'" alt="Resized Image">';
                        echo '</div>@@'.$new_file_name;
                    }

                    imagedestroy($image_res); //freeup memory
                }
            }

            exit;
        }

        $validation = \Brand::validate(\Input::all());
        $input = \Input::all();
        //print_r($input);
        if($validation->fails()){
            return \Redirect::back()->withErrors($validation)->withInput();
        }else{

            array_forget($input,"_token");

            try{
                if($id ==""){
                    $brand  = new  \Brand();

                    foreach($input as $key=>$value){
                        $brand->$key = $value ;
                    }
                    if($brand->save()){

                        \Session::put("success_message","Record Saved");
                        return \Redirect::back();
                    }else{
                        \Session::put("error_message","Sorry, Unexpected Error! Record Could Not Be Saved");
                        return \Redirect::back();
                    }
                }else{
                    $brand  =  \Brand::find($id);

                    array_forget($input,"_token");
                    foreach($input as $key=>$value){
                        $brand->$key = $value ;
                    }
                    if($brand->update()){
                        \Session::put("success_message","Record Updated");
                        return \Redirect::back();
                    }else{
                        \Session::put("error_message","Sorry, Unexpected Error! Record Could Not Be Saved");
                        return \Redirect::back();
                    }
                }
            }catch(ValidationException $e) {
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

    public function getBrandEdit($id=""){
        return \View::make("backend.brands.edit")->with("p_title","Brands ")->with("subtitle",">Edit")
            ->with("mybrand",\Brand::find($id));
    }


    public function getOptionIndex(){
        return \View::make("backend.options.index")->with("p_title","Product Option ")->with("subtitle",">Listing")
            ->with("options",\DB::table("options_values")->get());
    }

    public function getOptionAddNew($id=""){
        return \View::make("backend.options.addnew")->with("p_title","Product Option ")->with("subtitle",">Addnew")
            ->with("options",\DB::table("options")->get());
    }

    public function getOptionEdit($id=""){

    }

    public function postOptionAddNew($id=""){
        if(\Request::ajax()){
            if(($_POST['action']=="saveoption")){
                //echo "all good";
                $option =  new \Optionvalue();
                $option->option_id      = $_POST['optionid'];
                $option->title          = $_POST['title'];
                $option->optvalue       = $_POST['optvalue'];

                $option->save();
            }
        }
    }
}


#####  This function will proportionally resize image #####
function normal_resize_image($source, $destination, $image_type, $max_size, $image_width, $image_height, $quality){

    if($image_width <= 0 || $image_height <= 0){return false;} //return false if nothing to resize

    //do not resize if image is smaller than max size
    if($image_width <= $max_size && $image_height <= $max_size){
        if(save_image($source, $destination, $image_type, $quality)){
            return true;
        }
    }

    //Construct a proportional size of new image
    $image_scale	= min($max_size/$image_width, $max_size/$image_height);
    $new_width		= ceil($image_scale * $image_width);
    $new_height		= ceil($image_scale * $image_height);

    $new_canvas		= imagecreatetruecolor( $new_width, $new_height ); //Create a new true color image

    //Copy and resize part of an image with resampling
    if(imagecopyresampled($new_canvas, $source, 0, 0, 0, 0, $new_width, $new_height, $image_width, $image_height)){
        save_image($new_canvas, $destination, $image_type, $quality); //save resized image
    }

    return true;
}

##### This function corps image to create exact square, no matter what its original size! ######
function crop_image_square($source, $destination, $image_type, $square_size, $image_width, $image_height, $quality){
    if($image_width <= 0 || $image_height <= 0){return false;} //return false if nothing to resize

    if( $image_width > $image_height )
    {
        $y_offset = 0;
        $x_offset = ($image_width - $image_height) / 2;
        $s_size 	= $image_width - ($x_offset * 2);
    }else{
        $x_offset = 0;
        $y_offset = ($image_height - $image_width) / 2;
        $s_size = $image_height - ($y_offset * 2);
    }
    $new_canvas	= imagecreatetruecolor( $square_size, $square_size); //Create a new true color image

    //Copy and resize part of an image with resampling
    if(imagecopyresampled($new_canvas, $source, 0, 0, $x_offset, $y_offset, $square_size, $square_size, $s_size, $s_size)){
        save_image($new_canvas, $destination, $image_type, $quality);
    }

    return true;
}
##### Saves image resource to file #####
function save_image($source, $destination, $image_type, $quality){
    switch(strtolower($image_type)){//determine mime type
        case 'image/png':
            imagepng($source, $destination); return true; //save png file
            break;
        case 'image/gif':
            imagegif($source, $destination); return true; //save gif file
            break;
        case 'image/jpeg': case 'image/pjpeg':
        imagejpeg($source, $destination, $quality); return true; //save jpeg file
        break;
        default: return false;
    }
}