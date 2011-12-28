<?php
 
abstract class RecordSet {


    private $query;
    private $type;

    function __construct($type, $query) {
        $this->type = $type;
        $this->query = $query;
    }

    /**
     * @param string $column
     * @return mixed
     */
    final public function oneOfColumn($column){
        $row = $this->assocOne();
        if(empty($row)){
            return NULL;
        }
        return $row[$column];
    }

    final public function allOfColumn($column){
        $result = array();

        $all = $this->assocAll();
        if($all !== FALSE && count($all) > 0){
            foreach($all as $row){
                $result[] = $row[$column];
            }
        }
        return $result;
    }

    abstract function assocOne();
    abstract function assocAll();

    final public function getQuery() {
        return $this->query;
    }

    public function getType() {
        return $this->type;
    }

}
