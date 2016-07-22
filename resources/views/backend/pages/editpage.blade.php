<?php
/**
 * Created by PhpStorm.
 * User: Amedora
 * Date: 12/19/14
 * Time: 9:59 AM
 */



//initilize the page
require_once("inc/init.php");

//require UI configuration (nav, ribbon, etc.)
require_once("inc/config.ui.php");

/*---------------- PHP Custom Scripts ---------

YOU CAN SET CONFIGURATION VARIABLES HERE BEFORE IT GOES TO NAV, RIBBON, ETC.
E.G. $page_title = "Custom Title" */

$page_title = "Edit Page";

/* ---------------- END PHP Custom Scripts ------------- */

//include header
//you can add your custom css in $page_css array.
//Note: all css files are inside css/ folder
$page_css[] = "your_style.css";
include("inc/header.php");

//include left panel (navigation)
//follow the tree in inc/config.ui.php
$page_nav["pages"]["sub"]["list"]["active"] = true;
include("inc/nav.php");

?>
    <script src="../../../js/app.config.js"></script>
    <!-- ==========================CONTENT STARTS HERE ========================== -->
    <!-- MAIN PANEL -->
    <div id="main" role="main">
    <?php
    //configure ribbon (breadcrumbs) array("name"=>"url"), leave url empty if no url
    //$breadcrumbs["New Crumb"] => "http://url.com"
    $breadcrumbs["Pages"] = "";
    include("inc/ribbon.php");
    ?>

    <!-- MAIN CONTENT -->
    <div id="content">
        <div class="row">
            <div class="col-xs-12 col-sm-7 col-md-7 col-lg-4">
                <h1 class="page-title txt-color-blueDark"><i class="fa-fw fa fa-code"></i> Pages <span>> Edit- {{$mypage[0]->title}}</span></h1>

            </div>

        </div>
        <section>
            <div class="col-xs-12 col-sm-7 col-md-7 col-lg-4">
                <div class="text-left">
                    {{HTML::decode(HTML::linkRoute('pageslisting','<span class="btn-label"><i class="glyphicon glyphicon-back"></i> Back to Pages'))}}
                </div>
            </div>
        </section>
        {{ Form::open(array('action'=>array('Backend\HomeController@postEditPage', $mypage[0]->id), 'method'=>'POST', 'class'=>'form-horizontal', 'files'=>true)) }}

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

                        <!-- widget edit box -->
                        <div class="jarviswidget-editbox">
                            <!-- This area used as dropdown edit box -->

                        </div>
                        <!-- end widget edit box -->

                        <!-- widget content -->
                        <div class="widget-body">

                            <fieldset>
                                <legend></legend>

                                @if(\Session::has('success_message'))
                                <div class="alert alert-success fade in">
                                    <button class="close" data-dismiss="alert">×</button>
                                    <i class="fa-fw fa fa-check"></i>{{Session::get('success_message')}}
                                </div>
                                @endif
                                @if(\Session::has('error_message'))
                                <div class="alert alert-danger fade in">
                                    <button class="close" data-dismiss="alert">×</button>
                                    <i class="fa-fw fa fa-check"></i>{{Session::get('error_message')}}
                                </div>
                                @endif
                                @if($errors->has("title"))
                                <div class="alert alert-danger fade in">
                                    <button class="close" data-dismiss="alert">×</button>
                                    <i class="fa-fw fa fa-times"></i>{{$errors->first("title",":message")}}

                                </div>

                                @endif
                                @if($errors->has("permalink"))
                                <div class="alert alert-danger fade in">
                                    <button class="close" data-dismiss="alert">×</button>
                                    <i class="fa-fw fa fa-times"></i>{{$errors->first("permalink",":message")}}

                                </div>

                                @endif
                                @if($errors->has("p_content"))
                                <div class="alert alert-danger fade in">
                                    <button class="close" data-dismiss="alert">×</button>
                                    <i class="fa-fw fa fa-times"></i>{{$errors->first("p_content",":message")}}
                                </div>

                                @endif

                                <div class="form-group">
                                    <label class="col-md-1 control-label">Title</label>
                                    <div class="col-md-11">
                                        <input class="form-control" placeholder="New Page Title" id="title" name="title" type="text" value="{{$mypage[0]->title}}" autocomplete="off">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-1 control-label">Url</label>
                                    <div class="col-md-11">
                                        <input class="form-control" placeholder="Page Url" id="permalink" name="permalink" value="{{$mypage[0]->permalink}}" type="text" readonly>
                                    </div>
                                </div>
                            </fieldset>


                            <input type="hidden" id="type" name="type" value="page">

                        </div>
                        <!-- end widget content -->

                        <!-- widget content -->
                        <div class="widget-body">


                            <textarea id="p_content" name="p_content">{{$mypage[0]->p_content}}</textarea>

                        </div>
                        <!-- end widget content -->

                        <div class="widget-body">
                            <div class="col-sm-12">

                                <fieldset>
                                    <legend>Meta Setting</legend>
                                    <div class="form-group">
                                        <label >Meta Title</label>

                                        <textarea id="meta_title" name="meta_title" class="form-control" placeholder="Title" rows="4">{{$mypage[0]->meta_title}}</textarea>

                                    </div>
                                    <div class="form-group">
                                        <label class="">Meta Keyword</label>

                                        <textarea id="meta_keyword" name="meta_keyword" class="form-control" placeholder="Keyword" rows="4">{{$mypage[0]->meta_keyword}}</textarea>

                                    </div>
                                    <div class="form-group">
                                        <label class="">Meta Description</label>

                                        <textarea class="form-control" placeholder="Description" rows="4" name="meta_description" id="meta_description">{{$mypage[0]->meta_description}}</textarea>

                                    </div>
                                </fieldset>

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



                        <!-- widget content -->
                        <div class="widget-body">

                            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                                <div class="form-group">
                                    <button type="submit" class="btn btn-primary"><i class="fa fa-cog"></i>Save &amp; Publish</button>
                                    <!--<a class="btn btn-primary" href="javascript:void(0);"><i class="fa fa-cog"></i> Save &amp; Publish</a>-->

                                </div>
                                <hr>

                                <div class="form-group">
                                    <label>Select Parent</label>
                                    <select class="form-control" id="parent_id" name="parent_id">
                                        <option value="">--SELECT PARENT PAGE--</option>
                                        @foreach($pages as $page)
                                        @if($page->parent_id == $mypage[0]->id)
                                        <option value="{{$page->id}}" selected>{{$page->title}}</option>
                                        @else
                                        <option value="{{$page->id}}">{{$page->title}}</option>
                                        @endif

                                        @endforeach

                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>Select Layout</label>
                                    <select class="form-control" id="layout" name="layout">
                                        <option>default</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <div class="col-md-6" style="margin: 0; padding: 0">
                                        <input class="form-control" id="sortorder" name="sortorder" value="{{$mypage[0]->sortorder}}" placeholder="Sort Order" type="text">
                                    </div>
                                    <div class="col-md-6" >
                                        <label class="checkbox-inline">
                                            <input type="checkbox" id="view_status" name="view_status"
                                            @if($mypage[0]->view_status == "hidden")
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

                <div class="jarviswidget jarviswidget-sortable" id="wid-id-14" data-widget-load="ajax/demowidget.php" data-widget-colorbutton="false" data-widget-editbutton="false" data-widget-togglebutton="false" data-widget-deletebutton="false" data-widget-fullscreenbutton="false" data-widget-custombutton="false" role="widget">

                    <header role="heading" class=""><div class="jarviswidget-ctrls" role="menu"><a href="javascript:void(0);" class="button-icon jarviswidget-refresh-btn" data-loading-text="&nbsp;&nbsp;Loading...&nbsp;" rel="tooltip" title="" data-placement="bottom" data-original-title="Refresh"><!--<i class="fa fa-refresh"></i>--></a>     </div>
                        <h2><strong>Media</strong> <i></i></h2></header>

                    <!-- widget div-->
                    <div role="content" class="">



                        <!-- widget content -->
                        <div class="widget-body">
                            <h4>Featured Image</h4>

                            <div class="col-md-12" style="margin: 0; padding: 0">
                                <div id="imgg" style="background-color: #c3c3c3; padding: 10px; text-align: center">
                                    <?php
                                    if($mypage[0]->image !=""){
                                        echo "<img alt='' src='".ASSETS_URL.'/uploads/images/'.$mypage[0]->image."' width='100' height='100' />";
                                    }

                                    else{
                                        echo "<i class='fa fa-camera fa-5x'></i>";
                                    }
                                    ?>
                                </div>
                                <a class="inline2" href="#inline_content2" >Browse</a>

                                <input type="hidden" id="image" name="image" value="{{$mypage[0]->image}}">

                            </div>
                            <hr>
                            <p>&nbsp;</p>
                            <h4>Video Url</h4>
                            <div class="col-12 col-md-12 col-lg-12">
                                <div class="form-group">
                                    <input class="form-control" id="video" name="video" placeholder="https://vimeo.com/78468485" type="text" value="{{$mypage[0]->video}}">
                                </div>
                            </div>

                            <hr>
                            <p>&nbsp;</p>
                            <h4>Document <small>(.PDF,.DOC,.DOCX)</small></h4>
                            <div class="col-12 col-md-12 col-lg-12">


                                <div class="form-group">

                                    <div >
                                        <input type="file" id="document" name="document" class="btn btn-default">
                                        <input type="hidden" id="olddocument" name="olddocument" value="{{$mypage[0]->document}}"
                                        <p class="help-block">
                                            Upload document here.
                                        </p>
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
            //CKEDITOR.replace( 'p_content', { height: '380px', startupFocus : true} );
            CKEDITOR.replace( 'p_content',
                {
                    height: '380px', startupFocus : true,
                    filebrowserBrowseUrl :'<?php echo ASSETS_URL; ?>/js/plugin/ckeditor/filemanager/browser/default/browser.html?Connector=<?php echo ASSETS_URL; ?>/js/plugin/ckeditor/filemanager/connectors/php/connector.php',
                    filebrowserImageBrowseUrl : '<?php echo ASSETS_URL; ?>/js/plugin/ckeditor/filemanager/browser/default/browser.html?Type=Image&amp;Connector=<?php echo ASSETS_URL; ?>/js/plugin/ckeditor/filemanager/connectors/php/connector.php',
                    filebrowserFlashBrowseUrl :'<?php echo ASSETS_URL; ?>/js/plugin/ckeditor/filemanager/browser/default/browser.html?Type=Flash&amp;Connector=<?php echo ASSETS_URL; ?>/js/plugin/ckeditor/filemanager/connectors/php/connector.php',
                    filebrowserUploadUrl  :'<?php echo ASSETS_URL; ?>/js/plugin/ckeditor/filemanager/connectors/php/upload.php?Type=File',
                    filebrowserImageUploadUrl : '<?php echo ASSETS_URL; ?>/js/plugin/ckeditor/filemanager/connectors/php/upload.php?Type=Image',
                    filebrowserFlashUploadUrl : '<?php echo ASSETS_URL; ?>/js/plugin/ckeditor/filemanager/connectors/php/upload.php?Type=Flash'
                }
            );
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