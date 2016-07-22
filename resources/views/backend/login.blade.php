<?php
//initilize the page
require_once("inc/init.php");
//require UI configuration (nav, ribbon, etc.)
require_once("inc/config.ui.php");
/*---------------- PHP Custom Scripts ---------
YOU CAN SET CONFIGURATION VARIABLES HERE BEFORE IT GOES TO NAV, RIBBON, ETC.
E.G. $page_title = "Custom Title" */
$page_title = "Login";
/* ---------------- END PHP Custom Scripts ------------- */
//include header
//you can add your custom css in $page_css array.
//Note: all css files are inside css/ folder
$page_css[] = "your_style.css";
$no_main_header = true;
$page_html_prop = array("id"=>"extr-page", "class"=>"animated fadeInDown");
include("inc/header.php");
?>

    <header id="header">
        <div id="logo-group">
            <span id="logo"> <img src="<?php echo ASSETS_URL; ?>/img/logo_hr.png" alt="Paperbags NG"></span>
        </div>
    </header>

    <div id="main" role="main">

        <!-- MAIN CONTENT -->
        <div id="content" class="container">

            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-7 col-lg-8 hidden-xs hidden-sm">
                    <h1 class="txt-color-blue login-header-big">Paperbagsng.com</h1>
                    <div class="hero" style="background-image: none">

                        <div class="pull-left login-desc-box-l">
                            <h4 class="paragraph-header">Administrative Portal Login!</h4>
                            <div class="login-app-icons">
                                <a href="<?php echo ASSETS_URL; ?>" class="btn btn-primary btn-sm">Frontend </a>

                            </div>
                        </div>

                        <!--<img src="<?php /*echo ASSETS_URL; */?>/img/demo/iphoneview.png" class="pull-right display-image" alt="" style="width:210px">-->

                    </div>


                </div>
                <div class="col-xs-12 col-sm-12 col-md-5 col-lg-4">
                    <div class="row">
                        <div class="col-xs-12">
                            <?php  ?>
                            @if(\Illuminate\Support\Facades\Session::has('message'))
                            <div class="alert alert-success fade in">
                                <button class="close" data-dismiss="alert">×</button>
                                <i class="fa-fw fa fa-check"></i>{{\Illuminate\Support\Facades\Session::get('message')}}
                            </div>
                            @endif
                            @if(\Illuminate\Support\Facades\Session::has('success_message'))
                            <div class="alert alert-success fade in">
                                <button class="close" data-dismiss="alert">×</button>
                                <i class="fa-fw fa fa-check"></i>{{\Illuminate\Support\Facades\Session::get('success_message')}}
                            </div>
                            @endif
                            @if(Session::has('error_message'))
                            <div class="alert alert-danger fade in">
                                <button class="close" data-dismiss="alert">×</button>
                                <i class="fa-fw fa fa-check"></i>{{Session::get('error_message')}}
                            </div>
                            @endif


                            <div class="col-xs-12"> @if ( ! empty( $errors ) )
                                @foreach ( $errors->all() as $error )
                                <div class="alert alert-danger fade in">
                                    <button class="close" data-dismiss="alert">×</button>
                                    <i class="fa-fw fa fa-times"></i>{{$error}}
                                </div>
                                @endforeach
                                @endif</div>
                        </div>
                    </div>
                    <div class="well no-padding">
                       <!--Form::open(array('action'=>array('AuthController@postLogin'), 'method'=>'POST', 'class'=>'smart-form client-form')) -->
                        <form action="login" method="post" class="smart-form client-form">
                            <input type="hidden" id="_token" name="_token" value="{{csrf_token()}}" />
                            <header>
                                Sign In
                            </header>

                            <fieldset>

                                <section>
                                    <label class="label">E-mail</label>
                                    <label class="input"> <i class="icon-append fa fa-user"></i>
                                        <input type="email" name="email" required="">
                                        <b class="tooltip tooltip-top-right"><i class="fa fa-user txt-color-teal"></i> Please enter email address/username</b></label>
                                </section>

                                <section>
                                    <label class="label">Password</label>
                                    <label class="input"> <i class="icon-append fa fa-lock"></i>
                                        <input type="password" name="password" required="">
                                        <b class="tooltip tooltip-top-right"><i class="fa fa-lock txt-color-teal"></i> Enter your password</b> </label>
                                    <div class="note">
                                        <a href="<?php echo APP_URL; ?>/forgotpassword.php">Forgot password?</a>
                                    </div>
                                </section>

                                <section>
                                    <label class="checkbox">
                                        <input type="checkbox" name="remember" checked="">
                                        <i></i>Stay signed in</label>
                                </section>
                            </fieldset>
                            <footer>
                                <button type="submit" class="btn btn-primary">
                                    Sign in
                                </button>
                            </footer>
                        </form>

                    </div>

                   <!-- <h5 class="text-center"> - Or sign in using -</h5>

                    <ul class="list-inline text-center">
                        <li>
                            <a href="javascript:void(0);" class="btn btn-primary btn-circle"><i class="fa fa-facebook"></i></a>
                        </li>
                        <li>
                            <a href="javascript:void(0);" class="btn btn-info btn-circle"><i class="fa fa-twitter"></i></a>
                        </li>
                        <li>
                            <a href="javascript:void(0);" class="btn btn-warning btn-circle"><i class="fa fa-linkedin"></i></a>
                        </li>
                    </ul>-->

                </div>
            </div>
        </div>

    </div>
    <!-- END MAIN PANEL -->
    <!-- ==========================CONTENT ENDS HERE ========================== -->

<?php
//include required scripts
include("inc/scripts.php");
?>

    <!-- PAGE RELATED PLUGIN(S)
    <script src="..."></script>-->

    <script type="text/javascript">
        runAllForms();

        $(function() {
            // Validation
            $("#login-form").validate({
                // Rules for form validation
                rules : {
                    email : {
                        required : true,
                        email : true
                    },
                    password : {
                        required : true,
                        minlength : 3,
                        maxlength : 20
                    }
                },

                // Messages for form validation
                messages : {
                    email : {
                        required : 'Please enter your email address',
                        email : 'Please enter a VALID email address'
                    },
                    password : {
                        required : 'Please enter your password'
                    }
                },

                // Do not change code below
                errorPlacement : function(error, element) {
                    error.insertAfter(element.parent());
                }
            });
        });
    </script>

<?php
//include footer
include("inc/google-analytics.php");
?>