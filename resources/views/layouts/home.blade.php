<?php
/**
 * Created by PhpStorm.
 * User: USER
 * Date: 7/16/16
 * Time: 8:37 PM
 */
?>
<!DOCTYPE html>
<html class="js touch history boxshadow csstransforms3d csstransitions video svg webkit chrome win js touch sticky-header-enabled sticky-header-negative sticky-header-active">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Paper bags NG</title>
    <meta name="keywords" content="Selling the best paperbags" />
    <meta name="description" content="Paperbag - Selling paperbags">
    <meta name="author" content="Ahmed">
    @include("includes.head")
    <!-- Current Page CSS -->
    <link rel="stylesheet" href="{{url('')}}/plugins/rs-plugin/css/settings.css">
    <link rel="stylesheet" href="{{url('')}}/plugins/rs-plugin/css/layers.css">
    <link rel="stylesheet" href="{{url('')}}/plugins/rs-plugin/css/navigation.css">
    <link rel="stylesheet" href="{{url('')}}/plugins/rs-plugin/css/circle-flip-slideshow/css/component.css">
</head>
<body cz-shortcut-listen="true">
<div class="body">
@include("includes.header")
@yield("content")
@include("includes.footer")
</div>

<script src="{{url('')}}/plugins/jQuery/jQuery-2.1.4.min.js"></script>
<script src="{{url('')}}/themes/porto/js/jquery.appear.min.js"></script>
<script src="{{url('')}}/themes/porto/js/jquery.easing.min.js"></script>
<script src="{{url('')}}/themes/porto/js/jquery-cookie.min.js"></script>
<script src="{{url('')}}/bootstrap/js/bootstrap.min.js"></script>
<script src="{{url('')}}/themes/porto/js/common.min.js"></script>
<script src="{{url('')}}/themes/porto/js/jquery.validate.min.js"></script>
<script src="{{url('')}}/themes/porto/js/jquery.stellar.min.js"></script>
<script src="{{url('')}}/plugins/rendro-easy-pie-chart/jquery.easypiechart.min.js"></script>
<script src="{{url('')}}/themes/porto/js/jquery.lazyload.min.js"></script>
<script src="{{url('')}}/themes/porto/js/jquery.isotope.min.js"></script>
<script src="{{url('')}}/plugins/owl.carousel/owl.carousel.min.js"></script>
<script src="{{url('')}}/plugins/magnific-popup/jquery.magnific-popup.min.js"></script>
<script src="{{url('')}}/themes/porto/js/vide.min.js"></script>
<script src="{{url('')}}/plugins/flexisel/jquery.flexisel.js"></script>

<script src="{{url('')}}/themes/porto/js/theme.js"></script>
<!-- Current Page Vendor and Views -->
<script src="{{url('')}}/plugins/rs-plugin/js/jquery.themepunch.tools.min.js"></script>
<script src="{{url('')}}/plugins/rs-plugin/js/jquery.themepunch.revolution.min.js"></script>

<script src="{{url('')}}/themes/porto/js/view.home.js"></script>
<!-- Theme Initialization Files -->
<script src="{{url('')}}/themes/porto/js/theme.init.js"></script>
<script type="text/javascript">
    jQuery(document).ready(function() {
        jQuery('#revolutionSlider').revolution({
                delay:9000,
                startwidth:1170,
                startheight:500,
                hideThumbs:10
            });
    });
</script>
<script type="text/javascript">
    $(window).load(function() {
        $("#flexiselDemo1").flexisel();
    });
</script>
</body>
</html>