<div class="">
    <div class="table-responsive">
        <table class="table" id="tabela-consultas">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Data</th>
                    <th scope="col">Profissional de Saúde</th>
                    <th scope="col">Notas</th>
                </tr>
            </thead>
            <tbody>
                <?php 
                    if(!isset($_SESSION))
                        session_start();
                    require_once("../../../includes/php/class_consultas.php");
                    $consultas = Consultas::getConsultas($_SESSION["id"]);
                    foreach( $consultas as $consulta){
                        echo '<tr>';
                        echo '  <th scope="row">'.$consulta["id"].'</th>';
                        echo '  <td>'.$consulta["data"].'</td>';
                        echo '  <td>'.$consulta["prof_saude"].'</td>';
                        echo '  <td>'.$consulta["notas"].'</td>';
                        echo '</tr>';
                    }
                    
                ?>
            </tbody>
        </table>
    </div>
</div>

<script>
    $("#tabela-consultas").DataTable();
</script>