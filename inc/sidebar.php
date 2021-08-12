<div class="sidebar clear">
			<div class="samesidebar clear">
				<h2>Categories</h2>
				<!---For categories coloumn from tbl_category in post2.php--->
					<ul>
						<?php
                         $query = "SELECT * FROM `db_blog`.`tbl_category`";
                         $category = $db->select($query);
                         if($category){
                         while($result = $category->fetch_assoc())
                         {

						?>
						<li><a href="post2.php?category=<?php echo $result['id']; ?>"><?php echo $result['name']; ?></a></li><!--Here the data will come from the tbl_Category table of database and connected to the post php--Here href('post2.php') means this query is connected to the post2.php and it will connect the two table of database and bring the data which is matched post id and category id!---->
					
						<?php } } else{?>
					
                          <li>No Category Created.</li>
                          <?php
                      }
						 ?>	
						 <!------>				
					</ul>
			</div>
			
			<div class="samesidebar clear">
				<h2>Latest articles</h2>
				<!---For Latest article in post2.php--->
				<?php
                         $query = "SELECT * FROM tb_post Limit 6";//It will select the latest post of database. limit how much it will show//--\\\
                         $category = $db->select($query);
                         if($category){
                         while($result = $category->fetch_assoc())
                         {

						?>
					<div class="popular clear">
			
						<h3><a href="post2.php?category=<?php echo $result['id'];?>"><?php echo $result['title'];?></a></h3>
						<a href="post2.php?category=<?php echo $result['id'];?>"><img src="admin/<?php echo $result['image'];?>" alt="post image"/></a>
						<p><?php echo $fm->readmore($result['body'],30);?></p><!----Here readmore() is used in helpers folder format.php file it is used for textshorten. here 120 means Only 120 word will show.----->	
					</div>
					
					
					<?php 
                  } ///End of while loop//--\\\
                   }//End of if .//--\\\
                else
                {
	                 header("Location: 404.php");
	                  }
	                 ?>
	          <!--------->
			</div>
			
		</div>