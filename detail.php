<div id="left">
	<?php 
		echo kategori($kategori_id);
	 ?>
</div>	
<div id="right">
	<?php 

		$barang_id = $_GET['barang_id'];

		$sql	= "SELECT * FROM barang WHERE barang_id='$barang_id' AND status='on'";
		$result = mysqli_query($links, $sql);

		$row = mysqli_fetch_assoc($result);

		echo "<div id='detail-barang'>
				<h2>$row[nama_barang]</h2>
				<div id='frame-barang'>			
					<img src='".BASE_URL."images/barang/$row[gambar]'/>
				</div>

				<div id='frame-harga'>			
					<span>".idr($row['harga'])."</span>
					<a href='".BASE_URL."tambah-keranjang.php?barang_id=$row[barang_id]'> + add to cart </a>
				</div>

				<div id='keterangan'>			
					<span class='judul'>Keterangan :</span > $row[spesifikasi]
				</div>
			  </div>";	

	 ?>
</div>