<?php

class categoryModel extends Model
{
	/*private $masp, $tensp, $gia;*/
	function __construct()
	{
		parent::__construct();
	}
	function getAllCtgrs()
	{
		$rs = $this->select('*', 'category', null, 'ORDER BY madm DESC');
		for ($i = 0; $i < count($rs); $i++) {
			$tmp = $this->select('count(masp)', 'category dm, product sp', 'dm.madm = sp.madm AND dm.madm = ' . $rs[$i]['madm']);
			$sum[] = $tmp[0]['count(masp)'];
		}
		for ($i = 0; $i < count($rs); $i++) {
			$rs[$i]['tongsp'] = $sum[$i];
		}
		return $rs;
	}
}
