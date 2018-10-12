<?php 

	include_once 'function/database.php';
	include_once 'function/helper.php';

	// $data = isset($_GET['page']) ? $_GET['page'] : false;

	$level			= 'customer';
	$username		=	mysqli_real_escape_string($links, $_POST['username']);
	$email			=	mysqli_real_escape_string($links, $_POST['email']);
	$alamat			=	mysqli_real_escape_string($links, $_POST['alamat']);
	$phone			=	mysqli_real_escape_string($links, $_POST['phone']);
	$password		=	mysqli_real_escape_string($links, $_POST['password']);
	$re_password	=	mysqli_real_escape_string($links, $_POST['re_password']);
	$status			= 'on';

	unset($_POST['password']);
	unset($_POST['re_password']);
	unset($_POST['_token']);
	unset($_POST['submit']);
	$data	=	http_build_query($_POST);
	// var_dump($data); die();
	
	$sql	= "SELECT * FROM user WHERE email='$email'";
	$result	= mysqli_query($links, $sql);
	
	if (empty(trim($username)) || empty(trim($email)) || empty(trim($alamat)) || empty(trim($phone)) || empty(trim($password)) || empty(trim($re_password)) ) { 
		header("location: " .BASE_URL. "index.php?page=register&notif=require&$data");
	}elseif (mysqli_num_rows($result) == 1) {
		header("location: " .BASE_URL. "index.php?page=register&notif=email&$data");
	}elseif ($password = ($password != $re_password)) {
		header("location: " .BASE_URL. "index.php?page=register&notif=re_password&$data");
	}elseif (strlen($re_password) < 6) { 
		header("location: " .BASE_URL. "index.php?page=register&notif=password&$data");
	}elseif (strlen($username) < 3 ) {
		header("location: " .BASE_URL. "index.php?page=register&notif=username&$data");
	}else{
		$password		=	password_hash($_POST['password'], PASSWORD_DEFAULT);
		
		$query			=	"INSERT INTO user(level, nama, email, alamat, phone, password, status) VALUES('$level', '$username', '$email', '$alamat', '$phone', '$password', '$status')";
		// var_dump($query); die();
		$result	=	mysqli_query($links, $query);

		header("location: " .BASE_URL. "login.html");
	}

?>