<!--This file is created to show the list of the slider in admin panel.This is little bit connected to adminsidebar.php and addsider.php-------->
	<?php
include "inc/adminheader.php";
include "inc/adminsidebar.php";
?>
        <div class="grid_10">
            <div class="box round first grid">
                <h2>Slider List</h2>
                <div class="block">  
                    <table class="data display datatable" id="example">
					<thead>
						<tr>
							<th>No</th>
							<th>Slider Title</th>
							<th>Slider Image</th>
							<th>Action</th>
						</tr>
					</thead>
					<tbody>
						<!--For bringing the All data from tbl_slider table  show it in admin panel(post list)-->
						<?php
                         $sliderquery = "SELECT * FROM tbl_slider";
                             $slider = $db->select($sliderquery);
                             if($slider)
                             {
                             	$i=0;
                             	while($sliderresult = $slider->fetch_assoc())
                             	{
                             		$i++;
						?>
						<tr class="odd gradeX">
							<td><?php echo $i; ?></td>
							<td> <?php echo $sliderresult['title'];?></td>
							<td><img src="<?php echo $sliderresult['image']?>"height = "40px" width = "60px"/></td>
							<td>
								 <?php
                                 if(Session::get('userRoll') == '0')
                                 {
                              ?>
								<a href="editsilder.php?editsliderid=<?php echo $sliderresult['id'];?>">Edit</a> 
								  || <a onclick="return confirm('Are your sure to delete');
								  " href="deleteslider.php?deletesliderid=<?php echo $sliderresult['id'];?>">Delete</a>
                                <?php }
                                ?>
                               
							</td>
							<!----------------------------->
						</tr>
						<?php
                         }
                     }
						?>
					</tbody>
					<!-------------------------------------->
				</table>
	
               </div>
            </div>
        </div>
        <script type="text/javascript">
        $(document).ready(function () {
            setupLeftMenu();
            $('.datatable').dataTable();
			setSidebarHeight();
        });
    </script>
        <div class="clear">
        </div>
    </div>
     <?php
         include "inc/adminfooter.php";
        ?>
