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

    public function listaArtigos()
    {
        $db = new Database();
        $db = $db->db;
        
        $sql = "SELECT * FROM vw_artigo";

        $stmt = $db->prepare($sql);
        $stmt->execute();
        $result = $stmt->fetchAll();

        return ($result);
    }

    public function listaCategorias()
    {
        $db = new Database();
        $db = $db->db;
        
        $sql = "SELECT DISTINCT nome_expressao, nome_zona FROM vw_categoria";

        $stmt = $db->prepare($sql);
        $stmt->execute();
        $result = $stmt->fetchAll();

        return ($result);
    }

}


?>