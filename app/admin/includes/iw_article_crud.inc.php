<?php


/* 
 * LIST
 */
$app->get('/ironweb/article', Auth::validateDelegate(Auth::ROLE_IRONWEB), function () use ($app) {
  /** @var Slim $app */
 	$app->render('ironweb/article/list.twig' , array('list'=> iw_event::getAll() , 'now' => time()) );
  //  $app->render('ironweb/article/list.twig' , array('list'=> '' , 'now' => time()) );
})->name(AdminRoutes::IRONWEB_ARTICLE_LIST);




/* 
 * ADD
 */
$app->get('/ironweb/article/new', Auth::validateDelegate(Auth::ROLE_IRONWEB), function () use ($app) {
  /** @var Slim $app */
    $app->render('ironweb/article/new_or_edit.twig',
    array(
              'mode'=>'new',
              'post_target'=>$app->urlFor(AdminRoutes::IRONWEB_ARTICLE_CREATE, array()),
              'item' => iw_event::create()
    )
    );
})->name(AdminRoutes::IRONWEB_ARTICLE_NEW);


/* 
 *  INSERT
 */
$app->post('/ironweb/article', Auth::validateDelegate(Auth::ROLE_WRITER), function () use ($app) {
  /** @var Slim $app */
  $a = iw_event::create();

  // post input items into ts
  $ts_start = strtotime($_POST['date_start'].' '.$_POST['time_start']);
  $ts_end	= strtotime($_POST['date_end'].' '.$_POST['time_end']);
  $a->set('ts_publication', $ts_start);
  $a->set('ts_end_publication', $ts_end);
  
  // other fields
  foreach($_POST as $k=>$v){
  	if ( $k != 'date_start' &&  $k !=  'date_end' && $k !='time_start' && $k !='time_end' )
	{
	    $a->set($k, $v);
	}
  }

  $a->save();
  $id = $a->get('id');
  $app->flash('article', 'Créé!');

  $app->redirect($app->urlFor(AdminRoutes::IRONWEB_ARTICLE_EDIT, array('id'=>$id)));
})->name(AdminRoutes::IRONWEB_ARTICLE_CREATE);



/* 
 * EDIT 
 */
$app->get('/ironweb/article/edit/:id', Auth::validateDelegate(Auth::ROLE_IRONWEB), function ($id) use ($app) {
  /** @var Slim $app */
  
    $app->render('ironweb/article/new_or_edit.twig',
    array(
              'mode'=>'edit',
              'post_target'=>$app->urlFor(AdminRoutes::IRONWEB_ARTICLE_UPDATE, array('id'=>$id)),
              'item' => iw_event::getById($id)
    )
    );
})->name(AdminRoutes::IRONWEB_ARTICLE_EDIT);


/* 
 *   UDPATE
 */
$app->post('/ironweb/article/update/:id', Auth::validateDelegate(Auth::ROLE_IRONWEB), function ($id) use ($app) {
  /** @var Slim $app */

  $a = iw_event::getById($id);

  // post input items into ts
  $ts_start = strtotime($_POST['date_start'].' '.$_POST['time_start']);
  $ts_end	= strtotime($_POST['date_end'].' '.$_POST['time_end']);
  $a->set('ts_publication', $ts_start);
  $a->set('ts_end_publication', $ts_end);

  // other fields
  foreach($_POST as $k=>$v)
  {
  	if ( $k != 'date_start' &&  $k !=  'date_end' && $k !='time_start' && $k !='time_end' )
	{
	    $a->set($k, $v);
	}
  }
	
    $res = $a->save();
    $app->flash('article', 'Mise à jour effectuée!');
    $app->redirect($app->urlFor(AdminRoutes::IRONWEB_ARTICLE_EDIT, array('id'=>$id)));

})->name(AdminRoutes::IRONWEB_ARTICLE_UPDATE);


/* 
 * DELETE
 */
$app->get('/ironweb/article/delete/:id', Auth::validateDelegate(Auth::ROLE_IRONWEB), function ($id) use ($app) {
  /** @var Slim $app */
    $a = iw_event::getById($id);
	$res = $a->delete();
    $app->flash('article', 'Article Supprimé!');
    $app->redirect($app->urlFor(AdminRoutes::IRONWEB_ARTICLE_LIST));
	
})->name(AdminRoutes::IRONWEB_ARTICLE_DELETE);


