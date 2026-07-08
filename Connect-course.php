<?php

require_once "db.php";
session_start();

if(isset($_POST['submit'])){

    $student_id = $_POST['student_id'];
    $course_id = $_POST['course_id'];

    $query = "INSERT INTO student_courses(student_id, course_id)
              VALUES($student_id, $course_id)";

    if(mysqli_query($conn,$query)){
        $message = "دانشجو با موفقیت ثبت شد.";
    }else{
        $message = "این دانشجو قبلاً در این درس ثبت شده است.";
    }

}

$students = mysqli_query($conn,"SELECT id, full_name, student_code FROM students ORDER BY full_name");

$courses = mysqli_query($conn,"
SELECT
courses.id,
courses.course_name,
teachers.full_name AS teacher_name
FROM courses
LEFT JOIN teachers
ON courses.teacher_code = teachers.teacher_code
ORDER BY courses.course_name
");

?>

<!DOCTYPE html>
<html lang="fa" dir="rtl">

<head>

<meta charset="UTF-8">

<title>ثبت دانشجو در درس</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">

<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

<link href="https://fonts.googleapis.com/css2?family=Vazirmatn:wght@100..900&display=swap" rel="stylesheet">

<style>

body{
    background:#f5f5f5;
    font-family:"Vazirmatn",sans-serif;
}

.card{
    border:none;
    border-radius:18px;
}

</style>

</head>

<body>

<div class="container">

<div class="row justify-content-center py-5">

<div class="col-lg-6">

<div class="card shadow">

<div class="card-body p-4">

<h3 class="text-center mb-4">
ثبت دانشجو در درس
</h3>

<?php
if(isset($message)){
?>

<div class="alert alert-success">
    <?php echo $message; ?>
</div>

<?php } ?>

<form method="POST">

<div class="mb-3">

<label class="form-label">
دانشجو
</label>

<select
name="student_id"
class="form-select"
required>

<option value="">
انتخاب دانشجو
</option>

<?php while($student=mysqli_fetch_assoc($students)){ ?>

<option value="<?php echo $student['id']; ?>">

<?php
echo $student['full_name'];
echo " (";
echo $student['student_code'];
echo ")";
?>

</option>

<?php } ?>

</select>

</div>

<div class="mb-3">

<label class="form-label">
درس
</label>

<select
name="course_id"
class="form-select"
required>

<option value="">
انتخاب درس
</option>

<?php while($course=mysqli_fetch_assoc($courses)){ ?>

<option value="<?php echo $course['id']; ?>">

<?php
echo $course['course_name'];
echo " - ";
echo $course['teacher_name'];
?>

</option>

<?php } ?>

</select>

</div>

<button
class="btn btn-success w-100 py-2"
name="submit">

ثبت دانشجو

</button>

</form>

<hr>

<a
href="index.php"
class="btn btn-outline-secondary w-100">

بازگشت

</a>

</div>

</div>

</div>

</div>

</div>

</body>

</html>