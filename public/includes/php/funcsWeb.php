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

        case 'getSingleUser':
            echo json_encode(User::getSingleUser($_POST["key"]));
            break;
        case 'updateUser':
            if(isset($_POST["email"],$_POST["password"],$_POST["nome"],$_POST["genero"],
            $_POST["data_nascimento"],$_POST["contacto"],$_POST["cc"],$_POST["nif"],
            $_POST["morada"],$_POST["nacionalidade"],$_POST["role"], $_POST["idKey"])){
                
                $result = User::updateUser($_POST["email"],$_POST["password"],$_POST["nome"],$_POST["genero"],
                $_POST["data_nascimento"],$_POST["contacto"],$_POST["cc"],$_POST["nif"],
                $_POST["morada"],$_POST["nacionalidade"],$_POST["role"], $_POST["idKey"]);

                echo json_encode($result);
            }
            break;
        
        /**
         * -- LOGIN  / Logout--
         */
        case 'login':
            if(isset($_POST["email"],$_POST["pwd"])){
                $result = Login::loginEntra($_POST["email"],$_POST["pwd"]);
                echo json_encode($result);

            }
            break;
        case 'logout':
            if(!isset($_SESSION)) session_start();
            Login::destroiSessao();
            break;
        
        /**
         *  -- Mensagens --
         */
        case "sendTo":
            if(isset($_POST["id"],$_POST["id_to"],$_POST["mensagem"])){
                Mensagens::sendMensagens($_POST["id"],$_POST["id_to"],$_POST["mensagem"]);
            }
            break;
        case "getMessages":
            if(isset($_POST["id"],$_POST["id_to"],$_POST["mensagem"])){
                echo json_encode(Mensagens::getMensagens($_POST["id"],$_POST["id_to"]));
            }
            break;
        case "getNumberMessages":
            if(isset($_POST["id"],$_POST["id_to"],$_POST["mensagem"])){
                echo json_encode(Mensagens::getNumberMensagens($_POST["id"],$_POST["id_to"]));
            }
            break;

        /**
         * -- Artigos --
         */

        case "insertArtigo":
            $result = Artigos::insertArtigo($_POST["titulo"],$_POST["noticia"]);
            echo json_encode($result);
            break;

        /**
         * -- Notificações
         */
        case "getNotification":
            if(isset($_POST["id"])){
                echo json_encode(Mensagens::getNotificacoes($_POST["id"]));
            }
            break;
        case "getNotificationNumber":
            if(isset($_POST["id"])){
                echo json_encode(Notificacoes::getNumberNotificacoes($_POST["id"]));
            }
            break;

        default:
            # code...
            break;
    }
}

?>