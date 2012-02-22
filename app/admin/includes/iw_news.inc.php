<?php


/* 
 * LIST
 */
$app->get('/ironweb/news', function () use ($app) {
  /** @var Slim $app */
	//articles 
	$a = iw_event::create();
	$articles = $a->getToCome();
	$archives = $a->getHasPast();
	
	$str ='{"articles":[' ;
	$z=0;
	$m = sizeof($articles);
	foreach( $articles as $at)
	 {
	 	$str .= '{"id" :"'.$at->id.'",';
	 	$str .= '"title" :"'.$at->title.'",';
	 	$str .= '"text" :"'.$at->text.'"}';
		$z++;
		if( $z < $m ) $str .= ",";
	 }
	$str .='],';

	//archives 
	$str .='"archives":[';
	$z=0;
	$m = sizeof($archives);
	foreach( $archives as $ar)
	 {
	 	$str .= '{"id" :"'.$ar->id.'",';
	 	$str .= '"title" :"'.$ar->title.'",';
	 	$str .= '"text" :"'.$ar->text.'"}';
		$z++;
		if( $z < $m ) $str .= ",";
	 }
	$str .='],';

	// votes
	$b = iw_ballots::create();
	$vc = iw_ballots_votes::create();

	$str .='"votes":{';
	
	// vote en cours
	$votes 	=	$b->getActive();
	$z=0;
	$m = sizeof($votes);
	$str .='"en_cours":[';
	foreach( $votes as $v)
	 {
	 	$str .= '{"id" :"'.$v->id.'",';
	 	$str .= '"name" :"'.$v->name.'"';
	 	 // vote counts for yellow & red ;
		 if( $v->display_results_realtime == 1 )
		 {
			 $vcj = iw_ballots_votes::getVoteCount( $v->id , 1 );
			 $vcr = iw_ballots_votes::getVoteCount( $v->id , 2 );
  	 	 	 $str .= ',"realtime" :"1"';
  	 	 	 $str .= ',"jaune" :"'.$vcj.'"';
  	 	 	 $str .= ',"rouge" :"'.$vcr.'"';
		}else{
  	 	 	 $str .= ',"realtime" :"0"';
		}
	 	$str .= '}';
		$z++;
		if( $z < $m ) $str .= ",";
	 }
	$str .='],';

	// vote précédent
	$precedent 	=	$b->getPrecedent();
	$z=0;
	$m = sizeof($precedent);
	$str .='"precedent":[';
	foreach( $precedent as $p)
	 {
	 	$str .= '{"id" :"'.$p->id.'",';
	 	$str .= '"name" :"'.$p->name.'"';

		$vcj = iw_ballots_votes::getVoteCount( $p->id , 1 );
		$vcr = iw_ballots_votes::getVoteCount( $p->id , 2 );
  	 	$str .= ',"jaune" :"'.$vcj.'"';
  	 	$str .= ',"rouge" :"'.$vcr.'"';
		
	 	$str .= '}';
		$z++;
		if( $z < $m ) $str .= ",";
	 }
	$str .=']}}';

	$fh = fopen('../../frontend/http_serve/assets/js/news.json','wb');
	
	fwrite($fh,$str);
	fclose($fh);

	$app->render('ironweb/news.twig' , array( 'txt_time' => date('r')) );
	
})->name(AdminRoutes::IRONWEB_NEWS_LIST);




