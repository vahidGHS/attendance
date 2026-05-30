<?php

session_start();

require_once "db.php";

if(isset($_POST['login'])){

    $username = $_POST['username'];
    $password = $_POST['password'];

    $query = "SELECT * FROM users

    WHERE username='$username'
    AND password='$password'";

    $result = mysqli_query($conn, $query);

    if(mysqli_num_rows($result) > 0){

        $_SESSION['user'] = $username;

        header("Location: index.php");

        exit();

    }else{

        $error = "Invalid Username or Password";

    }

}

?>

<!DOCTYPE html>
<html>

<head>

    <title>Login</title>

</head>

<body>

<h2>Login</h2>

<?php

if(isset($error)){
    echo $error;
}

?>

<form method="POST">

    <input
        type="text"
        name="username"
        placeholder="Username"
    >

    <br><br>

    <input
        type="password"
        name="password"
        placeholder="Password"
    >

    <br><br>

    <button type="submit" name="login">
        Login
    </button>

</form>

</body>

</html>