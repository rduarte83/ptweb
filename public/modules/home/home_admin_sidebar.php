<div class="row">
    <nav class="col-md-2 d-md-block bg-dark sidebar topPadding">
        <div class="sidebar-sticky">
            <ul class="nav flex-column">
                <li class="nav-item">
                    <a class="nav-link active" href="home.php">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-home"><path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path><polyline points="9 22 9 12 15 12 15 22"></polyline></svg>
                        Dashboard <span class="sr-only">(current)</span>
                    </a>
                </li>
                
                <li class="nav-item">
                    <a id="openDropDownAdmin" class="nav-link" href="#">
                        <i class="fas fa-users"></i>
                        Utilizadores 
                        <i class="fa fa-caret-down"></i>
                    </a>
                        
                    <div class="dropdown-container Admin">
                        <ul>
                            <li><a href="#" id="add_user" data-toggle="modal" data-target="#addUserModal">Adicionar Utilizador</a></li>
                            <li><a href="#">Editar Utilizador</a></li>
                        </ul>                     
                    </div>                
                </li>
            </ul>
        </div>
    </nav>

       
</div>