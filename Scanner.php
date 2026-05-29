<!DOCTYPE html>
<html>

<head>

    <title>QR Scanner</title>

    <link rel="stylesheet" href="style.css">

</head>

<body>

    <h2>QR Scanner</h2>

    <div id="reader"></div>

    <div id="result"></div>

    <script src="js/html5-qrcode.min.js"></script>

    <script>

    function onScanSuccess(decodedText){

        document.getElementById("result")
        .innerHTML = "Scanned: " + decodedText;

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

            alert(data);

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