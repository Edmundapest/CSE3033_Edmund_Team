<?php  
session_start(); 

$username=$_SESSION['username'];
 if(isset($_POST["export"]))        
 {  
      $connect = mysqli_connect("localhost", "root", "qwerty123", "breathe");  
      header('Content-Type: text/csv; charset=utf-8');  
      header('Content-Disposition: attachment; filename=data.csv');  
      $output = fopen("php://output", "w");  
      fputcsv($output, array('username', 'activities', 'ActStart', 'ActEnd', 'Priority', 'category'));  
      $query = "SELECT username,activities,ActStart,ActEnd,Priority,category from task Where username='$username' ORDER BY ActID DESC";  
      $result = mysqli_query($connect, $query);  
      while($row = mysqli_fetch_assoc($result))  
      {  
           fputcsv($output, $row);  
      }  
      fclose($output);  
 }  
 ?>  