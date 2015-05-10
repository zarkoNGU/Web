<?php

class PostController extends BaseController {     
    private $postModel;

    protected function onInit() {
        $this->title = 'Welcome';
        $this->postModel = new PostModel();
    }
                        
    public function get($id) {
        if(is_numeric($id)){       
            $this->post = $this->postModel->getPost($id);       
            $this->answers = $this->postModel->getAnswers($id);       
            if(count($this->post) <= 0){     
                $this->addErrorMessage("Post does not exist!");
                $this->redirect();
            }     
        }else{       
            $this->addErrorMessage("Missing numeric id of post!");
        }                                            
    }    
    
    public function getPost($id) {        
        $id = self::$db->quote_smart($id);     
        
        $sql = "SELECT
                    p.*, u.username
                FROM posts AS p
                LEFT JOIN users AS u ON u.id = p.user_id
                WHERE p.active = '1' and p.id = '{$id}'";    
        $query = self::$db->query($sql);  
        $post = array();
        while( $row = self::$db->fetch_assoc($query) ){
            $row["title"] = htmlspecialchars($row["title"]);
            $row["text"] = htmlspecialchars($row["text"]);
            $row["create_time"] = date("M d \, Y \a\\t h:i A", $row["create_time"]);
            $post = $row;   
        }
                                             
        return $post;
    }
    public function getAnswers($id) {        
        $id = self::$db->quote_smart($id);     
        
        $sql = "SELECT
                    a.*, u.username
                FROM posts_answers AS a
                LEFT JOIN users AS u ON u.id = a.user_id
                WHERE a.id = '{$id}'";    
        $query = self::$db->query($sql);  
        $answers = array();
        while( $row = self::$db->fetch_assoc($query) ){
            $row["title"] = htmlspecialchars($row["title"]);
            $row["text"] = htmlspecialchars($row["text"]);
            $row["create_time"] = date("M d \, Y \a\\t h:i A", $row["create_time"]);
            $answers[] = $row;   
        }
                                             
        return $answers;
    }                
}
