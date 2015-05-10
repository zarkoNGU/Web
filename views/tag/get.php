<div class="col-md-12">        
    <?php if(count($this->posts) > 0) : ?>                                                     
        <?php foreach ($this->posts as $post) : ?>       
            <h2>
                <a href="/posts/get/<?=  $post["id"] ?>"><?=  $post["title"] ?></a>
            </h2>
            <p class="lead">
                by <a href="#"><?= $post["username"] ?></a>      
            </p>
            <p>
                <span class="glyphicon glyphicon-time"></span> Posted on <?= $post["create_time"] ?>
                <?php if($this->isAdmin()) : ?>
                    <a href="posts/delete/<?=  $post["id"] ?>" class="right question-report">Delete</a>
                    <a href="posts/edit/<?=  $post["id"] ?>" class="right question-report">Edit</a>
                <?php endif ?>
            </p>     
            <hr>
            <p><?= $post["text"] ?></p>                                                                                                       

            <hr>     
        <?php endforeach ?> 
    <?php else : ?>
        <h2>No posts found</h2>
    <?php endif ?>             
</div>                        