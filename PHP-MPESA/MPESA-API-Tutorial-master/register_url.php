<?php

$url = 'https://sandbox.safaricom.co.ke/mpesa/c2b/v1/registerurl';

$consumer_key = "6RXyGyPbrVAAttsCTz7EYR2SveG7Zl2M";
$consumer_secret = "6bcUPZcTNMMfFCZz";

$headers = ["Content-Type:application/json;charset = utf8"];
// $credentials = base64_encode($consumer_key . ":" . $consumer_secret);
$url = "https://sandbox.safaricom.co.ke/oauth/v1/generate?grant_type=client_credentials";


$curl = curl_init($url);
// curl_setopt($curl, CURLOPT_URL, $url);
curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
curl_setopt($curl, CURLOPT_RETURNTRANSFER, TRUE);
curl_setopt($curl, CURLOPT_HEADER, false);
curl_setopt($curl, CURLOPT_USERPWD, $consumer_key . ":" . $consumer_secret);
// curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
// curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
$result = curl_exec($curl);

// $status = $curl_getinfo($ch, CURLINFO_HTTP_CODE);
$result = json_decode($result);

$access_token = $result->access_token;
echo $access_token;
// curl_close($curl);


// /* This two files are provided in the project. */
// $confirmationUrl = ''; // path to your confirmation url. can be IP address that is publicly accessible or a url
// $validationUrl = ''; // path to your validation url. can be IP address that is publicly accessible or a url



$curl = curl_init();
curl_setopt($curl, CURLOPT_URL, $url);
curl_setopt($curl, CURLOPT_HTTPHEADER, array('Content-Type:application/json', 'Authorization:Bearer ' . $access_token)); //setting custom header


$curl_post_data = array(
	//Fill in the request parameters with valid values
	'ShortCode' => '174379',
	'ResponseType' => 'Completed',
	'ConfirmationURL' => 'https://f24a-154-159-252-233.in.ngrok.io/MEAL BOOKING SYSTEM/PHP-MPESA/MPESA-API-Tutorial-master/confirmation_url.php',
	'ValidationURL' => 'https://f24a-154-159-252-233.in.ngrok.io/MEAL BOOKING SYSTEM/PHP-MPESA/MPESA-API-Tutorial-master/validation_url.php'
);

$data_string = json_encode($curl_post_data);

curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
curl_setopt($curl, CURLOPT_POST, true);
curl_setopt($curl, CURLOPT_POSTFIELDS, $data_string);

$curl_response = curl_exec($curl);
print_r($curl_response);

echo $curl_response;
