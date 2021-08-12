<!------This is for Add category in sidebar-----------!--->
<?php
include "inc/adminheader.php";
include "inc/adminsidebar.php";
?>
<!----This is done because only admin can assign in the Add category(Admin panel),এটী করা হেয়েছ যােত কের addcat.php নাম টা tittle bar এ write কের addmin panel e access করা না যাই।----little bit connected to admisidebar.php------->

<?php

  if(!Session::get('userRoll') == '0')
  {
     echo "<script>window.location = 'adminindex.php';</script>";
  }
  ?>

<!----------------->
        <div class="grid_10">
		
            <div class="box round first grid">
                <h2>Add New Category</h2>
               <div class="block copyblock"> 
              <!----For adding new category  in tbl_Category from the add category(Admin panel) in list--->   
     <?php
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
             $query = "INSERT INTO tbl_category(name) VALUES('$cname')";
             $catinsert = $db->insert($query);
             if($catinsert)
             {
               echo "<span class='success'>Category inserted successfully.</span>";
             }
             else
             {
              echo "<span class='error'>Category not inserted successfully.</span>";
             }
           }

        }
     ?>  
     <!----->

                <form action = "" method ="post">
                    <table class="form">					
                        <tr>
                            <td>
                                <input type="text" name ="name" placeholder="Enter Category Name..." class="medium" />
                            </td>
                        </tr>
						<tr> 
                            <td>
                                <input type="submit" name="submit" Value="Save" />
                            </td>
                        </tr>
                    </table>
                    </form>
                </div>
            </div>
        </div>
        <?php
         include "inc/adminfooter.php";
        ?>