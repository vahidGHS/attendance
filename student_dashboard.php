<?php

session_start();

require_once "db.php";

if (!isset($_SESSION['user'])) {

    header("Location: login.php");
    exit();
}

$username = $_SESSION['user'];

$query = "
SELECT student_code, full_name, qr_token
FROM students
WHERE student_code='$username'
";

$result = mysqli_query($conn, $query);

$student = mysqli_fetch_assoc($result);





?>
<!DOCTYPE html>
<html lang="fa" dir="rtl">

<head>

    <script src="js/qrcode.min.js"></script>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>پنل دانش‌آموز</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

    <link href="https://fonts.googleapis.com/css2?family=Vazirmatn:wght@100..900&display=swap" rel="stylesheet">

    <style>

        body{
            background:#f5f5f5;
            font-family:"Vazirmatn",sans-serif;
        }

        .student-card{
            border:none;
            border-radius:20px;
        }

        #qrcode{
            display:flex;
            justify-content:center;
        }

        .logout-btn{
            background:#dc3545;
            color:white;
            border:none;
        }

        .logout-btn:hover{
            background:#bb2d3b;
            color:white;
        }

    </style>

</head>

<body>

<div class="container">

    <div class="row vh-100 justify-content-center align-items-center">

        <div class="col-11 col-md-8 col-lg-5">

            <div class="card shadow student-card">

                <div class="card-body p-4 text-center">

                    <h2 class="mb-2">
                        کارت حضور و غیاب
                    </h2>

                    <p class="text-muted mb-4">

                        <?php echo $student['full_name']; ?>

                    </p>

                    <div id="qrcode" class="mb-4"></div>

                    <div class="alert alert-light border">

                        <strong>کد دانش‌آموزی:</strong>

                        <?php echo $student['student_code']; ?>

                    </div>

                    <a href="logout.php"
                       class="btn logout-btn w-100">

                        خروج

                    </a>

                </div>

            </div>

        </div>

    </div>

</div>

<script>

    let qrSize = Math.min(window.innerWidth * 0.6, 250);

    new QRCode(
        document.getElementById("qrcode"),
        {
            text: "<?php echo $student['qr_token']; ?>",
            width: qrSize,
            height: qrSize
        }
    );

</script>

</body>
</html>