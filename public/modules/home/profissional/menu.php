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
    <div id="add_video" class="menu regDor col-md col-sm">
        <h2>Adicionar Vídeo</h2>
        <i class="fas fa-user-md tamIcon"></i>
    </div>
    <div id="edit_video" class="menu regDor col-md col-sm">
        <h2>Editar Vídeo</h2>
        <i class="fas fa-user-md tamIcon"></i>
    </div>

    <!-- Alert success -->
    <div class="row fluid">
        <div class="alert alert-success" id="success-alert">
            <button type="button" class="close" data-dismiss="alert">x</button>
            <strong>Success! </strong>
            Artigo adicionado!
        </div>
    </div>

    <!-- Alert error -->
    <div class="row fluid">
        <div class="alert alert-danger" id="danger-alert">
            <button type="button" class="close" data-dismiss="alert">x</button>
            <strong>Success! </strong>
            Artigo não adicionado!
        </div>
    </div>

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