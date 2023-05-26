<?php
require_once 'auth.php';
require_once 'dbconfig.php';

if(!checkAuth()){
    header("Location: login.php");
    exit;
}
$conn = mysqli_connect($dbconfig['host'],$dbconfig['user'],$dbconfig['pwd'],$dbconfig['db']);
$query = "SELECT * FROM bagagli WHERE utente='".$_SESSION['id']."'";
$query2 = "SELECT * FROM prenotazione WHERE prenotazione IN (SELECT prenotazione FROM bagagli WHERE utente='".$_SESSION['id']."')";
$res = mysqli_query($conn,$query);
$res2 = mysqli_query($conn,$query2);

$data = [];
$data2 = [];
while ($row = $res->fetch_assoc()) {
    $data[] = $row;
}
while ($row2 = $res2->fetch_assoc()) {
    $data2[] = $row2;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="myBaggage.css?v=<?php echo time(); ?>">
    <title>My flights</title>
</head>
<body>
<div class="nav">
    <h1>Hello <?php echo $_SESSION["name"]?> here are your baggage</h1>
</div>
<div id="content">
<?php
if(count($data)==0){
    echo '<p id="noContent">No flight purchased</p>';
}else{
    for($i=0;$i<count($data);$i++){
        echo '<div class="ticket">
                <div class="ticket-header">
                <h3>Your Baggage</h3>
                </div>
                <div class="ticket-body">
                <p>Hand baggage:'.$data[$i]["bagaglio_a_mano"].'</p>
                <p>Hold baggage:'.$data[$i]["bagaglio_stiva"].'</p>
                <p>Departure: '.$data2[$i]["partenza"].'</p>
                <p>Destination: '.$data2[$i]["destinazione"].'</p>
                <p>Departure date: '.$data2[$i]["dataPartenza"].'</p>
                <p>Return date: '.$data2[$i]["dataRitorno"].'</p>
                </div>
            </div>';
    }
}
?>
    
</div>
</body>
</html>