<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php

require_once "db.php";

$token = $_POST['token'];
$query = "SELECT * FROM students
WHERE qr_token='$token'";
$result = mysqli_query($conn, $query);
if(mysqli_num_rows($result) > 0){






echo "  done"


}
?>
  
</body>
</html>