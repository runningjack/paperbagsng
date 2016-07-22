<?php
/**
 * Created by PhpStorm.
 * User: Amedora
 * Date: 1/1/15
 * Time: 7:11 AM
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
$page_nav["frontend"]["sub"]["pageblock"]["active"] = true;
include("inc/nav.php");

?>
    <script src="../../../js/app.config.js"></script>
    <!-- ==========================CONTENT STARTS HERE ========================== -->
    <!-- MAIN PANEL -->
    <div id="main" role="main">
    <?php
    //configure ribbon (breadcrumbs) array("name"=>"url"), leave url empty if no url
    //$breadcrumbs["New Crumb"] => "http://url.com"
    $breadcrumbs["pageblock"] = "";
    include("inc/ribbon.php");
    ?>

    <!-- MAIN CONTENT -->
    <div id="content">
    <div class="row">
        <div class="col-xs-12 col-sm-7 col-md-7 col-lg-4">
            <h1 class="page-title txt-color-blueDark"><i class="fa-fw fa fa-code"></i> Pageblock <span>> Add New</span></h1>

        </div>

    </div>
    <section>
        <div class="col-xs-12 col-sm-7 col-md-7 col-lg-4">
            <div class="text-left">
                {{HTML::decode(HTML::linkRoute('pgblock','<span class="btn-label"><i class="glyphicon glyphicon-back"></i> Back to Listing'))}}
            </div>
        </div>
    </section>
    {{ Form::open(array('action'=>array('Backend\HomeController@getAddPageBlock'), 'method'=>'POST', 'class'=>'form-horizontal', 'files'=>true)) }}

    <div class="row">
    <div class="col-sm-9">

        <div class="jarviswidget jarviswidget-color-darken jarviswidget-sortable" id="wid-id-2" data-widget-editbutton="false" data-widget-colorbutton="false" data-widget-deletebutton="false" data-widget-fullscreenbutton="false" role="widget" style="">

            <header role="heading"><div class="jarviswidget-ctrls" role="menu">   <a href="javascript:void(0);" class="button-icon jarviswidget-toggle-btn" rel="tooltip" title="" data-placement="bottom" data-original-title="Collapse"><i class="fa fa-minus"></i></a>  </div>
                <span class="widget-icon"> <i class="fa fa-arrows-v"></i> </span>
                <h2 class="font-md"><strong>Set </strong> <i>Content</i></h2>

                <span class="jarviswidget-loader" style="display: none;"><i class="fa fa-refresh fa-spin"></i></span>
            </header>

            <!-- widget div-->

            <div role="content" style="display: block;">



                <!-- widget content -->
                <div class="widget-body">


                    <fieldset>
                        <legend></legend>

                        @if(Session::has('success_message'))
                        <div class="alert alert-success fade in">
                            <button class="close" data-dismiss="alert">×</button>
                            <i class="fa-fw fa fa-check"></i>{{Session::get('success_message')}}
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
                            <label class="col-md-2 control-label">Title</label>
                            <div class="col-md-10">
                                <input class="form-control" placeholder="title" id="title" name="title" value="" type="text" required="required" autocomplete="off">
                            </div>
                        </div>



                        <hr>
                    </fieldset>
                    <fieldset>


                                    <textarea id="mymarkdown" name="description" class="custom-scroll" style="max-height:180px;" required></textarea>



                    </fieldset>

                    <input type="hidden" id="type" name="type" value="pageblock">

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
                <h2><strong>Block</strong> <i> Sttings</i></h2>

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
                                <input type="checkbox" id="status" name="status" class="checkbox style-0">
                                <span>Active</span>
                            </label>
                        </div>

                        <div class="form-group">
                            <label>Select Link</label>

                            <select class="form-control" id="parent_id" name="parent_id">
                                <option value="">--SELECT PARENT PAGE--</option>
                                @foreach($pages as $page)
                                <option value="{{$page->id}}">{{$page->title}}</option>
                                @endforeach

                            </select>
                            </div>


                        <div class="form-group" >
                            <label class="input">Sort Order

                                <input type="text" id="sortorder" name="sortorder" placeholder="sort order" class="form-control " autocomplete="off">


                            </label>

                        </div>
                        <div class="form-group" >
                            <label class="input">Enternal Link
                                <div class="input-group ">
                                    <span class="input-group-addon"><i class="fa fa-link"></i></span>
                                    <input type="text" id="permalink" name="permalink" placeholder="http://" class="form-control " autocomplete="off">

                                </div>
                            </label>

                        </div>
                        <hr>


                        <div class="form-group">
                            <label class="col-md-2 control-label">Inline</label>
                            <div class="col-md-10">
                                <label class="checkbox-inline">
                                    <input type="checkbox" class="checkbox style-0" name="home-top" value="home top">
                                    <span>Home Top</span>
                                </label>
                                <label class="checkbox-inline">
                                    <input type="checkbox" class="checkbox style-0" name="home-bottom" value="home bottom">
                                    <span>Home Bottom</span>
                                </label>
                                <label class="checkbox-inline">
                                    <input type="checkbox" class="checkbox style-0" name="inner-top" value="inner top">
                                    <span>Inner Top</span>
                                </label>
                                <label class="checkbox-inline">
                                    <input type="checkbox" class="checkbox style-0" name="inner-bottom" value="inner bottom">
                                    <span>Inner Bottom</span>
                                </label>
                                <label class="checkbox-inline">
                                    <input type="checkbox" class="checkbox style-0" name="sidebar-left" value="sidebar left">
                                    <span>Side Bar Left</span>
                                </label>
                                <label class="checkbox-inline">
                                    <input type="checkbox" class="checkbox style-0" name="sidebar-right" value="sidebar right">
                                    <span>Side Bar Right</span>
                                </label>
                                <label class="checkbox-inline">
                                    <input type="checkbox" class="checkbox style-0" name="footer" value="footer" >
                                    <span>Footer</span>
                                </label>
                                <input type="hidden" name="action" value="new">
                                <input type="hidden" name="type" value="page block">
                            </div>
                        </div>

                        <hr>

                        </div>



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

    <section id="widget-grid">
        <article class="col-sm-12 col-md-12 col-lg-12 sortable-grid ui-sortable">

            <!-- Widget ID (each widget will need unique ID)-->
            <!--End of widject -->

            <div class="jarviswidget well transparent" id="wid-id-9" data-widget-colorbutton="false" data-widget-editbutton="false" data-widget-togglebutton="false" data-widget-deletebutton="false" data-widget-fullscreenbutton="false" data-widget-custombutton="false" data-widget-sortable="false" role="widget" style="">
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
                <header role="heading">
                    <span class="widget-icon"> <i class="fa fa-comments"></i> </span>
                    <h2>Accordions </h2>

                    <span class="jarviswidget-loader"><i class="fa fa-refresh fa-spin"></i></span></header>

                <!-- widget div-->
                <div role="content">

                    <!-- widget edit box -->
                    <div class="jarviswidget-editbox">
                        <!-- This area used as dropdown edit box -->

                    </div>

                    <div class="widget-body">
                        <h4>Image Size w:940px by h:417px</h4>
                        {{ Form::open(array('action'=>array('Backend\HomeController@postSlideHome', 'pageblockimage'), 'method'=>'POST', 'class'=>'dropzone', 'id'=>'mydropzone')) }}
                        {{-- Form::open(array('url'=>'backend/sliders/index/', 'method'=>'POST', 'class'=>'dropzone', 'id'=>'mydropzone' )) --}}<!--<form action="upload.php" class="dropzone" id="mydropzone">-->

                        </form>

                    </div>
                </div>
            </div>
        </article>
    </section>

    <p>&nbsp;</p>

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
    <script src="<?php echo ASSETS_URL; ?>/js/plugin/markdown/markdown.min.js"></script>
    <script src="<?php echo ASSETS_URL; ?>/js/plugin/markdown/to-markdown.min.js"></script>
    <script src="<?php echo ASSETS_URL; ?>/js/plugin/markdown/bootstrap-markdown.min.js"></script>
    <script src="<?php echo ASSETS_URL; ?>/js/plugin/dropzone/dropzone.min.js"></script>

    <script>


        $(document).ready(function() {

            Dropzone.autoDiscover = false;
            $("#mydropzone").dropzone({
                //url: "/file/post",
                addRemoveLinks : true,
                maxFilesize: 0.5,
                dictResponseError: 'Error uploading file!'
            });

            Dropzone.options.myDropzone = {
                init: function() {
                    this.on("success", function(file, responseText) {
                        // Handle the responseText here. For example, add the text to the preview element:
                        file.previewTemplate.appendChild(document.createTextNode(responseText));
                        alert(responseText)
                    });
                }
            };




            $("#mymarkdown").markdown({
                autofocus:false,
                savable:false
            })
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
                //alert("all good")
                $("#permalink").val(perma)
            })



        });

    </script>

<?php
//include footer
include("inc/google-analytics.php");
?>