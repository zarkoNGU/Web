<div class="col-md-12">
    <a href="/posts/add" class="btn btn-success right">Add New Post</a>     
    <div class="clear"></div>       
    <?php foreach ($this->posts as $post) : ?>       
        <h2>
            <a href="/posts/get/<?=  $post["id"] ?>"><?=  $post["title"] ?></a>
        </h2>
        <p class="lead">
            by <a href="#"><?= $post["username"] ?></a>    
        </p>
        <p>                                                                             
            <span class="glyphicon glyphicon-time"></span> Posted on <?= $post["create_time"] ?>     
            <span class="views"><i class="icon-user"></i> <?= $post["views"] ?> views</span>    
            <?php if($this->isAdmin()) : ?>
                <a href="/posts/delete/<?= $post["id"] ?>" class="right question-report">Delete</a>
                <a href="/posts/edit/<?= $post["id"] ?>" class="right question-report">Edit</a>
            <?php endif ?>
        </p>        
        <hr>
        <p><?= $post["text"] ?></p>  
        <hr> 
        <p class="bootstrap-tagsinput"> Tags:          
            <?php foreach ($post["tags"] as $tag) : ?>   
              <a href="/tags/get/<?= $tag["id"] ?>" class="tag label label-info"><?= $tag["name"] ?></a>
            <?php endforeach ?>      
        </p>
        <hr>    
    <?php endforeach ?>        
</div>                        