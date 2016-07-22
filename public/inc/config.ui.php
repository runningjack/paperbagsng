<?php

//CONFIGURATION for SmartAdmin UI

//ribbon breadcrumbs config
//array("Display Name" => "URL");
$breadcrumbs = array(
	"Home" => APP_URL
);

/*navigation array config
ex:
"dashboard" => array(
	"title" => "Display Title",
	"url" => "http://yoururl.com",
	"url_target" => "_self",
	"icon" => "fa-home",
	"label_htm" => "<span>Add your custom label/badge html here</span>",
	"sub" => array() //contains array of sub items with the same format as the parent
)
*/
$page_nav = array(
	"dashboard" => array(
		"title" => "Dashboard",
		"url" => '/backend/dashboard/index',
		"icon" => "fa-home"
	),
	"pages" => array(
		"title" => "Pages",
		"icon" => "fa-code",
		"sub" => array(

			"list" => array(
				"title" => "All Pages",
				"url" => 'pages/index'
			),
			"addnew" => array(
				"title" => "Add New",
				"url" => 'pages/addnew'
			)
		)
	),

	"posts" => array(
		"title" => "Posts",
		"icon" => "fa-bar-chart-o",
		"sub" => array(
			"list" => array(
				"title" => "All Post",
				"url" => 'posts/index'
			),
			"addnew" => array(
				"title" => "Add New",
				"url" => 'posts/addnew'
			),
            "categories" => array(
                "title" => "All Categories",
                "url" => "categories/index"
            )
	)
    ),
    "events" => array(
        "title" => "Events",
        "icon" => "fa-calendar",
        "sub" => array(
            "list" => array(
                "title" => "All Events",
                "url" => 'events/index'

            ),
            "addnew" => array(
                "title" => "Add New",
                "url" => 'events/addnew'
            ),

        )
    ),

	"frontend" => array(
		"title" => "Frontend",
		"icon" => "fa-windows",
		"sub" => array(
			"slideshow" => array(
		        "title" => "Slide Show",
		        "icon" => "fa-file",
		        "sub" => array(
		            "list" => array(
		                "title" => "All Slides",
		                "url" => "sliders/index"
		            ),
		            "slideimage" => array(
		                "title" => "Manage Slide Image",
		                "url" => "sliders/manageimages"
		            )
		        )
		    ),
            "menu" => array(
				"title" => "Manage Frontend Menu",
				"url" => "menu/index"
			),
            "preview" => array(
				"title" => "Preview Website",
				"url" => ""
			),
            "document"=>array(
                "title"=>"Documents",
                "icon"=>"fa-download",
                "sub" => array(
                    "list" => array(
                        "title" => "All Listing",
                        "url"=>"documents/index"
                    ),
                    "category" => array(
                        "title" => "Category Listing",
                        "url"=>"documents/category"
                    )
                )

            ),
            "pageblock"=>array(
                "title"=>"Page Blocks",
                "url"=>"pageblocks/index"
            )

		)
	),

    "admin"=>array(
        "title"=>"Administrator",
        "icon"=>"fa-users",
        "sub"=>array(
            "list"=>array(
                "title"=>"Admin Listing",
                "url"=>"administrators/index"
            ),
            "addnew"=>array(
                "title"=>"Add New",
                "url"=>"administrators/addnew"
            )
        )
    ),
    "setting"=>array(
        "title"=>"Settings",
        "icon"=>"fa-wrench",
        "url"=>"settings"
    )
);

//configuration variables
$page_title = "";
$page_css = array();
$no_main_header = false; //set true for lock.php and login.php
$page_body_prop = array(); //optional properties for <body>
$page_html_prop = array(); //optional properties for <html>
?>