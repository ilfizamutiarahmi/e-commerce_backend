<?php

header("Access-Control-Allow-Origin: *");

include 'koneksi.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Pastikan bahwa parameter id_alamat dan id_user tersedia
    if (isset($_POST['id_alamat']) && isset($_POST['id_user'])) {
        $id_alamat = $_POST['id_alamat'];
        $id_user = $_POST['id_user'];

        $sql = "DELETE FROM alamat_pengiriman WHERE id_alamat='$id_alamat' AND id_user='$id_user'";
        
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
?>
