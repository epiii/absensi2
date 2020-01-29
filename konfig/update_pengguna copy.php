<?php 
session_start();
if(isset($_SESSION['page'])){

if(isset($_POST['no'])){

include 'connection.php';
$no = mysql_real_escape_string(trim($_POST['no']));
$username = mysql_real_escape_string(trim($_POST['username']));
$password = mysql_real_escape_string(trim($_POST['password']));
$role = mysql_real_escape_string(trim($_POST['role']));

$sql = mysqli_query($dbconnect, "UPDATE tb_pengguna SET username='$username', password='$password', level='$role' WHERE no='$no'");
    if($sql){
        $error = "false";
    }else{
        $error = "true";
    }
}else{
    $error="true";
}

}else{
    $error="true";
}
header("location:../index.php?page=pengguna&error=".$error);

?>