<?php
/**
 * Created by PhpStorm.
 * User: Amedora
 * Date: 12/19/14
 * Time: 1:36 PM
 */


//initilize the page
require_once("inc/init.php");

//require UI configuration (nav, ribbon, etc.)
require_once("inc/config.ui.php");

/*---------------- PHP Custom Scripts ---------

YOU CAN SET CONFIGURATION VARIABLES HERE BEFORE IT GOES TO NAV, RIBBON, ETC.
E.G. $page_title = "Custom Title" */

$page_title = "All Categories";

/* ---------------- END PHP Custom Scripts ------------- */

//include header
//you can add your custom css in $page_css array.
//Note: all css files are inside css/ folder
$page_css[] = "your_style.css";
include("inc/header.php");

//include left panel (navigation)
//follow the tree in inc/config.ui.php
$page_nav["posts"]["sub"]["categories"]["active"] = false;
include("inc/nav.php");
$breadcrumbs["Categories"] =""
?>
    <script src="../../js/app.config.js"></script>
    <!-- ==========================CONTENT STARTS HERE ========================== -->
    <!-- MAIN PANEL -->
    <div id="main" role="main">
        <?php
        //configure ribbon (breadcrumbs) array("name"=>"url"), leave url empty if no url
        //$breadcrumbs["New Crumb"] => "http://url.com"
        //$breadcrumbs["Pages"] = "";
        include("inc/ribbon.php");
        ?>

        <!-- MAIN CONTENT -->
        <div id="content">
            <div class="row">
                <div class="col-xs-12 col-sm-7 col-md-7 col-lg-4">
                    <h1 class="page-title txt-color-blueDark"><i class="fa-fw fa fa-code"></i> Categories <span>> All Listing</span></h1>
                </div>

            </div>

            <!-- widget grid -->
            <section id="widget-grid" class="">

                <!-- row -->
                <div class="row">
                    <article class="col-md-12">

                        <!-- Widget ID (each widget will need unique ID)-->
                        <div class="jarviswidget jarviswidget-color-blue" id="wid-id-2" data-widget-editbutton="false">

                            <header>
                                <span class="widget-icon"> <i class="fa fa-table"></i> </span>
                                <h2>All Categories </h2>

                            </header>

                            <!-- widget div-->
                            <div>



                                <!-- widget content -->
                                <div class="widget-body no-padding">

                                    <div class="text-right">
                                        <a href="#" id="dialog_link" class="btn btn-labeled btn-primary">
                                            <span class="btn-label"><i class="glyphicon glyphicon-plus"></i></span> Add New </a>
                                    </div>
                                    <div id="dialog_simple" title="Dialog Simple Title">
                                        <div id="msg"></div>
                                        <p>
                                        <form>

                                            <div class="row">
                                                <div class="col-md-3">
                                                    <h5>Category Title</h5>
                                                </div>
                                                <div class="col-md-9">
                                                    <section >
                                                        <input type="text" class="col-md-12" id="title" name="title"  required="required" value="">
                                                    </section>
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="col-md-3">
                                                    <h5>Url</h5>
                                                </div>
                                                <div class="col-md-9">
                                                    <section >
                                                        <input type="text" class="col-md-12"  id="permalink" name="permalink"  required="required" value="">
                                                    </section>
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="col-md-3">
                                                    <h5>Description</h5>
                                                </div>
                                                <div class="col-md-9">
                                                    <section>
                                                        <input type="hidden" id="type" name="type" value="category" >
                                                        <textarea class="form-control" id="p_content" name="p_content" placeholder="Decription" rows="4"></textarea>
                                                    </section>
                                                </div>
                                            </div>

                                        </form>
                                        </p>
                                    </div>

                                    <table class="table table-hover">
                                        <thead>
                                        <tr>
                                            <th>Sn</th>
                                            <th>Title</th>
                                            <th>Description</th>
                                            <th>Status</th>
                                            <th>Date Created</th>
                                            <th>Last Modified</th>
                                            <th>Action</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        {{--*/ $x = 1 /*--}}
                                        @foreach($categories as $category)
                                        <tr>
                                            <td>{{$x}}</td>
                                            <td>{{$category->title}}</td>
                                            <td>{{$category->description}}</td>
                                            <td>{{$category->status}}</td>
                                            <td>{{$category->created_at}}</td>
                                            <td>{{$category->updated_at}}</td>
                                           <!-- <td><a href="#">Edit</a> </td>-->
                                            <td><a href="#" data-toggle="modal" data-target="#myModal{{$category->id}}"><i class="fa fa-trash">Delete</a></i> <!-- Modal -->
                                                <div class='modal fade' id='myModal{{$category->id}}' tabindex='-1' role='dialog' aria-labelledby='myModalLabel' aria-hidden='true'>
                                                    <div class='modal-dialog'>
                                                        <div class='modal-content'>
                                                            <div class='modal-header  ' style="background-color: #3276B1; color:#fff">
                                                                <button type='button' class='close' data-dismiss='modal' aria-hidden='true'>
                                                                    &times;
                                                                </button>
                                                                <h1 class='modal-title' id='myModalLabel'>Remove Page {{$category->title}}</h1>
                                                            </div>
                                                            <div class='modal-body' id="mbody{{$category->id}}">

                                                                <div class='row' >
                                                                    <div class='col-md-12'>

                                                                        <input type="hidden" id="pgid{{$category->id}}" name="pgid" value="{{$category->id}}">

                                                                        <h2>Are you sure you want to remove <b>{{$category->title}} Category</b> from the database ?</h2>
                                                                    </div>
                                                                </div>


                                                            </div>
                                                            <div class='modal-footer'>
                                                                <button type='button' class='btn btn-default' data-dismiss='modal'>
                                                                    Cancel
                                                                </button>
                                                                <button type='button' class='btn btn-primary datadel' dal="{{$category->id}}">
                                                                    Delete
                                                                </button>
                                                            </div>
                                                        </div><!-- /.modal-content -->
                                                    </div><!-- /.modal-dialog -->
                                                </div><!-- /.modal --> </td>
                                        </tr>
                                        {{--*/ $x++ /*--}}
                                        @endforeach

                                        </tbody>
                                    </table>

                                </div>
                                <!-- end widget content -->

                            </div>
                            <!-- end widget div -->

                        </div>
                        <!-- end widget -->

                    </article>
                    <!-- WIDGET END -->

                    <!-- NEW WIDGET START -->




                    <!-- WIDGET END -->

                </div>

                <!-- end row -->

            </section>
            <!-- end widget grid -->

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
    <script src="..."></script>-->

    <script>

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
                title : "<div class='widget-header'><h4><i class='fa fa-warning'></i>Add New Category</h4></div>",
                buttons : [{
                    html : "<i class='fa fa-save'></i>&nbsp; Save",
                    "class" : "btn btn-success",
                    click : function() {
                        var request =  $.ajax({
                            url:"addnew",
                            type:"post",
                            data:{type:$("#type").val(),title:$("#title").val(),permalink:$("#permalink").val(),p_content:$("#p_content").val()},
                            dataType:"html"
                        })

                        request.done(function(data){
                            $("#msg").html(data)
                        })

                        request.fail(function(){
                            $("#msg").html('<div class="alert alert-danger fade in">'+
                            '<button class="close" data-dismiss="alert">×</button>'+
                            '<i class="fa-fw fa fa-times">Request failed: </div>')//alert()
                        })

                        //$(this).dialog("close");
                    }
                }, {
                    html : "<i class='fa fa-times'></i>&nbsp; Cancel",
                    "class" : "btn btn-default",
                    click : function() {
                        $(this).dialog("close");
                    }
                }]
            });

            $("#title").keyup(function(){

                perma = $(this).val()
                perma = perma.replace(/\s/g,"-")
                perma = perma.toLowerCase()
                //alert("all good")
                $("#permalink").val(perma)
            })

            $(".datadel").each(function(){
                $(this).click(function(){
                    var d = $(this).attr("dal")
                    //alert(d)
                    var pgid =($("#pgid"+d).val())
                    var n =$("#imgname"+d).val()
                    $("#mbody"+d).html("<img src='<?php echo ASSETS_URL;?>/img/loading.gif' style='text-align: center'> ")
                    var request =  $.ajax({
                        url:"<?php echo ASSETS_URL ?>/backend/pages/editpage/"+pgid,
                        type:"post",
                        data:{id:pgid,action:"delete"},
                        dataType:"html"
                    })
                    request.done(function(data){
                        $("#mbody"+d).html(data)

                    })
                    request.fail(function(){
                        alert("Request failed: ")
                    })
                    setInterval(function(){location.reload();  }, 3000);
                })

            })
        })

    </script>

<?php
//include footer
include("inc/google-analytics.php");
?>