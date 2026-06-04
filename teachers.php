<?php

include "db.php";

$query = "SELECT * FROM teachers";

$result = mysqli_query($conn, $query);

?>

<!DOCTYPE html>

<html lang="fa" dir="rtl">

<head>

    <title>teachers List</title>

    <link rel="stylesheet" href="style.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

    <link href="https://fonts.googleapis.com/css2?family=Vazirmatn:wght@100..900&display=swap" rel="stylesheet">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <style>
        .title {
            text-align: center;
        }

        * {
            font-family: "Vazirmatn", sans-serif;
        }
    </style>
</head>
<script src="js/qrcode.min.js"></script>

<body>

    <h2 class="title">لیست اساتید</h2>
    <br>
    <br>
    <table border="1" cellpadding="10" class="table table-striped table-success">

        <tr class="table-success">
            <th class="table-success">ردیف</th>
            <th class="table-success">کد استاد</th>
            <th class="table-success">نام کامل</th>
            

        </tr>

        <?php

        while ($row = mysqli_fetch_assoc($result)) {

        ?>

            <tr>

                <td class="table-success"><?php echo $row['id']; ?></td>

                <td class="table-success"><?php echo $row['teacher_code']; ?></td>

                <td class="table-success"><?php echo $row['full_name']; ?></td>

            </tr>

        <?php } ?>

    </table>
    <script>
        <?php

        mysqli_data_seek($result, 0);

        while ($row = mysqli_fetch_assoc($result)) {

        ?>


        <?php } ?>
    </script>
    <br>
    <div class="d-flex justify-content-center">
        <a
            href="index.php"
            class="btn btn-outline-success w-50">

            بازگشت به داشبورد

        </a>
    </div>
</body>

</html>