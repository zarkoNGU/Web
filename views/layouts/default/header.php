<!--<!DOCTYPE html>
<html>

<head>                                                       
    
</head>

<body>
    <header>
        <a href="/"><img src="/content/images/site-logo.png"></a>
        <ul class="menu">
            <li><a href="/">Home</a></li>
            <li><a href="/authors">Authors</a></li>
            <li><a href="/books">Books</a></li>
        </ul>
    </header>                                                 
             -->
    
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <title><?php echo htmlspecialchars($this->title) ?></title>
                                                                                                                
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css">   
    <link href="//netdna.bootstrapcdn.com/font-awesome/3.2.1/css/font-awesome.css" rel="stylesheet">
    <link rel="stylesheet" href="/content/styles.css" />  
                                                                           
    <script src="//code.jquery.com/jquery-1.11.3.min.js"></script>   
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>                                                  
    <script src="../../../content/js/contact.js"></script>                                                  

<body>                  
<div id="myModal" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title">Register field</h4>
            </div>
            <div class="modal-body">           
                <form method="POST" action="" id="register_form">
                    <input type="hidden" name="register" value="1">                                             
                    <div style="margin-bottom: 25px" class="input-group">
                        <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                        <input type="text" class="form-control" name="username" value="" placeholder="Username">                                        
                    </div>                                                  
                    <div style="margin-bottom: 25px" class="input-group">
                        <span class="input-group-addon"><i class="glyphicon glyphicon-envelope"></i></span>
                        <input type="text" class="form-control" name="email" value="" placeholder="E-mail">                                        
                    </div>
                    <div style="margin-bottom: 25px" class="input-group">
                        <span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
                        <input type="password" class="form-control" name="password" placeholder="Password">
                    </div> 
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" onclick="document.getElementById('register_form').submit();">Register</button>
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>       
            </div>
        </div>
    </div>
</div>
    <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
        <div class="container">                                                                                   
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav">
                    <li>
                        <a href="/">Home</a>
                    </li>
                    <li>
                        <a href="/posts">Posts</a>
                    </li>
                    <li>
                        <a href="/users">Users</a>
                    </li>
                </ul>
                <div class="right">
                    <?php if($this->isLoggedIn()) :?>
                        <div style="padding-top: 12px;">
                            <span class="username">Hello, <?= $this->user["username"] ?></span>
                            <a href="/logout" class="register_button">Logout</a>  
                        </div>                                                  
                    <?php else: ?>            
                            <form method="POST" action="" class="login_form">
                                <input type="text" name="username" placeholder="Username" class="form-control">
                                <input type="password" name="password" placeholder="Password" class="form-control">
                                <button type="submit">Login</button>
                            </form>
                            <a href="#myModal" data-toggle="modal" class="register_button">Register</a>     
                    <?php endif ?>                               
                </div> 
            </div>                        
        </div>                 
    </nav>                                                
    <div class="container">    
        <div class="row">
            <?php include_once('views/layouts/messages.php'); ?>   
