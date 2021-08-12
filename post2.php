<?php
///All other include are in header.php.--//---\\\
include  'inc/header.php';
include "inc/slider.php";
?>
<!---For connecting with tb_post and tbl_category through post.php page-->
<?php
$CatID = mysqli_real_escape_string($db->link,$_GET['category']);
if(!(isset($CatID)) || $CatID === NULL)
{
	header("Location: 404.php");
}
else
{
	$id = $CatID;
}

?>
<div class="contentsection contemplete clear">
		<div class="maincontent clear">
			<?php
			 $query = "SELECT * FROM tb_post WHERE categ=$id ";///It will select according to categ column as a id //--\\\
               $getPost = $db->select($query);
               ///if the post is selected than it will print the HTML data.--
               if( $getPost){
               	while($result = $getPost->fetch_assoc())
               	{       
               	?>      
	<div class="samepost clear">
				
				<h2><a href="post.php?id=<?php echo $result['id'];?>"><?php echo $result['title'];?><!----This title is from database table tbl_post column---></a></h2>
				<h4><?php echo $fm->Date($result['date']);?><!---It will format the date form format class--->By, <a href="#"><?php echo $result['author'];?></a></h4>
				<!--Here all images are uploading from database .the image wich are kept in admin folder sub folder upload.-!-->
				<!---For bringing in the main page from admin panel--->
				 <a href="#"><img src="admin/<?php echo $result['image'];?>" alt="post image"/></a>
				 <!-------->
				<?php echo $fm->readmore($result['body']);?><!--It will print the document from body column.Here Read more is used to show just some limit words fixed in readmore() function in format.php file---->
				<div class="readmore clear">
					<a href="post.php?id=<?php echo $result['id'];?>">Read More</a>
				</div>
			</div>

<?php
}
}
//finish of if() function--\\\
else
{
///header("Location:404.php");
echo "<h3>No post avaiable for this category.</h3>";
}
?>
<!------>
</div>
		<?php
           include "inc/sidebar.php";   
            include "inc/footer.php";       
 
		?>