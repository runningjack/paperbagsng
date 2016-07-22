<?php
/**
 * Created by PhpStorm.
 * User: Amedora
 * Date: 6/26/15
 * Time: 5:38 AM
 */

namespace Backend;


class SalesController extends BackendController {
    public function getCustomerIndex(){
        return \View::make("backend.sales.customers.index")->with("customers",\DB::table("customers")->paginate(20))->with("title","Customers")->with("subtitle","List");
    }

    public function getOrderIndex(){
        return \View::make("backend.sales.orders.index")->with("orders",\DB::table("orders")->paginate(20))
            ->with("statuses",\DB::table("order_status")->get())
            ->with("title","Orders")->with("subtitle","List");
    }

    public function postOrderIndex(){
        if(isset($_POST['id']) && $_POST['action']=="status"){
            $order = \Order::find($_POST['id']);
            $order->order_status_id  =   $_POST['status'];
            if($order->update()){
                $input = \Input::all();

                $orderstatus = \Orderstatus::find((int)$_POST['status']);

                if($orderstatus->name == "Failed"){
                    $input['subject'] ="Your order ".$order->invoice_no." Failed";
                    $input['message_text'] ="<p>Thank you for placing an order with Jumia. Unfortunately, we were unable to process the payment of your order.</p>";
                    $input['message_text'] .="";
                }elseif($orderstatus->name == "Processing"){
                    $input['subject'] ="Your order ".$order->invoice_no." Processing";
                    $input['message_text'] ="<p>Thank you for placing an order with Jumia. Unfortunately, we were unable to process the payment of your order.</p>";
                    $input['message_text'] .="";
                }elseif($orderstatus->name == "Shipped"){
                    $input['subject'] ="Your order ".$order->invoice_no." Shipped";
                    $input['message_text'] ="<p>Thank you for placing an order with Jumia. Unfortunately, we were unable to process the payment of your order.</p>";
                    $input['message_text'] .="";
                }elseif($orderstatus->name == "Canceled"){
                    $input['subject'] ="Your order ".$order->invoice_no." Canceled";
                    $input['message_text'] ="<p>Thank you for placing an order with Jumia. Unfortunately, we were unable to process the payment of your order.</p>";
                    $input['message_text'] .="";
                }elseif($orderstatus->name == "Complete"){
                    $input['subject'] ="Your order ".$order->invoice_no." Complete";
                    $input['message_text'] ="<p>Thank you for placing an order with Jumia. Unfortunately, we were unable to process the payment of your order.</p>";
                    $input['message_text'] .="";
                }elseif($orderstatus->name == "Denied"){
                    $input['subject'] ="Your order ".$order->invoice_no." Denied";
                    $input['message_text'] ="<p>Thank you for placing an order with Jumia. Unfortunately, we were unable to process the payment of your order.</p>";
                    $input['message_text'] .="";
                }elseif($orderstatus->name == "Chargeback"){
                    $input['subject'] ="Your order ".$order->invoice_no." Chargeback";
                    $input['message_text'] ="<p>Thank you for placing an order with Jumia. Unfortunately, we were unable to process the payment of your order.</p>";
                    $input['message_text'] .="";
                }elseif($orderstatus->name == "Pending"){
                    $input['subject'] ="Your order ".$order->invoice_no." Pending";
                    $input['message_text'] ="<p>Thank you for placing an order with Jumia. Unfortunately, we were unable to process the payment of your order.</p>";
                    $input['message_text'] .="";
                }elseif($orderstatus->name == "Voided"){
                    $input['subject'] ="Your order ".$order->invoice_no." Voided";
                    $input['message_text'] ="<p>Thank you for placing an order with Jumia. Unfortunately, we were unable to process the payment of your order.</p>";
                    $input['message_text'] .="";
                }elseif($orderstatus->name == "Processed"){
                    $input['subject'] ="Your order ".$order->invoice_no." Processed";
                    $input['message_text'] ="<p>Thank you for placing an order with Jumia. , we have being able to process the payment of your order.</p>";
                    $input['message_text'] .="";
                }elseif($orderstatus->name == "Expired"){
                    $input['subject'] ="Your order ".$order->invoice_no." Expired";
                    $input['message_text'] = "<p>Thank you for placing an order with Jumia. Unfortunately, we were unable to process the payment of your order.</p>";
                    $input['message_text'] .="";
                }elseif($orderstatus->name == "Canceled Reversal"){
                    $input['subject'] ="Your order ".$order->invoice_no." Canceled Reversal";
                    $input['message_text'] = "<p>Thank you for placing an order with Jumia. Unfortunately, we were unable to process the payment of your order.</p>";
                    $input['message_text'] .="";
                }

                $input['firstname']     = $order->firstname;
                $input['email']             =   $order->email;


                \Mail::send('emails.orderemails', $input, function($message) use($input) {
                    $message->from("info@melkaycosmetics.com", "Melkay Cosmetics ");
                    $message->to($input['email'], $input['email'])->cc('webmaster@melkaycosmetics.com')->subject($input['subject']);
                });

                echo "Status Updated";
            }else{
                echo "Unexpected Error! Status could not be upaded";
            }
        }
    }

    public function getCustomerAdd(){
        return \View::make("backend.sales.customers.add")->with("title","Add New Customer")->with("subtitle","")
            ->with("countries",\DB::table("country")->get());
    }

    public function getCustomerEdit($id=""){
        return \View::make("backend.sales.customers.edit")->with("title","Edit Customer Details")->with("subtitle","")
            ->with("customer",\Customer::find($id))
            ->with("countries",\DB::table("country")->get());
    }

    public function postCustomerAdd($id=""){
        $input = \Input::get();
        $validation = \Customer::validate($input);
        if($id !=""){
            $customer = \Customer::find($id);
            array_forget($input,"_token");
            array_forget($input,"confirm");
            array_forget($input,"submit");
            array_forget($input,"tag");

            foreach($input as $key=>$value){
                $customer->$key = $value;
            }

            if($customer->update()){

                \Session::put("success_message","Customer record updeted!");
                return \Redirect::back();
            }else{
                \Session::put("error_message","Unexpected Error! Customer record could not be updated");
                return \Redirect::back()->withInput();
            }

            exit;
        } else{

        }
        if($validation->fails()){
            return \Redirect::back()->withErrors($validation)->withInput();
        }else{

            $customer = new \Customer();

            array_forget($input,"_token");
            array_forget($input,"confirm");
            array_forget($input,"submit");
            array_forget($input,"tag");

            foreach($input as $key=>$value){
                $customer->$key = $value;
            }
                $customer->password     =  \Hash::make(\Input::get("password"));
                if($customer->save()){

                    \Mail::send('emails.registration', $input, function($message) use($input) {
                        $message->from("info@melkaycosmetics.com", "Melkay Cosmetics ");
                        $message->to($input['email'], "info@melkaycosmetics.com")->cc('ahmed@chroniclesoft.com')->subject("Registration ");
                    });

                    \Session::put("success_message","Your Registration was successful");
                    return \Redirect::back();
                }else{
                    \Session::put("error_message","Your registration was not successful, please try again next time");
                    return \Redirect::back()->withInput();
                }
            //}

        }
    }
} 