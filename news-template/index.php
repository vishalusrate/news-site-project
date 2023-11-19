<?php include 'header.php'; ?>
    <div id="main-content">
        <div class="container">
            <div class="row">
                <div class="col-md-8">
                    <!-- post-container -->
                    <div class="post-container">
					<?php
			  
			  	include "config.php";
				
				 $limit =9;
			
				 if(isset($_GET['page'])){
					$page =$_GET['page'];
				 }else{
					 $page=1;
				 }
				 $offset = ($page-1)* $limit;
				 
				 
				 $sql = "select * from post 
				left join category on post.category=category.category_id
				left join user on post.author=user.user_id
				order by post_id desc LIMIT $offset,$limit";		
				$result = mysqli_query($conn,$sql);
				if(mysqli_num_rows($result)){
					while($row = mysqli_fetch_assoc($result)){
			
			  ?>
                        <div class="post-content">
						
                            <div class="row">
                                <div class="col-md-4">
                                    <a class="post-img" href="single.php?id=<?php echo $row['post_id']; ?>"><img src="admin/upload/<?php echo $row['post_img']; ?>" alt=""/></a>
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
                                                <a href='author.php?aid=<?php echo $row['user_id'];  ?>'><?php echo $row['username'];?></a>
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
				}
				
				$sql1 = "SELECT * FROM post";
					  $result1 = mysqli_query($conn,$sql1);
					  echo "<ul class='pagination admin-pagination'>";
					  if($page > 1){
					  echo '<li><a href="index.php?page='.($page-1).'">PREV</a></li>';
					  }
					  if(mysqli_num_rows($result1) > 0){
						  
						 $total_record =  mysqli_num_rows($result1);
						
						 $total =ceil($total_record / $limit);
						 for($i=1;$i<$total; $i++){
							echo "<li><a href='index.php?page=$i'>$i</a></li>";
							 
						 }
						 if($total > $page){
				echo '<li><a href="index.php?page='.($page+1).'">NEXT</a></li>';
					  }
						 					  

						 echo "</ul>";
					  }
					  
						?>
                        <!--ul class='pagination'>
                            <li class="active"><a href="">1</a></li>
                            <li><a href="">2</a></li>
                            <li><a href="">3</a></li>
                        </ul>-->
                    </div><!-- /post-container -->
                </div>
                <?php include 'sidebar.php'; ?>
            </div>
        </div>
    </div>
<?php include 'footer.php'; ?>
