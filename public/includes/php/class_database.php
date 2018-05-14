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


}
