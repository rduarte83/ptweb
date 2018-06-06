<?php
  header('content-type: application/json; charset=utf-8');
  require_once("class_database.php");

  $password = $_POST["password"];
  var_dump($_POST);
  $nome = $_POST["nome"];
  $morada = $_POST["morada"];
  $nacionalidade = $_POST["nacionalidade"];
  $nif = $_POST["nif"];
  $cc = $_POST["cc"];
  $genero = $_POST["genero"];
  $data_nascimento = $_POST["data_nascimento"];
  $contacto = $_POST["contacto"];
  $email = $_POST["email"];
  $role = $_POST["role"];

  try {

    $test = new Database();

    $DB->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    $q = "INSERT INTO utilizador VALUES(101, :password, :nome,:morada,:nacionalidade,:nif,:cc,:genero,:data_nascimento,:contacto,:email,:role,:data_registo, null);";
    $statement = $DB->prepare( $q );
    $statement->bindParam(':password', $password);
    $statement->bindParam(':nome', $nome);
    $statement->bindParam(':morada', $morada);
    $statement->bindParam(':nacionalidade', $nacionalidade);
    $statement->bindParam(':nif', $nif);
    $statement->bindParam(':cc', $cc);
    $statement->bindParam(':genero', $genero);
    $statement->bindParam(':data_nascimento', $data_nascimento);
    $statement->bindParam(':contacto', $contacto);
    $statement->bindParam(':email', $email);
    $statement->bindParam(':role', $role);
    $statement->bindParam(':data_registo', date("d-m-Y"));

    $statement->execute();

    echo $stmt->rowcount();
    
  } catch (PDOException $e) {
    echo "ERROR: " . $e->getMessage();
  }
?>
