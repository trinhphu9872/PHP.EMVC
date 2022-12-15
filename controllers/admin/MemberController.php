<?php

/**
 * 
 */
class MemberController extends Controller
{
	private $memberE;
	public function __construct()
	{
		$this->folder = "admin";
		if (!isset($_SESSION['admin'])) {
			header("Location: http://192.168.2.67/PHP.EMVC/indexadmin");
		}
		require_once 'vendor/Model.php';
		require_once 'models/admin/memberModel.php';
		$this->memberE = new memberModel;
	}
	public function index()
	{
		if ($_SESSION['admin']['role_id'] == 1) {
			$data = $this->memberE->getAllMembers();
			$this->render('member', $data, 'user', 'admin');
		} else {
			header("Location: http://192.168.2.67/PHP.EMVC/Admin/indexadmin/Dashboard");
		}
	}


	public function createAccount()
	{
		if ($this->checkPermission(array_key_first($_SESSION['admin']['Permission']), "CREATE_USER")) {
			$data = [
				"name" => '"' . $_POST['userNa'] . '"',
				"username" => '"' . $_POST['username'] . '"',
				"pass" => '"' . password_hash($_POST['password'], PASSWORD_DEFAULT) . '"',
				"addr" => '"' . $_POST['addr'] . '"',
				"phone" => '"' . $_POST['tel'] . '"',
				"create_time" => "NOW()",
				"role_id" => '"' . $_POST['role'] . '"',
				"status_user" => 1,
			];
			$this->memberE->insert('user', array_values($data), array_keys($data));
		} else {
			echo "Bạn không có quyền hạn sử dụng chức năng";
		}
	}


	public function delAccount()
	{
		if ($this->checkPermission(array_key_first($_SESSION['admin']['Permission']), "DEL_USER")) {
			$id = $_POST['id'];
			$user = $this->memberE->select('status_user', 'user', 'id = ' . $id);
			$reStatus = ($user[0]['status_user'] == 1) ? 0 : 1;
			$data = [
				'status_user' => $reStatus,
			];
			if ($this->memberE->update('user', 'status_user', $data['status_user'], 'id = ' . $id) == 1) {
				echo $data['status_user'] == 1 ? "Mở thành công" : "Xoá thành công";
			} else {
				echo "Lỗi xử lí user";
			}
		} else {
			echo "Bạn không có quyền hạn sử dụng chức năng";
		}
	}
}
