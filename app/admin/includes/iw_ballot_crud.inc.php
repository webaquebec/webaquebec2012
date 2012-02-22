<?php


/* 
 * LIST
 */
$app->get('/ironweb/ballot', Auth::validateDelegate(Auth::ROLE_IRONWEB), function () use ($app) {
  /** @var Slim $app */
  $app->render('ironweb/ballot/list.twig' , array('list'=> iw_ballots::getAll() , 'now' => time()) );
  
})->name(AdminRoutes::IRONWEB_BALLOT_LIST);




/* 
 * ADD
 */
$app->get('/ironweb/ballot/new', Auth::validateDelegate(Auth::ROLE_IRONWEB), function () use ($app) {
  /** @var Slim $app */
    $app->render('ironweb/ballot/new_or_edit.twig',
    array(
              'mode'=>'new',
              'post_target'=>$app->urlFor(AdminRoutes::IRONWEB_BALLOT_CREATE, array()),
              'item' => Presentation::create()
    )
    );
})->name(AdminRoutes::IRONWEB_BALLOT_NEW);


/* 
 *  INSERT
 */
$app->post('/ballot/create', Auth::validateDelegate(Auth::ROLE_WRITER), function () use ($app) {
  /** @var Slim $app */
  $b = iw_ballots::create();

  // post input items into ts
  $ts_start = strtotime($_POST['date_start'].' '.$_POST['time_start']);
  $ts_end	= strtotime($_POST['date_end'].' '.$_POST['time_end']);
  $b->set('ts_start', $ts_start);
  $b->set('ts_end', $ts_end);
  
  // other fields
  foreach($_POST as $k=>$v){
  	if ( $k != 'date_start' &&  $k !=  'date_end' && $k !='time_start' && $k !='time_end' )
	{
	    $b->set($k, $v);
	}
  }

  $b->save();
  $id = $b->get('id');
  $app->flash('ballots', 'Créé!');

  $app->redirect($app->urlFor(AdminRoutes::IRONWEB_BALLOT_EDIT, array('id'=>$id)));
})->name(AdminRoutes::IRONWEB_BALLOT_CREATE);



/* 
 * EDIT 
 */
$app->get('/ironweb/ballot/edit/:id', Auth::validateDelegate(Auth::ROLE_IRONWEB), function ($id) use ($app) {
  /** @var Slim $app */
  
    $app->render('ironweb/ballot/new_or_edit.twig',
    array(
              'mode'=>'edit',
              'post_target'=>$app->urlFor(AdminRoutes::IRONWEB_BALLOT_UPDATE, array('id'=>$id)),
              'item' => iw_ballots::getById($id)
    )
    );
})->name(AdminRoutes::IRONWEB_BALLOT_EDIT);


/* 
 *   UDPATE
 */
$app->post('/ironweb/ballot/update/:id', Auth::validateDelegate(Auth::ROLE_IRONWEB), function ($id) use ($app) {
  /** @var Slim $app */

  $b = iw_ballots::getById($id);

  // post input items into ts
  $ts_start = strtotime($_POST['date_start'].' '.$_POST['time_start']);
  $ts_end	= strtotime($_POST['date_end'].' '.$_POST['time_end']);
  $b->set('ts_start', $ts_start);
  $b->set('ts_end', $ts_end);

  // other fields
  foreach($_POST as $k=>$v)
  {
  	if ( $k != 'date_start' &&  $k !=  'date_end' && $k !='time_start' && $k !='time_end' )
	{
	    $b->set($k, $v);
	}
  }
	
    $res = $b->save();
    $app->flash('ballots', 'Mise à jour effectuée!');
    $app->redirect($app->urlFor(AdminRoutes::IRONWEB_BALLOT_EDIT, array('id'=>$id)));

})->name(AdminRoutes::IRONWEB_BALLOT_UPDATE);


/* 
 * DELETE
 */
$app->get('/ironweb/ballot/delete/:id', Auth::validateDelegate(Auth::ROLE_IRONWEB), function ($id) use ($app) {
  /** @var Slim $app */
    $b = iw_ballots::getById($id);
	$res = $b->delete();
    $app->flash('ballots', 'Supprimé!');
    $app->redirect($app->urlFor(AdminRoutes::IRONWEB_BALLOT_LIST));
	
})->name(AdminRoutes::IRONWEB_BALLOT_DELETE);


