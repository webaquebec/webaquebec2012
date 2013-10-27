<?php

//Constants
define("PROJECT_ROOT", realpath(__DIR__."/../../"));
define("PATH_PUBLIC", PROJECT_ROOT."/app/frontend/");
define("PATH_ADMIN", PROJECT_ROOT."/app/admin/");
define("SHARED_PATH", PROJECT_ROOT."/app/shared/");
define("SLIM_PATH", PROJECT_ROOT."/libraries/slim/");
define("MARKDOWN_PATH", PROJECT_ROOT."/libraries/php-markdown/");
define("SLIMEXTRAS_PATH", PROJECT_ROOT."/libraries/slim-extras/");
define("TWIG_PATH", PROJECT_ROOT."/libraries/twig/Twig/");
define("CACHE_PATH", PROJECT_ROOT.'/cache/');

//Requirements.
require SLIM_PATH.'/Slim.php';
require SLIMEXTRAS_PATH.'/Views/TwigView.php';
require MARKDOWN_PATH."/markdown.php";
require SHARED_PATH."/classes/SimpleAutoLoader.php";
require PROJECT_ROOT."/libraries/idiorm/idiorm.php";
require PROJECT_ROOT."/libraries/paris/paris.php";
SimpleAutoLoader::addPath(SHARED_PATH."/classes/");

/**
 * @param $templates_path
 */
function bootstrap($templates_path){
    global $app;

    parse_configuration();
    init_orm();
    init_slim($templates_path);
    $app = Slim::getInstance();
    init_twig($app);
}


function init_orm(){
    $db = Config::get("db");
    ORM::configure(sprintf('sqlite:%s/db.sqlite', PROJECT_ROOT));

    if(Config::get('debug') === TRUE){
        ORM::configure('logging', TRUE);
    }

}

function init_slim($templates_path){
    $slim_config = array(
        'templates.path' => $templates_path
    );
    new Slim($slim_config);
}

function init_twig(Slim $app){
    TwigView::$twigDirectory = rtrim(TWIG_PATH, "/"); //Slim requires a path without trailling slash.
    if(Config::get('cache') !== FALSE){
        TwigView::$twigOptions['cache'] = CACHE_PATH.'/twig_cache_public/';
    }

    $twig_view = new TwigView();
    $app->view($twig_view);

    $twig_view->getEnvironment()->addFilter('markdown', new Twig_Filter_Function("TwigFilters::handle_markdown", array('is_safe' => array('html'))));
    $twig_view->getEnvironment()->addFunction('route', new Twig_Function_Function("TwigFilters::route"));

}

function parse_configuration(){
    Config::readConfigFile(SHARED_PATH."/conf.php");
}