<?php

header("Access-Control-Allow-Origin: *");

include 'koneksi.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Pastikan bahwa parameter id tersedia
    if (isset($_POST['id_alamat'])) {
        $id_alamat = $_POST['id_alamat'];

        $sql = "DELETE FROM alamat_pengiriman WHERE id_alamat='$id_alamat'";
        if ($koneksi->query($sql) === TRUE) {
            $response['isSuccess'] = true;
            $response['message'] = "Berhasil menghapus data alamat";
        } else {
            $response['isSuccess'] = false;
            $response['message'] = "Gagal menghapus data alamat: " . $koneksi->error;
        }
    } else {
        $response['isSuccess'] = false;
        $response['message'] = "Parameter tidak lengkap";
    }
} else {
    $response['isSuccess'] = false;
    $response['message'] = "Metode yang diperbolehkan hanya POST";
}

echo json_encode($response);
