<?php
/**
 * Created by PhpStorm.
 * User: USER
 * Date: 7/22/16
 * Time: 5:40 AM
 */
?>

@extends("layouts.home")
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
<div class="row">
    <div class="col-md-12 center">
        <h2 class="word-rotator-title mb-sm">Paperbagng.com is the <strong>most <span class="word-rotate active" data-plugin-options="{'delay': 2000, 'animDelay': 300}">
								<span class="word-rotate-items" style="width: 144px; top: -84px;">
									<span>popular</span>
									<span>awesome</span>
									<span>incredible</span>
								<span>popular</span></span>
							</span></strong> Paperbag Company.</h2>
        <p class="lead">Trusted by over 2,000 satisfied users, Paperbagng.com is a huge success<br>in the of one of the world’s largest MarketPlace.</p>
    </div>
</div>
<div class="row">
    <div class="col-md-12">
        <hr class="tall">
    </div>
</div>
<div class="container">
    <div class="row">
        <div class="col-md-8">
            <h3 class="heading-primary"><strong>Who</strong> We Are</h3>
            <p class="lead">{!!$mypage->p_content!!}</p>
        </div>
        <div class="col-md-4">
            <div class="featured-box featured-box-primary">
                <div class="box-content">
                    <h4 class="text-uppercase">Behind the scenes</h4>
                    <ul class="thumbnail-gallery" data-plugin-lightbox="" data-plugin-options="{&quot;delegate&quot;: &quot;a&quot;, &quot;type&quot;: &quot;image&quot;, &quot;gallery&quot;: {&quot;enabled&quot;: true}}">
                        <li>
                            <a title="Benefits 1" href="{{url('')}}/img/products/product-7.jpg">
												<span class="thumbnail mb-none">
													<img src="{{url('')}}/img/products/product-7.jpg" style="height:75px; width:75px;" alt="">
												</span>
                            </a>
                        </li>
                        <li>
                            <a title="Benefits 2" href="{{url('')}}/img/products/product-7-2.jpg">
												<span class="thumbnail mb-none">
													<img src="{{url('')}}/img/products/product-7-2.jpg" style="height:75px; width:75px;" alt="">
												</span>
                            </a>
                        </li>
                        <li>
                            <a title="Benefits 3" href="{{url('')}}/img/products/product-7-3.jpg">
												<span class="thumbnail mb-none">
													<img src="{{url('')}}/img/products/product-7-3.jpg" style="height:75px; width:75px;" alt="">
												</span>
                            </a>
                        </li>
                        <li>
                            <a title="Benefits 4" href="{{url('')}}/img/products/product-7-2.jpg">
												<span class="thumbnail mb-none">
													<img src="{{url('')}}/img/products/product-7-2.jpg" style="height:75px; width:75px;" alt="">
												</span>
                            </a>
                        </li>
                        <li>
                            <a title="Benefits 5" href="{{url('')}}/img/products/product-7-3.jpg">
												<span class="thumbnail mb-none">
													<img src="{{url('')}}/img/products/product-7-3.jpg" style="height:75px; width:75px;" alt="">
												</span>
                            </a>
                        </li>
                        <li>
                            <a title="Benefits 6" href="{{url('')}}/img/products/product-7-3.jpg">
												<span class="thumbnail mb-none">
													<img src="{{url('')}}/img/products/product-7-3.jpg" style="height:75px; width:75px;" alt="">
												</span>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>


</div>
<section class="section section-primary mb-none">
    <div class="container">
        <div class="row">
            <div class="counters counters-text-light">
                <div class="col-md-3 col-sm-6">
                    <div class="counter">
                        <strong data-to="2000" data-append="+">2000+</strong>
                        <label>Happy Clients</label>
                        <p class="text-color-primary mb-xl">They can’t be wrong</p>
                    </div>
                </div>
                <div class="col-md-3 col-sm-6">
                    <div class="counter">
                        <strong data-to="19">19</strong>
                        <label>Pre-made Paper Bag</label>
                        <p class="text-color-primary mb-xl">Many more to come</p>
                    </div>
                </div>
                <div class="col-md-3 col-sm-6">
                    <div class="counter">
                        <strong data-to="25" data-append="+">25+</strong>
                        <label>Design your own bag</label>
                        <p class="text-color-primary mb-xl">Satisfaction guaranteed</p>
                    </div>
                </div>
                <div class="col-md-3 col-sm-6">
                    <div class="counter">
                        <strong data-to="1000" data-append="+">1000+</strong>
                        <label>On-time Delivery</label>
                        <p class="text-color-primary mb-xl">Available free within Lagos State</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@else
@endif
@stop
