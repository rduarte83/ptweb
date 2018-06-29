<?php

class Treinos
{
    public static function getTreinos($id_utente)
    {
        require_once("class_database.php");
        $db = new Database();
        $arrParam = [
            ":id_utente" => intval($id_utente),
        ];

        $sql = "SELECT * FROM  treino WHERE utente=:id_utente";
        $result = $db->EXE_QUERY($sql,$arrParam, false);
        return $result;
    }

    public static function getTreinosCalendar($id_utente)
    {
        $db = new Database();
        $arrParam = [
            ":id_utente" => intval($id_utente),
        ];

        $sql = "SELECT id, data_inicio AS inicio, data_fim as fim, descricao AS titulo FROM treino WHERE utente=:id_utente";
        $result = $db->EXE_QUERY($sql,$arrParam, false);
        return $result;
    }

    public static function getTreino($id_treino)
    {
        require_once("class_database.php");
        $db = new Database();
        $arrParam = [
            ":id_treino" => intval($id_treino),
        ];

        $sql = "SELECT * FROM vw_treino WHERE id_treino=:id_treino";
        $result = $db->EXE_QUERY($sql,$arrParam, false);
        return $result;
    }

    public static function insertTreino($data_inicio, $data_fim, $profSaude, $utente, $descricao, $descVideo)
    {
        $db = new Database();
        $arrParam = [
            ":data_inicio" => date("d-m-Y",strtotime($data_inicio)),
            ":data_fim" => date("d-m-Y",strtotime($data_fim)),
            ":id_prof" => intval($profSaude),
            ":id_utente" => intval($utente),
            ":descricao" => $descricao
        ];

        $sql = "INSERT INTO treino (data_criacao, data_inicio, data_fim, prof_saude,utente,descricao) VALUES (now(), :data_inicio, :data_fim, :id_prof, :id_utente, :descricao) RETURNING id";
        $result = $db->EXE_NON_QUERY($sql,$arrParam, false);
        
        $id_treino = $result->fetch(PDO::FETCH_ASSOC);

        $arrMensagem = [
            "status"=>0, 
            "message"=>""
        ];

        $arrMensagem=Videos::insertVideoTreino($id_treino["id"], $descVideo);

        if($result->rowCount() > 0){
            $arrMensagem["status"] = 1;
            $arrMensagem["message"] = "Treino criado com sucesso" . "<br>" .  $arrMensagem["message"];
        }
        return $arrMensagem;
        
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