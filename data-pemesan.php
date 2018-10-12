 <?php 

 	if($user_id == false){
 		$_SESSION["proses_pesanan"] = true;

 		header("location: ". BASE_URL."login.html");
 		exit;
 	}
 	$notif			= isset($_GET['notif']) ? $_GET['notif'] : false;
 	$nama_penerima	= isset($_GET['nama_penerima']) ? $_GET['nama_penerima'] : false;
 	$nomor_telepon	= isset($_GET['nomor_telepon']) ? $_GET['nomor_telepon'] : false;
 	$alamat			= isset($_GET['alamat']) ? $_GET['alamat'] : false;

  ?>

 <div id="frame-data-pengiriman">
 	<h3 class="label-data"> Halaman Pengiriman Barang </h3>
 	<div id="frame-form-pengiriman">
 		<form action="<?= BASE_URL."proses-pemesanan.php";?>" method="POST">

 			<?php 

 				if($notif == 'token'){
 					echo "<div class='errors'>Maaf, token anda tidak cocok !</div>";
 				}elseif($notif == 'require'){
 					echo "<div class='errors'>Maaf, anda harus mengisi data dengan benar !</div>";
 				}elseif($notif == 'number'){
 					echo "<div class='errors'>Maaf, Nomor Telepon formatnya harus angka !</div>";
 				}

 			 ?>

			<div class="el-form">
				<label>Nama Penerima</label>	
				<span><input type="text" name="nama_penerima" value="<?= $nama_penerima;?>" ></span>
			</div>	

			<div class="el-form">
				<label>Nomor Telepon</label>	
				<span><input type="text" name="nomor_telepon" value="<?= $nomor_telepon;?>" ></span>
			</div>		

			<div class="el-form">
				<label>Alamat</label>	
				<span><textarea name="alamat" cols="30" rows="8"><?= $alamat;?></textarea></span>
			</div>	

			<input type="hidden" name="_token" value="<?=is_token();?>">

			<div class="el-form">
				<label>Kota</label>	
				<span>
					<select name="kota">
						<?php 
							$sql 	= "SELECT * FROM kota";
							$result	= mysqli_query($links, $sql);

							while($row = mysqli_fetch_assoc($result)){
								echo "<option value='$row[kota_id]'>$row[kota] (".idr($row["tarif"]).")</option>";

							}
						 ?>
					 </select>
				</span>
			</div>		
			  
			<div class="el-form">
				<span><input type="submit" name="submit" id="button" value="submit" class="submit-my-profile" /></span>
			</div>

 		</form>
 	</div>
 </div>

 <div id="frame-data-detail">
 	<h3 class="label-data">Detail Order</h3>

 	<div id="frame-detail-order">
 		<table class="table-list">
 			<tr>
 				<th>Nama Barang</th>
 				<th>Qty</th>
 				<th class="right">Total</th>
 			</tr>

 			<?php 

 				$subtotal = 0;

 				foreach ($keranjang as $key => $value) {
 					$barang_id = $key;

 					$nama_barang = $value['nama_barang'];
 					$harga		 = $value['harga'];
 					$quantity	 = $value['quantity'];

 					$total 		 = $quantity * $harga;
 					$subtotal 	 = $subtotal + $total;
 					echo "<tr>
 							<td class='left'>$nama_barang</td>
 							<td class='middle'>$quantity</td>
 							<td class='right'>".idr($total)."</td>
 						  </tr>";
 				}

 				echo "<tr>
						<td colspan='2' class='right'><b>Subtotal</b></td>
						<td class='right'><b>".idr($subtotal)."</b></td>
					 </tr>";

 			 ?>
 		</table>
 	</div>
 </div>