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

$app->get('/plages_horaire/', Auth::validateDelegate(Auth::ROLE_MINIMAL_ACCESS), function () use ($app) {
    /** @var Slim $app */
    $app->render('plages_horaire/list.twig', array('list'=>PlageHoraire::getAll()));
})->name(AdminRoutes::PLAGES_HORAIRE_LIST);

$app->get('/horaire/', Auth::validateDelegate(Auth::ROLE_MINIMAL_ACCESS), function () use ($app) {
    /** @var Slim $app */
    $app->render('horaire/list.twig', array('list'=>Horaire::getAll()));
})->name(AdminRoutes::HORAIRE_LIST);


include __DIR__."/../includes/programmation_crud.inc.php";
include __DIR__."/../includes/plages_horaire_crud.inc.php";
include __DIR__."/../includes/horaire_crud.inc.php";

$app->run();


