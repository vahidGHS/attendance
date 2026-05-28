<?php

include "db.php";

$query = "SELECT * FROM students";

$result = mysqli_query($conn, $query);

?>

<!DOCTYPE html>
<html>

<head>

    <title>Students List</title>

    <link rel="stylesheet" href="style.css">

</head>
<script src="js/qrcode.min.js"></script>
<body>

    <h2>Students List</h2>

    <table border="1" cellpadding="10">

        <tr>
            <th>ID</th>
            <th>Student Code</th>
            <th>Full Name</th>
            <th>Class</th>
            <th>QR Code</th>
        </tr>

        <?php

        while($row = mysqli_fetch_assoc($result)){

        ?>

        <tr>

            <td><?php echo $row['id']; ?></td>

            <td><?php echo $row['student_code']; ?></td>

            <td><?php echo $row['full_name']; ?></td>

            <td><?php echo $row['class_name']; ?></td>
            <td>

                <div id="qrcode<?php echo $row['id']; ?>"></div>

            </td>

        </tr>

        <?php } ?>

    </table>
<script>

<?php

mysqli_data_seek($result, 0);

while($row = mysqli_fetch_assoc($result)){

?>

new QRCode(
    document.getElementById("qrcode<?php echo $row['id']; ?>"),
    {
        text: "<?php echo $row['qr_token']; ?>",
        width: 100,
        height: 100
    }
);

<?php } ?>

</script>
</body>

</html>