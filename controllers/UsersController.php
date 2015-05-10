<?php                                   

class UsersController extends BaseController {
    private $usersModel;

    protected function onInit() {
        $this->title = 'Users';
        $this->usersModel = new UsersModel();
    }
                        
    public function index() {
        $this->users = $this->usersModel->getAll();
    }          

    public function edit($id) {
        if ($this->isPost()) {
            $error = false;         
            if(isset($_POST["username"]) && !empty($_POST["username"])){
                $username = $_POST["username"];    
            }else{                          
                $error = true;
            }       
            if(isset($_POST["email"]) && !empty($_POST["email"])){
                $email = $_POST["email"];    
            }else{                          
                $error = true;
            }    
            if(isset($_POST["password"]) && !empty($_POST["password"])){
                $password = $_POST["password"];    
            }else{                          
                $error = true;
            }
            
            if(!$error){                     
                if ($this->usersModel->edit($id, $username, $email, $password)) {
                    $this->addInfoMessage("User edited.");
                    $this->redirect("users");
                } else {
                    $this->addErrorMessage("Cannot edit user without valid password!");
                }  
            }     
        }
                                       
                                       
        $this->user = $this->usersModel->find($id);
        if (!$this->user) {
            $this->addErrorMessage("Invalid user.");
            $this->redirect("users");
        }
    }  
    
    public function delete($id) {
        if ($this->usersModel->delete($id)) {
            $this->addInfoMessage("User deleted.");
        } else {
            $this->addErrorMessage("Cannot delete user #" . htmlspecialchars($id) . '.');
            $this->addErrorMessage("Maybe it is in use.");
        }
        $this->redirect("users");
    }
}
