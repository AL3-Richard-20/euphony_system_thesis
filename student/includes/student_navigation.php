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

				<li><a onclick="location.href = 'history.php';" title = "My Achievements"><span class = "fa fa-trophy" id = "icons"></span></a></li>

				<li><a onclick="location.href = 'index.php';" title = "Home"><i class = "fa fa-home" id = "icons"></i></a></li>

				<li class="dropdown">

			        <a class="dropdown-toggle" data-toggle="dropdown" href="#">More
			        <span class="caret"></span></a>

			        <ul class="dropdown-menu">
			        	<li><a onclick="location.href = 'payment_transactions.php';" title = "Balances"> Balances</a></li>
						<li><a href="student_profile_settings.php?userid=<?php echo $user_id; ?>" title = "Settings"> Settings</a></li>
			        </ul>

			     </li>

			     <li><a href="#" title = "Help" onclick="sweetAlertSteps();"><i class="fa fa-question" id = "icons"></i></a></li>

			     <li><a href="#" title = "Log Out" onclick="trigger()"><i class="fa fa-power-off" id = "icons"></i></a></li>

			</ul>

		</div>

	</div>

</nav>