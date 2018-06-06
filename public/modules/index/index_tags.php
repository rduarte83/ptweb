<div class="row tagsTop" style="margin-right: 0">
    <div class="row">
        <?php
            // GET TAGS
            require_once("includes/php/class_artigos.php");
            $tags = new Artigos();
            foreach($tags->listaCategorias() as $tag){
                
                echo "<a class='btn btn-primary btn-sm' href='#' role='button' tag-id='".$tag["id"]."'>" .$tag['cat']."</a>";
            }
        ?>
    </div>
</div>