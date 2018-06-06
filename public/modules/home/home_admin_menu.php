<div class="row offset-md-2 adminContent">

    <!-- <div class="menu regDor col-md col-sm">
        <h2>ayy</h2>
        <i class="fas fa-chart-line tamIcon"></i>
    </div>

    <div class="menu regDor col-md col-sm">
        <h2>Adicionar Utente</h2>
        <i class="far fa-calendar-alt tamIcon"></i>
    </div>
    <div class="menu regDor col-md col-sm">
        <h2>Adicionar Artigo</h2>
        <i class="fas fa-child tamIcon"></i>        
    </div>
    <div class="menu regDor col-md col-sm">
        <h2>Editar Artigo</h2>
        <i class="fas fa-user-md tamIcon"></i>
    </div>
    <div class="menu regDor col-md col-sm">
        <h2>Adicionar Vídeo</h2>
        <i class="fas fa-user-md tamIcon"></i>
    </div>
    <div class="menu regDor col-md col-sm">
        <h2>Editar Vídeo</h2>
        <i class="fas fa-user-md tamIcon"></i>
    </div> -->
</div>

<!-- Modal for adding user -->
<div class="modal fade" id="addUserModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Form de utilizador</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form class="form-horizontal" id="addUserForm">
                    <fieldset>

                        <!-- Text input http://getbootstrap.com/css/#forms -->
                        <div class="form-group">
                            <label for="password" class="control-label col-sm-2">Password</label>
                            <div class="col-sm-10">
                                <input type="password" class="form-control" name="password" id="password" required="">

                            </div>
                        </div>
                        <!-- Text input http://getbootstrap.com/css/#forms -->
                        <div class="form-group">
                            <label for="nome" class="control-label col-sm-2">Nome</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" name="nome" id="nome" required="">

                            </div>
                        </div>
                        <!-- Text input http://getbootstrap.com/css/#forms -->
                        <div class="form-group">
                            <label for="morada" class="control-label col-sm-2">Morada</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" name="morada" id="morada" required="">

                            </div>
                        </div>
                        <!-- Text input http://getbootstrap.com/css/#forms -->
                        <div class="form-group">
                            <label for="nacionalidade" class="control-label col-sm-2">Nacionalidade</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" name="nacionalidade" id="nacionalidade" placeholder="" required="">

                            </div>
                        </div>
                        <!-- Text input http://getbootstrap.com/css/#forms -->
                        <div class="form-group">
                            <label for="nif" class="control-label col-sm-2">NIF</label>
                            <div class="col-sm-10">
                                <input type="number" class="form-control" name="nif" id="nif" placeholder="*********" maxlength="9" required="">
                            </div>
                        </div>
                        <!-- Text input http://getbootstrap.com/css/#forms -->
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
                                    <option value="1">Masculino</option>
                                    <option value="2">Feminino</option>
                                </select>
                            </div>
                        </div>

                        <!-- Text input http://getbootstrap.com/css/#forms -->
                        <div class="form-group">
                            <label for="data_nascimento" class="control-label col-sm-6">Data de nascimento</label>
                            <div class="col-sm-10">
                                <input type="date" class="form-control" name="data_nascimento" id="data_nascimento" required="">

                            </div>
                        </div>
                        <!-- Text input http://getbootstrap.com/css/#forms -->
                        <div class="form-group">
                            <label for="contacto" class="control-label col-sm-2">Contacto</label>
                            <div class="col-sm-10">
                                <input type="number" class="form-control" name="contacto" id="contacto" placeholder="+351 *********" maxlength="13">

                            </div>
                        </div>
                        <!-- Text input http://getbootstrap.com/css/#forms -->
                        <div class="form-group">
                            <label for="Email" class="control-label col-sm-2">Email</label>
                            <div class="col-sm-10">
                                <input type="email" class="form-control" name="email" id="email">

                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2" for="role">Role</label>
                            <div class="col-sm-10">

                                <select class="form-control" name="role" id="role">
                                    <option value="2">Profissional de saúde</option>
                                    <option value="3">Utente</option>
                                    <option value="1">Admin</option>
                                </select>
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