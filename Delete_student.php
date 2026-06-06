<?php
require_once('db.php');
$id=$_GET['id'];
$query="DELETE FROM Students Where id=$id";
mysqli_query($conn,$query);
$query="DELETE FROM users Where username=$id";
mysqli_query($conn,$query);
header("Location: students.php");
exit();
 ?>