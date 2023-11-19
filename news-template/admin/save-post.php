<?php
include 'config.php';

if(isset($_FILES['fileToUpload'])){
	$error = array();
	
	$file_name =$_FILES['fileToUpload']['name'];
	$file_size =$_FILES['fileToUpload']['size'];
	$tmp_name =$_FILES['fileToUpload']['tmp_name'];
	$file_type =$_FILES['fileToUpload']['type'];
	$file_exten =end(explode('.',$file_name));
	$extension=array("jpg","jpeg","png");
	
	
	if(in_array($file_exten,$extension===false)){
		$error[] = "file upload is failed plz select format of file jpg ,jpeg,png";
	}
	if($file_size > 2097152){
		$error[]="plz select the 2mb lower file..";
	}
	$new_name = time()."-".$file_name;
	$target="upload/".$new_name;
	$change_name=$new_name;
	
	if(empty($error)==true){
		move_uploaded_file($tmp_name,$target);
	}else{
		print_r($error);
		die();
	}
	
}
session_start();
$title = mysqli_real_escape_string($conn,$_POST["post_title"]);
$desc = mysqli_real_escape_string($conn,$_POST["postdesc"]);
$category = mysqli_real_escape_string($conn,$_POST["category"]);
$date = date('d M,Y');
$author = $_SESSION['user_id'];

$sql = "insert into post(title,description,category,post_date,author,post_img)
        values('$title','$desc',$category,'$date',$author,'$change_name');";
$sql.="update category set post=post+1 where category_id=$category";

if(mysqli_multi_query($conn,$sql)){
	
	 header("location: $hostname/admin/post.php");
}
else{
	echo "<div class='alert alert-danger'>not saved...</div>";
}




?>