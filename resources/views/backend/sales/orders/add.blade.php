<?php
/**
 * Created by PhpStorm.
 * User: Amedora
 * Date: 6/26/15
 * Time: 4:21 AM
 */

require_once("inc/init.php");

//require UI configuration (nav, ribbon, etc.)
require_once("inc/config.ui.php");

$page_title = "Add New Customer";
include("inc/header.php");

//include left panel (navigation)
//follow the tree in inc/config.ui.php
$page_nav["sales"]["sub"]["customers"]["sub"]["add"]["active"] = true;
include("inc/nav.php");

?>
    <!-- ==========================CONTENT STARTS HERE ========================== -->
    <!-- MAIN PANEL -->
    <div id="main" role="main">
    <?php
    //configure ribbon (breadcrumbs) array("name"=>"url"), leave url empty if no url
    //$breadcrumbs["New Crumb"] => "http://url.com"
    $breadcrumbs["Add New"] = "";
    include("inc/ribbon.php");
    ?>

    <!-- MAIN CONTENT -->
    <div id="content">
    <div class="row">
        <div class="col-xs-12 col-sm-7 col-md-7 col-lg-4">
            <h1 class="page-title txt-color-blueDark"><i class="fa-fw fa fa-code"></i>{{$title}}<span>> {{$subtitle}}</span></h1>
        </div>
    </div>
    <section>
        <div class="col-xs-12 col-sm-7 col-md-7 col-lg-4">
            <div class="text-left">
                {{HTML::decode(HTML::linkRoute('cuslist','<span class="btn-label"><i class="glyphicon glyphicon-back"></i> Back to Listing'))}}
            </div>
        </div>
    </section>
    {{Form::open(array('action'=>array('Backend\SalesController@postCustomerAdd', ""), 'method'=>'POST', 'class'=>'form-horizontal', 'files'=>true)) }}
    <div class="row">
    <div class="col-md-9">
        <div class="jarviswidget jarviswidget-color-darken jarviswidget-sortable" id="wid-id-2" data-widget-editbutton="false" data-widget-colorbutton="false" data-widget-deletebutton="false" data-widget-fullscreenbutton="false" role="widget" style="">
            <header role="heading">
                <div class="jarviswidget-ctrls" role="menu">
                    <a href="javascript:void(0);" class="button-icon jarviswidget-toggle-btn" rel="tooltip" title="" data-placement="bottom" data-original-title="Collapse"><i class="fa fa-minus"></i></a>
                </div>
                <span class="widget-icon"> <i class="fa fa-arrows-v"></i> </span>
                <h2 class="font-md"><strong>Set </strong> <i>Content</i></h2>
            </header>
            <div role="content" style="display: block;">
                <div class="widget-body">
                    @if(Session::has('error_message'))
                    <div class="alert alert-danger fade in">
                        <button class="close" data-dismiss="alert">×</button>
                        <i class="fa-fw fa fa-check"></i>{{Session::get('error_message')}}
                    </div>
                    @endif
                    @if(Session::has('success_message'))
                    <div class="alert alert-success fade in">
                        <button class="close" data-dismiss="alert">×</button>
                        <i class="fa-fw fa fa-check"></i>{{Session::get('success_message')}}
                    </div>
                    @endif

                    @if ( ! empty( $errors ) )
                    @foreach ( $errors->all() as $error )
                    <div class="alert alert-danger fade in">
                        <button class="close" data-dismiss="alert">×</button>
                        <i class="fa-fw fa fa-times"></i>{{$error}}
                    </div>
                    @endforeach
                    @endif

                    <div class="tabs-left">
                        <ul class="nav nav-tabs tabs-left" id="demo-pill-nav">
                            <li class="active">
                                <a href="#tab-r1" data-toggle="tab"><i class="fa fa-user"></i>General</a>
                            </li>
                            <li>
                                <a href="#tab-r2" data-toggle="tab"><i class="fa fa-money"></i> Address</a>
                            </li>

                        </ul>
                        <div class="tab-content">
                            <div class="tab-pane active" id="tab-r1">
                                <div class="form-group" style="margin: 0 !important;padding: 0 !important; text-align: center"> <h3>Basic Info</h3></div>
                                <div class="form-group">
                                    <label class="col-md-2 col-2 control-label">First Name <span class="color-black">*</span></label>
                                    <div class="col-md-10 col-10">
                                        <input class="form-control" placeholder="Enter first name" id="firstname" name="firstname" type="text" required="required" value="{{\Input::old('firstname')}}" autocomplete="off">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-md-2 control-label">Last Name <span class="color-black">*</span></label>
                                    <div class="col-md-10">
                                        <input class="form-control" placeholder="Enter last name" id="firstname" name="lastname" type="text" required="required" value="{{\Input::old('lastname')}}" autocomplete="off">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-md-2 control-label">Email <span class="color-black">*</span></label>
                                    <div class="col-md-10">
                                        <input class="form-control" placeholder="Enter email" id="email" name="email" type="email" required="required" value="{{\Input::old('email')}}" autocomplete="off">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-md-2 control-label">Telephone<span class="color-black">*</span></label>
                                    <div class="col-md-10">
                                        <input class="form-control" placeholder="Enter phone number" id="phone" name="phone" type="text" required="required" value="{{\Input::old('phone')}}" autocomplete="off">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-md-2 control-label">Password<span class="color-black">*</span></label>
                                    <div class="col-md-10">
                                        <input class="form-control" placeholder="Enter password" id="password" name="password" type="password" required="required" value="" autocomplete="off">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-md-2 control-label">Confirm<span class="color-black">*</span></label>
                                    <div class="col-md-10">
                                        <input class="form-control" placeholder="COnfirm password" id="confirm" name="confirm" type="password" required="required" value="" autocomplete="off">
                                    </div>
                                </div>

                            </div>
                            <div class="tab-pane" id="tab-r2">

                                <div class="form-group" style="margin: 0 !important;padding: 0 !important; text-align: center"> <h3>Address</h3></div>
                                <div class="form-group">
                                    <label class="col-md-2 control-label">Company </label>
                                    <div class="col-md-10">
                                        <input class="form-control" placeholder="Enter Company" id="company" name="company" type="text"  value="{{\Input::old('email')}}" autocomplete="off">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-md-2 control-label">Contact</label>
                                    <div class="col-md-10">
                                        <input class="form-control" placeholder="Enter contact person" id="contact" name="contact" type="text"  value="{{\Input::old('phone')}}" autocomplete="off">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-md-2 control-label">Address 1<span class="color-black">*</span></label>
                                    <div class="col-md-10">
                                        <textarea class="form-control" name="address" required ></textarea>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-md-2 control-label">Apartment<span class="color-black">*</span></label>
                                    <div class="col-md-10">
                                        <input class="form-control" placeholder="Enter contact Block/Floor/Room No etc" id="apartment" name="apartment" type="text"  value="{{\Input::old('phone')}}" autocomplete="off">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-md-2 control-label">City/Town<span class="color-black">*</span></label>
                                    <div class="col-md-10">
                                        <input class="form-control" placeholder="Enter city" id="confirm" name="city" type="text" required="required" value="" autocomplete="off">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-md-2 control-label">Country <span class="color-black">*</span></label>
                                    <div class="col-md-10">
                                        <select class="form-control" name="country" id="country" required="required">
                                            <option value="">Select a country…</option>
                                            @if($countries)
                                            @foreach($countries as $country)
                                            @if($country->name == "Nigeria")
                                            <option value="{{$country->name}}" selected>{{$country->name}}</option>
                                            @else
                                            <option value="{{$country->name}}">{{$country->name}}</option>
                                            @endif
                                            @endforeach
                                            @endif
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-md-2 control-label">State/Region <span class="color-black">*</span></label>
                                    <div class="col-md-10">
                                        <input class="form-control" type="text" id="state" name="state" placeholder ="State / Country" required value="{{Input::old('state')}}">
                                    </div>
                                </div>

                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
    <div class="col-md-3">
        <div class="jarviswidget jarviswidget-sortable" id="wid-id-12" data-widget-load="ajax/demowidget.php" data-widget-colorbutton="false" data-widget-editbutton="false" data-widget-togglebutton="false" data-widget-deletebutton="false" data-widget-fullscreenbutton="false" data-widget-custombutton="false" role="widget">

            <header role="heading" class=""><div class="jarviswidget-ctrls" role="menu"><a href="javascript:void(0);" class="button-icon jarviswidget-refresh-btn" data-loading-text="&nbsp;&nbsp;Loading...&nbsp;" rel="tooltip" title="" data-placement="bottom" data-original-title="Refresh"><i class="fa fa-refresh"></i></a>     </div>
                <h2><strong>Publish &amp;</strong> <i>Page Sttings</i></h2>

                <span class="jarviswidget-loader" style="display: none;"><!--<i class="fa fa-refresh fa-spin"></i></span>--></header>

            <!-- widget div-->
            <div role="content" class="">
                <!-- widget content -->
                <div class="widget-body">
                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary"><i class="fa fa-cog"></i>Save &amp; Publish</button>
                            <!--<a class="btn btn-primary" href="javascript:void(0);"><i class="fa fa-cog"></i> Save &amp; Publish</a>-->
                        </div>
                        <hr>

                        <div class="form-group">
                            <div class="col-md-12">
                                <label class="checkbox-inline">
                                    <input id="view_status" name="view_status" value="visible" class="checkbox style-0" type="checkbox" checked>
                                    <span>View Status</span><span class=""><small><i> Check to indicate whether product is active and unchecked if you want to deactivate product</i></small></span>
                                </label>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-md-12">
                                <label class="checkbox-inline">
                                    <input id="tag" name="tag" value="Special" class="checkbox style-0" type="checkbox">
                                    <span>Special</span><span class=""><small><i>Check to tag product as special.</i></small></span>
                                </label>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
    </form>
    </div>
    <!-- END MAIN CONTENT -->

    </div>
    <!-- END MAIN PANEL -->
    <!-- ==========================CONTENT ENDS HERE ========================== -->

    <!-- PAGE FOOTER -->
<?php
// include page footer
include("inc/footer.php");
?>
    <!-- END PAGE FOOTER -->

<?php
//include required scripts
include("inc/scripts.php");
?>

    <!-- PAGE RELATED PLUGIN(S)
<script src="<?php echo ASSETS_URL; ?>/js/plugin/YOURJS.js"></script>-->

    <script>

        $(document).ready(function() {
            // PAGE RELATED SCRIPTS
        })

    </script>

<?php
//include footer
\Session::flush();
include("inc/google-analytics.php");
?>