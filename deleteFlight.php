<?php
session_start();
require_once 'dbconfig.php';

if(!isset($_SESSION["id"])){
    header("Location: login.php");
    exit;
}

header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET,POST');
header('Access-Control-Allow-Headers: *');
header('Content-Type: application/json; charset=UTF-8');
$data = json_decode(file_get_contents('php://input'));

    $conn = mysqli_connect($dbconfig['host'],$dbconfig['user'],$dbconfig['pwd'],$dbconfig['db']);
    $prenotazione = $data->idPrenotazione;
    
    $query = "DELETE FROM prenotazione WHERE prenotazione='".$prenotazione."'";
    $res = mysqli_query($conn,$query) or die(mysqli_error($conn));
    if($res){
        echo json_encode(['state'=>'eliminato']);
        exit;
    }else{
        echo json_encode(['state'=>false,'error'=>'Booking not successful']);
    }
    mysqli_close($conn);
?>