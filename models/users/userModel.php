<?php

/**
 * 

 */
class userModel extends Model
{

	function __construct()
	{
		parent::__construct();
	}
	function getUserByUsername($username)
	{
		$result = array();
		$sql = "SELECT * FROM user WHERE username = '" . $username . "'";
		if ($this->conn->query($sql)->rowCount() == 0) {
			return false;
		} else {
			foreach ($this->conn->query($sql) as $row) {
				$result = $row;
			}
			return $result;
		}
	}
	function addUser($name, $un, $pw, $addr, $phone, $email)
	{
		$sql = "INSERT INTO user(name,username,pass,addr,phone,email,createttime,role,isDel) VALUES ('" . $name . "','" . $un . "','" . $pw . "','" . $addr . "','" . $phone . "','" . $email . "',NOW(),'0','0')";
		if (!$this->conn->query($sql)) {
			return false;
		} else {
			return true;
		}
	}
}
