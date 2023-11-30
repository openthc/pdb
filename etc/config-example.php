<?php
/**
 * DEV OpenTHC Variety Database
 */

// Init
$cfg = [];

// Database
$cfg['database'] = [
	'main' => [
		'hostname' => '127.0.0.1',
		'username' => 'openthc_main',
		'password' => 'openthc_main',
		'database' => 'openthc_main',
	],
];

$cfg['redis'] = [
	'hostname' => '127.0.0.1',
];


$cfg['openthc'] = [];

$cfg['openthc']['sso'] = [
	'id' => '010PENTHCX0000SVC0000000PS',
	'origin' => 'https://sso.openthc.dev',
	'secret' => 'SK/ops.openthc.dev',
];

return $cfg;
