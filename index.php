<?php
///All other include are in header.php.--//---\\\
include  'inc/header.php';
include "inc/slider.php";
?>
<?php
///Class object are also in header because you can use every where.
?>

	<div class="contentsection contemplete clear">
		<div class="maincontent clear">
			<!---Pagination catching href = ' ?page='.--->
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
<!----------------------------------------------------------------->


			<?php
			/// LIMIT  means only the row which you will print will come from the table.-//--\\\
               $query = "SELECT * FROM `db_blog`.`tb_post` limit $start, $per_page";
               $getPost = $db->select($query);
               ///if the post is selected than it will print the HTML data.--
               if( $getPost){
               	while($result = $getPost->fetch_assoc())
               	{             

			?>
			<div class="samepost clear">
				<!--Every $result['']is from tbl_post table of dbl_blog database--->
				<h2><a href="post.php?id=<?php echo $result['id'];?>"><?php echo $result['title'];?><!----This title is from database table tbl_post column---></a></h2>
				<h4><?php echo $fm->Date($result['date']);?><!---It will format the date form format class--->By, <a href="#"><?php echo $result['author'];?></a></h4>
				<!--Here all images are uploading from database .the image wich are kept in admin folder sub folder upload.-->
				<!---For bringing in the main page from admin panel--->
				 <a href="#"><img src="admin/<?php echo $result['image'];?>" alt="post image"/></a>
				 <!--------------->
				<?php echo $fm->readmore($result['body']);?><!--It will print the document from body column.Here Read more is used to show just some limit words fixed in readmore() function in format.php file---->
				<div class="readmore clear">
					<a href="post.php?id=<?php echo $result['id'];?>">Read More</a><!--It will show the details writing of the column-->
				</div>
			</div>

<?php
}
?>	<!--end of while loop--->	


<!---Pagination means  Paginaion means showing your query result in multiple pages instead of just put them all in one long page.--->

<?php
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
echo "<a href ='index.php?page=$total_pages'>".'Last Page'."</a></span>"
?>

<!----->

<?php
}

//finish of if() function--\\\
else
{

	header ("Location: 404.php");
}
?>
		</div>
		<?php
           include "inc/sidebar.php";   
            include "inc/footer.php";       
 
		?>

	