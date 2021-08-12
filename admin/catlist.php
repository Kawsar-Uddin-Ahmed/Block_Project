<!------This is for category list in category option--------!-->
<?php
include "inc/adminheader.php";
include "inc/adminsidebar.php";
?>
        <div class="grid_10">
            <div class="box round first grid">
                <h2>Category List</h2>
                <!--For deleting from category list-->
               <?php
                if(isset($_GET['delid']))
                 {
                     $deleteid = $_GET['delid'];
                    $delquery = "DELETE FROM tbl_category WHERE id = $deleteid";
                    $delete_row = $db->delete($delquery);
                    if($delete_row)
                    {
                        echo "<span class ='success'>Deleted successfully.</span>";
                    }
                    else
                    {
                        echo "<span class = 'error'><Not deleted./span>";
                    }
                 }   
               
                ?>
                <!---->
                <div class="block">        
                    <table class="data display datatable" id="example">
					<thead>
						<tr>
							<th>Serial No.</th>
							<th>Category Name</th>
                            <!---Action column will be only in Admin and Author---->
                            <th>Action</th>
                        <!-------->
						</tr>
					</thead>
					<tbody>
						<!---For bringing data in catlist from tbl_category in admin panel----->
						<?php

                         $query = "SELECT * FROM `db_blog`.`tbl_category` ORDER BY id DESC";
                         $category = $db->select($query);
                         if($category)
                         {
                         	$i=0;
                         	
                         	while($result = $category->fetch_assoc())
                         	{
                         		$i++;
                                
						?>
						<tr class="odd gradeX">
							<td><?php echo $i; ?></td><!--Desecnding order will work if you do this-!--->
							<!---<td><?php //echo $result['id'];\Desecnding order will not  work if you do this but it is also correct ?></td>-!-->
							<td><?php echo $result['name']; ?></td>
							<td><a href="editcat.php?catid=<?php echo $result['id']; ?>">Edit</a> 
        
                                <!--Only admin can edit and delete category connected to tbl_admin and tbl_category.page adminsidebar.php and login.php and editcat.php------>

                              <?php
                               if(Session::get('userRoll') == '0')
                               {

                              ?>
                               || <a onclick= "return confirm('Are you sure to delete.');" href="catlist.php?delid= <?php echo $result['id']; ?>">Delete</a></td>
                            <?php  } ?>
                            <!--------------->
						</tr>
						<?php
					}
				}
						?>
					</tbody>
					<!-------->
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
       <?php
         include "inc/adminfooter.php";
        ?>


