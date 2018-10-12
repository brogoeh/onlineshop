<?php 
	
	$pesanan_id = $_GET['pesanan_id'];

 ?>

 <div class="table-list">
 	<form action="<?= BASE_URL."module/pesanan/action.php?pesanan_id=$pesanan_id"?>" method="POST">
 		<div class="el-form">
 			<label for="">No Rekening</label>
 			<span><input type="text" name="nomor_rekening"></span>
 		</div>
 		<div class="el-form">
 			<label for="">Nama Account</label>
 			<span><input type="text" name="nama_account"></span>
 		</div>
 		<div class="el-form">
 			<label for="">Tanggal Transfer (Format : yyyy-mm-dd)</label>
 			<span><input type="text" name="tanggal_transfer"></span>
 		</div>
 		<div class="el-form">
 			<input type="submit" name="button" value="Konfirmasi" id="button">
 		</div>
 	</form>
 </div>