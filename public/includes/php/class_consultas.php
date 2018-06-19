<?php

class Consultas
{

    public static function getConsultas($id_utente)
    {
        require_once("class_database.php");
        $db = new Database();
        $arrParam = [
            ":id_utente" => intval($id_utente),
        ];

        $sql = "SELECT u.nome as utente, ps.nome as prof_saude , c.data, c.id, c.notas FROM consultas as c
        INNER JOIN utilizador as u ON u.id = c.utente
        INNER JOIN utilizador as ps ON ps.id = c.prof_saude
        WHERE utente=:id_utente";
        $result = $db->EXE_QUERY($sql,$arrParam, false);
        return $result;
    }

    public static function getConsulta($id_consulta)
    {
        $db = new Database();
        $arrParam = [
            ":id_consulta" => intval($id_consulta),
        ];

        $sql = "SELECT * FROM  consultas WHERE id=:id_consulta";
        $result = $db->EXE_QUERY($sql,$arrParam, false);
        return $result;
    }

    public static function insertConsulta($data, $profSaude, $utente, $notas)
    {
        $db = new Database();
        $arrParam = [
            ":data" => date("d-m-Y",strtotime($data)),
            ":id_prof" => intval($profSaude),
            ":id_utente" => intval($utente),
            ":notas" => $notas
        ];

        $sql = "INSERT INTO consultas (data,prof_saude,utente,notas) VALUES (:data,:id_prof,:id_utente,:notas)";
        $result = $db->EXE_NON_QUERY($sql,$arrParam, false);
        return $result->rowCount();
    }
    
    public static function updateConsulta($data, $profSaude, $utente, $notas, $id_consulta)
    {
        $db = new Database();
        $arrParam = [
            ":data" => date("d-m-Y",strtotime($data)),
            ":id_prof" => intval($profSaude),
            ":id_utente" => intval($utente),
            ":notas" => $notas,
            ":id_consulta" => intval($id_consulta)
        ];

        $sql = "UPDATE consultas SET data=:data, prof_saude=:id_prof, utente=:id_utente, notas=:notas WHERE id=:id_consulta";
        $result = $db->EXE_NON_QUERY($sql,$arrParam, false);
        return $result->rowCount();
    }

}

?>