<!---This is for social Media in sidebar--!--->
<?php
include "inc/adminheader.php";
include "inc/adminsidebar.php";
?>
        <div class="grid_10">
		
            <div class="box round first grid">
                <h2>Update Social Media</h2>
                <!---For catching and updating the value--------->
<?php
 if($_SERVER['REQUEST_METHOD'] == 'POST')
  {
          $vfb = $fm->validation($_POST['fb']);
          $vtwt = $fm->validation($_POST['twt']);
          $vlnk = $fm->validation($_POST['linkedIn']);
          $vgoogle = $fm->validation($_POST['google']);

         $Facebook = mysqli_real_escape_string($db->link,$vfb);
         $Twit = mysqli_real_escape_string($db->link,$vtwt);
        $linkedin = mysqli_real_escape_string($db->link,$vlnk);
        $Google = mysqli_real_escape_string($db->link,$vgoogle);

     if($Facebook == "" || $Twit == "" || $linkedin == "" || $Google == "")
        {
            echo "<span class ='error'>Field must be filled.</span>";
         }
         else
         {
            $upquery = "UPDATE tbl_social
                        SET 
                        fb = '$Facebook',
                        twt = '$Twit',
                        linkedIn = '$linkedin',
                        google = '$Google'
                        WHERE id = '1'";
                $update_rows = $db->update($upquery);
                if($update_rows)
                {
                    echo "<span class ='success'>Social updated.</span>";
                }
                else
                {
                 echo "<span class ='error'>Social not updated.</span>";
                }
         }
        }
     ?>
     <!---------------------------------------------------------------->
               <div class="block">  
         <!-----For bringing and showing the data from database to social media(admin panel)----------->
                <?php
                  $query = "SELECT * FROM tbl_social WHERE id='1'";
                  $social = $db->select($query);
                  if($social)
                  {
                    while($result = $social->fetch_assoc())
                    {

                ?>

                 <form action="social.php" method="post">
                    <table class="form">					
                        <tr>
                            <td>
                                <label>Facebook</label>
                            </td>
                            <td>
                                <input type="text" name="fb" value = "<?php echo $result['fb']; ?>" class="medium" />
                            </td>
                        </tr>
						 <tr>
                            <td>
                                <label>Twitter</label>
                            </td>
                            <td>
                                <input type="text" name="twt" value = "<?php echo $result['twt']; ?>" class="medium" />
                            </td>
                        </tr>
						
						 <tr>
                            <td>
                                <label>LinkedIn</label>
                            </td>
                            <td>
                                <input type="text" name="linkedIn"  value = "<?php echo $result['linkedIn']; ?>" class="medium" />
                            </td>
                        </tr>
						
						 <tr>
                            <td>
                                <label>Google</label>
                            </td>
                            <td>
                                <input type="text" name="google"  value = "<?php echo $result['google']; ?>" class="medium" />
                            </td>
                        </tr>
						<?php } } ?>
             <!---------------------------------------------------------->
						 <tr>
                            <td></td>
                            <td>
                                <input type="submit" name="submit" Value="Update" />
                            </td>
                        </tr>
                    </table>
                    </form>
                </div>
            </div>
        </div>
          <?php
         include "inc/adminfooter.php";
        ?>