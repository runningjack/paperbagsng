<?php
/**
 * Created by PhpStorm.
 * User: Amedora
 * Date: 12/31/14
 * Time: 4:33 AM
 */


//initilize the page
require_once("inc/init.php");

//require UI configuration (nav, ribbon, etc.)
require_once("inc/config.ui.php");

/*---------------- PHP Custom Scripts ---------

YOU CAN SET CONFIGURATION VARIABLES HERE BEFORE IT GOES TO NAV, RIBBON, ETC.
E.G. $page_title = "Custom Title" */



/* ---------------- END PHP Custom Scripts ------------- */

//include header
//you can add your custom css in $page_css array.
//Note: all css files are inside css/ folder
$page_css[] = "your_style.css";
include("inc/header.php");

//include left panel (navigation)
//follow the tree in inc/config.ui.php
$page_nav["setting"]["active"] = false;
include("inc/nav.php");
$breadcrumbs["Settings"] =""
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
                    <h1 class="page-title txt-color-blueDark"><i class="fa-fw fa fa-code"></i> Settings <span>> All Listing</span></h1>
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

                            <header>
                                <span class="widget-icon"> <i class="fa fa-table"></i> </span>
                                <h2>Settings </h2>

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
                                            <th>Name</th>
                                            <th>Description</th>
                                            <th>Value</th>
                                            <th>Date Created</th>
                                            <th>Last Modified</th>
                                            <th>Action</th>

                                        </tr>
                                        </thead>
                                        <tbody>
                                        {{--*/ $x = 1 /*--}}
                                        @foreach($settings as $page)
                                        <tr>
                                            <td>{{$x }}</td>
                                            <td>{{$page->name}}</td>
                                            <td>{{$page->description}}</td>
                                            <td>{{$page->value}}</td>
                                            <td>{{$page->created_at}}</td>
                                            <td>{{$page->updated_at}}</td>
                                           <!-- <td>{{HTML::linkRoute('editpage',"Edit",$page->id)}}</td>-->
                                            <td><a href="#" data-toggle="modal" data-target="#myModal{{$page->id}}"><i class="fa fa-trash">Change Setting Value</a></i> <!-- Modal -->
                                                <div class='modal fade' id='myModal{{$page->id}}' tabindex='-1' role='dialog' aria-labelledby='myModalLabel' aria-hidden='true'>
                                                    <div class='modal-dialog'>
                                                        <div class='modal-content'>
                                                            <div class='modal-header  ' style="background-color: #3276B1; color:#fff">
                                                                <button type='button' class='close' data-dismiss='modal' aria-hidden='true'>
                                                                    &times;
                                                                </button>
                                                                <h1 class='modal-title' id='myModalLabel'>{{$page->name}}</h1>
                                                            </div>

                                                            <div class='modal-body' id="mbody{{$page->id}}">

                                                                <div class='row' >
                                                                    <div class='col-md-12'>

                                                                        <input type="hidden" id="pgid{{$page->id}}" name="pgid" value="{{$page->id}}">


                                                                    </div>
                                                                </div>

                                                                <div class="row">
                                                                    <div class="col-md-3">
                                                                        <h5>Setting Name</h5>
                                                                    </div>
                                                                    <div class="col-md-9">
                                                                        <section >
                                                                            <input type="hidden" class="col-md-12" id="name" name="name"  value="{{$page->name}}">
                                                                            <h3>{{$page->name}}</h3>
                                                                        </section>
                                                                    </div>
                                                                </div>

                                                                <div class="row">
                                                                    <div class="col-md-3">
                                                                        <h5>Setting Value</h5>
                                                                    </div>
                                                                    <div class="col-md-9">
                                                                        <section >
                                                                            <input type="text" class="col-md-12" id="value{{$page->id}}" name="value"  required="required" value="{{$page->value}}">
                                                                        </section>
                                                                    </div>
                                                                </div>

                                                                <div class="row">
                                                                    <div class="col-md-3">
                                                                        <h5>Description</h5>
                                                                    </div>
                                                                    <div class="col-md-9">
                                                                        <section>

                                                                            <textarea class="form-control" id="description{{$page->id}}" name="description" placeholder="Decription" rows="4">{{$page->description}}</textarea>
                                                                        </section>
                                                                    </div>
                                                                </div>


                                                            </div>
                                                            <div class='modal-footer'>
                                                                <button type='button' class='btn btn-default' data-dismiss='modal'>
                                                                    Cancel
                                                                </button>
                                                                <button type='button' class='btn btn-primary dataupdate' dal="{{$page->id}}">
                                                                    Update
                                                                </button>
                                                            </div>
                                                        </div><!-- /.modal-content -->
                                                    </div><!-- /.modal-dialog -->
                                                </div><!-- /.modal -->
                                            </td>
                                        </tr>
                                        {{--*/ $x++ /*--}}
                                        @endforeach
                                        </tbody>
                                        </table>
                                    {{$settings->links()}}

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


            $(".dataupdate").each(function(){
                $(this).click(function(){

                    var d = $(this).attr("dal")
                    var des = $("#description"+d).val()
                    var  valu = $("#value"+d).val()

                    //alert(d)
                    var pgid =($("#pgid"+d).val())

                    $("#mbody"+d).html("<img src='<?php echo ASSETS_URL;?>/img/loading.gif' style='text-align: center'> ")
                    var request =  $.ajax({
                        url:"settings",
                        type:"post",
                        data:{id:pgid,action:"update",description:des,value:valu},
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