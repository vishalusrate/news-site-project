<!DOCTYPE html>
<?php
include "config.php";

switch(basename($_SERVER['PHP_SELF'])){
case "single.php":
if(isset($_GET['cid'])){
$sql = "select * from post where post_id = {$_GET['cid']}";
$result= mysqli_query($conn,$sql) or die("query failed: home title");
$row=mysqli_fetch_assoc($result);
$page_title=$row['title']." News";
}else{
	$page_title="no result fount";
}
break;
case "category.php":
if(isset($_GET['cid'])){
$sql = "select * from category where category_id = {$_GET['cid']}";
$result= mysqli_query($conn,$sql) or die("query failed: home title");
$row=mysqli_fetch_assoc($result);
$page_title=$row['category_name']." News";;
}else{
	$page_title="no category fount";
}
break;
	case "author.php":
if(isset($_GET['aid'])){
$sql = "select * from user where user_id = {$_GET['aid']}";
$result= mysqli_query($conn,$sql) or die("query failed: home title");
$row=mysqli_fetch_assoc($result);
$page_title="News by  ".$row['first_name']."&".$row['last_name'];
}else{
	$page_title="no author fount";
}
break;
case "search.php":
if(isset($_GET['search'])){
	$page_title=$_GET['search'];
}else{
$page_title="no search found";
}
break;
default:
$page_title="xyz news";
break;
}
?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title><?php echo $page_title; ?></title>
    <!-- Bootstrap -->
    <link rel="stylesheet" href="css/bootstrap.min.css" />
    <!-- Font Awesome Icon -->
    <link rel="stylesheet" href="css/font-awesome.css">
    <!-- Custom stlylesheet -->
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
<!-- HEADER -->
<div id="header">
    <!-- container -->
    <div class="container">
        <!-- row -->
        <div class="row">
            <!-- LOGO -->
            <div class=" col-md-offset-4 col-md-4">
			<?php
				
				include "config.php";
				$sql1 ="select * from setting";
				$result1 =mysqli_query($conn,$sql1);
				if(mysqli_num_rows($result1)>0){
					while($row1=mysqli_fetch_assoc($result1)){
						if($row1['weblobo']==""){
							echo '<a href="index.php" >'.$row1['weblobo'].'</a>';
						}else{
							echo '<a href="index.php" id="logo"><img src="admin/images/'.$row1['weblobo'].'"></a>';
						}
				}
				}
						
				?>
                
            </div>
            <!-- /LOGO -->
        </div>
    </div>
</div>
<!-- /HEADER -->
<!-- Menu Bar -->
<div id="menu-bar">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
			<?php
			include 'config.php';
			if(isset($_GET['cid'])){
				$cat_id=$_GET['cid'];
			}
			$sql ="select * from category where post > 0";
			$results =mysqli_query($conn,$sql);
			if(mysqli_num_rows($results)>0){
				 $active="";
			?>
		
               <ul class='menu'>
			   <li><a class='{$active}'href='<?php echo $hostname; ?>'>HOME</a></li>
			   <?php while($row=mysqli_fetch_assoc($results)){ 
			 if(isset($_GET['cid'])){
				if($row['category_id']==$cat_id){
				  $active="active"; 
			   }else{
			     $active="";
			   }
			}

                 echo "<li><a class='{$active}'href='category.php?cid={$row['category_id']}'>{$row['category_name']}</a></li>";
                    }
               echo "</ul>";
			}				
?>
					<!-- <li><a href='category.php'>Entertainment</a></li>
                    <li><a href='category.php'>Sports</a></li>
                    <li><a href='category.php'>Politics</a></li>-->
            </div>
        </div>
    </div>
</div>
<!-- /Menu Bar -->
