<?php
/**
 * Created by PhpStorm.
 * User: Team Acer
 * Date: 7/15/16
 * Time: 4:42 PM
 */ ?>
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
    </head>
<body cz-shortcut-listen="true">
<div class="body">
@include("includes.header")
<div role="main" class="main">
    @yield("content")
</div>
@include("includes.footer")
</div>

</body>
</html>