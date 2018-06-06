<?php
  header('content-type: application/json; charset=utf-8');
  require_once("class_database.php");

  try {

    $test = new Database();

    $DB->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    $q = "SELECT id, nome, role FROM utilizador fetch first 100 rows only;";
    $statement = $DB->prepare( $q );

    $statement->execute();

    $reg = $statement->fetchAll(PDO::FETCH_ASSOC);

    echo json_encode($reg);
    
  } catch (PDOException $e) {
    echo "ERROR: " . $e->getMessage();
  }
?>
