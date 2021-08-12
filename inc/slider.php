
<div class="slidersection templete clear">
        <div id="slider" >
        	<!------For showing the slide in font view--------->
        	<?php
              $slidequery = "SELECT * FROM tbl_slider ORDER BY id LIMIT 1";
              $slideshow = $db->select($slidequery);
              if($slideshow)
              {
              	while($slideresult = $slideshow->fetch_assoc())
              	{

           ?>
            <a href="#" class="nivo-imageLink" style="display: block;"><img src="admin/<?php echo $slideresult['image']; ?>" alt="<?php echo $slideresult['title']; ?>" title="<?php echo $slideresult['title']; ?>"/></a>

            
            
            <?php
        } 
    }
    ?>
    <!----------------------------->   
        </div>

</div>