<?php

$render_start = microtime(true);

//Constants
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
require PROJECT_ROOT."/libraries/idiorm/idiorm.php";
require PROJECT_ROOT."/libraries/paris/paris.php";
SimpleAutoLoader::addPath(PATH_PUBLIC."/classes/");
SimpleAutoLoader::addPath(SHARED_PATH."/classes/");

//Initialize
parse_configuration();
init_orm();
init_slim();
$app = Slim::getInstance();
init_twig($app);

//      FAKE         ************
$app->get('/md', function () use ($app) {
    /** @var Slim $app */
    $app->render('markdown_test.html');
});

$app->get('/', function () use ($app) {
    /** @var Slim $app */
    $app->render('index.html');
})->name(Routes::INDEX);

$app->get('/a-propos/', function() use ($app){
    /** @var Slim $app */
    $app->render('a-propos.html');

})->name(Routes::A_PROPOS);

$app->get('/partenaires/', function() use ($app){
    /** @var Slim $app */
    $app->render('partenaires.html');

})->name(Routes::PARTENAIRES);

$app->get('/contact/', function() use ($app){
    /** @var Slim $app */
    $app->render('contact.html');

})->name(Routes::CONTACT);

$app->get('/informations-pratiques/', function() use ($app){
    /** @var Slim $app */
    $app->render('informations-pratiques.html');

})->name(Routes::INFORMATIONS_PRATIQUES);

$app->get('/iron-web/', function() use ($app){
    /** @var Slim $app */
    $app->render('iron-web.html');

})->name(Routes::IRON_WEB);

$app->get('/inscription/', function() use ($app){
    /** @var Slim $app */
    $app->render('inscription.html');

})->name(Routes::INSCRIPTION);

$app->get('/programmation/', function () use ($app) {
    /** @var Slim $app */
    $list = Presentation::getAll();
    $app->render('programmation-list-raph.html', array(
        'list' => $list,
        'route_single' => Routes::PROGRAMMATION_SINGLE,
    ));

})->name(Routes::PROGRAMMATION);

$app->get('/programmation/:id/?:name?/?', function ($id, $name = NULL) use ($app) {
    /** @var Slim $app */
    $item = Presentation::getById($id);
    print_r(array($id, $name, $item));

})->name(Routes::PROGRAMMATION_SINGLE);

$app->notFound(function () use ($app) {
    /** @var Slim $app */
    $app->render('errors/404.html');
});


$app->view()->setData('menu', array(
    'primary' => array(

    ),
    'secondary' => array(
        array('name' => Routes::CONTACT, 'url' => $app->urlFor(Routes::CONTACT)),
        array('name' => Routes::PARTENAIRES, 'url' => $app->urlFor(Routes::PARTENAIRES)),
        array('name' => Routes::A_PROPOS, 'url' => $app->urlFor(Routes::A_PROPOS)),
    ),
));




$app->run();
$render_end = microtime(true);
if(Config::get('debug') === TRUE){
    $render_time = $render_end - $render_start;
    $memory_used = Helpers::byteFormat(memory_get_peak_usage(true));
    $queries = count(ORM::get_query_log());
    echo "<!-- Render Time : $render_time -->\n";
    echo "<!-- Memory Used : $memory_used -->\n";
    echo "<!-- Queries : $queries -->\n";
}






function init_orm(){
    $db = Config::get("db");

    $db_host = $db["host"];
    $db_port = $db["port"];
    $db_name = $db["database"];

    ORM::configure("mysql:host=$db_host;port=$db_port;dbname=$db_name;charset=utf8");
    ORM::configure('username', $db["user"]);
    ORM::configure('password', $db["password"]);

    if(Config::get('debug') === TRUE){
        ORM::configure('logging', TRUE);
    }

}

function init_slim(){
    $slim_config = array(
        'templates.path' => PATH_PUBLIC."/templates/"
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

class TwigFilters{

    public static function handle_markdown($code){
        return Markdown($code);
    }

    public static function route($route_name, $params = array()){
        return Slim::getInstance()->urlFor($route_name, $params);
    }

}