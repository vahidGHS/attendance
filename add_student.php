<?php

include "db.php";

if (isset($_POST['submit'])) {

    $student_code = $_POST['student_code'];
    $full_name = $_POST['full_name'];
    $class_name = $_POST['class_name'];
    $token = md5(uniqid());
    $query = "INSERT INTO students
    (student_code, full_name, class_name, qr_token)

    VALUES

    ('$student_code', '$full_name', '$class_name', '$token')";

    mysqli_query($conn, $query);

    $query = "INSERT INTO users
    (username, password, role)

    VALUES

    ('$student_code', '123', 'student')";

    mysqli_query($conn, $query);
    echo "Student Added Successfully";
}

?>
<!DOCTYPE html>
<html lang="fa" dir="rtl">

<head>

    <meta charset="UTF-8">

    <title>افزودن دانش‌آموز</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

    <link href="https://fonts.googleapis.com/css2?family=Vazirmatn:wght@100..900&display=swap" rel="stylesheet">

    <style>
        body {
            background: #f5f5f5;
            font-family: "Vazirmatn", sans-serif;
        }

        .student-card {
            border: none;
            border-radius: 20px;
        }

        .save-btn {
            background-color: #4f8555;
            color: white;
            border: none;
        }

        .save-btn:hover {
            background-color: #3f6e45;
            color: white;
        }
    </style>

</head>

<body>

    <div class="container">

        <div class="row vh-100 justify-content-center align-items-center">

            <div class="col-11 col-md-8 col-lg-5">

                <div class="card shadow student-card">

                    <div class="card-body p-4">

                        <h2 class="text-center mb-4">
                            افزودن دانش‌آموز
                        </h2>

                        <form method="POST">

                            <div class="mb-3">

                                <label class="form-label">
                                    کد دانش‌آموزی
                                </label>

                                <input
                                    type="text"
                                    name="student_code"
                                    class="form-control">

                            </div>

                            <div class="mb-3">

                                <label class="form-label">
                                    نام و نام خانوادگی
                                </label>

                                <input
                                    type="text"
                                    name="full_name"
                                    class="form-control">

                            </div>

                            <div class="mb-4">

                                <label class="form-label">
                                    کلاس
                                </label>

                                <input
                                    type="text"
                                    name="class_name"
                                    class="form-control">

                            </div>

                            <button
                                type="submit"
                                name="submit"
                                class="btn save-btn w-100 py-2">

                                ذخیره دانش‌آموز

                            </button>

                        </form>

                        <hr>

                        <a
                            href="index.php"
                            class="btn btn-outline-secondary w-100">

                            بازگشت به داشبورد

                        </a>

                    </div>

                </div>

            </div>

        </div>

    </div>

</body>

</html>