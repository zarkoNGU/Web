<?php

class HomeModel extends BaseModel {     
    public function getUser($id) {        
        $id = self::$db->quote_smart($id);     
        
        $sql = "SELECT * FROM users WHERE id = '{$id}'";    
        $query = self::$db->query($sql);     
        return self::$db->fetch_assoc($query);
    }  
    
    public function getAll($keywords = "") {        
        $keywords = self::$db->quote_smart($keywords);     
        
        $sql = "SELECT
                    p.*, u.username
                FROM posts AS p
                LEFT JOIN users AS u ON u.id = p.user_id
                WHERE p.active = '1' AND (p.title LIKE '%{$keywords}%' OR p.text LIKE '%{$keywords}%')
                ORDER BY create_time DESC
                LIMIT 10";    
        $query = self::$db->query($sql);  
        $posts = array();
        while( $row = self::$db->fetch_assoc($query) ){
            $row["title"] = htmlspecialchars($row["title"]);
            $row["text"] = htmlspecialchars($row["text"]);
            $row["create_time"] = date("M d \, Y \a\t h:i A", $row["create_time"]);
            $posts[] = $row;
        }
        return $posts;
    }
    
    public function getAllTags() {           
        $sql = "SELECT * FROM tags";    
        $query = self::$db->query($sql);  
        $tags = array();
        while( $row = self::$db->fetch_assoc($query) ){                            
            $tags[] = $row;
        }
        return $tags;
    }
    
    public function checkLogin($username, $password) {        
        $username = self::$db->quote_smart($username);     
        $password = self::$db->quote_smart($password);
        $crypt_password = sha1($username . "+" . $password);     
        
        $sql = "SELECT id, is_admin FROM users WHERE username = '{$username}' and password = '{$crypt_password}'";    
        $query = self::$db->query($sql);   
        $usr = self::$db->fetch_assoc($query);      
        
        return $usr;
    }
    
    public function register($username, $password, $email) {        
        $arr["username"] = self::$db->quote_smart($username);     
        $password = self::$db->quote_smart($password);
        $arr["email"] = self::$db->quote_smart($email);         
        $arr["password"] = sha1($arr["username"] . "+" . $password);     
        $arr["create_time"] = time();            
                                             
        $id = self::$db->insert("users", $arr);      
        
        return $id;
    }                
}
