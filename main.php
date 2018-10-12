<div id="left">
	<?php 
		echo kategori($kategori_id);
	 ?>
</div>	
<div id="right">
	<div id="slides">
		
		<?php 

			$queryBanner	= "SELECT * FROM banner WHERE status='on' ORDER BY banner_id DESC LIMIT 3";
			$result			= mysqli_query($links, $queryBanner);

			while($rowBanner = mysqli_fetch_assoc($result)){
				echo "<a href='". BASE_URL."$rowBanner[link]'><img src='". BASE_URL. "images/slides/$rowBanner[gambar]'/></a>";
			}

		 ?>

	</div>
	<div id="frame-barang">
		<ul>
			<?php

				if ($kategori_id) {

					$kategori_id = "AND barang.kategori_id='$kategori_id'";
					
					}

					$halaman = isset($_GET['halaman']) ? $_GET['halaman'] : 1;
					$data_per_halaman = 9;
					$mulai_dari = ($halaman - 1) * $data_per_halaman;

				 	$query 	= "SELECT barang.*, kategori.kategori FROM barang JOIN kategori ON barang.kategori_id = kategori.kategori_id WHERE barang.status='on' $kategori_id ORDER BY rand() DESC LIMIT $mulai_dari, $data_per_halaman";
					$result	= mysqli_query($links, $query);
				 
					$no = 1;
					while($row = mysqli_fetch_assoc($result)){
						$style = false;
						if($no == '3'){
							$style = "style = 'margin-left: 20px';";
							$no= 0;
						}

						$kategori = strtolower($row['kategori']);
						$barang   = str_replace(" ", "-", $row['nama_barang']);
						
						echo "<li $style>
								<p class='price'>".idr($row['harga'])."</p> <a href='".BASE_URL."$row[barang_id]/$kategori/$barang.html'>
									<img src='".BASE_URL."images/barang/$row[gambar]'>
								</a>
								<div class='keterangan-gambar'>
									<p><a href='".BASE_URL."	$row[barang_id]/$kategori/$barang.html'>$row[nama_barang]</a></p>
									<span>Stock: $row[stok]</span>
								</div>
								<div class='btn-add-cart'>
									<a href='".BASE_URL."tambah-keranjang.php?barang_id=$row[barang_id]'> + add to cart</a>
								</div>";
					$no++;
					}

			 ?>
		</ul>
	</div>
		<?php 

			$query 		   = mysqli_query($links,"SELECT barang.*, kategori.kategori FROM barang JOIN kategori ON barang.kategori_id = kategori.kategori_id WHERE barang.status='on' $kategori_id");

			$total_data	   = mysqli_num_rows($query);
			$total_halaman = ceil($total_data / $data_per_halaman);

			echo "<ul class='pagination'>";

			if($halaman > 1){
				$prev = $halaman - 1;
				echo "<li><a href='".BASE_URL."index.php?halaman=$prev''> << prev </a></li>";
			}

			for ($i=1; $i <= $total_halaman; $i++) { 
				if($halaman == $i){
					echo "<li><a class='active' href='". BASE_URL. "index.php?halaman=$i'> $i </a><li>";
				}else{
					echo "<li><a href='". BASE_URL. "index.php?halaman=$i'> $i </a><li>";
				}
			}

			if($halaman < $total_halaman){
				$next = $halaman + 1;
				echo "<li><a href='".BASE_URL."index.php?halaman=$next'> Next >></a>";

			}

			echo "</ul>";

		 ?>
</div>