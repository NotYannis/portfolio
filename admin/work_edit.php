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
		/**
		* SAUVEGARDE DE LA REALISATION
		**/
		if(isset($_GET['id'])){
			$id = $db->quote($_GET['id']);
			$db->query("UPDATE port_works SET name=$name, slug=$slug, content=$content, categories_id = $categories_id WHERE id=$id");
		}else{
			$db->query("INSERT INTO port_works SET name=$name, slug=$slug, content=$content, categories_id = $categories_id");
			$_GET['id'] = $db->lastInsertId();
		}
		setFlash('La réalisation a bien été ajoutée');

		/**
		* ENVOI DES IMAGES
		**/
		$work_id = $db->quote($_GET['id']);
		$files = $_FILES['images'];
		$image = array();
		var_dump($_FILES);
		die();
		foreach($files['tmp_name'] as $k => $v) {
			$image[] = array(
				'name' => $files['name'][$k],
				'tmp_name' => $files['tmp_name'][$k]
			);
			$extension = pathinfo($image['name'], PATHINFO_EXTENSION);
			if(in_array($extension, array('png', 'jpg', 'gif'))){
				$db->query("INSERT INTO port_images SET work_id =$work_id");
				$image_id = $db->lastInsertId();
				$image_name = $image_id . '.' . $extension;
				move_uploaded_file($image['tmp_name'], IMAGES . '/works/' . $image_name);
				$image_name = $db->quote($image_name);
				$db->query("UPDATE port_images SET name=$image_name WHERE id = $image_id");
			}
		}

		//header('Location:work.php');
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

<form action ="#" method="post" enctype="multipart/form-data">
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
	<div class="form-group">
		<input type="file" name="images[]">
		<input type="file" name="images[]" class="hidden" id="duplicate">
	</div>
	<p>
		<a href="#" class="btn btn_success" id="duplicatebtn">Ajouter une image</a>
	</p>
	<button type="submit" class="btn btn-primary btn-sm">Enregistrer</button>
</form>


<?php ob_start(); ?>
<script src="<?= WEBROOT; ?>js/tinymce/tinymce.min.js"></script>
<script type="text/javascript">
(function($){
$('#duplicatebtn').click(function(e){
	e.preventDefault();
	var $clone = $('#duplicate').clone().attr('id','').removeClass('hidden');
	$('#duplicate').before($clone);
	})
})

(jQuery);
tinyMCE.init({
  mode : "textareas"
});
</script>

<?php
$script = ob_get_clean();
include '../partials/footer.php';
?>