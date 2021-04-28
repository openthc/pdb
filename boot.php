<?php
/**
 * Bootstrap Product Database
 */

define('APP_ROOT', __DIR__);

require_once(APP_ROOT . '/vendor/autoload.php');

\OpenTHC\Config::init(APP_ROOT);

error_reporting(E_ALL & ~E_NOTICE);
