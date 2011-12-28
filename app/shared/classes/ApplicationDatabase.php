<?php

class ApplicationDatabase {

    /**
     * @var Database
     */
    private static $db;

    static public function getDBConnection(){
        if(!isset(self::$db)){
            $db = Config::get("db");
            self::$db = Database::connect(Database::TYPE_MYSQL,
                $db["host"],
                $db["port"],
                $db["database"],
                $db["user"],
                $db["password"]);
        }

        return self::$db;
    }

    /**
     * @return int
     */
    static public function getQueriesCount(){
        $count = self::$db->getQueriesMade();
        return $count;
    }

}
