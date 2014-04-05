<?php
$auth = 0;
include 'lib/includes.php'; 
include 'partials/header.php'; 

if(!isset($_GET['slug'])){
	header("HTTP/1.1 301 Moved Permanently");
	header('Location:index.php');
	die();
}
$slug = $db->quote($_GET['slug']);
$select = $db->query("SELECT * FROM port_works WHERE slug = $slug");
$work = $select->fetch();
$work_id = $work['id'];

if($select->rowCount() == 0){
	header("HTTP/1.1 301 Moved Permanently");
	header('Location:index.php');
	die();
}


$select = $db->query("SELECT * FROM port_images WHERE work_id = $work_id");
$images = $select->fetchAll();
$title = $work['name'];

include 'partials/header.php';
?>

<h1><?= $work['name']; ?></h1>

<?= $work['content']; ?>

<?php foreach ($images as $k => $image): ?>
	<p>
		<img src="<?= WEBROOT; ?>img/works/<?= $image['name']; ?>" width="100%">
	</p>
<?php endforeach ?>

<?php
include 'lib/debug.php';
include 'partials/footer.php';
?>