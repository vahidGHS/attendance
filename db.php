<?php

$conn = mysqli_connect(
    "localhost",
    "root",
    "",
    "attendancedb"
);

if(!$conn){
    die("Connection Failed");
}

?>