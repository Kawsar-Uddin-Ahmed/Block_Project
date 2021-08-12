<!------This page is created to view the post this is little bit connected to the postlist.php-------->
<?php
include "inc/adminheader.php";
include "inc/adminsidebar.php";
?>
<!----For editing checking  the post from post list---->
<?php
if(!isset($_GET['viewpostid']) || $_GET['viewpostid'] === NULL)
{

  header("Location:postlist.php");
}
else
{
  $viewid = $_GET['viewpostid'];
}


?>
<!------------------------------>
        <div class="grid_10">
    
            <div class="box round first grid">
                <h2>View Post</h2>
<!--For showing from tb_post table the post in the admin panel(add post) in the  field. which you can edit---->
<?php
    if($_SERVER['REQUEST_METHOD'] == 'POST')
 {
  
  }


 ?>
 <!-------------------------------------------->
                <div class="block"> 
          <!---For brining to the Edit post page from post list in admin panel-------->
                <?php
                  $query = "SELECT * FROM tb_post WHERE id= $viewid ORDER BY id";
                  $viewpost = $db->select($query);
                  if($viewpost)
                  {
                    while($viewresult = $viewpost->fetch_assoc())
                    {


                 

                ?>              
                 <form action="" method="post" enctype="multipart/form-data">
                    <table class="form">
                       
                        <tr>
                            <td>
                                <label>Title</label>
                            </td>
                            <td>
                                <input type="text" readonly name ="title" value = "<?php echo $viewresult['title'];  ?>"  class="medium" />
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label>Category</label>
                            </td>
                            <td>
                                <select id="select" readonly>
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
                                if($viewresult['categ'] == $result['id'])
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
                                <label>Image</label>
                            </td>
                            <td>
                        <!---for bringing the image file and show---->
                              <img src = "<?php echo $viewresult['image']; ?> " height = "150px" width ="200px"/><br/>
                        <!---------------->
                            </td>
                        </tr>
                        <tr>
                            <td style="vertical-align: top; padding-top: 9px;">
                                <label>Content</label>
                            </td>
                            <td>
                                <textarea class="tinymce" readonly name="body">
                                 <?php echo $viewresult['body']; ?>
                                </textarea>
                            </td>
                        </tr>
                            <tr>
                            <td>
                                <label>Tags</label>
                            </td>
                            <td>
                                <input type="text" readonly name ="tags" value = "<?php echo $viewresult['tags'];  ?>"class="medium" />
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label>Authors</label>
                            </td>
                            <td>
                                <input type="text" readonly name ="author" value = "<?php echo $viewresult['author'];  ?>" class="medium" />
                                <!-----Here session is used so that you can update the userid of post automatically little bit connect to login.php.userid is kept hidden here---->
                                <input type="hidden" name ="userid" value="<?php echo Session::get('userId'); ?>" class="medium" />
                                <!------------>
                            </td>
                        </tr>
                        </tr>
            <tr>
                            <td></td>
                            <td>
                                <input type="submit" name="submit" Value="OK" />
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