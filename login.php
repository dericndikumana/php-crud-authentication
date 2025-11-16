<?php
session_start();
include "connect.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <link rel="stylesheet" href="bootstrap-5.0.2-dist\css\bootstrap.css">
    <link rel="stylesheet" href="bootstrap-5.0.2-dist\js\bootstrap.js">
    <title>Login Form</title>
</head>
<body class="bg-light d-flex justify-content-center align-items-center vh-100">
    <div class="bg-white shadow p-4 rounded w-100" style="max-width: 400px;">
      
         <div class="container mt-3">
            <h2>Login to Your Account</h2>
        <form action="" method="POST">

        <div class="mb-3">
            <label for="email">Email:</label>
            <input type="email" name="email" class="form-control" placeholder="Enter your Email name" required>
        </div>

      <div class="mb-3">
            <label>Password:</label>
            <input type="password" name="password" class="form-control" placeholder="Enter your Password" required minlength="6">
        </div>

      <input type="submit" name="login" class="btn btn-primary" value="Login">

        <div class="signup-link">
        Don't have an account? <a href="signup.php">SignUp here</a>
    </div>
    </form>
    </div>
    </div>

    <?php
    if(isset($_POST['login'])){
        $email = $_POST['email'];
        $password = $_POST['password'];

        $select = mysqli_query($connect,"SELECT*FROM students WHERE email='$email' AND password='$password'");
         if (mysqli_num_rows($select) == 1) {
        $_SESSION['user_email'] = $email;
        header("Location: index.php");
        exit;
    } 
    else {
        echo "<script>alert('Incorrect email or password');</script>";
    }
    }
    ?>
</body>
</html>