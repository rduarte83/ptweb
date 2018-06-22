<?php
    if(!isset($_POST, $_POST["idTreino"])){
        exit();
    }
    if(!isset($_SESSION))
    session_start();
    require_once("../../../includes/php/class_treinos.php");
    $treinos = Treinos::getTreinos($_SESSION["id"]);
?> 
