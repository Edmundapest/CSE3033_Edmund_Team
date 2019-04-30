<?php

 
//including the database connection file
include("include/connection.php");
//getting id of the data from url
  $id = $_GET['id'];
$stmt= "DELETE FROM task WHERE ActID=$id";
//deleting the row from table
$result = $db->query($stmt);
 
//redirecting to the display page (index.php in our case)
header("Location:manage.php");