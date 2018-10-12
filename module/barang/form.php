<?php 

	$barang_id	= isset($_GET['barang_id']) ? $_GET['barang_id'] : false;

	$barang		= "";
	$kategori_id= "";
	$spesifikasi= "";
	$gambar 	= "";
	$stock		= "";
	$harga		= "";
	$status 	= "";
	$button		= "Add";
	$keteranganImg ="";

	if($barang_id){
		$query	=	"SELECT * FROM barang WHERE barang_id='$barang_id'";
		$result	= 	mysqli_query($links, $query);

		$row = mysqli_fetch_assoc($result);

		$barang 	= $row['nama_barang'];
		$spesifikasi= $row['spesifikasi'];
		$kategori_id= $row['kategori_id'];
		$stock 		= $row['stok'];
		$gambar 	= $row['gambar'];
		$harga 		= $row['harga'];
		$status 	= $row['status'];
		$button 	= "Update";

		$keteranganImg	= "(Klik choose file jika anda ingin mengganti gambar)";
		$gambar 		= "<img src='".BASE_URL."images/barang/$gambar' style='width: 200px;vertical-align: middle;'/>";
	}

 ?>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
 <script src="<?= BASE_URL.'js/tinymce/js/tinymce/tinymce.min.js'?>"></script>

<form action="<?= BASE_URL."module/barang/action.php?barang_id=$barang_id"?>" method="POST" enctype="multipart/form-data"> 

	
	<div class="el-form">
		<label for="barang"> Kategori </label>
		<span> <select name="kategori_id" id="barang">
			<?php 
				$query 	= "SELECT kategori_id, kategori FROM kategori WHERE status='on' ORDER BY kategori ASC";
				$result	= mysqli_query($links, $query);

				while($row 	= mysqli_fetch_assoc($result)){
					if($kategori_id == $row['kategori_id']){
						echo "<option value='$row[kategori_id]' selected='true'>$row[kategori]</option>";
					}else{
						echo "<option value='$row[kategori_id]'>$row[kategori]</option>";
					}
				}

				// var_dump($row); die();
			 ?>
		</select> </span>
	</div>

	<div class="el-form">
		<label for="barang"> Barang </label>
		<span> <input type="text" name="barang" id="barang" value='<?= $barang;?>'></span>
	</div>

		<label for="editor" style="font-weight: bold;"> Spesifikasi </label>
		<span><textarea name="spesifikasi" id="editor" cols="30" rows="10" style="margin-bottom: 10px;"><?= $spesifikasi; ?></textarea></span>

	<div class="el-form">
		<label for="stock" style="margin-top: 20px;"> Stock Barang </label>
		<span> <input type="text" name="stock" id="stock" value='<?= $stock;?>'></span>
	</div>

	<div class="el-form">
		<label for="harga"> Harga </label>
		<span> <input type="text" name="harga" id="harga" value='<?= $harga;?>'></span>
	</div>

	<div class="el-form">
		<label for="gambar"> Gambar <?=$keteranganImg;?> </label>
		<span> <input type="file" name="file" id="gambar"><?= $gambar;?></span>
	</div>

	<div class="el-form"> 
		<label for="status"> Status </label>
		<span>
			<input type="radio" name="status" value="on" <?php if($status == 'on'){ echo "checked == 'true'";}?>> On 
			<input type="radio" name="status" value="off" <?php if($status == 'off'){ echo "checked == 'true'";}?>> Off
		</span>
	</div>

	<input type="hidden" name="_token" value="<?= is_token();?>">

	<div class="el-form">
		<input type="submit" name="button" value="<?=$button?>" id="button">
	</div>

</form>


<script>
	tinymce.init({
		selector: '#editor',
		toolbar: 'jbimages link image code codesample preview bold italic underline backcolor alignleft aligncenter alignright alignjustify bullist numlist outdent indent removeformat',
		plugins: 'link image code codesample jbimages preview lists',
  		relative_urls: false,
	});
</script>