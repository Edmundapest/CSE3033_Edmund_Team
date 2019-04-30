<?php require('include/connection.php');
//logout
$user->logout(); 
//logged in return to index page
header('Location: index.php');
exit;
?>