<!--This for copy right is sidebar. It will update the text of footer means at fuuly down texts--!-->
<?php
include "inc/adminheader.php";
include "inc/adminsidebar.php";
?>
    
        <div class="grid_10">
		
            <div class="box round first grid">
                <h2>Update the footer(Copyright)Text</h2>
        <!---For catching and updating the value--------->
<?php
 if($_SERVER['REQUEST_METHOD'] == 'POST')
  {
          $vnote = $fm->validation($_POST['note']);
         
         $Note = mysqli_real_escape_string($db->link,$vnote);

     if($Note == "")
        {
            echo "<span class ='error'>Copyright Text must be filled.</span>";
         }
         else
         {
            $cpquery = "UPDATE tbl_copyright 
                        SET 
                        note ='$Note'
                        WHERE id='1'";
                $update_rows = $db->update($cpquery);
                if($update_rows)
                {
                    echo "<span class ='success'>Copyright Text updated.</span>";
                }
                else
                {
                 echo "<span class ='error'>Copyright Text not updated.</span>";
                }
         }
        }
     ?>
     <!---------------------------------------------------------------->

                <div class="block copyblock"> 
                    <!---Bringing the data from the tbl_copyright table and showing it to the copyright in admin panel--->
                    <?php
                     $cquery = "SELECT * FROM tbl_copyright WHERE id='1'";
                     $copy = $db->select($cquery);
                     if($copy)
                     {
                        while($result = $copy->fetch_assoc())
                        {

                    ?>
                 <form action ="" method = "post">
                    <table class="form">					
                        <tr>
                            <td>
                                <input type="text" value="<?php echo $result['note']; ?>" name="note" class="large" />
                            </td>
                        </tr>
						
						 <tr> 
                            <td>
                                <input type="submit" name="submit" Value="Update" />
                            </td>
                        </tr>
                    </table>
                    </form>
                <?php   }  } ?>
                </div>
            </div>
        </div>
        <?php
         include "inc/adminfooter.php";
        ?>