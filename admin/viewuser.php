<!-----This is file is created to show the details of the user it is little bit connected to userlist.php--!--->

<?php
include "inc/adminheader.php";
include "inc/adminsidebar.php";
?>
<!------For edit or update user list---->
<?php
if(!isset($_GET['userid']) || $_GET['userid'] == NULL)///IF ID IS NOT PRESENT or you want to add something with out userid than it will show this.
{
   echo "<script>window.location='userlist.php'</script>";
}
//--\\\
//If id is setted
else
{
  $userid = $_GET['userid'];///From userlist.php
}
//--\\\

?>
<!----->
        <div class="grid_10">
    
            <div class="box round first grid">
                <h2>User Details</h2>
<!--For showing from tb_post table the post in the admin panel(add post) in the  field. which you can edit---->
<?php
 if($_SERVER['REQUEST_METHOD'] == 'POST')
 {
   $name = mysqli_real_escape_string($db->link,$_POST['name']);
   $username = mysqli_real_escape_string($db->link,$_POST['username']);
   $email = mysqli_real_escape_string($db->link,$_POST['email']);
   $details = mysqli_real_escape_string($db->link,$_POST['detail']);
   echo "<script>window.location='userlist.php'</script>";
}
  ?>
 <!-------------------------------------------->
                <div class="block"> 
          <!---For brining to the Edit post page from post list in admin panel-------->
                <?php
                  $query = "SELECT * FROM tbl_admin WHERE id='$userid'";
                  $getuser = $db->select($query);
                  if($getuser)
                  {
                    while($userresult = $getuser->fetch_assoc())
                    {
                ?>              
                 <form action="viewuser.php" method="post"> 
                    <table class="form">
                       
                        <tr>
                            <td>
                                <label>Name</label>
                            </td>
                            <td>
                                <input type="text" name="name" value="<?php echo $userresult['name'];  ?>"  class="medium" />
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label>UserName</label>
                            </td>
                            <td>
                                <input type="text" name="username" value="<?php echo $userresult['username'];  ?>"  class="medium" />
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label>Email</label>
                            </td>
                            <td>
                                <input type="text" name="email" value="<?php echo $userresult['email'];  ?>"  class="medium" />
                            </td>
                        </tr>
                        <tr>
                            <td style="vertical-align: top; padding-top: 9px;">
                                <label>Details</label>
                            </td>
                            <td>
                                <textarea class="tinymce" name="detail">
                                 <?php echo $userresult['detail']; ?>
                                </textarea>
                            </td>
                        
                          <tr>
                            <td></td>
                            <td>
                                <input type="submit" name="submit" Value="ok" />
                            </td>
                        </tr>
                    </table>
                    </form>
                  <?php  } } ?>
                </div>
           <!--------------------------------------------------->
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