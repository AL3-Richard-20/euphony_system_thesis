
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

			<!-- <div class="navbar-header">

		      	<a href="index.php"><img src="../images/default/Euphony_logo.png" class="img-responsive" style="height:60px;"></a>

		    </div> -->

			<ul class="nav navbar-nav navbar-right">

				<!-- li><a onclick="location.href = 'index.php';" title = "Timeline">Timeline</a></li> -->

				<li>
					<a onclick = "location.href='view_profile.php?userid=<?php echo $user_id; ?>';" title = "My Account">

						<?php

							if($profileimg == NULL){

								if($sex == 'Male'){

									echo "<img src='../images/profile_img/Vector_1.png' style = 'height: 30px'> $firstname";
								}
								else if($sex == 'Female'){

									echo "<img src='../images/profile_img/Vector_2.png' style = 'height: 30px'> $firstname";
								}
							}
							
							else{

								echo "<img src='../images/profile_img/$profileimg' style = 'height: 30px'> $firstname";
							}
						?>
						
					</a>
				</li>

				<li><a onclick="location.href = 'index.php';" title = "Home" data-toggle='popover' data-trigger='hover' data-placement="bottom"><i class = "fa fa-home" id = "icons"></i></a></li>

				<!-- <li><a onclick="location.href = '#';" title = "Notifications"><i class="fas fa-bell" id = "icons"></i></a></li> -->

				<!-- <li class="dropdown">
			        <a class="dropdown-toggle" data-toggle="dropdown" href="#" title="Messages"><i class="fas fa-envelope" id = "icons"></i> <span class="badge badge-danger count2"></span></a>
			        <ul class="dropdown-menu messages"></ul>
			    </li> -->

				<li class="dropdown">
					<!-- <a href="administrators.php" class="dropdown-toggle" data-toggle="dropdown"> -->
			        <a href="administrators.php" title="Administrators" data-toggle='popover' data-trigger='hover' data-placement="bottom"> 
			        <span class="fa fa-user" id="icons"></span></a>

			        <!-- <ul class="dropdown-menu">
			        	<li><a href="administrators.php" title = "Administrators"> Administrator/s</a></li>
			        	<li><a href="#" title = "Staffs"> Staffs</a></li>
			        </ul> -->
			    </li>

			    <li class="dropdown">
			        <a class="dropdown-toggle" data-toggle="dropdown" href="#"> More 
			        <span class="caret" id="icons"></span></a>

			        <ul class="dropdown-menu">

			        	<li><a onclick="location.href = 'logs.php';" title = "Logs"><!-- <i class="fas fa-calendar-alt" id = "icons"></i> --> Logs</a></li>

						<li><a onclick="location.href = 'content_management.php';" title = "Settings" data-toggle='popover' data-trigger='hover' data-placement="bottom"><!-- <i class="fas fa-cog" id = "icons"></i> --> Settings</a></li>
			        </ul>
			     </li>

			     <li><a href="#" onclick="trigger();" title = "Log Out?" data-toggle='popover' data-trigger='hover' data-content="Click if Yes" data-placement="bottom"><i class="fa fa-power-off" id = "icons"></i></a></li>

			</ul>

		</div>

	</div>

</nav>