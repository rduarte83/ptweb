<?php
require_once("class_database.php");

class Artigos
{

    private $lista = [ 
                    "artigo" => [
                        "autor" => "",
                        "titulo" => "",
                        "conteudo" => "",
                        "categorias" => [
                            "expressao" => [],
                            "zonas" => []
                        ]
                    ]];

    private $listaCat = [];

    public function listaArtigos()
    {
        $db = new Database();
        $sql = "SELECT * FROM vw_artigo";
        $result = $db->EXE_NON_QUERY($sql);
        return ($result);

    }

    public function listaCategorias()
    {
        // Query nome_expressao
        $db = new Database();
        $sql = "SELECT DISTINCT nome_expressao FROM vw_categoria";
        $result = $db->EXE_NON_QUERY($sql);

        foreach ( $result as $item ) {
            array_push($this->listaCat, ["cat" => $item["nome_expressao"]]);
        }

        // Query nome_zona
        $sql = "SELECT DISTINCT nome_zona, id_zona FROM vw_categoria";

        $result = $db->EXE_NON_QUERY($sql);

        foreach ( $result as $item ) {
            array_push($this->listaCat, ["id" => $item["id"],"cat" => $item["nome_zona"]]);
        }

        return ($this->listaCat);
    }

    public function limit_text($text, $limit) {
        if (str_word_count($text, 0) > $limit) {
            $words = str_word_count($text, 2);
            $pos = array_keys($words);
            $text = substr($text, 0, $pos[$limit]) . '...';
        }
        return $text;
    }

}


?>