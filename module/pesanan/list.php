<?php 
	$halaman = isset($_GET['halaman']) ? $_GET['halaman'] : 1;
	$data_per_halaman = 10;
	$mulai_dari = ($halaman - 1)*$data_per_halaman;

	if($level == "superadmin"){
		$queryPesanan = "SELECT pesanan.*, user.nama FROM pesanan JOIN user ON pesanan.user_id=user.user_id ORDER BY pesanan.tanggal_pemesanan DESC LIMIT $mulai_dari, $data_per_halaman";
		$result 	  = mysqli_query($links, $queryPesanan);
	}else{
		$queryPesanan = "SELECT pesanan.*, user.nama FROM pesanan JOIN user ON pesanan.user_id=user.user_id WHERE pesanan.user_id='$user_id' ORDER BY pesanan.tanggal_pemesanan DESC LIMIT $mulai_dari, $data_per_halaman";
		$result 	  = mysqli_query($links, $queryPesanan);
	}

	if(mysqli_num_rows($result) == 0 ){
		echo "<h3> Saat ini belum ada data pesanan";
	}else{
		echo "<table class='table-list'>
				<tr class='table-row'>
					<th class='left'>Nomor Pesanan</th>
					<th class='left'>Status</th>
					<th class='left'>Nama</th>
					<th class='left'>Action</th>
				</tr>";

		while ($row = mysqli_fetch_assoc($result)) {

			$adminButton = '';
			if($level == "superadmin"){
				$adminButton = "<a class='tombol-action' href='".BASE_URL."index.php?page=my-profile&module=pesanan&action=status&pesanan_id=$row[pesanan_id]'>Update Status</a>";
			}
			$status = $row['status'];
			echo "<tr>
					<td class='left'>$row[pesanan_id]</td>
					<td class='left'>$arrayStatusPesanan[$status]</td>
					<td class='left'>$row[nama]</td>
					<td class='left'>
						<a class='tombol-action' href='".BASE_URL."index.php?page=my-profile&module=pesanan&action=detail&pesanan_id=$row[pesanan_id]'>Detail Pesanan</a> 
						$adminButton
					</td>
				  </tr>";
		}
		echo "</table>";

		$queryHalaman	= "SELECT * FROM pesanan";
		$resultHalaman	= mysqli_query($links, $queryHalaman);

		pagination($resultHalaman, $data_per_halaman, $halaman, 'index.php?page=my-profile&module=pesanan&action=list');
	}

 ?>