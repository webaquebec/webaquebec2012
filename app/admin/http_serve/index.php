<?php

include __DIR__."/../../shared/bootstrap.inc.php";

//Requirements.
SimpleAutoLoader::addPath(PATH_ADMIN."/classes/");

//Initialize
global $app;
bootstrap(PATH_ADMIN."/templates/");

$app->get('/', function () use ($app) {
    /** @var Slim $app */
    $app->render('index.html');
})->name(AdminRoutes::INDEX);

$app->run();


