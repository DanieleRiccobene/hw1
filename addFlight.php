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
$_SESSION["flight"] = $data;
if(isset($data)){
    $conn = mysqli_connect($dbconfig['host'],$dbconfig['user'],$dbconfig['pwd'],$dbconfig['db']);
    $partenza = mysqli_real_escape_string($conn,$data->partenzaValue);
    setcookie("partenza",$partenza);
    $destinazione = mysqli_real_escape_string($conn,$data->destinazioneValue);
    setcookie("destinazione",$destinazione);
    $dataPartenza = mysqli_real_escape_string($conn,$data->dataPartenzaValue);
    setcookie("dataPartenza",$dataPartenza);
    $dataRitorno = mysqli_real_escape_string($conn,$data->dataRitornoValue);
    setcookie("dataRitorno",$dataRitorno);
    //setcookie("dataRitorno",$dataRitornoCookie);
    $passeggeri = mysqli_real_escape_string($conn,$data->passeggeriValue);
    setcookie("passeggeri",$passeggeri);
    $classe = mysqli_real_escape_string($conn,$data->classeValue);
    setcookie("classe",$classe);
    $prezzo = mysqli_real_escape_string($conn,$data->prezzoValue);
    setcookie("prezzo",$prezzo);
    setcookie("utente",$_SESSION["id"]);
    $query = "INSERT INTO prenotazione(utente,partenza,destinazione,dataPartenza,dataRitorno,passeggeri,classe,prezzo) 
    VALUES('".$_SESSION["id"]."','".$partenza."','".$destinazione."','".$dataPartenza."','".$dataRitorno."','".$passeggeri."','".$classe."','".$prezzo."')";
    
    if(mysqli_query($conn,$query)){
        $_SESSION['insert']=true;
        $last_id = $conn->insert_id;
        setcookie("prenotazione",$last_id);
        echo json_encode(['state'=>true]);
    }else{
        echo json_encode(['state'=>false,'error'=>'
        Booking not successful']);
    }
    exit();
}
?>