<?php include 'header.php'; 
error_reporting(0);?>
    <div id="main-content">
      <div class="container">
        <div class="row">
            <div class="col-md-8">
                <!-- post-container -->
                <?php
				include 'config.php';
				if(isset($_GET['search'])){
				$search_term=$_GET['search'];
				}
				?>
				 <h2 class="page-heading">Search: <?php echo $search_term;  ?></h2>
				<?php
				include "config.php";
				
				$search_term=$_GET['search'];
				
				$limit =3;
			
				 if(isset($_GET['page'])){
					$page =$_GET['page'];
				 }else{
					 $page=1;
				 }
				 $offset = ($page-1)* $limit;
				 
				$sql = "select * from post left join user on post.author = user.user_id
                left join category on post.category = category.category_id 
				where post.title like '%$search_term%' or post.description like '%$search_term%'
				order by post_id desc LIMIT $offset,$limit";
				$result=mysqli_query($conn,$sql);
				if(mysqli_num_rows($result)>0){
					while($row=mysqli_fetch_assoc($result)){
				
				?>
                 
                    <div class="post-content">
                        <div class="row">
                            <div class="col-md-4">
                                <a class="post-img" href="single.php?cid=<?php echo $row['post_id']; ?>"><img src="admin/upload/<?php echo $row['post_img']; ?>" alt=""/></a>
                            </div>
                            <div class="col-md-8">
                                <div class="inner-content clearfix">
                                    <h3><a href='single.php?cid=<?php echo $row['post_id']; ?>'> <?php echo $row['title']; ?></a></h3>
                                    <div class="post-information">
                                        <span>
                                            <i class="fa fa-tags" aria-hidden="true"></i>
                                            <a href='category.php?cid=<?php echo $row['category']; ?>'><?php echo $row['category_name']; ?></a>
                                        </span>
                                        <span>
                                            <i class="fa fa-user" aria-hidden="true"></i>
                                            <a href='author.php'><?php echo $row['username']; ?></a>
                                        </span>
                                        <span>
                                            <i class="fa fa-calendar" aria-hidden="true"></i>
                                            <?php echo $row['post_date']; ?>
                                        </span>
                                    </div>
                                    <p class="description">
                                       <?php echo substr($row['description'],0,180); ?> </p>
                                    <a class='read-more pull-right' href='single.php?cid=<?php echo $row['post_id'];  ?>'>read more</a>
                                </div>
                            </div>
                        </div>
                    </div>
                 <?php  } }
else{
					echo "no recordfound";
				}				 ?>
                  
                    <?php
				
	
				
				 $sql1 = "SELECT * FROM post
          				 where post.author={$search_term}";
					  $result1 = mysqli_query($conn,$sql1);
					if(mysqli_num_rows($result1) > 0){
						 $total_record =mysqli_num_rows($result1);
						
						 $total =ceil($total_record / $limit);
						 
					  echo "<ul class='pagination admin-pagination'>";
					  if($page > 1){
					  echo '<li><a href="author.php?search='.$search_term.'& page='.($page-1).'">PREV</a></li>';
					  }
					  
						 for($i=1;$i<$total; $i++){
							 if($i == $page){
                          $active = "active";
                        }else{
                          $active = "";
                        }
							echo "<li class='{$active}'><a href='author.php?search='.$search_term.'&page=$i'>$i</a></li>";
							 
						 }
					 
						 if($total > $page){
				echo '<li class="{$active}"><a href="author.php?search='.$search_term.'&page='.($page+1).'">NEXT</a></li>';
					  }
						  					  

						 echo "</ul>";
					  }
					  
						?>
                </div><!-- /post-container -->
           
            <?php include 'sidebar.php'; ?>
        </div>
      </div>
    </div>
<?php include 'footer.php'; ?>
