<!------This is for post list edit option copy from addpost.php but little bit change and little bit connect to postlist.php and adminheadre.php-----------!--->
<?php
include "inc/adminheader.php";
include "inc/adminsidebar.php";
?>
<?php
$userid = Session::get('userId');
$userroll = Session::get('userRoll');

?>

        <div class="grid_10">
    
            <div class="box round first grid">
                <h2>User Profile</h2>
<!--For showing from tb_post table the post in the admin panel(add post) in the  field. which you can edit---->
<?php
 if($_SERVER['REQUEST_METHOD'] == 'POST')
 {
   $name = mysqli_real_escape_string($db->link,$_POST['name']);
   $username = mysqli_real_escape_string($db->link,$_POST['username']);
   $email = mysqli_real_escape_string($db->link,$_POST['email']);
   $details = mysqli_real_escape_string($db->link,$_POST['detail']);
  $userquery = "UPDATE tbl_admin
                 SET
                    name = '$name',
                    username = '$username',
                    email = '$email',
                    detail = '$details'
                    WHERE id = '$userid'";
           $updated_rows = $db->update($userquery);//Passing in databaseclass
           ///--------\\\\
           if($updated_rows)
           {
            echo "<span class = 'success'>User updated successfully.</span>";
           }
           else
           {
            echo "<span class = 'error'>User not updated .</span>";
           }

}
//--\\\

 ?>
 <!-------------------------------------------->
                <div class="block"> 
          <!---For brining to the Edit post page from post list in admin panel-------->
                <?php
                  $query = "SELECT * FROM tbl_admin WHERE id='$userid' AND roll='$userroll'";
                  $getuser = $db->select($query);
                  if($getuser)
                  {
                    while($userresult = $getuser->fetch_assoc())
                    {
                ?>              
                 <form action="profile.php" method="post" enctype="multipart/form-data">
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
                                <input type="submit" name="submit" Value="Update" />
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