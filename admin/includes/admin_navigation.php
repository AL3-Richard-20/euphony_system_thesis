
<?php include "../includes/help_modal.php"; ?>
<?php include "includes/menu.php"; ?>

<nav class="navbar navbar-default navbar-fixed-top">

	<div class="container">
		
		<div class="navbar-header">
			<button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
			<span class="icon-bar"></span>
			<span class="icon-bar"></span>
			<span class="icon-bar"></span> 
			</button>
		</div>

		<div class="collapse navbar-collapse" id="myNavbar">

			<ul class="nav navbar-nav navbar-right">

				<li><a onclick = "location.href='view_profile.php?userid=<?php echo $user_id; ?>';" title = "My Account"><img src="../images/profile_img/<?php echo $profileimg; ?>" style = "height: 30px"> <?php echo $firstname; ?></a></li>

				<li><a onclick="location.href = 'index.php';" title = "Home"><i class = "fa fa-home" id = "icons"></i></a></li>

				<li><a onclick="location.href = 'POS.php';" title = "POS"><i class="fas fa-shopping-cart" id = "icons"></i></a></li>

				<li class="dropdown">
			        <a class="dropdown-toggle" data-toggle="dropdown" href="#"><i class = "fa fa-user" title = "Records" id = "icons"></i>
			        <span class="caret"></span></a>
			        <ul class="dropdown-menu">
			        	<li><a onclick="location.href = 'students.php';">Students</a></li>
						<li><a onclick="location.href = 'teachers.php';">Teachers</a></li>
			        </ul>
			    </li>

			    <li class="dropdown">

			        <a class="dropdown-toggle" data-toggle="dropdown" href="#"> More 
			        <span class="caret" id="icons"></span></a>

			        <ul class="dropdown-menu">

			        	<li><a href="lesson_passers.php" title = "Graduates">Graduates</a></li>

			        	<li><a onclick="location.href = 'schedule.php';" title = "Schedule">Schedule</a></li>

						<li><a onclick="location.href = 'inventory.php';" title = "Inventory">Inventory</a></li>

						<li><a onclick="location.href = 'reports_menu.php';" title = "Reports">Reports</a></li>

						<li><a onclick="openHelp();" title = "Help">Help</a></li>

			        </ul>

			     </li>

				<li><a href="#" onclick="trigger()" title = "Log Out"><i class="fas fa-power-off" id = "icons"></i></a></li>

			</ul>

		</div>

	</div>
	
</nav>

<script>
	
	function openHelp(){

		$('#helpModal').modal();
	}
	
</script>