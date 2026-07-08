ئ
<?php

require_once "db.php";

$query = "
SELECT
courses.id,
courses.course_name,
teachers.full_name,
COUNT(student_courses.student_id) AS total_students

FROM courses

LEFT JOIN teachers
ON courses.teacher_code = teachers.teacher_code

LEFT JOIN student_courses
ON courses.id = student_courses.course_id

GROUP BY
courses.id,
courses.course_name,
teachers.full_name

ORDER BY courses.course_name
";

$result = mysqli_query($conn, $query);

?>

<!DOCTYPE html>
<html lang="fa" dir="rtl">

<head>

    <meta charset="UTF-8">

    <title>مدیریت درس‌ها</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

    <link href="https://fonts.googleapis.com/css2?family=Vazirmatn:wght@100..900&display=swap" rel="stylesheet">

    <style>
        body {
            background: #f5f5f5;
            font-family: "Vazirmatn", sans-serif;
        }

        .card {
            border: none;
            border-radius: 18px;
        }

        h2 {
            font-weight: 700;
        }

        .table td,
        .table th {
            vertical-align: middle;
        }
    </style>

</head>

<body>

    <div class="container py-5">

        <div class="card shadow">

            <div class="card-body">

                <div class="d-flex justify-content-between align-items-center mb-4">

                    <h2>
                        مدیریت درس‌ها
                    </h2>

                    <a
                        href="add_courses.php"
                        class="btn btn-success">

                        افزودن درس

                    </a>

                </div>

                <table class="table table-hover align-middle">

                    <thead class="table-success">

                        <tr>

                            <th>ردیف</th>

                            <th>نام درس</th>

                            <th>استاد</th>

                            <th>تعداد دانشجو</th>

                            <th width="350">
                                عملیات
                            </th>

                        </tr>

                    </thead>

                    <tbody>

                        <?php

                        while ($row = mysqli_fetch_assoc($result)) {

                        ?>

                            <tr>

                                <td>

                                    <?php echo $row['id']; ?>

                                </td>

                                <td>

                                    <?php echo $row['course_name']; ?>

                                </td>

                                <td>

                                    <?php echo $row['full_name']; ?>

                                </td>

                                <td>

                                    <?php echo $row['total_students']; ?>

                                </td>

                                <td>

                                    <a
                                        href="course_students.php?id=<?php echo $row['id']; ?>"
                                        class="btn btn-primary btn-sm">

                                        دانشجویان

                                    </a>

                                    <a
                                        href="delete_course.php?id=<?php echo $row['id']; ?>"
                                        class="btn btn-danger btn-sm"
                                        onclick="return confirm('درس حذف شود؟');">

                                        حذف

                                    </a>

                                </td>

                            </tr>

                        <?php } ?>

                    </tbody>

                </table>

                <hr>

                <a
                    href="index.php"
                    class="btn btn-outline-secondary">

                    بازگشت

                </a>

            </div>

        </div>

    </div>

</body>

</html>
```