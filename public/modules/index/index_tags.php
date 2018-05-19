<div class="row tagsTop">
    <div class="row">
        <?php
            // GET TAGS
            require_once("includes/php/class_artigos.php");
            $tags = new Artigos();
            $tags->listaCategorias();
            foreach($tags->listaCategorias() as $tag){
                
                echo "<a class='btn btn-primary btn-sm' href='#' role='button'>Tags :" .$elem['nome_zona']."</a>";
            }
        ?>
        
        <a class="btn btn-primary btn-sm " href="#" role="button">Tags 2</a>
        <a class="btn btn-primary btn-sm " href="#" role="button">Tags 3</a>
        <a class="btn btn-primary btn-sm " href="#" role="button">Tags 4</a>
        <a class="btn btn-primary btn-sm " href="#" role="button">Tags 5</a>
        <a class="btn btn-primary btn-sm " href="#" role="button">Tags 6</a>
        <a class="btn btn-primary btn-sm " href="#" role="button">Tags 1</a>
    </div>
</div>