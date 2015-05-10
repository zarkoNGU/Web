<?php

class PostsController extends BaseController {     
    private $postsModel;

    protected function onInit() {
        $this->title = 'Welcome';
        $this->postsModel = new PostsModel();
    }
                        
    public function index() {        
        $this->posts = $this->postsModel->getAll();      
    }       
      
    public function get($id) {
        if ($this->isPost()){    
            if($this->isLoggedIn()){     
                $error = false;           
                if(isset($_POST["title"]) && !empty($_POST["title"])){
                    $title = $_POST["title"];    
                }else{                          
                    $error = true;
                }
                
                if(isset($_POST["text"]) && !empty($_POST["text"])){
                    $text = $_POST["text"];    
                }else{                                            
                    $error = true;
                }   
                
                if(!$error){         
                    $this->postsModel->add_answer($this->userID(), $id, $title, $text); 
                    $this->addInfoMessage("Successfully addded answer!");  
                    $this->redirect("posts/get/{$id}");    
                }else{     
                    $this->addErrorMessage("Title or text cannot be empty!");
                }
            }else{                
                $this->addErrorMessage("Cannot add answer if you are not logged!");
            }   
        }
        
        if(is_numeric($id)){       
            $this->post = $this->postsModel->getPost($id);       
            $this->answers = $this->postsModel->getAnswers($id);       
            if(count($this->post) <= 0){     
                $this->addErrorMessage("Post does not exist!");
                $this->redirect("home");
            }     
        }else{       
            $this->addErrorMessage("Missing numeric id of post!");
        }                                            
    } 
      
    public function delete_answer($id) {
        if($this->isAdmin()){  
            if(is_numeric($id)){       
                $success = $this->postsModel->deleteAnswer($id);         
                if($success){     
                    $this->addErrorMessage("Successfully deleted answer!");
                    $this->redirect("posts");
                }else{                 
                    $this->addErrorMessage("Something is wrong!");
                }     
            }else{       
                $this->addErrorMessage("Missing numeric id of answer!");
            }
        }else{              
            $this->addErrorMessage("This option is only for admins!");
            $this->redirect("posts");
        }                                              
    }    
    
    public function edit($id) {
        if ($this->isPost()){    
            $error = false;           
            if(isset($_POST["title"]) && !empty($_POST["title"])){
                $title = $_POST["title"];    
            }else{                          
                $error = true;
            }
            
            if(isset($_POST["text"]) && !empty($_POST["text"])){
                $text = $_POST["text"];    
            }else{                                            
                $error = true;
            }   
            
            if(!$error){         
                $this->postsModel->edit($id, $title, $text); 
                $this->addInfoMessage("Successfully edited post!");  
                $this->redirect("posts/get/{$id}");    
            }else{     
                $this->addErrorMessage("Title or text cannot be empty!");
            } 
        }
        
        if(is_numeric($id)){       
            $this->post = $this->postsModel->getPost($id);             
            if(count($this->post) <= 0){     
                $this->addErrorMessage("Post does not exist!");
                $this->redirect("home");
            }     
        }else{       
            $this->addErrorMessage("Missing numeric id of post!");
        }                                            
    } 
    
    public function add() {
        if ($this->isPost()){ 
            if($this->isLoggedIn()){     
                $error = false;     
                $tags = array();      
                if(isset($_POST["title"]) && !empty($_POST["title"])){
                    $title = $_POST["title"];    
                }else{                          
                    $error = true;
                }
                
                if(isset($_POST["text"]) && !empty($_POST["text"])){
                    $text = $_POST["text"];    
                }else{                                            
                    $error = true;
                }   
                       
                if(isset($_POST["tags"]) && !empty($_POST["tags"])){
                    $tags = explode(",", $_POST["tags"]);    
                }
                
                if(!$error){         
                    $id = $this->postsModel->add($this->userID(), $title, $text, $tags); 
                    $this->addInfoMessage("Successfully addded post!");  
                    $this->redirect("posts/get/{$id}");    
                }else{     
                    $this->addErrorMessage("Title or text cannot be empty!");
                }
            }else{                
                $this->addErrorMessage("Cannot add post if you are not logged!");
            }   
        }                                   
    } 
}
