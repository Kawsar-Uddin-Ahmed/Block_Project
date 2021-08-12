<link rel="stylesheet" href="font-awesome-4.5.0/css/font-awesome.css">	
	<link rel="stylesheet" href="css/nivo-slider.css" type="text/css" media="screen" />
	<link rel="stylesheet" href="style.css">
<!-----Changing the theme little bit connected to theme.php file---------->
<?php
 $themequery = "SELECT * FROM tbl_theme WHERE id='1'";
       $THEME = $db->select($themequery);
        while($themeresult = $THEME->fetch_assoc())
        {
          if ($themeresult['theme'] == 'default') {
?>
 <link rel="stylesheet" href="Theme/default.css">
 <?php } 
 elseif($themeresult['theme'] == 'deepgreen')
 {
?>
<link rel="stylesheet" href="Theme/deepgreen.css">
<?php
}
 elseif($themeresult['theme'] == 'red')
 {
?>
<link rel="stylesheet" href="Theme/red.css">
  <?php
 }
 elseif($themeresult['theme'] == 'lightgreen')
 {
 ?>
 <link rel="stylesheet" href="Theme/lightgreen.css">
 <?php
}
}
 ?>