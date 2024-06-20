<?php

header("Access-Control-Allow-Origin: *");

include 'koneksi.php';

if($_SERVER['REQUEST_METHOD'] == "POST") {
    $response = array();
    $username = $_POST['username'];
    $password = md5($_POST['password']);

    $cek = "SELECT * FROM user WHERE username = ? AND password = ? AND verified_code IS NOT NULL AND is_verified = 'verified'";
    $stmt = mysqli_prepare($koneksi, $cek);
    mysqli_stmt_bind_param($stmt, "ss", $username, $password);
    
    // Execute statement
    mysqli_stmt_execute($stmt);
    
    // Get result
    $result = mysqli_stmt_get_result($stmt);

    if(mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        $response['value'] = 1;
        $response['message'] = "berhasil login";
        $response['fullname'] = $row['fullname'];
        $response['jenis_kelamin'] = $row['jenis_kelamin'];
        $response['no_hp'] = $row['no_hp'];
        $response['alamat'] = $row['alamat'];
        $response['role'] = $row['role'];
        $response['email'] = $row['email'];
        $response['id_user'] = $row['id_user'];
        echo json_encode($response);
    } else {
        $response['value'] = 0;
        $response['message'] = "Gagal login. Pastikan email, password benar, dan akun sudah diverifikasi serta kode OTP telah diterima.";
        echo json_encode($response);
    }
}

?>
