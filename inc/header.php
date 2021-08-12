<?php
include "lib/config.php";
include "lib/Database.php";
include "helpers/format.php";

?>
<?php

$db = new Database();
$fm = new format();

?>
<!DOCTYPE html>
<html>
<head>
  <?php include "scripts/meta.php" ; ?>
	<?php include "scripts/css.php"; ?>
	<?php include "scripts/js.php" ; ?>
</head>

<body>
	<div class="headersection templete clear">
		<a href="index.php">
			<div class="logo">
				<!----Bringing the image from tbl_titleandslogan and show it in mainwebsite------->
				<?php
             $tsquery = "SELECT * FROM tbl_titleandslogan WHERE id = '1'";
           $blog_title = $db->select($tsquery);
               if($blog_title)
                  {
                   while($result = $blog_title->fetch_assoc())
                      {
                 
				?>
				<img src="admin/<?php echo $result['logo'];?>" alt="Logo"/>
				<h2><?php echo $result['title'];?></h2>
				<p><?php echo $result['slogan'];?></p>
			<?php } } ?>
			<!-------------------------------->
			</div>
		</a>
		<div class="social clear">
			<div class="icon clear">
				<!--For bringing and joining the link and show it when press in the photo link of main page--------->
				<?php
                  $query = "SELECT * FROM tbl_social WHERE id='1'";
                  $social = $db->select($query);
                  if($social)
                  {
                    while($result = $social->fetch_assoc())
                    {

                ?>
				<a href="<?php echo $result['fb']; ?>" target="_blank"><i class="fa fa-facebook"><img src="admin/upload/facebook.png" height = "25px" width = "25px" alt="Facebook"/></i></a>

				<a href="<?php echo $result['twt']; ?>" target="_blank"><i class="fa fa-twitter"></i><img src="admin/upload/twitter.jpg"
				height = "25px" width = "25px" alt="Twitter"/></a>

				<a href="<?php echo $result['linkedIn']; ?>" target="_blank"><i class="fa fa-linkedin"><img src="admin/upload/linkedin.jpg" height = "25px" width = "25px" alt="LinkedIn"/></i></a>

				<a href="<?php echo $result['google']; ?>" target="_blank"><i class="fa fa-google-plus"><img src="admin/upload/Google.jpeg" height = "25px" width = "25px" alt="Google"/></i></a>
			<?php } } ?>
	<!--------------------------------------------------------------->
			</div>
			<div class="searchbtn clear">
				<!--For using searching box-->
			<form action="search.php" method="post">
				<input type="text" name="search" placeholder="Search keyword..."/>
				<input type="submit" name="submit" value="Search"/>
			</form>
			<!----->
			</div>
		</div>
	</div>
<div class="navsection templete">
<!-------------For highlighting the menu bar little bit connected to format.php title()------------->
	<?php
   $path = $_SERVER['SCRIPT_FILENAME'];//For catching the path where the project is( means localhost/project) and the file name.//--\\\
  $catchpages = basename($path,'.php');

	?>
	<ul>
		<li>
         
			<a 
             <?php
              if($catchpages == 'index')
              {
              	echo "id='active'";
              }
             ?>
			href="index.php">Home</a></li>
	<!---Bringing from the tbl_page and showing the name of the pages in  it the sidebar ------>
                    <?php
                      $pquery = "SELECT * FROM tbl_page";
                      $newpage = $db->select($pquery);
                      if($newpage)
                      {
                        while($result = $newpage->fetch_assoc())
                        {
                    ?>
                   <li><a 
            <?php
           if(isset($_GET['pageid']) && $_GET['pageid'] == $result['id'])
              {
               echo 'id="active"';            
              }

                   
   ?>href="about.php?pageid=<?php echo $result['id']; ?>"><?php echo $result['name']; ?></a></li>
        <?php }  } ?> 
        
    <!---------------------------------------------------------------->
		<li><a <?php
              if($catchpages == 'contact')
              {
              	echo "id='active'";
              }
             ?>href="contact.php">Contact</a></li>
     <!------------------------------------------------>
	</ul>
</div>