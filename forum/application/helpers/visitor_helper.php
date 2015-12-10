<?php
	function visitorIdentity($idUser, $idThread)
	{
		$visitor = array(
			'thread'	 => $idThread,
			'ip_address' => $_SERVER['REMOTE_ADDR'],
			'access_url' => $_SERVER['HTTP_HOST'],
			'user_agent' => $_SERVER['HTTP_USER_AGENT'],
			'user_id'	 => $idUser,
			'created_at' => date('Y-m-d').' '.date('G:i:s')
		);
		return $visitor;
	}
