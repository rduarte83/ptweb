<div class="row tagsTop">
    <div class="row">
        <?php
            // GET TAGS
            require_once("includes/php/class_artigos.php");
            $tags = new Artigos();
            foreach($tags->listaCategorias() as $tag){
                
                echo "<a class='btn btn-primary btn-sm' href='#' role='button'>" .$tag['cat']."</a>";
            }
        ?>
    </div>
</div>