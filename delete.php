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
    window.location='login.php';
    </script>";
}

$delete = mysqli_query($connect,"DELETE from students where id='$id' ");
if($delete){
    echo "<script>
        alert('Student well deleted!');
        window.location='index.php';
        </script>";
}else{
    echo "<script>
        alert('Student well deleted');
        window.location='index.php';
        </script>";
}
?>