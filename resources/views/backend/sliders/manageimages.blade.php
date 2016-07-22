<?php
/**
 * Created by PhpStorm.
 * User: Amedora
 * Date: 12/30/14
 * Time: 1:19 PM
 */



//initilize the page
require_once("inc/init.php");

//require UI configuration (nav, ribbon, etc.)
require_once("inc/config.ui.php");

/*---------------- PHP Custom Scripts ---------

YOU CAN SET CONFIGURATION VARIABLES HERE BEFORE IT GOES TO NAV, RIBBON, ETC.
E.G. $page_title = "Custom Title" */

$page_title = "All Pages";

/* ---------------- END PHP Custom Scripts ------------- */

//include header
//you can add your custom css in $page_css array.
//Note: all css files are inside css/ folder
$page_css[] = "your_style.css";
include("inc/header.php");

//include left panel (navigation)
//follow the tree in inc/config.ui.php
$page_nav["frontend"]["sub"]["slideshow"]["sub"]["slideimage"]["active"] = false;
include("inc/nav.php");
$breadcrumbs["pages"] =""
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
                    <h1 class="page-title txt-color-blueDark"><i class="fa-fw fa fa-code"></i> Slider Images <span>> All Listing</span></h1>
                </div>

            </div>

            <!-- widget grid -->
            <section id="widget-grid" class="">

                <!-- row -->
                <div class="row">

                    <!-- NEW WIDGET START -->

                    <!-- WIDGET END -->

                    <!-- NEW WIDGET START -->
                    <article class="col-md-12">

                        <!-- Widget ID (each widget will need unique ID)-->
                        <div class="jarviswidget jarviswidget-color-blue" id="wid-id-2" data-widget-editbutton="false">
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
                                <span class="widget-icon"> <i class="fa fa-table"></i> </span>
                                <h2>All Slider Images </h2>

                            </header>

                            <!-- widget div-->
                            <div>

                                <!-- widget edit box -->
                                <div class="jarviswidget-editbox">
                                    <!-- This area used as dropdown edit box -->

                                </div>
                                <!-- end widget edit box -->

                                <!-- widget content -->
                                <div class="widget-body no-padding">


                                    <table class="table table-hover">
                                        <thead>
                                        <tr>
                                            <th>Sn</th>
                                            <th>Title</th>
                                            <th>Permalink</th>
                                            <th>Status</th>
                                            <th>Date Created</th>
                                            <th>Last Modified</th>
                                            <th>Action</th>
                                            <th></th>

                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($slideimages as $page)
                                        <tr>
                                            <td>{{$page->id}}</td>
                                            <td><span><img src="{{ASSETS_URL}}/uploads/slideshow/{{$page->img_name}}" style="width:90px; height:55px" ></span>{{$page->title}}</td>
                                            <td>{{$page->permalink}}</td>
                                            <td>{{$page->status}}</td>
                                            <td{{$page->created_at}}</td>
                                            <td>{{$page->updated_at}}</td>
                                            <td>Edi</td>
                                            <td><a href="#" data-toggle="modal" data-target="#myModal{{$page->id}}"><i class="fa fa-trash">Delete</a></i> <!-- Modal -->
                                                <div class='modal fade' id='myModal{{$page->id}}' tabindex='-1' role='dialog' aria-labelledby='myModalLabel' aria-hidden='true'>
                                                    <div class='modal-dialog'>
                                                        <div class='modal-content'>
                                                            <div class='modal-header'>
                                                                <button type='button' class='close' data-dismiss='modal' aria-hidden='true'>
                                                                    &times;
                                                                </button>
                                                                <h4 class='modal-title' id='myModalLabel'>Remove Image</h4>
                                                            </div>
                                                            <div class='modal-body' id="mbody{{$page->id}}">

                                                                <div class='row' >
                                                                    <div class='col-md-12'>
                                                                        <img src="{{ASSETS_URL}}/uploads/slideshow/{{$page->img_name}}" style="width:90px; height:55px" >
                                                                        <input type="hidden" id="pgid{{$page->id}}" name="pgid" value="{{$page->id}}">
                                                                        <input type="hidden" id="imgname{{$page->id}}" name="imgname" value="{{$page->img_name}}"
                                                                        <h2>Are you sure you want to remove {{$page->img_name}} from the database ?</h2>
                                                                    </div>
                                                                </div>


                                                            </div>
                                                            <div class='modal-footer'>
                                                                <button type='button' class='btn btn-default' data-dismiss='modal'>
                                                                    Cancel
                                                                </button>
                                                                <button type='button' class='btn btn-primary datadel' dal="{{$page->id}}">
                                                                    Delete
                                                                </button>
                                                            </div>
                                                        </div><!-- /.modal-content -->
                                                    </div><!-- /.modal-dialog -->
                                                </div><!-- /.modal --></td>
                                        </tr>
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

            $(".datadel").each(function(){
                $(this).click(function(){
                    var d = $(this).attr("dal")

                    //alert(d)
                    var pgid =($("#pgid"+d).val())
                    var n =$("#imgname"+d).val()
                    var request =  $.ajax({
                        url:"manageimages/delete",
                        type:"post",
                        data:{id:pgid,image:n},
                        dataType:"html"
                    })

                    request.done(function(data){
                        $("#mbody"+d).html(data)
                    })

                    request.fail(function(){
                        alert("Request failed: ")
                    })
                })
            })
        })

    </script>

<?php
//include footer
include("inc/google-analytics.php");
?>