<!DOCTYPE html>
<?php

session_start();

if(!isset($_SESSION['user'])){

    header("Location: login.php");

    exit();

}

?>
<html>

<head>
    <title>Smart Attendance</title>

    <link rel="stylesheet" href="style.css">
</head>

<body>

    <h1>Smart Attendance System</h1>

    <a href="add_student.php">Add Student</a>

    <br><br>

    <a href="students.php">Students List</a>
<br><br>

<a href="scanner.php">
    Open Scanner
</a>
<br><br>

<a href="attendance_report.php">
    Attendance Report
</a>
</body>

</html>
<br><br>

<a href="logout.php">
    Logout
</a>