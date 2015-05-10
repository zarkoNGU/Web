<?php

class HomeController extends BaseController {     
    private $homeModel;

    protected function onInit() {
        $this->title = 'Welcome';
        $this->homeModel = new HomeModel();   
        if(isset($_COOKIE["id"]) && !empty($_COOKIE["id"]) && is_numeric($_COOKIE["id"])){             
            $this->user = $this->homeModel->getUser($_COOKIE["id"]);
        }                                                         
    }
                        
    public function index() {    
        if ($this->isPost()) {  
            $error = false;           
            if(isset($_POST["username"]) && !empty($_POST["username"])){
                $username = $_POST["username"];    
            }else{                          
                $error = true;
            }
            
            if(isset($_POST["password"]) && !empty($_POST["password"])){
                $password = $_POST["password"];    
            }else{                                            
                $error = true;
            }
            
            
            if(isset($_POST["register"]) && $_POST["register"] == 1 && !$error){     
                if(isset($_POST["email"]) && !empty($_POST["email"]) && filter_var($_POST["email"], FILTER_VALIDATE_EMAIL)){  
                    $email = $_POST["email"];    
                    $user["id"] = $this->homeModel->register($username, $password, $email);                
                    setcookie("id", $user["id"]);                  
                    $this->addInfoMessage("Successfully registered!");  
                }else{                                            
                    $error = true;
                    $this->addErrorMessage("Wrong email!");
                }    
            }else{    
                if($this->isLoggedIn()){   
                    $this->addErrorMessage("You are already logged!");
                    $this->redirect("home");
                }                        
                                                            
                if(!$error){
                    $user = $this->homeModel->checkLogin($username, $password);
                    if(isset($user["id"])){
                        setcookie("id", $user["id"]);            
                        setcookie("is_admin", $user["is_admin"]);      
                        $this->addInfoMessage("Successfully logged!");
                        $this->redirect("home");      
                    }else{          
                        $this->addErrorMessage("Wrong username or password!");
                    }
                }else{
                    $this->addErrorMessage("Cannot login without username and password.");
                }
            }           
        }
           
        if(isset($_GET["search"]) && !empty($_GET["search"])){   
            $this->posts = $this->homeModel->getAll($_GET["search"]);
        }else{            
            $this->posts = $this->homeModel->getAll();
        }
                          
        $this->tags = $this->homeModel->getAllTags();                         
    }    
}
