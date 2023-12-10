<?php
/**
 *
 */

namespace OpenTHC\PDB\Controller;

class Home extends \OpenTHC\Controller\Base
{
	function __invoke($REQ, $RES, $ARG)
	{
		$data = [];
		$file = 'home.php';
		return $RES->write( $this->render($file, $data) );
	}
}
