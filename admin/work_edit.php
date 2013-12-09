<?php
include '../lib/includes.php';

if(isset($_POST['name']) && isset($_POST['slug'])){
	checkCsrf();
	$slug = $_POST['slug'];
	if(preg_match('/^[a-z\-0-9]+$/', $slug)){
		$name = $db->quote($_POST['name']);
		$slug = $db->quote($_POST['slug']);
		$content = $db->quote($_POST['content']);
		$categories_id = $db->quote($_POST['categories_id']);
		if(isset($_GET['id'])){
			$id = $db->quote($_GET['id']);
			$db->query("UPDATE port_works SET name=$name, slug=$slug, content=$content, categories_id = $categories_id WHERE id=$id");
		}else{
			$db->query("INSERT INTO port_works SET name=$name, slug=$slug, content=$content, categories_id = $categories_id");
		}
		setFlash('La réalisation a bien été ajoutée');
		header('Location:work.php');
		die();
	}else{
		setFlash('Le slug n\'est pas valide', 'danger');
	}
}

//Récupère l'id de la réalisation si une dans l'url
if(isset($_GET['id'])){
	$id = $db->quote($_GET['id']);
	$select = $db->query("SELECT * FROM port_works WHERE id=$id");
	if($select->rowCount() == 0){
		setFlash('Il n\'y a pas de réalisation avec cette id', 'danger');
		header('Location:works.php');
		die();
	}
	$_POST = $select->fetch();
}

$select = $db->query('SELECT id, name FROM port_categories ORDER BY name ASC');
$categories = $select->fetchAll();
$categories_list = array();
foreach ($categories as $category) {
	$categories_list[$category['id']] = $category['name'];
}

include '../partials/admin_header.php';


?>



<h1>Editer une réalisation</h1>

<form action ="#" method="post">
	<div class="form-group">
		<label for="name">Nom de la réalisation</label>
		<?= input('name'); ?>
	</div>
	<div class="form-group">
		<label for="slug">URL de la réalisation</label>
		<?= input('slug'); ?>
	</div>
	<div class="form-group">
		<label for="content">Contenu de la réalisation</label>
		<?= textarea('content'); ?>
	</div>
	<div class="form-group">
		<label for="categories_id">URL de la réalisation</label>
		<?= select('categories_id', $categories_list); ?>
	</div>
	<?= csrfInput(); ?>
	<button type="submit" class="btn btn-default">Enregistrer</button>
</form>

<?php include '../partials/footer.php'; ?>