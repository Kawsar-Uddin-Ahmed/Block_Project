  <!---For statically showing the tittle means the page I enter the name of the page will be in the title.This is done by catching id pf each value---->
  <!-----<?php/*
      if(isset($_GET['pageid']))
      {
        $pagetitleid = $_GET['pageid'];
        $pquery = "SELECT * FROM tbl_page WHERE id=$pagetitleid";
        $newpage = $db->select($pquery);
        if($newpage)
          {
               while($result = $newpage->fetch_assoc())
            {*/
     ?>--->
   <!--- <title><?php //echo $result['name']; ?> - <?php //echo TITLE; ?></title>--->
 <!-----<?php // }  } } else { ?>----->
  <!----<title><?php //echo "Home"; ?> - <?php //echo TITLE;  ?></title>------>
<!---<?php //} ?>---->
<!------------------------------------------------------->
<!----For dymacially showing the tittle means the page I enter the name of the page will be in the title.This is done by without catching id means all time each value.---------->
<?php
      if(isset($_GET['pageid']))
      {
        $pagetitleid = $_GET['pageid'];
        $pquery = "SELECT * FROM tbl_page WHERE id=$pagetitleid";
        $newpage = $db->select($pquery);
        if($newpage)
          {
               while($result = $newpage->fetch_assoc())
            {
     ?>
    <title><?php echo $result['name']; ?> - <?php echo TITLE; ?></title>
<?php  }  } } 
//For showing the title when post is click little bit check the post2.php and sidebar.php.
elseif(isset($_GET['category']))
      {
        $Latestposttitleid = $_GET['category'];
        $latestquery = "SELECT * FROM tb_post WHERE id=$Latestposttitleid";
        $latestpost = $db->select($latestquery);
        if($latestpost)
          {
               while($postitle = $latestpost->fetch_assoc())
            {
     ?>
  <title><?php echo $postitle['title']; ?> - <?php echo TITLE; ?></title>
<?php  }  } }
///---\\\\

else { ?>
  <title><?php echo $fm->title(); ?> - <?php echo TITLE;  ?></title>
<?php } ?>
<!--------------------------------------------------->

  <meta name="language" content="English">
  <!------For Adding Meta Keywords/Tags to Individual Post. little bit connected to config.php------------------------>
  <meta name="description" content="It is a website about education">
  <!-----For showing just meta keywords---------->
  <?php
  if(isset($_GET['id']))
  {
    $keywordid = $_GET['id'];
    $metakeywordquery = "SELECT * FROM tb_post WHERE id='$keywordid'";
    $addmetakeyword = $db->select($metakeywordquery);
    if($addmetakeyword)
    {
      while($result = $addmetakeyword->fetch_assoc())
      {
 
      ?>
    <meta name="keywords" content="<?php echo $result['tags']; ?>">

  <?php
    }
  }
}
  else
  {
?>
<meta name="keywords" content="<?php echo KEYWORDS; ?>">
<?php
  }
?>
<!-------------------------->
<!-----For showing just meta author---------->
<?php
  if(isset($_GET['id']))
  {
    $authorid = $_GET['id'];
    $metaauthorquery = "SELECT * FROM tb_post WHERE id='$keywordid'";
    $addmetaauthor = $db->select($metaauthorquery);
    if($addmetaauthor)
    {
      while($result = $addmetaauthor->fetch_assoc())
      {
 
      ?>
    <meta name="author" content="<?php echo $result['author']; ?>">

  <?php
    }
  }
}
  else
  {
?>
<meta name="author" content="<?php echo AUTHOR ;  ?>">
<?php
  }
  ?>
 <!-------------------------->
<!------------------------------------------------------------------->