<?php

$render_start = microtime(true);

//Constants
const ROUTE_INDEX = 'index';
const ROUTE_CONTACT = 'contact';
const ROUTE_PARTENAIRES = 'partenaires';
const ROUTE_A_PROPOS = 'a-propos';

define("PROJECT_ROOT", realpath(__DIR__."/../../../"));
define("PATH_PUBLIC", PROJECT_ROOT."/app/frontend/");
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
SimpleAutoLoader::addPath(PATH_PUBLIC."/classes/");
SimpleAutoLoader::addPath(SHARED_PATH."/classes/");

//Initialize
parse_configuration();
$app = init_slim();
init_twig($app);

//      FAKE         ************
$app->get('/md', function () use ($app) {
    /** @var Slim $app */
    $app->render('markdown_test.html');
});
//      FAKE         ************
$app->get('/programmation-raph', function () use ($app) {
    /** @var Slim $app */
    $list = Presentation::getAll();
    print_r($list);
});

$app->get('/', function () use ($app) {
    /** @var Slim $app */
    $app->render('index.html');
})->name(ROUTE_INDEX);

$app->get('/a-propos/', function() use ($app){
    /** @var Slim $app */
    $app->render('a-propos.html');

})->name(ROUTE_A_PROPOS);

$app->get('/partenaires/', function() use ($app){
    /** @var Slim $app */
    $app->render('partenaires.html');

})->name(ROUTE_PARTENAIRES);

$app->get('/contact/', function() use ($app){
    /** @var Slim $app */
    $app->render('contact.html');

})->name(ROUTE_CONTACT);


$app->notFound(function () use ($app) {
    /** @var Slim $app */
    $app->render('errors/404.html');
});


$app->view()->setData('menu', array(
    'primary' => array(

    ),
    'secondary' => array(
        array('name' => ROUTE_CONTACT, 'url' => $app->urlFor(ROUTE_CONTACT)),
        array('name' => ROUTE_PARTENAIRES, 'url' => $app->urlFor(ROUTE_PARTENAIRES)),
        array('name' => ROUTE_A_PROPOS, 'url' => $app->urlFor(ROUTE_A_PROPOS)),
    ),
));




$app->run();
$render_end = microtime(true);
if(Config::get('debug') === TRUE){
    $render_time = $render_end - $render_start;
    $memory_used = Helpers::byteFormat(memory_get_peak_usage(true));
    $queries = ApplicationDatabase::getQueriesCount();
    echo "<!-- Render Time : $render_time -->\n";
    echo "<!-- Memory Used : $memory_used -->\n";
    echo "<!-- Queries : $queries -->\n";
}






function init_slim(){
    $slim_config = array(
        'templates.path' => PATH_PUBLIC."/templates/"
    );
    $app = new Slim($slim_config);
    return $app;
}

function init_twig(Slim $app){
    TwigView::$twigDirectory = rtrim(TWIG_PATH, "/"); //Slim requires a path without trailling slash.
    if(Config::get('cache') !== FALSE){
        TwigView::$twigOptions['cache'] = CACHE_PATH.'/twig_cache_public/';
    }

    $twig_view = new TwigView();
    $app->view($twig_view);

    $twig_view->getEnvironment()->addFilter('markdown', new Twig_Filter_Function("MarkdownHandler::handle", array('is_safe' => array('html'))));

}

function parse_configuration(){
    Config::readConfigFile(SHARED_PATH."/conf.php");
}

class MarkdownHandler{
    public static function handle($code){
        return Markdown($code);
    }
}