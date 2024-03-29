<?php
/**
 * Product Search
 */

namespace OpenTHC\PDB\Controller;

class Search extends \OpenTHC\Controller\Base
{
	/**
	 *
	 */
	function __invoke($REQ, $RES, $ARG)
	{
		$dbc = _dbc();

		$S = new \OpenTHC\PDB\Search($this->_container);
		$res = $S->search($_GET['q'], $_GET['p']);

		$data = array(
			'Page' => array('title' => 'Product List'),
			'search_page' => array(
				'q' => $_GET['q'],
				'cur' => max(1, intval($_GET['p'])),
				'max' => $res['page']['max'],
			),
			'search_data' => $res['data'],
		);

		// var_dump($data);

		$html = $this->render('search.php', $data);

		return $RES->write( $html );

	}
}
