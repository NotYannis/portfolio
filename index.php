<?php
$auth = 0;
$i = 0;
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
	<h1 style="text-align:center">Bienvenue sur le Portfolio de <a href="https://github.com/NotYannis">Yannis Attard</a></h1>

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
	        <div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100" style="width: 40%">
	            <span class="sr-only">40% Complete (success)</span>
	        </div>
	        <span class="progress-type">PHP</span>
	        <span class="progress-completed">40%</span>
	    </div>
	    <div class="progress">
	        <div class="progress-bar progress-bar-info" role="progressbar" aria-valuenow="80" aria-valuemin="0" aria-valuemax="100" style="width: 80%">
	            <span class="sr-only">80% Complete (info)</span>
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
	
<?php foreach ($works as $k => $work){ ?>
<div class="container works" id = "<?= $work['category_id']; ?>" style="<?= background($i) ?>">
	<div class="row">
		<div class="col-sm-5">
			<div class="row">
				<div class="col-sm-3">
					<img src="<?= WEBROOT; ?>img/works/<?= $work['image_name']; ?>" alt="">
				</div>
			</div>
		</div>		
		<div class="col-sm-6">
			<h2><?= $work['name']; ?></h2>
			<?= $work['content']; ?>
		</div>
	</div>
</div>
<?php
if($i > 4) $i = 0;
else $i++;
}

include 'partials/footer.php';
?>