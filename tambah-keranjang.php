<?php 

	include_once'function/database.php';
	include_once'function/helper.php';

	$barang_id = $_GET['barang_id'];
	$keranjang	= isset($_SESSION['keranjang']) ? $_SESSION['keranjang'] : false;

	$sql 	= "SELECT * FROM barang WHERE barang_id='$barang_id'";
	$result	= mysqli_query($links, $sql);

	$row = mysqli_fetch_assoc($result);

	$keranjang[$barang_id] = array(
									'nama_barang' => $row['nama_barang'],
									'gambar'	  => $row['gambar'],
									'harga'		  => $row['harga'],
									'quantity'	  => 1
								);

	$_SESSION['keranjang'] = $keranjang;

	header("location: ". BASE_URL);
 ?>