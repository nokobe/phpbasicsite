<div class='pagenav'>
	<div id='title'><a href="index.php">PBS Home</a></div>
	<div id='login'>
		<?php
		if(isset($_SESSION['logged_in'])) {
			$user = unserialize($_SESSION['user']);
			print "Welcome, ".$user->username." | <a href=\"settings.php\">Settings</a> | <a href=\"logout.php\">Logout</a>";
		} else {
			print "You are not logged in. <a href=\"login.php\">Log In</a> to allow changes | <a href=\"register.php\">New user</a>";
		}
		?>
	</div>
</div>

<div class='notices'>
	<?php
	    foreach ($message as $m) {
		    if (gettype($m) == 'array') {
			    echo "<div class=\"$m[class]\">$m[message]</div>";
		    } else {
			    echo "<div class='info'>$m</div>";
		    }
	    }
	?>
</div>
