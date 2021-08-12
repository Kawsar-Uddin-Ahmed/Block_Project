<!-------This is for Add post in post option in sidebar------!-->
<?php
include "inc/adminheader.php";
include "inc/adminsidebar.php";
?>
        <div class="grid_10">
		
            <div class="box round first grid">
                <h2>Add New Post</h2>
<!--For inserting in the tb_post table from the post in the admin panel(add post) in the  field. which you can update---->
<?php
    if($_SERVER['REQUEST_METHOD'] == 'POST')
 {
   $poscat = mysqli_real_escape_string($db->link,$_POST['categ']);
   $postitle = mysqli_real_escape_string($db->link,$_POST['title']);
   $posbody = mysqli_real_escape_string($db->link,$_POST['body']);
   $posautor = mysqli_real_escape_string($db->link,$_POST['author']);
   $postag = mysqli_real_escape_string($db->link,$_POST['tags']);
   $userid = mysqli_real_escape_string($db->link,$_POST['userid']);
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
         $uploaded_image = "upload/storeuser/".$unique_name;
         //--\\\
        
  if($poscat == "" || $postitle == "" || $posbody == "" || $posautor == "" || $postag == "" || $file_name == "")
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
          $query = "INSERT INTO tb_post(categ,title,body,image,author,tags,userid) VALUES('$poscat','$postitle','$posbody','$uploaded_image','$posautor','$postag','$userid')";
           $inserted_rows = $db->insert($query);//Passing in databaseclass
           ///--------\\\\
           if($inserted_rows)
           {
            echo "<span class = 'success'>Post inserted successfully.</span>";
           }
           else
           {
            echo "<span class = 'error'>Post is not inserted .</span>";
           }

      }


  }


 ?>
                <div class="block">               
                 <form action="addpost.php" method="post" enctype="multipart/form-data">
                    <table class="form">
                       
                        <tr>
                            <td>
                                <label>Title</label>
                            </td>
                            <td>
                                <input type="text" name ="title"placeholder="Enter Post Title..." class="medium" />
                            </td>
                        </tr>
     <!-------------------------------------------->
                        <tr>
                            <td>
                                <label>Category</label>
                            </td>
                            <td>
                                <select id="select" name="categ">
                                <option>Select Category.</option>
                                <!---For bringing category name from database table tbl_category to admin panel(add post) and show it in category box.--->
                                <?php
                                 $query = "SELECT * FROM `db_blog`.`tbl_category`";
                                 $category = $db->select($query);
                                 if($category)
                                 {
                                    //$i=0;//Starting the category.Do not use this when you will use $result['id'];
                                  
                                while($result = $category->fetch_assoc())
                                    {
                                        //$i++;//Increament of category.Do not use this when you will use $result['id'];

                                ?>
                                    <option value="<?php echo $result['id']; //$i;//Showing the category by id from tbl_category.Do not use this when you will use $result['id'];  ?>"><?php echo $result['name']; ?></option>
                                   <?php } } ?>
                              <!----------->
                                </select>
                            </td>
                        </tr>
                   
                    
                        <!---<tr>
                            <td>
                                <label>Date Picker</label>
                            </td>
                            <td>
                                <input type="text" id="date-picker" />
                            </td>
                        </tr>
                        --->
                        <tr>
                            <td>
                                <label>Upload Image</label>
                            </td>
                            <td>
                                <input type="file" name="image" />
                            </td>
                        </tr>
                        <tr>
                            <td style="vertical-align: top; padding-top: 9px;">
                                <label>Content</label>
                            </td>
                            <td>
                                <textarea class="tinymce" name="body"></textarea>
                            </td>
                        </tr>
                            <tr>
                            <td>
                                <label>Tags</label>
                            </td>
                            <td>
                                <input type="text" name ="tags"placeholder="Enter Tags..." class="medium" />
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label>Authors</label>
                            </td>
                            <!---Here session is used so that authors column in post(admin panel) will show the name automatically------>
                            <td>
                                <input type="text" name ="author" value="<?php echo Session::get('username'); ?>" class="medium" />
                                <!-----Here session is used so that you can update the userid of post automatically little bit connect to login.php.userid is hidden here---->
                                <input type="hidden" name ="userid" value="<?php echo Session::get('userId'); ?>" class="medium" />
                                <!------------>
                            </td>
                            <!----------------->
                        </tr>
                        </tr>
						<tr>
                            <td></td>
                            <td>
                                <input type="submit" name="submit" Value="Save" />
                            </td>
                        </tr>
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