<?php

class orderModel extends Model
{
	function __construct()
	{
		parent::__construct();
	}
	function getAllOrders()
	{
		$gd = $this->select('*', 'transaction', null, 'ORDER BY create_time DESC');
		for ($i = 0; $i < count($gd); $i++) {
			$magdArr[] = $gd[$i]['id_transaction'];
		}
		for ($i = 0; $i < count($gd); $i++) {
			$sp = $this->select('*', 'detailtransaction ctgd, product sp', "ctgd.id_product = sp.id_product AND ctgd.id_transaction = " . $magdArr[$i] . "");
			for ($j = 0; $j < count($sp); $j++) {
				$cart[$j] = array('masp' => $sp[$j]['masp'], 'tensp' => $sp[$j]['tensp'], 'dongia' => $sp[$j]['gia'], 'soluong' => $sp[$j]['soluong']);
			}

			$gd[$i]['sp'] = $cart;
			$cart = null;
		}
		return $gd;
		/*echo "<pre>";
		print_r($gd);
		echo "</pre>";*/
	}

	function getOrderUser()
	{
		$gd = $this->select('*', 'giaodich', "user_id =" . $_SESSION['user']['id'] . "", 'ORDER BY date DESC');
		for ($i = 0; $i < count($gd); $i++) {
			$magdArr[] = $gd[$i]['magd'];
		}
		for ($i = 0; $i < count($gd); $i++) {
			$sp = $this->select('*', 'chitietgd ctgd, product sp', "ctgd.masp = sp.masp AND ctgd.magd = " . $magdArr[$i] . "");
			for ($j = 0; $j < count($sp); $j++) {
				$cart[$j] = array('masp' => $sp[$j]['masp'], 'tensp' => $sp[$j]['tensp'], 'dongia' => $sp[$j]['gia'], 'soluong' => $sp[$j]['soluong']);
			}

			$gd[$i]['sp'] = $cart;
			$cart = null;
		}
		return $gd;
	}
	public function orderToday()
	{
		$now = new DateTime("", new DateTimeZone('ASIA/Ho_Chi_Minh'));
		$today = $now->format('Y-m-d');
		$rs = $this->select('count(id_transaction) as neworder', 'transaction', "DATE(create_time) = '" . $today . "'");
		return $rs[0]['neworder'];
	}
	// function gerOrderById()
	// {
	// 	$magd = 44;
	// 	$rs = $this->select('*', 'giaodich', "magd = '" . $magd . "'");
	// 	return $rs;
	// }
}
