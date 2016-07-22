<?php
/**
 * Created by PhpStorm.
 * User: Amedora
 * Date: 12/19/14
 * Time: 9:58 AM
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

$page_title = "All Posts";

/* ---------------- END PHP Custom Scripts ------------- */

//include header
//you can add your custom css in $page_css array.
//Note: all css files are inside css/ folder
$page_css[] = "your_style.css";
include("inc/header.php");

//include left panel (navigation)
//follow the tree in inc/config.ui.php
$page_nav["posts"]["sub"]["list"]["active"] = false;
include("inc/nav.php");
$breadcrumbs["Posts"] =""
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
                    <h1 class="page-title txt-color-blueDark"><i class="fa-fw fa fa-code"></i> Posts <span>> All Listing</span></h1>
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


                        <div class="jarviswidget jarviswidget-color-blue" id="wid-id-2" data-widget-editbutton="false">

                            <header>
                                <span class="widget-icon"> <i class="fa fa-table"></i> </span>
                                <h2>All Posts </h2>

                            </header>

                            <!-- widget div-->
                            <div>



                                <!-- widget content -->
                                <div class="widget-body no-padding">
                                    <?php if(\Session::has("message")){
                                        echo'<div class="alert alert-success alert-block">
                                        <a class="close" data-dismiss="alert" href="#">×</a>
                                        <h4 class="alert-heading">Info!</h4>';
                                        echo \Session::get("message");
                                        echo '</div>';
                                    }
                                    ?>

                                    <div class="text-right">

                    {{HTML::decode(HTML::linkRoute('addnewpost','<span class="btn-label"><i class="glyphicon glyphicon-plus"></i></span> Add New',null,array("class"=>"btn btn-labeled btn-primary")))}}
                                    </div>

                                    <table class="table table-hover">
                                        <thead>
                                        <tr>
                                            <th>Sn</th>
                                            <th>Title</th>
                                            <th>Permalink</th>
                                            <th>Status</th>
                                            <th>Category</th>
                                            <th>Date Created</th>
                                            <th>Last Modified</th>
                                            <th>Action</th>
                                            <th>s</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        {{--*/ $x = 1 /*--}}
                                        @foreach($posts as $page)
                                        <tr>
                                            <td>{{$x}}</td>
                                            <td>{{$page->title}}</td>
                                            <td>{{$page->permalink}}</td>
                                            <td>{{$page->status}}</td>
                                            <td>
                                                @if($page->parent_id != 0)
                                                    @foreach($categories as $category)
                                                        @if($category->id == $page->parent_id)
                                                            {{$category->title}}

                                                        @endif
                                                    @endforeach
                                                @else
                                                {{"Uncategorized"}}
                                                @endif
                                            </td>
                                            <td>{{$page->created_at}}</td>
                                            <td>{{$page->updated_at}}</td>
                                            <td>{{HTML::linkRoute('editpost',"Edit",$page->id)}}</td>
                                            <td><a href="#" data-toggle="modal" data-target="#myModal{{$page->id}}"><i class="fa fa-trash">Delete</a></i> <!-- Modal -->
                                                <div class='modal fade' id='myModal{{$page->id}}' tabindex='-1' role='dialog' aria-labelledby='myModalLabel' aria-hidden='true'>
                                                    <div class='modal-dialog'>
                                                        <div class='modal-content'>
                                                            <div class='modal-header  ' style="background-color: #3276B1; color:#fff">
                                                                <button type='button' class='close' data-dismiss='modal' aria-hidden='true'>
                                                                    &times;
                                                                </button>
                                                                <h1 class='modal-title' id='myModalLabel'>Remove Page {{$page->title}}</h1>
                                                            </div>
                                                            <div class='modal-body' id="mbody{{$page->id}}">

                                                                <div class='row' >
                                                                    <div class='col-md-12'>

                                                                        <input type="hidden" id="pgid{{$page->id}}" name="pgid" value="{{$page->id}}">

                                                                        <h2>Are you sure you want to remove <b>{{$page->title}}</b> from the database ?</h2>
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
\Session::flush()
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