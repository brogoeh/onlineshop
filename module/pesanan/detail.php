<?php 

	$pesanan_id	= $_GET['pesanan_id'];

	$query 		= "SELECT pesanan.nama_penerima, pesanan.nomor_telepon, pesanan.alamat, pesanan.tanggal_pemesanan, user.nama, kota.kota, kota.tarif FROM pesanan JOIN user ON pesanan.user_id=user.user_id JOIN kota ON kota.kota_id=.pesanan.kota_id WHERE pesanan.pesanan_id='$pesanan_id'";

	$result 	= mysqli_query($links, $query);

	$row 		= mysqli_fetch_assoc($result);


	// declare query
	
	$nama_penerima 		= $row['nama_penerima'];
	$alamat		   		= $row['alamat'];
	$nomor_telepon 		= $row['nomor_telepon'];
	$tanggal_pemesanan	= $row['tanggal_pemesanan'];
	$nama   			= $row['nama'];
	$kota   			= $row['kota'];
	$tarif				= $row['tarif'];


 ?>

 <div id="frame-faktur">
 	<h3><center> Detail Pesanan </center></h3>
 	<hr>
	<table>
		<tr>
			<td> Nomor Faktur </td>
			<td>:</td>
			<td><?=$pesanan_id;?></td>
		</tr>

		<tr>
			<td> Nama Pemesan </td>
			<td>:</td>
			<td><?=$nama;?></td>
		</tr>

		<tr>
			<td> Alamat </td>
			<td>:</td>
			<td><?=$alamat;?></td>
		</tr>

		<tr>
			<td> Nomor Telepon </td>
			<td>:</td>
			<td><?=$nomor_telepon;?></td>
		</tr>

		<tr>
			<td> Tanggal Pemesanan </td>
			<td>:</td>
			<td><?=$tanggal_pemesanan;?></td>
		</tr>


	</table>

 </div>

<table class="table-list">
	<tr class="table-row">
		<th class="middle">No</th>
		<th class="left">Nama Barang</th>
		<th class="middle">Qty</th>
		<th class="right">Harga Satuan</th>
		<th class="right">Total</th>
	</tr>
	
	<?php 

		$queryDetail = "SELECT pesanan_detail.*, barang.nama_barang FROM pesanan_detail JOIN barang ON pesanan_detail.barang_id = barang.barang_id WHERE pesanan_detail.pesanan_id= '$pesanan_id'";
// var_dump($queryDetail); die();
		$results	 = mysqli_query($links, $queryDetail);
		// var_dump($results); die();	 	
		$no= 1;
		$subtotal = 0;
		while($rowDetail = mysqli_fetch_assoc($results)){
			$total 		= $rowDetail['harga'] * $rowDetail['quantity'];
			$subtotal	= $subtotal + $total;
			echo "<tr>
					<td class='middle'> $no </td>
					<td class='left'> $rowDetail[nama_barang] </td>
					<td class='middle'> $rowDetail[quantity] </td>
					<td class='right'>". idr($rowDetail['harga']) ."</td>
					<td class='right'>". idr($total) ."</td>
				  </tr>";

			

			$no++;
		}
			$subtotal 	= $subtotal + $tarif;
	 ?>

			<tr>
				<td colspan='3'></td>
				<td class='right'> Biaya Pengiriman </td>
				<td class='right'><?= idr($tarif); ?> </td>
			</tr>

			<tr>
				<td colspan='3'></td>
				<td class='left'><b> Subtotal </b></td>
				<td class='right'><b><?= idr($subtotal); ?></b></td>
			</tr>
</table>

<div id="keterangan-pembayaran">
	<p>Silahkan lakukan pembayaran ke Bank BRI Syariah <br> Nomor Account : 012-9827000 (A/N Brogoeh). <br> Setelah melakukan pembayaran silahkan konfirmasi pembayaran <a href="<?= BASE_URL."index.php?page=my-profile&module=pesanan&action=konfirmasi_pembayaran&pesanan_id=$pesanan_id"?>">Disini</a></p>
</div>
















