<div class="col-md-12">
    <h2>
        <a href="#"><?=  $this->post["title"] ?></a>
    </h2>
    <p class="lead">
        by <a href="#"><?= $this->post["username"] ?></a>
    </p>
    <p><span class="glyphicon glyphicon-time"></span> Posted on <?= $this->post["create_time"] ?></p>     
    <hr>
    <p><?= $this->post["text"] ?></p>                                                                                                       

    <hr>         
    
    <?php foreach ($this->answers as $answer) : ?>   
        <article class="question question-type-normal">
            <h2>
                <a href="single_question.html"><?= $answer["title"] ?></a>
            </h2>
            <a class="question-report" href="#">Report</a>
            <div class="question-type-main"><i class="icon-question-sign"></i>Answer</div>
            <div class="question-author">
                <a href="#" original-title="ahmed" class="question-author-img tooltip-n"><span></span><img alt="" src="http://2code.info/demo/html/ask-me/images/demo/avatar.png"></a>
            </div>
            <div class="question-inner">
                <div class="clearfix"></div>
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
</div>                        