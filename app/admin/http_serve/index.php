<?php

include __DIR__."/../../shared/bootstrap.inc.php";

//Requirements.
SimpleAutoLoader::addPath(PATH_ADMIN."/classes/");

//Initialize
global $app;
bootstrap(PATH_ADMIN."/templates/");


$app->get('/hash/:password', function ($password) use ($app) {
    /** @var Slim $app */

    //Don't allow hash generation if in production.
    if(Config::get('debug')){
        echo Auth::hashRaw($password);

    }else{
        $app->pass();
    }
});

$app->get('/', Auth::validateDelegate(Auth::ROLE_MINIMAL_ACCESS), function () use ($app) {
    /** @var Slim $app */
    $app->render('index.twig');
})->name(AdminRoutes::INDEX);

$app->get('/programmation/', Auth::validateDelegate(Auth::ROLE_MINIMAL_ACCESS), function () use ($app) {
    /** @var Slim $app */
    $app->render('programmation/list.twig', array('list'=>Presentation::getAll()));
})->name(AdminRoutes::PROGRAMMATION_LIST);


include __DIR__."/../includes/programmation_crud.inc.php";
include __DIR__."/../includes/iw_ballot_crud.inc.php";
include __DIR__."/../includes/iw_article_crud.inc.php";
include __DIR__."/../includes/iw_news.inc.php";

$app->run();


