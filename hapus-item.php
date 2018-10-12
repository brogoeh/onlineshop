<?php 

	include_once('function/helper.php');

	$barang_id	= $_GET['barang_id'];
	$keranjang	= $_SESSION['keranjang'];

	unset($keranjang[$barang_id]);

	$_SESSION['keranjang']	= $keranjang;

	header("location: ". BASE_URL ."cart.html");

 ?>