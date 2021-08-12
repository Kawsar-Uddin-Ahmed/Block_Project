<!----This page is for titleslogan in sidebar. It is used to update the title logo and slogan of blog from admin panel .little bit taken some code from editpost.php --!--->
<?php
include "inc/adminheader.php";
include "inc/adminsidebar.php";
?> 
<style>
.leftside
{
    float:left;
    width;70%;
}
.rightside
{
    float:right;
    width;20%;
}
.right img
{
  height:160px;
  width:170px;
}

</style>
       <div class="grid_10">
		
            <div class="box round first grid">
                <h2>Update Site Title and Description</h2>
<!----For catching and updating the values of table tbl_titleslogan from tittle slogan in admin panel------------->
 <?php
    if($_SERVER['REQUEST_METHOD'] == 'POST')
 {
    $vtitle = $fm->validation($_POST['title']);
    $vslogan = $fm->validation($_POST['slogan']);
   $title = mysqli_real_escape_string($db->link,$vtitle);
   $slogan = mysqli_real_escape_string($db->link,$vslogan);
    ///permission of kind of image----
          $permitted = array('jpg','jpeg','png','gif');
          //---\\\
           ///Catching through $_FILE.
          $file_name = $_FILES['logo']['name'];
          $file_size = $_FILES['logo']['size'];
          $file_way = $_FILES['logo']['tmp_name'];
          //---\\\
          ///For uploading different image in same name in pc folder.And pc will generate an unique name for each file---
         $div = explode('.', $file_name);
         //---\\\
         /// Here if the file extension in Capital letter it will be smaller.
         $file_extension = strtolower(end($div));
         //--\\\
         ///it is for the unique name of image . substring is used to make the md5(time()) smaller .here highest 0 to 5 character will print.
        $unique_name = substr(md5(time()), 0, 5).'.'.$file_extension;//All image that you will insert in database will be save in pc folder.///--\\\
        /*$unique_name = substr('logo', 0, 5).'.'.$file_extension;*///It is used so that only image name logo will overwrite Means only the file will store in pc folder which is in the database ,If new image is insereted in database than old image will be removed automatically from the pc folder.///--\\\
        //--\\\
        // Combining the folder with unique_name.If you do this you should not need to the folder name in extra for uploading  the image in pc destinated folder. 
         $uploaded_image = "upload/storeuser/".$unique_name;
         //--\\\
        
  if($title == "" || $slogan == "")
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
          $tsquery = "UPDATE tbl_titleandslogan
                    SET
                    title = '$title',
                    slogan = '$slogan',
                    logo = '$uploaded_image'
                    WHERE id = '1'";
           $updated_rows = $db->update($tsquery);//Passing in databaseclass
           ///--------\\\\
           if($updated_rows)
           {
            echo "<span class = 'success'>Tittle and slogan updated successfully.</span>";
           }
           else
           {
            echo "<span class = 'error'>Tittle and slogan not updated .</span>";
           }

      }
}
//--\\\
//When image is empty
else
{
$tsquery = "UPDATE tbl_titleandslogan
                    SET
                     title = '$title',
                    slogan = '$slogan'
                    WHERE id = '1'";
           $updated_rows = $db->update($tsquery);//Passing in databaseclass
           ///--------\\\\
           if($updated_rows)
           {
            echo "<span class = 'success'>Tittle and slogan updated successfully.</span>";
           }
           else
           {
            echo "<span class = 'error'>Tittle and slogan not updated .</span>";
           }

}
//--\\\
}
  }
 ?>
 <!---------------------------->
 <!-------------For bringing and showing from tbl_tittleslogan in titleslogan in admin panel---------->
<?php

$tsquery = "SELECT * FROM tbl_titleandslogan WHERE id = '1'";
$blog_title = $db->select($tsquery);
if($blog_title)
{
    while($result = $blog_title->fetch_assoc())
    {



 ?>   
                <div class="block sloginblock">
                <div class = "leftside">          
                <form action="titleslogan.php" method="post" enctype="multipart/form-data">
                    <table class="form">					
                        <tr>
                            <td>
                                <label>Website Title</label>
                            </td>
                            <td>
                                <input type="text" value = "<?php echo $result['title']; ?>"  name="title" class="medium" />
                            </td>
                        </tr>
						 <tr>
                            <td>
                                <label>Website Slogan</label>
                            </td>
                            <td>
                                <input type="text" value = "<?php echo $result['slogan']; ?>" name="slogan" class="medium" />
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label>Logo of page</label>
                            </td>
                            <td>
                                <input type="file" value = "<?php echo $result['logo']; ?>" name="logo" class="medium" />
                            </td>
                        </tr>
						 
						
						 <tr>
                            <td>
                            </td>
                            <td>
                                <input type="submit" name="submit" Value="Update" />
                            </td>
                        </tr>
                    </table>
                    </form>
                </div>
                <!------For showing the logo in title and slogan page------------->
                <div class = "rightside">
                 <img src = "<?php echo $result['logo']; ?>" alt = "logo"/>
                 logo
                </div>
                <!------------------>
                </div>
           <?php  } }?>
            </div>
            <!---------------->
        </div>
          <?php
         include "inc/adminfooter.php";
        ?>
