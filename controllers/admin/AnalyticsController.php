<?php

/**
 * 
 */
class AnalyticsController extends Controller
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
		$this->render('analytics', null, 'ANALYTICS', 'admin');
	}
	function memberAnalytics()
	{
		require_once 'vendor/Model.php';
		$this->render('memberAnalytics', null, 'MEMBER ANALYTICS', 'admin');
	}
}
