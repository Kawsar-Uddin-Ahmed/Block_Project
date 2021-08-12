        <div class="grid_2">
            <div class="box sidemenu">
                <div class="block" id="section-menu">
                    <ul class="section menu">
                       <li><a class="menuitem">Site Option</a>
                            <ul class="submenu">
                                <li><a href="titleslogan.php">Title & Slogan</a></li>
                                <li><a href="social.php">Social Media</a></li>
                                <li><a href="copyright.php">Copyright(footer text)</a></li>
                                
                            </ul>
                        </li>
						
                         <li><a class="menuitem">Page Option</a>
                            <ul class="submenu">
                    <!-----For opening the page----------------->
                                <li><a href="addpage.php">Add new page</a></li>
                   <!------------------------------------------->
    <!---Bringing from the tbl_page and showing the name of the pages in  it the sidebar ------>
                    <?php
                      $pquery = "SELECT * FROM tbl_page";
                      $newpage = $db->select($pquery);
                      if($newpage)
                      {
                        while($result = $newpage->fetch_assoc())
                        {
                    ?>
                                <li><a href="page.php?pageid=<?php echo $result['id']; ?>"><?php echo $result['name']; ?></a></li>
                            <?php }  } ?> 
                <!------------------------------------------->           
                            </ul>
                        </li>
                        <li><a class="menuitem">Category Option</a>
                            <ul class="submenu">
                <!-----For opening the page----------------->
                                <li>
          <!----Only admin can add category so roll is 0 according to the tbl_admin roll table.little bit connected to login.php and session.php---theory1(Start)----->
                              <?php 
                               if(Session::get('userRoll') == '0')
                              {


                              ?>
                                    <a href="addcat.php">Add Category</a>
                            <?php
                                 }
                                ?>
                                <!----theory1(finish)------>
                                     </li>
                            <li><a href="catlist.php">Category List</a>
                                </li>
        <!-------------------------------------------------->
                            </ul>
                        </li>

                   <!----------For slider option to add slider-------->
                        <li><a class="menuitem">Slider Option</a>
                            <ul class="submenu">
                    <!----Only admin can see add slider option---->
                      <?php
                         if(Session::get('userRoll') == '0'|| Session::get('userRoll') == '1')
                           {
                                 ?>
                            <li><a href="addslider.php">Add Slider</a></li>
                          <?php } ?>
                          <!------------------------------------------>
                            <li><a href="sliderlist.php">Slider List</a></li>
                            </ul>
                        </li>
                        <!----------------------------------------->
                        <li><a class="menuitem">Post Option</a>
                            <ul class="submenu">
                                <!---For opening the page---->
                                <li><a href="addpost.php">Add Post</a> </li>
                                <li><a href="postlist.php">Post List</a> 
                                 <!--------------></li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </div>
        </div>