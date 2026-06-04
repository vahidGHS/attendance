<?php

require_once "db.php";

if (isset($_POST['submit'])) {

    $teacher_code = $_POST['teacher_code'];
    $full_name = $_POST['full_name'];
    $subject_name = $_POST['subject_name'];
    $password = $_POST['password'];

    $user_query = "
    INSERT INTO users(username,password,role)
    VALUES(
        '$teacher_code',
        '$password',
        'teacher'
    )
    ";

    mysqli_query($conn, $user_query);

    $teacher_query = "
    INSERT INTO teachers(
        teacher_code,
        full_name,
        subject_name
    )
    VALUES(
        '$teacher_code',
        '$full_name',
        '$subject_name'
    )
    ";

    mysqli_query($conn, $teacher_query);

    $success = "معلم با موفقیت ثبت شد";
}

?>
<!DOCTYPE html>
<html lang="fa" dir="rtl">

<head>

    <meta charset="UTF-8">

    <title>افزودن معلم</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

    <link href="https://fonts.googleapis.com/css2?family=Vazirmatn:wght@100..900&display=swap" rel="stylesheet">

    <style>
        body {
            background: #f5f5f5;
            font-family: "Vazirmatn", sans-serif;
        }

        .Teacher-card {
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

        <div class="row justify-content-center py-5">

            <div class="col-11 col-md-8 col-lg-5">

                <div class="card shadow border-0 rounded-4">

                    <div class="card-body p-4">

                        <h3 class="text-center mb-4">
                            افزودن استاد
                        </h3>

                        <?php
                        if (isset($success)) {
                        ?>
                            <div class="alert alert-success">
                                <?php echo $success; ?>
                            </div>
                        <?php
                        }
                        ?>

                        <form method="POST">

                            <div class="mb-3">

                                <label class="form-label">
                                    کد استاد
                                </label>

                                <input
                                    type="text"
                                    name="teacher_code"
                                    class="form-control"
                                    required>

                            </div>

                            <div class="mb-3">

                                <label class="form-label">
                                    نام و نام خانوادگی
                                </label>

                                <input
                                    type="text"
                                    name="full_name"
                                    class="form-control"
                                    required>

                            </div>

                            <div class="mb-3">

                                <label class="form-label">
                                    نام درس
                                </label>

                                <input
                                    type="text"
                                    name="subject_name"
                                    class="form-control"
                                    required>

                            </div>

                            <div class="mb-3">

                                <label class="form-label">
                                    رمز عبور
                                </label>

                                <input
                                    type="password"
                                    name="password"
                                    class="form-control"
                                    required>

                            </div>

                            <button
                                type="submit"
                                name="submit"
                                class="btn btn-success w-100">

                                ثبت استاد

                            </button>

                        </form>

                    </div>

                </div>

            </div>

        </div>

    </div>
    <div class="d-flex justify-content-center">
        <a
            href="index.php"
            class="btn btn-outline-success w-50">

            بازگشت به داشبورد

        </a>
    </div>
</body>

</html>