<?php

/**
 * 
 */
class IndexController extends Controller
{
	function __construct()
	{
		$this->folder = "default";
	}
	function index()
	{
		require_once 'vendor/Model.php';
		require_once 'models/admin/productModel.php';
		$md = new productModel;
		$data = $md->getAllPrds();

		$this->render('index', $data);
	}
	function signup()
	{
		if (isset($_SESSION['user'])) {
			header('location: ../');
		}
		$this->render('signup');
	}
	function signin()
	{
		if (isset($_SESSION['user'])) {
			header('location: ../');
		}
		$this->render('signin');
	}
}
