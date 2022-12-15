<?php

use LDAP\Result;

/**
 * 
 */
class ProductAdminController extends Controller
{

	private $productE, $categoryE;
	private  $defaultLink = "Location: http://192.168.2.67/PHP.EMVC/Admin/productadmin";
	public function __construct()
	{
		$this->folder = "admin";
		if (!isset($_SESSION['admin'])) {
			header($this->defaultLink);
		}
		require_once 'vendor/Model.php';
		require_once 'models/admin/productModel.php';
		require_once 'models/admin/categoryModel.php';
		// mk model
		$this->productE = new productModel;
		$this->categoryE = new categoryModel;
		$_SESSION["name_category"] = $this->categoryE->select('id_category,name_category', 'category', null, 'ORDER BY id_category DESC');
	}
	function index()
	{

		if ($_SESSION['admin']['role_id'] == 1) {
			$data = $this->productE->getProductAndUser();
			$this->render('product', $data, 'SẢN PHẨM', 'admin');
		} else {
			$data = $this->productE->getAllRoles($_SESSION['admin']['id']);
			$this->render('product', $data, 'SẢN PHẨM', 'admin');
		}
	}

	// fix action create
	public function createProduct()
	{
		if ($this->checkPermission(array_key_first($_SESSION['admin']['Permission']),  'CRE_PRO')) {
			header('Content-type: image/jpeg');
			$folder = $this->categoryE->getName($_POST['category']);
			$target_dir = "public/images/" . $folder[0]['name_category'] . '/';
			$target_dir_clone = "images/" . $folder[0]['name_category'] . '/';
			$file = $_FILES['fileToUpload']['name'];
			$path = pathinfo($file);
			$filename = $path['filename'];
			$ext = $path['extension'];
			$temp_name = $_FILES['fileToUpload']['tmp_name'];
			$path_filename_ext = $target_dir . $filename . "." . $ext;
			$path_filename_ext_clone = $target_dir_clone . $filename . "." . $ext;

			$data = [
				'user_id' => '"' . $_POST['idUser'] . '"',
				'name_product' => '"' . $_POST['tensp'] . '"',
				'desc_product' => '"' . $_POST['mota'] . '"',
				'id_category' => '"' . $_POST['category'] . '"',
				'img_prodcut' => '"' . $path_filename_ext . '"',
				'price_product' => '"' . $_POST['gia'] . '"',
				'quantity_product' => '"' . $_POST['count'] . '"',
				'status_product' => 1,
				'approve_product' => 0,
				'create_time' => 'NOW()',
			];
			// echo $this->checkPermission("SALES", 5);

			# code...
			if ($this->productE->insert('product', array_values($data), array_keys($data)) == 1) {
				move_uploaded_file($temp_name, $path_filename_ext);
				header($this->defaultLink);
			} else {
				echo "không thêm vào được database";
			}
		} else {
			echo "Bạn không có quyền hạn sử dụng chức năng";
		}
	}

	public function deleteProduct($id)
	{
		if ($this->checkPermission(array_key_first($_SESSION['admin']['Permission']), 'DEL_PRO')) {
			if ($this->productE->update('product', ['status_product', 'update_time'], ['0',  date("Y-m-d H:i:s")], 'id_product = ' . $_GET['id'])) {
				echo "OK";
			} else {
				echo  "xoá khong thành công dữ liệu";
			}
		} else {
			echo "Bạn không có quyền hạn sử dụng chức năng";
		}
	}



	public function approveProduct($id)
	{
		if ($this->checkPermission(array_key_first($_SESSION['admin']['Permission']), "APR_PRO")) {
			if ($this->productE->update('product', ['approve_product', 'update_time'], ['1',  date("Y-m-d H:i:s")], 'id_product = ' . $_GET['id'])) {
				echo "OK";
			} else {
				echo  "Phê duyệt không thành công ";
			}
		} else {
			echo "Bạn không có quyền hạn sử dụng chức năng";
		}
	}

	// fix action create
	public function editProduct()
	{
		if ($this->checkPermission(array_key_first($_SESSION['admin']['Permission']), "EDT_PRO")) {
			$folder = $this->categoryE->getName($_POST['category']);
			$target_dir = "public/images/" . $folder[0]['name_category'] . '/';
			$target_dir_clone = "images/" . $folder[0]['name_category'] . '/';
			$file = $_FILES['fileToUpload']['name'];
			$path = pathinfo($file);
			$filename = $path['filename'];
			$ext = $path['extension'];
			$temp_name = $_FILES['fileToUpload']['tmp_name'];
			$path_filename_ext = $target_dir . $filename . "." . $ext;
			$path_filename_ext_clone = $target_dir_clone . $filename . "." . $ext;


			$data = [
				'user_id' => '' . $_POST['idUser'] . '',
				'name_product' => '' . $_POST['tensp'] . '',
				'id_category' => '' . $_POST['category'] . '',
				'desc_product' => '' . $_POST['mota'] . '',
				'price_product' => '' . $_POST['gia'] . '',
				'quantity_product' => '' . $_POST['count'] . '',
				'status_product' => 1,
				'update_time' => date("Y-m-d H:i:s"),

			];
			if ($file != '') {
				$data['img_prodcut'] =  '' . $path_filename_ext  . '';
			}
			if ($this->productE->update('product', array_keys($data), array_values($data), 'id_product = ' . $_POST['idproduct']) == 1) {
				move_uploaded_file($temp_name, $path_filename_ext);
				header($this->defaultLink);
			} else {

				echo "không thêm vào được database";
			}
		} else {
			echo "Bạn không có quyền hạn sử dụng chức năng";
		}
	}
}
