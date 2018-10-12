<div id="frame-tambah">
	<a href="<?= BASE_URL. 'index.php?page=my-profile&module=kategori&action=form'?>" class="tombol-action"> + Tambah Kategori </a>
</div>

<?php 
	
	$halaman = isset($_GET['halaman']) ? $_GET['halaman'] : 1;
	$data_per_halaman = 10;
	$mulai_dari = ($halaman - 1) * $data_per_halaman;

	$query	= "SELECT * FROM kategori LIMIT $mulai_dari, $data_per_halaman ";
	$result	= mysqli_query($links, $query);

	if(mysqli_num_rows($result) == 0 ){
		echo "<h3>Data Nihil</h3>";
	}else{
		echo "<table class='table-list'>";
		echo "<tr class='baris-title'>
				<th class='number'>No</th>
				<th class='left'>Kategori</th>
				<th class='middle'>Status</th>
				<th class='middle'>Action</th>
			 </tr>";

			$no=1 + $mulai_dari;

			while($row = mysqli_fetch_assoc($result)){
				echo "<tr>
						<td class='number'>$no</td>
						<td class='left'>$row[kategori]</td>
						<td class='middle'>$row[status]</td>
						<td class='middle'>
						<a class='tombol-action' href='".BASE_URL. "index.php?page=my_profile&module=kategori&action=form&kategori_id=$row[kategori_id]'> Edit </a>
						<a style='margin-left: 5px' class='tombol-action' href='".BASE_URL. "module/kategori/action.php?button=Delete&kategori_id=$row[kategori_id]'> Delete </a>
						</td>
					</tr>";
				$no++;
			}
		echo "</table>";

		$queryHalaman	= "SELECT * FROM kategori";
		$resultHalaman	= mysqli_query($links, $queryHalaman);

		pagination($resultHalaman, $data_per_halaman, $halaman, 'index.php?page=my-profile&module=kategori&action=list');
	}

 ?>