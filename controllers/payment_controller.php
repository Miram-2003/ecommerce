<?php
require_once('../classes/payment_class.php');

function recordPayment( $amt, $customer_id, $order_id, $currency, $payment_date, $mode, $reference)
{
    $payment = new payment(); 
    return $payment->recordPayment($amt, $customer_id, $order_id, $currency, $payment_date, $mode, $reference);
}

function getPaymentDetailsByOrderId($order_id)
{
    $payment = new payment(); 
    return $payment->getPaymentDetailsByOrderId($order_id);
}

function getCustomerPaymentHistory($customer_id)
{
    $payment = new payment(); 
    return $payment->getCustomerPaymentHistory($customer_id);
}



function verify_payment($referenceId) {
    $curl = curl_init();
    curl_setopt_array($curl, array(
      CURLOPT_URL => "https://api.paystack.co/transaction/verify/$referenceId",
      CURLOPT_RETURNTRANSFER => true,
      CURLOPT_ENCODING => "",
      CURLOPT_MAXREDIRS => 10,
      CURLOPT_TIMEOUT => 30,
      CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
      CURLOPT_CUSTOMREQUEST => "GET",
      CURLOPT_HTTPHEADER => array(
        "Authorization: Bearer sk_test_7e173ec800b7e73e17652fbd87341b05d293d9ba",
        "Cache-Control: no-cache",
      ),
    ));

    $response = curl_exec($curl);
    $err = curl_error($curl);

    curl_close($curl);

    if ($err) {
      echo "cURL Error #:" . $err;
    } else {
      $data = json_decode($response);
      return $data;

    }

  }




?>