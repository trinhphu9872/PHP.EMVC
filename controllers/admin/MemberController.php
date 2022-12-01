<?php

/**
 * 
 */
class MemberController extends Controller
{

	public function __construct()
	{
		$this->folder = "admin";
		if (!isset($_SESSION['admin'])) {
			header("Location: http://localhost/WBH_MVC/indexadmin");
		}
	}
	public function index()
	{
		require_once 'vendor/Model.php';
		require_once 'models/admin/memberModel.php';
		$md = new memberModel;
		$data = $md->getAllMembers();
		$this->render('member', $data, 'user', 'admin');
	}
	public function action()
	{
		$actionName = $id = '';
		if (isset($_POST['name'])) {
			$actionName = $_POST['name'];
		}
		if (isset($_POST['id'])) {
			$id = $_POST['id'];
		}
		require_once 'vendor/Model.php';
		require_once 'models/admin/memberModel.php';

		$md = new memberModel;
		switch ($actionName) {
			case 'del':
				$md->delete('thanhvien', 'id = ' . $id);
				break;
			case 'add':
				$data = [
					"name" => '"' . $_POST['userNa'] . '"',
					"username" => '"' . $_POST['username'] . '"',
					"pass" => '"' . $_POST['password'] . '"',
					"addr" => '"' . $_POST['addr'] . '"',
					"phone" => '"' . $_POST['tel'] . '"',
					"email" => '"' . $_POST['email'] . '"',
					"createttime" => "NOW()",
					"role" => '"' . $_POST['role'] . '"',
					"isDel" => 0,
				];

				$md->insert('user', array_values($data), array_keys($data));

				break;

			default:
				echo "Error!";
				break;
		}
	}
}
