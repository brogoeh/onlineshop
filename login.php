<?php 

	if($username){
		header("location: " .BASE_URL);
	}

 ?>

<span class="is_title"> Login user </span>
<div id="register-user">
	
	<form action="<?= BASE_URL .'login-user.php'?>" method="POST">

		<?php 

		$notif		= isset($_GET['notif']) ? $_GET['notif'] : false;
		// $username	= isset($_GET['username']) ? $_GET['username'] : false;


		if ($notif == 'true') {
			echo "<div class='errors'>Maaf, username dan password wajib diisi !</div>";
		}elseif ($notif == 'username') {
			echo "<div class='errors'>Maaf, username belum terdaftar !</div>";
		}elseif ($notif == 'password') {
			echo "<div class='errors'>Maaf, kombinasi username dan password salah !</div>";
		}elseif ($notif == 'token') {
			echo "<div class='errors'>Maaf, token tidak cocok !</div>";
		}

		 ?>

		<div class="el-form">
			<label for="username"> Username </label>
			<span> <input type="text" name="username" id="username"></span>
		</div>

		<div class="el-form">
			<label for="password"> Password </label>
			<span> <input type="password" name="password" id="password"></span>
		</div>

		<div class="el-form">
			<label for="remember"> Remember Me </label>
			<span> <input type="checkbox" name="remember" id="remember"></span>
		</div>

		<input type="hidden" name="_token" value="<?= is_token();?>">
		 
		 <span> Belum punya akun silahkan <a href="<?= BASE_URL. 'register.html'?>"> daftar </a> disini.</span>
		<div class="el-form">
			<input type="submit" name="submit" value="Login">
		</div>
		
	</form>

</div>