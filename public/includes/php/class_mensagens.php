<?php
class Mensagens
{
    public static function getMensagens($id, $id_to)
    {
        $db = new Database();
        $arrParam = [
            ":id" => $id,
            ":id_to" => $id_to,
        ];
        $sql = "SELECT * FROM mensagem WHERE (origem=:id AND destino=:id_to) OR (destino=:id AND origem=:id_to)";
        
        $result = $db->EXE_QUERY($sql, $arrParam);
        return $result;
    }

    public static function sendMensagens($id, $id_to, $message)
    {
        $db = new Database();
        $arrParam = [
            ":id" => $id,
            ":id_to" => $id_to,
            ":mensagem" => $message
        ];
        $sql = "INSERT INTO mensagem (data, origem, destino, conteudo) VALUES (now(), :id, :id_to, :mensagem)";
        
        $result = $db->EXE_NON_QUERY($sql, $arrParam);
        return $result->rowCount();
        
    }

    public static function getNumberMensagens($id, $id_to)
    {
        $db = new Database();
        $arrParam = [
            ":id" => $id,
            ":id_to" => $id_to,
        ];
        $sql = "SELECT COUNT(*) FROM mensagem WHERE (origem=:id AND destino=:id_to) OR (destino=:id AND origem=:id_to) AND lida = 0";
        
        $result = $db->EXE_QUERY($sql, $arrParam);

        return $result;
    }

}

?>