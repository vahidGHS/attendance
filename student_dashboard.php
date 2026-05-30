<?php

session_start();

require_once "db.php";

if(!isset($_SESSION['user'])){

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
 echo $student['full_name'];




?>
<!DOCTYPE html>
<html lang="en">
<head>
    <script src="js/qrcode.min.js"></script>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <div id="qrcode"></div>
</body>
</html>
 
<script>
     new QRCode(
                document.getElementById("qrcode"), {
                    text: "<?php  echo $student['qr_token'];   ?>",
                    width: 500,
                    height: 500
                }
            );
</script>