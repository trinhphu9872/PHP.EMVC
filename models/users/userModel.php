<?php

/**
 * 

 */
class userModel extends Model
{

	public function __construct()
	{
		parent::__construct();
	}
	public function getUserByUsername($username)
	{
		$result = array();
		$sql = "SELECT * FROM user WHERE username = '" . $username . "'";
		if ($this->conn->query($sql)->rowCount() == 0) {
			return false;
		} else {
			$result =  $this->selectTop('*', 'user', 'username = ' . "'$username' ");
			return $result;
		}
	}

	public function getPermission($username)
	{
		$result = array();
		$user = $this->getUserByUsername($username);
		$user["Permission"] = [];
		$sql = "SELECT * FROM rolepermission r 
			LEFT JOIN permissions p using (id_permission)
			WHERE r.id_roles  = '" . $user['role_id'] . "'";
		// echo $sql;
		$query = $this->conn->prepare($sql);
		$query->execute();

		// print_r($query->fetch());
		while ($dataPermission = $query->fetch()) {
			if (!isset($user['Permission'][$dataPermission['action_permission']])) {
				# code...
				$user['Permission'][$dataPermission['action_permission']] = [];
			}
			$user['Permission'][$dataPermission['action_permission']][] = $dataPermission['desc_permission'];
		};
		return $user;
	}
	public function addUser($name, $un, $pw, $addr, $phone)
	{
		$sql = "INSERT INTO user(name,username,pass,addr,phone,createttime,role,isDel) VALUES ('" . $name . "','" . $un . "','" . $pw . "','" . $addr . "','" . $phone . "',NOW(),'0','0')";
		if (!$this->conn->query($sql)) {
			return false;
		} else {
			return true;
		}
	}
}
