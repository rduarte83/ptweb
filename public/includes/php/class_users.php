<?php

class User 
{
    public static function insertUser ( $email, $password, $nome, $genero, $data_nascimento, $contacto, $cc, $nif, $morada, $nacionalidade, $role)
    {
        try {

            $Database = new Database();
            $arrParam = [
                ":password" => $password,
                ":nome" => $nome,
                ":morada" => $morada,
                ":nacionalidade" => $nacionalidade,
                ":nif" => $nif,
                ":cc" => $cc,
                ":genero" => $genero,
                ":data_nascimento" => date("Y-m-d", strtotime($data_nascimento)),
                ":contacto" => $contacto,
                ":email" => $email,
                ":role" => intval($role)
            ]; 
            
            $query = "INSERT INTO utilizador 
            (id, password, nome, morada, nacionalidade, nif, cc, genero, data_nascimento, contacto,mail, role, data_registo)
            VALUES(DEFAULT, :password, :nome, :morada, :nacionalidade, :nif, :cc, :genero, :data_nascimento, :contacto, :email, :role, now())";

            $result = $Database->EXE_NON_QUERY($query, $arrParam, false);
 
            if($result != null)
                return $result->rowCount();

        } catch (PDOException $e) {
            echo "ERROR: " . $e->getMessage();
        }
    }

    public static function updateUser($email, $password=null, $nome,  $genero, $data_nascimento, $contacto, $cc, $nif, $morada, $nacionalidade, $role, $id)
    {

        try{
            require_once("class_database.php");
            $Database = new Database();
            $query;
            $arrParam;

            if (!empty($password)){
                $arrParam = [
                    ":password" => $password,
                    ":nome" => $nome,
                    ":morada" => $morada,
                    ":nacionalidade" => $nacionalidade,
                    ":nif" => $nif,
                    ":cc" => $cc,
                    ":genero" => $genero,
                    ":data_nascimento" => date("Y-m-d", strtotime($data_nascimento)),
                    ":contacto" => $contacto,
                    ":email" => $email,
                    ":role" => intval($role),
                    ":id" => intval($id)
                ]; 
    
                $query = "UPDATE utilizador 
                SET nome=:nome,morada=:morada,nacionalidade=:nacionalidade,
                nif=:nif,cc=:cc,genero=:genero,data_nascimento=:data_nascimento,contacto=:contacto,mail=:email,
                role=:role, password=:password WHERE id=:id";
            }else {
                $arrParam = [
                    ":nome" => $nome,
                    ":morada" => $morada,
                    ":nacionalidade" => $nacionalidade,
                    ":nif" => $nif,
                    ":cc" => $cc,
                    ":genero" => $genero,
                    ":data_nascimento" => date("Y-m-d", strtotime($data_nascimento)),
                    ":contacto" => $contacto,
                    ":email" => $email,
                    ":role" => intval($role),
                    ":id" => intval($id)
                ]; 

                $query = "UPDATE utilizador 
                SET nome=:nome,morada=:morada,nacionalidade=:nacionalidade,
                nif=:nif,cc=:cc,genero=:genero,data_nascimento=:data_nascimento,contacto=:contacto,mail=:email,
                role=:role WHERE id=:id";
            }

            

            $result = $Database->EXE_NON_QUERY($query, $arrParam, false);
            return $result->rowcount();

        } catch (PDOException $e) {
            echo "ERROR: " . $e->getMessage();
            return null;
        }
    }

    public static function getUsers()
    {
        try {
            require_once("class_database.php");
            $Database = new Database();
            // QUERY COM ERRO
            $query = "SELECT id, nome, role FROM utilizador";
            
            $result = $Database->EXE_QUERY($query);
        
            return $result;
            
        } catch (PDOException $e) {
            echo "ERROR: " . $e->getMessage();
            return null;
        }
    }

    public static function getUsersPaciente($id)
    {
        try {
            require_once("class_database.php");
            $Database = new Database();

            $arrParam = [
                ":id" => intval($id),
            ];

            // QUERY COM ERRO
            $query = "SELECT ute.id,uti.nome as nome  FROM utente as ute
            INNER JOIN utilizador as uti ON uti.id = ute.id
            INNER JOIN utilizador as ps  ON ps.id = ute.prof_saude
            WHERE ute.prof_saude=:id";
            
            $result = $Database->EXE_QUERY($query,$arrParam);
        
            return $result;
            
        } catch (PDOException $e) {
            echo "ERROR: " . $e->getMessage();
            return null;
        }
    }


    public static function getSingleUser($key)
    {

        try{
            require_once("class_database.php");
            $Database = new Database();

            $arrParam = [
                "key" => $key
            ];

            $query = "SELECT * FROM utilizador WHERE id=:key;";


            $reg = $Database->EXE_QUERY($query,$arrParam);

            return $reg;

        } catch (PDOException $e) {
            return null;
            echo "ERROR: " . $e->getMessage();
        }
    }

    public static function getProfissinal()
    {
        if(!isset($_SESSION))
            session_start();

        try{
            require_once("class_database.php");
            $Database = new Database();

            $arrParam = [
                ":id" => $_SESSION["id"],
            ];

            $query = "SELECT * FROM utilizador WHERE id=(SELECT prof_saude FROM utente WHERE id=:id);";

            $reg = $Database->EXE_QUERY($query,$arrParam);

            return $reg;

        } catch (PDOException $e) {
            return null;
            echo "ERROR: " . $e->getMessage();
        }
    }


}

?>