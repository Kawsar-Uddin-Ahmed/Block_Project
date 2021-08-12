<!-------------For editing the theme in the font page Liitle bit 
  connected to theme folder and header.php-------------------->

<?php
include "inc/adminheader.php";
include "inc/adminsidebar.php";
?>

?>

        <div class="grid_10">
		
            <div class="box round first grid">
                <h2> Change theme</h2>
               <div class="block copyblock"> 
                 
     <?php
      //For updating changing theme(Admin panel).
          if($_SERVER['REQUEST_METHOD'] == 'POST')
          {
           $rtheme = mysqli_real_escape_string($db->link,$_POST['theme']);
            $themequery = "UPDATE tbl_theme SET theme='$rtheme' WHERE id='1'";
             $updated_row = $db->update($themequery);
    
             if($updated_row)
             {
               echo "<span class='success'>Theme updated successfully.</span>";
             }
             else
             {
              echo "<span class='error'>Theme not updated.</span>";
             }
           }
             //--\\\
     ?>

     <!---For selecting the theme of table tbl_theme from admin panel and publishing the color in font page --->
   <?php
       $themequery = "SELECT * FROM tbl_theme WHERE id='1'";
       $THEME = $db->select($themequery);
        while($themeresult = $THEME->fetch_assoc())
        {

     ?>
              <form action = "" method ="post">
                    <table class="form">					
                        <tr>
                            <td>
                                <input <?php if ($themeresult['theme'] == 'default') { echo "checked"; }?> type="radio" name ="theme" value ="default"/>Default.
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <input <?php if ($themeresult['theme'] == 'deepgreen') { echo "checked"; }?> type="radio" name ="theme" value ="deepgreen"/>Deep-Green.
                            </td>
                        </tr>
                         <tr>
                            <td>
                                <input <?php if ($themeresult['theme'] == 'lightgreen') { echo "checked"; }?> type="radio" name ="theme" value ="lightgreen"/>Light-Green.
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <input <?php if ($themeresult['theme'] == 'red') { echo "checked"; }?> type="radio" name ="theme" value ="red"/>Red.
                            </td>
                        </tr>
						              <tr> 
                            <td>
                                <input type="submit" name="submit" Value="Changed" />
                            </td>
                        </tr>
                    </table>
                    </form>
                  <?php } ?>
                   <!------>
                </div>
            </div>
        </div>
        <?php
         include "inc/adminfooter.php";
        ?>