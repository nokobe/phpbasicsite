<?php   
  
require_once 'includes/global.inc.php';  
  
//check to see if they're logged in  
if(!isset($_SESSION['logged_in'])) { 
    header("Location: index.php"); 
} 
 
//get the user object from the session 
$user = unserialize($_SESSION['user']); 
 
//initialize php variables used in the form 
$saveRequired = false;  
$password = "";  
$password_confirm = "";  
$email = $user->email; 
$message = array();
 
//check to see that the form has been submitted 
if(isset($_POST['submit-settings'])) {  
 
    //retrieve the $_POST variables 
    $password = $_POST['password'];  
    $password_confirm = $_POST['password-confirm'];  
    $email = $_POST['email']; 

    if($password != "") {
	    //check to see if passwords match  
	    if($password != $password_confirm) {  
		$message[] = "Passwords do not match";  
	    }
	    else if ($user->hashedPassword != md5($password)) {
		 $user->hashedPassword = md5($password);
		 $message[] = "password updated";
	         $saveRequired = true;
	    }
    }
    if($user->email != $email) {
	    $user->email = $email; 
	    $message[] = "email updated";
	    $saveRequired = true;
    }
 
    if ($saveRequired)
    {
	    $user->save(); 
    }
    else
    {
	    $message[] = "No change";
    }
} 
    $message[] = "test message";
 
//If the form wasn't submitted, or didn't validate  
//then we show the registration form again  
?>  
  
<html>  
<head>  
    <title>PBS: Change Settings</title>  
    <link rel="stylesheet" href="css/style.css" type="text/css" />
</head>  
<body>  
 <?php require "nav.php" ?>

    <form action="settings.php" method="post">  
    Change Password: <input type="password" value="<?php echo $password; ?>" name="password" /><br/>  
    Change Password (confirm): <input type="password" value="<?php echo $password_confirm; ?>" name="password-confirm" /><br/>  
    E-Mail: <input type="text" value="<?php echo $email; ?>" name="email" /><br/>  
    <input type="submit" value="Update" name="submit-settings" />  
  
    </form>  

    <a href="index.php">Return to main page</a>

</body>  
</html>  
