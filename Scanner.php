<?php 
session_start(); // شروع یا ادامه نشست کاربری برای دسترسی به متغیرهای سشن
include "db.php"; // اتصال به پایگاه داده

// بررسی اینکه آیا کاربر وارد شده نقش استاد دارد یا خیر
if ($_SESSION['role'] == "teacher") {

    // کوئری دریافت لیست تمامی دانشجویان به ترتیب حروف الفبا
    $query = "
    SELECT *
    FROM students
    ORDER BY full_name
    ";
    $result = mysqli_query($conn, $query); // اجرای کوئری در پایگاه داده
 
    // کنترل انتخاب شدن درس؛ اگر استاد درسی را انتخاب نکرده باشد، عملیات متوقف می‌شود
    if (!isset($_SESSION['course_id'])) {
        die("ابتدا یک درس انتخاب کنید.");
    }

    $course_id = $_SESSION['course_id']; // ذخیره شناسه درس فعال در متغیر
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
                        <h2 class="text-center mb-4">اسکن کد QR</h2>

                        <video id="reader" style="width:100%; border-radius: 12px;"></video>

                        <div id="result" class="alert alert-light mt-3">
                            منتظر اسکن...
                        </div>

                        <div class="d-flex justify-content-center">
                            <a href="<?php echo $_SESSION['dashboard']; ?>" class="btn btn-outline-secondary w-100">
                                بازگشت
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="js/zxing.min.js"></script>

    <script>
        // تنظیمات بهینه‌سازی پردازش اسکنر برای تلاش بیشتر و دقت بالاتر در تشخیص کد
        const hints = new Map();
        hints.set(ZXing.DecodeHintType.TRY_HARDER, true);

        // راه‌اندازی اسکنر با استفاده از تنظیمات اعمال شده
        const codeReader = new ZXing.BrowserQRCodeReader(hints);

        // شروع به خواندن ویدیو از دوربین و تلاش برای رمزگشایی کد QR
        codeReader.decodeFromVideoDevice(undefined, 'reader', (result, err) => {
            if (result) {
                const decodedText = result.getText(); // استخراج متن خام موجود در QR کد
                alert(decodedText); 
                document.getElementById("result").innerHTML = "کد اسکن شد";

                // ارسال متن اسکن شده (توکن) به صورت ناهمگام (AJAX) به فایل ثبت حضور و غیاب
                fetch("mark_attendance.php", {
                        method: "POST",
                        headers: {
                            "Content-Type": "application/x-www-form-urlencoded"
                        },
                        body: "token=" + encodeURIComponent(decodedText)
                    })
                    .then(response => response.text())
                    .then(data => {
                        // نمایش پاسخ دریافت شده از سرور در صفحه
                        document.getElementById("result").innerHTML = data;
                    });
            }
        });
    </script>
</body>
</html>