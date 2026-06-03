<?php

require_once "db.php";

$query = "

SELECT
students.full_name,
attendance.attendance_time

FROM attendance

JOIN students

ON attendance.student_id = students.id

ORDER BY attendance.id DESC

";
$result = mysqli_query($conn, $query);


?>

<!DOCTYPE html>
<html lang="fa" dir="rtl">

<head>

    <meta charset="UTF-8">

    <title>گزارش حضور و غیاب</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

    <link href="https://fonts.googleapis.com/css2?family=Vazirmatn:wght@100..900&display=swap" rel="stylesheet">

    <style>

        body{
            background:#f5f5f5;
            font-family:"Vazirmatn",sans-serif;
        }

        .report-card{
            border:none;
            border-radius:20px;
        }

    </style>

</head>

<body>

<div class="container py-5">

    <div class="row justify-content-center">

        <div class="col-12 col-lg-10">

            <div class="card shadow report-card">

                <div class="card-body p-4">

                    <h2 class="text-center mb-4">
                        گزارش حضور و غیاب
                    </h2>

                    <div class="table-responsive">

                        <table class="table table-striped table-hover align-middle">

                            <thead class="table-success">

                                <tr>

                                    <th>نام دانش‌آموز</th>
                                    <th>زمان حضور</th>

                                </tr>

                            </thead>

                            <tbody>

                            <?php
                            while($row = mysqli_fetch_assoc($result)){
                            ?>

                                <tr>

                                    <td>
                                        <?php echo $row['full_name']; ?>
                                    </td>


                                    <td>
                                        <?php echo $row['attendance_time']; ?>
                                    </td>

                                </tr>

                            <?php } ?>

                            </tbody>

                        </table>

                    </div>

                    <div class="text-center mt-4">

                        <a href="index.php"
                           class="btn btn-outline-secondary">

                            بازگشت به داشبورد

                        </a>

                    </div>

                </div>

            </div>

        </div>

    </div>

</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>