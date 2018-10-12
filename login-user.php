<?php 
	
	include_once 'function/database.php';
	include_once 'function/helper.php';
	
	if(check($_POST['_token'])){

	$username	=	mysqli_real_escape_string($links, $_POST['username']);
	$password	=	mysqli_real_escape_string($links, $_POST['password']); 

	$query		=	"SELECT * FROM user WHERE nama='$username'"; 
	$result		=	mysqli_query($links, $query);

	// var_dump($result);die();
		
	$row  		= 	mysqli_fetch_assoc($result) ;

	// var_dump($row);die();
	$password 	= 	password_verify($password, $row['password']);  //var_dump($password);die();

		if($password){
			$sql		= "SELECT * FROM user WHERE nama='$username' AND status='on'"; //var_dump($sql);die();
			$results	= mysqli_query($links, $sql);
			// print_r($results); die();
			if(mysqli_num_rows($results) == 0 ){
				header("location: " .BASE_URL. "index.php?page=login&notif=true");
			}else{
				$rows 	= mysqli_fetch_assoc($results);

				$_SESSION['user_id']  = $rows['user_id'];
				$_SESSION['username'] = $rows['nama'];
				$_SESSION['level']    = $rows['level'];

				if(isset($_SESSION["proses_pesanan"])){
					unset($_SESSION["proses_pesanan"]);
					header("location: " .BASE_URL. "data-pemesan.html");
				}else{

					header("location: " .BASE_URL. "index.php?page=my-profile&module=pesanan&action=list");
					
				}
			}
		}elseif ($username != $row['nama']) {
				header("location: " .BASE_URL. "index.php?page=login&notif=username");
		}elseif ($password != $row['password']) {
				header("location: " .BASE_URL. "index.php?page=login&notif=password");
		}else{
			header("location: " .BASE_URL. "index.php?page=login&notif=true");
		}

	}else{
		header("location: " .BASE_URL. "index.php?page=login&notif=token");
	}
