<?php

header('Content-Type: application/json');
ob_start();
session_start();
//set timezone
date_default_timezone_set('Europe/London');
//database credentials
define('DBHOST','localhost');
define('DBUSER','root');
define('DBPASS','qwerty123');
define('DBNAME','breathe');
//application address
define('DIR','http://domain.com/');
define('SITEEMAIL','noreply@domain.com');
try {
	//create PDO connection
	$db = new PDO("mysql:host=".DBHOST.";charset=utf8mb4;dbname=".DBNAME, DBUSER, DBPASS);
    //$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_SILENT);//Suggested to uncomment on production websites
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);//Suggested to comment on production websites
    $db->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
  

} catch(PDOException $e) {
	//show error
    echo '<p class="bg-danger">'.$e->getMessage().'</p>';
    exit;
}
	$username= $_SESSION['username'];
 	$statement = $db->prepare("SELECT stressLevel,activities FROM task where username='$username'");
	$statement->execute();
	$results = $statement->fetchAll(PDO::FETCH_ASSOC);
	$json = json_encode($results);
	print $json;
//query to get data from the table


//free memory associated with result


//now print the data



?>