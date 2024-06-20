<?php

header("Access-Control-Allow-Origin: header");
header("Access-Control-Allow-Origin: *");
include 'koneksi.php';

if($_SERVER['REQUEST_METHOD'] == "POST") {

    $response = array();
    $username = $_POST['username'];
    $fullname = $_POST['fullname'];
    $jenis_kelamin = $_POST['jenis_kelamin'];
    $no_hp = $_POST['no_hp'];
    $alamat = $_POST['alamat'];
    $role = 'customers';
    $email = $_POST['email'];
    $password = md5($_POST['password']);

    $cek = "SELECT * FROM user WHERE username = '$username' OR email = '$email'";
    $result = mysqli_query($koneksi, $cek);

    if(mysqli_num_rows($result) > 0){ 
        $response['value'] = 2;
        $response['message'] = "Username atau email telah digunakan";
        echo json_encode($response);
    } else {
        $insert = "INSERT INTO user (username, fullname, jenis_kelamin, no_hp,alamat, role, email, password) 
                   VALUES ('$username', '$fullname', '$jenis_kelamin','$no_hp','$alamat','$role','$email', '$password')";
        
        if(mysqli_query($koneksi, $insert)){
            $response['value'] = 1;
			$response['username'] = $username;
            $response['fullname'] = $fullname;
            $response['jenis_kelamin'] = $jenis_kelamin;
            $response['no_hp'] = $no_hp;
            $response['alamat'] = $alamat;
            $response['role'] = $role;
            $response['email'] = $email;
            $response['password'] = $password;
            $response['message'] = "Registrasi Berhasil";
            echo json_encode($response);
        } else {
            
            $response['value'] = 0;
            $response['message'] = "Gagal Registrasi";
            echo json_encode($response);
        }
    }
}
?>