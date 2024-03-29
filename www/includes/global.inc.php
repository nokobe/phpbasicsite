<?php  
require_once 'classes/User.class.php';  
require_once 'classes/UserTools.class.php';  
require_once 'classes/DB.class.php';  
require_once 'includes/functions.php';

date_default_timezone_set("Australia/Melbourne");
  
//connect to the database  
$db = new DB();  
$db->connect();  
  
//initialize UserTools object  
$userTools = new UserTools();  
  
//start the session  
session_start();  
  
//refresh session variables if logged in  
if(isset($_SESSION['logged_in'])) {  
    $user = unserialize($_SESSION['user']);  
    $_SESSION['user'] = serialize($userTools->get($user->id));  
}  

$old = set_error_handler('errorHandler');

?>
