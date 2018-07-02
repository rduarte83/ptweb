<?php
class Notificacoes
{
    public static function getNotificacoes($id, $role)
    {
        /**
         * $role = 1 ADMIN
         * $role = 2 Profissional de saude sénior
         * $role = 3 Profissional de saude
         * $role = 4 Utente
         */
        $db = new Database();
        $arrParam = [
            ":id" => $_SESSION["id"],
        ];

        switch(intval($role)){
            case 1:
                $arrParam = null;
                $sql = "SELECT * FROM notificacoes as n
                    INNER JOIN treino as t ON t.id = n.id_notificacao
                    INNER JOIN artigo as a ON a.id = n.id_notificacao";
                break;
            case 2:
                $sql = "SELECT * FROM notificacoes as n
                    INNER JOIN treino as t ON t.id = n.id_notificacao
                    INNER JOIN artigo as a ON a.id = n.id_notificacao
                    WHERE t.prof_saude = :id";
                break;
            case 3:
                $sql = "SELECT * FROM notificacoes as n
                    INNER JOIN treino as t ON t.id = n.id_notificacao
                    INNER JOIN artigo as a ON a.id = n.id_notificacao
                    WHERE t.prof_saude = :id OR a.autor = :id ";
                break;
            case 4:
                $sql = "SELECT * FROM notificacoes as n
                    INNER JOIN treino as t ON t.id = n.id_notificacao
                    WHERE t.utente = :id";
                break;
            default:
                $sql = "";
                break;
        }


        $result = $db->EXE_QUERY($sql, $arrParam, false);
        return self::trabalhaMensagem($result);
    }

    public static function getNumberNotificacoes($id, $role)
    {
        /**
         * $role = 1 ADMIN
         * $role = 2 Profissional de saude sénior
         * $role = 3 Profissional de saude
         * $role = 4 Utente
         */
        $db = new Database();
        $arrParam = [
            ":id" => $_SESSION["id"],
        ];

        

        switch(intval($role)){
            case 1:
                $arrParam = null;
                $sql = "SELECT COUNT(n.id) FROM notificacoes as n
                    INNER JOIN treino as t ON t.id = n.id_notificacao
                    INNER JOIN artigo as a ON a.id = n.id_notificacao";
                break;
            case 2:
                $sql = "SELECT COUNT(n.id) FROM notificacoes as n
                        INNER JOIN treino as t ON t.id = n.id_notificacao
                        INNER JOIN artigo as a ON a.id = n.id_notificacao
                        WHERE t.prof_saude = :id AND n.lido = false";
                break;
            case 3:
                $sql = "SELECT COUNT(n.id) FROM notificacoes as n
                    INNER JOIN treino as t ON t.id = n.id_notificacao
                    INNER JOIN artigo as a ON a.id = n.id_notificacao
                    WHERE t.prof_saude = :id AND a.autor = :id AND n.lido = false";
                break;
            case 4:
                $sql = "SELECT COUNT(n.id) FROM notificacoes as n
                    INNER JOIN treino as t ON t.id = n.id_notificacao
                    WHERE t.utente = :id AND n.lido = false";
                break;
            default:
                $arrParam = null;
                $sql = "";
                break;
        }

        $result = $db->EXE_QUERY($sql, $arrParam, false);
        
        return $result[0]["count"];
    }

    public static function setNotificacoesLidas($id)
    {
        $db = new Database();
        $arrParam = [
            ":id" => $_SESSION["id"],
        ];

        $sql = "UPDATE n 
        SET n.lido = true
        FROM notificacoes as n
        INNER JOIN treino as t ON t.id = n.id_notificacao
        INNER JOIN artigo as a ON a.id = n.id_notificacao
        WHERE (t.prof_saude = :id AND a.autor = :id) OR t.utente = :id ";

        $result = $db->EXE_NON_QUERY($sql, $arrParam, false);
        
        return $result->rowCount();
    }

    private static function trabalhaMensagem($conteudo){
        $resposta = "<div class='col-sm-12'>
                        <div class='row col-sm-12 no-text'>
                            Não tem notificações
                        </div>
                    </div>";
        foreach ( $conteudo as $atual){
            if(isset($atual["titulo"])){
                $descText = ($atual["descricao"] != "") ? $atual["descricao"] : $atual["titulo"];
            }else {
                $descText = $atual["descricao"];
            }
            
            $resposta .= "
                <div class='col-sm-12'>
                    <div class='row col-sm-12 descricacao-texto'>
                        <h6>".$atual["mensagem"]."</h6>
                    </div>
                    <div class='row'>
                        <div class='col-sm-6 data-inicio'>
                            <h6>".$atual["data_inicio"]."</h6>
                        </div>
                        <div class='col-sm-6 data-fim'>
                            <h6>".$atual["data_fim"]."</h6>
                        </div>
                    </div>
                    <div class='row col-sm-12 descricacao-texto'>
                        <p>". $descText ."</p>
                    </div>                    
                </div>
                <div class='dropdown-divider'></div>
            ";
        }
        return $resposta;
    }

}

?>