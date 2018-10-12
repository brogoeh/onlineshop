<div id="frame-tambah">
	<a class="tombol-action" href="<?php echo BASE_URL."index.php?page=my_profile&module=kota&action=form"; ?>">+ Tambah Kota</a>
</div>

<?php

	$queryKota = mysqli_query($links, "SELECT * FROM kota ORDER BY kota ASC");
	
	if(mysqli_num_rows($queryKota) == 0){
		echo "<h3>Saat ini belum ada nama kota yang didalam database.</h3>";
	}
	else{
		echo "<table class='table-list'>";
		
			echo "<tr class='baris-title'>
					<th class='number'>No</th>
					<th class='left'>Kota</th>
					<th class='left'>Tarif</th>
					<th class='middle'>Status</th>
					<th class='middle'>Action</th>
				 </tr>";
				 
			$no = 1;
			while($rowKota=mysqli_fetch_assoc($queryKota)){
				echo "<tr>
						<td class='number'>$no</td>
						<td>$rowKota[kota]</td>
						<td>".idr($rowKota['tarif'])."</td>
						<td class='middle'>$rowKota[status]</td>
						<td class='middle'>
							<a class='tombol-action' href='".BASE_URL."index.php?page=my-profile&module=kota&action=form&kota_id=$rowKota[kota_id]"."'>Edit</a>
						</td>
					 </tr>";
				
				$no++;
			}
		
		echo "</table>";
	}
?>