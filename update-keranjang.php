<?php 
	
	// include_once'function/database.php';
	include_once'function/helper.php';

	$keranjang	= $_SESSION['keranjang']; 
	$barang_id	= $_POST['barang_id'];
	$value		= $_POST['value'];

	$keranjang[$barang_id]["quantity"]	= $value;
	$_SESSION['keranjang'] = $keranjang;
 ?>