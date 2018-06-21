<?php
    require_once("../../../includes/php/class_users.php");

    if(!isset($_SESSION))
        session_start();

    $dados = User::getDadosUtente($_SESSION["id"]);
    $dados = $dados[0];
?>

<div class="row-fluid">
    <h3 class="modal-title" id="exampleModalLabel">Informação do utilizador</h3>
    <hr>
    <form>
        <div class="form-group row">
            <label for="Nome" class="col-sm-3 col-form-label">Nome</label>
            <div class="col-sm-9">
                <input type="text" readonly class=" form-control" id="Nome" value="<?php echo $dados["nome"]; ?>">
            </div>
        </div>
        <div class="form-group row">
            <label for="Morada" class="col-sm-3 col-form-label">Morada</label>
            <div class="col-sm-9">
                <input type="text" readonly class=" form-control" id="Morada" value="<?php echo $dados["morada"]; ?>">
            </div>
        </div>
        <div class="form-group row">
            <label for="Nacionalidade" class="col-sm-3 col-form-label">Nacionalidade</label>
            <div class="col-sm-9">
                <input type="text" readonly class="form-control" id="Nacionalidade" value="<?php echo $dados["nacionalidade"]; ?>">
            </div>
        </div>
        <div class="form-group row">
            <label for="Nif" class="col-sm-3 col-form-label">Nif</label>
            <div class="col-sm-9">
                <input type="text" readonly class=" form-control" id="Nif" value="<?php echo $dados["nif"]; ?>">
            </div>
        </div>
        <div class="form-group row">
            <label for="CC" class="col-sm-3 col-form-label">CC</label>
            <div class="col-sm-9">
                <input type="text" readonly class=" form-control" id="CC" value="<?php echo $dados["cc"]; ?>">
            </div>
        </div>
        <div class="form-group row">
            <label for="Genero" class="col-sm-3 col-form-label">Genero</label>
            <div class="col-sm-9">
                <input type="text" readonly class=" form-control" id="Genero" value="<?php echo $dados["genero"]; ?>">
            </div>
        </div>
        <div class="form-group row">
            <label for="dataNasc" class="col-sm-3 col-form-label">Data Nascimento</label>
            <div class="col-sm-9">
                <input type="text" readonly class=" form-control" id="dataNasc" value="<?php echo $dados["data_nascimento"]; ?>">
            </div>
        </div>
        <div class="form-group row">
            <label for="Contacto" class="col-sm-3 col-form-label">Contacto</label>
            <div class="col-sm-9">
                <input type="text" readonly class=" form-control" id="Contacto" value="<?php echo $dados["contacto"]; ?>">
            </div>
        </div>
        <div class="form-group row">
            <label for="Mail" class="col-sm-3 col-form-label">Mail</label>
            <div class="col-sm-9">
                <input type="text" readonly class=" form-control" id="Mail" value="<?php echo $dados["mail"]; ?>">
            </div>
        </div>
        <div class="form-group row">
            <label for="nomeProf" class="col-sm-3 col-form-label">Profissional de Saúde</label>
            <div class="col-sm-9">
                <input type="text" readonly class=" form-control" id="nomeProf" value="<?php echo $dados["prof_saude_nome"]; ?>">
            </div>
        </div>
    </form>
</div>