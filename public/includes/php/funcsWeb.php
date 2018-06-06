<?php

require_once("includes.php");

if(isset($_POST,$_POST["cmd"]))
{  
    $cmd = $_POST["cmd"];
    switch ($cmd) {
        /**
         * -- USER COMMANDS --
         * Insert User & GET USER
         */
        case 'insertUser':
                //( $email, $passsword, $nome, $genero, $data_nascimento, $contacto, $cc, $nif, $morada, $nacionalidade, $role)
            if(isset($_POST["email"],$_POST["password"],$_POST["nome"],$_POST["genero"],
                $_POST["data_nascimento"],$_POST["contacto"],$_POST["cc"],$_POST["nif"],
                $_POST["morada"],$_POST["nacionalidade"],$_POST["role"])){
                    
                    $result = User::insertUser($_POST["email"],$_POST["password"],$_POST["nome"],$_POST["genero"],
                    $_POST["data_nascimento"],$_POST["contacto"],$_POST["cc"],$_POST["nif"],
                    $_POST["morada"],$_POST["nacionalidade"],$_POST["role"]);
                    
                    echo json_encode($result);
            }
            break;
        case 'getUsers':
            echo json_encode(User::getUsers());
            break;
        
        case 'login':
            
            break;
        
        default:
            # code...
            break;
    }
}

?>