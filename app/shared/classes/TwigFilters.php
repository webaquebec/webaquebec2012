<?php

class TwigFilters{

    public static function handle_markdown($code){
        return Markdown($code);
    }

    public static function route($route_name, $params = array()){
        return Slim::getInstance()->urlFor($route_name, $params);
    }

}