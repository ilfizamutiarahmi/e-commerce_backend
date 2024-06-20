<?php

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json");

include 'koneksi.php';

$response = array();

if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    if (isset($_GET['id_kategori'])) {
        $id_kategori = $_GET['id_kategori'];

        // Memastikan koneksi berhasil
        if ($koneksi->connect_error) {
            $response['isSuccess'] = false;
            $response['message'] = "Connection failed: " . $koneksi->connect_error;
        } else {
            // Query untuk mendapatkan data produk
            $sql = "SELECT produk.nama_produk, produk.stok, produk.harga, produk.berat, produk.keterangan, produk.gambar
                    FROM produk 
                    WHERE produk.id_kategori = ?";

            $stmt = $koneksi->prepare($sql);
            if ($stmt === false) {
                $response['isSuccess'] = false;
                $response['message'] = "Failed to prepare statement: " . $koneksi->error;
            } else {
                $stmt->bind_param("i", $id_kategori);
                $stmt->execute();
                $result = $stmt->get_result();

                if ($result->num_rows > 0) {
                    $response['isSuccess'] = true;
                    $response['data'] = array();

                    while ($row = $result->fetch_assoc()) {
                        $data = array(
                            'nama_produk' => $row['nama_produk'],
                            'harga' => $row['harga'],
                            'berat' => $row['berat'],
                            'keterangan' => $row['keterangan'],
                            'gambar' => $row['gambar'],
                            'stok' => $row['stok']
                        );
                        array_push($response['data'], $data);
                    }
                } else {
                    $response['isSuccess'] = false;
                    $response['message'] = "Produk tidak ditemukan untuk kategori ini";
                }
                $stmt->close();
            }
        }
    } else {
        $response['isSuccess'] = false;
        $response['message'] = "Required fields are missing";
    }
} else {
    $response['isSuccess'] = false;
    $response['message'] = "Only GET method is allowed";
}

echo json_encode($response);
?>
