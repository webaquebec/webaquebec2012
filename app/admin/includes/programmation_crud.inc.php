<?php
global $app;
$app->get('/programmation/edit/:id', Auth::validateDelegate(Auth::ROLE_WRITER), function ($id) use ($app) {
    /** @var Slim $app */
    $app->render('programmation/new_or_edit.twig',
        array(
            'mode'=>'edit',
            'post_target'=>$app->urlFor(AdminRoutes::PROGRAMMATION_UPDATE, array('id'=>$id)),
            'item'=>Presentation::getById($id),
        )
    );
})->name(AdminRoutes::PROGRAMMATION_EDIT);

$app->get('/programmation/new/', Auth::validateDelegate(Auth::ROLE_WRITER), function () use ($app) {
    /** @var Slim $app */
    $app->render('programmation/new_or_edit.twig',
        array(
            'mode'=>'new',
            'post_target'=>$app->urlFor(AdminRoutes::PROGRAMMATION_CREATE, array()),
            'item' => Presentation::create()
        )
    );
})->name(AdminRoutes::PROGRAMMATION_NEW);

$app->post('/programmation/create', Auth::validateDelegate(Auth::ROLE_WRITER), function () use ($app) {
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

$app->post('/programmation/update/:id', Auth::validateDelegate(Auth::ROLE_WRITER), function ($id) use ($app) {
    /** @var Slim $app */
    $p = Presentation::getById($id);
    foreach($_POST as $k=>$v){
        $p->set($k, $v);
    }
    $p->save();
    $app->flash('programmation', 'Sauvegardé!');
    $app->redirect($app->urlFor(AdminRoutes::PROGRAMMATION_EDIT, array('id'=>$id)));
})->name(AdminRoutes::PROGRAMMATION_UPDATE);

$app->get('/programmation/delete/:id', Auth::validateDelegate(Auth::ROLE_WRITER), function ($id) use ($app) {
    /** @var Slim $app */
    $p = Presentation::getById($id);
    $p->delete();

    $app->flash('programmation', 'Supprimé!');
    $app->redirect($app->urlFor(AdminRoutes::PROGRAMMATION_LIST));
})->name(AdminRoutes::PROGRAMMATION_DELETE);