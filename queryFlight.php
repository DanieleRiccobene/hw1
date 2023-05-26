<?php
require_once 'dbconfig.php';
require_once 'auth.php';
if(!checkAuth()){
    header("Location: login.php");
    exit;
}
$conn = mysqli_connect($dbconfig['host'],$dbconfig['user'],$dbconfig['pwd'],$dbconfig['db']);

if ($conn->connect_errno) {
    die('Errore di connessione al database: ' . $conn->connect_error);
}

$query = "SELECT * FROM prenotazione WHERE utente='".$_SESSION['id']."'";
$result = $conn->query($query);

// Verifica eventuali errori di query
if (!$result) {
    die('Errore nella query: ' . $conn->error);
}

$data = [];
while ($row = $result->fetch_assoc()) {
    $data[] = $row;
}
$jsonData = json_encode($data);

header('Content-Type: application/json');
echo $jsonData;
$conn->close();
?>

