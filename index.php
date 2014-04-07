<?php
$auth = 0;
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


include 'partials/header.php'; 
?>
<div class="container top-bar">
<?php if($category): ?>
	<h1>Mes réalisations <?= $category['name']; ?></h1>
<?php else: ?>
	<h1>Bienvenue sur mon Portfolio</h1>	
<?php endif ?>

<!--
	Barre de progression
-->
	<div class="row">
		<div class="col-sm-2">
			<img src ="<?= WEBROOT; ?>img/all/technologies.png">
		</div>
	    <div class="progress">
	        <div class="progress-bar" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: 60%;">
	            <span class="sr-only">60% Complete</span>
	        </div>
	        <span class="progress-type">C#</span>
	        <span class="progress-completed">60%</span>
	    </div>
	    <div class="progress">
	        <div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: 60%">
	            <span class="sr-only">60% Complete (success)</span>
	        </div>
	        <span class="progress-type">PHP</span>
	        <span class="progress-completed">60%</span>
	    </div>
	    <div class="progress">
	        <div class="progress-bar progress-bar-info" role="progressbar" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100" style="width: 20%">
	            <span class="sr-only">20% Complete (info)</span>
	        </div>
	        <span class="progress-type">Java</span>
	        <span class="progress-completed">20%</span>
	    </div>
	    <div class="progress">
	        <div class="progress-bar progress-bar-warning" role="progressbar" aria-valuenow="70" aria-valuemin="0" aria-valuemax="100" style="width: 70%">
	            <span class="sr-only">70% Complete (warning)</span>
	        </div>
	        <span class="progress-type">HTML/ HTML 5</span>
	        <span class="progress-completed">70%</span>
	    </div>
		<div class="col-md-2" style="width: 19% ">
			<h4 style="text-align:center">
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
</div>
	
<?php foreach ($works as $k => $work): ?>
<div class="container" id = "<?= $work['category_id']; ?>">
	<div class="row">
		<div class="col-sm-4">
			<div class="row">
					<div class="col-sm-3">
						<a href="<?= WEBROOT; ?>realisation/<?= $work['slug']; ?>">
							<img = src="<?= WEBROOT; ?>img/works/<?= $work['image_name']; ?>" alt="">
							<h2><?= $work['name']; ?></h2>
						</a>
					</div>
			</div>
		</div>		
	<div class="col-sm-6">
		<?= $work['content']; ?>
	</div>
	</div>
</div>
<?php endforeach ?>

		<div class="col-sm-4">
			<ul>
				<?php foreach ($categories as $k => $category): ?>
				<!-- 	<a href="<?= WEBROOT; ?>categorie/<?= $category['slug']; ?>">
						<?= $category['name']; ?>
					</a> -->
				<?php endforeach ?>
			</ul>	
		</div>
<?php
include 'partials/footer.php';
?>