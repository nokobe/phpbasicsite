<?php  
//register.php  
  
require_once 'includes/global.inc.php';  
  
//initialize php variables used in the form  
$username = "";  
$password = "";  
$password_confirm = "";  
$email = "";  
  
//check to see that the form has been submitted  
if(isset($_POST['submit-form'])) {   
  
    //retrieve the $_POST variables  
    $username = $_POST['username'];  
    $password = $_POST['password'];  
    $password_confirm = $_POST['password-confirm'];  
    $email = $_POST['email'];  
  
    //initialize variables for form validation  
    $success = true;  

    $userTools = new UserTools();  
  
    //validate that the form was filled out correctly  
    if ($username === "") {
	    $message[] = array( 'class' => 'error', 'message' => 'Please enter a username' );
	    $success = false;
    }
    if ($password === "") {
	    $message[] = array( 'class' => 'error', 'message' => 'Please enter a password' );
	    $success = false;
    }
    //check to see if user name already exists  
    if($userTools->checkUsernameExists($username))  {  
        $message[] = array( 'class' => 'error', 'message' => 'That username is already in use' );
        $success = false;  
    }  
  
    //check to see if passwords match  
    if($password != $password_confirm) {
        $message[] = array( 'class' => 'error', 'message' => 'Passwords do not match' );
        $success = false;  
    }

    if ($email === "") {
        $message[] = array( 'class' => 'error', 'message' => 'Please enter your email address' );
        $success = false;  
    }
  
    if($success)  
    {  
        //prep the data for saving in a new user object  
        $data['username'] = $username;  
        $data['password'] = md5($password); //encrypt the password for storage  
        $data['email'] = $email;  
  
        //create the new user object  
        $newUser = new User($data);  
  
        //save the new user to the database  
        $newUser->save(true);  
  
        //log them in  
        $userTools->login($username, $password);  
  
        //redirect them to a welcome page  
        header("Location: welcome.php");
	$message[] = "should not see this message!";
    }  
  
}  
  
//If the form wasn't submitted, or didn't validate  
//then we show the registration form again  
?>  
  
<html>  
<head>  
    <title>PBS: New User Registration</title>  
    <link rel="stylesheet" href="css/style.css" type="text/css" />
</head>  
<body>  
    <?php require "nav.php" ?>
    <form action="register.php" method="post">  
  
    Username: <input type="text" value="<?php echo $username; ?>" name="username" /><br/>  
    Password: <input type="password" value="<?php echo $password; ?>" name="password" /><br/>  
    Password (confirm): <input type="password" value="<?php echo $password_confirm; ?>" name="password-confirm" /><br/>  
    E-Mail: <input type="text" value="<?php echo $email; ?>" name="email" /><br/>  
    <input type="submit" value="Register" name="submit-form" />  
  
    </form>  
</body>  
</html>
