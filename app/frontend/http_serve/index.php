<?php

$render_start = microtime(true);

include __DIR__."/../../shared/bootstrap.inc.php";

//Requirements.
SimpleAutoLoader::addPath(PATH_PUBLIC."/classes/");

//Initialize
global $app;
bootstrap(PATH_PUBLIC."/templates/");

$app->get('/', function () use ($app) {
	$list = Presentation::getRandomSet(4);
    /** @var Slim $app */
    $app->render('index.html', array('vedettes'=> $list,'route_single' => Routes::PROGRAMMATION_SINGLE,));
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
    if(Config::get('ironweb_live') && !isset($_GET['live']))
    {
      header('Location:/iron-web/live', 302);
      exit();
    }
    $app->render('iron-web/index.html');

})->name(Routes::IRON_WEB);

$app->get('/iron-web/live', function() use ($app){
    /** @var Slim $app */
    $app->render('iron-web/live.html');

})->name(Routes::IRON_WEB_LIVE);

$app->get('/inscription/', function() use ($app){
    /** @var Slim $app */
    $app->render('inscription.html');

})->name(Routes::INSCRIPTION);

$app->get('/programmation/', function () use ($app) {
    /** @var Slim $app */
    $app->render('horaire.html');
    /*$list = Presentation::getAccordingToStarred(FALSE);
	$star_list = Presentation::getAccordingToStarred();
    $app->render('programmation-liste.twig', array(
        'list' => $list,
		'stars'=>$star_list,
        'route_single' => Routes::PROGRAMMATION_SINGLE,
    ));*/

})->name(Routes::PROGRAMMATION);

$app->get('/programmation/:id/?:name?/?', function ($id, $name = NULL) use ($app) {
    /** @var Slim $app */
    $item = Presentation::getById($id);
    $app->render('programmation-single.twig', array(
       'item'=>$item,
    ));

})->name(Routes::PROGRAMMATION_SINGLE);

$app->get('/horaire_test/', function() use ($app){
    /** @var Slim $app */

    $horaires = Horaire::getByDay(2);//Jeudi
    die(print_r($horaires));

})->name('horaire_test');

$app->notFound(function () use ($app) {
    /** @var Slim $app */
    $app->render('errors/404.html');
});

$app->view()->setData('ironweb_live',  Config::get('ironweb_live'));
$app->view()->setData('ironweb_live_channel',  rand(1,2) ==1 ? 'ironweb_jaunes' : 'ironweb_rouges'); 

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