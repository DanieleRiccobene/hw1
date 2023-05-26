<?php
require_once 'auth.php';
require_once 'dbconfig.php';


if(!$_SESSION["name"] = checkAuth()){
    header("Location: login.php");
    exit;
}

header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET,POST');
header('Access-Control-Allow-Headers: *');
header('Content-Type: application/json; charset=UTF-8');
$data = json_decode(file_get_contents('php://input'));

    $conn = mysqli_connect($dbconfig['host'],$dbconfig['user'],$dbconfig['pwd'],$dbconfig['db']);
    
    header("Location: addBaggage.php");
?>
