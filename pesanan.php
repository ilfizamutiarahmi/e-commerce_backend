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
            // Query untuk mendapatkan data pesanan
            $sql = "SELECT produk.nama_produk, pesanan.jumlah, produk.harga, pesanan.total_bayar, alamat_pengiriman.nama,
                    alamat_pengiriman.no_hp, alamat_pengiriman.alamat, alamat_pengiriman.kode_pos
                    FROM pesanan 
                    JOIN produk ON pesanan.id_produk = produk.id_produk 
                    JOIN alamat_pengiriman ON pesanan.id_alamat
                    WHERE pesanan.id_user = ? AND pesanan.status = ?";

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
                            'nama' => $row['nama'],
                            'no_hp' => $row['no_hp'],
                            'alamat' => $row['alamat'],
                            'kode_pos' => $row['kode_pos'],
                            'nama_produk' => $row['nama_produk'],
                            'jumlah' => $row['jumlah'],
                            'harga' => $row['harga'],
                            'total_bayar' => $row['total_bayar'],
                        );
                        array_push($response['data'], $data);
                    }
                } else {
                    $response['isSuccess'] = false;
                    $response['message'] = "pesanan kosong";
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
