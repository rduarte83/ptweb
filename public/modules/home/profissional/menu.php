<div id="main_div" class="row menu-row homeProf">

    <div id="show_list_pac" class="menu regDor col-md col-sm">
        <h2>Lista de Utentes</h2>
        <i class="fas fa-chart-line tamIcon"></i>
    </div>
    <div id="add_pac" class="menu regDor col-md col-sm">
        <h2>Adicionar Utente</h2>
        <i class="far fa-calendar-alt tamIcon"></i>
    </div>
    <div id="add_article" class="menu regDor col-md col-sm">
        <h2>Adicionar Artigo</h2>
        <i class="fas fa-child tamIcon"></i>        
    </div>
    <div id="edit_article" class="menu regDor col-md col-sm" style="border-radius: 5px;">
        <h2>Editar Artigo</h2>
        <i class="fas fa-user-md tamIcon"></i>
    </div>
    <div id="add_consulta" class="menu regDor col-md col-sm">
        <h2>Adicionar Consulta</h2>
        <i class="fas fa-user-md tamIcon"></i>
    </div>

    <?php 
    if(!isset($_SESSION))
        session_start();

    if($_SESSION["role_id"]==2): ?>
        <div id="show_list_pedidos" class="menu regDor col-md col-sm">
            <h2>Pedidos de Treinos/Artigos</h2>
            <i class="fas fa-user-md tamIcon"></i>
        </div>
    <?php endif;?>
</div>

<!-- Modal for adding article -->
<div class="modal fade" id="articleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Form de utilizador</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form class="form-horizontal" id="addArticle">
                    <fieldset>

                        <!-- Text input http://getbootstrap.com/css/#forms -->
                        <div class="form-group">
                            <label for="nome" class="control-label col-sm-2">Titulo</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" name="titulo" id="titulo" required="required">

                            </div>
                        </div>
                        <!-- Text input http://getbootstrap.com/css/#forms -->
                        <div class="form-group">
                            <label for="morada" class="control-label col-sm-2">Noticia</label>
                            <div class="col-sm-10">
                                <textarea class="form-control" name="noticia" id="noticia" required="true" rows="10" required="required"></textarea>
                            </div>
                        </div>

                    </fieldset>
                    <button type="submit" class="btn btn-primary">Guardar</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>

                </form>
            </div>
        </div>
    </div>
</div>

<!-- Modal for adding video -->
<div class="modal fade" id="addVideoModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Form de utilizador</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form class="form-horizontal" id="addVideo">
                    <fieldset>

                        <!-- Text input http://getbootstrap.com/css/#forms -->
                        <div class="form-group">
                            <label for="nome" class="control-label col-sm-2">Titulo</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" name="tituloVid" id="tituloVid" required="required">

                            </div>
                        </div>
                        <!-- Text input http://getbootstrap.com/css/#forms -->
                        <div class="form-group">
                            <label for="morada" class="control-label col-sm-2">Noticia</label>
                            <div class="col-sm-10">
                                <textarea class="form-control" name="noticiaVid" id="noticiaVid" required="true" rows="10" required="required"></textarea>
                            </div>
                        </div>

                    </fieldset>
                    <button type="submit" class="btn btn-primary">Guardar</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>

                </form>
            </div>
        </div>
    </div>
</div>

<!-- Modal for adding pacient -->
<div class="modal fade" id="addPacientModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Form de utilizador</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form class="form-horizontal" id="addPacientForm">
                    <fieldset>

                        <div class="form-group">
                            <label for="password" class="control-label col-sm-2">Password</label>
                            <div class="col-sm-10">
                                <input type="password" class="form-control" name="password" id="password" required="">

                            </div>
                        </div>
                        <div class="form-group">
                            <label for="nome" class="control-label col-sm-2">Nome</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" name="nome" id="nome" required="">

                            </div>
                        </div>
                        <div class="form-group">
                            <label for="morada" class="control-label col-sm-2">Morada</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" name="morada" id="morada" required="">

                            </div>
                        </div>
                        <div class="form-group">
                            <label for="nacionalidade" class="control-label col-sm-2">Nacionalidade</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" name="nacionalidade" id="nacionalidade" placeholder="" required="">

                            </div>
                        </div>
                        <div class="form-group">
                            <label for="nif" class="control-label col-sm-2">NIF</label>
                            <div class="col-sm-10">
                                <input type="number" class="form-control" name="nif" id="nif" placeholder="*********" maxlength="9" required="">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="cc" class="control-label col-sm-2">CC</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" name="cc" id="cc" placeholder="*********-***" maxlength="11" required="">

                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-2" for="genero">Genero</label>
                            <div class="col-sm-10">

                                <select class="form-control" name="genero" id="genero">
                                    <option value="M">Masculino</option>
                                    <option value="F">Feminino</option>
                                </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="data_nascimento" class="control-label col-sm-6">Data de nascimento</label>
                            <div class="col-sm-10">
                                <input type="date" class="form-control" name="data_nascimento" id="data_nascimento" required="">

                            </div>
                        </div>
                        <div class="form-group">
                            <label for="contacto" class="control-label col-sm-2">Contacto</label>
                            <div class="col-sm-10">
                                <input type="number" class="form-control" name="contacto" id="contacto" placeholder="+351 *********" maxlength="13">

                            </div>
                        </div>
                        <div class="form-group">
                            <label for="Email" class="control-label col-sm-2">Email</label>
                            <div class="col-sm-10">
                                <input type="email" class="form-control" name="email" id="email">
                            </div>
                        </div>

                    </fieldset>
                    <button type="submit" class="btn btn-primary">Guardar</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Modal for adding Consulta -->
<div class="modal fade" id="addConsultaModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Form de Consultas</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form class="form-horizontal" id="addConsultaForm">
                    <fieldset>

                        <div class="form-group">
                            <label for="paciente" class="control-label col-sm-2">Paciente</label>
                            <div class="col-sm-10">
                                <select class="form-control" name="paciente" id="paciente">
                                    <option value="-1">Selecione o paciente...</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="data" class="control-label col-sm-2">Data</label>
                            <div class="col-sm-10">
                                <input type="date" class="form-control" name="data" id="data" placeholder="">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="notas" class="control-label col-sm-6">Notas</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" name="notas" id="notas">

                            </div>
                        </div>
                    </fieldset>
                    <button type="submit" class="btn btn-primary">Guardar</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                </form>
            </div>
        </div>
    </div>
</div>