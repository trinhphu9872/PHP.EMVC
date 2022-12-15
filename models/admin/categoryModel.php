<?php

class categoryModel extends Model
{
	/*private $masp, $tensp, $gia;*/
	function __construct()
	{
		parent::__construct();
	}
	public function getAll()
	{

		$categoryAll = $this->select('*', 'category', null, 'ORDER BY id_category DESC');
		//$sumCategory = $this->select('dm.id_category, count(sp.id_product) as sumProduct','category dm, product sp', 'dm.id_category = sp.id_category', 'GROUP BY dm.id_category ORDER BY dm.id_category DESC' )


		return $categoryAll;
	}

	public function getName($id)
	{
		$rs = $this->select('*', 'category', 'id_category =' . $id, 'ORDER BY id_category DESC');
		return $rs;
	}
}
