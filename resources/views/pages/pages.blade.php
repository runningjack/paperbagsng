<?php
/**
 * Created by PhpStorm.
 * User: USER
 * Date: 7/22/16
 * Time: 4:34 AM
 */
?>

@extends("layouts.inner")
@section("content")

@if (isset($mypage))
<section class="page-header page-header-light page-header-more-padding">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h1>{!! $mypage->title !!} <span></span></h1>
                <ul class="breadcrumb breadcrumb-valign-mid">
                    <li><a href="{{url('')}}">Home</a></li>
                    <li class="active">{{ $mypage->title }}</li>
                </ul>
            </div>
        </div>
    </div>
</section>


<div class="container">
    <div class="row">
        <div class="col-md-12">
            {!!$mypage->p_content!!}
        </div>
    </div>
</div>
@else
@endif
@stop