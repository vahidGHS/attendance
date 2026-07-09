
<?php

require_once "db.php";

$course_id = $_GET['id'];

// حذف دانشجو از درس
if(isset($_GET['delete'])){

    $student_id = $_GET['delete'];

    mysqli_query($conn,"
        DELETE FROM student_courses
        WHERE student_id = $student_id
        AND course_id = $course_id
    ");

}
$all_students = mysqli_query($conn,"
SELECT *
FROM students
WHERE id NOT IN(
    SELECT student_id
    FROM student_courses
    WHERE course_id=$course_id
)
");
// اطلاعات درس
$course = mysqli_fetch_assoc(mysqli_query($conn,"
SELECT
courses.course_name,
teachers.full_name AS teacher_name
FROM courses
LEFT JOIN teachers
ON courses.teacher_code = teachers.teacher_code
WHERE courses.id = $course_id
"));

// دانشجوهای این درس
$students = mysqli_query($conn,"
SELECT
students.id,
students.student_code,
students.full_name
FROM student_courses

JOIN students
ON student_courses.student_id = students.id

WHERE student_courses.course_id = $course_id

ORDER BY students.full_name
");

?>

<!DOCTYPE html>

<html lang="fa" dir="rtl">

<head>

<meta charset="UTF-8">

<title>دانشجویان درس</title>

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

<div class="container py-5">

<div class="card shadow">

<div class="card-body">

<h3>

<?php echo $course['course_name']; ?>

</h3>

<p>

استاد:

<?php echo $course['teacher_name']; ?>

</p>

<a
href="enroll_student.php?course=<?php echo $course_id; ?>"
class="btn btn-success mb-3">

افزودن دانشجو

</a>

<table class="table table-striped">

<tr>

<th>کد دانشجویی</th>

<th>نام</th>

<th>عملیات</th>

</tr>

<?php

while($row = mysqli_fetch_assoc($students)){

?>

<tr>

<td>

<?php echo $row['student_code']; ?>

</td>

<td>

<?php echo $row['full_name']; ?>

</td>

<td>

<a
class="btn btn-danger btn-sm"
href="course_students.php?id=<?php echo $course_id; ?>&delete=<?php echo $row['id']; ?>"
onclick="return confirm('حذف شود؟')">

حذف

</a>

</td>

</tr>

<?php } ?>

</table>

<a
href="courses.php"
class="btn btn-outline-secondary">

بازگشت

</a>

</div>

</div>

</div>

</body>

</html>

