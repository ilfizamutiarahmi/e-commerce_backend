<?php

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json");

include 'koneksi.php';

$response = array();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    if (isset($_POST['id_user']) && isset($_POST['id_produk'])) {
        $id_user = $_POST['id_user'];
        $id_produk = $_POST['id_produk'];

        // Insert into database
        $sql = "INSERT INTO favourite (id_user, id_produk) VALUES (?, ?)";
        $stmt = $koneksi->prepare($sql);
        if ($stmt === false) {
            $response['isSuccess'] = false;
            $response['message'] = "Failed to prepare statement: " . $koneksi->error;
        } else {
            $stmt->bind_param("ss", $id_user, $id_produk); // Bind four parameters
            if ($stmt->execute()) {
                $response['isSuccess'] = true;
                $response['message'] = "Berhasil menambahkan data";
            } else {
                $response['isSuccess'] = false;
                $response['message'] = "Gagal menambahkan data: " . $stmt->error;
            }
                $stmt->close();
        }
    } else {
        $response['isSuccess'] = false;
        $response['message'] = "Data tidak ditemukan";
    }
}
else {
    $response['isSuccess'] = false;
    $response['message'] = "Only POST method is allowed";
}

echo json_encode($response);
?>
