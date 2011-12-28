<?php

/**
 * Dead simple autoloader.
 * No namespace support.
 * Need to have classes files named: "Classname.php"
 */
class SimpleAutoLoader {

    /** @var string[] */
    static private $paths = array();

    /**
     * @static
     * @param string $class_name
     * @return bool
     */
    static public function load($class_name){
        foreach(self::$paths as $p){
            $file = $p.$class_name.".php";
            if(file_exists($file)){
                require $file;
                return true;
            }
        }
        
        return false;
    }

    /**
     * Add a path to look for classes.
     *
     * @static
     * @param string $path Absolute path to folder containing class-files.
     * @return void
     */
    static public function addPath($path){
        self::$paths[] = rtrim($path, "/")."/";
    }

}

function SimpleAutoLoader_auto_loader($class_name){
    return SimpleAutoLoader::load($class_name);
}
spl_autoload_register('SimpleAutoLoader_auto_loader');