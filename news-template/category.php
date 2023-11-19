<?php include 'header.php'; ?>
    <div id="main-content">
      <div class="container">
        <div class="row">
            <div class="col-md-8">
                <!-- post-container -->
                <div class="post-container">
				<?php
				include 'config.php';
				if(isset($_GET['cid'])){
				$cat_id=$_GET['cid'];
				}
				
				 $sql1 = "SELECT * FROM category where category_id={$cat_id}";
					  $result1 = mysqli_query($conn,$sql1);
					  $row1=mysqli_fetch_assoc($result1);
			  
				?>
				<h2 class="page-heading"><?php echo $row1['category_name'];  ?> News</h2>
				<?php
			  
				
				 $limit =3;
			
				 if(isset($_GET['page'])){
					$page =$_GET['page'];
				 }else{
					 $page=1;
				 }
				 $offset = ($page-1)* $limit;
				 
				 
				 $sql = "select * from post 
				left join category on post.category=category.category_id
				left join user on post.author=user.user_id
				where post.category={$cat_id}
				order by post_id desc LIMIT $offset,$limit";		
				$result = mysqli_query($conn,$sql);
				if(mysqli_num_rows($result)){
					while($row = mysqli_fetch_assoc($result)){
			
			  ?>
                        <div class="post-content">
                            <div class="row">
                                <div class="col-md-4">
                                    <a class="post-img" href="single.php?cid=<?php echo $row['post_id']; ?>"><img src="admin/upload/<?php echo $row['post_img']; ?>" alt=""/></a>
                                </div>
                                <div class="col-md-8">
                                    <div class="inner-content clearfix">
                                        <h3><a href="single.php?cid=<?php echo $row['post_id']; ?>"><?php echo $row['title']; ?></a></h3>
                                        <div class="post-information">
                                            <span>
                                                <i class="fa fa-tags" aria-hidden="true"></i>
                                                <a href='category.php?cid=<?php echo $row['category']; ?>'><?php echo $row['category_name'];?></a>
                                            </span>
                                            <span>
                                                <i class="fa fa-user" aria-hidden="true"></i>
                                                <a href='author.php?aid=<?php echo $row['author']; ?>'><?php echo $row['username'];?></a>
                                            </span>
                                            <span>
                                                <i class="fa fa-calendar" aria-hidden="true"></i>
                                                <?php echo $row['post_date'];?>
                                            </span>
                                        </div>
                                        <p class="description">
                                            <?php echo substr($row['description'],0,150);?>
											</p>
                                        <a class='read-more pull-right' href="single.php?cid=<?php echo $row['post_id']; ?>">read more</a>
                                    </div>
                                </div>
                            
                            </div>
                        </div>
						<?php
				}
				}else{
					echo "no recordfound";
				}
				
				 if(mysqli_num_rows($result1) > 0){
						 $total_record =  $row1['post'];
						
						 $total =ceil($total_record / $limit);
						 
					  echo "<ul class='pagination admin-pagination'>";
					  if($page > 1){
					  echo '<li><a href="category.php?cid='.$cat_id.'& page='.($page-1).'">PREV</a></li>';
					  }
					  
						 for($i=1;$i<$total; $i++){
							 if($i == $page){
                          $active = "active";
                        }else{
                          $active = "";
                        }
							echo "<li class='{$active}'><a href='category.php?cid='.$cat_id.'&page=$i'>$i</a></li>";
							 
						 }
					 
						 if($total > $page){
				echo '<li class="{$active}"><a href="category.php?cid='.$cat_id.'&page='.($page+1).'">NEXT</a></li>';
					  }
						  					  

						 echo "</ul>";
					  }
					  
						?>
                </div><!-- /post-container -->
            </div>
            <?php include 'sidebar.php'; ?>
        </div>
      </div>
    </div>
<?php include 'footer.php'; ?>
