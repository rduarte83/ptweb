<?php

class Login 
{
    private static $message = ["status" => 0, "message" => "Erro ao dar login"];
    public function __contruct()
    {
        
    }

    public static function loginEntra ($email, $pwd){
        //New
        require_once("class_database.php");
        $gestor = new Database();
        $email_array = [
            ':email'    => $email
        ];
        if(self::verifyData($email)) {

            $dados = $gestor->EXE_QUERY('SELECT * FROM vw_utilizadores WHERE mail LIKE :email',$email_array,false);
            
            if(empty($dados))
                return self::$message;

            $id = $dados[0]['id'];

            $id_array = [
                ':id' => $id,
                ':pwd' => $pwd
            ];

            $pass = $gestor->EXE_QUERY('SELECT password = crypt(:pwd, password) as pass FROM utilizador WHERE id = :id;',$id_array,false);
            
            if ($pass[0]["pass"]) {
               $arrID = [
                   ":id" => $id
               ];
                //query para definir o current user (logs)
                $query = 'CREATE OR REPLACE FUNCTION f_activeUser() RETURNS integer AS $$ 
                            DECLARE activeuser int := :id; 
                            BEGIN 
                                RETURN activeuser; 
                            END 
                        $$ LANGUAGE plpgsql SECURITY DEFINER;';
                $gestor->EXE_NON_QUERY($query, $arrID);
                self::iniciarSessao($dados);
                self::$message["status"] = 1;
                self::$message["message"] = "Login com sucessso";
            } else{
                return  self::$message;
            }
        }else {
            self::$message["message"]="ALÇLLAACUUUKACKKKR";
        }
        return  self::$message;
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
        if(!isset($_SESSION)){
            session_start();
        }
        

        $_SESSION['id'] = $dados[0]['id'];
        $_SESSION['nome'] = $dados[0]['nome'];
        $role = $dados[0]['role_nome'] == "Prof Saúde Sénior" ? "Prof Saúde" : $dados[0]['role_nome'];
        $_SESSION['role'] = $role;
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
            return false;
        }
        return true;
    }
}