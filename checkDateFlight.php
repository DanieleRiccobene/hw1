<?php
require_once 'dbconfig.php';
$conn = mysqli_connect($dbconfig['host'],$dbconfig['user'],$dbconfig['pwd'],$dbconfig['db']);
$query = "SELECT dataPartenza FROM prenotazione WHERE dataPartenza<(SELECT now())";
$res = mysqli_query($conn,$query);
$result = [];

while ($row = $res->fetch_assoc()) {
    $result[] = $row;
}

if(mysqli_num_rows($res)>0){
    echo json_encode($result);
}else{
    echo json_encode(["state"=>false]);
}

?>