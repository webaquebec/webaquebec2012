<?php
 
abstract class Database {

    const TYPE_MYSQL = 'mysql';

    public static function connect($type, $server, $port, $database, $username, $password){
        switch($type){

            case Database::TYPE_MYSQL:
                $db = new Database_MySQL($server, $port, $database, $username, $password);
                break;

            default:
                throw new Exception("Invalid Database type $type");
                break;
        }

        return $db;
    }

    private $type;
    private $queriesMade;
    private $illegal_conversion_tags = array();


    public function __construct($type) {
        $this->type = $type;
    }

    /**
     * @param string $query
     * @param array $arguments
     * @return RecordSet
     */
    final public function query($query, array $arguments = array()){
        $this->queriesMade++;
        $arguments_supplied = count($arguments);
        //Check how many sprintf arguments are supplied.
        preg_match_all("/%[-+]?(?:[ 0]|'.)?a?\d*(?:\.\d*)?[%bcdeEufFgGosxX]/", $query, $matches);
        $conversion_tags = $matches[0];
        $arguments_required = count($conversion_tags);
        foreach($conversion_tags as $tag){
            $tag_letter = substr($tag, -1);
            if(array_key_exists($tag_letter, $this->illegal_conversion_tags)){
                throw new Exception("Illegal replacement tag found with error : " . $this->illegal_conversion_tags[$tag_letter]);
            }
        }
        if($arguments_required != $arguments_supplied){
            throw new Exception('Arguments supplied does not match for query : ' . $query . '. Expected : ' . $arguments_required . '(' . join(", ", $matches[0]) . '), received : ' . $arguments_supplied . " (" . join(", ", $arguments) . ")");
        }
        if($arguments_supplied > 0){
            $escaped_args = array();
            foreach($arguments as $arg){
                $escaped_args[] = $this->escape($arg);
            }
            $query = vsprintf($query, $escaped_args);
        }
        $old_error_handler = set_error_handler(function($errno, $errstr, $errfile, $errline) use($query){
                $msg = "Query failed with error : " . $errstr;
                $msg .= PHP_EOL."QUERY : $query";
                throw new Exception($msg);
            });
        $return = $this->respondToQuery($query);
        set_error_handler($old_error_handler);

        return $return;
    }

    /**
     * @abstract
     * @param string $query
     * @return RecordSet
     */
    abstract function respondToQuery($query);

    /**
     * @abstract
     * @param mixed $input
     * @return string
     */
    abstract function escape($input);

    public function getType() {
        return $this->type;
    }

    public function getQueriesMade() {
        return $this->queriesMade;
    }

    protected function setIllegalConversionTag($tag, $error){
        $this->illegal_conversion_tags[$tag] = $error;
    }

}
