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

        body{
            background:#f5f5f5;
            font-family:"Vazirmatn",sans-serif;
        }

        .scanner-card{
            border:none;
            border-radius:20px;
        }

        #reader{
            width:100%;
        }

        #result{
            text-align:center;
            margin-top:20px;
            font-weight:500;
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

                    <div id="reader"></div>

                    <div id="result"
                         class="alert alert-light mt-3">

                        منتظر اسکن...

                    </div>

                    <div class="mt-4">

                        <a href="index.php"
                           class="btn btn-outline-success w-100">

                            بازگشت به داشبورد

                        </a>

                    </div>

                </div>

            </div>

        </div>

    </div>

</div>

<script src="js/html5-qrcode.min.js"></script>

<script>

function onScanSuccess(decodedText){

    document.getElementById("result")
    .innerHTML = "کد اسکن شد";

    fetch("mark_attendance.php", {

        method: "POST",

        headers: {
            "Content-Type":
            "application/x-www-form-urlencoded"
        },

        body: "token=" + decodedText

    })
    .then(response => response.text())
    .then(data => {

        document.getElementById("result")
        .innerHTML = data;

    });

}

let scanner = new Html5QrcodeScanner(
    "reader",
    {
        fps: 10,
        qrbox: 250
    }
);

scanner.render(onScanSuccess);

</script>

</body>

</html>