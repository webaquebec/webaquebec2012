// JavaScript Document





/*
 *	 valid_email(email)
 *	check email valid format	
 *	@input : email(string) to check format : [A-Z0-9_.-] @ [a-z].[a-z]
 *	@output : bool
*/
var valid_email = function (email)
{
	var EmailRE=/^[a-z0-9._-]+@+[a-z0-9._-]+\.+[a-z]{2,4}$/i;
	return EmailRE.test(email);
}




/*
 *	 update_vote_bar($r,$j,$realtime)
 *	update live vote bar & numeric percentiles	
 *	@input : $r, $j number of votes for red & yellow, $realtime =0,1 noshow, show
 *	@output : bool
*/
var update_vote_bar = function($j,$r,$realtime){
	
	if( $realtime == 1 )
	{
		if( $r == $j &&  parseInt($r) == 0 ){ //no vote. 
			red = 0; yellow = 0; r_txt = 0 ; y_txt = 0;
		}else{
			red = Math.floor(  parseInt($r)*100 / ( parseInt($r) + parseInt($j) ) );
			yellow = 100-red;
			r_txt = red;
			y_txt = yellow;
		}
	}else{
		red = 0; yellow = 0 ; r_txt = "&nbsp;" ; y_txt = "&nbsp;"
	}

	$('#iw-live-votes .vote_en_cours').find('.e_rouge').attr('data-vote',$r)
									   .find('.live_res_txt').html(r_txt+'%')
									   .next('div').find('span').css({'width':red+'%'});
												   
	$('#iw-live-votes .vote_en_cours').find('.e_jaune').attr('data-vote',$j)
									  .find('.live_res_txt').html(y_txt+'%')
									  .next('div').find('span').css({'width':yellow+'%'});
}





/*
 * getNews($f)
 *	@ $f => json feed URL
 *  From json feed content, build & update DOM content for News Articles. 
 */
var getNews = function($f){
				$.ajax({
					  url: $f,
					  dataType: 'json',
					  cache : false,
					  success: function(data){
					 	var articles = []; var archives = [];
						
						//articles 
						$flx = (data.articles).slice(0,3);
						$.each( $flx , function(k,v){
								articles.push(
									'<div class="news"><h3>'+v.title+'</h3><p>'+(v.text).substring(0,150)+'</p></div>');
							});
						ctc_at = articles.join('');
						$('#iw-live-footer').find('.col').eq(0).find('.nfeed').html(ctc_at);

						//archives
						$flx =  (data.archives).slice(0,3);
						$.each( $flx , function(k,v){
								archives.push(
									'<div class="news"><h3>'+v.title+'</h3><p>'+(v.text).substring(0,150)+'</p></div>');
							});
						ctc_ar = archives.join('');
						$('#iw-live-footer').find('.col').eq(1).find('.nfeed').html(ctc_ar);
					}
				});
	};


/*
 * getVote($f)
 *	@ $f => json feed URL
 *  From json feed content, build & update DOM content for votes : current & last.
 */
var getVote =  function($f){
				$.ajax({
					  url: $f,
					  dataType: 'json',
					  cache : false,
					  success: function(data){
					 	var encours = []; var precedent = [];
						
						if( (data.votes.en_cours).length == 0 && (data.votes.precedent).length == 0 )
						{
							$('#iw-live-votes').hide();
						}else{
							$('#iw-live-votes').show();
						}
						
						// current vote
						// empty vote 
						if( (data.votes.en_cours).length == 0 )
						{
							$('#iw-live-votes-encours').hide();
							$('#iw-live-votes').find('.vote_en_cours').find('.qst').html('Pas de vote en cours');
							$('.vote_boutons').find('a').hide();
							
						}else{
							$('#iw-live-votes-encours').show();
							ec = data.votes.en_cours[0];		
							
							$('#iw-live-votes').find('.vote_en_cours').find('.qst').html(ec.name);
							$('#iw_b').val(ec.id);
							$('#iw_real').val(ec.realtime);

							// has cookie = already voted => hide voting buttons
							// in case active vote changes, need to show them back
							if( $.cookie( ec.id ) == 1 ){
								if (  ( $('.vote_boutons').find('.deja_vote') ).length == 0 )
								{
									$('.vote_boutons').append('<p class="deja_vote">Vous avez d&eacute;j&agrave; vot&eacute;.</p>');
									$('.vote_boutons').find('a').hide();
								}
							}else{
								xstr = 'undefined' ;
								// case button clicked but no email entered => keep button hidden & form visible
								if ( $('#iw_team').val() )
								{
									xstr = ($('#iw_team').val()).toLowerCase();
								}
																
								if(   xstr == 'undefined' )
								{
									$('.vote_boutons').show().find('a').show();
									$('.voteRetour').fadeOut('fast');
								}
								$('.vote_boutons').find('.deja_vote').remove();
							}
							update_vote_bar( ec.jaune , ec.rouge, ec.realtime);
						}
						
						// vote precedent
						if( (data.votes.precedent).length == 0 )
						{
							$('#iw-live-votes-precedent').hide();
							$('#iw-live-votes').find('.vote_precedent').find('.qst').html('Pas de vote pr&eacute;c&eacute;dent');
							$('#iw-live-votes').find('.vote_precedent').find('.res').hide();
						}else{
							$('#iw-live-votes-precedent').show();
							pr = data.votes.precedent[0];
							$('#iw-live-votes').find('.vote_precedent').find('.qst').html(pr.name);
							if( pr.rouge == pr.jaune && parseInt(pr.jaune) == 0 ){
								red  = 0; yellow = 0;
							}else{
								red = Math.floor(  parseInt(pr.rouge)*100 / ( parseInt(pr.rouge) + parseInt(pr.jaune) ) );
								yellow = 100-red;
							}
							$('#iw-live-votes').find('.vote_precedent').find('.e_rouge').html(red+'%<span>&nbsp;</span>');
							$('#iw-live-votes').find('.vote_precedent').find('.e_jaune').html(yellow+'%<span>&nbsp;</span>');
							
							$('#iw-live-votes').find('.vote_precedent').find('.res').show();
						}
					}
			});
	};



/* main DOM update call */
var updateUI = function($newsfeed,$timer){
			getNews($newsfeed);
			getVote($newsfeed);
			t = setTimeout("updateUI($newsfeed,$timer)",$timer);
}





/* DOM Ready */
jQuery(document).ready(function($) {

		if ( $('body div:first-child').hasClass('ironweb-live') ) {
			
			// conf
			$newsfeed = '/assets/js/news.json';
			$timer = 0.5; // minutes
			
			//feeds with unique trailling value to bypass any browser caching
			ts = Math.round((new Date()).getTime() / 1000);
			$newsfeed = $newsfeed+'?'+ts;
			$timer = $timer * 60000 ; // millisec
			
			updateUI($newsfeed,$timer);
			

			/* DOM listeners */
			/* click vote buttons Rouge vs Jaune */
			$('.vote_boutons').find('a')
							  .click(function(event){
									event.preventDefault();
									var votefor = $(this).attr('data-teams');
									$('.vote_form').find('#iw_team').val(votefor);
									$('.vote_boutons').slideUp(250,function(){$('.vote_form').slideDown(250);});
								});
							  
			/* Submit Vote email form */
			$('.vote_form').find('form')
						   .submit(function(event){
								event.preventDefault();
								
								email = $.trim( $('#email').val() ) ;
																						
								if ( !valid_email(email) )
								{
									$('.ermail').slideDown(250);
									return false;
								}else{
									$('.ermail').slideUp(250);
									$data =  ($('.vote_form').find('form')).serialize();
									url  = 	'/iron-web/teamvote';

									var jqxhr = $.post(url,$data)
											.success(function(data){
													$('.vote_form').slideUp('fast');
													ckie = $('#iw_b').val();
													$.cookie( ckie , '1', { expires: 180 });
													// bar update
													if( data == "1" ){
														if ( $('#iw_real').val() == '1' )
														{
															vote = $('#iw_team').val();
															$r = $('.vote_en_cours .e_rouge').attr('data-vote');
															$j = $('.vote_en_cours .e_jaune').attr('data-vote');
															if ( vote == '1' ){ $j = parseInt($j)+1; }else{ $r = parseInt($r)+1; }
															update_vote_bar( $j , $r, '1' );
														}
													}
													$('#iw_team').val('undefined');
													// feedback
													$feedback_ty = "Vote enregistr&eacute;. Merci.";
													$feedback_dv = "Vous avez d&eacute;j&agrave; vot&eacute;.";
													$feedback_ct = "Ce vote n'est plus actif.";
												
													switch (data){
														case "1" : $('.voteRetour').html($feedback_dv).show(); break;
														case "2" : $('.voteRetour').html($feedback_ct).show(); break;
														default  : $('.voteRetour').html($feedback_ty).show();
													}
													
												})
											.error(function(data) { alert("Erreur de communication avec le serveur. Merci d'essayer de nouveau."); })
									return false;
								}
							});

		} /* live page only */
}); /* DOM ready */