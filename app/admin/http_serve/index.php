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


$app->get('/programmation/edit/:id', function ($id) use ($app) {
    /** @var Slim $app */
    $app->render('programmation/new_or_edit.twig',
        array(
            'mode'=>'edit',
            'item'=>Presentation::getById($id),
        )
    );
})->name(AdminRoutes::PROGRAMMATION_EDIT);

$app->get('/programmation/new/', function () use ($app) {
    /** @var Slim $app */
    $app->render('programmation/new_or_edit.twig',
        array(
            'mode'=>'new',
            'item' => Presentation::create()
        )
    );
})->name(AdminRoutes::PROGRAMMATION_NEW);

$app->post('/programmation/create', function () use ($app) {
    /** @var Slim $app */
    $p = Presentation::create();
    foreach($_POST as $k=>$v){
        $p->set($k, $v);
    }
    $p->save();
    $id = $p->get('id');

    $app->flash('programmation', 'Créé!');
    $app->redirect($app->urlFor(AdminRoutes::PROGRAMMATION_EDIT, array('id'=>$id)));
})->name(AdminRoutes::PROGRAMMATION_CREATE);

$app->post('/programmation/update/:id', function ($id) use ($app) {
    /** @var Slim $app */
    $p = Presentation::getById($id);
    foreach($_POST as $k=>$v){
        $p->set($k, $v);
    }
    $p->save();
    $app->flash('programmation', 'Sauvegardé!');
    $app->redirect($app->urlFor(AdminRoutes::PROGRAMMATION_EDIT, array('id'=>$id)));
})->name(AdminRoutes::PROGRAMMATION_UPDATE);

$app->get('/programmation/delete/:id', function ($id) use ($app) {
    /** @var Slim $app */
    $p = Presentation::getById($id);
    $p->delete();

    $app->flash('programmation', 'Supprimé!');
    $app->redirect($app->urlFor(AdminRoutes::PROGRAMMATION_LIST));
})->name(AdminRoutes::PROGRAMMATION_DELETE);

$app->run();


