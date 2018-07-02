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
        $sql = "SELECT * FROM vw_artigo WHERE aprovado = true";
        $result = $db->EXE_NON_QUERY($sql);
        return ($result);

    }

    public function listaCategorias()
    {
        require_once("class_database.php");
        // Query nome_expressao
        $db = new Database();

        // Query nome_zona
        $sql = "SELECT  id, nome FROM zona";

        $result = $db->EXE_QUERY($sql, null, true);

        foreach ( $result as $item ) {
            array_push($this->listaCat, ["id" => $item["id"],"cat" => $item["nome"]]);
        }

        return ($this->listaCat);
    }

    public static function  getCategorias()
    {
        $listaCat = [];
        require_once("class_database.php");
        // Query nome_expressao
        $db = new Database();

        // Query nome_zona
        $sql = "SELECT DISTINCT id, nome FROM zona";

        $result = $db->EXE_QUERY($sql, null, true);

        foreach ( $result as $item ) {
            array_push($listaCat, ["id" => $item["id"],"cat" => $item["nome"]]);
        }

        return ($listaCat);
    }

    public static function limit_text($text, $limit) {
        if (str_word_count($text, 0) > $limit) {
            $words = str_word_count($text, 2);
            $pos = array_keys($words);
            $text = substr($text, 0, $pos[$limit]) . '...';
        }
        return $text;
    }

    public static function insertArtigo($titulo, $noticia, $categorias){
        try {

            $Database = new Database();
            $arrParam = [
                ":titulo" => $titulo,
                ":noticia" => $noticia,
                ":id" => $_SESSION["id"],
            ];

            if(!isset($_SESSION)) session_start();
            if($_SESSION["role_id"]==2){
                $query = "INSERT INTO artigo 
                    (id, autor, titulo, conteudo, data_criacao, data_edicao, aprovado)
                    VALUES(DEFAULT, :id, :titulo, :noticia, now(), null, TRUE) RETURNING id";
            }else {
                $query = "INSERT INTO artigo 
                    (id, autor, titulo, conteudo, data_criacao, data_edicao)
                    VALUES(DEFAULT, :id, :titulo, :noticia, now(), null) RETURNING id";
            }
            

            $result1 = $Database->EXE_NON_QUERY($query, $arrParam, false);


            if($result1 != null){
                $id_artigo = $result1->fetch(PDO::FETCH_ASSOC)["id"];
                foreach( $categorias as $cat ) {
                    $arrParam = [
                        ":id_zona" => intval($cat),
                        ":id_artigo" => intval($id_artigo),
                    ];
                    $query = "INSERT INTO zona_artigo (zonaid, artigoid)
                        VALUES (:id_zona, :id_artigo)";
                    $result2 = $Database->EXE_NON_QUERY($query, $arrParam, false);
                }
                return $result1->rowCount();
            }
                

        } catch (PDOException $e) {
            echo "ERROR: " . $e->getMessage();
        }

    }

    public static function getListaArtigosAprovar ()
    {
        require_once("class_database.php");
        $Database = new Database();

        $query = "SELECT a.*, u.nome as prof_saude FROM artigo as a
        INNER JOIN utilizador as u ON u.id = a.autor
        WHERE aprovado = false";

        $result = $Database->EXE_QUERY($query);
        return $result;
    }

    public static function aprovarArtigo ($id)
    {
        require_once("class_database.php");
        $Database = new Database();

        $arrParam = [
            ":id" => intval($id),
        ];


        $query = "UPDATE artigo 
        SET aprovado = TRUE
        WHERE id=:id";

        $result = $Database->EXE_NON_QUERY($query, $arrParam, false);

        return $result->rowCount();
    }

    public static function removerArtigo ($id)
    {
        require_once("class_database.php");
        $Database = new Database();

        $arrParam = [
            ":id" => intval($id),
        ];


        $query = "DELETE FROM video WHERE id = (SELECT videoid FROM artigo_video WHERE artigoid=:id);";
        $query2 = "DELETE FROM artigo_video WHERE artigoid=:id;";
        $query3 = "DELETE FROM artigo WHERE id=:id;";

        

        $result = $Database->EXE_NON_QUERY($query, $arrParam, false);
        $result = $Database->EXE_NON_QUERY($query2, $arrParam, false);
        $result = $Database->EXE_NON_QUERY($query3, $arrParam, false);

        return $result->rowCount();
    }

}