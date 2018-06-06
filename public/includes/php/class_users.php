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
                ":data_nascimento" => $data_nascimento,
                ":contacto" => $contacto,
                ":email" => $email,
                ":role" => $role,
                ":data_registo" => date("d-m-Y")
            ];
            
            $query = "INSERT INTO utilizador (id,password,nome,morada,nacionalidade,nif,cc,genero,data_nascimento,contacto,mail,role,data_registo)
            VALUES(DEFAULT, :password, :nome,:morada,:nacionalidade,:nif,:cc,:genero,:data_nascimento,:contacto,:email,:role,:data_registo);";

            $result = $Database->EXE_NON_QUERY($query, $arrParam,false);
            if($result != null)
                return $result->rowCount();

        } catch (PDOException $e) {
            echo "ERROR: " . $e->getMessage();
        }
    }

    public static function getUsers()
    {
        try {
            $Database = new Database();
            $query = "SELECT id, nome role FROM utilizador fetch first 100 rows only;";

            $result = $Database->EXE_QUERY($query);
        
            return $result;
            
        } catch (PDOException $e) {
            echo "ERROR: " . $e->getMessage();
        }
    }
}

?>