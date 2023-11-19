<?php
include 'config.php';
if(empty($_FILES['new-image']['name'])){
	$change_name=$_POST['old_logo'];
}else{
	$error = array();
	
	$file_name =$_FILES['new-image']['name'];
	$file_size =$_FILES['new-image']['size'];
	$tmp_name =$_FILES['new-image']['tmp_name'];
	$file_type =$_FILES['new-image']['type'];
	$file_exten =end(explode('.',$file_name));
	$extension=array("jpg","jpeg","png");
	
	
	if(in_array($file_exten,$extension===false)){
		$error[] = "file upload is failed plz select format of file jpg ,jpeg,png";
	}
	if($file_size > 2097152){
		$error[]="plz select the 2mb lower file..";
	}
	$new_name=time()."-".$file_name;
	$target="upload/".$new_name;
	$change_name=$new_name;
	if(empty($error)==true){
		move_uploaded_file($tmp_name,$target);
	}else{
		print_r($error);
		die();
	}
	
}

$sql="update post set title='{$_POST['post_title']}',description='{$_POST['postdesc']}',category={$_POST['category']},post_img='{$change_name}' where post_id='{$_POST['post_id']}';";
if($_POST['old-category']!=$_POST['category']){
$sql.="update category set post=post-1 where category_id={$_POST['old-category']};";
$sql.="update category set post=post+1 where category_id={$_POST['category']};";
}

$result = mysqli_multi_query($conn,$sql);
if($result){
header("location:{$hostname}/admin/post.php");
}else{
	echo "data not updated...";
	
}



?>