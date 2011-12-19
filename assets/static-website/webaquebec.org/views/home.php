<div class="page-content-block clearfix">

  <?php
  //############################################################################
  //  Vox Pop    ###############################################################
  ?>

  <div class="left-side main">
    <div id="vox-pop" class="white-box">
      <div class="thumb">
        <a class="btn-vox-pop" href="http://vimeo.com/29752446">Écoutez<strong>le Vox Pop</strong></a>
        <img src="<?php echo base_url() ?>assets/img/vox-pop-preview.jpg" alt="Apercu du Vox Pop">
      </div>
      <div class="content">
        <h3>Le Web made in Québec</h3>
        <p>Pour les gens de Québec comme ailleurs, le web est devenu partie intégrante de nos vies. C’est un outil de travail, une industrie florissante, une mine de renseignements et un mode de vie.</p>

      </div>
      <ul class="social-bar list-custom list-hori clearfix">
        <li><span>Suivez-nous</span></li>
        <li><a class="btn-facebook" href="https://www.facebook.com/webaquebec" title="Suivez-nous sur Facebook">Facebook</a></li>
        <li><a class="btn-twitter" href="https://twitter.com/webaquebec" title="Suivex-nous sur Twitter">Twitter</a></li>
      </ul>
    </div>
  </div>

  <div class="right-side main">

    <?php
    //############################################################################
    //  Important Numbers    #####################################################
    ?>

		<div id="important-numbers">
			<? /* ?>
      <a id="btn-precedent" class="btn-nav" href="#"><span>Précédent</span></a>
      <a id="btn-suivant" class="btn-nav" href="#"><span>Suivant</span></a>
			<? */ ?>
			<ul id="numbers-viewport" class="list-custom list-hori clearfix">
				<?
					$featured = array(
						array(
							'number' => '30',
							'text' => 'conférenciers du <br>Québec'
						),
						array(
							'number' => '48',
							'text' => 'heures de <br>compétition'
						),
						array(
							'number' => '44',
							'text' => 'bénévoles'
						),
						array(
							'number' => '500',
							'text' => 'participants'
						),
						array(
							'number' => '3',
							'text' => 'soirées thématiques'
						)
					);
					shuffle($featured);
					for ($x=0; $x < 3; $x++) { 
					?>
					<li>
						<span class="number"><?=$featured[$x]['number']?></span>
						<h2><?=$featured[$x]['text']?></h2>
					</li>
					<? } ?>
      </ul>
    </div>

    <?php
    //############################################################################
    //  Conferenciers    #########################################################
    ?>

    <div id="conferenciers">
			<ul class="list-custom list-hori clearfix">
				<?
					$speakers = array(
						array(
							'name' => 'Isabelle Grenier',
							'slug' => 'isabelle-grenier',
							'url' => '/programmation/'
						),
						array(
							'name' => 'Peter Morville',
							'slug' => 'peter-morville_star',
							'url' => '/programmation/'
						),
						array(
							'name' => 'Rémi Prévost',
							'slug' => 'remi-prevost',
							'url' => '/programmation/'
						),
						array(
							'name' => 'Denis Boudreault',
							'slug' => 'denis-boudreault',
							'url' => '/programmation/'
						)					
					);
					shuffle($speakers);
					for ($x=0; $x < 4; $x++) { 
				?>
					<li>
						<a href="<?=$speakers[$x]['url']?>" target="_blank">
							<span><?=$speakers[$x]['name']?></span>
							<img src="<?php echo base_url() ?>assets/img/conferenciers/147x160/<?=$speakers[$x]['slug']?>.jpg" alt="<?=$speakers[$x]['name']?>">
						</a>
					</li>
				<? } ?>
			</ul>
      <div class="btn-more-wrapper">
				<a href="<?php echo base_url() ?>/programmation/" style="clear: both;">Consulter la programmation</a>
      </div>
    </div>

  </div>

</div>
<div class="sep-shadow"></div>
<div class="page-content-block clearfix">

  <div class="left-side main">
    <?php $this->load->view('news_box') ?>
    <?php $this->load->view('newsletter_box') ?>
  </div>

  <?php
  //############################################################################
  //  Home two column    #######################################################
  ?>

  <div class="right-side main">
    <div class="left-side rs-content-box iron-web">
      <h3 class="box-header">Iron Web</h3>
      <div class="white-thumb">
        <a class="btn-vox-pop" href="http://vimeo.com/29847338">Retour sur le <strong>Iron Web 2011</strong></a>
      </div>
      <p>Le Iron Web est une compétition de 48 heures, diffusée en direct, par et pour les passionnés du Web qui désirent participer au projet le plus court mais le plus intense de leur vie.</p>
      <div class="btn-more-wrapper">
        <a href="<?php echo base_url() ?>iron-web/" title="Tout sur la compétition Iron Web">Tout sur la compétition</a>
      </div>
    </div>
    <div class="right-side rs-content-box">
      <h3 class="box-header">Commanditaires principaux</h3>
			<div id="commanditaires-principaux" class="white-thumb commanditaires-principaux">
				<?
					$commanditaires = array(
						array(
							'name' => 'iXmédia',
							'slug' => 'ixmedia',
							'url' => 'http://www.ixmedia.com/'
						),
						array(
							'name' => 'Libéo',
							'slug' => 'libeo',
							'url' => 'http://www.libeo.com/'
						),
						array(
							'name' => 'Vétiq',
							'slug' => 'vetiq',
							'url' => 'http://www.vetiq.org/'
						),
						array(
							'name' => 'Korem',
							'slug' => 'korem',
							'url' => 'http://www.korem.com/'
						)
					);
					shuffle($commanditaires);
					for ($x=0; $x < 4; $x++) { 
				?>
				<a href="<?=$commanditaires[$x]['url']?>" target="_blank"><img src="<?php echo base_url() ?>/assets/img/partenaires/225x100/<?=$commanditaires[$x]['slug']?>.png" alt="<?=$commanditaires[$x]['name']?>"></a>
				<? } ?>
      </div>
      <p>Sans la participation de ses nombreux commanditaires, le WAQ ne pourrait offrir un tel niveau de qualité à un coût si peu élevé. Merci à tous nos partenaires.</p>
      <div class="btn-more-wrapper">
        <a href="<?php echo base_url() ?>partenaires/" title="Tout sur nos fantastiques partenaires">Tout sur les partenaires</a>
      </div>
    </div>
  </div>

</div>



