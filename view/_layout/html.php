<?php
/**
 * OpenTHC HTML Layout
 */

use Edoceo\Radix\Session;

if (empty($_ENV['title'])) {
	$_ENV['title'] = $this->data['Page']['title'];
}

?>
<!DOCTYPE html>
<html lang="en" translate="no">
<head>
<meta charset="utf-8">
<meta name="application-name" content="OpenTHC Product Database">
<meta name="viewport" content="initial-scale=1, user-scalable=yes">
<meta name="theme-color" content="#069420">
<meta name="mobile-web-app-capable" content="yes">
<meta name="apple-mobile-web-app-capable" content="yes">
<meta name="google" content="notranslate">
<meta http-equiv="cleartype" content="on">
<link rel="stylesheet" href="/vendor/fontawesome/css/all.min.css" integrity="sha256-CTSx/A06dm1B063156EVh15m6Y67pAjZZaQc89LLSrU=">
<link rel="stylesheet" href="/vendor/bootstrap/bootstrap.min.css">
<link rel="stylesheet" href="/css/main.css">
<title><?= __h(strip_tags($data['Page']['title'])) ?></title>
<style>
.hero-wrap {
	background: #303030;
	color: #fdfdfd;
	margin: 0;
	padding: 20vh 0;
}
.hero-wrap .hero-core {
	font-size: 150%;
	margin: 0 auto;
	max-width: 960px;
}
.hero-wrap .hero-core h1,
.hero-wrap .hero-core h2,
.hero-wrap .hero-core h3 {
	margin: 0 0 2rem 0;
	text-align: center;
}
.page-thin {
	font-size: 120%;
	margin: 0 auto;
	max-width: 960px;
}
</style>
</head>
<body>
<?= $this->block('menu-zero.php') ?>

<?php

$x = Session::flash();
if ( ! empty($x)) {

	$x = str_replace('<div class="good">', '<div class="alert alert-success" role="alert">', $x);
	$x = str_replace('<div class="info">', '<div class="alert alert-info" role="alert">', $x);
	$x = str_replace('<div class="warn">', '<div class="alert alert-warning" role="alert">', $x);
	$x = str_replace('<div class="fail">', '<div class="alert alert-danger" role="alert">', $x);

	echo '<div class="radix-flash">';
	echo $x;
	echo '</div>';

}


echo $this->body;

?>

<footer class="home-mini">
<div>
<a href="https://openthc.com/about/privacy">Privacy</a> | <a href="https://openthc.com/about/tos">Terms</a>
</div>

<div>
<small>
<a href="https://directory.openthc.com">Directory</a>
| <a href="https://vdb.openthc.org">Variety Database</a>
| <a href="https://api.openthc.org">API</a>
| <a href="https://twitter.com/openthc"><i class="fab fa-twitter"></i></a>
| <a href="https://instagram.com/openthc"><i class="fab fa-instagram"></i></a>
| <a href="https://github.com/openthc"><i class="fab fa-github"></i></a>
</small>
</div>
</footer>

<script src="/vendor/bootstrap/bootstrap.bundle.min.js"></script>

<?= $this->foot_script ?>

<?= $this->block('theme-selector.php'); ?>

</body>
</html>
