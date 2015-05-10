<?php

class PostModel extends BaseModel {  
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
