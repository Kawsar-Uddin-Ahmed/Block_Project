<!-----It is used for view option in Action column of Inbox in admin panel. little bit connect to inbox.php------------------->
<?php
include "inc/adminheader.php";
include "inc/adminsidebar.php";
?>
<!----For catching the id of the tbl_contact table---->
<?php
 if(!isset($_GET['viewemailid']) || $_GET['viewemailid'] == NULL)
 {
 	echo "<script> window.location = 'inbox.php';</script>";
 }
 else
 {
 	$emailid = $_GET['viewemailid'];
 }

?>
<!---------------------------------------------------->
        <div class="grid_10">
		
            <div class="box round first grid">
                <h2>View Email</h2>
<!--For viewing in the tbl_contact table from the Inbox in the admin panel(add post) in the  field---->
<?php
   
   if($_SERVER['REQUEST_METHOD'] == 'POST'){
   	/*It is not needed here.
   	$vname = $fm->validation($_POST['name']);
   	$vemail = $fm->validation($_POST['email']);
   	$vmsg = $fm->validation($_POST['body']);
   	$vdate = $fm->validation($_POST['date']);

   $conname = mysqli_real_escape_string($db->link,$vname);
   $conemail = mysqli_real_escape_string($db->link,$vemail);
   $conmsg = mysqli_real_escape_string($db->link,$vmsg);
   $condate = mysqli_real_escape_string($db->link,$vdate);*/
  ///After viewing the message to go back to inbox this code is used.
   echo "<script> window.location = 'inbox.php';</script>";
   //--\\\\
  }
 ?>
  <!-------------------------------------------->
  <!--------For viewing the email----------------->
                <div class="block">               
                 <form action="" method="post">
                 	<!--------For bringing and showing the data---->
            <?php
              $viewquery = "SELECT * FROM tbl_contact WHERE id=$emailid";
               $viewcontacts = $db->select($viewquery);
               if($viewcontacts)
                          {
                        
                          	while($result = $viewcontacts->fetch_assoc())
                          	{
                             



                 	?>
                 	<!----------------------->
               <!---readonly is used so that it cannot be edited.<textare class="tinymce"></textarea> read only is not worked-----!-->
                    <table class="form">
                       
                        <tr>
                            <td>
                                <label>Name</label>
                            </td>
                            <td>
                                <input type="text" readonly name ="name" value ="<?php echo $result['firstname'].' '.$result['lastname']; ?>" class="medium" />
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label>Email</label>
                            </td>
                            <td>
                                <input type="text" readonly name ="email" value ="<?php echo $fm->validation($result['email']); ?> " class="medium" />
                            </td>
                        </tr>
                           <tr>
                            <td>
                                <label>Message</label>
                            </td>
                            <td>
                                <textarea class="tinymce"  name="body"> <?php echo $fm->validation($result['body']); ?>
                                </textarea>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label>Date</label>
                            </td>
                            <td>
                                <input type="text" readonly name ="date" value ="<?php echo $fm->Date($result['date']); ?> " class="medium" />
                            </td>
                        </tr>
						<tr>
                            <td></td>
                            <td>
                                <input type="submit" name="submit" Value="OK" />
                            </td>
                        </tr>
                    </table>
                <?php  }  }  ?>
                    </form>
            <!-------------------------------------------->
                </div>
            </div>
        </div>
        <div class="clear">
        </div>
    </div>
    <!-- Load TinyMCE -->
    <script src="js/tiny-mce/jquery.tinymce.js" type="text/javascript"></script>
    <script type="text/javascript">
        $(document).ready(function () {
            setupTinyMCE();
            setDatePicker('date-picker');
            $('input[type="checkbox"]').fancybutton();
            $('input[type="radio"]').fancybutton();
        });

    </script>
     <!---->
    <?php
         include "inc/adminfooter.php";
     ?>

<!-- /TinyMCE -->
    <!------<style type="text/css">
        #tinymce{font-size:15px !important;}
    </style>--------->
