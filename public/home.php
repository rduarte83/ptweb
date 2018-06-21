<?php
    session_start();
    //$_SESSION["role"]="Admin";
    if( !isset($_SESSION,$_SESSION["role"])){
        header ( "location: index.php" ); 
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Home - <?php echo $_SESSION["role"]; ?></title>
    <link rel="stylesheet" href="includes/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.13/css/all.css" integrity="sha384-DNOHZ68U8hZfKXOrtjWvjxusGo9WQnrNx2sqG0tfsghAvtVlRW3tvkXWZh58N9jp" crossorigin="anonymous">
    <link rel="stylesheet" href="includes/css/home.css">
    <link rel="stylesheet" type="text/css" href="http://cdn.datatables.net/1.10.18/css/jquery.dataTables.min.css"/>
 
    <!-- Scripts -->
    <script src="includes/js/jquery-3.3.1.min.js"></script>
    <script src="includes/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="includes/js/home.js"></script>
    <script type="text/javascript" src="http://cdn.datatables.net/1.10.18/js/jquery.dataTables.min.js"></script>
</head>
<body>
    <div class="container-fluid">
        <?php 
            $type = $_SESSION["role"];
            switch($type){
                case "Utente":
                    require_once("modules/home/paciente/paciente.php");
                    break;
                case "Prof Saúde":
                    require_once("modules/home/profissional/profissional.php");
                    break;
                case "Admin":
                    require_once("modules/home/admin/admin.php");
                    echo '<script src="includes/js/admin.js"></script>';
                    break;
                default:
                    break;
            }
        ?>

        <!-- Alert error -->
        <div class="row" id="notification">
            <div class="alert alert-danger" id="danger-alert">
                <button type="button" class="close" data-dismiss="alert">x</button>
                <strong>Error! </strong>
                <span id="errorMensagem"></span>
            </div>
            <!-- Alert success -->
            <div class="alert alert-success" id="success-alert">
                <button type="button" class="close" data-dismiss="alert">x</button>
                <strong>Success! </strong>
                <span id="sucessoMensagem"></span>
            </div>
        </div>
    </div>
    
</body>
</html>