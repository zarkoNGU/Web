<?php


if (!function_exists('mysql_connect'))
  die('This PHP environment doesn\'t have MySQL support built in.');

class SQL //MySQL
{
  var $link_id;
  var $query_result;
  var $num_queries = 0;

  function connect($db_host, $db_username, $db_password, $db_name = '', $use_names = '', $pconnect = false, $newlink = true) {

    if ($pconnect) $this->link_id = @mysql_pconnect($db_host, $db_username, $db_password);
    else $this->link_id = @mysql_connect($db_host, $db_username, $db_password, $newlink);
        if (!empty($use_names)) $this->query("SET NAMES '$use_names'");

    if ($this->link_id){
      if($db_name){
        if (@mysql_select_db($db_name, $this->link_id)) return $this->link_id;
          else die(mysql_error());// = "Can't open database ('$db_name')";
        if (!empty($use_names)) $this->query("SET NAMES '$use_names'");
      }
    } else die(mysql_error());// = "Can't connect to mysql server";
  }

  function db($db_name) {
    if ($this->link_id){
      if (@mysql_select_db($db_name, $this->link_id)) return $this->link_id;
        else die(mysql_error());// = "Can't open database ('$db_name')";
    } else die(mysql_error());// = "Can't connect to database";
  }

  function query($sql){
    $this->query_result = @mysql_query($sql, $this->link_id);

    if ($this->query_result){
      ++$this->num_queries;
      return $this->query_result;
    } else {
        $error = "
            <pre>
                QUERY: \n {$sql} \n\n
                ERROR: <span style=\"color:red\">" . mysql_error() . " </span>
            </pre>
        ";
      die($error);
    }
  }           

  function fetch_assoc($query_id = 0){
    return ($query_id) ? @mysql_fetch_assoc($query_id) : false;
  }        

  function insert($tbl,$data){
        foreach($data as $field=>$value){
                $fields[] = $field;
                $values[] = $this->quote_smart($value);
        }                                 
         
        $sql = "INSERT INTO `{$tbl}` (`";
        $sql .= implode("`,`",$fields);
        $sql .= "`) VALUES ('";
        $sql .= implode("','",$values);
        $sql .= "')";

        $this->query($sql); 
        return $this->insert_id();
  }
  
  function update($tbl,$data,$where){    
      $cols = array();
        foreach($data as $field=>$value){
            $cols[] = "`{$field}`='".$this->quote_smart($value)."'"; 
        }
        
        $sql = "UPDATE `{$tbl}` SET";
        $sql .= implode(",",$cols);
        $sql .= " WHERE {$where}";  
        $this->query($sql);
        return true;
  }     
  
  function delete($tbl,$where){
            $this->query("DELETE FROM `{$tbl}` WHERE ".$where);    
  } 
  function insert_id(){
    return ($this->link_id) ? @mysql_insert_id($this->link_id) : false;
  }
  
    function quote_smart($value)
    {                       
        if ( get_magic_quotes_gpc() )
        {
            $value = stripslashes( $value );
        }                                              
        if ( !is_numeric( $value ) )
        {
             $value = mysql_real_escape_string($value);
        }
        return $value;
    }      
}



?>
