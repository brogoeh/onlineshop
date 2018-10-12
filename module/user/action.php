<?php
    include("../../function/database.php");   
    include("../../function/helper.php");

    admin_only("user", $level);   
    $button  = isset($_POST['button']) ? $_POST['button'] : $_GET['button'];
    $user_id = isset($_GET['user_id']) ? $_GET['user_id'] : false;
	
    $nama = isset($_POST['nama']) ? $_POST['nama'] : false;
	$email = isset($_POST["email"]) ? $_POST["email"] : false;
	$phone = isset($_POST["phone"]) ? $_POST["phone"] : false;
	$alamat = isset($_POST["alamat"]) ? $_POST["alamat"] : false;
	$level = isset($_POST["level"]) ? $_POST["level"] : false;
	$status = isset($_POST["status"]) ? $_POST["status"] : false;	

	if($button == "Update"){
		$query = mysqli_query($links, "UPDATE user SET nama='$nama',
												   email='$email',
												   phone='$phone',
												   alamat='$alamat',
												   level='$level',
												   status='$status'
												   WHERE user_id='$user_id'");
	}elseif ($button == "Delete") {
		$query 	= "DELETE FROM user WHERE user_id='$user_id'";
		$result = mysqli_query($links, $query);
	}
	
    header("location: ".BASE_URL."index.php?page=my_profile&module=user&action=list");
?>