<?php
session_start();
if(isset($_POST['username']) && isset($_POST['password'])){
include 'connection.php';

$username = trim($_POST['username']);
$password = trim($_POST['password']);
// $username = mysql_real_escape_string(trim($_POST['username']));
// $password = mysql_real_escape_string(trim($_POST['password']));


$sql =  mysqli_query($dbconnect,"SELECT*FROM tb_pengguna WHERE username='$username' AND password='$password'");
$cek = mysqli_num_rows($sql);

    if($cek > 0){
        $_SESSION ['status'] = '0';
        $_SESSION ['username'] = $username;
        header("location: ../index.php?page=dashboard");
    }else{
        $_SESSION['status'] = '1';
        header("location:../login.php?error=true");
    }
}else{
    header("location:../login.php?error=true");
}
?>