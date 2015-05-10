<?php

class UsersModel extends BaseModel {       
    public function getAll() {             
        $sql = "SELECT * FROM users";
        $query = self::$db->query($sql);
        $users = array();
        while( $row = self::$db->fetch_assoc($query) ){
            $users[] = $row;
        }                        
        return $users;
    }

   public function find($id) {
        $id = self::$db->quote_smart($id);
        $sql = "SELECT * FROM users WHERE id = {$id}";
        $query = self::$db->query($sql);
        $user = self::$db->fetch_assoc($query);   
                      
        return $user;
    }      

    public function delete($id) {
        $id = self::$db->quote_smart($id);
        self::$db->delete("users", " id = '{$id}'");
        
        return 1;
    }
}
