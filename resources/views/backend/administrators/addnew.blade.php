<?php
/**
 * Created by PhpStorm.
 * User: Amedora
 * Date: 12/31/14
 * Time: 1:44 PM
 */

//initilize the page
require_once("inc/init.php");

//require UI configuration (nav, ribbon, etc.)
require_once("inc/config.ui.php");



$page_title = "Add New";

$page_css[] = "your_style.css";
include("inc/header.php");

//include left panel (navigation)
//follow the tree in inc/config.ui.php
$page_nav["pages"]["sub"]["addnew"]["active"] = true;
include("inc/nav.php");

?>
    <script src="../../../js/app.config.js"></script>
    <!-- ==========================CONTENT STARTS HERE ========================== -->
    <!-- MAIN PANEL -->
    <div id="main" role="main">
    <?php
    //configure ribbon (breadcrumbs) array("name"=>"url"), leave url empty if no url
    //$breadcrumbs["New Crumb"] => "http://url.com"
    $breadcrumbs["Users"] = "";
    include("inc/ribbon.php");
    ?>

    <!-- MAIN CONTENT -->
    <div id="content">
    <div class="row">
        <div class="col-xs-12 col-sm-7 col-md-7 col-lg-4">
            <h1 class="page-title txt-color-blueDark"><i class="fa-fw fa fa-code"></i> Users <span>> Add New</span></h1>

        </div>

    </div>
    <section>
        <div class="col-xs-12 col-sm-7 col-md-7 col-lg-4">
            <div class="text-left">
                {{HTML::decode(HTML::linkRoute('userlist','<span class="btn-label"><i class="glyphicon glyphicon-back"></i> Back to Users'))}}
            </div>
        </div>
    </section>
    {{ Form::open(array('action'=>array('Backend\UserController@postAddUser' ), 'method'=>'POST', 'class'=>'form-horizontal', 'files'=>true)) }}

    <div class="row">
    <div class="col-sm-9">



        <div class="jarviswidget jarviswidget-color-darken jarviswidget-sortable" id="wid-id-2" data-widget-editbutton="false" data-widget-colorbutton="false" data-widget-deletebutton="false" data-widget-fullscreenbutton="false" role="widget" style="">
            <!-- widget options:
                usage: <div class="jarviswidget" id="wid-id-0" data-widget-editbutton="false">

                data-widget-colorbutton="false"
                data-widget-editbutton="false"
                data-widget-togglebutton="false"
                data-widget-deletebutton="false"
                data-widget-fullscreenbutton="false"
                data-widget-custombutton="false"
                data-widget-collapsed="true"
                data-widget-sortable="false"

            -->
            <header role="heading"><div class="jarviswidget-ctrls" role="menu">   <a href="javascript:void(0);" class="button-icon jarviswidget-toggle-btn" rel="tooltip" title="" data-placement="bottom" data-original-title="Collapse"><i class="fa fa-minus"></i></a>  </div>
                <span class="widget-icon"> <i class="fa fa-arrows-v"></i> </span>
                <h2 class="font-md"><strong>Set </strong> <i>Content</i></h2>

                <span class="jarviswidget-loader" style="display: none;"><i class="fa fa-refresh fa-spin"></i></span>
            </header>

            <!-- widget div-->

            <div role="content" style="display: block;">

                <!-- widget edit box -->
                <div class="jarviswidget-editbox">
                    <!-- This area used as dropdown edit box -->

                </div>
                <!-- end widget edit box -->

                <!-- widget content -->
                <div class="widget-body">

                    <fieldset>
                        <legend></legend>

                        @if(Session::has('message'))
                        <div class="alert alert-success fade in">
                            <button class="close" data-dismiss="alert">×</button>
                            <i class="fa-fw fa fa-check"></i>{{Session::get('message')}}
                        </div>
                        @endif
                        @if(Session::has('error_message'))
                        <div class="alert alert-danger fade in">
                            <button class="close" data-dismiss="alert">×</button>
                            <i class="fa-fw fa fa-check"></i>{{Session::get('error_message')}}
                        </div>
                        @endif
                        @if($errors->has("firstname"))
                        <div class="alert alert-danger fade in">
                            <button class="close" data-dismiss="alert">×</button>
                            <i class="fa-fw fa fa-times"></i>{{$errors->first("firstname",":message")}}

                        </div>

                        @endif
                        @if($errors->has("lastname"))
                        <div class="alert alert-danger fade in">
                            <button class="close" data-dismiss="alert">×</button>
                            <i class="fa-fw fa fa-times"></i>{{$errors->first("lastname",":message")}}

                        </div>

                        @endif
                        @if($errors->has("email"))
                        <div class="alert alert-danger fade in">
                            <button class="close" data-dismiss="alert">×</button>
                            <i class="fa-fw fa fa-times"></i>{{$errors->first("email",":message")}}
                        </div>

                        @endif
                        @if($errors->has("phone"))
                        <div class="alert alert-danger fade in">
                            <button class="close" data-dismiss="alert">×</button>
                            <i class="fa-fw fa fa-times"></i>{{$errors->first("phone",":message")}}
                        </div>

                        @endif


                        <div class="form-group">
                            <label class="col-md-2 control-label">Username</label>
                            <div class="col-md-10">
                                <input class="form-control" placeholder="Username" id="username" name="username" type="text" required="required" autocomplete="off">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-2 control-label">email</label>
                            <div class="col-md-10">
                                <input class="form-control" placeholder="Email" id="email" name="email" type="text" required="required" >
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-2 control-label">Password</label>
                            <div class="col-md-10">
                                <input class="form-control" placeholder="Password" id="password" name="password" type="password" required="required" >
                            </div>
                        </div>
                        <!--<div class="form-group">
                            <label class="col-md-2 control-label">Confirm password</label>
                            <div class="col-md-10">
                                <input class="form-control" placeholder="Password" id="password" name="password" type="password" required="required" >
                            </div>
                        </div>-->
                        <hr>
                    </fieldset>
                    <fieldset>
                        <div class="row">
                            <div class="col-md-2 col-lg-2 "></div>
                            <div class="col-md-5 col-lg-5">
                                <div class="form-group">
                                    <label class="col-md-3 control-label">Firstname</label>
                                    <div class="col-md-9">
                                        <input class="form-control" placeholder="Password" id="firstname" name="firstname" type="text" required="required" >
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-3 control-label">Middlename</label>
                                    <div class="col-md-9">
                                        <input class="form-control" placeholder="middlename" id="middlename" name="middlename" type="text"  >
                                    </div>
                                </div>

                            </div>
                            <div class="col-md-5 col-lg-5">
                                <div class="form-group">
                                    <label class="col-md-3 control-label">Lastname</label>
                                    <div class="col-md-9">
                                        <input class="form-control" placeholder="Lastname" id="lastname" name="lastname" type="text" required="required" >
                                    </div>

                                </div>
                                <div class="form-group">
                                    <label class="col-md-3 control-label">Telephone</label>
                                    <div class="col-md-9">
                                        <input class="form-control" placeholder="phone" id="phone" name="phone" type="text" required="required" >
                                    </div>
                                </div>

                            </div>
                            <hr>
                        </div>
                        <p>&nbsp;</p>

                    </fieldset>


                </div>
                <!-- end widget content -->



            </div>

            <!-- end widget div -->

        </div>

    </div>
    <div class="col-sm-3">

        <div class="jarviswidget jarviswidget-sortable" id="wid-id-12" data-widget-load="ajax/demowidget.php" data-widget-colorbutton="false" data-widget-editbutton="false" data-widget-togglebutton="false" data-widget-deletebutton="false" data-widget-fullscreenbutton="false" data-widget-custombutton="false" role="widget">
            <!-- widget options:
                usage: <div class="jarviswidget" id="wid-id-0" data-widget-editbutton="false">

                data-widget-colorbutton="false"
                data-widget-editbutton="false"
                data-widget-togglebutton="false"
                data-widget-deletebutton="false"
                data-widget-fullscreenbutton="false"
                data-widget-custombutton="false"
                data-widget-collapsed="true"
                data-widget-sortable="false"

            -->
            <header role="heading" class=""><div class="jarviswidget-ctrls" role="menu"><a href="javascript:void(0);" class="button-icon jarviswidget-refresh-btn" data-loading-text="&nbsp;&nbsp;Loading...&nbsp;" rel="tooltip" title="" data-placement="bottom" data-original-title="Refresh"><i class="fa fa-refresh"></i></a>     </div>
                <h2><strong>User</strong> <i> Sttings</i></h2>

                <span class="jarviswidget-loader" style="display: none;"><!--<i class="fa fa-refresh fa-spin"></i></span>--></header>

            <!-- widget div-->
            <div role="content" class="">

                <!-- widget edit box -->
                <div class="jarviswidget-editbox">
                    <!-- This area used as dropdown edit box -->

                </div>
                <!-- end widget edit box -->

                <!-- widget content -->
                <div class="widget-body">

                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary"><i class="fa fa-cog"></i>Save &amp; Publish</button>
                            <!--<a class="btn btn-primary" href="javascript:void(0);"><i class="fa fa-cog"></i> Save &amp; Publish</a>-->

                        </div>
                        <hr>

                        <div class="form-group">

                            <label class="checkbox-inline">
                                <input type="checkbox" id="status" name="status" value="active" checked class="checkbox style-0">
                                <span>Active</span>
                            </label>

                        </div>
                       <!-- <div class="form-group">
                            <label>Select Role</label>
                            <select class="form-control" id="layout" name="layout">
                                <option>default</option>
                            </select>
                        </div>-->

                        <hr>

                    </div>

                </div>

                <!-- end widget content -->

            </div>
            <!-- end widget div -->

        </div>


    </div>
    </div>

    </form>
    </div>
    <!-- END MAIN CONTENT -->

    </div>
    <!-- END MAIN PANEL -->
    <!-- ==========================CONTENT ENDS HERE ========================== -->
<?php
Session::flush();
?>
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

    <!-- PAGE RELATED PLUGIN(S)-->

    <script src="<?php echo ASSETS_URL; ?>/js/plugin/ckeditor/ckeditor.js"></script>

    <script>


        $(document).ready(function() {
            CKEDITOR.replace( 'p_content', { height: '380px', startupFocus : true} );
            var perma =""
            // PAGE RELATED SCRIPTS

            // switch style change
            $('input[name="checkbox-style"]').change(function() {
                //alert($(this).val())
                $this = $(this);

                if ($this.attr('value') === "switch-1") {
                    $("#switch-1").show();
                    $("#switch-2").hide();
                } else if ($this.attr('value') === "switch-2") {
                    $("#switch-1").hide();
                    $("#switch-2").show();
                }

            });

            // tab - pills toggle
            $('#show-tabs').click(function() {
                $this = $(this);
                if($this.prop('checked')){
                    $("#widget-tab-1").removeClass("nav-pills").addClass("nav-tabs");
                } else {
                    $("#widget-tab-1").removeClass("nav-tabs").addClass("nav-pills");
                }

            });

            $("#title").keyup(function(){

                perma = $(this).val()
                perma = perma.replace(/\s/g,"-")
                perma = perma.toLowerCase()
                //alert("all good")
                $("#permalink").val(perma)
            })



        });

    </script>

<?php
//include footer
include("inc/google-analytics.php");
?>