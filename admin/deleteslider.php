<!-------This page is created to delte the slider from admin panel.
It is little bit connected to sliderlist.php page--------->

<?php
include "../lib/Session.php";
Session::checkSession();//Starting the session here.//--\\\*/
/*Session::checkLogin();//for login also you can use this with out using init() from Session class.//--\\\*/
?>
<?php
include "../lib/config.php";
include "../lib/Database.php";

?>
<?php

$db = new Database();
?>
<!----For deleting checking  the post from post list---->
<?php
if(!isset($_GET['deletesliderid']) || $_GET['deletesliderid'] === NULL)
{

 echo "<script>window.location = 'adminindex.php';</script>";
}
else
{
  $delsliderid = $_GET['deletesliderid'];
  $getsliderquery = "SELECT * FROM tbl_slider WHERE id='$delsliderid'";
  $getslider = $db->select($getsliderquery);
  if($getslider)
  {
  	while($delimage = $getslider->fetch_assoc())
  	{
  		$dellink = $delimage['image'];
  	    unlink($dellink);//It will delete the photo from the pc folder also.//--\\\
  	}
  }


  $delsliderquery = "DELETE FROM `db_blog`.`tbl_slider` WHERE id='$delsliderid'";
  $delslider = $db->delete($delsliderquery);
  if($delslider)
  {
  	echo "<script>alert('Slider deleted successfully');</script>";
  	echo "<script>window.location = 'sliderlist.php';</script>";
  }
  else
  {
    echo "<script>alert('Slider not deleted.');</script>";
  	echo "<script>window.location = 'sliderlist.php';</script>";

  }
}
?>
<!------------------------------>