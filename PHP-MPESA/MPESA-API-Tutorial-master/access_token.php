<?php
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
curl_close($curl);
