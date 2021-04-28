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
<meta name="application-name" content="OpenTHC">
<meta name="viewport" content="initial-scale=1, user-scalable=yes">
<meta name="theme-color" content="#069420">
<meta name="apple-mobile-web-app-capable" content="yes">
<meta name="mobile-web-app-capable" content="yes">
<meta name="google" content="notranslate">
<meta http-equiv="cleartype" content="on">
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
<title><?= h(strip_tags($_ENV['title'])) ?></title>
<style>
* {
	box-sizing: border-box;
	margin: 0;
	padding: 0;
}
body {
	font-family: sans-serif;
	font-size: 1.1rem;
}

a {
	color: inherit;
}

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
.page-thin p {
	margin: 0 0 0.80rem 0;
}

.download-link-list {
	display: flex;
	justify-content: space-between;
}

.download-link-list div {
	margin: 0.75rem;
}

.download-link-list div a {
	background: #ddd;
	border: 2px outset #333;
	border-radius: 8px;
	padding: 0.50rem 0.75rem;
}

</style>
</head>
<body>
<?php

$x = Session::flash();
if (!empty($x)) {

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
| <a href="https://lab.openthc.com">Lab</a>
| <a href="https://vdb.openthc.com">Variety Database</a>
| <a href="https://api.openthc.org">API</a>
| <a href="https://twitter.com/openthc"><i class="fab fa-twitter"></i></a>
| <a href="https://instagram.com/openthc"><i class="fab fa-instagram"></i></a>
| <a href="https://github.com/openthc"><i class="fab fa-github"></i></a>
</small>
</div>
</footer>

<?= $this->foot_script ?>

</body>
</html>
