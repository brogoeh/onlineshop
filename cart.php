<?php 

	if($total_barang == 0){
		echo "<h3> Maaf, saat ini keranjang belanja anda kosong </h3>";
	}else{
		$no = 1;

		echo "<table class='table-list'>
				<tr class='baris-title'>
					<th class='middle'>No</th>
					<th class='left'>Gambar</th>
					<th class='left'>Nama Barang</th>
					<th class='middle'>Qty</th>
					<th class='right'>Harga Satuan</th>
					<th class='middle'>Total</th>
				</tr>";
		$subtotal = 0;
		foreach ($keranjang as $key => $value) {
			$barang_id	= $key;

			$nama_barang	= $value['nama_barang'];
			$gambar 		= $value['gambar'];
			$harga 			= $value['harga'];
			$quantity		= $value['quantity'];

			$total 	= $quantity * $harga;
			$subtotal = $subtotal + $total;

			echo "<tr>
					<td class='middle'>$no</td>
					<td class='left'><img src='".BASE_URL."images/barang/$gambar' height='100px'></td>
					<td class='left'>$nama_barang</td>
					<td class='middle'><input type='text' name='$barang_id' value='$quantity' class='update-qty'></td>
					<td class='right'>".idr($harga)."</td>
					<td class='middle delete_item'>".idr($total)."<a href='". BASE_URL."hapus-item.php?barang_id=$barang_id'> X </a></td>
				 </tr>";

				 $no++;
		}

		echo "<tr>
				<td colspan='5' class='right'><b>Subtotal</b></td>
				<td class='right'><b>".idr($subtotal)."</b></td>
			 </tr>";

		echo "</table>";

		echo "<div id='frame-btn-cart'>
				<a id='lanjut-belanja' href='". BASE_URL. "index.php'> < Lanjut Belanja </a>
				<a id='lanjut-pemesanan' href='".BASE_URL."data-pemesan.html'> Lanjut Pemesanan > </a>
			  </div>";

	}

 ?>

 <script>
 	$(function(){
 		$(".update-qty").on('input', function(){
 			var barang_id = $(this).attr("name");
 			var value	  = $(this).val();
 			

 		$.ajax({
 			method: "POST",
 			url   : "update-keranjang.php",
 			data  : "barang_id="+barang_id+"&value="+value
 		})
 		
 			.done(function(data){
				location.reload(); 				
 			});
 		});
 	});
 </script>