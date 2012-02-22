<?php

$render_start = microtime(true);

include __DIR__."/../../shared/bootstrap.inc.php";

//Requirements.
SimpleAutoLoader::addPath(PATH_PUBLIC."/classes/");

//Initialize
global $app;
bootstrap(PATH_PUBLIC."/templates/");

$app->get('/', function () use ($app) {
	$list = Presentation::getRandomSet(4);
    /** @var Slim $app */
    $app->render('index.html', array('vedettes'=> $list,'route_single' => Routes::PROGRAMMATION_SINGLE,));
})->name(Routes::INDEX);

$app->get('/a-propos/', function() use ($app){
    /** @var Slim $app */
    $app->render('a-propos.html');

})->name(Routes::A_PROPOS);

$app->get('/partenaires/', function() use ($app){
    /** @var Slim $app */
    $app->render('partenaires.html');

})->name(Routes::PARTENAIRES);

$app->get('/contact/', function() use ($app){
    /** @var Slim $app */
    $app->render('contact.html');

})->name(Routes::CONTACT);

$app->get('/informations-pratiques/', function() use ($app){
    /** @var Slim $app */
    $app->render('informations-pratiques.html');

})->name(Routes::INFORMATIONS_PRATIQUES);

$app->get('/iron-web/', function() use ($app){
    /** @var Slim $app */
    if(Config::get('ironweb_live') && !isset($_GET['live']))
    {
      header('Location:/iron-web/live', 302);
      exit();
    }
    $app->render('iron-web/index.html');

})->name(Routes::IRON_WEB);

$app->get('/iron-web/live', function() use ($app){
    /** @var Slim $app */
    $app->view()->setData('ironweb_iframe', isset($_GET['iframe']) ? $_GET['iframe'] : false);
    $app->render('iron-web/live.html');

})->name(Routes::IRON_WEB_LIVE);

$app->get('/inscription/', function() use ($app){
    /** @var Slim $app */
    $app->render('inscription.html');

})->name(Routes::INSCRIPTION);

$app->get('/programmation/', function () use ($app) {
    /** @var Slim $app */
    $app->render('horaire.html');
    /*$list = Presentation::getAccordingToStarred(FALSE);
	$star_list = Presentation::getAccordingToStarred();
    $app->render('programmation-liste.twig', array(
        'list' => $list,
		'stars'=>$star_list,
        'route_single' => Routes::PROGRAMMATION_SINGLE,
    ));*/

})->name(Routes::PROGRAMMATION);

$app->get('/programmation/:id/?:name?/?', function ($id, $name = NULL) use ($app) {
    /** @var Slim $app */
    $item = Presentation::getById($id);
    $app->render('programmation-single.twig', array(
       'item'=>$item,
    ));

})->name(Routes::PROGRAMMATION_SINGLE);

$app->get('/horaire_test/', function() use ($app){
    /** @var Slim $app */

    $horaires = Horaire::getByDay(2);//Jeudi
    die(print_r($horaires));

})->name('horaire_test');

// Record vote on ajax call
$app->post('/iron-web/teamvote', function () use ($app) {
    /** @var Slim $app */
	if( sizeof($_POST) < 3 ) // direct access, redirect. Does not work but at least prevent post treatment code to run
	{ 
	   $app->redirect($app->urlFor(Routes::IRON_WEB_LIVE));
	}else{
	  $v = iw_ballots_votes::create();
	  
	  $b  = iw_ballots::create();
	  $lst  = $b->getActive();
	  
	  // make sure the posted hidden field has correct ballot ID
	  $z=0; $cheatVote =0;
	  foreach( $lst as $e )
	  {
	  	if( $z == 0 ){
			if ( $e->id != $_POST['iw_b'] ) {$cheatVote = 1 ;}
		}
		$z++;
	  }

	  $hasVoted = $v->hasVoted( $_POST['iw_b'], $_POST['email'] );
	  
		if( $hasVoted == 1 )
		{
			echo '1'; // Error Already Voted
		}elseif ( $cheatVote == 1) {
			echo '2'; // post value does not correspond to correct vote value
		}else{
			$v->set('iw_ballotsID', $_POST['iw_b']);
			$v->set('email', $_POST['email']);
			$v->set('iw_teamsID', $_POST['iw_team']);
			//
			if ( isset($_SERVER["REMOTE_ADDR"]) )    { 
				$v->set('IP',$_SERVER["REMOTE_ADDR"] ); 
			} else if ( isset($_SERVER["HTTP_X_FORWARDED_FOR"]) )    { 
				$v->set('IP',$_SERVER["HTTP_X_FORWARDED_FOR"]); 
			} else if ( isset($_SERVER["HTTP_CLIENT_IP"]) )    { 
				$v->set('IP',$_SERVER["HTTP_CLIENT_IP"]); 
			} 
			//
			$v->save();
			echo(0);
		}
	}
})->name(Routes::IRON_WEB_TEAM_VOTE);

$app->notFound(function () use ($app) {
    /** @var Slim $app */
    $app->render('errors/404.html');
});

$app->view()->setData('ironweb_live',  Config::get('ironweb_live'));
$app->view()->setData('ironweb_live_channel',  rand(1,2) ==1 ? 'ironweb_jaunes' : 'ironweb_rouges');

$app->view()->setData('menu', array(
    'primary' => array(

    ),
    'secondary' => array(
        array('name' => Routes::CONTACT, 'url' => $app->urlFor(Routes::CONTACT)),
        array('name' => Routes::PARTENAIRES, 'url' => $app->urlFor(Routes::PARTENAIRES)),
        array('name' => Routes::A_PROPOS, 'url' => $app->urlFor(Routes::A_PROPOS)),
    ),
));




$app->run();
$render_end = microtime(true);
if(Config::get('debug') === TRUE){
    $render_time = $render_end - $render_start;
    $memory_used = Helpers::byteFormat(memory_get_peak_usage(true));
    $queries = count(ORM::get_query_log());
    echo "<!-- Render Time : $render_time -->\n";
    echo "<!-- Memory Used : $memory_used -->\n";
    echo "<!-- Queries : $queries -->\n";
}

