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
            var_dump($arrParamZona);

            $sql = "INSERT INTO zona_episodio_dor VALUES (:episodio_dorid, :zonaid, :intensidade)";

            $result = $db->EXE_NON_QUERY($sql, $arrParamZona, false);
            var_dump($result->rowCount());

            if($result->rowCount()>0)
                $sucesso = true;
            else
                $sucesso = false;
        }

        if($sucesso)
            $resposta = ["message" => "Registo da dor efectuado com sucesso", "status"=> 1];

        return $resposta;
    }
}
?>