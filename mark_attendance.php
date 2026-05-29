
    <?php

require_once "db.php";

$token = $_POST['token'];
$query = "SELECT * FROM students
WHERE qr_token='$token'";
$result = mysqli_query($conn, $query);
if(mysqli_num_rows($result) > 0){
    $student = mysqli_fetch_assoc($result);
    $student_id = $student['id'];
    $time = date("Y-m-d H:i:s");
    $insert = "INSERT INTO attendance
    (student_id, attendance_time)

    VALUES

    ('$student_id', '$time')";
    mysqli_query($conn, $insert);
    echo "  done";


}
else{
    echo"wrong qr code";
}
?>
  
