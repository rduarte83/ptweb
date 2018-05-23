<?php

require_once("class_database.php");

if ( isset($_POST,$_POST["pwd"],$_POST) ) {
    return;
}


class Login 
{
    public function __contruct($email, $pwd)
    {
        $gestor = new Database();
        $parametros = [
            ':email'    => $email
        ];
        verifyData($email);
        $dados = $gestor->EXE_QUERY('SELECT * FROM vw_utilizadores WHERE mail = :email',$parametros);

        $id = $dados[0]['id'];

        $id_array = [
            ':id' => $id,
            ':pwd' => $pwd
        ];

        $pass = $gestor->EXE_QUERY('SELECT password = crypt(:pwd, password) FROM utilizador WHERE id = :id;',$id_array);
        if ($pass) self::iniciarSessao($dados);
            else exit();
    }

    public static function verificarLogin(){
        //verifica se o utilizador tem sessão ativa
        $resultado = false;

        if(isset($_SESSION['tipo'])){
            $resultado = true;
        }
        return $resultado;
    }

    public static function iniciarSessao($dados){
        //iniciar a sessão
        $_SESSION['id'] = $dados[0]['id'];
        $_SESSION['nome'] = $dados[0]['nome'];
        $_SESSION['role'] = $dados[0]['role_nome'];
    }

    public static function destroiSessao(){
        //destroi as variáveis da sessão
        unset($_SESSION['id']);
        unset($_SESSION['nome']);
        unset($_SESSION['role']);
    }

    public static function verifyData($email)
    {
        if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
            exit();
        }
    }



}