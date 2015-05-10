<?php

class PostsModel extends BaseModel {  
    public function getAll() {          
        $sql = "SELECT
                    p.*, u.username
                FROM posts AS p
                LEFT JOIN users AS u ON u.id = p.user_id
                WHERE p.active = '1'
                ORDER BY p.views DESC";    
        $query = self::$db->query($sql);  
        $posts = array();
        while( $row = self::$db->fetch_assoc($query) ){       
            $row["title"] = htmlspecialchars($row["title"]);
            $row["text"] = htmlspecialchars($row["text"]);
            $row["create_time"] = date("M d \, Y \a\\t h:i A", $row["create_time"]);
                                                                                          
            $sqlTags = "SELECT 
                            t.id, t.name 
                        FROM tags as t
                        LEFT JOIN posts_tags AS pt ON pt.tag_id = t.id
                        WHERE pt.post_id = '{$row["id"]}'";    
            $queryTags = self::$db->query($sqlTags);  
            $row["tags"] = array();
            while( $tag = self::$db->fetch_assoc($queryTags) ){
                $row["tags"][] = $tag;   
            }
            
            $posts[] = $row;   
        }
                                             
        return $posts;
    }    
    public function getPost($id) {        
        $id = self::$db->quote_smart($id);     
        self::$db->query("UPDATE posts SET views = views + 1 WHERE id = '{$id}'");
        
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
                WHERE a.post_id = '{$id}'";    
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
    
    public function edit($id, $title, $text) {        
        $id = self::$db->quote_smart($id);     
        $edit["title"] = self::$db->quote_smart($title);     
        $edit["text"] = self::$db->quote_smart($text);     
        
        self::$db->update("posts", $edit, " id = '{$id}'");   
    }
    
    public function add($user_id, $title, $text, $tags) {       
        $edit["user_id"] = self::$db->quote_smart($user_id);     
        $edit["title"] = self::$db->quote_smart($title);     
        $edit["text"] = self::$db->quote_smart($text);     
        
        $post_id = self::$db->insert("posts", $edit);
        
        if(count($tags) > 0){
            foreach($tags as $key=>$tag){
                $sql = "SELECT id FROM tags WHERE name = '{$tag}'";
                $query = self::$db->query($sql);
                $tag_id = self::$db->fetch_assoc($query);
                if(!$tag_id){    
                    $tag_id = self::$db->insert("tags", array("name"=>$tag));                                
                }
                self::$db->insert("posts_tags", array("post_id"=>$post_id,
                                                      "tag_id"=>$tag_id));                                     
            }    
        }
        
        return $post_id;   
    }
    
    public function add_answer($user_id, $post_id, $title, $text) {       
        $edit["user_id"] = self::$db->quote_smart($user_id);     
        $edit["post_id"] = self::$db->quote_smart($post_id);     
        $edit["title"] = self::$db->quote_smart($title);     
        $edit["text"] = self::$db->quote_smart($text);     
        
        return self::$db->insert("posts_answers", $edit);   
    }
    
    public function deleteAnswer($id) {        
        $id = self::$db->quote_smart($id);                  
        
        self::$db->delete("posts_answers", " id = '{$id}'");  
        
        return 1; 
    }                                    
}
