<?php
session_start();
include "connect.php";

if (!isset($_SESSION['user_email'])) {
    header("Location: login.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <link rel="stylesheet" href="bootstrap-5.0.2-dist\css\bootstrap.css">
    <link rel="stylesheet" href="bootstrap-5.0.2-dist\js\bootstrap.js">
    <title>Document</title>
</head>
<body>
    <div class="container mt-5">
        <div class="table-responsive">
        <table border="1" class="table table-striped table-bordered">
            <h2 class=""><b>Student List</b></h2>
            <div class="d-flex justify-content-end">
            <a href="logout.php" class="btn btn-success float-start">Logout</a>
            </div>
            <hr>
            <tr>
                <th>No</th>
                <th>Names</th>
                <th>Email</th>
                <th>Action</th>
            </tr>        
        

        <?php
        $select = mysqli_query($connect,"SELECT*FROM students");
        if(mysqli_num_rows($select) > 0){
            while($row = mysqli_fetch_assoc($select)){
                echo "<tr>";
                echo "<td>".$row['id']."</td>";
                echo "<td>".$row['name']."</td>";
                echo "<td>".$row['email']."</td>";
                echo "<td>
                        <a href='update.php?id=".$row['id']."' class='btn btn-success btn-sm'>Update</a>
                        <a href='delet.php?id=".$row['id']."' class='btn btn-danger btn-sm' onclick='return confirm(\"Are you sure you want to delete this student?\");'>Delete</a>
                    </td>";
                echo "</tr>";
            }
        }else {
                    echo "<tr><td colspan='6' class='text-center'>No records found</td></tr>";
             }
        ?>

        </table>
    </div>
    </div>
</body>
</html>