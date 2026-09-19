<?php
include "config.php";
if(empty($_FILES['logo']['name'])){
	$file_name=$_POST['old-image'];
}else{
	$error = array();
	
	$file_name=$_FILES['logo']['name'];
	$file_size=$_FILES['logo']['size'];
	$file_tmp=$_FILES['logo']['tmp_name'];
	$file_type=$_FILES['logo']['type'];
	$fle_exe=explode('.',$file_name);
	$file_exten=end($fle_exe);
	$file_ext=array("jpeg","png","jpg","bmp");
	
	if(in_array($file_exten,$file_ext)===false){
	$error[]="plsease upload valid format like jpeg,jpg,png";
	}
	if($file_size>2097152){
	  $error[]="plsease upload small size image like 2mb";
	}
	if(empty($error)==true){
		move_uploaded_file("$file_tmp","images/$file_name");
	}else{
		print_r($error);
		die();
	}
	
}

$sql = "update setting set webname='{$_POST['website_name']}', weblobo='{$file_name}',footerdiscri='{$_POST['footer_desc']}'";

$result = mysqli_query($conn,$sql);
if($result){
header("location:{$hostname}/admin/settings.php");
}else{
	echo "data not updated...";
	
}
?>