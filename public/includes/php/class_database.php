<?php


class Database extends PDO
{
    
    public $db;

    protected $database;
    protected $hostname;
    protected $username;
    protected $password;
    protected $port;

    public function Database()
    {
        $this->database = "grp4-412";
        $this->hostname = "estga-prog.ua.pt";
        $this->username = "ptw";
        $this->password = "ptw";
        $this->port = "5432";

        $this->db = new PDO("pgsql:host=$this->hostname;dbname=$this->database;port=$this->port;charset=utf8", $this->username, $this->password);

        $GLOBALS["DB"]=$this->db;
    }


}
