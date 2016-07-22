<?php

namespace paperbagsng;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Validator;

class Post extends Model
{
    //
    public static $rules = array(
        'title'=>'required|unique:posts',
        'permalink'=>'required|unique:posts'

    );

    public static function validate($data){

        return Validator::make($data, static::$rules);
    }

}
