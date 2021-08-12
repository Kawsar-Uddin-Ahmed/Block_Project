<?php
include  'inc/header.php';
include "inc/slider.php";
?>
<!--Showing post details in latest article conneted to post2.php--->
<?php
$postID = mysqli_real_escape_string($db->link,$_GET['id']);
if(!isset($postID) && $postID  == NULL)
{
	echo "<script>window.location='404.php'</script>";
}
else
{
	$id = $postID ;
}

?>
<!----->
  <div class="contentsection contemplete clear">
		<div class="maincontent clear">
			<div class="about">
				<!--Showing post details in --->
				<?php

                  $query = "SELECT * FROM tb_post WHERE id=$id";
                  $post = $db->select($query);
                  if($post)
                  {
                  	while($result = $post->fetch_assoc())
                  	{
                  

				?>
				<!-------------------->
				<!--It will show if you press Readmore option from Home it is little bit connect to index.php-->
				<h2><?php echo $result['title'];?></h2>
				<h4><?php echo $fm->Date($result['date']);?>,By <a href="#"><?php echo $result['author'];?></a></h4>
				<img src="admin/<?php echo $result['image'];?>" alt="post image"/>
				<!--It will print the full text from database--!-->
				<?php echo $result['body'];?>
				<!-------->
				<?php
				/*
				<!------During working for showing post details and Before working for related post . This php blog is given only for the comment not for work.*/?>

				<?php/*
			} ///End of while loop//--\\\
			
	}*/
		/*else
		{
		  header("Location: 404.php");
		} */
		?><!---->
		<!----->
		<!---Working with related post-->
		

				<div class="relatedpost clear">
					<!---For catagory id for related post column---->
					<?php

                    $catid = $result['categ'];
                    $queryrelated = "SELECT * FROM tb_post WHERE id=$catid limit 6";///Related post er ghore sudu highest 6 ta post er photo deka jabe.//--\\\
                  $relatedpost = $db->select($queryrelated);
                   if($relatedpost)
                  {
                  	 while($relatedresult = $relatedpost->fetch_assoc())
                  	{

					?>
					<!----->
				<!---It will show the if the tb_post where the id coloumn and categ column number matches with the tbl_category column id .If the tb_post categ column id is matched with any other id of tb_post table than it will show the related according to the id of tb_post column which is matched with the id of tbl_category ------>
					<h2>Related articles</h2>
					<a href="post.php?id=<?php echo $relatedresult['id'];?>">
				<!---For bringing in the main page from admin panel--->
					<img src="admin/<?php echo $relatedresult['image'];?>" alt="post image"/>
					<!---------------------------->
				    </a>
				    <!--------------------------------->
					
<?php
    
}//End of 2nd loop//--\\\
}//End of 2nd if//--\\\
else
{
	echo "No related post.";
}
?>
<!------>
</div>
<?php 
} ///End of while loop//--\\\
 }//End of if .//--\\\
  else
  {
	  header("Location: 404.php");
	}
	?>
	</div>
		</div>
		<?php
           include "inc/sidebar.php";   
            include "inc/footer.php";       
 
		?>
