<?php

session_start();

require_once "db.php";

$result = mysqli_query($conn, "
SELECT COUNT(*) AS total
FROM users
WHERE role='admin'
");

$row = mysqli_fetch_assoc($result);

$hasAdmin = $row['total'] > 0;
if (isset($_POST['login'])) {

    $username = $_POST['username'];
    $password = $_POST['password'];

    $query = "SELECT * FROM users

    WHERE username='$username'
    AND password='$password'";

    $result = mysqli_query($conn, $query);

    if (mysqli_num_rows($result) > 0) {
        $user = mysqli_fetch_assoc($result);

        $_SESSION['user'] = $user['username'];

        $_SESSION['role'] = $user['role'];

        $_SESSION['user'] = $username;
        if ($user['role'] == 'admin') {
            $_SESSION['dashboard'] = 'index.php';
            header("Location: index.php");
        } elseif ($user['role'] == 'teacher') {
            $_SESSION['dashboard'] = 'teacherPanel.php';
            header("Location: teacherPanel.php");
        } else {

            header("Location: student_dashboard.php");
        }



        exit();
    } else {

        $error = "Invalid Username or Password";
    }
}

?>
<!DOCTYPE html>
<html lang="fa" dir="rtl">

<head>
    <meta charset="UTF-8">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

    <link href="https://fonts.googleapis.com/css2?family=Vazirmatn:wght@100..900&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            background: #f5f5f5;
            position: relative;
            overflow: hidden;
        }

        body::before {
            content: "";
            position: absolute;
            width: 400px;
            height: 400px;
            border-radius: 50%;
            background: #4f855530;
            top: -120px;
            left: -120px;
        }

        body::after {
            content: "";
            position: absolute;
            width: 300px;
            height: 300px;
            border-radius: 50%;
            background: #4f855520;
            bottom: -80px;
            right: -80px;
        }

        * {
            font-family: "Vazirmatn", sans-serif;
        }

        .login-card {
            border-radius: 30px;
            overflow: hidden;
            min-height: 650px;
        }

        .login-form {
            background: white;
            padding: 50px;
        }

        .login-btn {
            background-color: #4f8555;
            color: white;
            border: none;

        }
    </style>

</head>

<body class="bg-light">
    <div class="container-fluid">

        <div class="row vh-100 justify-content-center align-items-center">

            <div class="col-11 col-md-6 col-lg-4">

                <div class="card shadow">

                    <div class="card-body p-4">
                        <?php if (!$hasAdmin) { ?>

                            <div class="alert alert-warning text-center">

                                <h5>هیچ مدیر سیستمی وجود ندارد.</h5>

                                <p class="mb-0">
                                    ابتدا باید یک کاربر با نقش <b>admin</b> 
                                    <b>دیتا بیس attendancedb</b>
                                    ایجاد شود.
                                </p>

                            </div>

                        <?php } else { ?>




                        <h3 class="text-center mb-4">
                            ورود
                        </h3>

                        <form method="POST">

                            <div class="mb-3">

                                <label class="form-label">
                                    نام کاربری
                                </label>

                                <input
                                    type="text"
                                    name="username"
                                    class="form-control">

                            </div>

                            <div class="mb-3">

                                <label class="form-label">
                                    پسوورد
                                </label>

                                <input
                                    type="password"
                                    name="password"
                                    class="form-control">

                            </div>

                            <button type="submit" class="btn login-btn w-100" name="login">

                                ورود

                            </button>

                        </form>

                        <?php } ?>
                    </div>

                </div>

            </div>

        </div>

    </div>

</body>