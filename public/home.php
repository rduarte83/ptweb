<?php
    session_start();
    $_SESSION["tipo"]="admin";
    if( !isset($_SESSION)){
        header ( "location: index.php" ); 
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Home - <?php echo $_SESSION["tipo"]; ?></title>
    <link rel="stylesheet" href="includes/css/bootstrap.min.css">
    <link rel="stylesheet" href="includes/css/fontawesome-all.min.css">
    <link rel="stylesheet" href="includes/css/home.css">
</head>
<body>
    <div class="container-fluid">
        <?php 
            $type = $_SESSION["tipo"];
            switch($type){
                case "paciente":
                    require_once("modules/home/home_paciente.php");
                    break;
                case "profS":
                    require_once("modules/home/home_profissional.php");
                    break;
                case "admin":
                    require_once("modules/home/home_admin.php");
                    break;

            }
        ?>
    </div>


    <!-- Scripts -->
    <script src="includes/js/jquery-3.3.1.min.js"></script>
    <script src="includes/js/bootstrap.min.js"></script>
    <script src="includes/js/home.js"></script>
</body>
</html>