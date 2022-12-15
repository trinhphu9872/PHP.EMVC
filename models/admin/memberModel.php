<?php

class memberModel extends Model
{
	function __construct()
	{
		parent::__construct();
	}
	function getAllMembers()
	{
		return $mb = $this->select('*', 'user', 'role_id = 0 or role_id = 2', 'ORDER BY create_time DESC');
	}
	function memberToday()
	{
		$now = new DateTime("", new DateTimeZone('ASIA/Ho_Chi_Minh'));
		$today = $now->format('Y-m-d');
		$beforeWeek = date("Y-m-d", strtotime("-1 week"));
		$rs = $this->select('count(id) as newmem', 'user', "DATE(create_time) <= '" . $today . "' AND DATE(create_time) >= '" . $beforeWeek . "'");
		return $rs[0]['newmem'];
	}
	function allMember()
	{
		$rs = $this->select('count(id) as sum', 'user');
		return $rs[0]['sum'];
	}
}
