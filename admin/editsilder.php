<!-------This page is created to edit the slider .It is little bit connected to sliderlist.php-------------->

<?php
include "inc/adminheader.php";
include "inc/adminsidebar.php";
?>
<!----For editing checking  the post from post list---->
<?php
if(!isset($_GET['editsliderid']) || $_GET['editsliderid'] === NULL)
{

  header("Location:sliderlist.php");
}
else
{
  $sliderid = $_GET['editsliderid'];
}


?>
<!------------------------------>
        <div class="grid_10">
    
            <div class="box round first grid">
                <h2>Edit Slider</h2>
<!--For showing from tb_post table the post in the admin panel(add post) in the  field. which you can edit---->
<?php
    if($_SERVER['REQUEST_METHOD'] == 'POST')
 {
   $slidertitle = mysqli_real_escape_string($db->link,$_POST['title']);
    ///permission of kind of image----
          $permitted = array('jpg','jpeg','png','gif');
          //---\\\
           ///Catching through $_FILE.
          $file_name = $_FILES['image']['name'];
          $file_size = $_FILES['image']['size'];
          $file_way = $_FILES['image']['tmp_name'];
          //---\\\
          ///For uploading different image in same name in pc folder.And pc will generate an unique name for each file---
         $div = explode('.', $file_name);
         //---\\\
         /// Here if the file extension in Capital letter it will be smaller.
         $file_extension = strtolower(end($div));
         //--\\\
         ///it is for the unique name of image . substring is used to make the md5(time()) smaller .here highest 0 to 5 character will print.
        $unique_name = substr(md5(time()), 0, 5).'.'.$file_extension;
        //--\\\
        // Combining the folder with unique_name.If you do this you should not need to the folder name in extra for uploading  the image in pc destinated folder. 
         $uploaded_image = "upload/slider/".$unique_name;
         //--\\\
        
  if($slidertitle == "")
  {
    echo "<span class ='error'>Field must be filled.</span>";
  }
  else{
   ///Validation of image or file.
  ///When image is not empty.
  if(!empty($file_name))
  {

  if($file_size >1048567)///>byte.Image size.It is allowed in only under 1 MB photos. Greater than 1MB will be inserted in database but not uploaded in upload file.
         {
              echo "<span class = 'error'>Image Should be less than 1MB</span>","<br>";
         }
         elseif(in_array($file_extension,$permitted) === false)
         {
          echo "<span class = 'error'>You can only include.".implode(',',$permitted)."</span>";
         }
         else
         {
           ///---\\\
         ///---\\\
          /// Uploading file in pc folder.
          move_uploaded_file($file_way,$uploaded_image );
          //--\\\
          $sliderquery = "UPDATE tbl_slider
                               SET
                               title='$slidertitle',
                               image='$uploaded_image'
                               WHERE id='$sliderid'";
           $updated_rows = $db->update($sliderquery);//Passing in databaseclass
           ///--------\\\\
           if($updated_rows)
           {
            echo "<span class = 'success'>Slider updated successfully.</span>";
           }
           else
           {
            echo "<span class = 'error'>Slider not updated .</span>";
           }

      }
}
//--\\\
//When image is empty
else
{
$sliderquery = "UPDATE tbl_slider
                   SET
                    title='$slidertitle'
                    WHERE id='$sliderid'";
           $updated_rows = $db->update($sliderquery);//Passing in databaseclass
           ///--------\\\\
           if($updated_rows)
           {
            echo "<span class = 'success'>Slider updated successfully.</span>";
           }
           else
           {
            echo "<span class = 'error'>Slider not updated .</span>";
           }

}
//--\\\
}
  }
 ?>
 <!-------------------------------------------->
                <div class="block"> 
          <!---For brining to the Edit post page from post list in admin panel-------->
                <?php
                  $query = "SELECT * FROM tbl_slider WHERE id='$sliderid'";
                  $getslider = $db->select($query);
                  if($getslider)
                  {
                    while($sliderresult = $getslider->fetch_assoc())
                    { 

                ?>              
                 <form action="" method="post" enctype="multipart/form-data">
                    <table class="form">
                       
                        <tr>
                            <td>
                                <label>Title</label>
                            </td>
                            <td>
                                <input type="text" name ="title" value = "<?php echo $sliderresult['title'];  ?>"  class="medium" />
                            </td>
                        </tr>
                        
                        <tr>
                            <td>
                                <label>Upload New Slider</label>
                            </td>
                            <td>
                        <!---for bringing the image file and show---->
                              <img src = "<?php echo $sliderresult['image']; ?> " height = "150px" width ="200px"/><br/>
                        <!---------------->
                                <input type="file" name="image" />
                            </td>
                        </tr>
                        
                        </tr>
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