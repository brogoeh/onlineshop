<?php 

	include_once'../../function/database.php';
	include_once'../../function/helper.php';

	admin_only("kategori", $level);

	$button 	 = isset($_POST['button']) ? $_POST['button'] : $_GET['button'];
	$kategori_id = isset($_GET['kategori_id']) ? $_GET['kategori_id'] : "";

	$kategori = isset($_POST['kategori']) ? $_POST['kategori'] : "";
	$status	  = isset($_POST['status']) ? $_POST['status'] : "";

	if($button == "Add"){
		$query 	  = "INSERT INTO kategori(kategori, status) VALUES('$kategori', '$status')";
		$result	  = mysqli_query($links, $query);
	}elseif ($button == "Update") {
		
		$query 	  = "UPDATE kategori SET kategori='$kategori', status='$status' WHERE kategori_id='$kategori_id'";
		$result	  = mysqli_query($links, $query);
	}elseif ($button == "Delete"){
		$query 	  = "DELETE FROM kategori WHERE kategori_id='$kategori_id'";
		$result   = mysqli_query($links, $query);
	}
	header("location: " .BASE_URL. "index.php?page=my-profile&module=kategori&action=list");


 ?>