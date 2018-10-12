<?php 

	$pesanan_id = $_GET['pesanan_id'];

	$query = mysqli_query($links, "SELECT status FROM pesanan WHERE pesanan_id='$pesanan_id'");
	$row   = mysqli_fetch_assoc($query);

	$status = $row['status'];

?>

<form action="<?= BASE_URL."module/pesanan/action.php?pesanan_id=$pesanan_id";?>" method="POST">
	
	<div class="el-form">
		<label for="">Pesanan ID (Faktur ID)</label>
		<span><input type="text" name="no_faktur" value="<?= $pesanan_id;?>" readonly="true"></span>
	</div>

	<div class="el-form">
		<label for="">Pesanan ID (Faktur ID)</label>
		<span>
			<select name="status" id="">
				<?php foreach ($arrayStatusPesanan as $key => $value): 
					if($status == $key){
						echo "<option value='$key' selected='true'>$value</option>"; 
					}else{
						echo "<option value='$key'>$value</option>"; 
					}
				endforeach; ?>
			</select>
		</span>
	</div>

	<div class="el-form">
		<span><input type="submit" name="button" value="Edit Status" id="button"></span>
	</div>

</form>