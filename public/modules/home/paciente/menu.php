<?php
    require_once("includes/php/class_users.php");

    if(!isset($_SESSION))
        session_start();

    $dados = User::getDadosUtente($_SESSION["id"]);
    $dados = $dados[0];
?>

<div class="row menu-row">
    <div id="registarDor" class="menu regDor col-md col-sm">
        <h2>Registar a dor</h2>
        <i class="fas fa-chart-line tamIcon"></i>
    </div>

    <div id="calendario" class="menu regDor col-md col-sm">
        <h2>Calendário</h2>
        <i class="far fa-calendar-alt tamIcon"></i>
    </div>
    <div id="treinos" class="menu regDor col-md col-sm">
        <h2>Treinos</h2>
        <i class="fas fa-child tamIcon"></i>        
    </div>
    <div id="consultas" class="menu regDor col-md col-sm">
        <h2>Consultas</h2>
        <i class="fas fa-user-md tamIcon"></i>
    </div>
    <div id="dadosPessoais" class="menu regDor col-md col-sm">
        <h2>Dados pessoais</h2>
        <i class="fas fa-user-md tamIcon"></i>
    </div>
</div>

<!-- Modal for adding pacient -->
<div class="modal fade" id="utenteInfo" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Informação do utilizador<h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                
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
        </div>
    </div>
</div>
