<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Dor</title>
    <link rel="stylesheet" href="includes/css/bootstrap.min.css">
    <link rel="stylesheet" href="includes/css/index.css">
</head>
<body>

    <div class="background-img "></div>
    <div class="container-fluid">
    
        <?php require_once("modules/index/index_navbar.php"); ?>
        
        <?php require_once("modules/index/index_tags.php"); ?>

        <?php require_once("modules/index/index_cardview.php"); ?>
        

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
    <!-- Scripts -->
    <script src="includes/js/jquery-3.3.1.min.js"></script>
    <script src="includes/js/bootstrap.min.js"></script>
    <script src="includes/js/index.js"></script>
</body>
</html>