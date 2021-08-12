<!---------This table is used to show the data from tbl_admin table to Add user option of admin panel . Little bit conneted to adminheader.php file---------!------->

<?php
include "inc/adminheader.php";
include "inc/adminsidebar.php";
?>
<!----This is done because only admin can assign in the Add new User(Admin panel),এটী করা হেয়েছ যােত কের adduser.php নাম টা tittle bar এ write কের addmin panel e access করা না যাই।----little bit connected to adminheader.php------->
<?php
 if(!Session::get('userRoll') == '0')//if the useroll is not 0 than this will happen
 {

 echo "<script>window.location = 'adminindex.php';</script>";

 }
 //--\\\
?>
<!--------------------------------------->
        <div class="grid_10">
		
            <div class="box round first grid">
                <h2>Add New User</h2>
               <div class="block copyblock"> 
              <!----For adding new user  in tbl_admin from the add user(Admin panel) in list--->   
     <?php
          if($_SERVER['REQUEST_METHOD'] == 'POST')
          {
           $vusername = $fm->validation($_POST['username']);
           $vpassword = $fm->validation(md5($_POST['userpass']));
           $vroll = $fm->validation($_POST['roll']);
           $vemail = $fm->validation($_POST['email']);
           $username = mysqli_real_escape_string($db->link,$vusername);
           $password = mysqli_real_escape_string($db->link,$vpassword);
           $roll = mysqli_real_escape_string($db->link,$vroll);
           $email = mysqli_real_escape_string($db->link,$vemail);

           if(empty($username) || empty($password) || empty($roll) || empty($email))
           {
             echo "<span class='error'>Filed must not be empty.</span>";
           }
           else 
           {
           $emailquery = "SELECT * FROM tbl_admin WHERE email='$email' limit 1";
           $mailcheck = $db->select($emailquery);
           if($mailcheck != false)
           {
           echo "<span class='error'>Mail already exists.</span>";
           }
           else
           {
             $query = "INSERT INTO tbl_admin(username,userpass,email,roll) VALUES('$username','$password','$email','$roll')";
             $valueinsert = $db->insert($query);
             if($valueinsert)
             {
               echo "<span class='success'>User created  successfully.</span>";
             }
             else
             {
              echo "<span class='error'>User not created inserted successfully.</span>";
             }
           }
        }

        }
     ?>  
     <!----->

                <form action = "" method ="post">
                    <table class="form">					
                        <tr>
                        	<td>
                              <label>Username</label>
                        	</td>
                            <td>
                                <input type="text" name ="username" placeholder="Enter username..." class="medium" />
                            </td>
                        </tr>
                        <tr>
                        	<td>
                              <label>Password</label>
                        	</td>
                            <td>
                                <input type="text" name ="userpass" placeholder="Enter userpass..." class="medium" />
                            </td>
                        </tr>
                        <tr>
                          <td>
                              <label>Email</label>
                          </td>
                            <td>
                                <input type="text" name ="email" placeholder="Enter user email..." class="medium" />
                            </td>
                        </tr>
                        <tr>
                        	<td>
                              <label>User roll</label>
                        	</td>
                            <td>
                                <select id='select' name='roll'>
                                  <option >Select the roll</option>
                                  <option value ='0'>Admin</option>
                                  <option value ='1'>Author</option>
                                  <option value ='2'>Editor</option>
                                </select>
                            </td>
                        </tr>
						<tr> 
							<td></td>
                            <td>
                                <input type="submit" name="submit" Value="Create" />
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