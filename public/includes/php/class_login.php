<?php

require_once("class_database.php");

if ( isset($_POST,$_POST["pwd"],$_POST) ) {
    return;
}


class Login 
{

    protected $email;
    protected $password;

    public function __contruct($email, $pwd)
    {
        $this->email = $email;
        $this->password = $pwd;
    }

    private function verifyData()
    {
        if(filter_var($this->email, FILTER_VALIDATE_EMAIL)){
            echo "hello";
        }
    }
}