
<style>
    ul.imglist {
        list-style-type: none;
        margin: 0;
        padding: 0;
    }

    ul.imglist li{
        float: left;
        margin-right: 10px;
        border: 5px solid #f3f3f3;
        position: relative;
        -webkit-transition: box-shadow 0.5s ease;
        -moz-transition: box-shadow 0.5s ease;
        -o-transition: box-shadow 0.5s ease;
        -ms-transition: box-shadow 0.5s ease;
        transition: box-shadow 0.5s ease;
    }
    ul.imglist li label input[type="radio"] {
        margin: 0;
        margin-top:-10px;
        margin-left: -40px;
        position: absolute;
    }

    ul.imglist li:hover {
        border: 5px solid #eee;
        cursor: pointer;
        -webkit-box-shadow: 0px 0px 7px rgba(255,255,255,0.9);
        box-shadow: 0px 0px 7px rgba(255,255,255,0.9);
    }
</style>

<?php
/**
 * Created by PhpStorm.
 * User: Amedora
 * Date: 12/19/14
 * Time: 1:35 PM
 */



//initilize the page
require_once("inc/init.php");

//require UI configuration (nav, ribbon, etc.)
require_once("inc/config.ui.php");

/*---------------- PHP Custom Scripts ---------

YOU CAN SET CONFIGURATION VARIABLES HERE BEFORE IT GOES TO NAV, RIBBON, ETC.
E.G. $page_title = "Custom Title" */

$page_title = "Edit Post";

/* ---------------- END PHP Custom Scripts ------------- */

//
$page_css[] = "your_style.css";
include("inc/header.php");

$page_nav["posts"]["sub"]["list"]["active"] = true;
include("inc/nav.php");

?>
    <script src="../../../js/app.config.js"></script>
    <!-- ==========================CONTENT STARTS HERE ========================== -->
    <!-- MAIN PANEL -->
    <div id="main" role="main">
    <?php

    $breadcrumbs["Posts"] = "";
    include("inc/ribbon.php");
    ?>

    <!-- MAIN CONTENT -->
    <div id="content">
    <div class="row">
        <div class="col-xs-12 col-sm-7 col-md-7 col-lg-4">
            <h1 class="page-title txt-color-blueDark"><i class="fa-fw fa fa-code"></i> Posts <span>> Edit Post</span></h1>

        </div>

    </div>
    <section>
        <div class="col-xs-12 col-sm-7 col-md-7 col-lg-4">
            <div class="text-left">
                {{HTML::decode(HTML::linkRoute('postslisting','<span class="btn-label"><i class="glyphicon glyphicon-back"></i> Back to Posts'))}}
            </div>
        </div>
    </section>
    {{ Form::open(array('url'=>'backend/post/editpost/'.$mypage->id, 'method'=>'POST', 'class'=>'form-horizontal', 'files'=>true)) }}
    <div class="row">
    <div class="col-sm-9">



        <div class="jarviswidget jarviswidget-color-darken jarviswidget-sortable" id="wid-id-2" data-widget-editbutton="false" data-widget-colorbutton="false" data-widget-deletebutton="false" data-widget-fullscreenbutton="false" role="widget" style="">

            <header role="heading"><div class="jarviswidget-ctrls" role="menu">   <a href="javascript:void(0);" class="button-icon jarviswidget-toggle-btn" rel="tooltip" title="" data-placement="bottom" data-original-title="Collapse"><i class="fa fa-minus"></i></a>  </div>
                <span class="widget-icon"> <i class="fa fa-arrows-v"></i> </span>
                <h2 class="font-md"><strong>Set </strong> <i>Content</i></h2>

                <span class="jarviswidget-loader" style="display: none;"><!--<i class="fa fa-refresh fa-spin"></i>--></span>
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

                        <div class="form-group">
                            <label class="col-md-1 control-label">Title</label>
                            <div class="col-md-11">
                                <input class="form-control" placeholder="New Page Title" id="title" value="{{$mypage->title}}" name="title" type="text" autocomplete="off">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-1 control-label">Url</label>
                            <div class="col-md-11">
                                <input class="form-control" placeholder="Page Url" id="permalink" value="{{$mypage->permalink}}" name="permalink" type="text" readonly>
                            </div>
                        </div>


                        <div class="form-group">
                            <label class="col-md-1 control-label">Caption</label>
                            <div class="col-md-11">
                                <textarea class="form-control"  id="description" name="description" rows="4">{{$mypage->description}}</textarea>
                            </div>
                        </div>
                    </fieldset>

                    <input type="hidden" id="created_by" name="created_by">
                    <input type="hidden" id="type" name="type" value="post">

                </div>
                <!-- end widget content -->

                <!-- widget content -->
                <div class="widget-body">

                    <textarea id="p_content" name="p_content">{{$mypage->p_content}}</textarea>

                </div>
                <!-- end widget content -->

                <div class="widget-body">
                    <ul id="myTab1" class="nav nav-tabs bordered">
                        <li class="active">
                            <a href="#s1" data-toggle="tab"><i class="fa fa-fw fa-lg fa-gears"></i>Meta Setting</a>
                        </li>
                        <li>
                            <a href="#s2" data-toggle="tab"><i class="fa fa-fw fa-lg fa-camera"></i>Media</a>
                        </li>
                    </ul>
                    <div id="myTabContent1" class="tab-content padding-10">
                        <div class="tab-pane fade in active" id="s1">
                            <div class="row">
                                <div class="col-lg-12 col-md-12 col-sm-12">
                                    <fieldset>
                                        <legend>Meta Setting</legend>
                                        <div class="">
                                            <label >Meta Title</label>
                                            <textarea id="meta_title" name="meta_title" class="form-control" placeholder="Title" rows="4"></textarea>
                                            <input type="hidden" id="audio" name="audio" value="{{$mypage->audio}}" >
                                        </div>
                                        <div class="">
                                            <label class="">Meta Keyword</label>
                                            <textarea id="meta_keyword" name="meta_keyword" class="form-control" placeholder="Keyword" rows="4"></textarea>
                                        </div>
                                        <div class="">
                                            <label class="">Meta Description</label>
                                            <textarea class="form-control" placeholder="Description" rows="4" name="meta_description" id="meta_description"></textarea>
                                        </div>
                                    </fieldset>
                                </div>
                            </div>

                        </div>
                        <div class="tab-pane fade" id="s2">

                            <p><a class='inline' href="#inline_content">Set Featured Image</a></p>
                            <div class="row smart-form">
                                <fieldset><legend> Upload Audio File</legend>
                                    <label class="help-block bg-color-blueDark txt-color-white">File must not be more than 100mb</label>
                                    <label class="input input-file">
                                <span class="button">

                                    <input class=""  type="file" name="file_audio" id="file_audio" onchange="document.getElementById('signatory_signature').value = this.value" accept="audio/*">Browse</span>
                                        <input class="" placeholder="Upload audio file " type="text" id="signatory_signature" name="signatory_signature" readonly="" value="">
                                    </label>
                                    <p><a class='inline2' href="#inline_content2">Select audio file from media store</a></p>
                                </fieldset>

                            </div>
                            <div class="row smart-form">
                                <fieldset><legend>Video</legend>
                                    <label class="help-block bg-color-blueDark txt-color-white">Insert a YouTube URL here</label>
                                    <label class="input input-file">
                                        <input class=""  type="text" placeholder="http://www.youtube.com/watch?v=UCOC1YwNwZw" name="video" id="video" value="{{$mypage->video}}" >
                                    </label>
                                </fieldset>

                            </div>
                            <div style='display:none'>
                                <div id='inline_content' style='padding:10px; background:#fff;'>

                                    <ul id="myTab2" class="nav nav-tabs bordered">
                                        <li class="active">
                                            <a href="#v1" data-toggle="tab"><i class="fa fa-fw fa-lg fa-upload"></i>Upload File</a>
                                        </li>
                                        <li>
                                            <a href="#v2" data-toggle="tab"><i class="fa fa-fw fa-lg fa-camera"></i>Images</a>
                                        </li>
                                    </ul>
                                    <div id="myTabContent2" class="tab-content padding-10">
                                        <div class="tab-pane fade" id="v1">
                                            <!-- The fileinput-button span is used to style the file input field as button -->
                                            <span class="btn btn-success fileinput-button">
                                                <i class="glyphicon glyphicon-plus"></i>
                                                <span>Add files...</span>
                                                <!-- The file input field used as target for the file upload widget -->
                                                <input id="fileupload" type="file" name="files" name="files[]" multiple >
                                            </span>
                                            <br>
                                            <br>
                                            <!-- The global progress bar -->
                                            <div id="progress" class="progress">
                                                <div class="progress-bar progress-bar-success"></div>
                                            </div>
                                            <!-- The container for the uploaded files -->
                                            <div id="files" class="files"></div>
                                            <br>
                                       </div>
                                        <div class="tab-pane fade" id="v2">
                                            <div id="mmd">
                                                <h3>Images</h3>
                                                <?php
                                                //Open images directory
                                                $dir = opendir("./uploads/images/");

                                                //List files in images directoryb
                                                while (($file = readdir($dir)) !== false) {
                                                    if(substr( $file, -3 ) == "jpg" || substr( $file, -3 ) == "png" || substr( $file, -3 ) == "JPG" ) {
                                                        $filelist[] = $file;

                                                    }
                                                }
                                                closedir($dir);
                                                sort($filelist);
                                                echo "<ul class='imglist'>";
                                                for($i=0; $i<count($filelist); $i++) {
                                                    echo "
                                                                    <li><label><input class='form-control radio radimg' type='radio' id='input$i' name='inpute' value='$filelist[$i]'><img
                                                                         src='".ASSETS_URL."/uploads/images/".$filelist[$i] ."' width='100' height='100'></label></li>
                                                            ";
                                                }
                                                echo "</ul>";
                                                ?>
                                            </div>
                                            <br clear="all">
                                            <div class="row">
                                                <div class="col-lg-6 col-md-6">
                                                    <p>&nbsp;</p>
                                                    <div class="form-group">
                                                        <input type="hidden" id="image" name="image" value="">
                                                        <input placeholder="image title" type="text" class="form-control input" name="img_title" id="img_title">
                                                    </div>
                                                    <div class="form-group">
                                                        <textarea id="img_description" placeholder="description" class="form-control" rows="4" name="img_description"></textarea>
                                                    </div>
                                                    <a href="#" class="btn btn-img btn-primary">Set As Setting</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- end widget div -->
        </div>
    </div>
    <div class="col-sm-3">
        <div class="jarviswidget jarviswidget-sortable" id="wid-id-12" data-widget-load="ajax/demowidget.php" data-widget-colorbutton="false" data-widget-editbutton="false" data-widget-togglebutton="false" data-widget-deletebutton="false" data-widget-fullscreenbutton="false" data-widget-custombutton="false" role="widget">
            <header role="heading" class=""><div class="jarviswidget-ctrls" role="menu"><a href="javascript:void(0);" class="button-icon jarviswidget-refresh-btn" data-loading-text="&nbsp;&nbsp;Loading...&nbsp;" rel="tooltip" title="" data-placement="bottom" data-original-title="Refresh"><i class="fa fa-refresh"></i></a>     </div>
                <h2><strong>Publish &amp;</strong> <i>Page Sttings</i></h2>
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
                            <label>Select Layout</label>
                            <select class="form-control" id="layout" name="layout">
                                <option>default</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <div class="col-md-6" style="margin: 0; padding: 0">
                                <input class="form-control" id="sortorder" name="sortorder" value="{{$mypage->sortorder}}" placeholder="Sort Order" type="text">
                            </div>
                            <div class="col-md-6" >
                                <label class="checkbox-inline">
                                    <input type="checkbox" id="view_status" name="view_status"
                                    @if($mypage->view_status == "hidden")
                                    {{ "value='hidden' checked"}}
                                    @else
                                    {{"value='visible'"}}
                                    @endif
                                    class="checkbox style-0">
                                    <span>Hide</span>
                                </label>
                            </div>
                        </div>
                        <hr>
                    </div>
                </div>
                <!-- end widget content -->
            </div>
            <!-- end widget div -->
        </div>
        <div class="jarviswidget jarviswidget-sortable" id="wid-id-13" data-widget-load="ajax/demowidget.php" data-widget-colorbutton="false" data-widget-editbutton="false" data-widget-togglebutton="false" data-widget-deletebutton="false" data-widget-fullscreenbutton="false" data-widget-custombutton="false" role="widget">
            <header role="heading" class=""><div class="jarviswidget-ctrls" role="menu"><a href="javascript:void(0);" class="button-icon jarviswidget-refresh-btn" data-loading-text="&nbsp;&nbsp;Loading...&nbsp;" rel="tooltip" title="" data-placement="bottom" data-original-title="Refresh"><!--<i class="fa fa-refresh"></i>--></a>     </div>
                <h2><strong>Categories</strong> <i></i></h2>
                <span class="jarviswidget-loader" style="display: none;"><i class="fa fa-refresh fa-spin"></i></span></header>
            <!-- widget div-->
            <div role="content" class="">
                <!-- widget edit box -->
                <div class="jarviswidget-editbox">
                    <!-- This area used as dropdown edit box -->
                </div>
                <!-- end widget edit box -->
                <!-- widget content -->
                <div class="widget-body">
                    @foreach($categories as $category)
                    <div class="radio">
                        <label>
                            <input type="radio" class="radiobox style-0 rd" data="{{$category->title}}" id="{{$category->id}}" @if($category->id == $mypage->parent_id){{"checked"}} @endif name="parent_id"  value="{{$category->id}}" >
                            <span>{{$category->title}}</span>
                        </label>
                    </div>


                    <!--<div class="form-group">
                        <div class="col-md-6" style="margin: 0; padding: 0">
                            <label class="radio">
                                <input type="radio" id="parent_id" name="parent_id" value="" class="radio smart-style-1">
                                <span></span>
                            </label>
                        </div>
                    </div>-->
                    @endforeach
<hr>
                    <div id="eventpanel" style="display: none">
                        <div class="row">
                            <div class="col-lg-5 col-md-5 col-sm-12 col-xs-12 ">
                                Start Date:
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 ">
                                <div class="form-group">
                                    <input class="form-control" placeholder="Stock price date from" type="text" name="start_date" value="{{date_format(date_create($mypage->start_date),'Y-m-d')}}" id="from">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-5 col-md-5 col-sm-12 col-xs-12 ">
                                End Date:
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 hidden-mobile">
                                <div class="form-group ">
                                    <input class="form-control" placeholder="Stock price date to" type="text" name="end_date" value="{{date_format(date_create($mypage->end_date),'Y-m-d')}}" id="to">
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-lg-5 col-md-5 col-sm-12 col-xs-12 ">
                                Time From:
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 ">
                                <div class="form-group">
                                    <input class="form-control" placeholder="Stock price date from" type="text" name="start_time" value="{{$mypage->start_time}}" id="timefrom">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-5 col-md-5 col-sm-12 col-xs-12 ">
                                Time to:
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 hidden-mobile">
                                <div class="form-group ">
                                    <input class="form-control" placeholder="Stock price date to" type="text" name="end_time" value="{{$mypage->end_time}}" id="timeto">
                                </div>
                            </div>
                        </div>

                        <div class="row smart-form">
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 ">
                                Venue
                            </div>
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                <textarea rows="2" id="venue" name="venue" class="form-control">{{$mypage->venue}}</textarea>
                            </div>
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

    <!-- Display none -->
    <div style='display:none'>
        <div id='inline_content2' style='padding:10px; background:#fff;'>
            <form id="aud"  enctype="multipart/form-data">
                <ul id="myTab3" class="nav nav-tabs bordered">
                    <li class="active">
                        <a href="#z1" data-toggle="tab"><i class="fa fa-fw fa-lg fa-upload"></i>Upload File</a>
                    </li>
                    <li>
                        <a href="#z2" data-toggle="tab"><i class="fa fa-fw fa-lg fa-camera"></i>Images</a>
                    </li>
                </ul>
                <div id="myTabContent3" class="tab-content padding-10">
                    <div class="tab-pane fade" id="z1">
                        <!-- The fileinput-button span is used to style the file input field as button -->

                        <!-- The file input field used as target for the file upload widget -->
                        <br>
                        <br>
                        <!-- The global progress bar -->
                        <div id="progress2" class="progress">
                            <div class="progress-bar progress-bar-success"></div>
                        </div>
                        <!-- The container for the uploaded files -->
                        <div id="files2" class="files"></div>
                        <br>
                    </div>
                    <div class="tab-pane fade" id="z2">
                        <div id="mmd2">
                            <h3>Audios</h3>
                            <?php
                            //Open images directory
                            $dir2 = opendir("./uploads/audios/");

                            //List files in images directoryb
                            while (($file2 = readdir($dir2)) !== false) {
                                if(substr( $file2, -3 ) == "mp3" || substr( $file2, -3 ) == "MP3"  ) {
                                    $filelist2[] = $file2;
                                }
                            }
                            closedir($dir2);
                            if(isset($filelist2)){
                                sort($filelist2);
                                echo "<ul class='imglist'>";
                                for($i=0; $i<count($filelist2); $i++) {
                                    echo "
                                                                    <li>
                                                                        <label>
                                                                            <input class='form-control radio radaudio' type='radio' id='input$i' name='inpute' value='$filelist2[$i]'><img
                                                                         src='".ASSETS_URL."/uploads/audios/audio.png' width='100' height='100'></label></li>
                                                                    ";
                                }
                                echo "</ul>";
                            }
                            ?>
                        </div>
                        <br clear="all">
                        <div class="row">
                            <div class="col-lg-6 col-md-6">
                                <p>&nbsp;</p>
                                <div class="form-group">
                                    <input placeholder="Audio title" type="text" class="form-control input" name="audio_title" id="audio_title">
                                </div>
                                <div class="form-group">
                                    <textarea id="audio_description" placeholder="description" class="form-control" rows="4" name="audio_description"></textarea>
                                </div>
                                <a href="#" class="btn btn-img btn-primary">Set As Setting</a>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <!-- End of display none -->
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

    <!-- PAGE RELATED PLUGIN(S)-->

    <script src="<?php echo ASSETS_URL; ?>/js/plugin/ckeditor/ckeditor.js"></script>
<script src="<?php echo ASSETS_URL; ?>/js/load-image.all.min.js"></script>
<script src="<?php echo ASSETS_URL; ?>/js/canvas-to-blob.min.js"></script>
<script src="<?php echo ASSETS_URL; ?>/js/jquery.iframe-transport.js"></script>
<!-- The basic File Upload plugin -->
<script src="<?php echo ASSETS_URL; ?>/js/jquery.fileupload.js"></script>
<!-- The File Upload processing plugin -->
<script src="<?php echo ASSETS_URL; ?>/js/jquery.fileupload-process.js"></script>
<!-- The File Upload image preview & resize plugin -->
<script src="<?php echo ASSETS_URL; ?>/js/jquery.fileupload-image.js"></script>
<!-- The File Upload audio preview plugin -->
<script src="<?php echo ASSETS_URL; ?>/js/jquery.fileupload-audio.js"></script>
<!-- The File Upload video preview plugin -->
<script src="<?php echo ASSETS_URL; ?>/js/jquery.fileupload-video.js"></script>
<!-- The File Upload validation plugin -->
<script src="<?php echo ASSETS_URL; ?>/js/jquery.fileupload-validate.js"></script>

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

            $(".inline").colorbox({inline:true, width:"80%",height:"80%"});
            $(".inline2").colorbox({inline:true, width:"80%",height:"80%"});
            $(".radimg").each(function(){
                $(this).click(function(){
                    $("#image").val($(this).val())
                })
            })

            $(".rd").each(function(){
                $(this).click(function(){
                    if($(this).attr("data")=="Events"){
                        $("#eventpanel").css("display","block")
                    }else{
                        $("#eventpanel").css("display","none")
                    }
                })
            })

            $(".radaudio").each(function(){
                $(this).click(function(){
                    $("#audio").val($(this).val())
                })
            })
            $(".btn-img").on("click",function(){

                $.colorbox.close()
                /*var request = $.ajax({
                 url:'addnew',
                 type:"post",
                 data:{}
                 })*/
            })

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

            $("#aud").on("submit",handleFormSubmit)

            function handleFileSelect(event)
            {
                var files = event.target.files || event.originalEvent.dataTransfer.files;
                // Itterate thru files (here I user Underscore.js function to do so).
                // Simply user 'for loop'.
                _.each(files, function(file) {
                    filesToUpload.push(file);
                });
            }

            function handleFormSubmit(event)
            {
                event.preventDefault();
                var form = this,
                    formData = new FormData(form);  // This will take all the data from current form and turn then into FormData
                jQuery.each($('input[name^="file_"]')[0].files, function(i, file) {
                    formData.append(i, file);
                });
                $.ajax({
                    type: "POST",
                    url: 'addnew',
                    data:formData ,
                    contentType: false,
                    processData: false,
                    success: function(response)
                    {
                        console.log(response)
                        //$("#mdata > tbody").append(response)
                    }
                });
            }



        });

    </script>
    <script>
        $(function () {
            'use strict';
            // Change this to the location of your server-side upload handler:
            var url = window.location.hostname === 'blueimp.github.io' ?
                    '//jquery-file-upload.appspot.com/' : 'editpost',
                uploadButton = $('<button/>')
                    .addClass('btn btn-primary')
                    .prop('disabled', true)
                    .text('Processing...')
                    .on('click', function () {
                        var $this = $(this),
                            data = $this.data();
                        $this
                            .off('click')
                            .text('Abort')
                            .on('click', function () {
                                $this.remove();
                                data.abort();
                            });
                        data.submit().always(function () {
                            $this.remove();
                        });
                    });
            $('#fileupload').fileupload({
                url: url,
                dataType: 'json',
                autoUpload: false,
                acceptFileTypes: /(\.|\/)(gif|jpe?g|png)$/i,
                maxFileSize: 5000000, // 5 MB
                // Enable image resizing, except for Android and Opera,
                // which actually support image resizing, but fail to
                // send Blob objects via XHR requests:
                disableImageResize: /Android(?!.*Chrome)|Opera/
                    .test(window.navigator.userAgent),
                previewMaxWidth: 100,
                previewMaxHeight: 100,
                previewCrop: true
            }).on('fileuploadadd', function (e, data) {
                data.context = $('<div/>').appendTo('#files');
                $.each(data.files, function (index, file) {
                    var node = $('<p/>')
                        .append($('<span/>').text(file.name));
                    if (!index) {
                        node
                            .append('<br>')
                            .append(uploadButton.clone(true).data(data));
                    }
                    node.appendTo(data.context);
                });
            }).on('fileuploadprocessalways', function (e, data) {
                var index = data.index,
                    file = data.files[index],
                    node = $(data.context.children()[index]);
                if (file.preview) {
                    node
                        .prepend('<br>')
                        .prepend(file.preview);
                }
                if (file.error) {
                    node
                        .append('<br>')
                        .append($('<span class="text-danger"/>').text(file.error));
                }
                if (index + 1 === data.files.length) {
                    data.context.find('button')
                        .text('Upload')
                        .prop('disabled', !!data.files.error);
                }
            }).on('fileuploadprogressall', function (e, data) {
                var progress = parseInt(data.loaded / data.total * 100, 10);
                $('#progress .progress-bar').css(
                    'width',
                    progress + '%'
                );
            }).on('fileuploaddone', function (e, data) {
                $.each(data.result.files, function (index, file) {
                    if (file.url) {
                        $("#mmd").load("<?php echo ASSETS_URL ?>/loadimg.php")
                        var link = $('<a>')
                            .attr('target', '_blank')
                            .prop('href', file.url);
                        $(data.context.children()[index])
                            .wrap(link);
                    } else if (file.error) {
                        var error = $('<span class="text-danger"/>').text(file.error);

                        $(data.context.children()[index])
                            .append('<br>')
                            .append(error);
                    }
                });
            }).on('fileuploadfail', function (e, data) {
                $.each(data.files, function (index) {
                    var error = $('<span class="text-danger"/>').text(''); //File upload failed.
                    $(data.context.children()[index])
                        .append('<br>')
                        .append(error);
                });
            }).prop('disabled', !$.support.fileInput)
                .parent().addClass($.support.fileInput ? undefined : 'disabled');
        });
    </script>
<?php
Session::flush();
?>
<?php
//include footer
include("inc/google-analytics.php");
?>