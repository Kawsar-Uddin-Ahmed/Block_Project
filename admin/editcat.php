<!------This is for category list edit option copy from addcat.php but little bit change and little bit connected to catlist.php-----------!--->
<?php
include "inc/adminheader.php";
include "inc/adminsidebar.php";
?>
<!------For edit or update category list---->
<?php
if(!isset($_GET['catid']) || $_GET['catid'] == NULL)///IF ID IS NOT PRESENT or you want to add something with out catid than it will show this.
{
   echo "<script>window.location='catlist.php'</script>";
   //header("Loctaion:catlist.php");
}
//--\\\
//If id is setted
else
{
  $caid = $_GET['catid'];///From catlist.php
}
//--\\\

?>
<!----->
        <div class="grid_10">
		
            <div class="box round first grid">
                <h2>Edit Category</h2>
               <div class="block copyblock"> 
                 
     <?php
      //For updating category list from add category.
          if($_SERVER['REQUEST_METHOD'] == 'POST')
          {
            $catname = $_POST['name'];
           $cname = mysqli_real_escape_string($db->link,$catname);
           if(empty($cname))
           {
             echo "<span class='error'>Filed must not be empty.</span>";
           }
        
           else
           {
             $upquery = "UPDATE tbl_category SET name = '$catname' WHERE id =$caid";
             $updated_row = $db->update($upquery);
    
             if($updated_row)
             {
               echo "<span class='success'>Category updated successfully.</span>";
             }
             else
             {
              echo "<span class='error'>Category not updated.</span>";
             }
           }

        }
             //--\\\
     ?>

     <!---For going to the edit.php page  after catching the $_GET['catid'] and showing it --->
     <?php
       $query = "SELECT * FROM tbl_category WHERE id = $caid ORDER BY id DESC";
       $category = $db->select($query);
        while($result = $category->fetch_assoc())
        {

     ?>
              <form action = "" method ="post">
                    <table class="form">					
                        <tr>
                            <td>
                                <input type="text" name ="name" value ="<?php echo $result['name'];?>" class="medium" />
                            </td>
                        </tr>
						<tr> 
                            <td>
                                <input type="submit" name="submit" Value="Save" />
                            </td>
                        </tr>
                    </table>
                    </form>
                   <?php } ?>
                   <!------>
                </div>
            </div>
        </div>
        <?php
         include "inc/adminfooter.php";
        ?>