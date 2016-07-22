<?php
/**
 * Created by PhpStorm.
 * User: Amedora
 * Date: 12/19/14
 * Time: 9:06 AM
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

$page_title = "Dashboard";

/* ---------------- END PHP Custom Scripts ------------- */

//include header
//you can add your custom css in $page_css array.
//Note: all css files are inside css/ folder
$page_css[] = "your_style.css";
include("inc/header.php");

//include left panel (navigation)
//follow the tree in inc/config.ui.php
$page_nav["dashboard"]["active"] = true;
include("inc/nav.php");

?>
    <!-- ==========================CONTENT STARTS HERE ========================== -->
    <!-- MAIN PANEL -->
    <div id="main" role="main">
        <?php
        //configure ribbon (breadcrumbs) array("name"=>"url"), leave url empty if no url
        //$breadcrumbs["New Crumb"] => "http://url.com"
        include("inc/ribbon.php");
        ?>

        <!-- MAIN CONTENT -->
        <div id="content">

            <div class="row">
                <div class="col-xs-12 col-sm-7 col-md-7 col-lg-4">
                    <h1 class="page-title txt-color-blueDark"><i class="fa-fw fa fa-home"></i> Dashboard <span>> My Dashboard</span></h1>
                </div>

            </div>
            <!-- widget grid -->
            <section id="widget-grid" class="">

                <!-- row -->
                <div class="row">
                    <article class="col-sm-12">
                        <!-- new widget -->

                        <!-- end widget -->

                    </article>
                </div>

                <!-- end row -->

                <!-- row -->

                <div class="row">

                    <article class="col-sm-12 col-md-12 col-lg-6">

                        <!-- new widget -->
                        <div class="jarviswidget jarviswidget-color-blueDark" id="wid-id-1" data-widget-editbutton="false" data-widget-fullscreenbutton="false">

                        </div>

                </div>
                <!-- end widget div -->
        </div>
        <!-- end widget -->



    </div>

    <!-- end row -->




    <!-- ==========================CONTENT ENDS HERE ========================== -->

    <!-- PAGE FOOTER -->
<?php
include("inc/footer.php");
?>
    <!-- END PAGE FOOTER -->

<?php
//include required scripts
include("inc/scripts.php");
?>

    <!-- PAGE RELATED PLUGIN(S)
    <script src="..."></script>-->
    <!-- Flot Chart Plugin: Flot Engine, Flot Resizer, Flot Tooltip -->
    <script src="<?php echo ASSETS_URL; ?>/js/plugin/flot/jquery.flot.cust.min.js"></script>
    <script src="<?php echo ASSETS_URL; ?>/js/plugin/flot/jquery.flot.resize.min.js"></script>
    <script src="<?php echo ASSETS_URL; ?>/js/plugin/flot/jquery.flot.tooltip.min.js"></script>

    <!-- Vector Maps Plugin: Vectormap engine, Vectormap language -->
    <script src="<?php echo ASSETS_URL; ?>/js/plugin/vectormap/jquery-jvectormap-1.2.2.min.js"></script>
    <script src="<?php echo ASSETS_URL; ?>/js/plugin/vectormap/jquery-jvectormap-world-mill-en.js"></script>

    <!-- Full Calendar -->
    <script src="<?php echo ASSETS_URL; ?>/js/plugin/fullcalendar/jquery.fullcalendar.min.js"></script>

    <script>

    $(document).ready(function() {

        /*
         * PAGE RELATED SCRIPTS
         */

        $(".js-status-update a").click(function() {
            var selText = $(this).text();
            var $this = $(this);
            $this.parents('.btn-group').find('.dropdown-toggle').html(selText + ' <span class="caret"></span>');
            $this.parents('.dropdown-menu').find('li').removeClass('active');
            $this.parent().addClass('active');
        });

        /*
         * TODO: add a way to add more todo's to list
         */

        // initialize sortable
        $(function() {
            $("#sortable1, #sortable2").sortable({
                handle : '.handle',
                connectWith : ".todo",
                update : countTasks
            }).disableSelection();
        });

        // check and uncheck
        $('.todo .checkbox > input[type="checkbox"]').click(function() {
            var $this = $(this).parent().parent().parent();

            if ($(this).prop('checked')) {
                $this.addClass("complete");

                // remove this if you want to undo a check list once checked
                //$(this).attr("disabled", true);
                $(this).parent().hide();

                // once clicked - add class, copy to memory then remove and add to sortable3
                $this.slideUp(500, function() {
                    $this.clone().prependTo("#sortable3").effect("highlight", {}, 800);
                    $this.remove();
                    countTasks();
                });
            } else {
                // insert undo code here...
            }

        })
        // count tasks
        function countTasks() {

            $('.todo-group-title').each(function() {
                var $this = $(this);
                $this.find(".num-of-tasks").text($this.next().find("li").size());
            });

        }

        /*
         * RUN PAGE GRAPHS
         */

        /* TAB 1: UPDATING CHART */
        // For the demo we use generated data, but normally it would be coming from the server

        var data = [], totalPoints = 200, $UpdatingChartColors = $("#updating-chart").css('color');

        function getRandomData() {
            if (data.length > 0)
                data = data.slice(1);

            // do a random walk
            while (data.length < totalPoints) {
                var prev = data.length > 0 ? data[data.length - 1] : 50;
                var y = prev + Math.random() * 10 - 5;
                if (y < 0)
                    y = 0;
                if (y > 100)
                    y = 100;
                data.push(y);
            }

            // zip the generated y values with the x values
            var res = [];
            for (var i = 0; i < data.length; ++i)
                res.push([i, data[i]])
            return res;
        }

        // setup control widget
        var updateInterval = 1500;
        $("#updating-chart").val(updateInterval).change(function() {

            var v = $(this).val();
            if (v && !isNaN(+v)) {
                updateInterval = +v;
                $(this).val("" + updateInterval);
            }

        });

        // setup plot
        var options = {
            yaxis : {
                min : 0,
                max : 100
            },
            xaxis : {
                min : 0,
                max : 100
            },
            colors : [$UpdatingChartColors],
            series : {
                lines : {
                    lineWidth : 1,
                    fill : true,
                    fillColor : {
                        colors : [{
                            opacity : 0.4
                        }, {
                            opacity : 0
                        }]
                    },
                    steps : false

                }
            }
        };

        var plot = $.plot($("#updating-chart"), [getRandomData()], options);

        /* live switch */
        $('input[type="checkbox"]#start_interval').click(function() {
            if ($(this).prop('checked')) {
                $on = true;
                updateInterval = 1500;
                update();
            } else {
                clearInterval(updateInterval);
                $on = false;
            }
        });

        function update() {
            if ($on == true) {
                plot.setData([getRandomData()]);
                plot.draw();
                setTimeout(update, updateInterval);

            } else {
                clearInterval(updateInterval)
            }

        }

        var $on = false;

        /*end updating chart*/

        /* TAB 2: Social Network  */



        // END TAB 2

        // TAB THREE GRAPH //
        /* TAB 3: Revenew  */



        /*
         * VECTOR MAP
         */



        $('#vector-map').vectorMap({
            map : 'world_mill_en',
            backgroundColor : '#fff',
            regionStyle : {
                initial : {
                    fill : '#c4c4c4'
                },
                hover : {
                    "fill-opacity" : 1
                }
            },
            series : {
                regions : [{
                    values : data_array,
                    scale : ['#85a8b6', '#4d7686'],
                    normalizeFunction : 'polynomial'
                }]
            },
            onRegionLabelShow : function(e, el, code) {
                if ( typeof data_array[code] == 'undefined') {
                    e.preventDefault();
                } else {
                    var countrylbl = data_array[code];
                    el.html(el.html() + ': ' + countrylbl + ' visits');
                }
            }
        });

        /*
         * FULL CALENDAR JS
         */

        if ($("#calendar").length) {
            var date = new Date();
            var d = date.getDate();
            var m = date.getMonth();
            var y = date.getFullYear();

            var calendar = $('#calendar').fullCalendar({

                editable : true,
                draggable : true,
                selectable : false,
                selectHelper : true,
                unselectAuto : false,
                disableResizing : false,

                header : {
                    left : 'title', //,today
                    center : 'prev, next, today',
                    right : 'month, agendaWeek, agenDay' //month, agendaDay,
                },

                select : function(start, end, allDay) {
                    var title = prompt('Event Title:');
                    if (title) {
                        calendar.fullCalendar('renderEvent', {
                                title : title,
                                start : start,
                                end : end,
                                allDay : allDay
                            }, true // make the event "stick"
                        );
                    }
                    calendar.fullCalendar('unselect');
                },

                events : [{
                    title : 'All Day Event',
                    start : new Date(y, m, 1),
                    description : 'long description',
                    className : ["event", "bg-color-greenLight"],
                    icon : 'fa-check'
                }, {
                    title : 'Long Event',
                    start : new Date(y, m, d - 5),
                    end : new Date(y, m, d - 2),
                    className : ["event", "bg-color-red"],
                    icon : 'fa-lock'
                }, {
                    id : 999,
                    title : 'Repeating Event',
                    start : new Date(y, m, d - 3, 16, 0),
                    allDay : false,
                    className : ["event", "bg-color-blue"],
                    icon : 'fa-clock-o'
                }, {
                    id : 999,
                    title : 'Repeating Event',
                    start : new Date(y, m, d + 4, 16, 0),
                    allDay : false,
                    className : ["event", "bg-color-blue"],
                    icon : 'fa-clock-o'
                }, {
                    title : 'Meeting',
                    start : new Date(y, m, d, 10, 30),
                    allDay : false,
                    className : ["event", "bg-color-darken"]
                }, {
                    title : 'Lunch',
                    start : new Date(y, m, d, 12, 0),
                    end : new Date(y, m, d, 14, 0),
                    allDay : false,
                    className : ["event", "bg-color-darken"]
                }, {
                    title : 'Birthday Party',
                    start : new Date(y, m, d + 1, 19, 0),
                    end : new Date(y, m, d + 1, 22, 30),
                    allDay : false,
                    className : ["event", "bg-color-darken"]
                }, {
                    title : 'Smartadmin Open Day',
                    start : new Date(y, m, 28),
                    end : new Date(y, m, 29),
                    className : ["event", "bg-color-darken"]
                }],

                eventRender : function(event, element, icon) {
                    if (!event.description == "") {
                        element.find('.fc-event-title').append("<br/><span class='ultra-light'>" + event.description + "</span>");
                    }
                    if (!event.icon == "") {
                        element.find('.fc-event-title').append("<i class='air air-top-right fa " + event.icon + " '></i>");
                    }
                }
            });

        };

        /* hide default buttons */
        $('.fc-header-right, .fc-header-center').hide();

        // calendar prev
        $('#calendar-buttons #btn-prev').click(function() {
            $('.fc-button-prev').click();
            return false;
        });

        // calendar next
        $('#calendar-buttons #btn-next').click(function() {
            $('.fc-button-next').click();
            return false;
        });

        // calendar today
        $('#calendar-buttons #btn-today').click(function() {
            $('.fc-button-today').click();
            return false;
        });

        // calendar month
        $('#mt').click(function() {
            $('#calendar').fullCalendar('changeView', 'month');
        });

        // calendar agenda week
        $('#ag').click(function() {
            $('#calendar').fullCalendar('changeView', 'agendaWeek');
        });

        // calendar agenda day
        $('#td').click(function() {
            $('#calendar').fullCalendar('changeView', 'agendaDay');
        });

        /*
         * CHAT
         */

        $.filter_input = $('#filter-chat-list');
        $.chat_users_container = $('#chat-container > .chat-list-body')
        $.chat_users = $('#chat-users')
        $.chat_list_btn = $('#chat-container > .chat-list-open-close');
        $.chat_body = $('#chat-body');

        /*
         * LIST FILTER (CHAT)
         */

        // custom css expression for a case-insensitive contains()
        jQuery.expr[':'].Contains = function(a, i, m) {
            return (a.textContent || a.innerText || "").toUpperCase().indexOf(m[3].toUpperCase()) >= 0;
        };

        function listFilter(list) {// header is any element, list is an unordered list
            // create and add the filter form to the header

            $.filter_input.change(function() {
                var filter = $(this).val();
                if (filter) {
                    // this finds all links in a list that contain the input,
                    // and hide the ones not containing the input while showing the ones that do
                    $.chat_users.find("a:not(:Contains(" + filter + "))").parent().slideUp();
                    $.chat_users.find("a:Contains(" + filter + ")").parent().slideDown();
                } else {
                    $.chat_users.find("li").slideDown();
                }
                return false;
            }).keyup(function() {
                // fire the above change event after every letter
                $(this).change();

            });

        }
        // on dom ready
        listFilter($.chat_users);

        // open chat list
        $.chat_list_btn.click(function() {
            $(this).parent('#chat-container').toggleClass('open');
        })

        $.chat_body.animate({
            scrollTop : $.chat_body[0].scrollHeight
        }, 500);

    });

    </script>

<?php
//include footer
include("inc/google-analytics.php");
?>