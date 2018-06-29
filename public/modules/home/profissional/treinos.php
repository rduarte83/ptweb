<?php
    if(!isset($_SESSION))
        session_start();
    
    if( !isset($_SESSION["role"])){
        header ( "location: index.php" ); 
    }
?>
<div class="row-fluid col-md-11" >
    <h1>Adicionar treino</h1>
    <form class="form-horizontal" id="addTreinoForm" method="post" enctype="multipart/form-data">

        <div class="form-group">
            <label for="pacienteTreinoAdd" class="control-label col-sm-2">Paciente</label>
            <div class="col-sm-11">
                <select class="form-control" name="utente" id="pacienteTreinoAdd" >
                    <option value="-1">Selecione o paciente...</option>
                </select>
            </div>
        </div>
        <div class="form-group">
            <label for="data" class="control-label col-sm-2">Data Inicio</label>
            <div class="col-sm-11">
                <input type="date" class="form-control" name="data-inicio" id="data-inicio">
            </div>
        </div>
        <div class="form-group">
            <label for="data" class="control-label col-sm-2">Data Fim</label>
            <div class="col-sm-11">
                <input type="date" class="form-control" name="data-fim" id="data-fim">
            </div>
        </div>
        <div class="form-group">
            <label for="notas" class="control-label col-sm-2">Descrição</label>
            <div class="col-sm-11">
                <textarea class="form-control" name="descricao" id="descricao" rows="3"></textarea>
            </div>
        </div>
        <div class="form-group">
            <label for="notas" class="control-label col-sm-1">Video</label>
            <div class="col-sm-11">
                <input type="file" class="form-control" name="file[]" id="video" multiple="multiple">
            </div>
            <div class="col-sm-11">
                <input type="text" class="form-control" name="descVideo" id="descVideo" placeholder="Descrição do video">
            </div>
            <input type="hidden" name="profSaude" value="<?php echo $_SESSION['id'];?>">
            <input type="hidden" name="cmd" value="insertTreino">
        </div>
        <div class="clear-fix form-group">
            <button type="submit" class="btn btn-primary">Guardar</button>
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
        </div>
        
    </form>

    <div id="respostaTreinos"></div>
</div>

<script>
    carregaDataSelectTreino();
</script>