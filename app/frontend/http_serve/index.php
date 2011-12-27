<?php

//Constants
define("PROJECT_ROOT", realpath(__DIR__."/../../../"));
define("PATH_PUBLIC", PROJECT_ROOT."/app/frontend/");
define("SLIM_PATH", PROJECT_ROOT."/libraries/slim/");
define("MARKDOWN_PATH", PROJECT_ROOT."/libraries/php-markdown/");
define("SLIMEXTRAS_PATH", PROJECT_ROOT."/libraries/slim-extras/");
define("TWIG_PATH", PROJECT_ROOT."/libraries/twig/Twig/");
define("CACHE_PATH", PROJECT_ROOT.'/cache/');

//Requirements.
require SLIM_PATH.'/Slim.php';
require SLIMEXTRAS_PATH.'/Views/TwigView.php';
require MARKDOWN_PATH."/markdown.php";

//Initialize
$app = init_slim();
init_twig($app);

$app->get('/', function () use ($app) {
    /** @var Slim $app */
    $app->render('index.html');
});

$app->get('/md', function () use ($app) {
    /** @var Slim $app */
    $app->render('markdown_test.html');
});

$app->run();







function init_slim(){
    $slim_config = array(
        'templates.path' => PATH_PUBLIC."/templates/"
    );
    $app = new Slim($slim_config);
    return $app;
}

function init_twig(Slim $app){
    TwigView::$twigDirectory = rtrim(TWIG_PATH, "/"); //Slim requires a path without trailling slash.
    TwigView::$twigOptions['cache'] = CACHE_PATH.'/twig_cache_public/';

    $twig_view = new TwigView();
    $app->view($twig_view);

    $twig_view->getEnvironment()->addFilter('markdown', new Twig_Filter_Function("MarkdownHandler::handle", array('is_safe' => array('html'))));

}

class MarkdownHandler{
    public static function handle($code){
        return Markdown($code);
    }
}