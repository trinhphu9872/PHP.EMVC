<?php

/**
 * 
 */
class CategoryController extends Controller
{

	function __construct()
	{
		$this->folder = "admin";
		if (!isset($_SESSION['admin'])) {
			header("Location: http://localhost/WBH_MVC/indexadmin");
		}
	}
	function index()
	{
		require_once 'vendor/Model.php';
		require_once 'models/admin/categoryModel.php';
		$md = new categoryModel;
		$data = $md->getAllCtgrs();
		$this->render('category', $data, 'DANH MỤC SẢN PHẨM', 'admin');
	}
	function action()
	{
		$actionName = $id = $cname = $ccountry = '';
		if (isset($_GET['name'])) {
			$actionName = $_GET['name'];
		}
		if (isset($_GET['id'])) {
			$id = $_GET['id'];
		}
		require_once 'vendor/Model.php';
		require_once 'models/admin/categoryModel.php';
		$md = new categoryModel;

		switch ($actionName) {
			case 'add':
				if (isset($_GET['cname'])) {
					$cname = $_GET['cname'];
				}
				if (isset($_GET['ccountry'])) {
					$ccountry = $_GET['ccountry'];
				}
				if ($cname == '') {
					echo "Bạn chưa điền tên danh mục!";
					return;
				}
				$data = [
					'tendm' => '"' . $cname . '"',
					'xuatsu' => '"' . $ccountry . '"'
				];

				if ($md->insert('category', array_values($data), array_keys($data)) == 1) {
					echo "OK";
				} else {
					echo "không thêm vào categỏy";
				}
				break;

			case 'del':
				if ($md->delete('category', 'madm = ' . $id) == 1) {
					echo "OK";
				} else {
					echo "</br> dính khoá ngoại sản phẩm  categỏy ";
				}
				break;

			case 'edit':
				$c4edit = $n4edit = '';
				$setRow = array('tendm', 'xuatsu');
				if (isset($_GET['country4edit'])) {
					$c4edit = $_GET['country4edit'];
				}
				if (isset($_GET['name4edit'])) {
					$n4edit = $_GET['name4edit'];
				}
				$setVal = array($n4edit, $c4edit);
				$md->update('category', $setRow, $setVal, 'madm = ' . $id);
				echo "OK";
				break;

			default:
				# code...
				break;
		}
	}
}
