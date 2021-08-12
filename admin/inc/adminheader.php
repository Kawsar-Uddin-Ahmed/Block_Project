<?php
include "../lib/Session.php";
Session::checkSession();//Starting the session here.By using this your admin panel cannot be open without login from any folder//--\\\*/
/*Session::checkLogin();//for login also you can use this with out using init() from Session class.//--\\\*/
?>
<?php
include "../lib/config.php";
include "../lib/Database.php";
include "../helpers/format.php";

?>
<?php

$db = new Database();
$fm = new format();
?>
<!-----For cache control in admin panel category list------->
    <?php
      //set headers to NOT cache a page
      header("Cache-Control: no-cache, must-revalidate"); //HTTP 1.1
      header("Pragma: no-cache"); //HTTP 1.0
      header("Expires: Sat, 26 Jul 1997 05:00:00 GMT"); 
      // Date in the past
      //or, if you DO want a file to cache, use:
      header("Cache-Control: max-age=2592000"); 
    //30days (60sec * 60min * 24hours * 30days)
    ?>
    <!-------->
<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="content-type" content="text/html; charset=utf-8" />
    <title> Control Panel</title>
    <link rel="stylesheet" type="text/css" href="css/reset.css" media="screen" />
    <link rel="stylesheet" type="text/css" href="css/text.css" media="screen" />
    <link rel="stylesheet" type="text/css" href="css/grid.css" media="screen" />
    <link rel="stylesheet" type="text/css" href="css/layout.css" media="screen" />
    <link rel="stylesheet" type="text/css" href="css/nav.css" media="screen" />
    <link href="css/table/demo_page.css" rel="stylesheet" type="text/css" />
    <!-- BEGIN: load jquery -->
    <script src="js/jquery-1.6.4.min.js" type="text/javascript"></script>
    <script type="text/javascript" src="js/jquery-ui/jquery.ui.core.min.js"></script>
    <script src="js/jquery-ui/jquery.ui.widget.min.js" type="text/javascript"></script>
    <script src="js/jquery-ui/jquery.ui.accordion.min.js" type="text/javascript"></script>
    <script src="js/jquery-ui/jquery.effects.core.min.js" type="text/javascript"></script>
    <script src="js/jquery-ui/jquery.effects.slide.min.js" type="text/javascript"></script>
    <script src="js/jquery-ui/jquery.ui.mouse.min.js" type="text/javascript"></script>
    <script src="js/jquery-ui/jquery.ui.sortable.min.js" type="text/javascript"></script>
    <script src="js/table/jquery.dataTables.min.js" type="text/javascript"></script>
    <!-- END: load jquery -->
    <script type="text/javascript" src="js/table/table.js"></script>
    <script src="js/setup.js" type="text/javascript"></script>
	 <script type="text/javascript">
        $(document).ready(function () {
            setupLeftMenu();
		    setSidebarHeight();
        });
    </script>

</head>
<body>
    <div class="container_12">
        <div class="grid_12 header-repeat">
            <div id="branding">
                <div class="floatleft logo">
                    <img src="img/livelogo.png" alt="Logo" />
				</div>
				<div class="floatleft middle">
					<h1>Training with live project</h1>
					<p>www.trainingwithliveproject.com</p>
				</div>
                <div class="floatright">
                    <div class="floatleft">
                        <img src="img/img-profile.jpg" alt="Profile Pic" /></div>
                        <!---For logout----->
            <?php
                if(isset($_GET['action']) && $_GET['action'] == "logout")
                          { 
                                Session:: destroy();

                          }

                        ?>
                        <!--------->
                    <div class="floatleft marginleft10">
                        <ul class="inline-ul floatleft">
                            <li>Welcome to <?php echo Session::get('username'); ?></li>
                            <li><a href="?action=logout">Logout</a></li>
                        </ul>
                    </div>
                </div>
                <div class="clear">
                </div>
            </div>
        </div>
        <div class="clear">
        </div>
        <div class="grid_12">
            <ul class="nav main">
                <li class="ic-dashboard"><a href="adminindex.php"><span>Dashboard</span></a> </li>
                <!------For changing color in font page---------->
                 <li class="ic-dashboard"><a href="theme.php"><span>Change theme</span></a> </li>
                 <!----------------------------------->
                <li class="ic-form-style"><a href="profile.php"><span>User Profile</span></a></li>
				<li class="ic-typography"><a href="changepassword.html"><span>Change Password</span></a></li>
				<li class="ic-grid-tables"><a href="inbox.php"><span>Inbox
     <!-----------For showing the notification of email------------->
                 <?php
                   $query = "SELECT * FROM tbl_contact WHERE status='0' ORDER BY id ASC";
                   $notification = $db->select($query);
                   if($notification)
                   {
                    $count = mysqli_num_rows($notification);
                    echo "(".$count.")";
                   }
                   else
                   {
                    echo "(0)";
                   }
                 ?>
                <!----------------------->
        </span></a></li>
  <!---User Roles and Permission MEANS Only admin can add users.(Only admin can add data in tbl_admin table from admin table) little bit connected to login.php and adduser.php----theory 2(start)----->
  <?php
   if(Session::get('userRoll') == '0')
   {

  ?>
        <!------For add user to assign roles. tbl_admin table- theory 1(start)-->
        <li class="ic-charts"><a href="adduser.php"><span>Add new user</span></a></li>
        <?php
         }
  
        ?>
        <!-----------------Theory 2(Finish)--------------->
        <li class="ic-charts"><a href="userlist.php"><span>User list</span></a></li>
            </ul>
      <!-------------theory 1 (finish)-------------------------------->
        </div>
        <div class="clear">
        </div>
