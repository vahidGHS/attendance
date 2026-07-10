<?php
include "db.php"; // اتصال به پایگاه داده

// کوئری برای دریافت اطلاعات تمام اساتید ثبت شده در سیستم
$query = "SELECT * FROM teachers";
$result = mysqli_query($conn, $query); // اجرای کوئری
?>
<!DOCTYPE html>
<html lang="fa" dir="rtl">

<head>
    <title>teachers List</title>
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
    <h2 class="title">لیست اساتید</h2>
    <br><br>

    <table border="1" cellpadding="10" class="table table-striped table-success">
        <tr class="table-success">
            <th>ردیف</th>
            <th>کد استاد</th>
            <th>نام کامل</th>
        </tr>

        <?php
        // حلقه بازخوانی تک‌تک ردیف‌های اساتید و چاپ آن‌ها در جدول
        while ($row = mysqli_fetch_assoc($result)) {
        ?>
            <tr>
                <td><?php echo $row['id']; ?></td>
                <td><?php echo $row['teacher_code']; ?></td>
                <td><?php echo $row['full_name']; ?></td>
            </tr>
        <?php } ?>
    </table>

    <script>
        <?php
        // بازنشانی پوینتر دیتابیس برای کدهای جاوااسکریپت احتمالی در آینده
        mysqli_data_seek($result, 0);
        while ($row = mysqli_fetch_assoc($result)) {
        ?>
           // توسعه در آینده
        <?php } ?>
    </script>
    <br>
    
    <div class="d-flex justify-content-center">
        <a href="index.php" class="btn btn-outline-secondary w-100">
            بازگشت به داشبورد
        </a>
    </div>
</body>
</html>