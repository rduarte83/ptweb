<?php
require_once("../../../includes/php/class_dor.php");
if(!isset($_POST, $_POST["utente"])){
    exit();
}

$utente = $_POST["utente"];
$EpisodiosDor = Dor::getListaDor($utente);

?>
<div class="row-fluid">
    <table class="table" id="tabela-epDor">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Data</th>
                <th scope="col">nº Zonas</th>
                <th scope="col">Ações</th>
            </tr>
        </thead>
        <tbody>
                <?php 
                foreach($EpisodiosDor as $epiDor)
                {
                    echo '<tr>';
                    echo '  <th scope="row">'.$epiDor["id"].'</th>';
                    echo '  <td>'.$epiDor["data"].'</td>';
                    echo '  <td>'.$epiDor["num_zona"].'</td>';
                    echo '  <td>';
                    echo '      <button class="btn button btn-ver" id-episodio="'.$epiDor["id"].'"><i></i>Ver</button>';
                    echo '  </td>';
                    echo '</tr>';
                }
                ?>
        </tbody>
    </table>
</div>