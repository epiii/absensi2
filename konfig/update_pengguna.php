<?php

if (isset($_POST['username']) && isset($_POST['password'])) {
    require 'dev.php';
    include 'connection.php';

    $username = trim($_POST['username']);
    $password = trim($_POST['password']);
    $level = trim($_POST['role']);
    $id_karyawan = trim($_POST['id_karyawan']);
    $no = trim($_POST['id']);
    // pr('ok');

    if ($level == '1') { // user
        $ss = ' SELECT *
                FROM tb_pengguna
                WHERE
                    level = "1" 
                    and id_karyawan = "' . $id_karyawan . '"';
        $ee = mysqli_query($dbconnect, $ss);
        $nn = mysqli_num_rows($ee);
        
        // pr($nn);
        if ($nn > 0) {
            $out = ['msg' => 'pegawai sudah mempunyai user login', 'status' => false];
        } else {
            $query = 'UPDATE tb_pengguna SET 
                        username="' . $username . '", 
                        password="' . $password . '",
                        id_karyawan="' . $id_karyawan . '",
                        level="' . $level . '" 
                    WHERE no=' . $no;

            // pr($query);
            $sql = mysqli_query($dbconnect, $query);

            if ($sql) {
                $out = ['msg' => 'berhasil menyimpan data', 'status' => true];
            } else {
                $out = ['msg' => 'gagal, ' . mysqli_error($dbconnect), 'status' => false];
            }
        }
    } else { // admin 
        $query = "UPDATE tb_pengguna SET 
                    username=" . $username . ", 
                    password=" . $password . ",
                    level=" . $level . "
                WHERE no=" . $id;
        $sql = mysqli_query($dbconnect, $query);

        if ($sql) {
            $out = ['msg' => 'berhasil menyimpan data', 'status' => true];
        } else {
            $out = ['msg' => 'gagal, ' . mysqli_error($dbconnect), 'status' => false];
        }
    }
} else {
    $out = ['msg' => 'unauthorized, method is invalid', 'status' => false];
    // $error = 'true';
}
echo json_encode($out);
// header("location:../index.php?page=pengguna&error=" . $error);
