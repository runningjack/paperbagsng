<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/',"HomeController@index");
Route::get('aboutus',"HomeController@getAboutus");
Route::get("orderform/{bagtype?}","HomeController@getOrderForm");
Route::post("orderform/{bagtype?}","HomeController@postOrderForm");
Route::get("register","RegistrationController@getRegistration");
Route::post("register","RegistrationController@postRegistration");
Route::get("pages/{permalink?}","HomeController@getPages");


Route::group(array('prefix' => 'backend'), function() {


    Route::any('/', 'Backend\HomeController@getIndex');
    Route::get('dashboard/index', array("as"=>"dashboard", "uses"=>'Backend\HomeController@getIndex'));
    Route::get('pages/index',array("as"=>"pageslisting",'uses'=>'Backend\PagesController@getPagesList'));
    Route::get('pages/addnew/{type?}',array('as'=>'addnewpage','uses'=>'Backend\PagesController@getAddPage'));
    Route::post('pages/addnew/{type?}',array('as'=>'adnewpage','uses'=>'Backend\PagesController@postAddPage'));


    Route::get('categories/index',array('as'=>'listcat','uses'=>'Backend\HomeController@getCategoriesIndex'));
    Route::post('categories/addnew',array('as'=>'addnew','uses'=>'Backend\HomeController@PostCategory'));


    Route::get('pages/editpage/{id}',array('as'=>'editpage','uses'=>'Backend\HomeController@getEditPage'));
    Route::post('pages/editpage/{id}',array('as'=>'editpage','uses'=>'Backend\HomeController@postEditPage'));
    Route::get('posts/index',array("as"=>"postslisting",'uses'=>'Backend\HomeController@getPostsList'));
    Route::get('posts/addnew', array('as'=>'addnewpost','uses'=>'Backend\HomeController@getAddPost'));
    Route::post('posts/addnew/{type?}', array('as'=>'adnewpost','uses'=>'Backend\HomeController@postAddPage'));
    Route::get('post/editpost/{id}',array('as'=>'editpost','uses'=>'Backend\HomeController@getEditPost'));
    Route::post('post/editpost/{id}',array('as'=>'editpostp','uses'=>'Backend\HomeController@postEditPage'));
    Route::get("menu/index",array("as"=>"menuhome","uses"=>"Backend\HomeController@getMenuHome"));
    Route::post("menu/index",array("as"=>"index","uses"=>'Backend\HomeController@postMenuHome'));

    Route::get("sliders/index",array("as"=>"slidehome","uses"=>"Backend\HomeController@getSlideHome"));
    Route::post("sliders/index/{type?}",array("as"=>"slidehome2","uses"=>"Backend\HomeController@postSlideHome"));


    Route::get("sliders/manageimages", array("as"=>'mimage', "uses"=>"Backend\HomeController@getSlideImages"));
    Route::post("sliders/manageimages/{type?}",array("as"=>'eimage',"uses"=>"Backend\HomeController@postSlideImages"));

    Route::get("administrators/index", array("as"=>'userlist',"uses"=>"Backend\UserController@getUserIndex"));
    Route::get("administrators/addnew", array("as"=>'useradd',"uses"=>"Backend\UserController@getAddUser"));
    Route::get("administrators/edituser/{id?}", array("as"=>'useredit',"uses"=>"Backend\UserController@getEditUser"));
    Route::post("administrators/edituser/{id?}", array("as"=>'useredit',"uses"=>"Backend\UserController@postEditUser"));
    Route::post("administrators/addnew", array("as"=>'useradd',"uses"=>"Backend\UserController@postAddUser"));
    Route::get("pageblocks/index",array("as"=>"pgblock","uses"=>"Backend\HomeController@getPageBlockIndex"));
    Route::get("pageblocks/addnew",array("as"=>"pgblockaddn","uses"=>"Backend\HomeController@getAddPageBlock"));
    Route::post("pageblocks/addnew/{id?}",array("as"=>"postpgblockadd","uses"=>"Backend\HomeController@postAddPageBlock"));
    Route::get("pageblocks/editpage/{id?}",array("as"=>"editpgblock","uses"=>"Backend\HomeController@getEditPageBlock"));
    Route::post("pageblocks/editpage/{id?}",array("as"=>"postpgblockedit","uses"=>"Backend\HomeController@postAddPageBlock"));
//08113022193

    Route::get("/settings",array("as"=>"settings","before"=>"auth","uses"=>"Backend\HomeController@getSettings"));
    Route::post("/settings",array("as"=>"settings","before"=>"auth","uses"=>"Backend\HomeController@postSettings"));


    Route::get("pcategory/index",array("as"=>"pcategory","before"=>"auth","uses"=>"Backend\CatalogueController@getCategoryIndex"));
    Route::get("pcategory/addnew",array("as"=>"addpcategory","before"=>"auth","uses"=>"Backend\CatalogueController@getCategoryAddNew"));
    Route::post("pcategory/addnew/{id?}",array("as"=>"postaddnew","before"=>"auth","uses"=>"Backend\CatalogueController@postCategoryAddNew"));
    Route::get("pcategory/edit/{id?}",array("as"=>"editpcategory","before"=>"auth","uses"=>"Backend\CatalogueController@getCategoryEdit"));
    Route::post("pcategory/edit/{id?}",array("as"=>"postaddnew","before"=>"auth","uses"=>"Backend\CatalogueController@postCategoryEdit"));


    Route::get("products/index",array("as"=>"prodindex","before"=>"auth","uses"=>"Backend\CatalogueController@getProductIndex"));
    Route::get("products/addnew/{id?}",array("as"=>"prodaddnew","before"=>"auth","uses"=>"Backend\CatalogueController@getProductAddNew"));
    Route::post("products/addnew/{id?}",array("as"=>"postprodaddnew","before"=>"auth","uses"=>"Backend\CatalogueController@postProductAddNew"));
    Route::get("products/edit/{id?}",array("as"=>"prodedit","before"=>"auth","uses"=>"Backend\CatalogueController@getProductEdit"));

    Route::get("brands/index", array("as"=>"brandlist","before"=>"auth","uses"=>"Backend\CatalogueController@getBrandIndex"));
    Route::get("brands/addnew/{id?}", array("as"=>"brandadd","before"=>"auth","uses"=>"Backend\CatalogueController@getBrandAddNew"));
    Route::post("brands/addnew/{id?}", array("as"=>"brandaddpost","before"=>"auth","uses"=>"Backend\CatalogueController@postBrandAddNew"));
    Route::get("brands/edit/{id?}", array("as"=>"brandedit","before"=>"auth","uses"=>"Backend\CatalogueController@getBrandEdit"));

    /*
     * Route for options setting
    */
    Route::get("options/index", array("as"=>"optionlist","before"=>"auth","uses"=>"Backend\CatalogueController@getOptionIndex"));
    Route::get("options/addnew/{id?}", array("as"=>"optionadd","before"=>"auth","uses"=>"Backend\CatalogueController@getOptionAddNew"));
    Route::post("options/addnew/{id?}", array("as"=>"optionaddpost","before"=>"auth","uses"=>"Backend\CatalogueController@postOptionAddNew"));
    Route::get("options/edit/{id?}", array("as"=>"optionedit","before"=>"auth","uses"=>"Backend\CatalogueController@getOptionEdit"));

    /**
     *Route for sales group
     */

    Route::get("sales/customers/index", array("as"=>"cuslist","before"=>"auth","uses"=>"Backend\SalesController@getCustomerIndex"));
    Route::get("sales/customers/add/{id?}", array("as"=>"cusadd","before"=>"auth","uses"=>"Backend\SalesController@getCustomerAdd"));
    Route::post("sales/customers/add/{id?}", array("as"=>"cusaddpost","before"=>"auth","uses"=>"Backend\SalesController@postCustomerAdd"));
    Route::get("sales/customers/edit/{id?}", array("as"=>"cusedit","before"=>"auth","uses"=>"Backend\SalesController@getCustomerEdit"));


    Route::get("sales/orders/index", array("as"=>"ordlist","before"=>"auth","uses"=>"Backend\SalesController@getOrderIndex"));
    Route::post("sales/orders/index", array("as"=>"postordlist","before"=>"auth","uses"=>"Backend\SalesController@postOrderIndex"));
    Route::get("sales/orders/add/{id?}", array("as"=>"ordadd","before"=>"auth","uses"=>"Backend\SalesController@getOrderAdd"));
    Route::post("sales/orders/add/{id?}", array("as"=>"ordaddpost","before"=>"auth","uses"=>"Backend\SalesController@postOrderAdd"));
    Route::get("sales/orders/edit/{id?}", array("as"=>"ordedit","before"=>"auth","uses"=>"Backend\SalesController@getOrderEdit"));

    //End of sales groping route

});
//Route::get('backend/login', 'AuthController@getLogin');
Route::get('login/{target?}',array("as"=>"login","uses"=>'AuthController@getLogin'));
Route::post('login/{target?}', 'AuthController@postLogin');

Route::get('account/auth/login', 'Auth\AuthController@getLogin');
Route::post('account/auth/login', 'Auth\AuthController@postLogin');
Route::get('account/auth/logout', 'Auth\AuthController@getLogout');
Route::get('logout', array("as"=>"logout","uses"=>'AuthController@getLogout'));
