<?php
require_once 'auth.php';
require_once 'dbconfig.php';

if(!checkAuth()){
    header("Location: login.php");
    exit;
}else if(!$_SESSION['insert']){
    header("Location: home.php");
}
$conn1 = mysqli_connect($dbconfig['host'],$dbconfig['user'],$dbconfig['pwd'],$dbconfig['db']);

$partenza = $_COOKIE['partenza'];
$destinazione = $_COOKIE['destinazione'];
$dataPartenza = urldecode($_COOKIE['dataPartenza']);
$dataRitorno = urldecode($_COOKIE['dataRitorno']);
$passeggeri = $_COOKIE['passeggeri'];
$classe = $_COOKIE['classe'];
$prezzo = $_COOKIE['prezzo'];
$idUtente = $_COOKIE['utente'];
$idPrenotazione = $_COOKIE['prenotazione'];


 if(isset($_POST["hand"]) && isset($_POST["hold"])){
    $conn = mysqli_connect($dbconfig['host'],$dbconfig['user'],$dbconfig['pwd'],$dbconfig['db']);
    $query2 = "INSERT INTO bagagli(utente,prenotazione,bagaglio_a_mano,bagaglio_stiva) 
    VALUES('".$idUtente."','".$idPrenotazione."','".$_POST["hand"]."','".$_POST["hold"]."')";
    if(mysqli_query($conn,$query2)){
        header("Location: home.php");
    }else{
        echo json_encode(['add'=>false]);
    }
}
?>

<html>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="addBaggage.css">
    <script src="addBaggage.js" defer="true"></script>
    <title>Add Baggage</title>
</head>
<body>
    <div class="content">
        <div class="form-container">
            <form action="addBaggage.php" method="post">
                
                <div id="number-control-hand">
                    <div>
                        <label>Hand luggage</label>
                        <input type="button" value="-" id="decrement-btn-hand"></input>
                        <input type="hidden" value="" name="hand" id="hand"><span id="numberHand">0</span></input>
                        <input type="button" value="+" id="increment-btn-hand"></input>
                    </div>
                </div>

                <div id="number-control-hold">
                    <div>
                        <label>Hold baggage</label>
                        <input type="button" value="-" id="decrement-btn-hold"></input>
                        <input type="hidden" value="" name="hold" id="hold"><span id="numberHold" name="hold">0</span></input>  
                        <input type="button" value="+" id="increment-btn-hold"></input>
                    </div>
                </div>

                <div class="btn-submit"><input type="submit" value="Add"></div>
            </form>
        </div>
    </div>
</body>
</html>