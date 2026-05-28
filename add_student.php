<?php

include "db.php";

if(isset($_POST['submit'])){

    $student_code = $_POST['student_code'];
    $full_name = $_POST['full_name'];
    $class_name = $_POST['class_name'];
    $token = md5(uniqid());
    $query = "INSERT INTO students
    (student_code, full_name, class_name, qr_token)

    VALUES

    ('$student_code', '$full_name', '$class_name', '$token')";

    mysqli_query($conn, $query);

    echo "Student Added Successfully";
}

?>

<!DOCTYPE html>
<html>

<head>
    <title>Add Student</title>

    <link rel="stylesheet" href="style.css">
</head>

<body>

    <h2>Add Student</h2>

    <form method="POST">

        <input type="text"
        name="student_code"
        placeholder="Student Code">

        <br><br>

        <input type="text"
        name="full_name"
        placeholder="Full Name">

        <br><br>

        <input type="text"
        name="class_name"
        placeholder="Class Name">

        <br><br>

        <button type="submit"
        name="submit">
            Save Student
        </button>

    </form>

</body>

</html>