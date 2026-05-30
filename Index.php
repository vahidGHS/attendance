<?php

session_start();

if(!isset($_SESSION['user'])){

    header("Location: login.php");
    exit();

}

?>

<!DOCTYPE html>
<html lang="fa" dir="rtl">

<head>

    <meta charset="UTF-8">

    <title>سیستم حضور و غیاب</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

    <link href="https://fonts.googleapis.com/css2?family=Vazirmatn:wght@100..900&display=swap" rel="stylesheet">

    <style>

        body{
            background:#f5f5f5;
            font-family:"Vazirmatn",sans-serif;
        }

        .dashboard-card{
            border:none;
            border-radius:20px;
        }

        .dashboard-btn{

            background-color:#4f8555;
            color:white;

            border:none;
            border-radius:15px;

            min-height:120px;

            display:flex;
            justify-content:center;
            align-items:center;

            text-decoration:none;

            font-size:18px;
            font-weight:500;

            transition:0.3s;
        }

        .dashboard-btn:hover{

            background-color:#3f6e45;
            color:white;

        }

    </style>

</head>

<body>

<div class="container">

    <div class="row vh-100 justify-content-center align-items-center">

        <div class="col-11 col-md-8 col-lg-6">

            <div class="card shadow dashboard-card">

                <div class="card-body p-4">

                    <h2 class="text-center mb-2">
                        سیستم حضور و غیاب
                    </h2>

                    <p class="text-center text-muted mb-4">

                        خوش آمدید

                        <?php echo $_SESSION['user']; ?>

                    </p>

                    <div class="row g-3">

                        <div class="col-6">

                            <a href="add_student.php"
                               class="dashboard-btn">

                                افزودن دانش‌آموز

                            </a>

                        </div>

                        <div class="col-6">

                            <a href="students.php"
                               class="dashboard-btn">

                                لیست دانش‌آموزان

                            </a>

                        </div>

                        <div class="col-6">

                            <a href="scanner.php"
                               class="dashboard-btn">

                                اسکن QR

                            </a>

                        </div>

                        <div class="col-6">

                            <a href="attendance_report.php"
                               class="dashboard-btn">

                                گزارش حضور و غیاب

                            </a>

                        </div>

                        <div class="col-12">

                            <a href="logout.php"
                               class="btn btn-danger w-100 py-3">

                                خروج

                            </a>

                        </div>

                    </div>

                </div>

            </div>

        </div>

    </div>

</div>

</body>
</html>