<?php
require_once("class_database.php");

$art = new Artigos();
$art->listaArtigos();

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
        $db = $GLOBALS["DB"];
        
        $sql = "SELECT * FROM artigo";

        $stmt = $db->prepare($sql);
        $stmt->execute();
        $result = $stmt->fetchAll();

        var_dump($result);
        return $lista;
    }

}


?>