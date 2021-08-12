<!------This is for post list edit option copy from addpost.php but little bit change and little bit connect to postlist.php-----------!--->
<?php
include "inc/adminheader.php";
include "inc/adminsidebar.php";
?>
<!----For editing checking  the post from post list---->
<?php
if(!isset($_GET['editpostid']) || $_GET['editpostid'] === NULL)
{

  header("Location:postlist.php");
}
else
{
  $postid = $_GET['editpostid'];
}


?>
<!------------------------------>
        <div class="grid_10">
    
            <div class="box round first grid">
                <h2>Edit Post</h2>
<!--For showing from tb_post table the post in the admin panel(add post) in the  field. which you can edit---->
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
        
  if($poscat == "" || $postitle == "" || $posbody == "" || $posautor == "" || $postag == "")
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
          $postquery = "UPDATE tb_post
                    SET
                    categ = '$poscat',
                    title = '$postitle',
                    body = '$posbody',
                    image = '$uploaded_image',
                    author = '$posautor',
                    tags = '$postag',
                    userid = '$userid'
                    WHERE id = '$postid'";
           $updated_rows = $db->update($postquery);//Passing in databaseclass
           ///--------\\\\
           if($updated_rows)
           {
            echo "<span class = 'success'>Post updated successfully.</span>";
           }
           else
           {
            echo "<span class = 'error'>Post not updated .</span>";
           }

      }
}
//--\\\
//When image is empty
else
{
$postquery = "UPDATE tb_post
                    SET
                    categ = '$poscat',
                    title = '$postitle',
                    body = '$posbody',
                    author = '$posautor',
                    tags = '$postag',
                    userid = '$userid'
                    WHERE id = '$postid'";
           $updated_rows = $db->update($postquery);//Passing in databaseclass
           ///--------\\\\
           if($updated_rows)
           {
            echo "<span class = 'success'>Post updated successfully.</span>";
           }
           else
           {
            echo "<span class = 'error'>Post not updated .</span>";
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
                  $query = "SELECT * FROM tb_post WHERE id= $postid";
                  $getpost = $db->select($query);
                  if($getpost)
                  {
                    while($postresult = $getpost->fetch_assoc())
                    {


                 

                ?>              
                 <form action="" method="post" enctype="multipart/form-data">
                    <table class="form">
                       
                        <tr>
                            <td>
                                <label>Title</label>
                            </td>
                            <td>
                                <input type="text" name ="title" value = "<?php echo $postresult['title'];  ?>"  class="medium" />
                            </td>
                        </tr>
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
                                    <option
                                <?php
                                ///For bringing the category in editpost.php page in admin panel by seeing the similarity between tb_post(categ)and tbl_category(id)
                                if($postresult['categ'] == $result['id'])
                                {
                                   echo "selected";//this is by default key word"selected" to show the name of category.///--\\\s

                                }       
                                //---\\\
                                ?> value="<?php echo $result['id']; //$i;//Showing the category by id from tbl_category.Do not use this when you will use $result['id'];  ?>"><?php echo $result['name']; ?></option>
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
                        <!---for bringing the image file and show---->
                              <img src = "<?php echo $postresult['image']; ?> " height = "150px" width ="200px"/><br/>
                        <!---------------->
                                <input type="file" name="image" />
                            </td>
                        </tr>
                        <tr>
                            <td style="vertical-align: top; padding-top: 9px;">
                                <label>Content</label>
                            </td>
                            <td>
                                <textarea class="tinymce" name="body">
                                 <?php echo $postresult['body']; ?>
                                </textarea>
                            </td>
                        </tr>
                            <tr>
                            <td>
                                <label>Tags</label>
                            </td>
                            <td>
                                <input type="text" name ="tags" value = "<?php echo $postresult['tags'];  ?>"class="medium" />
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label>Authors</label>
                            </td>
                            <td>
                                <input type="text" name ="author" value = "<?php echo $postresult['author'];  ?>" class="medium" />
                                <!-----Here session is used so that you can update the userid of post automatically little bit connect to login.php.userid is kept hidden here---->
                                <input type="hidden" name ="userid" value="<?php echo Session::get('userId'); ?>" class="medium" />
                                <!------------>
                            </td>
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