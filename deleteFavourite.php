<?php

header("Access-Control-Allow-Origin: *");

include 'koneksi.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Pastikan bahwa parameter id tersedia
    if (isset($_POST['id_favourite']) && isset($_POST['id_user'])) {
        $id_favourite = $_POST['id_favourite'];
	$id_user = $_POST['id_user'];

        $sql = "DELETE FROM favourite WHERE id_favourite='$id_favourite' AND id_user='$id_user'";
        if ($koneksi->query($sql) === TRUE) {
            $response['isSuccess'] = true;
            $response['message'] = "Berhasil menghapus data Favourite";
        } else {
            $response['isSuccess'] = false;
            $response['message'] = "Gagal menghapus data Favourite: " . $koneksi->error;
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
