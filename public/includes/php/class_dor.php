<?php

class Dor
{
    public static function registarDor($zonaCorArray){
        $resposta = ["message" => "Erro ao inserir os dados", "status"=> 0];
        if(!isset($_SESSION))
            session_start();
        $id = $_SESSION["id"];
        $sucesso= false;

        $db = new Database();
        $arrParamEpisodio = [
            ":utente" => intval($id)
        ];

        $sql = "INSERT INTO episodio_dor (data,utente) VALUES (now(),:utente) RETURNING id";
        $result = $db->EXE_NON_QUERY($sql,$arrParamEpisodio, false);
        $episodio_dorid = $result->fetch()['id'];

        foreach($zonaCorArray as $oneByOne)
        {
            $arrParamZona = [
                ":episodio_dorid" => intval($episodio_dorid),
                ":zonaid" => intval($oneByOne[0]),
                ":intensidade" => intval($oneByOne[1]),
            ];
            
            $sql = "INSERT INTO zona_episodio_dor VALUES (:episodio_dorid, :zonaid, :intensidade)";

            $result = $db->EXE_NON_QUERY($sql, $arrParamZona, false);

            if($result->rowCount()>0)
                $sucesso = true;
            else
                $sucesso = false;
        }

        if($sucesso)
            $resposta = ["message" => "Registo da dor efectuado com sucesso", "status"=> 1];

        return $resposta;
    }

    public static function getEpisodioDor($id_user, $epDorID){
        if(!isset($_SESSION))
            session_start();
        $sucesso= false;

        $db = new Database();
        $arrParam = [
            ":utente" => intval($id_user),
            ":epDorID" => intval($epDorID)
        ];

        $sql = "SELECT zed.zonaid as zona, zed.intensidade as cor FROM  episodio_dor as ed
        INNER JOIN zona_episodio_dor as zed ON zed.episodio_dorid = ed.id
        INNER JOIN zona as z ON z.id = zed.zonaid
        WHERE utente=:utente AND ed.id=:epDorID";

        $result = $db->EXE_QUERY($sql, $arrParam, false);

        return $result;
    }

    public static function getListaDor($id_user){
        if(!isset($_SESSION))
            session_start();
        
        require_once("class_database.php");
        $db = new Database();
        $arrParam = [
            ":utente" => intval($id_user),
        ];

        $sql = "SELECT id_episodio as id, 
        (SELECT DISTINCT data  FROM vw_episodio WHERE utente=:utente LIMIT 1), COUNT(id_zona) as num_zona 
        FROM vw_episodio 
        WHERE utente=:utente  
        GROUP BY id_episodio 
        HAVING COUNT(id_zona) >= 1;";

        $result = $db->EXE_QUERY($sql, $arrParam, false);

        return $result;
    }
    


}
?>