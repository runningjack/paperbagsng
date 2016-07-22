<?php
/**
 * Created by PhpStorm.
 * User: USER
 * Date: 7/17/16
 * Time: 3:16 PM
 */
?>
@extends("layouts.inners")
@section("content")

<div role="main" class="main shop">

<div class="container">

<div class="row">
    <div class="col-md-12">
        <hr class="tall">
    </div>
</div>

<div class="row">
<div class="col-md-12">

<div class="row">
    <div class="col-md-4">

        <div class="owl-carousel owl-theme owl-loaded owl-drag owl-carousel-init" data-plugin-options="{&quot;items&quot;: 1, &quot;margin&quot;: 10}">



            <div class="owl-stage-outer"><div class="owl-stage" style="transform: translate3d(-838px, 0px, 0px); transition: 0s; width: 2933px;"><div class="owl-item cloned" style="width: 409px; margin-right: 10px;"><div>
                            <img alt="" height="300" class="img-responsive" src="{{url('')}}/img/products/product-7-2.jpg">
                        </div></div><div class="owl-item cloned" style="width: 409px; margin-right: 10px;"><div>
                            <img alt="" height="300" class="img-responsive" src="{{url('')}}/img/products/product-7-3.jpg">
                        </div></div><div class="owl-item active" style="width: 409px; margin-right: 10px;"><div>
                            <img alt="" height="300" class="img-responsive" src="{{url('')}}/img/products/product-7.jpg">
                        </div></div><div class="owl-item" style="width: 409px; margin-right: 10px;"><div>
                            <img alt="" height="300" class="img-responsive" src="{{url('')}}/img/products/product-7-2.jpg">
                        </div></div><div class="owl-item" style="width: 409px; margin-right: 10px;"><div>
                            <img alt="" height="300" class="img-responsive" src="{{url('')}}/img/products/product-7-3.jpg">
                        </div></div><div class="owl-item cloned" style="width: 409px; margin-right: 10px;"><div>
                            <img alt="" height="300" class="img-responsive" src="{{url('')}}/img/products/product-7.jpg">
                        </div></div><div class="owl-item cloned" style="width: 409px; margin-right: 10px;"><div>
                            <img alt="" height="300" class="img-responsive" src="{{url('')}}/img/products/product-7-2.jpg">
                        </div></div></div></div><div class="owl-nav disabled"><div class="owl-prev"></div><div class="owl-next"></div></div><div class="owl-dots"><div class="owl-dot active"><span></span></div><div class="owl-dot"><span></span></div><div class="owl-dot"><span></span></div></div></div>

    </div>

    <div class="col-md-7">




        <div class="summary entry-summary">

            <h1 class="mb-none"><strong>{{$bag_title}}</strong></h1>
<br>
                <section class="panel panel-info form-wizard" id="w3">
                    <header class="panel-heading">


                        <h2 class="panel-title">Make you design specifications</h2>
                    </header>
                    <div class="panel-body">
                        <div class="wizard-progress">
                            <div class="steps-progress">
                                <div class="progress-indicator" style="width: 0%;"></div>
                            </div>
                            <ul class="wizard-steps">
                                <li class="active">
                                    <a href="#w3-layout" data-toggle="tab"><span>1</span>Layout</a>
                                </li>
                                <li>
                                    <a href="#w3-design" data-toggle="tab"><span>2</span>Design</a>
                                </li>
                                <li>
                                    <a href="#w3-finishing" data-toggle="tab"><span>3</span>Finishing</a>
                                </li>

                                <li>
                                    <a href="#w3-preview" data-toggle="tab"><span>4</span>Preview</a>
                                </li>
                                <li><a href="#w3-checkout" data-toggle="tab"><span>5</span>Checkout</a></li>

                            </ul>
                        </div>
                        <form class="form-horizontal" novalidate="novalidate" method="post" enctype="multipart/form-data">
                            <div class="tab-content">
                                <div id="w3-layout" class="tab-pane active">
                                    <div class="form-group">
                                        <label class="col-sm-4 control-label" for="w3-username">Size</label>
                                        <div class="col-sm-8">
                                            <select name="bag_size" id="bag_size" class="form-control" required="required">
                                                <option value="">--SELECT SIZE--</option>
                                                <option value="X SMALL">X SMALL</option>
                                                <option value="SMALL">SMALL</option>
                                                <option value="MEDIUM">MEDIUM</option>
                                                <option value="LARGE">LARGE</option>
                                                <option value="X LARGE">X LARGE</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-4 control-label" for="w3-username">Orientation</label>
                                        <div class="col-sm-8">
                                            <select name="orientation" id="orientation" class="form-control" required="required">
                                                <option value="">--SELECT ORIENTATION--</option>
                                                <option value="Landscape">Landscape</option>
                                                <option value="Portrait">Portrait</option>

                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div id="w3-design" class="tab-pane">
                                    <div class="form-group">
                                        <label class="col-sm-4 control-label" for="w3-username">Choose Background Type</label>
                                        <div class="col-sm-8">
                                            <select name="background_type" id="background_type" class="form-control" required="required">
                                                <option value="">--SELECT BACKGROUND TYPE--</option>
                                                <option value="solid">Solid</option>
                                                <option value="pattern" disabled>Pattern</option>
                                                <option value="picture" disabled>Picture/Image</option>

                                            </select>
                                        </div>
                                    </div>

                                    <div class="form-group back-type" id="solid">
                                        <label class="col-md-4 control-label">Select Background Color</label>
                                        <div class="col-md-8">
                                            <div class="input-group color colorpicker-element" data-plugin-colorpicker="">
                                                <span class="input-group-addon"><i style="background-color: rgb(235, 149, 164);"></i></span>
                                                <input id="background"  name="background" type="text" class="form-control" value="#0088cc">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="clearfix"></div>
                                    <!--<div class="form-group back-type" id="pattern">
                                        <label class="col-md-4 control-label">Select A Pattern</label>
                                        <div class="col-md-8">
                                            <ul class="list-inline">
                                                <li> <label for="background2"> <input class="form-control radio input-sm" id="background2" name="background" type="radio" value="{{url('')}}/img/patterns/Aztec-Seamless-Pattern.jpg"><img class="img-thumbnail img-responsive pattern-form-img" src="{{url('')}}/img/patterns/Aztec-Seamless-Pattern.jpg" /></label></li>
                                                <li> <label for="background3"> <input class="form-control radio input-sm" id="background3" name="background" type="radio" value="{{url('')}}/img/patterns/126629913_6cdabf9197_z.jpg"><img class="img-thumbnail img-responsive pattern-form-img" src="{{url('')}}/img/patterns/126629913_6cdabf9197_z.jpg" /></label></li>
                                                <li> <label for="background4"> <input class="form-control radio input-sm" id="background4" name="background" type="radio" value="{{url('')}}/img/patterns/christmas-paper-pattern-001.jpg"><img class="img-thumbnail img-responsive pattern-form-img" src="{{url('')}}/img/patterns/christmas-paper-pattern-001.jpg" /></label></li>
                                                <li> <label for="background5"><input class="form-control radio input-sm" id="background5" name="background" type="radio" value="{{url('')}}/img/patterns/diagonal black and white strip.png"><img class="img-thumbnail img-responsive pattern-form-img" src="{{url('')}}/img/patterns/diagonal black and white strip.png" /></label></li>
                                                <li> <label for="background6"><input class="form-control radio input-sm" id="background6" name="background" type="radio" value="{{url('')}}/img/patterns/lilac-tissue-paper-002.jpg"><img class="img-thumbnail img-responsive pattern-form-img" src="{{url('')}}/img/patterns/lilac-tissue-paper-002.jpg" /></label></li>
                                            </ul>
                                        </div>
                                    </div>-->

                                    <!--<div class="form-group">
                                        <label class="col-md-4 control-label">Upload your Logo</label>
                                        <div class="col-md-8">
                                            <div id="imgg">
                                                <a class="btn btn-primary" data-toggle="modal" data-target="#myModalLogo">Upload</a>
                                            </div>
                                            <input type="hidden" name="logo" id="design-logo" >
                                        </div>
                                    </div>-->

                                    <div class="form-group">
                                        <label class="col-md-4 control-label">Upload Your Logo</label>
                                        <div class="col-md-7">
                                            <div class="fileupload fileupload-new"  name="logo" data-provides="fileupload">
                                                <div class="input-append">
                                                    <div class="uneditable-input">
                                                        <i class="fa fa-file fileupload-exists"></i>
                                                        <span class="fileupload-preview">Upload</span>
                                                    </div>
														<span class="btn btn-default btn-file">
															<span class="fileupload-exists">Change</span>
															<span class="fileupload-new">Select file</span>
															<input type="file">
														</span>
                                                    <a href="#" class="btn btn-default fileupload-exists" data-dismiss="fileupload">Remove</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>


                                    <div class="form-group">
                                        <label class="col-sm-4 control-label" for="w3-username">Choose Logo Position</label>
                                        <div class="col-sm-8">
                                            <select name="logoposition" class="form-control" required="required">
                                                <option value="">--SELECT LOGO POSITION--</option>
                                                <option value="front">Front</option>
                                                <option value="back">Back</option>
                                                <option value="left side">Left Side</option>
                                                <option value="right side">right Side</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-4 control-label" for="design_text">Enter Text</label>
                                        <div class="col-md-8">
                                            <input type="text" name="design_text" class="form-control" id="design_text">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-4 control-label">Text Position</label>
                                        <div class="col-md-8">
                                            <select name="text_position" class="form-control" multiple="multiple" data-plugin-multiselect="" data-plugin-options="{ 'maxHeight': 200 }" id="ms_example0" style="display: none;">
                                                <option value="front">Front</option>
                                                <option value="back" selected="">Back</option>
                                                <option value="left" selected="">Left</option>
                                                <option value="right">Right</option>
                                                <option value="top">Top</option>
                                                <option value="bottom">Bottom</option>
                                                <option value="center">Center</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="col-sm-4 control-label" for="w3-username">Select a font style</label>
                                        <div class="col-sm-8">
                                            <select name="text_font" id="text_font" class="form-control" required="required">
                                                <option value="">--SELECT FONT STYLE--</option>
                                                <option value="serif">Serif</option>
                                                <option value="san-serif">San-Serif</option>
                                                <option value="Block/Collegiate">Block/Collegiate</option>
                                                <option value="Cultural/Worldly">Cultural/Worldly</option>
                                                <option value="Distressed">Distressed</option>
                                                <option value="Futuristic">Futuristic</option>
                                                <option value="Greek">Greek</option>
                                                <option value="Handwriting">Handwriting</option>
                                                <option value="Novelty/Fun">Novelty/Fun</option>
                                                <option value="Retro/Era">Retro/Era</option>
                                                <option value="Script/Formal">Script/Formal</option>

                                            </select>
                                        </div>
                                    </div>


                                </div>
                                <div id="w3-finishing" class="tab-pane">

                                    <div class="form-group">
                                        <label class="col-sm-4 control-label" for="w3-username">Select finishing style</label>
                                        <div class="col-sm-8">
                                            <select name="finishing" id="finishing" class="form-control" required="required">
                                                <option value="">--SELECT FINISHING STYLE--</option>
                                                <option value="foil blocking">Foil Blocking</option>
                                                <option value="Embossing">Embossing</option>
                                                <option value="spot lamination">Spot Lamination</option>
                                                <option value="all over embossed texture">All Over Embossed Texture</option>

                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-4 control-label" for="w3-username">Quantity</label>
                                        <div class="col-sm-4">
                                            <input type="number" class="form-control input-sm" name="quantity" id="quantity" required="" aria-required="true">
                                        </div>

                                    </div>

                                </div>

                                <div id="w3-preview" class="tab-pane">

                                    <div class="form-group">
                                        <label class="col-sm-12 control-label" for="w3-username">Preview you design details</label>
                                        <div class="col-sm-12">
                                            <table class="table table-striped mt-xl">
                                                <tbody>
                                                    <tr>
                                                        <td><h4><span style="color:#5CC6D0">Size</span></h4></td>
                                                        <td><span id="dsize" ></span></td>
                                                        <td></td>
                                                    </tr>
                                                    <tr>
                                                        <td><h4><span style="color:#5CC6D0">Orientation</span></h4></td>
                                                        <td><span id="dorient" ></span></td>
                                                        <td></td>
                                                    </tr>
                                                    <tr>
                                                        <td><h4><span style="color:#5CC6D0">Background</span></h4></td>
                                                        <td><span id="dbackground" ></span></td>
                                                        <td><div id="cl" style=" display: inline">COLOR</div> <span id="dcolor" ></span></td>
                                                        <td><span id="dpattern" ></span></td>
                                                    </tr>

                                                    <tr>
                                                        <td><h4><span style="color:#5CC6D0">Text</span></h4></td>
                                                        <td><span id="dtext"></span></td>
                                                        <td><span id="dfont"></span></td>
                                                    </tr>

                                                    <tr>
                                                        <td><h4><span style="color:#5CC6D0">Finishing</span></h4></td>
                                                        <td><span id="dfinishing"></span></td>
                                                        <td></td>
                                                    </tr>
                                                </tbody>

                                            </table>
                                        </div>
                                    </div>

                                </div>
                                <div id="w3-checkout" class="tab-pane">
                                    <div class="row">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <label for="first_name" class="control-label">First Name</label>
                                                <input type="text" class="form-control input-sm" name="first_name" id="first_name" required="" aria-required="true">
                                                <span class="help-block"></span>
                                        </div>

                                            <div class="col-md-6">
                                                <label for="last_name" class="control-label">Last Name</label>
                                                <input type="text" class="form-control input-sm" name="first_name" id="first_name" required="" aria-required="true">
                                            <span class="help-block"></span>
                                        </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                            <label for="email" class="control-label">Email</label>
                                            <input type="email" class="form-control input-sm" name="email" id="email" required="" aria-required="true">
                                            <span class="help-block"></span>
                                                </div>
                                            <div class="col-md-6">
                                                <label for="email" class="control-label">Telephone</label>
                                                <input type="text" class="form-control input-sm" name="phone" id="phone" required="" aria-required="true">
                                                <span class="help-block"></span>
                                            </div>
                                        </div>

                                        <div class="row">
                                           <div class="col-md-6">
                                               <label for="state" class="control-label">State</label>
                                               <input type="text" class="form-control input-sm" name="state" id="state" required="" aria-required="true">
                                               <span class="help-block"></span>
                                           </div>
                                            <div class="col-md-6">
                                                <label for="email" class="control-label">City</label>
                                                <input type="text" class="form-control input-sm" name="city" id="city" required="" aria-required="true">
                                                <span class="help-block"></span>
                                            </div>
                                        </div>
                                        <div class="row">
                                           <div class="col-md-12">
                                               <label for="state" class="control-label">Address</label>
                                               <textarea class="form-control" name="state" id="state" required="" aria-required="true"> </textarea>
                                               <span class="help-block"></span>
                                           </div>
                                        </div>

                                    </div>
                                </div>

                            </div>

                    </div>
                    <div class="panel-footer panel-info bg-info">
                        <ul class="pager">
                            <li class="previous disabled">
                                <a><i class="fa fa-angle-left"></i> Previous</a>
                            </li>
                            <li class="finish hidden pull-right">
                                <button class="btn btn-primary" type="submit" >Finish</button>
                            </li>
                            <li class="next">
                                <a>Next <i class="fa fa-angle-right"></i></a>
                            </li>
                        </ul>
                    </div>
                    </form>
                </section>




        </div>


    </div>
</div>

<div class="row">
    <div class="col-md-12">
        <div class="tabs tabs-product">
            <ul class="nav nav-tabs">
                <li class="active"><a href="#productDescription" data-toggle="tab">Description</a></li>
                <li><a href="#productInfo" data-toggle="tab">Aditional Information</a></li>

            </ul>
            <div class="tab-content">
                <div class="tab-pane active" id="productDescription">
                    <p></p>
                </div>
                <div class="tab-pane" id="productInfo">
                    <table class="table table-striped mt-xl">
                        <tbody>
                        <tr>
                            <th>
                                Size:
                            </th>
                            <td>
                                Unique
                            </td>
                        </tr>
                        <tr>
                            <th>
                                Colors
                            </th>
                            <td>
                                Red, Blue
                            </td>
                        </tr>
                        <tr>
                            <th>
                                Material
                            </th>
                            <td>
                                100% Leather
                            </td>
                        </tr>
                        </tbody>
                    </table>
                </div>

            </div>
        </div>
    </div>
</div>

<hr class="tall">


</div>

</div>
</div>

</div>




<div class="modal fade modal2" id="myModalLogin" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" >
    <div class="modal-dialog">
    <div class="modal-content modal-content2">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span><span class="sr-only">Close</span></button>
            <h4 class="modal-title" id="myModalLabel">Login to paperbagsng.com</h4>
        </div>
        <div class="modal-body">
            <div class="row">

                    <div class="col-xs-6">
                        <form id="loginForm" method="POST" >
                        <div class="well">
                            <input type="hidden" id="_token" name="_token" value="{{csrf_token()}}" />
                            <div class="form-group">
                                <label for="email" class="control-label">Username</label>
                                <input type="text" class="form-control" id="username" name="email" value="" required="" title="Please enter you username" placeholder="example@gmail.com">
                                <span class="help-block"></span>
                            </div>
                            <div class="form-group">
                                <label for="password" class="control-label">Password</label>
                                <input type="password" class="form-control" id="password" name="password" value="" required="" title="Please enter your password">
                                <span class="help-block"></span>
                            </div>
                            <div id="loginErrorMsg" class="alert alert-error hide">Wrong username og password</div>
                            <!--<div class="checkbox">
                                <label>
                                    <input type="checkbox" name="remember" id="remember"> Remember login
                                </label>
                                <p class="help-block">(if this is a private computer)</p>
                            </div>-->
                            <button type="submit" class="btn btn-success btn-block">Login</button>


                        </div>
                            </form>
                    </div>
                    <div class="col-xs-6">

                        <p class="lead">Register now for <span class="text-success">FREE</span></p>
                        <ul class="list-unstyled" style="line-height: 2">
                            <li><span class="fa fa-check text-success"></span> See all your orders</li>
                            <li><span class="fa fa-check text-success"></span> Fast re-order</li>
                            <li><span class="fa fa-check text-success"></span> Save your Design</li>
                            <li><span class="fa fa-check text-success"></span> Fast checkout</li>
                            <li><span class="fa fa-check text-success"></span> Get a gift <small>(only new customers)</small></li>
                            <li><a href="javascript:void(0)"><u>Read more</u></a></li>
                        </ul>
                        <br>
                        <form id="registerForm" method="POST" >
                        <div class="well">
                            <div class="form-group">
                                <label for="first_name" class="control-label">First Name</label>
                                <input type="text" class="form-control input-sm" name="first_name" id="first_name" required="" aria-required="true">
                                <span class="help-block"></span>
                            </div>
                            <div class="form-group">
                                <label for="last_name" class="control-label">Last Name</label>
                                <input type="text" class="form-control input-sm" name="last_name" id="last_name" required="" aria-required="true">
                                <span class="help-block"></span>
                            </div>
                            <div class="form-group">
                                <label for="email" class="control-label">Email</label>
                                <input type="email" class="form-control input-sm" name="email" id="email" required="" aria-required="true">
                                <span class="help-block"></span>
                            </div>
                            <input type="hidden" id="_token" name="_token" value="{{csrf_token()}}" />
                            <div class="form-group">
                                <label for="email" class="control-label">Telephone</label>
                                <input type="text" class="form-control input-sm" name="phone" id="phone" required="" aria-required="true">
                                <span class="help-block"></span>
                            </div>

                            <div class="form-group">
                                <label for="password" class="control-label">Password</label>
                                <input type="password" class="form-control input-sm" name="password" id="password2" required="" aria-required="true">
                                <span class="help-block"></span>
                            </div>

                            <div class="form-group">
                                <label for="email" class="control-label">Re-Password</label>
                                <input type="password" class="form-control input-sm" name="confirm" id="confirm" required="" aria-required="true">
                                <span class="help-block"></span>
                            </div>

                        </div>
                        <p><button type="submit"  class="btn btn-info btn-block">register</button></p>
                        </form>
                    </div>

            </div>
        </div>
    </div>
    </div>
</div>




<div class="modal fade" id="myModalLogo" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" >
    <div class="modal-dialog  modal-lg" style="width: 70%">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                <h4 class="modal-title">Upload Your Logo</h4>
            </div>

            <div class="modal-body">
                <form  action=''  method="post"  class="form-horizontal" onsubmit="return false"  enctype="multipart/form-data" id="MyUploadLogo" >
                    <input class="form-control fileupload" name="image_file" id="imageLogo" type="file" />
                    <input type="hidden" id="_token" name="_token" value="{{csrf_token()}}" />
                    <input type="hidden" name="faction" value="logo">
                    <input type="submit"  id="submit-btn" value="Upload" class="btn btn-primary" />
                    <input type="hidden" name="imageInput" id="imageInput" >
                    <br class="clearfix">
                    <div id="outputcert"></div>
                    <hr>

                    <div id="progressbox" style="display:none;"><div id="progressbarcert"></div><div id="statustxtcert">0%</div></div>

                </form>
                <div class="clearfix"></div>
            </div>
            <div class="modal-footer">
            </div>
        </div>
    </div>
</div>


@stop