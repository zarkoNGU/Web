<?php    
abstract class BaseModel {
    protected static $db;    

    public function __construct() {     
        if (self::$db == null) {     
            include_once('includes/Mysql.class.php');
                                                                       
            self::$db = new SQL;
            self::$db->connect(DB_HOST, DB_USER, DB_PASS, DB_NAME,"utf8");      
        }
    }
}
