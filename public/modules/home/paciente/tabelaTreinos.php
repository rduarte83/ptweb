<div class="">
    <div class="table-responsive">
        <table class="table" id="tabela-treinos">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Data Inicio</th>
                    <th scope="col">Data Fim</th>
                    <th scope="col">Descrição</th>
                    <th scope="col">Concluído</th>
                    <th scope="col">Ações</th>
                </tr>
            </thead>
            <tbody>
                <?php 
                    if(!isset($_SESSION))
                        session_start();
                    require_once("../../../includes/php/class_treinos.php");
                    $treinos = Treinos::getTreinos($_SESSION["id"]);
                    foreach( $treinos as $treino){
                        echo '<tr>';
                        echo '  <th scope="row">'.$treino["id"].'</th>';
                        echo '  <td>'.$treino["data_inicio"].'</td>';
                        echo '  <td>'.$treino["data_fim"].'</td>';
                        echo '  <td>'.$treino["descricao"].'</td>';
                        echo '  <td>'.$treino["concluido"].'</td>';
                        echo '  <td><button class="btn button btn-treino" id-treino="'.$treino["id"].'">Ver treino</button></td>';
                        echo '</tr>'; 
                    }
                    
                ?>
            </tbody>
        </table>
    </div>
</div>

<script>
    tableTreino = $("#tabela-treinos").DataTable();
</script>