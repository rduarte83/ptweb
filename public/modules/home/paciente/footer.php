<?php 
// GetProfissinal de Saúde
require_once("includes/php/class_users.php");
$profissional = User::getProfissinal();
$profissional = $profissional[0];
?>

<nav class="navbar fixed-bottom navbar-expand-lg navbar-dark barColor">
    <img src="..." alt="..." class="img-thumbnail">
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarProfissional" aria-controls="navbarProfissional" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarProfissional">
        <!-- Lista categorias -->
        <ul class="navbar-nav mr-auto profSaude">
            Profissional de Saúde - <?php echo $profissional["nome"];?>
        </ul>
        <!-- Entrar / Login -->
        <ul class="navbar-nav navbar-right"> 
            <a class="navbar-brand" href="#"><i class="fas fa-envelope"></i></a>
        </ul>
    </div>


    <div class="Mensagens">
       
        <div id="containerMensagem">
            <div id="infoProfissional" style="cursor: pointer;" class="navbar navbar-dark barColor">
                <img src="..." alt="..." class="img-thumbnail">

                <div class="collapse navbar-collapse" >
                    <!-- Lista categorias -->
                    <ul class="navbar-nav mr-auto profSaude">
                        Profissional de Saúde - <?php echo $profissional["nome"];?>
                    </ul>
                </div>
            </div>
            <div id="chatHolder">
                <ul class="chat">
                    <li class="esquerda text-left">112312sadjfg7wa6tf7asdygufasdifasgdufbasdf</li>   
                    <li class="esquerda text-left">112312sadjfg7wa6tf7asdygufasdifasgdufbasdf</li>  
                    <li class="esquerda text-left">112312sadjfg7wa6tf7asdygufasdifasgdufbasdf</li>  
                    <li class="esquerda text-left">112312sadjfg7wa6tf7asdygufasdifasgdufbasdf</li>  
                    <li class="esquerda text-left">112312sadjfg7wa6tf7asdygufasdifasgdufbasdf</li>  
                    <li class="direita text-right">112312sadjfg7wa6tf7asdygufasdifaasdasdasdsasgdufbasdf</li>  
                    <li class="direita text-right">112312sadjfg7wa6tf7asdygufasdifaasdasdasdsasgdufbasdf</li>  
                    <li class="direita text-right">112312sadjfg7wa6tf7asdygufasdifaasdasdasdsasgdufbasdf</li>  
                    <li class="direita text-right">112312sadjfg7wa6tf7asdygufasdifaasdasdasdsasgdufbasdf</li>  
                    <li class="direita text-right">112312sadjfg7wa6tf7asdygufasdifaasdasdasdsasgdufbasdf</li>  
                <ul>
            </div>
            <form id="formChat">
                <div >
                    <textarea rows="5" class="form-control" name="mensagem" id="mensagem" wrap="soft"></textarea>
                </div>
            
                <input type="hidden" id="id_to" value="<?php echo $profissional["id"];?>" />
                <div >
                    <input id="submitFormChat" type="submit" value="Enviar" >
                </div>
            </form>
        </div>
    </div>
</nav>