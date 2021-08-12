<!--It is totally different page-->
<!----Here login.php is in a admin folder but include things are in different folder which folder is out of admin folder so here ../ is used to connect with that folder-------!-->
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
<title>Login</title>
    <link rel="stylesheet" type="text/css" href="css/stylelogin.css" media="screen" />
</head>
<body>
<div class="container">
	<section id="content">
		<!---For catching the serever request----->
		<?php
          if($_SERVER['REQUEST_METHOD'] == 'POST')
          {
          	$name = $fm->validation($_POST['username']);
          	$pass = $fm->validation(md5($_POST['password']));

            $name = mysqli_real_escape_string($db->link,$name);//For security.//--\\\
            $pass = mysqli_real_escape_string($db->link,$pass);//For security.//--\\\
           $query = "SELECT * FROM tbl_admin WHERE username ='$name' AND userpass = '$pass'";
           $result = $db->select($query);
            /*if($result != false)
           {
           	$value = mysqli_fetch_array($result);///This for bringing the data given in the database.
                                                 /// The mysql_fetch_array() function returns a row from a recordset as an 
                                                 //     associative array and/or a numeric array//--\\\

            //Actually this is not needed because rows check are done in Database.php
            //select function.//--\\\
           $row = mysqli_num_rows($result);//Row আেছ কীনা তা search korbe.//--\\\
           	///when the server will get the row and checking.
           	 if($row>0)
           	  { 
           	  	///From checkSession() function of Session class.
                Session::set("login",true);
                //--\\\
                ///Database column name..
                Session::set("username",$value['username']);
                Session::set("userId",$value['id']);
                Session::set("userRoll",$value['roll']);//profile.php
                header("Location:adminindex.php"); /*If you write Session::checkLogin() than do not need to write it.*/
                //--\\\*/
           	/*}
           	//--\\\
           	///When the server will not get .
           	 else
           	{
               echo "<span style ='color:red;font-size:18px'>No result found.</span>";
           	}
           	//--\\\
           }
            	else
           	{
           		echo "<span style ='color:red;font-size:18px'>Username or password not matched.</span>";
           	}
           
     
          }
          */
      if($result != false)
           {
            //$value = mysqli_fetch_array($result);
            $value =$result->fetch_assoc();///This for bringing the data given in the database.
            ///From checkSession() function of Session class.
            Session::set("login",true);
            //--\\\
            ///Database column name..
            Session::set("username",$value['username']);
            Session::set("userId",$value['id']);
            Session::set("userRoll",$value['roll']);//profile.php
            header("Location:adminindex.php"); /*If you write Session::checkLogin() than do not need to write it.*/
          //--\\\
          }
     else
        {
          echo "<span style ='color:red;font-size:18px'>Username or password not matched.</span>";
        }
      }
		?>
		<!---->
		<form action="login.php" method="post">
			<h1>Admin Login</h1>
			<div>
				<input type="text" placeholder="Username" required="" name="username"/>
			</div>
			<div>
				<input type="password" placeholder="Password" required="" name="password"/>
			</div>
			<div>
				<input type="submit" value="Log in" />
			</div>
		</form><!-- form -->
		<div class="button">  
      <a href="forgetpass.php">Forget password !</a>
    </div>
    <div class="button">
			<a href="#">Control panel of Kawsar</a>
		</div><!-- button -->
	</section><!-- content -->
</div><!-- container -->
</body>
</html>