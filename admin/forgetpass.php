<!------This page is for forget password .little bit connected to login.php--!---->

<?php
include "../lib/Session.php";
Session::init();//Starting the session here.//--\\\*/
/*Session::checkLogin();//for login also you can use this with out using init() from Session class.//--\\\*/
?>
<?php
include "../lib/config.php";
include "../lib/Database.php";
include "../helpers/format.php";


?>
<?php

$db = new Database();
$fm = new format();

?>
<!DOCTYPE html>
<head>
<meta charset="utf-8">
<title>Password Recovery</title>
    <link rel="stylesheet" type="text/css" href="css/stylelogin.css" media="screen" />
</head>
<body>
<div class="container">
	<section id="content">
		<!---For catching the serever request----->
		<?php
          if($_SERVER['REQUEST_METHOD'] == 'POST')
          {
          	$vemail = $fm->validation($_POST['email']);
            $email = mysqli_real_escape_string($db->link,$vemail);//For security.//--\\\
            //For email validation.
            if(!filter_var($email,FILTER_VALIDATE_EMAIL))
             {
  	           echo "<span style ='color:red'>Invalid Email address.</span>";
              }
              //--\\\
              else
              {
               $emailquery = "SELECT * FROM tbl_admin WHERE email='$email' limit 1";
              $mailcheck = $db->select($emailquery);
            if($mailcheck != false)
           {
            while($value = $mailcheck->fetch_assoc())
            {
            	$userid = $value['id'];
            	$username = $value['username'];

            }
            //Generating password.
             $text = substr($email,0,3);
              $newpass = rand(1000,99999);
              $generate = "$text$rand";
              //keeping in database.
              $password = md5($generate);
              $updatequery = "UPDATE tbl_admin
                              SET
                              userpass = '$password'
                              WHERE id='$userid'";
              $updating = $db->update($updatequery);
              $to = '$email';
              $from = 'kawsaruddin238@gmail.com';
              $headers = "From: $from\n";
              // To send HTML mail, the Content-type header must be set
              $headers.= 'MIME-Version: 1.0'."\r\n";
              $headers.= 'Content-type: text/html; charset=iso-8859-1'."\r\n";
              $subject = "Your lost password";
              $message = "Your user name is ".$username."and password".$newpass."Please visit the login.";
              $sendmail = mail($to, $subject, $message,$headers);

              if($sendmail)
              {
              echo "<span style ='color:green;font-size:18px'>Mail Sent</span>";
              }
              else
              {
               echo "<span style ='color:red;font-size:18px'>Mail not sent.</span>";
              }
              }
               else
              {
               echo "<span style ='color:red;font-size:18px'>Email not exist</span>";
              }
            //--\\
            //--\\\
          }
        }
		?>
		<!---->
		<form action="" method="post">
			<h1>Password Recovery</h1>
			<div>
				<input type="text" placeholder="Enter the Valid Email address" required="" name="email"/>
			</div>
			
			<div>
				<input type="submit" value="Send mail" />
			</div>
		</form><!-- form -->
		<div class="button">  
      <a href="login.php">Login</a>
    </div>
    <div class="button">
			<a href="#">Control panel of Kawsar</a>
		</div><!-- button -->
	</section><!-- content -->
</div><!-- container -->
</body>
</html>