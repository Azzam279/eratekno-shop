<div class="col-md-10 content">
	<div class="panel panel-default">
		<?php
		if (isset($_GET['azm'])) {
			include_once($_GET['azm'].".php");
		}else{
			echo '<div class="panel-heading">';
			echo '<h4><b>';
			echo "Dashboard";
			echo '</b></h4>';
			echo '</div>';
			echo '<div class="panel-body">';
			echo "Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
		tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
		quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
		consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
		cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
		proident, sunt in culpa qui officia deserunt mollit anim id est laborum.";
			echo '</div>'; 
		}

		?>
	</div>
</div>