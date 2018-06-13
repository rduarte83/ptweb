<?php
class Notificacoes
{
    public static function getNotificacoes($id)
    {
        $db = new Database();
        $sql = "SELECT * FROM notificacoes";

        $result = $db->EXE_QUERY($sql);
        return $result;
    }

    public static function getNumberNotificacoes($id)
    {
        $db = new Database();
        $sql = "SELECT COUNT(*) FROM notificacoes";

        $result = $db->EXE_QUERY($sql);
        
        return $result;
    }

}

?>