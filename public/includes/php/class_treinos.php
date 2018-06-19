<?php

class Treinos
{
    public static function getTreinos($id_utente)
    {
        $db = new Database();
        $arrParam = [
            ":id_utente" => intval($id_utente),
        ];

        $sql = "SELECT * FROM  treino WHERE utente=:id_utente";
        $result = $db->EXE_QUERY($sql,$arrParam, false);
        return $result;
    }

    public static function getTreino($id_treino)
    {
        $db = new Database();
        $arrParam = [
            ":id_treino" => intval($id_treino),
        ];

        $sql = "SELECT * FROM  treino WHERE id=:id_treino";
        $result = $db->EXE_QUERY($sql,$arrParam, false);
        return $result;
    }

    public static function insertTreino($data_inicio, $data_fim, $profSaude, $utente, $descricao)
    {
        $db = new Database();
        $arrParam = [
            ":data_inicio" => date("d-m-Y",strtotime($data_inicio)),
            ":data_fim" => date("d-m-Y",strtotime($data)),
            ":id_prof" => intval($profSaude),
            ":id_utente" => intval($utente),
            ":descricao" => $descricao
        ];

        $sql = "INSERT INTO treino (data_criacao, data_inicio, data_fim, prof_saude,utente,descricao) VALUES (now(), :data_inicio, :data_fim, :id_prof, :id_utente, :descricao)";
        $result = $db->EXE_NON_QUERY($sql,$arrParam, false);
        return $result->rowCount();
    }

    public static function updateTreino($data_inicio, $data_fim, $profSaude, $utente, $descricao, $concluido, $id_treino)
    {
        $db = new Database();
        $arrParam = [
            ":data_inicio" => date("d-m-Y",strtotime($data)),
            ":data_fim" => date("d-m-Y",strtotime($data)),
            ":id_prof" => intval($profSaude),
            ":id_utente" => intval($utente),
            ":descricao" => $descricao,
            ":concluido" => $concluido,
            "id_treino" => intval($id_treino)
        ];

        $sql = "UPDATE treino 
        SET data_inicio=:data_inicio, data_fim=:data_fim, prof_saude=:id_prof, utente=:id_utente, descricao=:descricao, concluido=:concluido 
        WHERE id=:id_treino";
        $result = $db->EXE_NON_QUERY($sql,$arrParam, false);
        return $result->rowCount();
    }


}

?>