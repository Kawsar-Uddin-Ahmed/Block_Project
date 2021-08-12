<!-----This is the for the post list of post option----!-->
<?php
include "inc/adminheader.php";
include "inc/adminsidebar.php";
?>
        <div class="grid_10">
            <div class="box round first grid">
                <h2>Post List</h2>
                <div class="block">  
                    <table class="data display datatable" id="example">
					<thead>
						<tr>
							<th width ="5%">No</th>
							<th width ="15%">Post Title</th>
							<th width ="20%">Description</th>
							<th width ="10%">Category</th>
							<th width ="10%">Image</th>
							<th width ="10%">Author</th>
							<th width ="10%">Tags</th>
							<th width ="10%">Date</th>
							<th width ="10%">Action</th>
						</tr>
					</thead>
					<tbody>
						<!--For bringing the All data from tb_post table and name column from tbl_category show it in admin panel(post list)-->
						<?php
                         $query = "SELECT tb_post.*,tbl_category.name FROM tb_post
                             INNER JOIN tbl_category
                             ON tb_post.categ = tbl_category.id ORDER BY tb_post.id ASC";
                             $post = $db->select($query);
                             if($post)
                             {
                             	$i=0;
                             	while($result = $post->fetch_assoc())
                             	{
                             		$i++;
						?>
						<tr class="odd gradeX">
							<td><?php echo $i; ?></td>
							<td><a href="editpost.php?editpostid=<?php echo $result['id'];?>"</a><?php echo $result['title']; ?></td>
							<td><?php echo $fm->readmore($result['body'],150);  ?></td>
							<td> <?php echo $result['name'];?></td>
							<td><img src="<?php echo $result['image']?>"height = "40px" width = "60px"/></td>
							<td><?php echo $result['author']; ?></td>
							<td><?php echo $result['tags']; ?></td>
							<td><?php echo $fm->Date($result['date']);?></td>
							<!--For edit and delete. connect between tbl_admin and tbl_post table---------->
							<td><a href="viewpost.php?viewpostid=<?php echo $result['id'];?>">View</a>
								 <?php
                                 if(Session::get('userId') == $result['userid'])
                                 {
                              ?>
								||<a href="editpost.php?editpostid=<?php echo $result['id'];?>">Edit</a> 
								<?php
							     } 
							     ?>
								<!-----Only the person who has posted can only delete it means the id of tbl_admin and the userid of tbl_post if same than the post can be deleted and the admin can delete any post what ever he want. Little bit connected to tbl_admin table and login.php------> 
                                 <?php
                                  if(Session::get('userId') == $result['userid'] || Session::get('userRoll') == '0')
                                  {
                                 ?>
								  || <a onclick="return confirm('Are your sure to delete');" href="deletepost.php?deletepostid=<?php echo $result['id'];?>">Delete</a>
                                <?php }
                                ?>
                                <!----------------------->
							</td>
							<!----------------------------->
						</tr>
						<?php
                         }
                     }
						?>
					</tbody>
					<!-------------------------------------->
				</table>
	
               </div>
            </div>
        </div>
        <script type="text/javascript">
        $(document).ready(function () {
            setupLeftMenu();
            $('.datatable').dataTable();
			setSidebarHeight();
        });
    </script>
        <div class="clear">
        </div>
    </div>
     <?php
         include "inc/adminfooter.php";
        ?>
