/**
 * Created by Amedora on 12/5/14.
 */


var globals = { 'payment_target':'catchable','amt':1,'transcost':0,'total':0,'orderAmt':1,'curren':"" };
var myDataArray  = new Array();
$(document).ready(function(){

    var baseUrl = "http://localhost/c3exchange/public/"
    $(".ecurrency").on("change",function(){
        var otype   = $("#order_type").val()

        if(otype !="Exchange"){
            var $method = $(this).val()
            var $curr   = $method.split(" ")

            globals.curren = $curr[1];
            var urlparam =$curr[0]+7+otype //this needed Backend ajax
            var orderamount = $("#order_amount").val();

            $.ajax({
                url:"pages/DestTxt/"+urlparam,
                type:"post",
                data:{input:$curr[0]},
                success: function(result){
                    alert(result)
                    /*$.each(result, function( key, value ) {
                        myDataArray[key]  = value ;
                    });
                   myDataArray = $.map(result, function(value, key) {
                        return [[key, value]];
                    });*/

                    myDataArray = result.split('"')

                    $("#destTxt").html("<strong>"+$curr[0]+" <i>("+$curr[1]+")</i></strong>")

                    globals.amt =myDataArray[3]
                    treatNumeric(orderamount,globals.amt)
                    globals.payment_target =myDataArray[1] //get the ecurrency from index

                    if(otype == "Buy"){
                        globals.total = eval(javaCeil(parseInt(globals.orderAmt)/parseInt(globals.amt),2))
                        $("#FINAL_AMOUNT").val(globals.total)
                    }else if(otype=="Sell"){
                        globals.total = eval(javaCeil(parseInt(globals.orderAmt)*parseInt(globals.amt),2))
                        $("#FINAL_AMOUNT").html("<span class='alert-box success' style='display:inline'><h4 style='display:inline; color:#fff !important'><strong>"+ globals.total +" "+ " <i></i></strong></h4></span>")
                        $("#FINAL_AMOUNT h4").append( $("#order_transfer_type").val())
                    }

                    $("#total_amount").val(globals.total)
                    $("#final_amount").val(globals.total)
                    $("#offer_amount").val(globals.amt)
                }
            })
        }else if(otype =="Exchange"){
            var $method = $("#ecurrency").val()
            var $curr   = $method.split(" ")
            var excurr  = $("#exchange_transfer").val()
            excurr      = excurr.split(" ")
            globals.curren = $curr[1];
            var urlparam =$curr[0]+"©"+$curr[1]+"©"+$curr[2] //this needed Backend ajax
            var urlparam2 = excurr[0]+"©"+excurr[1]+"©"+excurr[2]
            var orderamount = $("#order_amount").val();
            var request = $.ajax({
                url:"exchange",
                type:"post",
                data:{input1:urlparam,input2:urlparam2},
                dataType:"json"
            })

            request.done(function(data){
                //alert(JSON.stringify(data))
                var splexchange = data["exchange"].split(":")
                var currpair    = data["currency_pair"].split("_") //splexchange[2]
                /*$.each( JSON.stringify(data), function( key, value ) {
                 myDataArray[key]  = value ;

                 success: function(JSONObject) {
                 var peopleHTML = "";

                 // Loop through Object and create peopleHTML
                 for (var key in JSONObject) {
                 if (JSONObject.hasOwnProperty(key)) {
                 peopleHTML += "<tr>";
                 peopleHTML += "<td>" + JSONObject[key]["name"] + "</td>";
                 peopleHTML += "<td>" + JSONObject[key]["gender"] + "</td>";
                 peopleHTML += "</tr>";
                 }
            }
            });*/

                $("#destTxt").html("<strong> <i>("+$curr[1]+")</i></strong>")
                $("#excdetail").html("<div class='large-6 columns right'>" +
                "<h5>Exchange Rate</h5> " +
                "<div><strong><i>"+splexchange[0]+" "+currpair[0]+" = "+splexchange[1]+" "+currpair[1]+
                    "</i></strong></div></div>")
                globals.amt = splexchange[1]
                treatNumeric(orderamount,globals.amt)


                globals.total = eval(parseFloat(globals.orderAmt)*parseFloat(globals.amt))
                $("#FINAL_AMOUNT").html(globals.total)
                console.log(globals.total)
                $("#total_amount").val(globals.total)
                $("#final_amount").val(globals.total)
                $("#offer_amount").val(globals.amt)


            })

            request.fail(function(){
                alert("Request: failed")
            })

        }
    })





$("#order_amount").on("keypress",function(evt){
    return isNumberKey(evt)
    })
$("#order_amount").on("change",function(evt){
    treatNumeric($(this).val(),globals.amt)
    var otype = $("#order_type").val()
    if(otype == "Buy"){
    globals.total = eval(parseInt(globals.orderAmt)/parseInt(globals.amt))
    $("#FINAL_AMOUNT").val(globals.total)

    }else if(otype=="Sell"){
    globals.total = eval(parseInt(globals.orderAmt)*parseInt(globals.amt))
    $("#FINAL_AMOUNT").html("<span class='alert-box success' style='display:inline'><h4 style='display:inline; color:#fff !important'><strong>"+ globals.total +" "+ $("#method_id").val()+ " <i></i></strong></h4></span>")
    }else if(otype="Exchange"){
    globals.total = eval(parseFloat(globals.orderAmt)*parseFloat(globals.amt))
    $("#FINAL_AMOUNT").html(parseFloat(globals.total))
    }
$("#total_amount").val(globals.total)
$("#final_amount").val(globals.total)
$("#offer_amount").val(globals.amt)
})
})
/*
* treatNumeric is a function to make sure
* that order amount and currency amount is
* not set to zero or is not a numeric value
*
* this method is to be called to for the
* ecurrency sell and buy dropdowns
* */
function treatNumeric(orderamt,curramt){

    //this orderamt field is to get the user order or offer
    //input for both sell and buy
    if(orderamt==0 || isNaN(orderamt)){
    globals.orderAmt = 1
    }else{
    globals.orderAmt = orderamt
    }
//this curramt field is to get the currency exchange rate through ajax
//for both sell and buy
if(curramt==0 || isNaN(curramt)){
    globals.amt = 1
    }else{
    globals.amt = curramt
    }
}

function isNumberKey(evt){
    var charCode = (evt.which) ? evt.which : event.keyCode
    if (charCode > 31 && (charCode < 48 || charCode > 57))
    return false;
    return true;
    }

function javaCeil(str, precision) {
    return str.toFixed(precision)
    }
