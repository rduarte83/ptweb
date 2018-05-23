<?php

class Database extends PDO
{
    
    public $db;

    protected $database;
    protected $hostname;
    protected $username;
    protected $password;
    protected $port;

    public function __construct()
    {
        $this->database = "ptaw-gr4-2018";
        $this->hostname = "estga-dev.clients.ua.pt";
        $this->username = "ptaw-gr4-2018";
        $this->password = "8%23wK988Z";
        $this->port = "5432";

        $this->db = new PDO("pgsql:host=$this->hostname;dbname=$this->database;port=$this->port;", $this->username, $this->password);

        $GLOBALS["DB"]=$this->db;
    }

    public function EXE_QUERY($query, $parametros = NULL, $fechar_ligacao = TRUE)
    {
        //executa a query à base de dados (SELECT)
        $resultados = NULL;
    
        //executa a query
        if ($parametros != NULL) {
            $gestor = $this->db->prepare($query);
            $gestor->execute($parametros);
            $resultados = $gestor->fetchAll(PDO::FETCH_ASSOC);
        } else {
            $gestor = $this->db->prepare($query);
            $gestor->execute();
            $resultados = $gestor->fetchAll(PDO::FETCH_ASSOC);
        }

        #fecha a ligação por defeito
        if ($fechar_ligacao) {
            $this->db = NULL;
        }

        #retorna os resultados
        return $resultados;
    }

    public function EXE_NON_QUERY($query, $parametros = NULL, $fechar_ligacao = TRUE)
    {
        //executa uma query com ou sem parâmetros (INSERT, UPDATE, DELETE)
        //executa a query
        $this->db->beginTransaction();
        try {
            if ($parametros != NULL) {
                $gestor = $this->db->prepare($query);
                $gestor->execute($parametros);
            } else {
                $gestor = $this->db->prepare($query);
                $gestor->execute();
            }
            $ligacao->commit();
        } catch (PDOException $e) {
            echo '<p>' . $e . '</p>';
            $this->db->rollBack();
        }

        #fecha a ligacao por defeito
        if ($fechar_ligacao) {
            $this->db = NULL;
        }
    }

}
