<?php

require_once 'auth.php';

if(!checkAuth()) exit;

header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET,POST');
header('Access-Control-Allow-Headers: *');
header('Content-Type: application/json; charset=UTF-8');
$data = json_decode(file_get_contents('php://input'),true);

$curl = curl_init();
curl_setopt($curl, CURLOPT_URL,'https://test.api.amadeus.com/v1/security/oauth2/token');
curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($curl, CURLOPT_POST, 1);
curl_setopt($curl, CURLOPT_POSTFIELDS,"grant_type=client_credentials&client_id=QQz3qfAWCdthb3ealgDAfQABtWMybevx&client_secret=9SX5xGTtmc7ji6XG");
curl_setopt($curl, CURLOPT_HTTPHEADER, array('Content-Type: application/x-www-form-urlencoded'));
$token = json_decode(curl_exec($curl),true);
curl_close($curl);
?>
