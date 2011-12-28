<?php

/**
 * @throws Exception
 * Dead simple config parser.
 */
class Config {

    static private $configurations = array();

    public static function readConfigFile($configuration_path) {
        $config = array();

        include($configuration_path);

        self::$configurations = array_merge(self::$configurations, $config);
    }

    public static function get($key) {
        if(!array_key_exists($key, self::$configurations)){
            throw new Exception("Invalid configuration key $key.");
        }
        return self::$configurations[$key];
    }
    
}
