/**
 * Created by Amedora on 1/7/15.
 */
$(document).ready(function(){
    $(".oaccount").on("change",function(){
        if($(this).val()=="individual" || $(this).val()=="joint" ){
        $( "#dialog-message" ).dialog({
            modal: true,
            buttons: {
                Yes: function() {
                    $( this ).dialog( "close" );
                    if($(".oaccount").val()=="individual"){
                        window.location = "./accounts/individual"
                    }
                    if($(".oaccount").val()=="joint"){
                        window.location = "./accounts/joint"
                    }
                },
                No: function(){
                    $(this).dialog("close")
                }
            }
        });
        }else if($(this).val()=="corporate"){
            $( "#corporate-message" ).dialog({
                modal: true,
                buttons: {
                    Ok: function() {
                        $( this ).dialog( "close" );
                    }
                }
            });
        }

       /* if($(this).val()=="individual"){corporate-message
            window.location = "./accounts/individual"
        }
        if($(this).val()=="joint"){
            window.location = "./accounts/joint"
        }
        if($(this).val()=="corporate"){
            window.location = "./accounts/corporate"
        }*/
    })

    $("#portal").on("change",function(){
        if($(this).val()=="SISL"){
            window.location.href = "https:\/\/www.sislbrokerage.com/"
        }
        if($(this).val()=="WEBTRADER"){
            window.location = "https:\/\/www.sislbrokerage.com/"
        }
    })



})