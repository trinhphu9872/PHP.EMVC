<?php

class productModel extends Model
{
	function __construct()
	{
		parent::__construct();
	}
	function getAllPrds()
	{
		$prd = $this->select('*', 'product sp, category dm', 'sp.id_category = dm.id_category and sp.quantity_product > 0', 'ORDER BY sp.status_product DESC,sp.create_time DESC');
		// var_dump($prd);
		return $prd;
	}

	function getProductAndUser()
	{
		$prd = $this->select('sp.* ,dm.name_category, us.name', 'product sp, category dm, user us', 'sp.id_category = dm.id_category and sp.quantity_product > 0 and us.id = sp.user_id', 'ORDER BY sp.status_product DESC,sp.create_time DESC');

		return $prd;
	}

	function getAllRoles($id)
	{
		$prd = $this->select('sp.*,dm.name_category, us.name', 'product sp, category dm, user us', 'sp.id_category = dm.id_category and sp.quantity_product > 0 and us.id = sp.user_id and sp.user_id =' . $id, 'ORDER BY sp.status_product DESC,sp.create_time DESC');
		// echo $prd;
		return $prd;
	}
}
