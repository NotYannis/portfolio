 <?php $auth = 0;
include 'lib/includes.php';

/**
* TRAITEMENT DU FORMULAIRE
**/
if (isset($_POST['username']) && isset($_POST['password'])){
	$username = $db->quote($_POST['username']);
	$password = sha1($_POST['password']);
	$select = $db->query("SELECT * FROM port_users WHERE username=$username AND password ='$password'");
	if($select->rowCount() > 0);{
		$_SESSION['Auth'] = $select->fetch();
		setFlash('Vous êtes maintenant connectés');
		header('Location:' . WEBROOT . 'admin/index.php');
		die();
	}
}
/**
* INCLUSION DU HEADER
**/
include 'partials/header.php';
?>

<form action ="#" method="post">
	<div class="form-group">
		<label for="username">Nom d'utilisateur</label>
		<?= input('username'); ?>
	</div>
	<div class="form-group">
		<label for="password">Password</label>
		<input type ="password" class="form_control input-sm" id="password" name="password">
	</div>
	<button type="submit" class="btn btn-default">Se connecter</button>
</form>

<?php include 'lib/debug.php'; ?>
<?php include 'partials/footer.php'; ?>