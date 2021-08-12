<?php
///All other include are in header.php.--//---\\\
include  'inc/header.php';

?>
<?php
$per_page =3;
if(isset($_GET["page"]))
{
	$page = $_GET["page"];
}
else
{
	$page = 1;
}
$start = ($page-1)*$per_page;
?>
<!--Search details of search box--->
<?php
$SearchID = mysqli_real_escape_string($db->link,$_POST['search']);
if(!(isset($SearchID) || $SearchID === NULL))///Here $_POST is used because in header folder the method of search paragraph is post.//--\\\
{
	//header("Location:404.php");
	echo "<script>window.location='404.php';</script>";
}
else
{
	$search = $SearchID;
}

?>
<div class="contentsection contemplete clear">
		<div class="maincontent clear">
			<?php
			 $query = "SELECT * FROM tb_post WHERE title LIKE '%$search%' OR body LIKE '%$search%'";
               $getPost = $db->select($query);
               ///if the post is selected than it will print the HTML data.--
               if( $getPost){
               	while($result = $getPost->fetch_assoc())
               	{       
               	?>      
               	<!----->   
	<div class="samepost clear">
				
				<h2><a href="post.php?id=<?php echo $result['id'];?>"><?php echo $result['title'];?><!----This title is from database table tbl_post column--!--></a></h2>
				<h4><?php echo $fm->Date($result['date']);?><!---It will format the date form format class--->By, <a href="#"><?php echo $result['author'];?></a></h4>
				<!--Here all images are uploading from database .the image wich are kept in admin folder sub folder upload.!-->
				 <a href="#"><img src="admin/<?php echo $result['image'];?>" alt="post image"/></a>
				<?php echo $fm->readmore($result['body']);?><!--It will print the document from body column.Here Read more is used to show just some limit words fixed in readmore() function in format.php file---!---->
				<div class="readmore clear">
					<a href="post.php?id=<?php echo $result['id'];?>">Read More</a>
				</div>
			</div>

<?php
}
///Bringing Data from database.//--\\\
$q = "SELECT * FROM `db_blog`.`tb_post` ";
$result = $db->select($q);
$total_rows = mysqli_num_rows($result);
$total_pages = ceil($total_rows/$per_page);
//--\\\
echo "<span class = 'pagination'><a href ='index.php?page =1'>".'First Page'."</a>";
for($i=1;$i<=$total_pages;$i++)
{
	echo "<a href ='index.php?page=".$i."'>".$i."</a>";
}
echo "<a href ='index.php?page=$total_pages'>".'Last Page'."</a></span>";

}
//finish of if() function--\\\
else
{
?>
<p> Your Search option is not found.</p>
<?php
	
}
?>
</div>
		<?php
           include "inc/sidebar.php";   
            include "inc/footer.php";       
 
		?>