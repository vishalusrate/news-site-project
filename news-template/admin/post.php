<?php include "header.php"; ?>
  <div id="admin-content">
      <div class="container">
          <div class="row">
              <div class="col-md-10">
                  <h1 class="admin-heading">All Posts</h1>
              </div>
              <div class="col-md-2">
                  <a class="add-new" href="add-post.php">add post</a>
              </div>
              <div class="col-md-12">
			  <?php
			  
			  	include "config.php";
				 $limit =9;
			
				 if(isset($_GET['page'])){
					$page =$_GET['page'];
				 }else{
					 $page=1;
				 }
				 $offset = ($page-1)* $limit;
				 
				 if( $_SESSION['user_role'] == 1){
				 $sql = "select * from post 
				left join category on post.category=category.category_id
				left join user on post.author=user.user_id
				order by post_id desc LIMIT $offset,$limit";
				 }else{
					 $sql = "select * from post 
				left join category on post.category=category.category_id
				left join user on post.author=user.user_id where post.author = {$_SESSION['user_id']}
				order by post_id desc LIMIT $offset,$limit";
				 }				
				$result = mysqli_query($conn,$sql);
				if(mysqli_num_rows($result)){
			
			  ?>
			  
                  <table class="content-table">
                      <thead>
                          <th>S.No.</th>
                          <th>Title</th>
                          <th>Category</th>
                          <th>Date</th>
                          <th>Author</th>
                          <th>Edit</th>
                          <th>Delete</th>
                      </thead>
                      <tbody>
					  <?php
					  $serial=$offset+1;
					  while($row = mysqli_fetch_assoc($result)){
						  ?>
                          <tr>
                              <td class='id'><?php echo $serial;?></td>
                              <td><?php echo $row['title'];?></td>
                              <td><?php echo $row['category_name'];?></td>
                              <td><?php echo $row['post_date'];?></td>
                              <td><?php echo $row['username'];?></td>
                              <td class='edit'><a href='update-post.php?id=<?php echo $row['post_id'];?>'><i class='fa fa-edit'></i></a></td>
                              <td class='delete'><a href='delete-post.php?id=<?php echo $row['post_id'];?>&catid=<?php echo $row['category'];?>'><i class='fa fa-trash-o'></i></a></td>
                          </tr>
                           <?php
						   $serial++;
					  }
				 ?>
                      </tbody>
                  </table>
                  <?php
					  }
					  $sql1 = "SELECT * FROM post";
					  $result1 = mysqli_query($conn,$sql1);
					  echo "<ul class='pagination admin-pagination'>";
					  if($page > 1){
					  echo '<li><a href="post.php?page='.($page-1).'">PREV</a></li>';
					  }
					  if(mysqli_num_rows($result1) > 0){
						  
						 $total_record =  mysqli_num_rows($result1);
						
						 $total =ceil($total_record / $limit);
						 for($i=1;$i<$total; $i++){
							echo "<li><a href='post.php?page=$i'>$i</a></li>";
							 
						 }
						 if($total > $page){
				echo '<li><a href="post.php?page='.($page+1).'">NEXT</a></li>';
					  }
						 					  

						 echo "</ul>";
					  }
					  
					  ?>
              </div>
          </div>
      </div>
  </div>
<?php include "footer.php"; ?>
