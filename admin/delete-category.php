<?php
include "config.php";
 $id= $_GET['id'];
 
 $sql="delete from category where category_id='$id'";
 $result=mysqli_query($conn,$sql);
 header("location: $hostname/admin/category.php");

?>