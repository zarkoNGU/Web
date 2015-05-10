<div class="col-md-12">
    <h2>
        <a href="#"><?=  $this->post["title"] ?></a>
    </h2>
    <p class="lead">
        by <a href="#"><?= $this->post["username"] ?></a>
    </p>
    <p>
        <span class="glyphicon glyphicon-time"></span> Posted on <?= $this->post["create_time"] ?>   
            <span class="views"><i class="icon-user"></i> <?= $this->post["views"] ?> views</span>    
        <?php if($this->isAdmin()) : ?>
            <a href="/posts/delete/<?=  $this->post["id"] ?>" class="right question-report">Delete</a>
            <a href="/posts/edit/<?=  $this->post["id"] ?>" class="right question-report">Edit</a>
        <?php endif ?>
    </p>     
    <hr>
    <p><?= $this->post["text"] ?></p>                                                                                                       

    <hr>         
    
    <?php foreach ($this->answers as $answer) : ?>   
        <article class="question question-type-normal">
            <h2>
                <?= $answer["title"] ?>                                                                
                <?php if($this->isAdmin()) : ?>                                                       
                    <a class="question-report" href="/posts/delete_answer/<?= $answer["id"] ?>">Delete</a>
                <?php endif ?>      
                <span class="question-type-main right"><i class="icon-question-sign"></i>Answer</span>                                                                             
            </h2>                                             
<!--            <div class="question-type-main"><i class="icon-question-sign"></i>Answer</div> -->
            <div class="question-author">
                <a href="#" original-title="ahmed" class="question-author-img tooltip-n"><span></span><img alt="" src="http://2code.info/demo/html/ask-me/images/demo/avatar.png"></a>
            </div>
            <div class="question-inner">     
                <p class="question-desc"><?= $answer["text"] ?></p>
                <div class="question-details">                                                                        
                    <span class="question-favorite"><i class="icon-star"></i>Best answer</span>
                </div>                                                                                             
                <span class="question-date"><i class="icon-time"></i><?= $answer["create_time"] ?></span>                       
                <span class="question-view"><i class="icon-user"></i><?= $answer["username"] ?></span>
                <div class="clearfix"></div>
            </div>
        </article>
    <?php endforeach ?>
    
    <?php if($this->isLoggedIn()) : ?>  
        <article class="question question-type-normal">
            <h3 style="margin-top: 0px;">
                <?php if(count($this->answers) > 0): ?>Add new answer
                <?php else: ?> Ооооооо ЩЕ ПИШЕШ ПЪРВИЯ КОМЕНТАР А?
                <?php endif ?>
            </h2> 
            <form method="POST" action="">
                <label for="title">Title</label>
                <input type="text" name="title" class="form-control" autocomplete="off">
                
                <label for="text">Text</label>
                <textarea rows="10" name="text" class="form-control"></textarea>
                
                <button type="submit" class="btn btn-success mt20">Add</button>
            </form>
        </article>
    <?php endif ?>        
</div>                        