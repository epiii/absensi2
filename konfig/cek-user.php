<?php
session_start();
if (isset($_POST['username']) && isset($_POST['password'])) {
    include 'connection.php';
    require 'dev.php';

    $username = trim($_POST['username']);
    $password = trim($_POST['password']);
    // $username = mysql_real_escape_string(trim($_POST['username']));
    // $password = mysql_real_escape_string(trim($_POST['password']));


    $query = "SELECT*FROM tb_pengguna WHERE username='$username' AND password='$password'";
    $sql =  mysqli_query($dbconnect, $query);
    $cek = mysqli_num_rows($sql);
    $data = mysqli_fetch_assoc($sql);
    // pr($data);

    if ($cek > 0) {
        $_SESSION['status'] = '0';
        $_SESSION['level'] = $data['level'];
        $_SESSION['username'] = $username;

        if ($data['level'] == '1' && $data['id_karyawan'] != '') {
            $_SESSION['id_karyawan'] = $data['id_karyawan'];

            $ss = 'SELECT * 
                    FROM tb_id i 
                    LEFT JOIN vw_jabatan j on j.id_jabatan = i.id_jabatan
                    LEFT JOIN vw_divisi d on d.id_divisi = i.id_divisi
                    WHERE id=' . $data['id_karyawan'];
            $ee = mysqli_query($dbconnect, $ss);
            $rr = mysqli_fetch_assoc($ee);
            $_SESSION['karyawan'] = $rr;
        }

        header("location: ../index.php?page=dashboard");
    } else {
        $_SESSION['status'] = '1';
        header("location:../login.php?error=true");
    }
} else {
    header("location:../login.php?error=true");
}
