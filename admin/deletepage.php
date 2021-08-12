<!------This is for PAGE list delete option full new file little bit connect to page.php-----------!--->
<?php
include "../lib/Session.php";
Session::checkSession();//Starting the session here.//--\\\*/
/*Session::checkLogin();//for login also you can use this with out using init() from Session class.//--\\\*/
?>
<?php
include "../lib/config.php";
include "../lib/Database.php";
include"../helpers/format.php";
?>
<?php

$db = new Database();
$fm = new format();
?>
<!----For deleting checking  the pages from page list---->
<?php
if(!isset($_GET['delid']) || $_GET['delid'] === NULL)
{

  header("Location:page.php");
}
else
{
  $delpageid = $_GET['delid'];
  
  $delquery = "DELETE FROM tbl_page WHERE id = '$delpageid'";
  $delData = $db->delete($delquery);
  if($delData)
  {
  	echo "<script>alert('Page deleted successfully');</script>";
  	echo "<script>window.location = 'adminindex.php';</script>";
  }
  else
  {
    echo "<script>alert('Page not deleted.');</script>";
  	echo "<script>window.location = 'adminindex.php';</script>";

  }
}



?>
<!------------------------------>