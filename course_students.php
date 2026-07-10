<?php
require_once "db.php"; // اتصال به پایگاه داده

// دریافت شناسه درس به صورت پاس داده شده از پارامتر URL (متد GET)
$course_id = $_GET['id'];

// بررسی درخواست حذفِ انتساب یک دانشجو از این درس
if(isset($_GET['delete'])){
    $student_id = $_GET['delete']; // دریافت آی‌دی دانشجو برای حذف از لیست این درس

    // حذف رکورد ارتباط دانشجو و درس از جدول student_courses
    mysqli_query($conn,"
        DELETE FROM student_courses
        WHERE student_id = $student_id
        AND course_id = $course_id
    ");
}

// استخراج تمام دانشجویانی که در حال حاضر در این درس ثبت‌نام *نشده‌اند* (جهت استفاده‌های احتمالی بعدی)
$all_students = mysqli_query($conn,"
SELECT *
FROM students
WHERE id NOT IN(
    SELECT student_id
    FROM student_courses
    WHERE course_id=$course_id
)
");

// دریافت نام درس و نام استاد آن جهت نمایش در هدر صفحه
$course = mysqli_fetch_assoc(mysqli_query($conn,"
SELECT courses.course_name, teachers.full_name AS teacher_name
FROM courses
LEFT JOIN teachers ON courses.teacher_code = teachers.teacher_code
WHERE courses.id = $course_id
"));

// دریافت لیست نهایی کلیه دانشجویانی که در این درسِ مشخص ثبت‌نام کرده‌اند
$students = mysqli_query($conn,"
SELECT students.id, students.student_code, students.full_name
FROM student_courses
JOIN students ON student_courses.student_id = students.id
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
        body{ background:#f5f5f5; font-family:"Vazirmatn",sans-serif; }
        .card{ border:none; border-radius:18px; }
    </style>
</head>

<body>
<div class="container py-5">
    <div class="card shadow">
        <div class="card-body p-4">
            <h3>لیست دانشجویان درس: <?php echo $course['course_name']; ?></h3>
            <p class="text-muted">استاد درس: <?php echo $course['teacher_name']; ?></p>

            <a href="enroll_student.php?course=<?php echo $course_id; ?>" class="btn btn-success mb-3">
                افزودن دانشجو به این درس
            </a>

            <table class="table table-striped align-middle">
                <thead class="table-dark">
                    <tr>
                        <th>کد دانشجویی</th>
                        <th>نام و نام خانوادگی</th>
                        <th>عملیات</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while($row = mysqli_fetch_assoc($students)) { ?>
                        <tr>
                            <td><?php echo $row['student_code']; ?></td>
                            <td><?php echo $row['full_name']; ?></td>
                            <td>
                                <a href="course_students.php?id=<?php echo $course_id; ?>&delete=<?php echo $row['id']; ?>" 
                                   class="btn btn-danger btn-sm" 
                                   onclick="return confirm('آیا از حذف این دانشجو از درس مطمئن هستید؟')">
                                   لغو ثبت‌نام درس
                                </a>
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
            <hr>
            <a href="courses.php" class="btn btn-outline-secondary">بازگشت به مدیریت درس‌ها</a>
        </div>
    </div>
</div>
</body>
</html>