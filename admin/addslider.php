<!-----------This file is created to add slider in admin panel.This is little bit connected to adminsidebar.php and sliderlist.php-------->

<?php
include "inc/adminheader.php";
include "inc/adminsidebar.php";
?>
        <div class="grid_10">
		
            <div class="box round first grid">
                <h2>Add New slider</h2>
              <!--------------------------------->
<!--For inserting in the tbl_slider table from the addslider in the admin panel(add slider) in the  field. which you can update---->
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
        
  if($slidertitle == "" || $file_name == "")
  {
    echo "<span class ='error'>Field must be filled.</span>";
  }
   ///Validation of image or file.
  elseif($file_size >1048567)///>byte.Image size.It is allowed in only under 1 MB photos. Greater than 1MB will be inserted in database but not uploaded in upload file.
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
          $sliderquery = "INSERT INTO tbl_slider(title,image) VALUES('$slidertitle','$uploaded_image')";
           $inserted_rows = $db->insert($sliderquery);//Passing in databaseclass
           ///--------\\\\
           if($inserted_rows)
           {
            echo "<span class = 'success'>Slider inserted successfully.</span>";
           }
           else
           {
            echo "<span class = 'error'>Slider is not inserted .</span>";
           }

      }


  }


 ?>
                <div class="block">               
                 <form action="addslider.php" method="post" enctype="multipart/form-data">
                    <table class="form">
                      <!----Only admin can add slider---->
                      <?php
                      if(Session::get('userRoll') == '0' || Session::get('userRoll') == '1')
                      {
                      ?>
                        <tr>
                            <td>
                                <label>Title</label>
                            </td>
                            <td>
                                <input type="text" name ="title"placeholder="Enter slider Title..." class="medium" />
                            </td>
                        </tr>
     <!-------------------------------------------->
                        <tr>
                            <td>
                                <label>Upload Image</label>
                            </td>
                            <td>
                                <input type="file" name="image" />
                            </td>
                        </tr>
						<tr>
                            <td></td>
                            <td>
                                <input type="submit" name="submit" Value="Add" />
                            </td>
                        </tr>
                      <?php } ?>
                      <!------------------------------------>
                    </table>
                    </form>
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