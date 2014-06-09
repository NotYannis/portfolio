<?php

define('WWW_ROOT', dirname(dirname(__FILE__)));
//Donne la racine du serveur, ici : portfolio/
$directory = basename(WWW_ROOT);

/**
* REQUEST_URI : Donne l'URL sur laquelle on se trouve
* explode sert à faire séparer une chaîne de caractére
* suivant la valeur passée en premier paramètre, ici
* $directory. Va donc séparer en deux l'url : portfolio
* d'un côté (url[0]) et le reste de l'autre (url[1])
**/

$url = explode($directory, $_SERVER['REQUEST_URI']);
if(count($url) == 1){
	define('WEBROOT', '/');
}else{
define('WEBROOT', $url[0] . '/');
}

define('IMAGES', WWW_ROOT . DIRECTORY_SEPARATOR . 'img');