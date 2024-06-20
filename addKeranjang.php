<?php

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json");

include 'koneksi.php';

$response = array();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    if (isset($_POST['id_user']) && isset($_POST['id_produk']) && isset($_POST['jumlah'])) {
        $id_user = $_POST['id_user'];
        $id_produk = $_POST['id_produk'];
        $jumlah = $_POST['jumlah'];

        // Mendapatkan harga produk dari tabel produk
        $sql = "SELECT harga FROM produk WHERE id_produk = ?";
        $stmt = $koneksi->prepare($sql);
        if ($stmt === false) {
            $response['isSuccess'] = false;
            $response['message'] = "Failed to prepare statement: " . $koneksi->error;
        } else {
            $stmt->bind_param("s", $id_produk);
            $stmt->execute();
            $stmt->bind_result($harga);
            $stmt->fetch();
            $stmt->close();

            if ($harga !== null) {
                $subtotal = $harga * $jumlah;

                // Insert into database
                $sql = "INSERT INTO keranjang (id_user, id_produk, jumlah, subtotal) VALUES (?, ?, ?, ?)";
                $stmt = $koneksi->prepare($sql);
                if ($stmt === false) {
                    $response['isSuccess'] = false;
                    $response['message'] = "Failed to prepare statement: " . $koneksi->error;
                } else {
                    $stmt->bind_param("sssd", $id_user, $id_produk, $jumlah, $subtotal); // Bind four parameters
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
                $response['message'] = "Produk tidak ditemukan";
            }
        }
    } else {
        $response['isSuccess'] = false;
        $response['message'] = "Required fields are missing";
    }
} else {
    $response['isSuccess'] = false;
    $response['message'] = "Only POST method is allowed";
}

echo json_encode($response);
?>
