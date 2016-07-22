<?php
/**
 * Created by PhpStorm.
 * User: Amedora
 * Date: 12/22/14
 * Time: 11:53 AM
 */
?>

<?php

//initilize the page
require_once("inc/init.php");

//require UI configuration (nav, ribbon, etc.)
require_once("inc/config.ui.php");

/*---------------- PHP Custom Scripts ---------

YOU CAN SET CONFIGURATION VARIABLES HERE BEFORE IT GOES TO NAV, RIBBON, ETC.
E.G. $page_title = "Custom Title" */

$page_title = "Add New";

/* ---------------- END PHP Custom Scripts ------------- */

//include header
//you can add your custom css in $page_css array.
//Note: all css files are inside css/ folder
$page_css[] = "your_style.css";
include("inc/header.php");

//include left panel (navigation)
//follow the tree in inc/config.ui.php
$page_nav["frontend"]["sub"]["menu"]["active"] = true;
include("inc/nav.php");

?>
<script src="../../js/app.config.js"></script>
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

<div class="row">


    <div id="dialog_simple" title="Dialog Simple Title">
        <div id="msg"></div>
        <p>
            {{ Form::open(array('url'=>'backend/posts/addnew/', 'method'=>'POST', 'class'=>'form-horizontal', 'files'=>true)) }}

        <div class="row">
            <div class="col-md-3">
                <h5>Menu Title</h5>
            </div>
            <div class="col-md-9">


                <div class="input-group">
                    <input type="text" name="title" placeholder="Menu title" class="form-control" >
                    <span class="input-group-addon"><i class="fa fa-ticket"></i></span>
                </div>

                <!--<p class="help-block alert-warning">
                    Select a date if date is not the same as today. If this field is empty the system assigns current date
                </p>-->
            </div>
        </div>


        <div class="row">
            <div class="col-md-3">
                <h5>Url</h5>
            </div>
            <div class="col-md-9">
                <div class="input-group">
                    <input type="hidden" id="type" name="type" value="custom menu" >
                    <input type="hidden" id="description" name="description">
                    <input type="hidden" id="p_content" name="p_content">
                    <input type="hidden" id="parent_id" name="parent_id">
                    <input type="hidden" id="meta_keyword" name="meta_keyword">
                    <input type="hidden" id="meta_description" name="meta_description">
                    <input type="hidden" id="meta_title" name="meta_title">

                    <input type="text" id="permalink" name="permalink" class="form-control input">
                    <span class="input-group-addon"><i class="fa fa-anchor"></i></span>
                    <!--<textarea class="form-control" id="description" name="description" placeholder="Decription" rows="4"></textarea>-->
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-3">

            </div>
            <div class="col-md-9">
                <section>
                    <p>&nbsp;</p>
                    <button class="btn btn-success" type="submit" id="submit" name="submit" ><i class='fa fa-save'></i> Save</button>

                </section>
            </div>
        </div>

        </form>
        </p>
    </div>

</div>
<div class="row">
    <div class="col-xs-12 col-sm-7 col-md-7 col-lg-4">
        <h1 class="page-title txt-color-blueDark"><i class="fa-fw fa fa-code"></i> Menu <span>>
Management</span></h1>

    </div>

</div>


<div class="row">
<div class="col-sm-3">

    <div class="jarviswidget jarviswidget-sortable" id="wid-id-13" data-widget-
         load="ajax/demowidget.php" data-widget-colorbutton="false" data-widget-editbutton="false" data-widget-
         togglebutton="false" data-widget-deletebutton="false" data-widget-fullscreenbutton="false" data-widget-
         custombutton="false" role="widget">

        <header role="heading" class=""><div class="jarviswidget-ctrls" role="menu"><a
                    href="javascript:void(0);" class="button-icon jarviswidget-refresh-btn" data-loading-
                    text="&nbsp;&nbsp;Loading...&nbsp;" rel="tooltip" title="" data-placement="bottom" data-original-
                    title="Refresh"><i class="fa fa-refresh"></i></a>     </div>
            <h2><strong>Categories</strong> <i></i></h2>

                    <span class="jarviswidget-loader" style="display: none;"><!--<i class="fa fa-refresh fa-
spin"></i></span>--></header>

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
                    @foreach($categories as $category)
                    <div class="checkbox">
                        <label>
                            <input type="checkbox" class="checkbox style-0 cat" data-val="{{$category->title}}?#?{{$category->id}}?#?posts/{{$category->permalink}}">
                            <span>{{$category->title}}</span>
                        </label>
                    </div>
                    @endforeach




                    <a id="addcat" class="btn btn-info">Add Categories as Menu</a>
                    <p>&nbsp;</p>
                </div>

            </div>
        </div>
        <!-- end widget div -->

    </div>

    <div class="jarviswidget jarviswidget-sortable" id="wid-id-12" data-widget-
               load="ajax/demowidget.php" data-widget-colorbutton="false" data-widget-editbutton="false" data-widget-
               togglebutton="false" data-widget-deletebutton="false" data-widget-fullscreenbutton="false" data-widget-
               custombutton="false" role="widget">

        <header role="heading" class=""><div class="jarviswidget-ctrls" role="menu"><a
                    href="javascript:void(0);" class="button-icon jarviswidget-refresh-btn" data-loading-
                    text="&nbsp;&nbsp;Loading...&nbsp;" rel="tooltip" title="" data-placement="bottom" data-original-
                    title="Refresh"><i class="fa fa-refresh"></i></a>     </div>
            <h2><strong>Pages</strong> <i></i></h2>

                    <span class="jarviswidget-loader" style="display: none;"><!--<i class="fa fa-refresh fa-
spin"></i></span>--></header>

        <!-- widget div-->
        <div role="content" class="">

            <!-- widget edit box -->
            <div class="jarviswidget-editbox">
                <!-- This area used as dropdown edit box -->

            </div>
            <!-- end widget edit box -->

            <!-- widget content -->
            <div class="widget-body">


                <a href="#" id="dialog_link" class="btn btn-labeled btn-success">
                    <span class="btn-label"><i class="glyphicon glyphicon-plus"></i></span> Add New Custom link </a>




                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                    <div class="checkbox">

                        <label>
                            <input type="checkbox" class="checkbox style-0 pg" data-val="Home?#?0?#?/">

                            <span>Home</span>
                        </label>
                    </div>
                    @foreach($pages as $page)
                    <div class="checkbox">
                        <label>
                            <input type="checkbox" class="checkbox style-0 pg" data-val="{{$page->title}}?#?{{$page->id}}?#?pages/{{$page->permalink}}">
                            <span>{{$page->title}}</span>
                        </label>
                    </div>
                    @endforeach

                    @foreach($customs as $category)
                    <div class="checkbox">
                        <label>
                            <input type="checkbox" class="checkbox style-0 pg" data-val="{{$category->title}}?#?{{$category->id}}?#?{{$category->permalink}}">
                            <span>{{$category->title}}</span>
                        </label>
                    </div>
                    @endforeach

                    <span><a id="addpag" class="btn btn-info ">Add Pages as Menu</a></span>

                    <p>&nbsp;</p>
                </div>

            </div>

        </div>
        <!-- end widget div -->

    </div>






</div>
<!-- Begin Section nine -->
<div class="col-sm-9">

<section id="widget-grid" class="">

<!-- row -->
<div class="row">

<!-- NEW WIDGET START -->
<article class="col-sm-12">

<!-- Widget ID (each widget will need unique ID)-->
<div class="jarviswidget well" id="wid-id-0">
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
<header>
    <span class="widget-icon"> <i class="fa fa-comments"></i> </span>
    <h2>My Data </h2>

</header>

<!-- widget div-->
<div>

<!-- widget edit box -->
<div class="jarviswidget-editbox">
    <!-- This area used as dropdown edit box -->

</div>
<!-- end widget edit box -->

<!-- widget content -->
<div class="widget-body">


<div class="row">

<div class="col-sm-6 col-lg-4" id="menuc">

    <h6>Menu #2</h6>
<div id="msg"></div>
    <div class="dd" id="nestable2">
        <ol class="dd-list" id="ppp">
            <?php
                if($menus){
                    echo $menus;
                }
            ?>


        </ol>
    </div>
    <p>&nbsp;</p>
    <p>&nbsp;</p>
    <div class="form-group">
        <!--<button  class="btn btn-primary"><i class="fa fa-cog"></i>Save &amp; Publish</button>-->
        <a class="btn btn-primary" id="savemenu" href="javascript:void(0);"><i class="fa fa-save"></i> Save Menu</a>

    </div>
</div>

</div>

</div>
<!-- end widget content -->

</div>
<!-- end widget div -->

</div>
<!-- end widget -->

</article>
<!-- WIDGET END -->

</div>

<!-- end row -->

<!-- row -->

            <input type="hidden" id="nestable2-output" rows="3" class="form-control font-md">




<!-- end row -->

</section>
</div>
<!-- End section nine -->
</div>


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

<!-- PAGE RELATED PLUGIN(S) -->
<script src="<?php echo ASSETS_URL; ?>/js/plugin/jquery-nestable/jquery.nestable.min.js"></script>

<script type="text/javascript">

    $(document).ready(function() {

        // PAGE RELATED SCRIPTS

        $.widget("ui.dialog", $.extend({}, $.ui.dialog.prototype, {
            _title : function(title) {
                if (!this.options.title) {
                    title.html("&#160;");
                } else {
                    title.html(this.options.title);
                }
            }
        }));
        $('#dialog_link').click(function() {
            $('#dialog_simple').dialog('open');
            return false;

        });
        $('#dialog_simple').dialog({
            autoOpen : false,
            width : 600,
            resizable : false,
            modal : true,
            title : "<div class='widget-header'><h4><i class='fa fa-warning'></i> Add New Custom Menu</h4></div>"

        });






        var updateOutput = function(e) {
            var list = e.length ? e : $(e.target), output = list.data('output');
            if (window.JSON) {
                output.val(window.JSON.stringify(list.nestable('serialize')));
                //, null, 2));
            } else {
                output.val('JSON browser support required for this demo.');
            }
        };



        // activate Nestable for list 2
        $('#nestable2').nestable({
            group : 1
        }).on('change', updateOutput);

        // output initial serialised data

        updateOutput($('#nestable2').data('output', $('#nestable2-output')));

        $("#addcat").on("click",function(){

            var pg = $(this).parents("div").find("input.cat:checked")
            $.each(pg,function(index,elem){

                var itemdata = $(this).attr("data-val");
                itemdata = itemdata.split("?#?");
                var mitem = $('<li class="dd-item" data-title="'+itemdata[0]+'" data-post="'+itemdata[1]+'" data-parent="0" data-link="'+itemdata[2]+'" ><div class="dd-handle">'+itemdata[0]+'<button data-action="Delete" type="button">Delete</button></div></li>')
                $("#ppp").append(mitem);
            })
            updateOutput($('#nestable2').data('output', $('#nestable2-output')));
        });

        $("#addpag").on("click",function(){

            var pg = $(this).parents("div").find("input.pg:checked")
            $.each(pg,function(index,elem){

                var itemdata = $(this).attr("data-val");
                itemdata = itemdata.split("?#?");
                var mitem = $('<li class="dd-item" data-title="'+itemdata[0]+'" data-post="'+itemdata[1]+'" data-parent="0" data-link="'+itemdata[2]+'" ><div class="dd-handle">'+itemdata[0]+'</div><i style="border-radius:13px; float:right; margin-top:-50px" class=" b fa fa-times-circle"></i></li>')
                $("#ppp").append(mitem);
            })
            updateOutput($('#nestable2').data('output', $('#nestable2-output')));
        });

        $("#savemenu").click(function(){
            var request = $.ajax({
                url:"index",
                type:"post",
                data: {id:2,val:$("#nestable2-output").val()},
                dataType: "html"
            });

            request.done(function(msg){
                //$("<span>updating</span>").insertAfter($(this))
                if(msg==1){
                    $("#msg").html('<div class="alert alert-success fade in"><button class="close" data-dismiss="alert">×</button><i class="fa-fw fa fa-check"></i><strong>Success</strong>  Record Saved.</div>')
                }else{
                    $("#msg").html('<div class="alert alert-danger fade in"><button class="close" data-dismiss="alert">×</button><i class="fa-fw fa fa-times b"></i><strong>Unexpected error</strong>  Record not save</div>')
                }


            });

            request.fail(function(){
                alert("Request failed: ")
            })
        })
    $("#menuc").on("click",".b",function(e){
        var mli =($(this).parents("li"))
        var id = mli.attr("data-id")
        var t = mli.attr("data-title")
        if(jQuery.type(id) === "undefined"){
           // alert(mli.attr("data-title"))
            mli.remove()
            updateOutput($('#nestable2').data('output', $('#nestable2-output')));
        }else{

            var request = $.ajax({
                url:"index",
                type:"post",
                data: {id:id,title:t,val:$("#nestable2-output").val()},
                dataType: "html"
            });

            request.done(function(msg){
                //$("<span>updating</span>").insertAfter($(this))
                updateOutput($('#nestable2').data('output', $('#nestable2-output')));
                alert(msg);
                mli.remove()
                /*if(msg==1){
                 $("#msg").html('<div class="alert alert-success fade in"><button class="close" data-dismiss="alert">×</button><i class="fa-fw fa fa-check"></i><strong>Success</strong>  Record Saved.</div>')
                 }else{
                 $("#msg").html('<div class="alert alert-danger fade in"><button class="close" data-dismiss="alert">×</button><i class="fa-fw fa fa-times b"></i><strong>Unexpected error</strong>  Record not save</div>')
                 }
                 */
                window.location.reload();

            });

            request.fail(function(){
                alert("Request failed: ")
            })
            //alert(mli.attr("data-id"))
        }


    })



    })

</script>

<?php
//include footer
include("inc/google-analytics.php");
?>





