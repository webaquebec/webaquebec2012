<?php
global $app;
$app->get('/horaire/edit/:id', Auth::validateDelegate(Auth::ROLE_WRITER), function ($id) use ($app) {
    /** @var Slim $app */
    $app->render('horaire/new_or_edit.twig',
        array(
            'mode'=>'edit',
            'plages'=>PlageHoraire::getAllAssoc(),
            'rooms'=>Room::getAllAssoc(),
            'presentations'=>Presentation::getAllAssoc(),
            'post_target'=>$app->urlFor(AdminRoutes::HORAIRE_UPDATE, array('id'=>$id)),
            'item'=>Horaire::getById($id),
        )
    );
})->name(AdminRoutes::HORAIRE_EDIT);

$app->get('/horaire/new/', Auth::validateDelegate(Auth::ROLE_WRITER), function () use ($app) {
    /** @var Slim $app */
    $app->render('horaire/new_or_edit.twig',
        array(
            'mode'=>'new',
            'plages'=>PlageHoraire::getAllAssoc(),
            'rooms'=>Room::getAllAssoc(),
            'presentations'=>Presentation::getAllAssoc(),
            'post_target'=>$app->urlFor(AdminRoutes::HORAIRE_CREATE, array()),
            'item' => Horaire::create()
        )
    );
})->name(AdminRoutes::HORAIRE_NEW);

$app->post('/horaire/create', Auth::validateDelegate(Auth::ROLE_WRITER), function () use ($app) {
    /** @var Slim $app */
    $p = Horaire::create();
    foreach($_POST as $k=>$v){
        $p->set($k, $v);
    }
    $p->save();
    $id = $p->get('id');

    $app->flash('horaire', 'Créé!');
    $app->redirect($app->urlFor(AdminRoutes::HORAIRE_EDIT, array('id'=>$id)));
})->name(AdminRoutes::HORAIRE_CREATE);

$app->post('/horaire/update/:id', Auth::validateDelegate(Auth::ROLE_WRITER), function ($id) use ($app) {
    /** @var Slim $app */
    $p = Horaire::getById($id);
    foreach($_POST as $k=>$v){
        $p->set($k, $v);
    }
    $p->save();
    $app->flash('horaire', 'Sauvegardé!');
    $app->redirect($app->urlFor(AdminRoutes::HORAIRE_EDIT, array('id'=>$id)));
})->name(AdminRoutes::HORAIRE_UPDATE);

$app->get('/horaire/delete/:id', Auth::validateDelegate(Auth::ROLE_WRITER), function ($id) use ($app) {
    /** @var Slim $app */
    $p = Horaire::getById($id);
    $p->delete();

    $app->flash('horaire', 'Supprimé!');
    $app->redirect($app->urlFor(AdminRoutes::HORAIRE_LIST));
})->name(AdminRoutes::HORAIRE_DELETE);