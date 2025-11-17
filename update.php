<?php
session_start();
include "connect.php";

if(!isset($_SESSION['user_email'])){
    header("location: login.php");
    exit;
}

if(isset($_GET['id'])){
    $id = $_GET['id'];
}else{
    echo "<script>alert('No user id found!');
    window.alert='login.php';
    </script>";
}

$select = mysqli_query($connect,"SELECT*FROM students WHERE id=$id");
$rows = mysqli_fetch_assoc($select);

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <link rel="stylesheet" href="bootstrap-5.0.2-dist\css\bootstrap.css">
    <link rel="stylesheet" href="bootstrap-5.0.2-dist\js\bootstrap.js">
    <title>Update Form</title>
</head>
<body class="bg-light d-flex justify-content-center align-items-center vh-100">
    <div class="bg-white shadow p-4 rounded w-100" style="max-width: 400px;">
      
         <div class="container mt-3">
            <h2>Update Student Account</h2>
        <form action="" method="POST">

     <div class="mb-3">
            <label>Full Name:</label>
            <input type="text" name="name" class="form-control" value="<?php $rows['name']; ?>" placeholder="update your Full name" required>
        </div>

        <div class="mb-3">
            <label for="email">Email:</label>
            <input type="email" name="email" class="form-control" value="<?php $rows['email']; ?>" placeholder="update your Email name" required>
        </div>

      <div class="mb-3">
            <label>Password:</label>
            <input type="password" name="password" class="form-control" value="<?php $rows['password']; ?>" placeholder="new Password" required minlength="6">
        </div>

      <div class="mb-3">
            <label>Confirm Password:</label>
            <input type="password" name="cpassword" class="form-control" placeholder="Enter your Password again" required minlength="6">
        </div>

      <input type="submit" name="update" class="btn btn-primary" value="Update">
    </form>
    <?php
    
    if(isset($_POST['update'])){
        $name = $_POST['name'];
        $email = $_POST['email'];
        $password = $_POST['password'];
        $cpassword = $_POST['cpassword'];
        $hashed = password_hash($password,PASSWORD_DEFAULT);

        if(strlen($password) < 6){
            echo "<script>alert('Password must be at least 6 characters or above')</script>";
            exit;
        }

        if($password !==$cpassword){
            echo "<script>alert('confirm password must be the same as password')</script>";
            exit;
        }

        $check = mysqli_query($connect,"SELECT*FROM students WHERE email = '$email'");
        if(mysqli_num_rows($check) >0 ){
            echo "<script>alert('Email arleady exist')</script>";
            exit;
        }

        $update = mysqli_query($connect,"UPDATE students SET name='$name',email='$email',password='$hashed' where id='$id'");
        if($update){
            echo "<script>alert('Student well updated');
            window.location='index.php';
            </script>";
        }else{
             echo "<script>alert('Student Not updated');
            window.location='index.php';
            </script>";
        }


        

    }
    ?>

    </div>
    </div>
</body>
</html>