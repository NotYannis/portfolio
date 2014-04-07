
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="shortcut icon" href="../../docs-assets/ico/favicon.png">

    <title><?=isset($title) ? $title : 'Mon portfolio'; ?></title>

    <!-- Bootstrap core CSS -->
    <link href="/portfolio/css/bootstrap.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="<?= WEBROOT; ?>css/starter-template.css" rel="stylesheet">

    <!-- Just for debugging purposes. Don't actually copy this line! -->
    <!--[if lt IE 9]><script src="../../docs-assets/js/ie8-responsive-file-warning.js"></script><![endif]-->

    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
    <![endif]-->
  </head>

  <body>

    <div class="navbar navbar-inverse navbar-fixed-top" role="navigation">
      <div class="container">
        <div class="navbar-header">
          <a class="navbar-brand" href="<?= WEBROOT; ?>">Mon Portfolio</a>
          <?php if(isset($categories)){
          foreach ($categories as $k => $category): ?>
          <a class="navbar-brand" href="<?= WEBROOT; ?>categorie/<?= $category['slug']; ?>">
            <?= $category['name']; ?>
          </a>
        <?php endforeach;
          }
         ?>
        </div>
      </div>
    </div>
        <?= flash(); ?>
