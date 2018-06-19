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
        case "insertPacient":

            if(isset($_POST["email"],$_POST["password"],$_POST["nome"],$_POST["genero"],
                $_POST["data_nascimento"],$_POST["contacto"],$_POST["cc"],$_POST["nif"],
                $_POST["morada"],$_POST["nacionalidade"])){

                $result = User::insertUser($_POST["email"],$_POST["password"],$_POST["nome"],$_POST["genero"],
                    $_POST["data_nascimento"],$_POST["contacto"],$_POST["cc"],$_POST["nif"],
                    $_POST["morada"],$_POST["nacionalidade"],4);

                echo json_encode($result);
            }
            break;

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
        case 'getMyUser':
            if(!isset($_SESSION)){ session_start(); }
            echo $_SESSION["id"];
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
            if(isset($_POST["id_to"],$_POST["mensagem"])){
                if(!isset($_SESSION)){ session_start(); }
                echo json_encode(Mensagens::sendMensagens($_SESSION["id"],$_POST["id_to"],$_POST["mensagem"]));

            }
            break;
        case "getMessages":
            if(isset($_POST["id_to"])){
                if(!isset($_SESSION)){ session_start(); }
                echo json_encode(Mensagens::getMensagens($_SESSION["id"],$_POST["id_to"]));
            }
            break;
        case "getNumberMessages":
            if(isset($_POST["id_to"])){
                if(!isset($_SESSION)){ session_start(); }
                echo json_encode(Mensagens::getNumberMensagens($_SESSION["id"],$_POST["id_to"]));
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

        /**
         *  -- Dor --
         */
        case "insertEpisodioDor":
            if(isset($_POST["zonaCorArray"])){
                echo json_encode(Dor::registarDor($_POST["zonaCorArray"]));
            }
            break;
        
        /**
         *  -- Treinos --
         */
        case "insertTreino":
            //($data_inicio, $data_fim, $profSaude, $utente, $descricao)
            if(isset($_POST["data_inicio"], $_POST["data_fim"], $_POST["profSaude"], $_POST["utente"], $_POST["descricao"])){
                echo json_encode(Treinos::insertTreino($_POST["data_inicio"], $_POST["data_fim"], $_POST["profSaude"], $_POST["utente"], $_POST["descricao"]));
            }
            break;
        case "UpdateTreino":
            //($data_inicio, $data_fim, $profSaude, $utente, $descricao, $concluido, $id_treino)
            if(isset($_POST["data_inicio"], $_POST["data_fim"], $_POST["profSaude"], $_POST["utente"], $_POST["descricao"], $_POST["concluido"], $_POST["id_treino"])){
                echo json_encode(Treinos::updateTreino($_POST["data_inicio"], $_POST["data_fim"], $_POST["profSaude"], $_POST["utente"], $_POST["descricao"], $_POST["concluido"], $_POST["id_treino"]));
            }
            break;
        case "getTreinos":
            if(isset($_POST["utente"])){
                echo json_encode(Treinos::getTreinos($_POST["utente"]));
            }
            break;
        case "getTreino":
            if(isset($_POST["id_treino"])){
                echo json_encode(Treinos::getTreino($_POST["id_treino"]));
            }
            break;
        /**
         *  -- Consultas --
         */
        case "insertConsulta":
            //($data, $profSaude, $utente, $notas)
            if(isset($_POST["data"], $_POST["profSaude"], $_POST["utente"], $_POST["notas"])){
                echo json_encode(Consultas::insertConsulta($_POST["data"], $_POST["profSaude"], $_POST["utente"], $_POST["notas"]));
            }
            break;
        case "updateConsulta":
            //($data, $profSaude, $utente, $notas, $id_consulta)
            if(isset($_POST["data"], $_POST["profSaude"], $_POST["utente"], $_POST["notas"], $_POST["id_consulta"])){
                echo json_encode(Consultas::updateConsulta($_POST["data"], $_POST["profSaude"], $_POST["utente"], $_POST["notas"], $_POST["id_consulta"]));
            }
            break;
        case "getConsultas":
            if(isset($_POST["utente"])){
                echo json_encode(Consultas::getConsultas($_POST["utente"]));
            }
            break;
        case "getConsulta":
            if(isset($_POST["id_consulta"])){
                echo json_encode(Consultas::getConsulta($_POST["id_consulta"]));
            }
            break;

        default:
            # code...
            break;
    }
}

?>