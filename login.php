<?php
require_once 'dbconfig.php';
include 'auth.php';
$flag = true;
    if(checkAuth()){
        header("Location: home.php");
        exit;
    }

    if(isset($_POST["username"]) && isset($_POST["pwd"])){
        $conn = mysqli_connect($dbconfig['host'],$dbconfig['user'],$dbconfig['pwd'],$dbconfig['db']);
        mysqli_select_db($conn,$dbconfig['db']);
        $username = mysqli_real_escape_string($conn,$_POST["username"]);
        $password = mysqli_real_escape_string($conn,$_POST["pwd"]);
        $query = "SELECT * FROM utenti WHERE email='".$username."' AND password='".$password."'";
        $res = mysqli_query($conn,$query) or die(mysqli_error($conn));
        $row = mysqli_fetch_assoc($res);
        if(mysqli_num_rows($res)>0)
        {
            $_SESSION["name"] = $row["name"];
            $_SESSION["id"] = $row["id"];
            $_SESSION["modal"] = false;
            header("Location: home.php");
            mysqli_free_result($res);
            mysqli_close($conn);
            exit;
        }
        $error = "User not found";
    }
?>
<!DOCTYPE html>
<html lang="en">
<title>Accedi su Flight Search</title>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="login.css?v=<?php echo time(); ?>">
    <title>Document</title>
</head>
<body>
    <div class="check">
        <form action="login.php" method="post">
            <p>Login</p>
            <div class="credentials">
                <input type="text" name="username">
                <label>Username</label>
            </div>

            <div class="credentials">
                <input type="password" name="pwd">
                <label>Password</label>
            </div>
            <div><input type="submit" value="Sign in"></div>
            <?php
                // Verifica la presenza di errori
                if (isset($error)) {
                    echo "<p id='error'>$error</p>";
                }
            ?>
            <p class="selection">or <a href="register.php">Sign up</a></p>
        </form>
    </div>
</body>
</html>