var lat_e400 = 46.817411;
var lng_e400 = -71.205399;

function initialize() {
  var latlng = new google.maps.LatLng(lat_e400, lng_e400);

  var map = new google.maps.Map(document.getElementById("googlemaps-footer"), {
    zoom: 15,
    center: latlng,
    scrollwheel: false,
    disableDefaultUI: true,
    mapTypeControl: false,
    navigationControl: true,
    mapTypeControlOptions: {
      mapTypeIds: 'waq'
    }
  });

  /* Styles {{{ */

  var mapStyles = [
  {
    featureType: "landscape",
      elementType: "all",
      stylers: [
      { hue: "#000000" },
      { saturation: -255 },
      { lightness: 3 }
    ]
  },
  {
    featureType: "water",
    elementType: "all",
    stylers: [
    { hue: "#4CABCF" }
    ]
  },
  {
    featureType: "road",
    elementType: "all",
    stylers: [
    { hue: "#006D96" },
    { lightness: 10 }
    ]
  },
  {
    featureType: "poi",
    elementType: "all",
    stylers: [
    { hue: "#006D96" },
    { saturation: -30 },
    { gamma: 0.7 }
    ]
  }
  ];
  var styledMapType = new google.maps.StyledMapType(mapStyles, {name: 'waq'});
  map.mapTypes.set('waq', styledMapType);
  map.setMapTypeId('waq');

  /*}}}*/

  var marker = new google.maps.Marker({
    position: latlng,
      title:"Web à Québec"
  });

  marker.setMap(map);
}


function initialize_ip() {

  // Espace 400e  ##############################################################

  var latlng_e400 = new google.maps.LatLng(lat_e400, lng_e400);

  var map_e400 = new google.maps.Map(document.getElementById("map-espace400"), {
    zoom: 15,
    center: latlng_e400,
    scrollwheel: false,
    disableDefaultUI: true,
    mapTypeControl: false,
    navigationControl: true,
    mapTypeControlOptions: {
      mapTypeIds: 'waq'
    }
  });


  // Hotel Saint-Paul  #####################################################

  var latlng_sp = new google.maps.LatLng(46.81686, -71.20932);

  var map_sp = new google.maps.Map(document.getElementById("map-hotelsp"), {
    zoom: 15,
    center: latlng_sp,
    scrollwheel: false,
    disableDefaultUI: true,
    mapTypeControl: false,
    navigationControl: true,
    mapTypeControlOptions: {
      mapTypeIds: 'waq'
    }
  });


  // Hotel Port-Royal  #####################################################

  var latlng_pr = new google.maps.LatLng(46.81451, -71.20277);

  var map_pr = new google.maps.Map(document.getElementById("map-hotelpr"), {
    zoom: 15,
    center: latlng_pr,
    scrollwheel: false,
    disableDefaultUI: true,
    mapTypeControl: false,
    navigationControl: true,
    mapTypeControlOptions: {
      mapTypeIds: 'waq'
    }
  });

  /* Styles {{{ */

  var mapStyles = [
  {
    featureType: "landscape",
      elementType: "all",
      stylers: [
      { hue: "#000000" },
      { saturation: -255 },
      { lightness: 3 }
    ]
  },
  {
    featureType: "water",
    elementType: "all",
    stylers: [
    { hue: "#4CABCF" }
    ]
  },
  {
    featureType: "road",
    elementType: "all",
    stylers: [
    { hue: "#006D96" },
    { lightness: 10 }
    ]
  },
  {
    featureType: "poi",
    elementType: "all",
    stylers: [
    { hue: "#006D96" },
    { saturation: -30 },
    { gamma: 0.7 }
    ]
  }
  ];
  var styledMapType = new google.maps.StyledMapType(mapStyles, {name: 'waq'});


  // Espace 400e  ##########################

  map_e400.mapTypes.set('waq', styledMapType);
  map_e400.setMapTypeId('waq');

  var marker_e400 = new google.maps.Marker({
    position: latlng_e400,
      title:"Web à Québec"
  });
  marker_e400.setMap(map_e400);


  // Hotel Saint-Paul  ###################

  map_sp.mapTypes.set('waq', styledMapType);
  map_sp.setMapTypeId('waq');

  var marker_sp = new google.maps.Marker({
    position: latlng_sp,
      title:"Hôtel le Saint-Paul"
  });
  marker_sp.setMap(map_sp);


  // Hotel Port-Royal  ###################

  map_pr.mapTypes.set('waq', styledMapType);
  map_pr.setMapTypeId('waq');

  var marker_pr = new google.maps.Marker({
    position: latlng_pr,
      title:"Hôtel Port-Royal Inc"
  });
  marker_pr.setMap(map_pr);

  /*}}}*/

}

$(function(){
  initialize();

  if($('.ip-wrapper').length > 0){initialize_ip();}

  var $slideshow = $('#iw-slideshow');
  if($slideshow.length >0)
  {
    $slideshow.find('.fadein .slide:gt(0)').hide();
    setInterval(function(){
      $slideshow.find('.fadein .slide:eq(0)').fadeOut()
      .next('.slide').fadeIn()
      .end().appendTo('.fadein');
    }, 
    10000);
  }

  var $commanditairesPrincipaux = $('#commanditaires-principaux');

  var nextIndex = 1,
      totalCount = $commanditairesPrincipaux.find('a').length;

  $commanditairesPrincipaux.each(function(index, elem){
    var $this = $(elem),
        $current = $this.find('a:first-child');

    $current.siblings().hide();
    crossfade($this.find('a:eq(' + nextIndex + ')'));
  });

  function crossfade($elem) {
    $elem.siblings().css('z-index',10); 
    $elem.delay(4000).css('z-index',15).fadeIn(
      700,
      function() {
        $elem.siblings().hide();
        nextIndex = (nextIndex < (totalCount-1)) ? nextIndex + 1 : 0;
        crossfade($commanditairesPrincipaux.find('a:eq(' + nextIndex + ')'));
      }
    );
  }

  $('.prog-wrapper .list-custom li').each(function(){
    if($(this).hasClass('first')){
      $(this).find('a').twipsy({
          animate: true,
          placement: 'right',
          html: true,
          offset: 5
        });
    }else if($(this).hasClass('last')){
      $(this).find('a').twipsy({
          animate: true,
          placement: 'left',
          html: true,
          offset: 5
        });
    }else{
      $(this).find('a').twipsy({
        animate: true,
        placement: 'above',
        html: true,
        offset: 5
      });
    }

  });

  /*$('.prog-wrapper ul li').hover(function(){
    $(this).find('div').show();
    $(this).addClass('summit');
  }, function(){
    $(this).removeClass('summit');
    $(this).find('div').hide();
  });*/

});
