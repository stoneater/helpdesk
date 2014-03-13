<?ob_start()?>
<?php
// Initialize the session...
session_start();
// Unset all of the session variables...
session_unset();
$_SESSION = array();
// Finally, destroy the session...
session_destroy();

//Redirect...
Header('Location: index.php');
?>
<?ob_end_flush();?>