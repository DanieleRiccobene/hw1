<?php
require_once 'dbconfig.php';

header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET,POST');
header('Access-Control-Allow-Headers: *');
header('Content-Type: application/json; charset=UTF-8');
$data = json_decode(file_get_contents('php://input'));
$username = '';
if(isset($data)){
    $username = $data->user;
    $conn = mysqli_connect($dbconfig['host'],$dbconfig['user'],$dbconfig['pwd'],$dbconfig['db']);
    $query = "SELECT * FROM utenti WHERE email='$username'";
    $res = mysqli_query($conn,$query);
    if(mysqli_num_rows($res)>0){
        echo json_encode(['error'=>true,
                          'message'=>'*Email already registered']);
    }else{
        echo json_encode(['error'=>false]);
    }
    exit();
}
?>