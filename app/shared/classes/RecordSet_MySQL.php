<?php
 
class RecordSet_MySQL extends RecordSet {

    private $result_handle;

    public function __construct($result_handle, $query) {
        parent::__construct(Database::TYPE_MYSQL, $query);
        $this->result_handle = $result_handle;
    }

    function assocOne() {
        return mysql_fetch_assoc($this->result_handle);
    }

    function assocAll() {
        mysql_field_seek($this->result_handle, 0);
        $arr = array();
        while(($row = mysql_fetch_assoc($this->result_handle)) !== FALSE){
            $arr[] = $row;
        }

        return $arr;
    }
    
}
