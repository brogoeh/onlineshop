<?php 

	include_once"function/database.php";
	include_once"function/helper.php";

	if(check($_POST['_token'])){

	$nama_penerima	= mysqli_real_escape_string($links, $_POST['nama_penerima']);
	$nomor_telepon	= mysqli_real_escape_string($links, $_POST['nomor_telepon']);
	$alamat			= mysqli_real_escape_string($links, $_POST['alamat']);
	$kota			= mysqli_real_escape_string($links, $_POST['kota']);

	$user_id		= $_SESSION['user_id']; 
	$waktu_saat_ini	= date('Y-m-d H:i:s'); 

	unset($_POST['_token']);
	unset($_POST['submit']);
	$data = http_build_query($_POST);

	if(empty(trim($nama_penerima)) || empty(trim($nomor_telepon)) || empty(trim($alamat)) || empty(trim($kota))){
		header("location: ". BASE_URL . "index.php?page=data-pemesan&notif=require&$data");
	}elseif(!is_numeric($nomor_telepon)){
		header("location: ". BASE_URL . "index.php?page=data-pemesan&notif=number&$data");
	}
	else{

			$query			= "INSERT INTO pesanan (kota_id, user_id, nama_penerima,  nomor_telepon,  alamat, tanggal_pemesanan, status) VALUES ('$kota', '$user_id', '$nama_penerima', '$nomor_telepon', '$alamat', '$waktu_saat_ini', '0')";

			$result			= mysqli_query($links, $query); //var_dump($query);

		}
		
		if($result){
			$last_pesanan_id = mysqli_insert_id($links);
			$keranjang		 = $_SESSION['keranjang'];

			foreach ($keranjang as $key => $value) {
				$barang_id = $key;
				$quantity  = $value['quantity'];
				$harga	   = $value['harga'];

				mysqli_query($links, "INSERT INTO pesanan_detail(pesanan_id, barang_id, quantity, harga) VALUES('$last_pesanan_id', '$barang_id', '$quantity', '$harga')");
			}
			unset($_SESSION["keranjang"]);

			header("location: ".BASE_URL."index.php?page=my-profile&module=pesanan&action=detail&pesanan_id=$last_pesanan_id");
		}
	// }
  

	}else{
		header("location: ". BASE_URL. "index.php?page=data-pemesan&notif=token");
	}


 ?>