<?php

class productModel extends Model
{
	function __construct()
	{
		parent::__construct();
	}
	function getAllPrds()
	{
		$prd = $this->select('*', 'product sp, category dm', 'sp.madm = dm.madm', 'ORDER BY sp.ngay_nhap DESC');
		return $prd;
	}
}
