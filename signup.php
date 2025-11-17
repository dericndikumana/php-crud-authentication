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
    <title>SignUp Form</title>
</head>
<body class="bg-light d-flex justify-content-center align-items-center vh-100">
    <div class="bg-white shadow p-4 rounded w-100" style="max-width: 400px;">
      
         <div class="container mt-3">
            <h2>Create Your Account</h2>
        <form action="" method="POST">

     <div class="mb-3">
            <label>Full Name:</label>
            <input type="text" name="name" class="form-control" placeholder="Enter your Full name" required>
        </div>

        <div class="mb-3">
            <label for="email">Email:</label>
            <input type="email" name="email" class="form-control" placeholder="Enter your Email name" required>
        </div>

      <div class="mb-3">
            <label>Password:</label>
            <input type="password" name="password" class="form-control" placeholder="Enter your Password" required minlength="6">
        </div>

      <div class="mb-3">
            <label>Confirm Password:</label>
            <input type="password" name="cpassword" class="form-control" placeholder="Enter your Password" required minlength="6">
        </div>

      <input type="submit" name="signup" class="btn btn-primary" value="SignUp">

        <div class="signup-link">
        You have an account? <a href="login.php">Login here</a>
    </div>
    </form>

    <?php
    
    if(isset($_POST['signup'])){
        $name = $_POST['name'];
        $email = $_POST['email'];
        $password = $_POST['password'];
        $confirm  = $_POST['cpassword'];
        $hashed = password_hash($password,PASSWORD_DEFAULT);

        if(strlen($password) < 6){
            echo "<script>alert('Password must be at least 6 characters');</script>";
            exit;
        }

        if($confirm !== $password){
            echo "<script>alert('Confirm password is not the same as password');</script>";
            exit;
        }
        // checking email 
        $check = mysqli_query($connect,"SELECT*FROM students WHERE email='$email'");
        if(mysqli_num_rows($check) > 0){
            echo "<script>alert('Email arleady registered');</script>";
            exit;
        }

        $insert = mysqli_query($connect,"INSERT INTO students(name,email,password) values('$name','$email','$hashed')");
        if ($insert) {
            $_SESSION['user_email'] = $email;
        echo "<script>
        alert('Student well inserted successfully!');
        window.location='login.php';
        </script>";
        exit;
    } else {
        echo "<script>alert('Student not inserted');</script>";
    }
    }
    ?>


    </div>
    </div>
</body>
</html>