<?php

require_once "db.php";

$query = "

SELECT
students.full_name,
students.class_name,
attendance.attendance_time

FROM attendance

JOIN students

ON attendance.student_id = students.id

ORDER BY attendance.id DESC

";
$result = mysqli_query($conn, $query);


?>

<!DOCTYPE html>
<html>

<head>

    <title>Attendance Report</title>

    <link rel="stylesheet" href="style.css">

</head>

<body>

<h2>Attendance Report</h2>

<table border="1" cellpadding="10">

<tr>

    <th>Student Name</th>
    <th>Class</th>
    <th>Attendance Time</th>

</tr>
<?php

while($row = mysqli_fetch_assoc($result)){

?>
<tr>

    <td>
        <?php echo $row['full_name']; ?>
    </td>

    <td>
        <?php echo $row['class_name']; ?>
    </td>

    <td>
        <?php echo $row['attendance_time']; ?>
    </td>

</tr>
<?php } ?>
</table>

</body>
</html>