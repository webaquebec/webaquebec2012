<?php
global $app;
$app->get('/plages_horaire/edit/:id', Auth::validateDelegate(Auth::ROLE_WRITER), function ($id) use ($app) {
    /** @var Slim $app */
    $app->render('plages_horaire/new_or_edit.twig',
        array(
            'mode'=>'edit',
            'post_target'=>$app->urlFor(AdminRoutes::PLAGES_HORAIRE_UPDATE, array('id'=>$id)),
            'item'=>PlageHoraire::getById($id),
        )
    );
})->name(AdminRoutes::PLAGES_HORAIRE_EDIT);

$app->get('/plages_horaire/new/', Auth::validateDelegate(Auth::ROLE_WRITER), function () use ($app) {
    /** @var Slim $app */
    $app->render('plages_horaire/new_or_edit.twig',
        array(
            'mode'=>'new',
            'post_target'=>$app->urlFor(AdminRoutes::PLAGES_HORAIRE_CREATE, array()),
            'item' => PlageHoraire::create()
        )
    );
})->name(AdminRoutes::PLAGES_HORAIRE_NEW);

$app->post('/plages_horaire/create', Auth::validateDelegate(Auth::ROLE_WRITER), function () use ($app) {
    /** @var Slim $app */
    $p = PlageHoraire::create();
    foreach($_POST as $k=>$v){
        $p->set($k, $v);
    }
    $p->save();
    $id = $p->get('id');

    $app->flash('plages_horaire', 'Créé!');
    $app->redirect($app->urlFor(AdminRoutes::PLAGES_HORAIRE_EDIT, array('id'=>$id)));
})->name(AdminRoutes::PLAGES_HORAIRE_CREATE);

$app->post('/plages_horaire/update/:id', Auth::validateDelegate(Auth::ROLE_WRITER), function ($id) use ($app) {
    /** @var Slim $app */
    $p = PlageHoraire::getById($id);
    foreach($_POST as $k=>$v){
        $p->set($k, $v);
    }
    $p->save();
    $app->flash('plages_horaire', 'Sauvegardé!');
    $app->redirect($app->urlFor(AdminRoutes::PLAGES_HORAIRE_EDIT, array('id'=>$id)));
})->name(AdminRoutes::PLAGES_HORAIRE_UPDATE);

$app->get('/plages_horaire/delete/:id', Auth::validateDelegate(Auth::ROLE_WRITER), function ($id) use ($app) {
    /** @var Slim $app */
    $p = PlageHoraire::getById($id);
    $p->delete();

    $app->flash('plages_horaire', 'Supprimé!');
    $app->redirect($app->urlFor(AdminRoutes::PLAGES_HORAIRE_LIST));
})->name(AdminRoutes::PLAGES_HORAIRE_DELETE);