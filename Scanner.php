<?php 
session_start();
include "db.php";

if ($_SESSION['role'] == "teacher") {

    $query = "
    SELECT *
    FROM students
    ORDER BY full_name
    ";
    $result = mysqli_query($conn, $query);
 
if (!isset($_SESSION['course_id'])) {
    die("ابتدا یک درس انتخاب کنید.");
}

$course_id = $_SESSION['course_id'];
}
?>
<!DOCTYPE html>
<html lang="fa" dir="rtl">

<head>

    <meta charset="UTF-8">

    <title>اسکن QR</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

    <link href="https://fonts.googleapis.com/css2?family=Vazirmatn:wght@100..900&display=swap" rel="stylesheet">

    <style>
        body {
            background: #f5f5f5;
            font-family: "Vazirmatn", sans-serif;
        }

        .scanner-card {
            border: none;
            border-radius: 20px;
        }

        #reader {
            width: 100%;
        }

        #result {
            text-align: center;
            margin-top: 20px;
            font-weight: 500;
        }
    </style>

</head>

<body>

    <div class="container">

        <div class="row justify-content-center py-5">

            <div class="col-12 col-md-8 col-lg-6">

                <div class="card shadow scanner-card">

                    <div class="card-body p-4">

                        <h2 class="text-center mb-4">
                            اسکن کد QR
                        </h2>

                        <video id="reader" style="width:100%; border-radius: 12px;"></video>

                        <div id="result"
                            class="alert alert-light mt-3">

                            منتظر اسکن...

                        </div>

                        <div class="d-flex justify-content-center">
                            <a href="<?php
                                        echo $_SESSION['dashboard']; ?>"
                                class="btn btn-outline-secondary w-100">

                                بازگشت

                            </a>
                        </div>
                    </div>

                </div>

            </div>

        </div>

    </div>

    </div>

    <script src="js/zxing.min.js"></script>

    <script>
        const hints = new Map();
        hints.set(ZXing.DecodeHintType.TRY_HARDER, true);

        const codeReader = new ZXing.BrowserQRCodeReader(hints);

        codeReader.decodeFromVideoDevice(undefined, 'reader', (result, err) => {
            if (result) {
                const decodedText = result.getText();
                alert(decodedText);
                document.getElementById("result").innerHTML = "کد اسکن شد";

                fetch("mark_attendance.php", {
                        method: "POST",
                        headers: {
                            "Content-Type": "application/x-www-form-urlencoded"
                        },
                        body: "token=" + encodeURIComponent(decodedText)
                    })
                    .then(response => response.text())
                    .then(data => {
                        document.getElementById("result").innerHTML = data;
                    });
            }
        });
    </script>

</body>

</html>