<?php
include '../lib/includes.php';
include '../partials/admin_header.php';


/**
 * SUPPRESSION
 **/
if(isset($_GET['delete'])){
	checkCsrf();
	$id = $db->quote($_GET['delete']);
	$db->query("DELETE FROM port_works WHERE id=$id");
	setFlash('La réalisation a bien été supprimée');
	header('Location:work.php');
}

/**
 * CATEGORIES
 */
$select = $db->query('SELECT id, name, slug FROM port_works');
$works = $select->fetchAll();
?>



<h1>Mes réalisations</h1>


<p><a href="work_edit.php" class="btn btn-success">Ajouter une nouvelle réalisation</a></p>
 
<table class="table table-striped table-hover">
	<thead>
		<tr>
			<th>Id</th>
			<th>Nom</th>
			<th>Actions</th>
		</tr>
	</thead>
	<tbody>
		<?php foreach($works as $category): ?>
		<tr>
			<td><?= $category['id']; ?></td>
			<td><?= $category['name']; ?></td>
			<td>
					<a href="work_edit.php?id=<?= $category['id']; ?>" class ="btn btn-default btn-xs">
					Editer</a>
					<a href="?delete=<?= $category['id']; ?>&<?= csrf(); ?>" class="btn btn-error btn-xs"
					onclick="return confirm('Sur de supprimer ?');">Supprimer</a>
			</td>
		</tr>
		<?php endforeach; ?>
	</tbody>
</table>

<?php include '../partials/footer.php'; ?>