<?php

include 'token.php'; 
$credentials_json = file_get_contents('config.json'); 
$credentials_arr = json_decode($credentials_json,true);

function execute($paymentId)
{
    global $credentials_arr;

    $post_token = array(
        'paymentId' => $paymentId
    );
    
    $url = curl_init($credentials_arr['base_url']."/payment/execute");
    $post_token = json_encode($post_token);
    $header = array(
        'Content-Type:application/json',
        'Authorization:'. getToken(),
        'X-APP-Key:'.$credentials_arr['app_key']
    );
    
    curl_setopt($url, CURLOPT_HTTPHEADER, $header);
    curl_setopt($url, CURLOPT_CUSTOMREQUEST, "POST");
    curl_setopt($url, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($url, CURLOPT_POSTFIELDS, $post_token);
    curl_setopt($url, CURLOPT_FOLLOWLOCATION, 1);
    $result_data = curl_exec($url);
    curl_close($url);
    
    return $result_data;
} 

?>
