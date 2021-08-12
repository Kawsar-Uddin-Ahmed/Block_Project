<div class="footersection templete clear">
	  <div class="footermenu clear">
		<ul>
			<li><a href="#">Home</a></li>
			<li><a href="#">About</a></li>
			<li><a href="#">Contact</a></li>
			<li><a href="#">Privacy</a></li>
		</ul>
	  </div>
	  <!---Bringing the data from the tbl_copyright table and showing it to the footer of main page--->
                    <?php
                     $cquery = "SELECT * FROM tbl_copyright WHERE id='1'";
                     $copy = $db->select($cquery);
                     if($copy)
                     {
                        while($result = $copy->fetch_assoc())
                        {

                    ?>
	  <p><?php echo $result['note']," "; echo date('d.m.Y');?></p>
	<?php } } ?>
	<!------------------------------------------>
	</div>
	<div class="fixedicon clear">
		<!--For bringing and joining the link and show it when press in the photo(situated in left side) link of main page--------->
				<?php
                  $query = "SELECT * FROM tbl_social WHERE id='1'";
                  $social = $db->select($query);
                  if($social)
                  {
                    while($result = $social->fetch_assoc())
                    {

                ?>
		<a href="<?php echo $result['fb']; ?>" target="_blank"><img src="admin/upload/fb.png" alt="Facebook"/></a>
		<a href="<?php echo $result['twt']; ?>" target="_blank"><img src="admin/upload/tw.png" alt="Twitter"/></a>
		<a href="<?php echo $result['linkedIn']; ?>" target="_blank"><img src="admin/upload/in.png" alt="LinkedIn"/></a>
		<a href="<?php echo $result['google']; ?>" target="_blank"><img src="admin/upload/gl.png" alt="Google"/></a>
	<?php  } } ?>
		<!------------------------------------->
	</div>
<script type="text/javascript" src="js/scrolltop.js"></script>
</body>
</html>