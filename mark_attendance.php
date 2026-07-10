<?php
session_start();
require_once "db.php";

if (!isset($_SESSION['course_id'])) {
    die("ابتدا درس را انتخاب کنید.");
}

$course_id = $_SESSION['course_id'];
$token = $_POST['token'];

// بررسی اینکه دانشجو در همین درس ثبت‌نام کرده باشد
$query = "
SELECT students.id, students.full_name
FROM students

JOIN student_courses
ON students.id = student_courses.student_id

WHERE students.qr_token = '$token'
AND student_courses.course_id = '$course_id'
";

$result = mysqli_query($conn, $query);

if (mysqli_num_rows($result) > 0) {

    $student = mysqli_fetch_assoc($result);
    $student_id = $student['id'];

    // جلوگیری از ثبت دوباره در همان روز (اختیاری ولی پیشنهاد می‌شود)
    $check = mysqli_query($conn, "
        SELECT id
        FROM attendance
        WHERE student_id = '$student_id'
        AND course_id = '$course_id'
        AND DATE(attendance_time) = CURDATE()
    ");

    if (mysqli_num_rows($check) > 0) {
        die("حضور این دانشجو قبلاً ثبت شده است.");
    }

    $time = date("Y-m-d H:i:s");

    mysqli_query($conn, "
        INSERT INTO attendance
        (student_id, attendance_time, course_id)
        VALUES
        ('$student_id', '$time', '$course_id')
    ");

    echo "حضور {$student['full_name']} ثبت شد.";

} else {

    echo "این دانشجو در درس انتخاب‌شده ثبت‌نام نکرده است.";

}
?>