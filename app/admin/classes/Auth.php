<?php

class Auth {

    const ROLE_MINIMAL_ACCESS = 1000;
    const ROLE_WRITER = 999;
    const ROLE_ADMIN = 0;

    static private $users = array();
    static private $inited = FALSE;
    static private $salt;

    static public function validateDelegate( $role ) {
        return function () use ( $role ) {
            Auth::validate($role);
        };
    }

    static public function init(){
        if(self::$inited) return;

        $config = Config::get('auth');
        self::$salt = $config['password_salt'];

        //Required before addUser();
        self::$inited = true;

        foreach($config['users'] as $u){
            self::addUser($u['name'], $u['hash'], $u['role']);
        }

    }

    static public function addUser($name, $passwordHash, $role){
        self::init();
        self::$users[$name] = array(
            'password_hash' => $passwordHash,
            'role' => $role,
        );
    }

    static public function validate($role){
        self::init();
        if(!isset($_SERVER['PHP_AUTH_USER'], $_SERVER['PHP_AUTH_PW'])){
            self::askAuth();
        }

        $user = self::getCurentUsername();
        $pass = $_SERVER['PHP_AUTH_PW'];

        if(!isset(self::$users[$user])){
            self::askAuth("Failed");
        }
        $hash = self::hashRaw($pass);

        if(self::$users[$user]['password_hash'] !== $hash){
            self::askAuth("Failed");
        }

        if(self::$users[$user]['role'] > $role){
            self::askAuth("User has no rights for this.");
        }
    }

    public static function getCurentUsername() {
        return $_SERVER['PHP_AUTH_USER'];
    }

    private static function askAuth($message = "Authorization Required") {
        Slim::getInstance()->response()->header('WWW-Authenticate', "Basic realm=\"Secure Area\"");
        Slim::getInstance()->halt(401, $message);
    }

    public static function hashRaw($raw_pass) {
        self::init();
        return sha1($raw_pass . self::$salt);
    }
}
