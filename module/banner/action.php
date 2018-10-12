<?php
    include("../../function/database.php");
    include("../../function/helper.php");

    admin_only("banner", $level);

    $barang_id = $_GET['banner_id'];

    $sql    = mysqli_query($links, "SELECT * FROM banner WHERE banner_id='$banner_id'");
    $result = mysqli_fetch_assoc($sql);

    $banner = $_POST['banner'];
    $link = $_POST['link'];
    $status = $_POST['status'];
    $button = $_POST['button'];
    $updateImg  ="";

    // mengubah fileName gambar
    $arrayImg   = array('.jpeg', '.png', '.jpg');
    $time       = time();
    $tmpImg     = $_FILES['file']['tmp_name'];
    $fileName   = str_replace($arrayImg, '', $_FILES['file']['name']);
    $filename   = $fileName. '_'. $time. '.jpg';
	
 
    if(!empty($_FILES['file']['name'])){
        $fileImg        = $filename;
        unlink("../../images/slides/".$result['gambar']);
        move_uploaded_file($tmpImg, "../../images/slides/".$fileImg);

        $updateImg  = ", gambar='$fileImg'";
    }
     
    if($button == "Add")
    {
        mysqli_query($links, "INSERT INTO banner (banner, link, gambar, status) VALUES ('$banner', '$link', '$fileImg', '$status')");
    }
    elseif($button == "Update")
    {
	    $banner_id = $_GET['banner_id'];
		
        mysqli_query($links, "UPDATE banner SET banner='$banner',
                                        link='$link',
                                        $edit_gambar
                                        status='$status'
										$updateImg WHERE banner_id='$banner_id'");
    }
     
     
    header("location: ".BASE_URL."index.php?page=my-profile&module=banner&action=list");
?>