
<html lang="en">
<?php

require_once "db.php";

$id = $_GET['id'];

$query = "SELECT * FROM students WHERE id=$id";

$result = mysqli_query($conn, $query);

$student = mysqli_fetch_assoc($result);

if(isset($_POST['update'])){

    $student_code = $_POST['student_code'];
    $full_name = $_POST['full_name'];

    $query = "
    UPDATE students
    SET
        student_code='$student_code',
        full_name='$full_name'
    WHERE id=$id
    ";

    mysqli_query($conn, $query);

    header("Location: students.php");
    exit();
}
?>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form method="POST">

    <div class="mb-3">

        <label class="form-label">
            کد دانشجویی
        </label>

        <input
            type="text"
            name="student_code"
            class="form-control"
            value="<?php echo $student['student_code']; ?>">

    </div>

    <div class="mb-3">

        <label class="form-label">
            نام کامل
        </label>

        <input
            type="text"
            name="full_name"
            class="form-control"
            value="<?php echo $student['full_name']; ?>">

    </div>

    <button
        type="submit"
        name="update"
        class="btn btn-success">

        ذخیره تغییرات

    </button>

</form>
</body>
</html>