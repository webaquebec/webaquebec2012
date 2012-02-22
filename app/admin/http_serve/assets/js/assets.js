// JavaScript Document

$.noConflict();
jQuery(document).ready(function($) {


$('#FrmBallot').submit(
				   function(event){
					   var e = 0; 
					   $('.error').hide();
					   
					   if ( $.trim($('#name').val()) == "" ){ $('.ername').slideDown('fast'); e=1;}
					   if ( $.trim($('#date_start').val()) == "" ){ $('.erstart').slideDown('fast'); e=1;}
					   if ( $.trim($('#date_end').val()) == "" ){ $('.erend').slideDown('fast'); e=1;}
					   if ( $('#date_start').val() == $('#date_end').val() &&
							$('#time_start').val() == $('#time_end').val() )
					   		{ $('.erdate').slideDown('fast'); e=1;}
					   if( e== 1 ){ event.preventDefault(); }
				   }
);


$('#FrmArticle').submit(
				   function(event){
					   var e = 0; 
					   $('.error').hide();
					   
					   if ( $.trim($('#title').val()) == "" ){ $('.ername').slideDown('fast'); e=1;}
					   if ( $.trim($('#date_start').val()) == "" ){ $('.erstart').slideDown('fast'); e=1;}
					   if ( $.trim($('#date_end').val()) == "" ){ $('.erend').slideDown('fast'); e=1;}
					   if ( $('#date_start').val() == $('#date_end').val()  &&
							$('#time_start').val() == $('#time_end').val() )
					   		{ $('.erdate').slideDown('fast'); e=1;}
					   if ( $.trim($('#text').val()) == "" ){ $('.ertxt').slideDown('fast'); e=1;}
					   
					   if( e== 1 ){ event.preventDefault(); }
				   }
);



});

