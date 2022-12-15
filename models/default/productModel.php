<?php

class productModel extends Model
{
	/*private $masp, $tensp, $gia;*/
	function __construct()
	{
		parent::__construct();
	}
	function getPrds($orderBy, $start, $last, $where = null)
	{
		if ($where === null) {
			$sql = "SELECT * FROM product ORDER BY " . $orderBy . " desc LIMIT " . $start . "," . $last;
		} else {
			$sql = "SELECT * FROM product WHERE " . $where . " ORDER BY " . $orderBy . " desc LIMIT " . $start . "," . $last;
		}

		$prd = array();
		foreach ($this->conn->query($sql) as $row) {
			$prd[] = $row;
		}
		return $prd;
	}
	function getPrdById($masp)
	{
		// if (isset($masp)) {
		// 	# code...
		// 	$masp = $_POST['masp'];
		// }
		$sql = "SELECT * FROM product WHERE masp = " . $masp;

		$prd = array();

		foreach ($this->conn->query($sql) as $row) {
			$prd = $row;
		}

		return $prd;
	}
}
