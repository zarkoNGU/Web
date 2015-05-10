<?php

class TagModel extends BaseModel {       
    public function getPosts($id) {    
        $id = self::$db->quote_smart($id);    
            
        $sql = "SELECT
                    p.*, u.username
                FROM posts AS p
                LEFT JOIN users AS u ON u.id = p.user_id
                LEFT JOIN posts_tags AS pt on pt.post_id = p.id
                WHERE p.active = '1' AND pt.tag_id = '{$id}'";    
        $query = self::$db->query($sql);  
        $posts = array();
        while( $row = self::$db->fetch_assoc($query) ){
            $row["title"] = htmlspecialchars($row["title"]);
            $row["text"] = htmlspecialchars($row["text"]);
            $row["create_time"] = date("M d \, Y \a\\t h:i A", $row["create_time"]);
            $posts[] = $row;   
        }
                                             
        return $posts;
    }           
}
