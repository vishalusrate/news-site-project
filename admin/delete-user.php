<?php
include 'header.php';
include 'config.php';
include 'config.php';
session_start();
if( $_SESSION['user_role'] == 0){
  header("Location: {$hostname}/admin/post.php");
}
$userid= $_GET['id'];

$sql = "delete from user where user_id = '$userid'";

if(mysqli_query($conn,$sql)){
header("location: $hostname/admin/users.php");
}


?>