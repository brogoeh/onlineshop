<?php 
	
	include_once'function/database.php';
	include_once'function/helper.php';

	unset($_SESSION['user_id']);
	unset($_SESSION['username']);
	unset($_SESSION['level']);
	header("location: " .BASE_URL. "index.php");


 ?>