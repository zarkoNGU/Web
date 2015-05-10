<div class="col-md-12">
    <form method="POST" action="">
        <label for="title">Title</label>
        <input type="text" name="title" value="<?= $this->post["title"] ?>" class="form-control" autocomplete="off">
        
        <label for="text">Text</label>
        <textarea rows="10" name="text" class="form-control"><?= $this->post["text"] ?></textarea>
        
        <button type="submit" class="btn btn-success mt20">Edit</button>
    </form>
</div>