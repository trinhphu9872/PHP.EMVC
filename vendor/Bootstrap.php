<?php

/**
 * 
 */
class Bootstrap
{
	function __construct()
	{
		$url = isset($_GET['url']) ? $_GET['url'] : null;
		$url = ($url == null) ? $url :  rtrim($url, '/');
		$url = filter_var($url, FILTER_SANITIZE_URL);
		$url = explode('/', $url);

		$index = ($url[0] == 'Admin') ? 1 : 0;
		$indexRoles = ($url[0] == 'Admin') ? 2 : 1;

		if (empty($url[0])) {
			require_once 'controllers/default/IndexController.php';
			$object_controller = new IndexController();
			$object_controller->index();
			return false;
		} else {
			$controller = ucfirst($url[$index]) . "Controller";
			$ctrlerPath = "";
			if (file_exists("controllers/default/" . $controller . ".php")) {
				$ctrlerPath = "controllers/default/" . $controller . ".php";
			} elseif (file_exists("controllers/users/" . $controller . ".php")) {
				$ctrlerPath = "controllers/users/" . $controller . ".php";
			} elseif (file_exists("controllers/admin/" . $controller . ".php")) {
				$ctrlerPath = "controllers/admin/" . $controller . ".php";
			} else {
				$ctrlerPath = "";
			}

			if ($ctrlerPath != "") {
				require_once $ctrlerPath;
				$object_controller = new $controller;
				if (empty($url[$indexRoles])) {
					$object_controller->index();
				} else {
					if (method_exists($controller, $url[$indexRoles])) {
						$classMethod = new ReflectionMethod($controller, $url[$indexRoles]);
						$argumentCount = count($classMethod->getParameters());

						// echo $url[$indexRoles + 1];
						$argsArr = array();
						for ($i = 2; $i <= $argumentCount + 1; $i++) {

							if (isset($url[$indexRoles])) {
								$argsArr[] = $url[$indexRoles + 1];
							}
						}
						$args = implode(",", $argsArr);
						$args = rtrim($args);
						// if (isset($url[$argumentCount + 2])) {
						// 	echo "du tham so";
						// }

						$object_controller->{$url[$indexRoles]}($args);
					} else {
						echo "ERR 404: Request not found!";
					}
				}
			} else {
				echo "ERR 404: Request not found!";
			}
		}
	}
}
