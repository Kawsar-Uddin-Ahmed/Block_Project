<!------This is for post list delete option full new file little bit connect to postlist.php-----------!--->
<?php
include "../lib/Session.php";
Session::checkSession();//Starting the session here.//--\\\*/
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
<!----For deleting checking  the post from post list---->
<?php
if(!isset($_GET['deletepostid']) || $_GET['deletepostid'] === NULL)
{

  header("Location:postlist.php");
}
else
{
  $delpostid = $_GET['deletepostid'];
  $getquery = "SELECT * FROM tb_post WHERE id = '$delpostid'";
  $getData = $db->select($getquery);
  if($getData)
  {
  	while($delimage = $getData->fetch_assoc())
  	{
  		$dellink = $delimage['image'];
  	    unlink($dellink);//It will delete the photo from the pc folder also.//--\\\
  	}
  }


  $delquery = "DELETE FROM tb_post WHERE id = '$delpostid'";
  $delData = $db->delete($delquery);
  if($delData)
  {
  	echo "<script>alert('Data deleted successfully');</script>";
  	echo "<script>window.location = 'postlist.php';</script>";
  }
  else
  {
    echo "<script>alert('Data not deleted.');</script>";
  	echo "<script>window.location = 'postlist.php';</script>";

  }
}



?>
<!------------------------------>