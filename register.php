<?php
require_once 'dbconfig.php';
require_once 'auth.php';

    if (checkAuth()) {
        header("Location: home.php");
        exit;
    }   
/*LUNGHEZZA PASSWORD MAX 12 CARATTERI*/
$newURL = "login.php";

    if(!empty($_POST["fname"]) && !empty($_POST["surname"]) && !empty($_POST["username"]) && !empty($_POST["password"])){
        $error=array();
        $conn = mysqli_connect($dbconfig['host'],$dbconfig['user'],$dbconfig['pwd'],$dbconfig['db']);
        $name = mysqli_real_escape_string($conn,$_POST["fname"]);
        $surname = mysqli_real_escape_string($conn,$_POST["surname"]);
        $username = mysqli_real_escape_string($conn,$_POST["username"]);
        $password = mysqli_real_escape_string($conn,$_POST["password"]);
        
        $check = "SELECT * FROM utenti WHERE email='$username'";
        $res = mysqli_query($conn,$check);
        //controllo email
        if (!filter_var($username, FILTER_VALIDATE_EMAIL)) {
            $error[] = "Email not valid";
        }else{
            $email = mysqli_real_escape_string($conn, strtolower($username));
            $res = mysqli_query($conn, "SELECT email FROM utenti WHERE email = '$username'");
            if (mysqli_num_rows($res) > 0) {
                $error[] = "Email already registered";
            }
        }

        //controllo spazi nella password
        if(preg_match('/\s/',$password)){
            $error[] = "Password must not containe whitespace";
        }
        //controllo lunghezza password
        if (strlen($password)< 8) {
            $error[] = "Password too short";
        }

        if (count($error) == 0) {
            $query = "INSERT INTO utenti(name, surname, email, password) VALUES('$name', '$surname', '$username', '$password')";
            
            if (mysqli_query($conn, $query)) {
                $_SESSION["name"] = $name;
                $_SESSION["id"] = mysqli_insert_id($conn);
                $_SESSION["modal"] = false;
                mysqli_close($conn);
                header("Location: home.php");
                exit;
            } else {
                $error[] = "Errore di connessione al Database";
            }
        }
        mysqli_close($conn);
    }
?>
<!DOCTYPE html>
<html lang="en">
<title>Registrati su Flight Search</title>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="register.css">
    <script src="register.js" defer="true"></script>
    <title>Document</title>
</head>
<body>
    <div class="check">
        <form action="register.php" method="post">
            <p>Register</p>
            <div class="type">
                <input id="name" type="text" name="fname" class="fields">
                <label id="labName">Name</label>
            </div>
            <div class="type">
                <input id="surname" type="text" name="surname" class="fields">
                <label id="labSurname">Surname</label>
            </div>
            <div class="type">
                <input id="email" type="text" name="username" class="fields">
                <label id="labEmail">Email<span></span></label>
            </div>
            <div class="type">
                <input id="pwd" type="password" name="password" class="fields">
                <label id="labPwd">Password(> 8 caratteri,!?@#)</label>
            </div>
            <input type="submit" value="Register">
            <div id="progressBar">
                <div id="bar"></div>
                <p id="alert"></p>
            </div>
            
            <p class="selection">Have already an account? <a href="login.php">Log In</a></p>
        </form>
        
    </div>
    <?php
            if(isset($error)) {
                foreach($error as $err){
                    echo "<div class='errors'><p class='error'>".$err."</p></div>";
                }
                unset($error);
            }
            ?>
</body>
</html>
