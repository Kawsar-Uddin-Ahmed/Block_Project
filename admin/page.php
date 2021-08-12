<!---It is used for creating page dynamically. little bit connect to addpost.php page and adminsidebar.php-.Here we will need only title and content--!--->
<?php
include "inc/adminheader.php";
include "inc/adminsidebar.php";
?>
<!------For edit or updating the created page id has come from adminsidebar.php---->
<?php
$pageID = mysqli_real_escape_string($db->link,$_GET['pageid']);
if(!isset($pageID) && $pageID == NULL)///IF ID IS NOT PRESENT or you want to add something with out catid than it will show this.
{
   echo "<script>window.location='adminindex.php'</script>";
   //header("Loctaion:catlist.php");
}
//--\\\
//If id is setted
else
{
  $pid = $pageID;///From catlist.php
}
//--\\\

?>
<style>
.actiondel
{
  margin-left:10px;

}
.actiondel a
{
  border:1px solid #ddd;
  color:#444;
  cursor:pointer;
  font-size: 20px;
  padding: 4px 10px;
  font-weight:normal;
  background:#F0F0F0;
}

</style>
        <div class="grid_10">
    
            <div class="box round first grid">
                <h2>Pages edit</h2>
<!--For inserting in the tbl_page table from the page edit in the admin panel(add post) in the  field---->
<?php
    if($_SERVER['REQUEST_METHOD'] == 'POST')
 {
   $Name = mysqli_real_escape_string($db->link,$_POST['name']);
   $Body = mysqli_real_escape_string($db->link,$_POST['body']);
  if($Name == "" || $Body == "")
  {
    echo "<span class ='error'>Field must be filled.</span>";
  }
  else
  {

    $pagequery = "UPDATE tbl_page
                   SET
                    name = '$Name',
                    body = '$Body'
                    WHERE id = '$pid'";
           $updated_rows = $db->update($pagequery);//Passing in databaseclass
           ///--------\\\\
           if($updated_rows)
           {
            echo "<span class = 'success'>Page updated successfully.</span>";
           }
           else
           {
            echo "<span class = 'error'>Page not updated.</span>";
           }

      }


  }
 ?>
 
                <div class="block"> 
                <!---Bringing from the tbl_page and showing the name of the pages in  it the sidebar ------>
                    <?php
                      $pagequery = "SELECT * FROM tbl_page WHERE id= '$pid'";
                      $newpage = $db->select($pagequery);
                      if($newpage)
                      {
                        while($result = $newpage->fetch_assoc())
                        {
                    ?>              
                 <form action="" method="post">
                    <table class="form">
                       
                        <tr>
                            <td>
                                <label>Name</label>
                            </td>
                            <td>
                                <input type="text" name ="name" value="<?php echo $result['name']; ?>" class="medium" />
                            </td>
                        </tr>
     <!-------------------------------------------->
                           <tr>
                            <td style="vertical-align: top; padding-top: 9px;">
                                <label>Content</label>
                            </td>
                            <td>
                                <textarea class="tinymce" name="body">
                                  <?php echo $result['body']; ?>
                                </textarea>
                            </td>
                        </tr>
            <tr>
                            <td></td>
                            <td>
                                <input type="submit" name="submit" Value="Submit" />
                                <!--------For delete page---->
                                <span class="actiondel"><a onclick="return confirm('Are you sure to delete');" href="deletepage.php?delid=<?php echo $result['id']; ?>">Delete</a></span>
                                <!------------>
                            </td>
                        </tr>
                    </table>
                    </form>
                  <?php   }  } ?>
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