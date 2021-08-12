<?php
include  'inc/header.php';
include 'inc/slider.php';
?>

<style>
.error
{
  color:red;
  float:left;
}

</style>
<!------Contact validation-------------------->
<?php
if($_SERVER['REQUEST_METHOD'] == 'POST')
{
  $firstname = $fm->validation($_POST['firstname']);
  $lastname = $fm->validation($_POST['lastname']);
  $email = $fm->validation($_POST['email']);
  $msg = $fm->validation($_POST['body']);

  $ufirstname = mysqli_real_escape_string($db->link,$firstname);
  $ulastname = mysqli_real_escape_string($db->link,$lastname);
  $uemail = mysqli_real_escape_string($db->link,$email);
  $umsg = mysqli_real_Escape_string($db->link,$msg);

  ///Validationing the system.

  ///For showing the all error message in part by part by different variable.
  $errorfirstname = "";
  $errorlastname = "";
  $erroremail = "";
  $errormessage = "";

  if(empty($ufirstname))
  {
  	$errorfirstname = "First name cannot be empty.";
  }
  if(empty($ulastname))
  {
  	$errorlastname = "Last name cannot be empty.";
  }
  if(empty($uemail))
  {
  	$erroremail = "Email cannot be empty.";
  }
  if(empty($umsg))
  {
  	$errormessage = "Message cannot be empty.";
  }
  //--\\\
 /*
   $error = "";
  if(empty($ufirstname))
  {
       $error = "First name must not be empty.";
  }
  elseif(!filter_var($ufirstname,FILTER_SANITIZE_SPECIAL_CHARS))
  {
  	$error = "Invalid first name .";
  }
  elseif(empty($ulastname))
  {
  	$error = "Last name must not be empty.";
  }
  elseif(!filter_var($ulastname,FILTER_SANITIZE_SPECIAL_CHARS))
  {
  	$error = "Invalid last name .";
  }
  elseif(empty($uemail))
  {
  	$error = "Email field must not be empty.";
  }
  elseif(!filter_var($uemail,FILTER_VALIDATE_EMAIL))
  {
  	$error = "Invalid email.";
  }
  elseif(empty($umsg))
  {
  	$error = "message field must not be empty.";
  }
  elseif(!filter_var($umsg,FILTER_SANITIZE_SPECIAL_CHARS))
  {
  	$error = "Invalid message .";
  }
  */
  else
  {
  	///Inserting in tbl_contact from contact.php.
  	$contactquery = "INSERT INTO tbl_contact(firstname,lastname,email,body) VALUES('$ufirstname','$ulastname','$uemail','$umsg')";
  	$contactinsert_rows = $db->insert($contactquery);
  	if($contactinsert_rows)
  	{
  		$message= "Message sent successfully.";
  	}
  	else
  	{ 
        $error = "Message not sent";
  	} 
  	//--\\\
  //---\\\
  	}
}
?>
<!------------------------------->
<!----For showing another pic in up of main page after going to contact-->
<!------<div class="slidersection templete clear">
        <div id="slider">
         
            <a href="#"><img src="admin/upload/slideshow/04.jpg" alt="nature 2" title="This is slider Two Title or Description" /></a>
            
            
        </div>

</div>----------->
<!----------------------------------->


	<div class="contentsection contemplete clear">
		<div class="maincontent clear">
			<div class="about">
				<h2>Contact us</h2>
				<!--Validationing the system.----->
				<?php
                  if(isset($error))
                  {
                  	echo "<span style='color:red'>$error</span>";
                  }
                  if(isset($message))
                  {
                  	echo "<span style='color:green'>$message</span>";
                  }

				?>
				<!------------------------->
			<form action="" method="post">
				<table>
				<tr>
					<td>Your First Name:</td>
					<td>
            <!--Validationing the system.----->
           <?php 
           if(isset($errorfirstname)){
            echo "<span class='error'>$errorfirstname</span>"; 
             }
           ?>
           <!------------------------->
					<input type="text" name="firstname" placeholder="Enter first name"/>
					</td>
				</tr>
				<tr>
					<td>Your Last Name:</td>
					<td>
            <!--Validationing the system.----->
           <?php 
             if(isset($errorlastname)){
              echo "<span class='error'>$errorlastname</span>"; 
                 }
              ?>
           <!------------------------->
					<input type="text" name="lastname" placeholder="Enter Last name" />
					</td>
				</tr>
				
				<tr>
					<td>Your Email Address:</td>
					<td>
            <!--Validationing the system.----->
           <?php 
             if(isset($erroremail)){
               echo "<span class='error'>$erroremail</span>"; 

              } 
           ?>
            <!------------------------->
					<input type="email" name="email" placeholder="Enter Email Address" />
					</td>
				</tr>
				<tr>
					<td>Your Message:</td>
					<td>
            <!--Validationing the system.----->
           <?php 
             if(isset($errormessage)){
              echo "<span class='error'>$errormessage</span>"; 
                }
              ?>
           <!------------------------->
					<textarea name='body'></textarea>
					</td>
				</tr>
				<tr>
					<td></td>
					<td>
					<input type="submit" name="submit" value="Send"/>
					</td>
				</tr>
		</table>
	<form>				
 </div>

		</div>
<?php
           include "inc/sidebar.php"; 

	     include "inc/footer.php";       
   
		?>
