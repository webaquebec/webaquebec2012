<?php

include __DIR__."/../../shared/bootstrap.inc.php";

//Requirements.
SimpleAutoLoader::addPath(PATH_ADMIN."/classes/");

//Initialize
global $app;
bootstrap(PATH_ADMIN."/templates/");

$app->get('/', function () use ($app) {
    /** @var Slim $app */
    $app->render('index.twig');
})->name(AdminRoutes::INDEX);

$app->get('/programmation/', function () use ($app) {
    /** @var Slim $app */
    $app->render('programmation/list.twig', array('list'=>Presentation::getAll()));
})->name(AdminRoutes::PROGRAMMATION_LIST);


include __DIR__."/../includes/programmation_crud.inc.php";

$app->run();


