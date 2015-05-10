<?php

class LogoutController extends BaseController {     
    private $logoutModel;

    protected function onInit() {           
        if(isset($_COOKIE["id"]) && is_numeric($_COOKIE["id"])){        
            setcookie("id", "", time()-3600);
            setcookie("is_admin", "", time()-3600);      
            $this->addInfoMessage("Successfully logout!");
            $this->redirect("home");    
        }else{    
            $this->addErrorMessage("You are not logged!");
        }            
        $this->redirect("home");                                             
    }
                        
    public function index() {                
                                             
    }    
}
