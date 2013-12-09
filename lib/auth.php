 <?php 
 session_start();

 // Redirige vers la page login si pas identifié 
 if(!isset($auth)){
 	if(!isset($_SESSION['Auth']['id'])){
 		header('Location:' . WEBROOT . 'login.php');
 		die();
 	}
 }

/**
* Créé un jeton csrf pour éviter d'avoir les informations sur les actions
* en clair dans l'url lorsqu'on est loggé admin
**/
if(!isset($_SESSION['csrf'])){
	$_SESSION['csrf'] = md5(time() + rand());
}

//Donne le contenu du jeton csrf pour la session en cours
function csrf(){
	return 'csrf=' . $_SESSION['csrf'];
}

//Renvoie sur une page si le contenu de csrf est différent de celui de la session ou vide
function checkCsrf(){
	if(
		(isset($_POST['csrf']) && $_POST['csrf'] == $_SESSION['csrf']) ||
		(isset($_GET['csrf']) && $_GET['csrf'] == $_SESSION['csrf']) 
		){
		return true;
	}
	header('Location:' . WEBROOT . '/csrf.php');
	die();
}

function csrfInput(){
	return '<input type="hidden" value="' . $_SESSION['csrf'] . '" name="csrf">';
}



 ?>