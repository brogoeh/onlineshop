<?php 

	require_once 'function/database.php';
	require_once 'function/helper.php';

	$page			= isset($_GET['page']) ? $_GET['page'] : false;
	$kategori_id 	= isset($_GET['kategori_id']) ? $_GET['kategori_id'] : false;

	$user_id		= isset($_SESSION['user_id']) ? $_SESSION['user_id'] : false;
	$username		= isset($_SESSION['username']) ? $_SESSION['username'] : false;
	$level			= isset($_SESSION['level']) ? $_SESSION['level'] : false;
	$keranjang		= isset($_SESSION['keranjang']) ? $_SESSION['keranjang'] : array();	
	$total_barang	= count($keranjang);

?>

<!DOCTYPE html>		
<html>
	<head>
		<title> Olshop </title>
		<!-- css -->
		<link rel="stylesheet" href="<?= BASE_URL. "css/style.css";?>" type="text/css">
		<link rel="stylesheet" href="<?= BASE_URL. "css/banner.css";?>" type="text/css">

		<!-- javascript -->
		<script src="<?= BASE_URL."js/jquery-3.3.1.min.js";?>"></script>
		<script src="<?= BASE_URL."js/Slides-SlidesJS-3/source/jquery.slides.min.js";?>"></script>

		
	</head>
	<body>
		<div wrapper>
			
			<div id="header">
				<a href="<?= BASE_URL. 'index.php'?>">
					<img src="<?=BASE_URL. 'images/logo.png'?>" alt="" /> <! logo >
				</a>

				<div id="menu">
					<div id="user">
						<?php 
							if($username) :
						 ?>
						<?php echo "Hi <strong> $username, </strong> "; ?><a href="<?= BASE_URL . 'index.php?page=my-profile&module=pesanan&action=list'?>>" style="text-decoration: underline;"> My Profile </a>
						<a href="<?= BASE_URL . 'logout.html'?>"> Logout </a>
						<?php else :?> 
						<a href="<?= BASE_URL . 'register.html'?>"> Register </a> | 
						<a href="<?= BASE_URL . 'login.html'?>"> Login </a>
						<?php endif; ?>
					</div>

					<a href="<?= BASE_URL. 'cart.html'?>" id="button-cart">
						<img src="<?= BASE_URL.'images/cart.png'?>" title="cart" alt="" /> <! logo >
						<?php 	

							if($total_barang != 0){
								echo "<span class='total-barang'>$total_barang</span>";
							}

						 ?>
					</a>
				</div>
			</div>

			<div class="content">
				
				<?php

					$filename	= "$page.php";

					if(file_exists($filename)){
						include_once ($filename);
					}else{
						include_once ('main.php');
					}

				 ?>

			</div>

			<div id="footer">
				<span> brogoeh &copy; 2017-2018. All rights Reserved </span>
			</div>

		</div>

		<script>
			$(function() {
				$('#slides').slidesjs({
					height: 350,
					play: { auto: true,
							interval: 3000,
						  },
					navigation: false
				});
			});
		</script>
	</body>
</html>