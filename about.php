<!--------THis page is created to show page data from the database pages-Little bit connected to header.php---->
<?php
include  'inc/header.php';
?>
<!------Bringing the id from header to catch----->
<?php
if(!isset($_GET['pageid']) || $_GET['pageid'] == NULL)
{
	header("Location:404.php");
}
else
{
	$pageid = $_GET['pageid'];
}
?>
<!--------------------------------------->
	<div class="contentsection contemplete clear">
		<div class="maincontent clear">
			<div class="about">
				<?php
                  $query = "SELECT * FROM tbl_page WHERE id='$pageid'";
                  $newpage = $db->select($query);
                  if($newpage)
                  {
                  	while($result = $newpage->fetch_assoc())
                  	{
				?>
				
				<!----<h2><<a href="<?php //echo $result['id']; ?>"><?php //echo $result['name']; ?></a></h2>--->
				<h2><?php echo $result['name']; ?></h2>
				
				<p><?php echo $result['body']; ?></p>
 <?php }  } ?>
	</div>
		</div>
		<?php
           include "inc/sidebar.php";   
            include "inc/footer.php";       
 
		?>

	