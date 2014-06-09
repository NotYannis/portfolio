<?php
$auth = 0;
$i = 0;
$form='';
include 'lib/includes.php'; 

$condition = '';
$category = false;
if(isset($_GET['categorie'])){
	$slug = $db->quote($_GET['categorie']);
	$select = $db->query("SELECT * FROM port_categories WHERE slug = $slug");
	if(!isset($_GET['categorie'])){
		header("HTTP/1.1 301 Moved Permanently");
		header('Location:' . WEBROOT);
		die();
	}
	$category = $select->fetch();
	$condition = "WHERE port_works.category_id = {$category['id']}";
}


$works = $db->query("SELECT port_works.name, port_works.id, port_works.slug, port_works.content, port_works.category_id, port_images.name as image_name
					  FROM port_works
					  LEFT JOIN port_images ON port_images.id = port_works.image_id
					  $condition")->fetchAll();

$categories = $db->query("SELECT id, slug, name FROM port_categories")->fetchAll();

if($category){
	$title = "Mes réalisations {$category['name']}";
}else{
	$title = "Bienvenue sur mon Portfolio";
}

if($_GET['send']==1){
	if(mail("yannis.attard@gmail.com", $_POST['inputEmail'].", ".$_POST['inputName'], $_POST['textArea'])){
		setFlash('Votre message a bien été envoyé. Merci !');
	}
	else{
		setFlash('Oops ! Il y a eu une erreur lors de l\'envoi de l\'email...', 'danger');
	}
}


include 'partials/header.php'; 
?>
<!--
	Formulaire de contact
-->
<div class="navbar-fixed-top" id="toppanel">
<div id="panel">
  <div id="panel_contents"> </div>
  <form method="POST" action="?send=1">
 <fieldset>
	<div class="form-group">
	  	<div class="col-lg-10">
	    	<input type="text" class="form-control" name="inputEmail" placeholder="Votre Email">
	  	</div>
	</div>
	<div class="form-group">
	  	<div class="col-lg-10">
	    	<input type="text" class="form-control" name="inputName" placeholder="Votre Nom">
	  	</div>
	</div>
	<div class="form-group">
		<div class="col-lg-10">
	    	<textarea class="form-control" rows="5" name="textArea" placeholder="Votre message"></textarea>
	    	<span class="help-block">yannis.attard@gmail.com
	    		<div class="pull-right">+33695469506</div>
	    	</span>
		</div>
	</div>
	<div class="pull-left">
		<?= dsp_crypt(0, 1); ?>
	</div>
	<div class="pull-right">
		<button type="button" class="btn btn-default btn-sm panel_button" id="hide_button" style="display: none;">Fermer</button>
		<button type="submit" class="btn btn-primary btn-sm panel_button" id="hide_button" style="display: none;">Envoyer</button>
	</div>
</fieldset>
 </div>
 </div>
<div class="container top-bar" id="1">
	<h1>Bienvenue sur le Portfolio de <a href="https://github.com/NotYannis">Yannis Attard</a></h1>
	<div class="row">
		<div class="col-sm-2">
			<img src ="<?= WEBROOT; ?>img/all/technologies.png" class="img-responsive">
		</div>
	    <div class="progress">
	        <div class="progress-bar" role="progressbar" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100" style="width: 40%;">
	            <span class="sr-only">40% Complete</span>
	        </div>
	        <span class="progress-type">C#</span>
	        <span class="progress-completed">40%</span>
	    </div>
	    <div class="progress">
	        <div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100" style="width: 50%">
	            <span class="sr-only">50% Complete (success)</span>
	        </div>
	        <span class="progress-type">PHP</span>
	        <span class="progress-completed">40%</span>
	    </div>
	    <div class="progress">
	        <div class="progress-bar progress-bar-info" role="progressbar" aria-valuenow="70" aria-valuemin="0" aria-valuemax="100" style="width: 70%">
	            <span class="sr-only">70% Complete (info)</span>
	        </div>
	        <span class="progress-type">SQL</span>
	        <span class="progress-completed">80%</span>
	    </div>
	    <div class="progress">
	        <div class="progress-bar progress-bar-warning" role="progressbar" aria-valuenow="70" aria-valuemin="0" aria-valuemax="100" style="width: 70%">
	            <span class="sr-only">70% Complete (warning)</span>
	        </div>
	        <span class="progress-type">HTML/ HTML 5</span>
	        <span class="progress-completed">70%</span>
	    </div>
		<div class="col-md-2" style="width: 19% ">
			<h4>
				Yannis Attard <br>Développeur lvl 22
			</h4>
		</div>
	    <div class="progress">
	        <div class="progress-bar progress-bar-danger" role="progressbar" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100" style="width: 50%">
	            <span class="sr-only">50% Complete (danger)</span>
	        </div>
	        <span class="progress-type">CSS / CSS3</span>
	        <span class="progress-completed">50%</span>
	    </div>
	</div>
	<div class="row">
		<p class="lead">Après des études dans la littérature et les arts, j'ai décidé de me tourner vers l'informatique avec un BTS SIO. 
		</p>
	</div>
</div>
	
<?php foreach ($categories as $k => $categorie){ ?>
<div class="container categorie" id = "<?= $categorie['id']; ?>">
	<?php foreach ($works as $k => $work):
	if($work['category_id'] == $categorie['id']): ?>
	<div class="container work" style="<?= background($i) ?>">
	<div class="row">
		<div class="col-sm-4">
					<img src="<?= WEBROOT; ?>img/works/<?= $work['image_name']; ?>" class="img-responsive" alt="">
		</div>		
		<div class="col-sm-6">
			<h2><?= $work['name']; ?></h2>
			<?= $work['content']; ?>
		</div>
	</div>
	</div>
<?php if($i >= 4) $i = 0;
else $i++;
endif;
endforeach ?>
</div>
<?php
}

include 'partials/footer.php';
?>