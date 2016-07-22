<?php
/**
 * Created by PhpStorm.
 * User: USER
 * Date: 7/16/16
 * Time: 8:37 PM
 */
?>
<header id="header" data-plugin-options="{"stickyEnabled": true, "stickyEnableOnBoxed": true, "stickyEnableOnMobile": true, "stickyStartAt": 57, "stickySetTop": "-57px", "stickyChangeLogo": true}" style="min-height: 125px;">
<div class="header-body" style="top: 0px;">
<div class="header-container container">
<div class="header-row">
    <div class="header-column">
        <div class="header-nav-main header-nav-main-effect-1 header-nav-main-sub-effect-1 collapse">
            <nav>
                <ul class="nav nav-pills" id="mainNav">
                    <li class="active">
                        <a  href="{{url('')}}"> Home</a>
                    </li>
                    <li class="">
                        <a href="{{url('')}}/aboutus"> About Us</a>
                    </li>
                    <li class="dropdown">
                        <a class="dropdown-toggle" href="#">
                            Order A Bag
                            <i class="fa fa-caret-down"></i></a>

                        <ul class="dropdown-menu">
                            <li>
                                <a href="{{url('')}}/orderform/Luxury-Laminated-Bag"> Luxury Laminated Paperbags</a>
                            </li>
                            <li>
                                <a href="{{url('')}}/orderform/Kraft-Bag"> Kraft Bags</a>
                            </li>
                            <li>
                                <a href="{{url('')}}/orderform/Custom-Bag"> Custom Bag</a>
                            </li>
                        </ul>
                    </li>
                    <li><a href="javascript:void(0)">PRICING</a> </li>
                </ul>
            </nav>
        </div>
    </div>
    <div class="header-column">
        <div class="header-row">
            <div class="header-logo" style="width: 250px; height: 84px;">
                <a href="{{url('')}}">
                    <img alt="Paperbagsng.com" width="111" height="54" data-sticky-width="82" data-sticky-height="40" data-sticky-top="33" src="{{url('')}}/themes/porto/img/logo.png" style="top: 0px; width: 250px; height: 55px;">
                </a>
            </div>
        </div>
    </div>
<div class="header-column">
    <div class="header-row">
    <div class="header-search hidden-xs">
        <form id="searchForm" action="page-search-results.html" method="get" novalidate="novalidate">
            <div class="input-group has-error">
                <input type="text" class="form-control" name="q" id="q" placeholder="Search..." required="" aria-required="true" aria-invalid="true">
												<span class="input-group-btn">
													<button class="btn btn-default" type="submit"><i class="fa fa-search"></i></button>
												</span>
            </div>
        </form>
    </div>

</div>
</div>
</div>
</div>
</div>
</header>