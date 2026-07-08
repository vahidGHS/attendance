<?php
include "db.php";
session_start();
if ($_SESSION['role'] == "admin") {

    $query = "
    SELECT *
    FROM students
    ORDER BY full_name
    ";
    $result = mysqli_query($conn, $query);
} else {
    if (!isset($_SESSION['course_id'])) {
        die("ابتدا یک درس انتخاب کنید.");
    }

    $course_id = $_SESSION['course_id'];


    

    $query = "
SELECT students.*
FROM students

INNER JOIN student_courses
ON students.id = student_courses.student_id

WHERE student_courses.course_id = $course_id

ORDER BY students.full_name
";

    $result = mysqli_query($conn, $query);
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

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <style>
        .title {
            text-align: center;
        }

        * {
            font-family: "Vazirmatn", sans-serif;
        }
    </style>
</head>
<script src="js/qrcode.min.js"></script>

<body>

    <h2 class="title">
        لیست دانشجویان
        <?php echo $course['course_name']; ?>
    </h2>
    <br>
    <br>
    <table border="1" cellpadding="10" class="table table-striped table-success">

        <tr class="table-success">
            <th class="table-success">ردیف</th>
            <th class="table-success">کد دانشجویی</th>
            <th class="table-success">نام کامل</th>
            <th class="table-success">QR Code</th>
            <th class="table-success">آمار حضور</th>
            <th>عملیات</th>
        </tr>

        <?php

        while ($row = mysqli_fetch_assoc($result)) {

        ?>

            <tr>

                <td class="table-success"><?php echo $row['id']; ?></td>

                <td class="table-success"><?php echo $row['student_code']; ?></td>

                <td class="table-success"><?php echo $row['full_name']; ?></td>

                <td class="table-success">
                    <div style="background:white; padding:16px; display:inline-block;">
                        <div id="qrcode<?php echo $row['id']; ?>"></div>
                    </div>
                </td>
                <td class="table-success">
                    <?php

                    $query = "SELECT COUNT(*) AS total
          FROM attendance
          WHERE student_id = {$row['id']}";

                    $countResult = mysqli_query($conn, $query);

                    $count = mysqli_fetch_assoc($countResult);

                    echo $count['total'];

                    ?>
                </td>
                <td>

                    <a
                        href="edit_student.php?id=<?php echo $row['id']; ?>"
                        class="btn btn-warning btn-sm">

                        ویرایش

                    </a>

                    <a
                        href="delete_student.php?id=<?php echo $row['id']; ?>"
                        class="btn btn-danger btn-sm"
                        onclick="return confirm('آیا از حذف این دانشجو مطمئن هستید؟')">

                        حذف

                    </a>

                </td>
            </tr>

        <?php } ?>

    </table>
    <script>
        <?php

        mysqli_data_seek($result, 0);
        while ($row = mysqli_fetch_assoc($result)) {
        ?>

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
        <a href="<?php echo $_SESSION['dashboard']; ?>"
            class="btn btn-outline-danger w-100 py-3">

            بازگشت

        </a>
    </div>
</body>

</html>