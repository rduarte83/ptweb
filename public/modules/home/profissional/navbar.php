<div class="row">
    <nav class="navbar fixed-top navbar-expand-lg">
        <a class="navbar-brand" href="home.php">Painel do Profissional de Saúde</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">
                
            </ul>
            <!-- Entrar / Login -->
            <?php if(!isset($_SESSION)) session_start(); ?>
            <ul class="navbar-nav navbar-right mr-right dropdown">
                <a style="color:#000 !important;" class="nav-link dropdown-toggle " href="#" id="navbarDropdownLogin" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                    <span class="glyphicon glyphicon-log-in"></span><?php echo $_SESSION["nome"];?>
                </a>
                <div class="dropdown-menu loginOptions">
                    <div id="pinicial" style="cursor:pointer;">Página Incial</div>
                    <div class="dropdown-divider"></div>
                    <div id="logout" style="cursor:pointer;"><i class="fas fa-sign-out-alt"></i>Sair</div>
                </div>
            </ul>

            <ul class="navbar-nav navbar-right mr-right dropdown" style="color: black;">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownAlertas" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true" style="color: black;">
                    <i id="numberNotificacoes" class="fas fa-bell" style="color: black;"></i>
                </a>
                <!-- Notificacões -->
                <div id="notificacoes" class="dropdown-menu rightMargin">
                    <div class="dropdown-divider"></div>
                </div>
            </ul>
        </div>
    </nav>

</div>