<!---This is for Inbox option in header---------!-->
<?php
include "inc/adminheader.php";
include "inc/adminsidebar.php";
?>
        <div class="grid_10">
            <div class="box round first grid">
                <h2>Inbox</h2>
<!------------------------------------------------->
                <!---------For seen option  to send from Inbox by updating the status 1----------->
               <?php
                 if(isset($_GET['seenid']))
                     {
	                  $seenid = $_GET['seenid'];
	                  $upquery = "UPDATE tbl_contact 
                                  SET status = '1'
                                  WHERE id='$seenid'";
                      $updated_rows = $db->update($upquery);
                      if($updated_rows)
                      {
                      	echo "<span class='success'>Message sent in the seen box.</span>";
                      }
                      else
                      {
                     echo "<span class='error'>Something wrong</span>";
                      }
                  }
                     ?>

<!------------------------------------------------->
                <div class="block">        
                    <table class="data display datatable" id="example">
					<thead>
						<tr>
							<th>Serial No.</th>
							<th>Name</th>
							<th>email</th>
							<th>message</th>
							<th>date</th>
							<th>Action</th>
						</tr>
					</thead>
					<tbody>
						<?php
                          $query = "SELECT * FROM tbl_contact WHERE status='0' ORDER BY id ASC";
                          $contacts = $db->select($query);
                          if($contacts)
                          {
                          	$i=0;
                          	while($result = $contacts->fetch_assoc())
                          	{
                               $i++;
						?>
						<tr class="odd gradeX">
							<td><?php echo $i; ?></td>
							<td><?php  echo $result['firstname'].' '. $result['lastname'];?></td>
							<td><?php echo $result['email'];  ?></td>
							<td><?php echo $fm->readmore($result['body'],50); ?></td>
							<td><?php  echo $fm->Date($result['date']); ?></td>
							<td><a href="viewemail.php?viewemailid=<?php echo $result['id']; ?>">View</a> || 
								<a href="replyemail.php?replyid=<?php echo $result['id']; ?>">Reply</a> ||
								<a onclick = "return confirm('Are you sure to move the message');" href="?seenid=<?php echo $result['id']; ?>">Seen</a>
							</td>
						</tr>
					<?php }  } ?>
					</tbody>
				</table>
               </div>
            </div>
     <!------------------------------------------------------>

      <!---------For seen message table----------->
        <div class="box round first grid">
                <h2>Seen Message</h2>
                <!---------For unseen option  to send back to inbox Inbox by updating the status 0----------->
               <?php
                 if(isset($_GET['unseenid']))
                     {
                    $useenid = $_GET['unseenid'];
                    $unseenpquery = "UPDATE tbl_contact 
                                  SET status = '0'
                                  WHERE id='$useenid'";
                      $unseenupdated_rows = $db->update($unseenpquery);
                      if($unseenupdated_rows)
                      {
                        echo "<span class='success'>Message sent back to the inbox box.</span>";
                      }
                      else
                      {
                     echo "<span class='error'>Something is wrong</span>";
                      }
                  }
                     ?>
            <!----------------------------------------------------->
                <!--For deleting from Seen message-->
               <?php
                if(isset($_GET['delid']))
                 {
                     $deleteid = $_GET['delid'];
                    $delquery = "DELETE FROM tbl_contact WHERE id = $deleteid";
                    $delete_row = $db->delete($delquery);
                    if($delete_row)
                    {
                        echo "<span class ='success'>Message Deleted successfully.</span>";
                    }
                    else
                    {
                        echo "<span class = 'error'>Message Not deleted.</span>";
                    }
                 }   
               
                ?>
                <!---------------------------------------->
                <div class="block">        
                   <table class="data display datatable" id="example">
					<thead>
						<tr>
							<th>Serial No.</th>
							<th>Name</th>
							<th>email</th>
							<th>message</th>
							<th>date</th>
							<th>Action</th>
						</tr>
					</thead>
					<tbody>
             <!-------Query to send in seen message box status  where id is changed in 1 ----->
						<?php
                          $query = "SELECT * FROM tbl_contact WHERE status='1' ORDER BY id ASC";
                          $contacts = $db->select($query);
                          if($contacts)
                          {
                          	$i=0;
                          	while($result = $contacts->fetch_assoc())
                          	{
                               $i++;
						?>
						<tr class="odd gradeX">
							<td><?php echo $i; ?></td>
							<td><?php  echo $result['firstname'].' '. $result['lastname'];?></td>
							<td><?php echo $result['email'];  ?></td>
							<td><?php echo $fm->readmore($result['body'],50); ?></td>
							<td><?php  echo $fm->Date($result['date']); ?></td>
              <td><a href="viewemail.php?viewemailid=<?php echo $result['id']; ?>">View</a> || 
                <a onclick = "return confirm('Are you sure to unseen it');" href="?unseenid=<?php echo $result['id']; ?>">Unseen</a> ||
							<a onclick = "return confirm('Are you sure to delete');" href="?delid=<?php echo $result['id']; ?>">Delete</a>
							</td>
						</tr>
					<?php }  } ?>
					</tbody>
     <!---------------------------------------->
				</table>
               </div>
            </div>
      <!-------------------------------------->

        </div>
        <!---For search option--->
        <script type="text/javascript">

        $(document).ready(function () {
            setupLeftMenu();

            $('.datatable').dataTable();
            setSidebarHeight();


        });
    </script>
    <!---->
         <?php
         include "inc/adminfooter.php";
        ?>

