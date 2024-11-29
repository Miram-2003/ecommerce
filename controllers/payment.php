<?php

function initiate_paystack_payment($email,$order_id, $amount) {
    $url = "https://api.paystack.co/transaction/initialize";

$amount = $amount *100;

  $fields = [
    'email' => $email,
    'amount' => $amount,
    'order_id' => $order_id,
    'callback_url' => "../customer.car_view.php",
    'metadata' => ["cancel_action" => "/customer/cart_view.php"]
  ];
  $fields_string = http_build_query($fields);

  //open connection
  $ch = curl_init();
  
  //set the url, number of POST vars, POST data
  curl_setopt($ch,CURLOPT_URL, $url);
  curl_setopt($ch,CURLOPT_POST, true);
  curl_setopt($ch,CURLOPT_POSTFIELDS, $fields_string);
  curl_setopt($ch, CURLOPT_HTTPHEADER, array(
    "Authorization: Bearer sk_test_7e173ec800b7e73e17652fbd87341b05d293d9ba",
    "Cache-Control: no-cache",
  ));
  
  //So that curl_exec returns the contents of the cURL; rather than echoing it
  curl_setopt($ch,CURLOPT_RETURNTRANSFER, true); 
  
  //execute post
  $result = curl_exec($ch);
  echo $result;

}


// Decode the JSON response
$response_data = json_decode(  $result , true);

// Debugging: Check full response
var_dump($response_data); // Uncomment this for debugging

// Check if the response contains a valid authorization URL
if (isset($response_data['data']['authorization_url'])) {
    return $response_data['data']['authorization_url']; // Return the Paystack redirect URL
} else {
    // If there's an error or no authorization URL in the response
    echo "Paystack API Error: " . $response_data['message'];
    return null;
}

}



?>