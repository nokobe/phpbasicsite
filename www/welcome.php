<?php
//welcome.php

require_once 'includes/global.inc.php';

//check to see if they're logged in
if(!isset($_SESSION['logged_in'])) {
    header("Location: index.php");
}

//get the user object from the session
$user = unserialize($_SESSION['user']);
?>

<html>
<head>
    <title>PBS: Welcome <?php echo $user->username; ?></title>
</head>
<body>
 <?php require "nav.php" ?>
	Hey there, <?php echo $user->username; ?>. You've been registered and logged in. Welcome! <a href="index.php">Go to Homepage</a>
</body>
</html>
