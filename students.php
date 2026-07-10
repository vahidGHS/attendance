<?php
include "db.php"; // اتصال به دیتابیس
session_start(); // شروع سشن

// بخش اول: اگر کاربر ادمین باشد، لیست تمام دانشجویان سیستم بدون فیلتر درس نشان داده می‌شود
if ($_SESSION['role'] == "admin") {

    $query = "
    SELECT *
    FROM students
    ORDER BY full_name
    ";
    $result = mysqli_query($conn, $query);

} else { 
    // بخش دوم: اگر کاربر استاد باشد، ابتدا بررسی می‌شود که آیا درسی انتخاب کرده است یا خیر
    if (!isset($_SESSION['course_id'])) {
        die("ابتدا یک درس انتخاب کنید.");
    }

    $course_id = $_SESSION['course_id']; // دریافت آی‌دی درس از سشن

    // کوئری جوین (INNER JOIN) برای استخراج دانشجویانی که فقط در این درسِ مشخص ثبت‌نام کرده‌اند
    $query = "
    SELECT students.*
    FROM students
    INNER JOIN student_courses ON students.id = student_courses.student_id
    WHERE student_courses.course_id = $course_id
    ORDER BY students.full_name
    ";

    $result = mysqli_query($conn, $query);
    
    // دریافت نام درس انتخاب شده برای نمایش در عنوان صفحه
    $q = mysqli_query($conn, "
    SELECT course_name
    FROM courses
    WHERE id=$course_id
    ");

    $course = mysqli_fetch_assoc($q);
}
?>
<!DOCTYPE html>
<html lang="fa" dir="rtl">

<head>
    <title>Students List</title>
    <link rel="stylesheet" href="style.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Vazirmatn:wght@100..900&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .title { text-align: center; }
        * { font-family: "Vazirmatn", sans-serif; }
    </style>
</head>
<script src="js/qrcode.min.js"></script>

<body>

    <h2 class="title">
        لیست دانشجویان 
        <?php echo $course['course_name']; ?>
    </h2>
    <br><br>

    <table border="1" cellpadding="10" class="table table-striped table-success">
        <tr class="table-success">
            <th>ردیف</th>
            <th>کد دانشجویی</th>
            <th>نام کامل</th>
            <th>QR Code</th>
            <th>آمار حضور</th>
            <th>عملیات</th>
        </tr>

        <?php
        // حلقه نمایش ردیف‌های جدول به ازای هر دانشجو
        while ($row = mysqli_fetch_assoc($result)) {
        ?>
            <tr>
                <td><?php echo $row['id']; ?></td>
                <td><?php echo $row['student_code']; ?></td>
                <td><?php echo $row['full_name']; ?></td>

                <td>
                    <div style="background:white; padding:16px; display:inline-block;">
                        <div id="qrcode<?php echo $row['id']; ?>"></div>
                    </div>
                </td>

                <td>
                    <?php
                    $query = "SELECT COUNT(*) AS total
                              FROM attendance
                              WHERE student_id = {$row['id']}";

                    $countResult = mysqli_query($conn, $query);
                    $count = mysqli_fetch_assoc($countResult);
                    echo $count['total']; // چاپ تعداد کل روزهای حاضر شده
                    ?>
                </td>

                <td>
                    <a href="edit_student.php?id=<?php echo $row['id']; ?>" class="btn btn-warning btn-sm">ویرایش</a>
                    <a href="delete_student.php?id=<?php echo $row['id']; ?>" class="btn btn-danger btn-sm" onclick="return confirm('آیا از حذف این دانشجو مطمئن هستید؟')">حذف</a>
                </td>
            </tr>
        <?php } ?>
    </table>

    <script>
        <?php
        // بازنشانی اشاره‌گر نتایج به ردیف اول برای اجرای مجدد حلقه در جاوااسکریپت
        mysqli_data_seek($result, 0);
        while ($row = mysqli_fetch_assoc($result)) {
        ?>
            // تولید کارت QR مستقل برای هر دانشجو در جدول بر اساس توکن آن‌ها
            new QRCode(document.getElementById("qrcode<?php echo $row['id']; ?>"), {
                text: "<?php echo $row['qr_token']; ?>",
                width: 256,
                height: 256,
                correctLevel: QRCode.CorrectLevel.M
            });
        <?php } ?>
    </script>
    <br>
    <div class="d-flex justify-content-center">
        <a href="<?php echo $_SESSION['dashboard']; ?>" class="btn btn-outline-secondary w-100">بازگشت</a>
    </div>
</body>
</html>