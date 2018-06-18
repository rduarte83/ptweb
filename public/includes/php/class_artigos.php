<?php
if(!isset($_SESSION))
    session_start();
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
        require_once("class_database.php");
        // Query nome_expressao
        $db = new Database();

        // Query nome_zona
        $sql = "SELECT DISTINCT nome_zona, id_zona FROM vw_categoria";

        $result = $db->EXE_QUERY($sql, null, true);

        foreach ( $result as $item ) {
            array_push($this->listaCat, ["id" => $item["id_zona"],"cat" => $item["nome_zona"]]);
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

    public static function insertArtigo($titulo, $noticia){
        try {

            $Database = new Database();
            $arrParam = [
                ":titulo" => $titulo,
                ":noticia" => $noticia,
                ":id" => $_SESSION["id"],
            ];

            $query = "INSERT INTO artigo 
            (id, autor, titulo, conteudo, data_criacao, data_edicao)
            VALUES(DEFAULT, :id, :titulo, :noticia, now(), null) RETURNING id";

            $result = $Database->EXE_NON_QUERY($query, $arrParam, false);

            if($result != null)
                return $result->rowCount();

        } catch (PDOException $e) {
            echo "ERROR: " . $e->getMessage();
        }

    }

}