<?php
// Retrieve the payload sent from the client-side JavaScript
$payload = json_decode($_POST['payload'], true);

// Extract token and amount from the payload
$token = $payload['token'];
$amount = $payload['amount'];

$args = http_build_query(array(
  'token' => $token ,
  'amount'=> $amount
));

$url = "https://khalti.com/api/v2/payment/verify/";

# Make the call using API.
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS,$args);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

$headers = ['Authorization: Key test_secret_key_27d6d605410f40268fa4495457f21186'];
curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

// Response
$response = curl_exec($ch);
$status_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
curl_close($ch);

// Handle the Khalti payment verification response
if ($status_code === 200) {
    // Payment verification successful
    $payment_response = json_decode($response, true);
   
    // Check the status in $payment_response and handle accordingly
    if ($payment_response['state']['name'] === 'Completed') {
      
        // Payment successful, perform your desired actions here
        echo "Payment Successful! Transaction ID: " . $payment_response['idx'];
    } else {
        // Payment failed, handle the error
        echo "Payment Failed! Error: " ;
    }
} else {
    // Error in the Khalti API request
    echo "Error: Unable to verify payment.";
}
?>
