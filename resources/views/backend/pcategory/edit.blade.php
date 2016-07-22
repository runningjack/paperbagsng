<?php
/**
 * Created by PhpStorm.
 * User: Amedora
 * Date: 3/12/15
 * Time: 10:11 AM
 */

//initilize the page
require_once("inc/init.php");

//require UI configuration (nav, ribbon, etc.)
require_once("inc/config.ui.php");

/*---------------- PHP Custom Scripts ---------

YOU CAN SET CONFIGURATION VARIABLES HERE BEFORE IT GOES TO NAV, RIBBON, ETC.
E.G. $page_title = "Custom Title" */

$page_title = "Modify Product Category";

/* ---------------- END PHP Custom Scripts ------------- */

//include header
//you can add your custom css in $page_css array.
//Note: all css files are inside css/ folder
$page_css[] = "your_style.css";
include("inc/header.php");

//include left panel (navigation)
//follow the tree in inc/config.ui.php
$page_nav["catalogue"]['sub']['category']['sub']['list']["active"] = false;
include("inc/nav.php");

?>
    <style>
        #mySearchContainer, #mySearchContainer2{
            z-index:5000 !important;
            width:100%;
            background-color:#fff;
            position:absolute;
            display:none;
            box-shadow: 0 0 3px #666;
            -moz-box-shadow: 0 0 3px #666;
            -webkit-box-shadow: 0 0 3px #666;
        }
        #mySearchContainer2, #mySearchContainer{
            height:200px;
            width: 350px;
            overflow:scroll
        }
        #mySearchContainer ul, #mySearchContainer2 ul{
            list-style:none;
            list-style-image:none;
            margin:0;
            padding:0;

        }
        #mySearchContainer ul li, #mySearchContainer2 ul li{
            float:left;
            color:#666666;
            padding: 5px;
            width: 100%;
            border-bottom-width: thin;
            border-bottom-style: dotted;
            border-bottom-color: #999;
        }
        #mySearchContainer ul li h3, #mySearchContainer2 ul li h3{
            font-size:11px;
        }
        .hover{
            background-color:#01A5E1;
        }

    </style>
    <!-- ==========================CONTENT STARTS HERE ========================== -->
    <!-- MAIN PANEL -->
    <div id="main" role="main" xmlns="http://www.w3.org/1999/html">
        <?php
        $breadcrumbs["Misc"] = "";
        include("inc/ribbon.php");
        ?>
        <!-- MAIN CONTENT -->
        <div id="content">
            <div class="row">
                <div class="col-xs-12 col-sm-7 col-md-7 col-lg-4">
                    <h1 class="page-title txt-color-blueDark"><i class="fa-fw fa fa-code"></i>{{$p_title}}<span>> {{$subtitle}}</span></h1>
                </div>
            </div>
            <section>
                <div class="col-xs-12 col-sm-7 col-md-7 col-lg-4">
                    <div class="text-left">
                        {{HTML::decode(HTML::linkRoute('pcategory','<span class="btn-label"><i class="glyphicon glyphicon-back"></i> Back to Listing'))}}
                    </div>
                </div>
            </section>
            {{Form::open(array('action'=>array('Backend\CatalogueController@postCategoryAddNew', $mycategory->id), 'method'=>'POST', 'class'=>'form-horizontal', 'files'=>true)) }}
            <div class="row">
                <div class="col-sm-9">
                    <div class="jarviswidget jarviswidget-color-darken jarviswidget-sortable" id="wid-id-2" data-widget-editbutton="false" data-widget-colorbutton="false" data-widget-deletebutton="false" data-widget-fullscreenbutton="false" role="widget" style="">
                        <header role="heading"><div class="jarviswidget-ctrls" role="menu">   <a href="javascript:void(0);" class="button-icon jarviswidget-toggle-btn" rel="tooltip" title="" data-placement="bottom" data-original-title="Collapse"><i class="fa fa-minus"></i></a>  </div>
                            <span class="widget-icon"> <i class="fa fa-arrows-v"></i> </span>
                            <h2 class="font-md"><strong>Set </strong> <i>Content</i></h2>

                            <!--<span class="jarviswidget-loader" style="display: none;"><i class="fa fa-refresh fa-spin"></i></span>-->
                        </header>
                        <div role="content" style="display: block;">
                            <div class="jarviswidget-editbox">
                            </div>
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
                                <div class="form-group">
                                    <label class="col-md-2 control-label">Parent Category</label>
                                    <div class="col-md-10">
                                        <input class="form-control" placeholder="New Page Title" id="title" name="parent_name" type="text"  value="{{\Input::old('parent_name')}}" autocomplete="off">
                                        <input type="hidden" id="clientid" name="parent_id" class="six" value="{{$mycategory->parent_id}}"  />
                                        <div id="mySearchContainer2" style="position: absolute;">
                                            <div id="lcpsearchinner"></div>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-md-2 control-label">Category</label>
                                    <div class="col-md-10">
                                        <input class="form-control" placeholder="New Category Title" id="title" name="title" type="text" required="required" value="{{$mycategory->title}}" autocomplete="off">
                                    </div>
                                </div>


                                <div class="form-group">
                                    <label class="col-md-2 control-label">Description</label>
                                    <div class="col-md-10">
                                        <textarea id="description" name="description">{{$mycategory->description}}</textarea>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-2 control-label">Meta Title</label>
                                    <div class="col-md-10">
                                        <textarea id="meta_title" name="meta_title" class="form-control" placeholder="Title" rows="4">{{$mycategory->meta_title}}</textarea>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-md-2 control-label">Meta Keyword</label>
                                    <div class="col-md-10">
                                        <textarea id="meta_keyword" name="meta_keyword" class="form-control" placeholder="Keyword" rows="4">{{$mycategory->meta_keyword}}</textarea>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-md-2 control-label">Meta Description</label>
                                    <div class="col-md-10">
                                        <textarea class="form-control" placeholder="Description"  rows="4" name="meta_description" id="meta_description">{{$mycategory->meta_description}}</textarea>
                                    </div>
                                </div>


                            </div>
                        </div>
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
                                        <div class="col-md-12" style="margin: 0; padding: 0">
                                            <div id="imgg" style="background-color: #c3c3c3; padding: 10px; text-align: center">
                                                @if($mycategory->image !="")

                                                <img src="{{ \Croppa::url(ASSETS_URL.'/uploads/images/thumbs/'.$mycategory->image, 100, 100)}}" >
                                                @else
                                                <i class="fa fa-camera fa-5x"></i>
                                                @endif

                                            </div>
                                            <a class='inline2' href="#inline_content2" >Browse</a>
                                            <input class="form-control" value="{{$mycategory->sort_order}}" id="sort_order" name="sort_order" placeholder="Sort Order" type="text">
                                            <input type="hidden" id="image" name="image" value="{{$mycategory->image}}">
                                            <input type="hidden" id="oldimage" name="oldimage" value="{{$mycategory->image}}">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="col-md-12">
                                            <label class="checkbox-inline">
                                                <input id="view_status" name="view_status" value="visible" class="checkbox style-0" type="checkbox"
                                                @if($mycategory->view_status == "hidden")
                                                {{ "value='hidden' checked"}}
                                                @else
                                                {{"value='visible'"}}
                                                @endif
                                                class="checkbox style-0">
                                                <span>Top</span><span class=""><small><i>Display in the top menu bar. Only works for the top parent categories.</i></small>s</span>
                                            </label>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="col-md-12">
                                            <label class="checkbox-inline">
                                                <input id="top" name="top" value="1" class="checkbox style-0" type="checkbox" @if($mycategory->top == "1")
                                                {{ "value='1' checked"}}
                                                @else
                                                {{"value='0'"}}
                                                @endif
                                                class="checkbox style-0">
                                                <span>Top</span><span class=""><small><i>Display in the top menu bar. Only works for the top parent categories.</i></small>s</span>
                                            </label>
                                        </div>
                                    </div>
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
    <!-- PAGE FOOTER -->
<?php
// include page footer
include("inc/footer.php");
?>
    <!-- END PAGE FOOTER -->

<?php
//include required scripts
include("inc/scripts.php");
\Session::flush();
?>
    <div style='display:none'>
        <div id='inline_content2' style='padding:10px; background:#fff;'>

            <ul id="myTab2" class="nav nav-tabs bordered">
                <li class="active">
                    <a href="#v1" data-toggle="tab"><i class="fa fa-fw fa-lg fa-upload"></i>Upload File</a>
                </li>
                <li>
                    <a href="#v2" data-toggle="tab"><i class="fa fa-fw fa-lg fa-camera"></i>Images</a>
                </li>
            </ul>
            <div id="myTabContent2" class="tab-content padding-10">
                <div class="tab-pane fade active" id="v1">
                    {{Form::open(array('action'=>array('Backend\CatalogueController@postCategoryAddNew', ""), 'method'=>'post', 'class'=>'form-horizontal', 'files'=>true,"onSubmit"=>"return false","enctype"=>"multipart/form-data","id"=>"MyUploadForm")) }}
                    <input name="image_file" id="imageInput" type="file" />
                    <input type="submit"  id="submit-btn" value="Upload" />
                    <img src="<?php echo ASSETS_URL ?>/img/loading.gif" id="loading-img" style="display:none;" alt="Please Wait"/>
                    </form>
                    <div id="progressbox" style="display:none;"><div id="progressbar"></div><div id="statustxt">0%</div></div>
                    <div id="output">

                    </div>
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

                            <a href="#" class="btn btn-img btn-primary">Set As Setting</a>
                        </div>
                    </div>
                </div>
            </div>




        </div>
    </div>
    <!-- PAGE RELATED PLUGIN(S)

<script src="<?php echo ASSETS_URL; ?>/js/plugin/YOURJS.js"></script>-->
    <script src="<?php echo ASSETS_URL; ?>/js/plugin/ckeditor/ckeditor.js"></script>
    <script src="<?php echo ASSETS_URL; ?>/js/jquery.form.min.js"></script>
    <script src="<?php echo ASSETS_URL; ?>/js/plugin/colorbox/jquery.colorbox.js"></script>

    <script>

        $(document).ready(function() {
            $(".select2-results li div.select2-result-label").each(function(){
                $(this).click(function(){
                    console.log($(this).val())
                })
            })

            CKEDITOR.replace( 'description',
                {
                    height: '250px', startupFocus : true,
                    filebrowserBrowseUrl :'<?php echo ASSETS_URL; ?>/js/plugin/ckeditor/filemanager/browser/default/browser.html?Connector=<?php echo ASSETS_URL; ?>/js/plugin/ckeditor/filemanager/connectors/php/connector.php',
                    filebrowserImageBrowseUrl : '<?php echo ASSETS_URL; ?>/js/plugin/ckeditor/filemanager/browser/default/browser.html?Type=Image&amp;Connector=<?php echo ASSETS_URL; ?>/js/plugin/ckeditor/filemanager/connectors/php/connector.php',
                    filebrowserFlashBrowseUrl :'<?php echo ASSETS_URL; ?>/js/plugin/ckeditor/filemanager/browser/default/browser.html?Type=Flash&amp;Connector=<?php echo ASSETS_URL; ?>/js/plugin/ckeditor/filemanager/connectors/php/connector.php',
                    filebrowserUploadUrl  :'<?php echo ASSETS_URL; ?>/js/plugin/ckeditor/filemanager/connectors/php/upload.php?Type=File',
                    filebrowserImageUploadUrl : '<?php echo ASSETS_URL; ?>/js/plugin/ckeditor/filemanager/connectors/php/upload.php?Type=Image',
                    filebrowserFlashUploadUrl : '<?php echo ASSETS_URL; ?>/js/plugin/ckeditor/filemanager/connectors/php/upload.php?Type=Flash'
                }
            );
            // PAGE RELATED SCRIPTS

            $("#title").keyup(function(){
                var input= $("#title");
                $("#mySearchContainer2").slideDown(200);
                $("#mySearchContainer2").html("<div style='width:150px; margin:25px auto;'>Loading Content...  <img src='<?php echo  ASSETS_URL ?>/img/loading.gif'   height='20' /></div>");

                if(input.val() !="" ){
                    $.ajax({
                        type:"get",
                        url:"addnew",
                        data:"input="+input.val(),
                        success: function(outpt){
                            //console.log(outpt)
                            if(outpt.length > 6){
                                $("#mySearchContainer2").html(outpt);

                                $("#mySearchContainer2 ul li").mouseover(function(){
                                    $("#mySearchContainer2 ul li").removeClass("hover");
                                    $(this).addClass("hover");

                                })

                                $("#mySearchContainer2 ul li").each(function(){
                                    $(this).on("mousedown",function(){
                                        //$("#mySearchContainer div.sch").each(function(){
                                        var searchdata = $(this).find("div.sch").html();
                                        var hidfid = $(this).find("div.divvid").attr("vid");
                                        var dress = $(this).find("div.divvid").attr("dress");
                                        $("#clientid").val(hidfid);

                                        $("#title").val(searchdata);
                                        $("#dress").html(dress)
                                        $("#mySearchContainer2").slideUp(200);
                                        //});
                                    })
                                })

                            }else{
                                $("#mySearchContainer2").slideUp(200);
                            }}
                    })
                }else{
                    $("#mySearchContainer2").slideUp(200);
                }

            });

            $(".inline2").colorbox({inline:true, width:"80%",height:"80%"});


            $(".radimg").each(function(){
                $(this).click(function(){
                    $("#image").val($(this).val())
                    $("#imgg").html("<img src='<?php echo ASSETS_URL ?>/uploads/images/"+$(this).val()+ "' height='100' weight='100'>")
                    return false
                })
            })

            var progressbox     = $('#progressbox');
            var progressbar     = $('#progressbar');
            var statustxt       = $('#statustxt');
            var completed       = '0%';

            var options = {
                target:   '#output',   // target element(s) to be updated with server response
                beforeSubmit:  beforeSubmit,  // pre-submit callback
                uploadProgress: OnProgress,
                success:       afterSuccess,  // post-submit callback
                resetForm: true        // reset the form after successful submit
            };

            $('#MyUploadForm').submit(function() {
                $(this).ajaxSubmit(options);
                // return false to prevent standard browser submit and page navigation
                return false;
            });

//when upload progresses
            function OnProgress(event, position, total, percentComplete)
            {
                //Progress bar
                progressbar.width(percentComplete + '%') //update progressbar percent complete
                statustxt.html(percentComplete + '%'); //update status text
                if(percentComplete>50)
                {
                    statustxt.css('color','#fff'); //change status text to white after 50%
                }
            }

//after succesful upload
            function afterSuccess(data)
            {

                $('#submit-btn').show(); //hide submit button
                $('#loading-img').hide(); //hide submit button

                var md = data.split("@@");
                $("#image").val(md[1])
                $("#imgg").html("<img src='<?php echo ASSETS_URL ?>/uploads/images/"+md[1]+ "' height='100' weight='100'>")

            }

//function to check file size before uploading.
            function beforeSubmit(){
                //check whether browser fully supports all File API
                if (window.File && window.FileReader && window.FileList && window.Blob)
                {

                    if( !$('#imageInput').val()) //check empty input filed
                    {
                        $("#output").html("Oops please load a file?");
                        return false
                    }

                    var fsize = $('#imageInput')[0].files[0].size; //get file size
                    var ftype = $('#imageInput')[0].files[0].type; // get file type

                    //allow only valid image file types
                    switch(ftype)
                    {
                        case 'image/png': case 'image/gif': case 'image/jpeg': case 'image/pjpeg':
                        break;
                        default:
                            $("#output").html("<b>"+ftype+"</b> Unsupported file type!");
                            return false
                    }

                    //Allowed file size is less than 1 MB (1048576)
                    if(fsize>1048576)
                    {
                        $("#output").html("<b>"+bytesToSize(fsize) +"</b> Too big Image file! <br />Please reduce the size of your photo using an image editor.");
                        return false
                    }

                    //Progress bar
                    progressbox.show(); //show progressbar
                    progressbar.width(completed); //initial value 0% of progressbar
                    statustxt.html(completed); //set status text
                    statustxt.css('color','#000'); //initial color of status text


                    $('#submit-btn').hide(); //hide submit button
                    $('#loading-img').show(); //hide submit button
                    $("#output").html("");
                }
                else
                {
                    //Output error to older unsupported browsers that doesn't support HTML5 File API
                    $("#output").html("Please upgrade your browser, because your current browser lacks some new features we need!");
                    return false;
                }
            }

//function to format bites bit.ly/19yoIPO
            function bytesToSize(bytes) {
                var sizes = ['Bytes', 'KB', 'MB', 'GB', 'TB'];
                if (bytes == 0) return '0 Bytes';
                var i = parseInt(Math.floor(Math.log(bytes) / Math.log(1024)));
                return Math.round(bytes / Math.pow(1024, i), 2) + ' ' + sizes[i];
            }


        })

    </script>


<?php
//include footer
include("inc/google-analytics.php");
?>