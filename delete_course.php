<?php

require_once "db.php";

$id = (int)$_GET['id'];

// اگر attendance هم course_id دارد
mysqli_query($conn,"
DELETE FROM attendance
WHERE course_id = $id
");

// حذف ثبت نام ها
mysqli_query($conn,"
DELETE FROM student_courses
WHERE course_id = $id
");

// حذف درس
mysqli_query($conn,"
DELETE FROM courses
WHERE id = $id
");

header("Location: courses.php");
exit;