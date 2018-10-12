<?php 

	include_once'../../function/database.php';
	include_once'../../function/helper.php';

	admin_only("barang", $level);

	$barang_id	= isset($_GET['barang_id']) ? $_GET['barang_id']: "";

	$sql	= mysqli_query($links, "SELECT * FROM barang WHERE barang_id='$barang_id'");
	$result	= mysqli_fetch_assoc($sql);
	// var_dump($result); die();
	$kategori_id= isset($_POST['kategori_id']) ? $_POST['kategori_id'] : false;
	$barang 	= isset($_POST['barang']) ? $_POST['barang'] : false;
	$spesifikasi= isset($_POST['spesifikasi']) ? $_POST['spesifikasi'] : false;
	$stock		= isset($_POST['stock']) ? $_POST['stock'] : false;
	$harga		= isset($_POST['harga']) ? $_POST['harga'] : false;
	$status	  	= isset($_POST['status']) ? $_POST['status'] : false;
	$button   	= isset($_POST['button']) ? $_POST['button'] : $_GET['button'];
	$updateImg	="";

	// mengubah fileName gambar
	$arrayImg	= array('.jpeg', '.png', '.jpg');
	$time		= time();
	$tmpImg		= $_FILES['file']['tmp_name'];
	$fileName	= str_replace($arrayImg, '', $_FILES['file']['name']);
	$filename	= $fileName. '_'. $time. '.jpg';

	if(!empty($_FILES['file']['name'])){
		$fileImg		= $filename;
		unlink("../../images/barang/".$result['gambar']);
		move_uploaded_file($tmpImg, "../../images/barang/".$fileImg);

		$updateImg	= ", gambar='$fileImg'";
	} 

	if($button == "Add"){
		$query 	  = "INSERT INTO barang(nama_barang, kategori_id, spesifikasi, gambar, harga, stok, status) VALUES('$barang', '$kategori_id', '$spesifikasi', '$fileImg', '$harga', '$stock', '$status')";
		$result	  = mysqli_query($links, $query); 
	}elseif ($button == "Update") {
		
		$query 	  = "UPDATE barang SET kategori_id='$kategori_id', nama_barang='$barang', spesifikasi='$spesifikasi' $updateImg, harga='$harga', stok='$stock', status='$status'  WHERE barang_id='$barang_id'"; 
		// var_dump($query); die();
		$result	  = mysqli_query($links, $query);
		 // print_r($result); die();
	}elseif ($button == "Delete") {
		$query 	  = "DELETE FROM barang WHERE barang_id='$barang_id'";
		$result   = mysqli_query($links, $query);
	}
	header("location: " .BASE_URL. "index.php?page=my-profile&module=barang&action=list");


 ?>