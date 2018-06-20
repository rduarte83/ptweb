<div class="row">
    <nav id="navTop" class="navbar fixed-top navbar-expand-lg navbar-dark corTop">
        <a id="logoDor" class="navbar-brand" href="#">DorLogo</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <!-- Lista categorias -->
            <ul class="navbar-nav mr-auto">
                <li class="nav-item dropdown">
                    <a class="nav-link" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <span class="navbar-toggler-icon"></span> Categorias
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                    <?php
                        require_once("includes/php/class_artigos.php");
                        try {
                            $art = new Artigos();
                            $lista = $art->listaCategorias();
                            foreach($lista as $elem){
                                echo "<a class='dropdown-item' href='#'>".$elem['cat']."</a>";
                            }
                        }catch(Exception $e){
                            var_dump($e);
                        }
                    ?>
                    </div>
                </li>
            </ul>

            <ul class="navbar-nav mr-auto"> 
                <form class="form-inline my-2 my-lg-0">
                    <input class="form-control mr-sm-2" type="search" placeholder="Pesquisar..." aria-label="Search">
                    <button class="btn btn-outline-light my-2 my-sm-0" type="submit">Pesquisar</button>
                </form>
            </ul>

            <!-- Entrar / Login -->
            <ul class="navbar-nav navbar-right"> 
                <li class="nav-item dropdown" id="navEntrar">
                    <?php 
                    if(!isset($_SESSION)) session_start();

                    if(!isset($_SESSION["nome"])): ?>
                    <a class="nav-link" href="#" id="navbarDropdownLogin" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <span class="glyphicon glyphicon-log-in"></span> Entrar
                    </a>
                    <div class="dropdown-menu navbarDropdownLogin" aria-labelledby="navbarDropdownLogin">
                        <form id="formLogin">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Email</label>
                                <input type="email" name="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Email">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputPassword1">Palavra-passe</label>
                                <input type="password" name="pwd" class="form-control" id="exampleInputPassword1" placeholder="Palavra-passe">
                            </div>
                            <button id="btn_entrar" type="submit" class="btn btn-primary">Entrar</button>
                        </form>
                    </div>
                    <?php else: ?>
                    <a class="nav-link dropdown-toggle " href="#" id="navbarDropdownLogin" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <span class="glyphicon glyphicon-log-in"></span> <?php echo $_SESSION["nome"];?>
                    </a>
                    <!--<div class="dropdown-menu" aria-labelledby="navbarDropdownLogin">
                        <div id="logout"><i class="fas fa-exit"></i>Sair</div>
                    </div>-->
                    <div class="dropdown-menu loginOptions">
                        <div id="painel" style="cursor:pointer;">Painel</div>
                        <div class="dropdown-divider"></div>
                        <div id="logout" style="cursor:pointer;"><i class="fas fa-sign-out-alt"></i>Sair</div>
                    </div>
                    <?php endif; ?>
                </li>
            </ul>
        </div>
    </nav>
</div>