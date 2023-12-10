<?php
/**
 * Downloads
 */

namespace OpenTHC\PDB\Controller;

use Edoceo\Radix\DB\SQL;

class Download extends \OpenTHC\Controller\Base
{
	function __invoke($REQ, $RES, $ARG)
	{
		$spec = (preg_match('/([\w\-]+)\.(\w+)$/', $ARG['file'], $m) ? $m : null);
		if (empty($spec)) {
			var_dump($m);
			var_dump($ARG);
			exit;
		}
		// var_dump($spec); exit;
		if ('openthc-product-data' !== $spec[1]) {
			__exit_text('No');
		}

		switch ($spec[2]) {
		case 'csv':
			$this->sendAsXSV(',');
			break;
		case 'tsv':
			$this->sendAsXSV("\t");
			break;
		case 'json':
			return $this->sendAsJSON($RES);
			break;
		case 'sql':
			$this->sendAsSQL();
			break;
		case 'xml':
			$this->sendAsXML();
			break;
		default:
			// Not Found
			return $RES->withStatus(404);
			break;
		}
	}

	function load_product()
	{
		$dbc = $this->_container->DB;
		$sql = 'SELECT * FROM product ORDER BY name';
		$res = $dbc->fetchAll($sql);
		return $res;
	}

	/**
	 * Send text/plain output using some-char separated values
	 * @param [type] $sep char, the separator
	 * @return never
	 */
	function sendAsXSV($sep)
	{
		$res = $this->load_product();

		header('Content-Type: text/plain');

		$csv = array();
		$csv[] = 'ID';
		$csv[] = 'Type';
		$csv[] = 'Product';
		// $csv[] = 'Stuff';

		echo implode($sep, $csv);
		echo "\n";

		foreach ($res as $rec) {

			$csv = array();
			$csv[] = $rec['id'];
			$csv[] = sprintf('"%s"', $rec['type']);
			$csv[] = sprintf('"%s"', str_replace('"', '\\"', $rec['name']));
			// $csv[] = sprintf('"%s"', $rec['stub']);

			echo implode($sep, $csv);
			echo "\n";
		}

		exit(0);
	}

	function sendAsJSON($RES)
	{
		$res = $this->load_product();

		$out = array();

		foreach ($res as $rec) {
			$out[] = array(
				'id' => $rec['id'],
				'name' => $rec['name'],
				'stub' => $rec['stub'],
				'type' => $rec['type'],
			);
		}

		return $RES->withJSON($out, 200, JSON_PRETTY_PRINT);

	}

	function sendAsSQL()
	{
		$res = $this->load_product();

		header('Content-Type: text/plain');

		echo <<<EOS
-- Adjust for your RDBMS
CREATE TABLE product (
	id varchar(26) PRIMARY KEY,
	type varchar(26) NOT NULL,
	name varchar(256) NOT NULL,
	name_code varchar(256) NOT NULL,
	stub varchar(128) NOT NULL
);

CREATE TABLE product_package (
	id varchar(26) PRIMARY KEY,
	product_id varchar(26) NOT NULL,
	name varchar(256) NOT NULL,
	size numeric(16, 4) NOT NULL,
	unit varchar(8) NOT NULL
);

CREATE TABLE product_package_variety (
	id varchar(26) PRIMARY KEY,
	product_id varchar(26) NOT NULL,
	package_id varchar(26) NOT NULL,
	variety_id varchar(26) NOT NULL
);

EOS;

		echo "\n";
		echo "\n";

		foreach ($res as $rec) {

			$csv = array();
			$csv[] = $rec['id'];
			$csv[] = sprintf('"%s"', $rec['type']);
			$csv[] = sprintf('"%s"', str_replace('"', '\\"', $rec['name']));

			echo 'INSERT INTO product (id, type, name) VALUES (';
			echo implode(', ', $csv);
			echo ');';
			echo "\n";

		}

		exit(0);
	}

	function sendAsXML()
	{
		$res = $this->load_product();

		//header('Content-Disposition: attachment; filename=openthc-product-data.xml');
		header('Content-Type: text/xml');

		echo <<<EOF
<?xml version="1.0" encoding="utf-8"?>
<!--
	This file generated from https://pdb.openthc.com/pub/openthc-product-data.xml
	See https://pdb.openthc.com/ for license information
-->
<!-- <?xml-stylesheet type="text/css" href="https://pdb.openthc.org/css/xml.css"?> -->
<products>
EOF;
		foreach ($res as $rec) {

			$rec['name'] = htmlspecialchars($rec['name'], ENT_XML1, 'utf-8');

			echo "<product>\n";
			echo "\t<name>{$rec['name']}</name>\n";
			echo "\t<stub>{$rec['stub']}</stub>\n";
			echo "\t<type>{$rec['type']}</type>\n";
			echo "</product>\n";
		}

		echo "</products>\n";
		echo "\n";

		exit(0);
	}
}
