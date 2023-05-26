<?php
include 'obtainToken.php';
require_once 'auth.php';

if(!checkAuth()) exit;

header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET,POST');
header('Access-Control-Allow-Headers: *');
header('Content-Type: application/json; charset=UTF-8');

$data = json_decode(file_get_contents('php://input'),true);
$param = http_build_query($data);
$curl = curl_init();
curl_setopt($curl,CURLOPT_URL,"https://test.api.amadeus.com/v2/shopping/flight-offers?".$param);
curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($curl, CURLOPT_HTTPHEADER, array('Authorization: Bearer '.$token['access_token']));
$result = curl_exec($curl);
echo $result;
curl_close($curl);
//echo $param;
?>