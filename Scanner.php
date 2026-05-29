<!DOCTYPE html>
<html>

<head>

    <title>QR Scanner</title>

    <link rel="stylesheet" href="style.css">

</head>

<body>

    <h2>QR Attendance Scanner</h2>

    <div id="reader"></div>

    <div id="result"></div>

    <script src="js/html5-qrcode.min.js"></script>
</body>
<!--window.location =
"mark_attendance.php?token=" + decodedText; ------------------------------------>
    <script>
        function onScanSuccess(decodedText){
            window.location =
            "mark_attendance.php?token=" + decodedText;
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
</html>