<?php

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json");

include 'koneksi.php';

$response = array();

if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    if (isset($_GET['id_user'])) {
        $id_user = $_GET['id_user'];

        // Memastikan koneksi berhasil
        if ($koneksi->connect_error) {
            $response['isSuccess'] = false;
            $response['message'] = "Connection failed: " . $koneksi->connect_error;
        } else {
            // Query untuk mendapatkan data keranjang
            $sql = "SELECT produk.nama_produk, keranjang.jumlah, produk.harga, keranjang.subtotal 
                    FROM keranjang 
                    JOIN produk ON keranjang.id_produk = produk.id_produk 
                    WHERE keranjang.id_user = ?";

            $stmt = $koneksi->prepare($sql);
            if ($stmt === false) {
                $response['isSuccess'] = false;
                $response['message'] = "Failed to prepare statement: " . $koneksi->error;
            } else {
                $stmt->bind_param("i", $id_user);
                $stmt->execute();
                $result = $stmt->get_result();

                if ($result->num_rows > 0) {
                    $response['isSuccess'] = true;
                    $response['data'] = array();

                    while ($row = $result->fetch_assoc()) {
                        $data = array(
                            'nama_produk' => $row['nama_produk'],
                            'jumlah' => $row['jumlah'],
                            'harga' => $row['harga'],
                            'subtotal' => $row['subtotal']
                        );
                        array_push($response['data'], $data);
                    }
                } else {
                    $response['isSuccess'] = false;
                    $response['message'] = "Keranjang kosong";
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
