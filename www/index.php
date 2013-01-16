<?php  
//index.php   
require_once 'includes/global.inc.php';  
?>  
  
<html>  
<head>  
    <title>PBS: Homepage</title>  
    <link rel="stylesheet" href="css/style.css" type="text/css" />
</head>  
<body>  
 <?php require "nav.php" ?>
  
<?php
if(isset($_SESSION['logged_in'])) {
	$user = unserialize($_SESSION['user']);
}
?>  

<div id='main'>
	MAIN PAGE
</div>
  
</body>  
</html>  
