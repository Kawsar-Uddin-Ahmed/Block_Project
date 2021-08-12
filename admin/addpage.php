<!---It is used for creating page dynamically. little bit connect to addpost.php page-.Here we will need only title and content--!--->

<?php
include "inc/adminheader.php";
include "inc/adminsidebar.php";
?>
        <div class="grid_10">
		
            <div class="box round first grid">
                <h2>Add New Pages</h2>
<!--For inserting in the tbl_page table from the page in the admin panel(add post) in the  field---->
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

    $addquery = "INSERT INTO tbl_page(name,body) VALUES('$Name','$Body')";
    $inserted_rows = $db->insert($addquery);//Passing in databaseclass
           ///--------\\\\
           if($inserted_rows)
           {
            echo "<span class = 'success'>Page created successfully.</span>";
           }
           else
           {
            echo "<span class = 'error'>Page not created successfully.</span>";
           }

      }


  }


 ?>
                <div class="block">               
                 <form action="addpage.php" method="post">
                    <table class="form">
                       
                        <tr>
                            <td>
                                <label>Name</label>
                            </td>
                            <td>
                                <input type="text" name ="name" class="medium" />
                            </td>
                        </tr>
     <!-------------------------------------------->
                           <tr>
                            <td style="vertical-align: top; padding-top: 9px;">
                                <label>Content</label>
                            </td>
                            <td>
                                <textarea class="tinymce" name="body"></textarea>
                            </td>
                        </tr>
						<tr>
                            <td></td>
                            <td>
                                <input type="submit" name="submit" Value="Submit" />
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