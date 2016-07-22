<?php
/**
 * Created by PhpStorm.
 * User: USER
 * Date: 7/16/16
 * Time: 8:38 PM
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
    <link rel="stylesheet" href="{{url('')}}/plugins/jQueryUI/jquery-ui.css" />
    <link rel="stylesheet" href="{{url('')}}/plugins/jQueryUI/jquery-ui.theme.css" />
    <link rel="stylesheet" href="{{url('')}}/plugins/bootstrap-colorpicker/dist/css/bootstrap-colorpicker.css">
    <link rel="stylesheet" href="{{url('')}}/themes/porto/css/bootstrap-multiselect.css">
    <link rel="stylesheet" href="{{url('')}}/themes/porto/css/theme-form-extension.css">
    <link rel="stylesheet" href="{{url('')}}/themes/porto/css/theme-admin-extension.css">
    <link rel="stylesheet" href="{{url('')}}/themes/porto/css/custom.css">
    <style TYPE="text/css">
        .modal2{
            margin-left: -50px;
        }
        .modal-content2 {
            width: 950px;
            margin-left: -180px;
            margin-right: 50px;
        }

    </style>

</head>
<body cz-shortcut-listen="true">
<div class="body">
    @include("includes.header")
    @yield("content")
    @include("includes.footer")
</div>
<script src="{{url('')}}/plugins/jQuery/jQuery-2.1.4.min.js"></script>
<script src="{{url('')}}/bootstrap/js/bootstrap.min.js"></script>
<script src="{{url('')}}/themes/porto/js/jquery.appear.min.js"></script>
<script src="{{url('')}}/themes/porto/js/jquery.easing.min.js"></script>
<script src="{{url('')}}/themes/porto/js/jquery-cookie.min.js"></script>
<script src="{{url('')}}/plugins/bootstrap-colorpicker/dist/js/bootstrap-colorpicker.min.js"></script>
<script src="{{url('')}}/themes/porto/js/common.min.js"></script>
<script src="{{url('')}}/themes/porto/js/jquery.validate.min.js"></script>
<script src="{{url('')}}/themes/porto/js/jquery.stellar.min.js"></script>
<script src="{{url('')}}/plugins/rendro-easy-pie-chart/jquery.easypiechart.min.js"></script>
<script src="{{url('')}}/themes/porto/js/jquery.lazyload.min.js"></script>
<script src="{{url('')}}/themes/porto/js/jquery.isotope.min.js"></script>
<script src="{{url('')}}/themes/porto/js/theme.js"></script>
<script src="{{url('')}}/themes/porto/js/theme.init.js"></script>
<script src="{{url('')}}/plugins/owl.carousel/owl.carousel.min.js"></script>
<script src="{{url('')}}/plugins/magnific-popup/jquery.magnific-popup.min.js"></script>
<script src="{{url('')}}/themes/porto/js/vide.min.js"></script>

<script src="{{url('')}}/themes/porto/js/jquery.bootstrap.wizard.js"></script>
<script src="{{url('')}}/themes/porto/js/paperbagform.wizard.js"></script>
<script src="{{url('')}}/plugins/flexisel/jquery.flexisel.js"></script>examples.advanced.form.js
<script src="{{url('')}}/themes/porto/js/bootstrap-colorpicker.js"></script>
<script src="{{url('')}}/themes/porto/js/examples.advanced.form.js"></script>
<script src="{{url('')}}/themes/porto/js/bootstrap-multiselect.js"></script>
<script src="{{url('')}}/themes/porto/js/jquery.form.min.js"></script>


<script src="{{url('')}}/themes/porto/js/theme.admin.extension.js"></script>
<script type="text/javascript">

    $(window).load(function() {
        var validator = $('#loginForm').validate({
            rules: {
                password:{
                    minlength : 5,
                    required: true
                },email: {
                    required: true,
                    email: "Your email address must be in the format of name@domain.com"
                }

            },messages:{
                username:"Please enter your login email",
                password:"Please enter your password"
            }, highlight: function (element) {
                $(element).closest('.form-group').removeClass('has-success').addClass('has-error');
            },
            unhighlight: function (element) {
                $(element).closest('.form-group').removeClass('has-error').addClass('has-success');
            },
            errorElement: 'span',
            errorClass: 'help-block',
            errorPlacement: function (error, element) {
                if (element.parent('.input-group').length) {
                    error.insertAfter(element.parent());
                } else {
                    error.insertAfter(element);
                }
            },submitHandler: function(form) {
                $("#myModalLogin").modal("hide")
                $("#myProcess").modal("show")
                $.ajax({url: '{{url("")}}/account/auth/login',type: 'post',data: $(form).serialize(),
                    success:function(data){
                        $("div#transProcess").html("<div class='alert alert-info fade in'><button class='close' data-dismiss='alert'>×</button><i class='fa-fw fa fa-check'></i>"+data+"</div>")
                        setInterval($("#myProcess").modal("hide"),500000);
                    }
                });
            }
        });
        var validator = $('#registerForm').validate({
            rules: {
                first_name: {
                    required: true
                },
                last_name: {
                    required: true
                }, phone: {
                    required: true
                },password:{
                    minlength : 5,
                    required: true
                },email: {
                    required: true,
                    email: "Your email address must be in the format of name@domain.com"
                }
                ,confirm : {
                    required:true,
                    minlength : 5,
                    equalTo : "#password2"
                }
            },messages:{
                first_name:"Please enter your first name",
                last_name:"Please enter your last name",
                phone:"Please enter your phone number",
                email:"please supply your email"
            }, highlight: function (element) {
                $(element).closest('.form-group').removeClass('has-success').addClass('has-error');
            },
            unhighlight: function (element) {
                $(element).closest('.form-group').removeClass('has-error').addClass('has-success');
            },
            errorElement: 'span',
            errorClass: 'help-block',
            errorPlacement: function (error, element) {
                if (element.parent('.input-group').length) {
                    error.insertAfter(element.parent());
                } else {
                    error.insertAfter(element);
                }
            },submitHandler: function(form) {
                $("#myModalLogin").modal("hide")
                $("#myProcess").modal("show")
                $.ajax({url: '{{url("")}}/register',type: 'post',data: $(form).serialize(),
                    success:function(data){if(data){$("div#transProcess").html("<div class='alert alert-info fade in'><button class='close' data-dismiss='alert'>×</button><i class='fa-fw fa fa-check'></i>"+data+"</div>")}else{alert(data);}setInterval($("#myProcess").modal("hide"),500000);}});
            }
        });
        $("#flexiselDemo1").flexisel();
//function for background type
        document.getElementById('background_type').addEventListener('change', function () {
            'use strict';
            var vis = document.querySelector('.vis'),
                target = document.getElementById(this.value);
            if (vis !== null) {
                vis.className = 'back-type';
            }
            if (target !== null ) {
                target.className = 'vis';
            }
        });



        $('#MyUploadLogo').submit(function(){$(this).ajaxSubmit(options);return false;});
        var progressbar,statustxt,progressbox =0;
        var options = {
            target:   '#outputcert',   // target element(s) to be updated with server response
            beforeSubmit:  beforeSubmit,  // pre-submit callback
            uploadProgress: OnProgress,
            success:       afterSuccess,  // post-submit callback
            resetForm: true        // reset the form after successful submit
        };
        //when upload progresses
        function OnProgress(event, position, total, percentComplete)
        {
            //Progress bar
            progressbar.width(percentComplete + '%') //update progressbar percent complete
            statustxt.html(percentComplete + '%'); //update status text
            if(percentComplete>50)
            {
                statustxt.css('color','#fff'); //change status text to white after 50%
            }
            $('#submit-btn').hide();
        }

        //after succesful upload
        function afterSuccess(data)
        {

            $('#submit-btn').show(); //hide submit button
            $('#loading-img').hide(); //hide submit button
            //alert(data)
            var md = data.split("@@");

            var url = "{{url('')}}"
            $("#imgg").html("<img src='"+url+"/uploads/docs/"+md[1]+ "' height='100' weight='100'> <p></p> <a class='btn btn-primary' data-target='#myModalLogo' data-toggle='modal'>Change</a> ")
            $("#dlogo").html("<img src='"+url+"/uploads/docs/"+md[1]+ "' height='100' weight='100'> <p></p> <a class='btn btn-primary' data-target='#myModalLogo' data-toggle='modal'>Change</a> ")
            $("#design-logo").val(md[1]);$("#imageInput").val(md[1]);setInterval($('#myModalLogo').modal("hide"),500000)

        }


        //function to check file size before uploading.
        function beforeSubmit(){
            //check whether browser fully supports all File API
            if (window.File && window.FileReader && window.FileList && window.Blob)
            {
                $('#outputcert').css("width","25%")
                $('#outputcert').css("margin","0 auto")
                $('#outputcert').html('<img src="{{url('')}}/img/loading2.gif" alt="Please Wait" style="align-content: center"/>')
                progressbar = $("#progressbarcert")
                statustxt = $("#statustxtcert")
                progressbox = $("#progressbox")
                if( !$('#imageLogo').val()) //check empty input filed
                {
                    $("#outputcert").html("Oops please load a file?");
                    return false
                }
                var fsize = $('#imageLogo')[0].files[0].size; //get file size
                var ftype = $('#imageLogo')[0].files[0].type; // get file type
                //allow only valid image file types
                switch(ftype)
                {
                    case 'image/png': case 'image/gif': case 'image/jpeg': case 'image/pjpeg':
                    break;
                    default:
                        $("#outputcert").html("<b>"+ftype+"</b> Unsupported file type!");
                        return false
                }

                //Allowed file size is less than 1 MB (1048576)
                if(fsize>1048576)
                {
                    $("#outputcert").html("<b>"+bytesToSize(fsize) +"</b> Too big Image file! Please reduce the size of your photo using an image editor.");
                    return false
                }

                //Progress bar
                progressbox.show(); //show progressbar
                //progressbar.width(completed); //initial value 0% of progressbar
                //statustxt.html(completed); //set status text
                statustxt.css('color','#000'); //initial color of status text


                $('#submit-btn').hide(); //hide submit button
                $('#loading-img').show(); //hide submit button
                $("#outputcert").html("");
            }
            else
            {
                //Output error to older unsupported browsers that doesn't support HTML5 File API
                $("#outputcert").html("Please upgrade your browser, because your current browser lacks some new features we need!");
                return false;
            }
        }

//function to format bites bit.ly/19yoIPO
        function bytesToSize(bytes) {
            var sizes = ['Bytes', 'KB', 'MB', 'GB', 'TB'];
            if (bytes == 0) return '0 Bytes';
            var i = parseInt(Math.floor(Math.log(bytes) / Math.log(1024)));
            return Math.round(bytes / Math.pow(1024, i), 2) + ' ' + sizes[i];
        }


        $("#bag_size").on("change",function(){$("#dsize").html($(this).val())});
        $("#orientation").on("change",function(){$("#dorient").html($(this).val())});
        $("#background_type").on("change",function(){$("#dbackground").html($(this).val())});
        $("#background").on("change",function(){$("#dcolor").html($(this).val())});
        $("#design_text").on("blur",function(){$("#dtext").html($(this).val())});
        $("#text_font").on("change",function(){$("#dfont").html($(this).val())});
        $("#finishing").on("change",function(){
            $("#dfinishing").html($(this).val())
            var c = $("#background").val()
            $("#dcolor").html(c)
            $("#cl").css("height","50px")
            $("#cl").css("width","50px")
        });

        $("#colorpicker-saturation").on("click",function(){
            var c = $("#background").val()
            $("#dcolor").html(c)
            $("#cl").css("background-color",c)

        })

        $(".radio").each(function(){
            /*$(this).is(":checked"){
                $("#dpattern").html($(this).val())
            }*/
        })

    });


</script>
</body>
</html>