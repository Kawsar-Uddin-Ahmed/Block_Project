<!-----It is used for reply option in Action column of Inbox in admin panel. little bit connect to inbox.php------------------->
<?php
include "inc/adminheader.php";
include "inc/adminsidebar.php";
?>
<!----For catching the id of the tbl_contact table---->
<?php
 if(!isset($_GET['replyid']) || $_GET['replyid'] == NULL)
 {
 	echo "<script> window.location = 'inbox.php';</script>";
 }
 else
 {
 	$emailid = $_GET['replyid'];
 }

?>
<!---------------------------------------------------->
        <div class="grid_10">
		
            <div class="box round first grid">
                <h2>View Email</h2>
<!--For viewing in the tbl_contact table from the Inbox in the admin panel(add post) in the  field---->
<?php
   
   if($_SERVER['REQUEST_METHOD'] == 'POST'){
   	$vto = $fm->validation($_POST['to']);
   	$vfrom = $fm->validation($_POST['from']);
   	$vsubject = $fm->validation($_POST['subject']);
   	$vmessage = $fm->validation($_POST['message']);

   $to = mysqli_real_escape_string($db->link,$vto);
   $from  = mysqli_real_escape_string($db->link,$vfrom);
   $subject = mysqli_real_escape_string($db->link,$vsubject);
   $message = mysqli_real_escape_string($db->link,$vmessage);

   ///sending email
   $sendemail = mail($to,$subject,$message,$from);
   if($sendemail)
   {
    echo "<span class = 'success'>Mail sent successfully.</span>";
   }
   else
   {
    echo "<span class = 'error'>Something went wrong.</span>";
   }

   //--\\\
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
                                <label>To</label>
                            </td>
                            <td>
                                <input type="text" readonly name ="toemail" value ="<?php echo $fm->validation($result['email']); ?> " class="medium" />
                            </td>
                        </tr>

                        
                            <td>
                                <label>From</label>
                            </td>
                            <td>
                                <input type="text"  name ="fromemail" placeholder = "Please enter your email..."class="medium" />
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label>Subject</label>
                            </td>
                            <td>
                                <input type="text"  name ="subject" palceholder = "Please enter the subject..." class="medium" />
                            </td>
                        </tr>
                           <tr>
                            <td>
                                <label>Message</label>
                            </td>
                            <td>
                                <textarea class="tinymce"  name="message"> 
                                </textarea>
                            </td>
                        </tr>
						<tr>
                            <td></td>
                            <td>
                                <input type="submit" name="submit" Value="Send" />
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
