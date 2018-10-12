<?php 

	if($username){
		header("location: " .BASE_URL);
	}

 ?>

<span class="is_title"> register user </span>
<div id="register-user">
	

	<form action="<?= BASE_URL .'register-user.php'?>" method="POST">


	<?php 

		$notif		= isset($_GET['notif']) ? $_GET['notif'] : false;
		$username	= isset($_GET['username']) ? $_GET['username'] : false;
		$email		= isset($_GET['email']) ? $_GET['email'] : false;
		$alamat		= isset($_GET['alamat']) ? $_GET['alamat'] : false;
		$phone		= isset($_GET['phone']) ? $_GET['phone'] : false;

		if ($notif == 'require') {
			echo "<div class='errors'>Maaf, anda harus melengkapi data dengan benar !</div>";
		}elseif ($notif == 'email') {
			echo "<div class='errors'>Maaf, email sudah terdaftar !</div>";
		}elseif ($notif == 're_password') {
			echo "<div class='errors'>Maaf, password yang anda masukkan tidak sama !</div>";
		}elseif ($notif == 'password') {
			echo "<div class='errors'>Maaf, password minimal harus 6 karakter !</div>";
		}elseif ($notif == 'username') {
			echo "<div class='errors'>Maaf, username minimal harus 3 karakter !</div>";
		}
	 ?>

		<div class="el-form">
			<label for="username"> Username </label>
			<span> <input type="text" name="username" id="username" value="<?= $username ?>"></span>
		</div>

		<div class="el-form">
			<label for="email"> Email </label>
			<span> <input type="text" name="email" id="email" value="<?= $email ?>" ></span>
		</div>

		<div class="el-form">
			<label for="phone"> No.Telepon/Hp </label>
			<span> <input type="text" name="phone" id="phone" value="<?= $phone ?>"></span>
		</div>

		<div class="el-form">
			<label for="alamat"> Alamat </label>
			<textarea name="alamat" id="alamat" cols="30" rows="10"><?= $alamat ?></textarea>
		</div>

		<div class="el-form">
			<label for="password"> Password </label>
			<span> <input type="password" name="password" id="password" ></span>
		</div>

		<div class="el-form">
			<label for="re-password"> Re-type Password </label>
			<span> <input type="password" name="re_password" id="re-password" ></span>
		</div>
<!-- 
		<div class="el-form">
			<label for="provinsi"> Province </label>
			<select name="provinsi" id="provinsi" required>
				<option value="0">Choose Province</option>
				<option value="1">Jakarta</option>
				<option value="2">Bekasi</option>
				<option value="3">Surabaya</option>
				<option value="4">Bandung</option>
			</select>
		</div> -->

		<!-- <div class="el-form">
			<label for="username"> Jenis kelamin </label>
			<input type="radio" name="gender" value="laki" checked="laki"> Laki-laki 
			<input type="radio" name="gender" value="perempuan"> Perempuan
		</div> -->

		<input type="hidden" name="_token" value="<?= is_token();?>">
		
		<div class="el-form">
			<span>Dengan menekan tombol register, anda setuju dengan <a href="" style="text-decoration: underline; color: white;">ketentuan dan syarat</a> yang berlaku </span>
		</div>

		<div class="el-form">
			<input type="submit" name="submit" value="Register">
		</div>
		
	</form>

</div>