<?php
    if(!isset($_POST, $_POST["idTreino"])){
        exit();
    }
    if(!isset($_SESSION))
    session_start();
    require_once("../../../includes/php/class_treinos.php");
    $treinos = Treinos::getTreino($_POST["idTreino"]);   
?>
<div class="row treinosBox">
    <div class="col-md-12">
        <div class="col-md-12">
            <div class="float-left sizeLetter">
                Data inicio - <?php echo $treinos[0]["data_inicio"]; ?>
            </div>

            <div class="clear-fix float-right sizeLetter">
                Data Fim - <?php echo $treinos[0]["data_fim"]; ?>
            </div>
        </div>
        
    </div>
    
    <div class="col-md-12">
        <hr style="color:white; border: 3px solid" />
    </div>

    <div class="col-md-4">
        O que deve fazer:
        <?php echo $treinos[0]["descricao"]; ?>
    </div>
    <div style="margin-top: 50px;" class="col-md-8">   
    <?php foreach($treinos as $treino){ ?>

    <div>    
        <div class="offset-md-2 col-md-8" >
            <video id="my-video" class="video-js" controls preload="auto" width="100%" height="460" data-setup="{}">
                <source src="<?php echo $treino["url_video"]?>" type='video/mp4'>
                <p class="vjs-no-js">
                    To view this video please enable JavaScript, and consider upgrading to a web browser that
                    <a href="http://videojs.com/html5-video-support/" target="_blank">supports HTML5 video</a>
                </p>
            </video>
        </div>
        <div class="offset-md-2 col-md-8" >
                <p>Descrição do Video:<?php echo $treino["descricao_video"]; ?></p>
        </div>
    </div>

<?php } ?>

</div>
