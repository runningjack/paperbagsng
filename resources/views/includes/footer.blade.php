<?php
/**
 * Created by PhpStorm.
 * User: USER
 * Date: 7/16/16
 * Time: 8:37 PM
 */
?>
<footer id="footer">
    <div class="container">
        <div class="row">
            <div class="footer-ribbon">
                <span>Get in Touch</span>
            </div>
            <div class="col-md-6">
                <div >
                    <h4>About</h4>
                    <p><b>Paperbags.com.ng</b> is Nigeria’s leading manufacturer and supplier of quality paper bags, Kraft bags, boxes and custom accessories including tags, tissue papers and ribbons. Our mission is simple; to provide quality and beautifully designed paper bags to our customers with consistently excellent service on budget and on time.</p>
                </div>
            </div>

            <div class="col-md-4">
                <div class="contact-details">
                    <h4>Contact Us</h4>
                    <ul class="contact">
                        <li><p><i class="fa fa-map-marker"></i> <strong>Address:</strong> 11 Omotayo Ojo Street, Off Allen Avenue, Ikeja-Lagos Nigeria</p></li>
                        <li><p><i class="fa fa-phone"></i> <strong>Phone:</strong> (+234) 9058807590</p></li>
                        <li><p><i class="fa fa-envelope"></i> <strong>Email:</strong> <a href="mailto:support@paperbagsng.com">support@paperbagsng.com</a></p></li>
                    </ul>
                </div>
            </div>
            <div class="col-md-2">
                <h4>Follow Us</h4>
                <ul class="social-icons">
                    <li class="social-icons-facebook"><a href="http://www.facebook.com/" target="_blank" title="Facebook"><i class="fa fa-facebook"></i></a></li>
                    <li class="social-icons-twitter"><a href="http://www.twitter.com/" target="_blank" title="Twitter"><i class="fa fa-twitter"></i></a></li>
                    <li class="social-icons-linkedin"><a href="http://www.linkedin.com/" target="_blank" title="Linkedin"><i class="fa fa-linkedin"></i></a></li>
                </ul>
            </div>
        </div>
    </div>
    <div class="footer-copyright">
        <div class="container">
            <div class="row">
                <div class="col-md-1">
                    <a href="index.html" class="logo">
                        <img alt="Porto Website Template" class="img-responsive" src="{{url('')}}/themes/porto/img/logo.png">
                    </a>
                </div>
                <div class="col-md-7">
                    <p>© Copyright 2016. All Rights Reserved.</p>
                </div>
                <div class="col-md-4">
                    <nav id="sub-menu">
                        <ul>
                            <li><a href="#">FAQ's</a></li>
                            <li><a href="#">Terms and Condition</a></li>
                            <li><a href="#">Contact</a></li>
                        </ul>
                    </nav>
                </div>
            </div>
        </div>
    </div>
</footer>
<div class="modal" id="myProcess">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-body">
                <div id="transProcess" style=' width:317px; margin:10px auto' ><img src='<?= url('');?>/img/loading2.gif'  ><h4>Processing Request... Please Wait!</h4></div>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div>

<div class="modal" id="myDelete">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                <h4 class="modal-title">Data Delete Console</h4>
            </div>
            <div class="modal-body delInfo">

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
                <a href="" model=""  class="del btn btn-primary" >Delete</a>

            </div>

        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div>