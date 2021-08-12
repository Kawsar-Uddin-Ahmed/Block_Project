<!------This is a userlist.php. This is used to see the user list of tbl_admin table and little bit connect to adminheade.php----!-->

<?php
include "inc/adminheader.php";
include "inc/adminsidebar.php";
?>
        <div class="grid_10">
            <div class="box round first grid">
                <h2>User List</h2>
                <!--For deleting from User list-->
               <?php
                if(isset($_GET['userdelid']))
                 {
                     $userdeleteid = $_GET['userdelid'];
                    $userdelquery = "DELETE FROM tbl_admin WHERE id = $userdeleteid";
                    $userdelete_row = $db->delete($userdelquery);
                    if($userdelete_row)
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
							<th>Name</th>
							<th>User name</th>
							<th>email</th>
							<th>Details</th>
							<th>Roll</th>
							<th>Action</th>
						</tr>
					</thead>
					<tbody>
						<!---For bringing data in user list from tbl_admin in admin panel----->
						<?php

                         $query = "SELECT * FROM tbl_admin ";
                         $user = $db->select($query);
                         if($user)
                         {
                         	$i=0;
                         	
                         	while($userresult = $user->fetch_assoc())
                         	{
                         		$i++;
                                
						?>
						<tr class="odd gradeX">
							<td><?php echo $i; ?></td><!--Desecnding order will work if you do this-!--->
							<!---<td><?php //echo $result['id'];\Desecnding order will not  work if you do this but it is also correct ?></td>-!-->
							<td><?php echo $userresult['name']; ?></td>
							<td><?php echo $userresult['username']; ?></td>
							<td><?php echo $userresult['email']; ?></td>
							<td><?php echo $fm->readmore($userresult['detail'],10); ?></td>
							<td>
							<?php 
							if($userresult['roll'] == '0') 
							{
								echo "Admin"; 

                             }
                             elseif($userresult['roll'] == '1')
                             {
                             	echo "Author";
                             }
                              elseif($userresult['roll'] == '2')
                             {
                                 echo "Editor";
                             }

							   ?>
							</td>
							<td><a href="viewuser.php?userid=<?php echo $userresult['id']; ?>">View user</a> 
                                <!-----This done beacuse only admin can delete any one other people including in tbl_admin cannot delete data----->
                               <?php
                                  if(Session::get('userRoll') == '0')
                                  {
                               ?>
                                ||<a onclick= "return confirm('Are you sure to delete.');" href="?userdelid=<?php echo $userresult['id']; ?>">Delete</a>
                                 <?php
                                  }
                                 ?>
                                 <!---------------------->
                            </td>
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
