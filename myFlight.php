<?php
require_once 'auth.php';
require_once 'dbconfig.php';

if(!checkAuth()){
    header("Location: login.php");
    exit;
}
$_SESSION["modal"] = true;
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="myFlight.css?v=<?php echo time(); ?>">
    <script src="myFlight.js" defer="true"></script>
    <title>My flights</title>
</head>
<body>
<div class="nav">
    <h1>Hello <?php echo $_SESSION["name"]?> here are your flights</h1>
</div>
<div id="content">

    
</div>
</body>
</html>