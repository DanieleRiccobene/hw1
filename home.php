<?php
require_once 'auth.php';
if (!checkAuth()){
    header("Location: login.php");
    exit;
}
$user_name = checkAuth();
if (!$_SESSION["modal"]) {
    $_SESSION["modal"] = true; // Imposta la variabile di sessione come true se è la prima visita
    $displayWelcomeDiv = true;
} else {
    $displayWelcomeDiv = false;
}
$_SESSION['insert']=false;
?>

<!DOCTYPE html>
<html>
    <head>
        <title>Flight search</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="home.css?v=<?php echo time(); ?>">
        <link rel="stylesheet" href="prenotazione.css?v=<?php echo time(); ?>">
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@48,400,0,0" />
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@48,400,0,0" />
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@48,400,0,0" />
        <script src="home.js" defer="true"></script>
        <script src="benvenuto.js" defer="true"></script>
    </head>
    
    <body>
        <?php if ($displayWelcomeDiv): ?>
        <section id="modalBenvenuto" class="hidden">
            <div class="hello">
                <h1>Welcome <?php echo $user_name;?>!</h1>
            </div>
        </section>
        <?php endif; ?>

        <div id="myModal" class="modal">
        <div class="modal-content">
            
        </div>
    </div>

        <div id="menuSelector">
            <div id="close"><span class="material-symbols-outlined">close</span></div>
            <a href="myFlight.php">My flights</a>
            <a href="myBaggage.php">Baggage</a>
            <a href="logout.php">Logout</a>
        </div>
        <div id="titleDiv">
                <div id="menu">
                    <div></div>
                    <div></div>
                    <div></div>
                </div>
            <h1>Flight Search<span class="material-symbols-outlined" id="plane">flight</span></h1></div>
    <div id="animated-container">
        <div id="container">
            <form id="my-form">
                <div class="form-container">
                    <div class="type">
                        <div id="form-part">
                            <label>From</label>
                            <input id="formTextPartenza" type="text" name="partenza" placeholder="City">
                            <div id="resultPart" class="hidden"></div>
                        </div>

                        <div id="form-dest">
                            <label>To</label>
                            <input id="formTextDestinazione" type="text" name="destinazione" placeholder="City">
                            <div id="resultDest" class="hidden"></div>
                        </div>
                    </div>

                    <div class="type">
                        <div id="form-departure-date">
                            <label>Departure</label>
                            <input type="date" class="formDate" name="dataPartenza" value="Departure">
                        </div>
                        
                        <div id="form-return-date">    
                            <label>Return</label>
                            <input type="date" class="formDate" name="dataRitorno">
                        </div>
                    </div>

                    
                    <div class="type">
                        <div id="form-passengers">
                            <label>Passengers</label>
                            <select class="formNum" name="numeroAdulti">
                                <option value="1">1</option>
                                <option value="2">2</option>
                                <option value="3">3</option>
                                <option value="4">4</option>
                                <option value="5">5</option>
                                <option value="6">6</option>
                                <option value="7">7</option>
                                <option value="8">8</option>
                                <option value="9">9</option>
                            </select>
                        </div>
                        
                        <div id="form-class-travel">
                            <label>Class</label>
                            <select id="formSel">
                                <!--ECONOMY, PREMIUM_ECONOMY, BUSINESS, FIRST-->
                                <option value="ECONOMY">ECONOMY</option>
                                <option value="PREMIUM_ECONOMY">PREMIUM_ECONOMY</option>
                                <option value="BUSINESS">BUSINESS</option>
                                <option value="FIRST">FIRST</option>
                            </select>
                        </div>

                    </div>
                <div id="searchFlight"><p>Cerca Voli!</p></div>
                </div>
            </form>
        </div>
</div>
<div id="no-content"></div>
<div id="flights">

</div>
    </body>
</html>