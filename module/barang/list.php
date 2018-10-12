<?php 

	$search 	= isset($_GET['search']) ? $_GET['search'] : false; 
	$where 		= '';
	$search_url	= '';
	if($search){
		$search_url = "search&=$search";
		$where 		= "WHERE barang.nama_barang LIKE '%$search%' ";
	}

 ?>
<div id="frame-tambah">

	<div id="kiri">
		<form action="<?= BASE_URL.'index.php' ?>" method="GET">
			<input type="hidden" name="page" value="<?= $_GET['page']?>">
			<input type="hidden" name="module" value="<?= $_GET['module']?>">
			<input type="hidden" name="action" value="<?= $_GET['action']?>">
			<input type="text" name="search" value="<?= $search?>">
			<input type="submit" value="Search">
		</form>
	</div>

	<div id="kanan">
		<a href="<?= BASE_URL. 'index.php?page=my_profile&module=barang&action=form'?>" class="tombol-action"> + Tambah Barang </a>
	</div>

</div>

<?php 

	$halaman 	= isset($_GET['halaman']) ? $_GET['halaman'] : 1;
	$data_per_halaman = 10;
	$mulai_dari = ($halaman - 1)*$data_per_halaman;

	$query	= "SELECT barang.* ,kategori.kategori FROM barang JOIN kategori ON barang.kategori_id=kategori.kategori_id $where LIMIT $mulai_dari, $data_per_halaman ";
	$result	= mysqli_query($links, $query);

	if(mysqli_num_rows($result) == 0 ){
		echo "<h3>Data Nihil</h3>";
	}else{
		echo "<table class='table-list'>";
		echo "<tr class='baris-title'>
				<th class='number'>No</th>
				<th class='left'>Barang</th>
				<th class='left'>Kategori</th>
				<th class='middle'>Harga</th>
				<th class='middle'>Status</th>
				<th class='middle'>Action</th>
			 </tr>";

			$no=1 + $mulai_dari;

			while($row = mysqli_fetch_assoc($result)){
				echo "<tr>
						<td class='number'>$no</td>
						<td class='left'>$row[nama_barang]</td>
						<td class='left'>$row[kategori]</td>
						<td class='middle'>".idr($row["harga"])."</td>
						<td class='middle'>$row[status]</td>
						<td class='middle'>
						<a class='tombol-action' href='".BASE_URL. "index.php?page=my-profile&module=barang&action=form&barang_id=$row[barang_id]'> Edit
					    </a>
					    <a style='margin-left: 5px' class='tombol-action' href='".BASE_URL. "module/barang/action.php?button=Delete&barang_id=$row[barang_id]'> Delete
					    </a>
						</td>
					</tr>";
				$no++;
			}
		echo "</table>";

		$queryHalaman	= "SELECT * FROM barang $where";
		$resultHalaman	= mysqli_query($links, $queryHalaman);

		pagination($resultHalaman, $data_per_halaman, $halaman, 'index.php?page=my-profile&module=barang&action=list&$search_url');
	}

 ?>