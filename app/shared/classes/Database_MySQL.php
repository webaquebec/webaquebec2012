<?php

class Database_MySQL extends Database{

    /**
     * @var \resource
     */
    private $link;

    public function __construct($server, $port, $database, $username, $password) {
        parent::__construct(Database::TYPE_MYSQL);

        $this->link = mysql_connect(
            vsprintf('%s:%u',
                array(
                    $server,
                    $port)
            ),
            $username,
            $password
        );


        if ($this->link === FALSE) {
            throw new Exception(vsprintf('Cannot connect to %s:%u with user:%s, aborting.', array($server, $port, $username)));
        }

        if (mysql_select_db($database,$this->link) === FALSE) {
            throw new Exception(vsprintf('Cannot select database %s, aborting.', array($database)));
        }
    }

    public function respondToQuery($query) {
        $handle = mysql_query($query, $this->link);
        
        if(!$handle){
            throw new Exception("Query failed : " . mysql_error($this->link));

        }else{
            return new RecordSet_MySQL($handle, $query);
        }
    }

    /**
     * @param mixed $input
     * @return string
     */
    function escape($input){
        if(is_null($input)){
            return "NULL";

        }else if($input === TRUE){
            return "true";

        }else if($input === FALSE){
            return "false";

        }else if(is_numeric($input)){
            return $input;

        }else if(is_string($input)){
            return "'". mysql_real_escape_string($input) . "'";

        }else{
            return mysql_real_escape_string($input);
        }

    }
}