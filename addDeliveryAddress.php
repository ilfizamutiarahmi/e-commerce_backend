<?php

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json");

include 'koneksi.php';

$response = array();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    if (isset($_POST['id_user']) && isset($_POST['nama']) && isset($_POST['no_hp']) && isset($_POST['alamat']) && isset($_POST['kode_pos'])) {
        $id_user = $_POST['id_user'];
        $nama = $_POST['nama'];
        $no_hp = $_POST['no_hp'];
        $alamat = $_POST['alamat'];
        $kode_pos = $_POST['kode_pos'];

        // Insert into database
        $sql = "INSERT INTO alamat_pengiriman (id_user, nama, no_hp, alamat, kode_pos) VALUES (?, ?, ?, ?, ?)";
        $stmt = $koneksi->prepare($sql);
        if ($stmt === false) {
            $response['isSuccess'] = false;
            $response['message'] = "Failed to prepare statement: " . $koneksi->error;
        } else {
            $stmt->bind_param("sssss", $id_user, $nama, $no_hp, $alamat, $kode_pos); // Bind parameters
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
        $response['message'] = "Data tidak lengkap";
    }
} else {
    $response['isSuccess'] = false;
    $response['message'] = "Only POST method is allowed";
}

echo json_encode($response);

?>
