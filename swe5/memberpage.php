<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">

<!-- jQuery library -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

<!-- Latest compiled JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>

<script >
/* Set the width of the side navigation to 250px and the left margin of the page content to 250px */
function openNav() {
    document.getElementById("mySidenav").style.width = "250px";
    document.getElementById("main").style.marginLeft = "250px";
  }
  
  /* Set the width of the side navigation to 0 and the left margin of the page content to 0 */
  function closeNav() {
    document.getElementById("mySidenav").style.width = "0";
    document.getElementById("main").style.marginLeft = "0";
  }

 </script>
<link rel="stylesheet" href="memberpage.css">


<?php require('include/connection.php'); 
//if not logged in redirect to login page
if(!$user->is_logged_in()){ header('Location: login.php'); exit(); }
//define page title
$title = 'Members Page';
//include header template

?>

<div id="mySidenav" class="sidenav">
  <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
  <a href="#">About</a>
  <a href="#">Services</a>
  <a href="#">Clients</a>
  <a href="#">Contact</a>
</div>


<!-- Use any element to open the sidenav -->

<div id="contentBox" style="margin:0px auto; width:100%">

 <!-- columns divs, float left, no margin so there is no space between column, width=1/3 -->
    <div id="column1" style="float:left; margin:0;">
		<div id="uncollapsedSidenav" class="unsidenav">
			<span onclick="openNav()">
				<img src="./open-iconic/svg/menu.svg" alt="icon name" class="menu"/>
			</span>
		</div>
    </div>

    <div id="column2" style="float:left; margin:0 10px;">

		<div >
				<h2>Member only page - Welcome <?php echo htmlspecialchars($_SESSION['username'], ENT_QUOTES); ?></h2>
				<p><a href='logout.php'>Logout</a></p>
				<hr>

		</div>
    </div>

</div>


<div class="container">

	<div class="column"></div>

	<div class="column">
	
	</div>

	


</div>

