<?php

/**
 * 
 */
class CategoryController extends Controller
{
	private $categoryE;
	private  $defaultLink = "Location: http://192.168.2.67/PHP.EMVC/Admin/category";
	public function __construct()
	{
		$this->folder = "admin";
		if (!isset($_SESSION['admin'])) {
			header("Location: http://192.168.2.67/PHP.EMVC/indexadmin");
		}
		require_once 'vendor/Model.php';
		require_once 'models/admin/categoryModel.php';
		$this->categoryE = new categoryModel;
		// init Alert

	}
	public function index()
	{
		$data = $this->categoryE->getAll();

		$this->render('category', $data, 'DANH MỤC SẢN PHẨM', 'admin');
	}

	public function createCategory()
	{

		if ($this->checkPermission(array_key_first($_SESSION['admin']['Permission']),  'ADD_CATEGORY')) {
			$data = [
				'name_category' =>  '"' . $_POST["categoryName"] . '"',
				'origin_category' =>  '"' . $_POST["categoryCountry"] . '"',
			];
			$check  = $this->categoryE->exe_query("SELECT name_category  FROM category WHERE name_category = " . $data['name_category']);
			// print_r($check);
			// echo $check;
			if ($check == 1  && $data['name_category'] != '' && $data['origin_category'] != '') {
				$target_dir = "public/images/" . $data['name_category'];
				if (!file_exists($target_dir) && $this->categoryE->insert('category', array_values($data), array_keys($data)) == 1) {
					$target_dir = "public/images/" . $_POST["categoryName"];
					if (!file_exists($target_dir)) {
						mkdir($target_dir, 0777, true);
					}
					header($this->defaultLink);
					// $_SESSION["success"] = 'Thành công tạo category';
				} else {
					header($this->defaultLink);
					// $_SESSION["error"] = 'Không thể thêm category';
				}
			} else {
				header($this->defaultLink);
				// $_SESSION["error"] = 'Khồng được để trống trường dữ liêu';
			}
		} else {
			echo "Bạn không có quyền hạn sử dụng chức năng";
		}
	}

	public function editCategory()
	{
		if ($this->checkPermission(array_key_first($_SESSION['admin']['Permission']),  'EDIT_CATEGORY')) {
			$data = [
				'name_category' =>  '' . $_POST["categoryName"] . '',
				'origin_category' =>  '' . $_POST["categoryCountry"] . '',

			];
			// 'id' =>  '"' . $_POST["id"] . '"'
			$check  = $this->categoryE->exe_query("SELECT name_category  FROM category WHERE id_category = " . $_POST["id"]);
			// echo $check;
			// print_r($check);
			if ($check == 1 && $data['name_category'] != '' && $data['origin_category'] != '') {
				// $target_dir = "public/images/" . $data['name_category'];

				$target_dir = "public/images/" . $_POST["categoryName"];

				if (!file_exists($target_dir)) {
					mkdir($target_dir, 0777, true);
				}
				$this->categoryE->update('category',  array_keys($data), array_values($data), 'id_category = ' . $_POST["id"]);

				// $_SESSION["success"] = 'Thành công sửa category';

				header($this->defaultLink);
				// $_SESSION["error"] = 'Không thể sửa category';

			} else {

				header($this->defaultLink);
				// $_SESSION["error"] = 'Tổn tại từ khoá category';
			}
		} else {
			echo "Bạn không có quyền hạn sử dụng chức năng";
		}
	}


	public function deleteCategory()
	{
		if ($this->checkPermission(array_key_first($_SESSION['admin']['Permission']),  'DEL_CATEGORY')) {

			if ($this->categoryE->delete('category', 'id_category = ' . $_POST['id']) == 1) {
				echo 'OK';
			} else {
				echo "Xoá khoá ngoại không thành công : dính khoá ngoại sản phẩm  categỏy ";
			}
		} else {
			echo "Bạn không có quyền hạn sử dụng chức năng";
		}
	}
}
