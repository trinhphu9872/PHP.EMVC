<?php

/**
 * 
 */
class IndexAdminController extends Controller
{
	private $productE, $userE, $memberE, $orderE;
	function __construct()
	{
		// call admin
		$this->folder = "admin";
		// call model
		require_once 'vendor/Model.php';
		require_once 'models/users/userModel.php';
		require_once 'models/admin/memberModel.php';
		require_once 'models/admin/productModel.php';
		require_once 'models/admin/OrderModel.php';
		// query
		$this->userE = new userModel;
		$this->productE = new productModel;
		$this->memberE = new memberModel;
		$this->orderE = new orderModel;
		// init Alert
		$_SESSION["errdata"] = '';
		$_SESSION["sucdata"] = '';
	}
	function index()
	{
		if (isset($_SESSION['admin'])) {
			header("Location: http://192.168.2.67/PHP.EMVC/Admin/indexadmin/Dashboard");
		}
		require_once 'views/admin/index.php';
	}
	function dashboard()
	{
		if (!isset($_SESSION['admin'])) {
			header("Location: http://192.168.2.67/PHP.EMVC/Admin/indexadmin");
		}
		$data = [];
		$data['orderToday'] = $this->orderE->orderToday();
		$data['memberToday'] = $this->memberE->memberToday();
		$data['product'] = count($this->productE->getAllPrds());
		$data['member'] = $this->memberE->allMember();
		$this->render('dashboard', $data, null, 'admin');
	}
	public function login()
	{
		$username = $_POST['username'];
		$password = $_POST['password'];
		if ($username == "" || $password == "") {
			$_SESSION["errdata"] = "Không được để trống username hoặc password";
		}
		$data = [];
		// print_r($this->userE->getPermission($username)->execute());

		if ($this->userE->getUserByUsername($username)) {
			$data = $this->userE->getPermission($username);
			if (password_verify($password, $data['pass']) && ($data['role_id'] == '1' ||  $data['role_id'] == '2')) {
				
				$_SESSION['admin'] = $data;
			} else {
				$_SESSION["errdata"] = "Sai tên tài khoản hoặc mật khẩu!";
			}
		} else {
			$_SESSION["errdata"] = "Sai tên tài khoản hoặc mật khẩu!";
		}

		$this->dashboard();
	}
	function logout()
	{
		session_unset();
		session_destroy();
		unset($_COOKIE['user']);
		$this->dashboard();
		setcookie('user', null, -1, '/');
	}
}
