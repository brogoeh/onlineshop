<?php 

	$kategori_id	= isset($_GET['kategori_id']) ? $_GET['kategori_id'] : false;

	$kategori		= "";
	$status 		= "";
	$button			= "Add";

	if($kategori_id){
		$query	=	"SELECT * FROM kategori WHERE kategori_id='$kategori_id'";
		$result	= 	mysqli_query($links, $query);

		$row = mysqli_fetch_assoc($result);

		$kategori 	= $row['kategori'];
		$status 	= $row['status'];
		$button 	= "Update";
	}

 ?>




<form action="<?= BASE_URL."module/kategori/action.php?kategori_id=$kategori_id"?>" method="POST"> 

	
	<div class="el-form">
		<label for="kategori"> Kategori </label>
		<span> <input type="text" name="kategori" id="kategori" value='<?= $kategori;?>'></span>
	</div>

	<div class="el-form">
		<label for="username"> Status </label>
		<span>
			<input type="radio" name="status" value="on" <?php if($status == 'on'){ echo "checked == 'true'";}?>> On 
			<input type="radio" name="status" value="off" <?php if($status == 'off'){ echo "checked == 'true'";}?>> Off
		</span>
	</div>

	<input type="hidden" name="_token" value="<?= is_token();?>">

	<div class="el-form">
		<input type="submit" name="button" value="<?=$button?>" id="button">
	</div>