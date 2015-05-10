<div class="col-md-8">
    <h1 class="page-header">Last 10 posts</h1>
    
    <?php if(count($this->posts) > 0) : ?>                                       
        <?php foreach ($this->posts as $post) : ?>
            <h2>
                <a href="/posts/get/<?= $post["id"] ?>"><?= $post["title"] ?></a>
            </h2>
            <p class="lead">
                by <?= $post["username"] ?>
            </p>
            <p>
                <span class="glyphicon glyphicon-time"></span> Posted on <?= $post["create_time"] ?> 
                <span class="views"><i class="icon-user"></i> <?= $post["views"] ?> views</span>    
            </p>     
            <hr>
            <p><?= $post["text"] ?></p>
            <a class="btn btn-primary" href="/posts/get/<?= $post["id"] ?>">Read More <span class="glyphicon glyphicon-chevron-right"></span></a>

            <hr>                        
        <?php endforeach ?>     
    <?php else : ?>
        <h2>No posts found</h2>
    <?php endif ?>                                   
</div>
 <div class="col-md-4">
           
    <div class="well">
        <h4>Blog Search</h4>
        <form method="get" action="">
            <div class="input-group">         
                <input type="text" name="search" class="form-control">
                <span class="input-group-btn">
                    <button class="btn btn-default" type="submit">
                        <span class="glyphicon glyphicon-search"></span>
                    </button>
                </span>     
            </div>
        </form>                   
    </div>
                                         
    <div class="well">
        <h4>Tags</h4>
        <div class="row">
            <div class="col-lg-6">
                <ul class="list-unstyled">         
                    <?php foreach ($this->tags as $key=>$tag) : ?>
                        <?php if($key % 2 == 0): ?>      
                            <li><a href="/tag/get/<?=  $tag["id"] ?>"><?= $tag["name"] ?></a></li>
                        <?php endif ?>   
                    <?php endforeach ?>       
                </ul>
            </div>                 
            <div class="col-lg-6">
                <ul class="list-unstyled">              
                    <?php foreach ($this->tags as $key=>$tag) : ?>
                        <?php if($key % 2 != 0): ?>      
                            <li><a href="/tag/get/<?=  $tag["id"] ?>"><?= $tag["name"] ?></a></li>
                        <?php endif ?>   
                    <?php endforeach ?> 
                </ul>
            </div>     
        </div>    
    </div>
               
    <div class="well">
        <h4>Your posts are NOT important for me !</h4>                                                                                                                                                   
    </div>

</div>          

