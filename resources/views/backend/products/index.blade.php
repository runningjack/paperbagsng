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

$page_title = "Price List";

/* ---------------- END PHP Custom Scripts ------------- */

//include header
//you can add your custom css in $page_css array.
//Note: all css files are inside css/ folder
$page_css[] = "your_style.css";
include("inc/header.php");

//include left panel (navigation)
//follow the tree in inc/config.ui.php
$page_nav["catalogue"]['sub']['product']['sub']['list']["active"] = false;
include("inc/nav.php");
$breadcrumbs["Stock Price"] =""
?>
    <style type="text/css">
        #ui-datepicker-div,.ui-datepicker,.ui-datepicker-div
        {
            z-index: 9999999 !important;
        }
    </style>
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
                    <h1 class="page-title txt-color-blue"><i class="fa-fw fa fa-code"></i> {{$p_title}}<span>> {{$subtitle}}</span></h1>
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
                                <h2>All Products </h2>

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
                                    @if(Session::has('error_message'))
                                    <div class="alert alert-danger no-margin fade in">
                                        <button class="close" data-dismiss="alert">×</button>
                                        {{Session::get("error_message")}}
                                        <i class="fa-fw fa fa-info"></i>

                                    </div>
                                    @endif
                                    @if(Session::has('success_message'))
                                    <div class="alert alert-success no-margin fade in">
                                        <button class="close" data-dismiss="alert">×</button>
                                        {{Session::get("success_message")}}
                                        <i class="fa-fw fa fa-info"></i>

                                    </div>
                                    @endif
                                    <div class="text-right">
                                        {{HTML::decode(HTML::linkRoute('prodaddnew','<span class="btn-label"><i class="glyphicon glyphicon-plus"></i></span> Add New',null,array("class"=>"btn btn-labeled btn-primary")))}}
                                    </div>
                                    <table id="datatable_fixed_column" class="table table-striped table-bordered" width="100%">
                                        <thead>
                                        <tr>
                                            <th style="width:7%">
                                            </th>
                                            <th></th>
                                            <th class="hasinput" style="width:17%">
                                                <input type="text" class="form-control" placeholder="Filter Name" />
                                            </th>
                                            <th style="width: 27%">
                                            </th>
                                            <th style="width:17%">
                                            </th>
                                            <th class="hasinput icon-addon">
                                                <input id="dateselect_filter" type="text" placeholder="Filter Date Added" class="form-control datepicker" data-dateformat="yy/mm/dd">
                                                <label for="dateselect_filter" class="glyphicon glyphicon-calendar no-margin padding-top-15" rel="tooltip" title="" data-original-fullname="Filter Date"></label>
                                            </th>
                                            <th></th>
                                        </tr>
                                        <tr>
                                            <th data-class="expand">SN</th>
                                            <td data-class="expand">Img</td>
                                            <th data-hide="phone">Product Name</th>
                                            <th data-hide="phone">Sort Order</th>
                                            <th data-hide="phone,tablet">Date Crreated</th>
                                            <th data-hide="phone,tablet">Date Modified</th>
                                            <th data-hide="phone">Action</th>
                                        </tr>
                                        </thead>
                                        <tbody id="listdata">
                                        @if($products)
                                        {{--*/$x=1/*--}}
                                        @foreach($products as $product)
                                        <tr>
                                            <td>{{$x}}</td>
                                            <td><img src="{{\Croppa::url(ASSETS_URL.'/uploads/images/thumbs/'.$product->image, 50, 50)}}" ></td>
                                            <td>{{$product->title}}</td>
                                            <td>{{$product->sort_order}}</td>
                                            <td>{{date_format(date_create($product->created_at),"d-m-Y")}}</td>
                                            <td>{{date_format(date_create($product->updated_at),"d-m-Y")}}</td>
                                            <td>{{HTML::linkRoute('prodedit',"Edit",$product->id)}}</td>
                                        </tr>
                                        {{--*/$x++/*--}}
                                        @endforeach
                                        @else
                                        <td colspan="6" >No listing available</td>
                                        @endif
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
Session::flush();
include("inc/footer.php");
?>
    <!-- END PAGE FOOTER -->
    <script src="<?php echo ASSETS_URL; ?>/js/libs/jquery-ui-1.10.3.min.js"></script>

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
                title : "<div class='widget-header'><h4><i class='fa fa-warning'></i> Stock Price List Batch Uplaod</h4></div>",

            });

            $('#dialog_link2').click(function() {
                $('#dialog_simple2').dialog('open');
                return false;

            });
            $('#dialog_simple2').dialog({
                autoOpen : false,
                width : 600,
                resizable : false,
                modal : true,
                title : "<div class='widget-header'><h4><i class='fa fa-warning'></i> Stock Price Daily Upload</h4></div>",

            });


            $( "#mydate,#mydate2").datepicker({
                showWeek: true,
                firstDay: 1,
                dateFormat: 'yy-mm-dd',
                changeYear: true,
                beforeShow: function(input) {
                    setTimeout(function() {
                        var widgetHeader = $(input).datepicker("widget").find(".ui-datepicker-header");
                        var prevYrBtn = $('<button title="PrevYr">&lt;&lt; Prev Year</button>');
                        prevYrBtn.unbind("click").bind("click", function() {
                            $.datepicker._adjustDate($(input), -1, 'Y');

                        });
                        var nextYrBtn = $('<button title="NextYr">Next year &gt;&gt;</button>');
                        nextYrBtn.unbind("click").bind("click", function() {
                            $.datepicker._adjustDate($(input), +1, 'Y');

                        });
                        prevYrBtn.appendTo(widgetHeader);
                        nextYrBtn.appendTo(widgetHeader);

                    }, 1);
                }
            });


            /* BASIC ;*/
            var responsiveHelper_dt_basic = undefined;
            var responsiveHelper_datatable_fixed_column = undefined;
            var responsiveHelper_datatable_col_reorder = undefined;
            var responsiveHelper_datatable_tabletools = undefined;

            var breakpointDefinition = {
                tablet : 1024,
                phone : 480
            };



            /* END BASIC */


            /* COLUMN FILTER  */
            var otable = $('#datatable_fixed_column').DataTable({
                //"bFilter": false,
                //"bInfo": false,
                //"bLengthChange": false
                //"bAutoWidth": false,
                //"bPaginate": false,
                //"bStateSave": true // saves sort state using localStorage
                "sDom": "<'dt-toolbar'<'col-xs-12 col-sm-6 hidden-xs'f><'col-sm-6 col-xs-12 hidden-xs'<'toolbar'>>r>"+
                    "t"+
                    "<'dt-toolbar-footer'<'col-sm-6 col-xs-12 hidden-xs'i><'col-xs-12 col-sm-6'p>>",

                "autoWidth" : true,
                "preDrawCallback" : function() {
                    // Initialize the responsive datatables helper once.
                    if (!responsiveHelper_datatable_fixed_column) {
                        responsiveHelper_datatable_fixed_column = new ResponsiveDatatablesHelper($('#datatable_fixed_column'), breakpointDefinition);
                    }
                },
                "rowCallback" : function(nRow) {
                    responsiveHelper_datatable_fixed_column.createExpandIcon(nRow);
                },
                "drawCallback" : function(oSettings) {
                    responsiveHelper_datatable_fixed_column.respond();
                }

            });

            // custom toolbar
            $("div.toolbar").html('<div class="text-right"></div>');

            // Apply the filter
            $("#datatable_fixed_column thead th input[type=text]").on( 'keyup change', function () {

                otable
                    .column( $(this).parent().index()+':visible' )
                    .search( this.value )
                    .draw();

            } );
            /* END COLUMN FILTER */

            //yyyy-mm-dd hh:ii

        })

    </script>
    <script src="<?php echo ASSETS_URL; ?>/js/plugin/datatables/jquery.dataTables.min.js"></script>
    <script src="<?php echo ASSETS_URL; ?>/js/plugin/datatables/dataTables.colVis.min.js"></script>
    <script src="<?php echo ASSETS_URL; ?>/js/plugin/datatables/dataTables.tableTools.min.js"></script>
    <script src="<?php echo ASSETS_URL; ?>/js/plugin/datatables/dataTables.bootstrap.min.js"></script>
    <script src="<?php echo ASSETS_URL; ?>/js/plugin/datatable-responsive/datatables.responsive.min.js"></script>
<?php
//include footer
include("inc/google-analytics.php");
?>