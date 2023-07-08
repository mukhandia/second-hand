
<title>
    transanction
</title>
<?php
require __DIR__ . '/vendor/autoload.php';

use Carbon\Carbon;

if (isset($_GET['amount']) && $_GET['number']) {
    $amount = $_GET['amount'];
    $phoneNumber = $_GET['number'];
    stkPush($amount, $phoneNumber);
}
function lipaNaMpesaPassword()
{
    //timestamp
    $timestamp = Carbon::rawParse('now')->format('YmdHms');
    //passkey
    $passKey = "bfb279f9aa9bdbcf158e97dd71a467cd2e0c893059b10f78e6b72ada1ed2c919";
    $businessShortCOde = 174379;
    //generate password
    $mpesaPassword = base64_encode($businessShortCOde . $passKey . $timestamp);

    return $mpesaPassword;
}
function newAccessToken()
{
    $consumer_key = "r07nYgeEnBYMe5rTb4Inx3ZdaiFf2BWU";
    $consumer_secret = "0FzAZKFqCjSgVRUd";
    $credentials = base64_encode($consumer_key . ":" . $consumer_secret);
    $url = "https://sandbox.safaricom.co.ke/oauth/v1/generate?grant_type=client_credentials";
    $curl = curl_init();
    curl_setopt($curl, CURLOPT_URL, $url);
    curl_setopt($curl, CURLOPT_HTTPHEADER, array("Authorization: Basic " . $credentials, "Content-Type:application/json"));
    curl_setopt($curl, CURLOPT_HEADER, false);
    curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    $curl_response = curl_exec($curl);
    $access_token = json_decode($curl_response);
    curl_close($curl);

    return $access_token->access_token;
}

function stkPush($amount, $phoneNumber)
{
    //    $user = $request->user;
    //    $amount = $request->amount;
    //    $number =  $request->number;
    $formatedPhone = $phoneNumber; //726582228
    $code = "254";
    $phoneNumber = $code . $formatedPhone; //254726582228

    $url = 'https://sandbox.safaricom.co.ke/mpesa/stkpush/v1/processrequest';
    $curl_post_data = [
        'BusinessShortCode' => 174379,
        'Password' => lipaNaMpesaPassword(),
        'Timestamp' => Carbon::rawParse('now')->format('YmdHms'),
        'TransactionType' => 'CustomerPayBillOnline',
        'Amount' => $amount,
        'PartyA' => $phoneNumber,
        'PartyB' => 174379,
        'PhoneNumber' => $phoneNumber,
        'CallBackURL' => 'https://9bf3-41-89-246-254.eu.ngrok.io/MEAL%20BOOKING%20SYSTEM/login.php',
        'AccountReference' => " ONLINE SHOP",
        'TransactionDesc' => "lipa Na M-PESA"
    ];
    $data_string = json_encode($curl_post_data);

    $curl = curl_init();
    curl_setopt($curl, CURLOPT_URL, $url);
    curl_setopt($curl, CURLOPT_HTTPHEADER, array('Content-Type:application/json', 'Authorization:Bearer ' . newAccessToken()));
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($curl, CURLOPT_POST, true);
    curl_setopt($curl, CURLOPT_POSTFIELDS, $data_string);
    $curl_response = curl_exec($curl);
    print_r($curl_response);
}//  header("Location:../checkout.php");
