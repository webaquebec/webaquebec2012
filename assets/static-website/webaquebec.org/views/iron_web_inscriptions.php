<?php
$this->load->helper('form');
?>
<div class="ros-wrapper">
  <div class="page-content-block clearfix">
    <div class="left-side rs-content-box main liste-reglements">
      <h3 class="box-header">Règlements clés</h3>
      <ul class="list-custom">
        <li>Ouvert à tous les adultes (professionnels ou étudiants) pouvant participer à la conception, réalisation et production d’un projet Web</li>
        <li>Vous ne pourrez quitter le lieu de compétition</li>
        <li>Nourriture, breuvages, bureau, chaise, internet et espace repos vous seront fournis</li>
        <li>Vous serez filmés (sauf dans l’aire de repos)</li>
        <li>Vous devez apporter votre ordinateur</li>
        <li>Vous devez utiliser des solutions libres de droits</li>
      </ul>
      <div class="btn-more-wrapper">
        <a href="<?php echo base_url() ?>/assets/reglements-ironweb-2012.pdf" target="_blank">Téléchargez les règlements complets</a>
      </div>
    </div>
    <div class="right-side main">
      <div class="full-width rs-content-box">
        <h3 class="box-header">Inscription au Iron Web 2012</h3>
        <p>La période d’appel de candidatures pour le Iron Web débute le 18 octobre et se termine le 1 décembre 2011.</p>
        <p>Suite à la réception des candidatures, une présélection sera effectuée par le comité du Iron Web et les candidats retenus seront convoqués à une entrevue en décembre. Les personnes sélectionnés pour participer seront contactées rapidement après les entrevues. Toutefois, la formation des équipes demeurera inconnue jusqu’au début de la compétition.</p>
        <p>La participation à la compétition est gratuite, mais un dépôt de 50$ sera exigé des candidats sélectionnés pour l’entrevue.</p> 
        <p>Vous avez des questions? Contactez <a href="mailto:ironweb@webaquebec.org">ironweb@webaquebec.org</a></p>
      </div>
      <?php if (!$saved): ?>
      <div id="iw-inscriptions" class="full-width rs-content-box">
        <?php echo form_open('iron-web-inscriptions'); ?>
        <h3 class="box-header">Identification</h3>
        <div class="col">
          <div class="required input text">
            <label for="nom_complet">Nom complet<span class="required">*</span></label>
            <?php echo form_input(array('name'=>'nom_complet', 'value'=>set_value('nom_complet'))); ?>
            <?php echo form_error('nom_complet'); ?>
          </div>
          <div class="required input text">
            <label for="nom_complet">Courriel<span class="required">*</span></label>
            <?php echo form_input(array('name'=>'courriel', 'value'=>set_value('courriel'))); ?>
            <?php echo form_error('courriel'); ?>
          </div>
          <div class="required input text medium">
            <label for="nom_complet">Téléphone<span class="required">*</span></label>
            <?php echo form_input(array('name'=>'telephone', 'value'=>set_value('telephone'))); ?>
            <?php echo form_error('telephone'); ?>
          </div>
          <div class="required input text short">
            <label for="nom_complet">Âge<span class="required">*</span></label>
            <?php echo form_input(array('name'=>'age', 'value'=>set_value('age'))); ?>
            <?php echo form_error('age'); ?>
          </div>
        </div>
        <div class="col last">
          <div class="required input text">
            <label for="nom_complet">Employeur</label>
            <?php echo form_input(array('name'=>'employeur', 'value'=>set_value('employeur'))); ?>
            <?php echo form_error('employeur'); ?>
          </div>
          <label for="etudiant">Étudiant?<span class="required">*</span></label>
          <div class="required input checkbox">
            <input type="radio" id="etudiant1" name="etudiant" value="0" <?php echo set_radio('etudiant', '0'); ?> /><label for="etudiant1">Oui</label>
            <input type="radio" id="etudiant2" name="etudiant" value="1" <?php echo set_radio('etudiant', '1', TRUE); ?> /><label for="etudiant2">Non</label>
            <?php echo form_error('etudiant'); ?>
          </div>
          <div class="required input text">
            <label for="nom_complet">École</label>
            <?php echo form_input(array('name'=>'ecole', 'value'=>set_value('ecole'))); ?>
            <?php echo form_error('ecole'); ?>
          </div>
        </div>
        <h3 class="box-header">Profil</h3>
        <div class="required input text">
          <label for="nom_complet">Quelle est votre principale fonction de travail?<span class="required">*</span>
            <span class="sub">(Intégrateur, designer, programmeur ou autre)</span>
          </label>
          <?php echo form_input(array('name'=>'fonction', 'value'=>set_value('fonction'))); ?>
          <?php echo form_error('fonction'); ?>
        </div>
        <div class="required input text">
          <label for="linkedin">Profil LinkedIn</label>
          <?php echo form_input(array('name'=>'linkedin', 'value'=>set_value('linkedin'))); ?>
          <?php echo form_error('linkedin'); ?>
        </div>
        <div class="required input">
          <label for="nom_complet">Votre profil professionnel<span class="required">*</a></label>
          <?php echo form_textarea(array('name'=>'profil', 'value'=>set_value('profil'))); ?>
          <?php echo form_error('profil'); ?>
        </div>
        <div class="required input">
          <label for="nom_complet">Pourquoi souhaitez vous participer au Iron Web?<span class="required">*</a></label>
          <?php echo form_textarea(array('name'=>'question1', 'value'=>set_value('question1'))); ?>
          <?php echo form_error('question1'); ?>
        </div>
        <div class="required input">
          <label for="nom_complet">Vos 3 meilleurs projets<span class="required">*</a></label>
          <?php echo form_textarea(array('name'=>'question2', 'value'=>set_value('question2'))); ?>
          <?php echo form_error('question2'); ?>
        </div>
        <div class="required input">
          <label for="nom_complet">Naturellement, quel rôle jouez vous dans une équipe?<span class="required">*</a></label>
          <?php echo form_textarea(array('name'=>'question3', 'value'=>set_value('question3'))); ?>
          <?php echo form_error('question3'); ?>
        </div>
        <label for="etudiant">Quel est votre principal environnement de travail?<span class="required">*</span></label>
        <div class="required input checkbox">
          <input type="radio" id="environnement1" name="environnement" value="windows" <?php echo set_radio('environnement', 'windows'); ?> /><label for="environnement1">Windows</label>
          <input type="radio" id="environnement2" name="environnement" value="osx" <?php echo set_radio('environnement', 'osx'); ?> /><label for="environnement2">OS X</label>
          <input type="radio" id="environnement2" name="environnement" value="linux" <?php echo set_radio('environnement', 'linux'); ?> /><label for="environnement3">Linux</label>
          <?php echo form_error('environnement'); ?>
        </div>
        <div class="input submit">
          <input type="submit" value="Envoyer ma candidature" />
        </div>
      </div>
      <?php else: ?>
        <h3 class="box-header">Inscription complétée</h3>
        <div class="rs-content-box">
          <p>Merci! Nous communiquerons avec vous à <?php echo $_POST['courriel'] ?> après la fermeture des inscriptions.
          <p>Bonne chance!</p>
        </div>
      <?php endif ?>
    </div>

  </div>

</div>



