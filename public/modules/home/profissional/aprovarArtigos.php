<?php
require_once("../../../includes/php/class_artigos.php");
$artigos = Artigos::getListaArtigosAprovar();

?>
<div class="row-fluid">
    <table class="table" id="tabela-aprovar">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Profissional de Saúde</th>
                <th scope="col">Titulo artigo</th>
                <th scope="col">Descrição</th>
                <th scope="col">Ações</th>
            </tr>
        </thead>
        <tbody>
                <?php 
                foreach($artigos as $artigo)
                {
                    echo '<tr>';
                    echo '  <th scope="row">'.$artigo["id"].'</th>';
                    echo '  <td>'.$artigo["prof_saude"].'</td>';
                    echo '  <td>'.$artigo["titulo"].'</td>';
                    echo '  <td>'.Artigos::limit_text($artigo["conteudo"],7).'</td>';
                    echo '  <td>';
                    echo '      <button class="btn button btn-aprovar" id-aprovar="'.$artigo["id"].'"><i></i>Aprovar</button>';
                    echo '      <button class="btn button btn-rejeitar" id-aprovar="'.$artigo["id"].'"><i></i>Rejeitar</button>';
                    echo '  </td>';
                    echo '</tr>';
                }
                ?>
                
                    
            
        </tbody>
    </table>
</div>