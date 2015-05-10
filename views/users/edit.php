<h1>Edit User</h1>

<?php if ($this->user) { ?>
<form method="post" action="">     
    <div style="margin-bottom: 25px" class="input-group">
        <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
        <input type="text" class="form-control" name="username" value="<?= $this->user["username"] ?>" placeholder="Username">                                        
    </div>                                                  
    <div style="margin-bottom: 25px" class="input-group">
        <span class="input-group-addon"><i class="glyphicon glyphicon-envelope"></i></span>
        <input type="text" class="form-control" name="email" value="<?= $this->user["email"] ?>" placeholder="E-mail">                                        
    </div>    
    <div style="margin-bottom: 25px" class="input-group">
        <span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
        <input type="password" class="form-control" name="password" placeholder="Your password">
    </div> 
    
    <input type="submit" value="Edit" />
    <a href="/users">Cancel</a>
</form>                  
<?php } ?>
