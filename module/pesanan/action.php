<?php 

	include_once'../../function/database.php';
	include_once'../../function/helper.php';

	$pesanan_id 		= $_GET['pesanan_id']; 
	$button 			= $_POST['button'];

	if($button == "Konfirmasi"){
		$user_id		    = $_SESSION['user_id'];
		$nomor_rekening 	= $_POST['nomor_rekening'];
		$nama_account 		= $_POST['nama_account'];
		$tanggal_transfer	= $_POST['tanggal_transfer'];

		$queryPembayaran = "INSERT INTO konfirmasi_pembayaran(pesanan_id, nomor_rekening, nama_account, tanggal_transfer) VALUES('$pesanan_id', '$nomor_rekening', '$nama_account', '$tanggal_transfer')";

		$result = mysqli_query($links, $queryPembayaran);
	

		if($result){
		
			mysqli_query($links, "UPDATE pesanan SET status='1' WHERE pesanan_id='$pesanan_id'");
			}
		}elseif ($button == "Edit Status") {
			$status = $_POST['status']; 

			mysqli_query($links, "UPDATE pesanan SET status='$status' WHERE pesanan_id='$pesanan_id'");

			if($status == "2"){

				$sql = mysqli_query($links, "SELECT * FROM pesanan_detail WHERE pesanan_id='$pesanan_id'");

				while($row = mysqli_fetch_assoc($sql)){

					$barang_id = $row['barang_id'];
					$quantity  = $row['quantity'];

					mysqli_query($links, "UPDATE barang SET stok = stok-$quantity WHERE barang_id='$barang_id'");

				}
			}
		}

		header("location: ".BASE_URL.'index.php?page=my-profile&module=pesanan&action=list');
	
 ?>