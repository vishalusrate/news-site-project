<?php
include('config.php');

$post_id= $_GET['id'];
$catid = $_GET['catid'];

$sql1 ="select * from post where post_id='{$post_id}'";
$result= mysqli_query($conn,$sql1);
$row = mysqli_fetch_assoc($result);

unlink("upload/".$row['post_img']);

	
$sql ="delete from post where post_id='{$post_id}';";
$sql .="update category set post=(post-1)where category_id='{$catid}'";
$result = mysqli_multi_query($conn,$sql);
if($result){
	header("location: $hostname/admin/post.php");
}else{
	echo "wrong path please select right path";
}


?>