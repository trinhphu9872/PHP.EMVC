<?php

/**
 * 
 */
class UserController extends Controller
{
	private $md, $pro;

	// init controller
	function __construct()
	{
		$this->folder = "users";
		require_once 'vendor/Model.php';
		require_once 'models/users/userModel.php';
		$this->md = new userModel;
	}

	// index controller
	function index()
	{
		echo "Trang khong ton tai";
	}
	// View and action register
	function signup()
	{
		$_SESSION["errdata"]  = '';
		$_SESSION["sucdata"]  = '';
		if (isset($_SESSION['user'])) {
			header('location: ../');
		}
		$_SESSION["errdata"] = '';
		$this->render('signup');
	}
	public function register()
	{
		$data = [
			'name' =>  $_POST['name'],
			'username' =>  $_POST['username'],
			'password' =>  $_POST['password'],
			'cpassword' =>  $_POST['cpassword'],
			'addr' => $_POST['addr'],
			'phone' => $_POST['tel']
		];

		$this->validationData($data, 1);

		if ($this->md->getUserByUsername($data["username"])) {
			$_SESSION["errdata"] = "Tên tài khoản đã tồn tại!";
		} else {
			if ($this->validationData($data, 1) == true && $this->md->getUserByUsername($data["username"]) != 1) {
				$this->md->addUser($data['name'], $data['username'], password_hash($data['password'], PASSWORD_DEFAULT), $data['addr'], $data['phone']);
				$_SESSION['user'] = $this->md->getUserByUsername($data["username"]);
				$userCart = [];
				$sql = '';
				if (isset($_SESSION['cart'])) {
					$sql = "SELECT masp FROM giohang WHERE user_id = " . $_SESSION['user']['id'];
					$userCart = $this->md->getListMasp($sql);
					$addData = [];
					for ($j = 0; $j < count($_SESSION['cart']); $j++) {
						$pos = false;
						if ($userCart != '') {
							$pos = array_search($_SESSION['cart'][$j], $userCart);
						}
						if ($pos === false) {
							$addData[] = $_SESSION['cart'][$j];
						}
					}
					$sql = "";
					for ($i = 0; $i < count($addData); $i++) {
						$sql .= "INSERT INTO giohang VALUES (" . $_SESSION['user']['id'] . ", " . $addData[$i] . ");\n";
					}
					$this->md->exe_query($sql);
				}
				$_SESSION["errdata"] = '';
				$_SESSION["sucdata"] = "Đăng kí tài khoản thành cồng";
			} else {
			}
		}
		$this->render('signup');
	}
	// login view and action 
	function signin()
	{
		$_SESSION["errdata"] = '';
		$_SESSION["sucdata"] = '';

		if (isset($_SESSION['user'])) {
			header('location: ../');
		}
		$this->render('signin');
	}

	// action login
	function login()
	{
		$this->md = new userModel;
		$dataGet = [
			'username' =>  $_POST['username'],
			'password' =>  $_POST['password'],
		];

		$flag =  $this->validationLogin($dataGet);

		$tempChek = $this->md->getUserByUsername($dataGet['username']);
		if ($tempChek && $flag) {
			$data = $tempChek;
			if (password_verify($dataGet['password'], $tempChek['pass']) && $flag) {
				$_SESSION['user'] = $data;
				$userCart = [];
				if (isset($_SESSION['cart'])) {
					$sql = "SELECT masp FROM giohang WHERE user_id = " . $data['id'];
					$userCart = $this->md->getListMasp($sql);
					$addData = [];
					for ($j = 0; $j < count($_SESSION['cart']); $j++) {
						$pos = array_search($_SESSION['cart'][$j], $userCart);
						if ($pos === false) {
							$addData[] = $_SESSION['cart'][$j];
						}
					}
					$sql = "";
					for ($i = 0; $i < count($addData); $i++) {
						$sql .= "INSERT INTO giohang VALUES (" . $data['id'] . ", " . $addData[$i] . ");\n";
					}
					$this->md->exe_query($sql);
				}
				// set cart
				$sql = "SELECT masp FROM giohang WHERE user_id = " . $data['id'] . "";
				$_SESSION['cart'] = null;
				$_SESSION['cart'] = $this->md->getListMasp($sql);
				// set cookiee
				$cookie_value = $tempChek['username'];
				setcookie('user', $cookie_value, time() + (86400 * 30), "/");
				// set redirect
				$this->folder = "default";
				require_once 'models/admin/productModel.php';
				$this->pro = new productModel;
				$this->render('index', $this->pro->getAllPrds());
			} else {
				$_SESSION["errdata"] = "Sai tên tài khoản hoặc mật khẩu!";
				$this->render('signin');
			}
		} else {
			$this->render('signin');
		}
	}

	// check login user
	function rememberLogin()
	{
		/*session_start();*/
		if (isset($_COOKIE['user'])) {
			$_SESSION['user'] = $this->md->getUserByUsername($_COOKIE['user']);
			header('location: ../');
		} else {
			echo "Trang khong ton tai";
			return 0;
		}
	}
	// logout 
	function logout()
	{
		session_unset();
		session_destroy();
		unset($_COOKIE['user']);
		setcookie('user', null, -1, '/');
		header('location: ../');
	}

	// view and action edit info
	function viewinfo()
	{
		$_SESSION["errdata"]  = '';
		$_SESSION["editdata"]  = '';
		$this->render('info');
	}
	function editInfo()
	{
		$data = [
			'id' =>  $_POST['id'],
			'username' =>  $_POST['name'],
			'addr' => $_POST['addr'],
			'phone' => $_POST['tel']
		];

		if ($this->validationData($data, 3)) {
			$sql = "UPDATE user SET name = '" . $data['username'] . "', addr = '" . $data['addr'] . "', phone = '" . $data['phone'] . "',createttime = NOW()  WHERE id = " . $_SESSION['user']['id'];
			$this->md->exe_query($sql);
			$_SESSION['user'] = $this->md->getUserByUsername($_SESSION['user']['username']);
			$_SESSION["errdata"]  = '';
			$_SESSION["editdata"]  = "Cập nhật thành công";
		}
		$this->render('info');
	}
	// edit pass
	// function vieweditpassword()
	// {
	// 	$this->render('editPassword');
	// }
	// function editpassword()
	// {
	// 	require_once 'vendor/Model.php';
	// 	require_once 'models/users/userModel.php';
	// 	$md = new userModel;
	// 	$opw = $npw = $cnpw = "";
	// 	if (isset($_POST['opw'])) {
	// 		$opw = $_POST['opw'];
	// 	}
	// 	if (isset($_POST['npw'])) {
	// 		$npw = $_POST['npw'];
	// 	}
	// 	if (isset($_POST['cnpw'])) {
	// 		$cnpw = $_POST['cnpw'];
	// 	}
	// 	if ($opw != $_SESSION['user']['pass']) {
	// 		echo "Mật khẩu cũ sai!";
	// 		return 0;
	// 	} else {
	// 		if ($npw != $cnpw) {
	// 			echo "Nhập lại mật khẩu không trùng khớp!";
	// 			return 0;
	// 		}
	// 	}
	// 	$sql = "UPDATE user SET pass = '" . $npw . "' WHERE id = " . $_SESSION['user']['id'];
	// 	$_SESSION['user'] = $md->getUserByUsername($_SESSION['user']['username']);
	// 	$md->exe_query($sql);
	// }

	public function validationData($param, $type)
	{
		$flag = true;

		switch ($type) {
			case 1:
				if ($param['username'] == "") {
					$_SESSION["errdata"] = "Tên tài khoản không được để trống!";
					$flag = false;
					break;
				} else if ($param['password'] == '') {
					$_SESSION["errdata"] =  " Mật khẩu không được để trống!";
					$flag = false;
					break;
				} else if (preg_match_all("/^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[#?!@$%^&*-]).{8,}$/", $param['password']) == false) {
					$_SESSION["errdata"] =  "Mật khẩu phải chữa kí tự hoa thường và một con số ";
					$flag = false;
					break;
				} else if (strlen($param['password']) < 8) {
					$_SESSION["errdata"] =  "Mật khẩu phải lớn hơn 8 kí tự ";
					$flag = false;
					break;
				} else if ($param['cpassword'] != $param['password']) {
					$_SESSION["errdata"] =  "Mật khẩu  nhập lại không trùng";
					$flag = false;
					break;
				} else if ($param['addr'] == '') {
					$_SESSION["errdata"] =  "Địa chỉ không được để trống!";
					$flag = false;
					break;
				}

			case 3:
				if ($param['username'] == "") {
					$_SESSION["errdata"] = "Tên tài khoản không được để trống!";
					$flag = false;
					break;
				} else if ($param['addr'] == '') {
					$_SESSION["errdata"] =  "Không bỏ trống địa chỉ";
					$flag = false;
					break;
				} else if ($param['phone'] == '') {
					$_SESSION["errdata"] =  "Không bỏ trống số điện thoại";
					$flag = false;
					break;
				}
			default:
				# code...
				break;
		}
		return $flag;
	}

	public function validationLogin($param)
	{
		$flag = true;
		if ($param['username'] == "") {
			$_SESSION["errdata"] = "Tên tài khoản không được để trống!";
			$flag = false;
		} else if ($param['password'] == '') {
			$_SESSION["errdata"] =  " Mật khẩu không được để trống!";
			$flag = false;
		}
		return $flag;
	}


	public function orderDonHang()
	{
		require_once 'vendor/Model.php';
		require_once 'models/admin/orderModel.php';
		$md = new orderModel;
		$data = $md->getOrderUser();
		$this->render('DonHang', $data, 'GIAO DỊCH');
	}
}
