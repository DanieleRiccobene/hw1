<?php
include 'obtainToken.php';
if(isset($data))
{
    $city = $data['el'];
    //$param = http_build_query(array("keyword" => $city));
    $curl = curl_init();
    curl_setopt($curl,CURLOPT_URL,"https://test.api.amadeus.com/v1/reference-data/locations?subType=CITY&keyword=".$city);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($curl, CURLOPT_HTTPHEADER, array('Authorization: Bearer '.$token['access_token']));
    $result = curl_exec($curl);
    
    echo $result;
    //var_dump(stripslashes($result));
    curl_close($curl);
}
?>