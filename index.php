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


$works = $db->query("SELECT port_works.name, port_works.id, port_works.slug, port_images.name as image_name
					  FROM port_works
					  LEFT JOIN port_images ON port_images.id = port_works.image_id
					  $condition")->fetchAll();

$categories = $db->query("SELECT slug, name FROM port_categories")->fetchAll();

if($category){
	$title = "Mes réalisations {$category['name']}";
}else{
	$title = "Bienvenue sur mon Portfolio";
}


include 'partials/header.php'; 
?>
<?php if($category): ?>
	<h1>Mes réalisations <?= $category['name']; ?></h1>
<?php else: ?>
	<h1>Bienvenue sur mon Portfolio</h1>	
<?php endif ?>
<div class="row">
	<div class="col-sm-8">
		<div class="row">
			<?php foreach ($works as $k => $work): ?>
				<div class="col-sm-3">
					<a href="<?= WEBROOT; ?>realisation/<?= $work['slug']; ?>">
						<img = src="<?= WEBROOT; ?>img/works/<?= $work['image_name']; ?>" alt="">
						<h2><?= $work['name']; ?></h2>
					</a>
				</div>
			<?php endforeach ?>
		</div>
	</div>

	<div class="col-sm-4">
		<ul>
			<?php foreach ($categories as $k => $category): ?>
				<a href="<?= WEBROOT; ?>categorie/<?= $category['slug']; ?>">
					<?= $category['name']; ?>
				</a>
			<?php endforeach ?>
		</ul>	
	</div>
</div>
<?php
include 'lib/debug.php';
include 'partials/footer.php';
?>