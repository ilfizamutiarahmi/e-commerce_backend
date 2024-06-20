<?php

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json");

include 'koneksi.php';

$response = array();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    
    // Ensure all required fields are present
    if (isset($_POST['id_alamat'], $_POST['id_produk'], $_POST['jumlah'], $_POST['id_user'], $_POST['metode_pembayaran'])) {
        $id_alamat = $_POST['id_alamat'];
        $id_produk = $_POST['id_produk'];
        $jumlah = $_POST['jumlah'];
        $id_user = $_POST['id_user'];
        $metode_pembayaran = $_POST['metode_pembayaran'];

        // Prepare to fetch the price of the product from the produk table
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
                $total_bayar = $harga * $jumlah;

                // Delete the same product from the cart if it exists
                $sql_delete = "DELETE FROM keranjang WHERE id_produk = ? AND id_user = ?";
                $stmt_delete = $koneksi->prepare($sql_delete);

                if ($stmt_delete === false) {
                    $response['isSuccess'] = false;
                    $response['message'] = "Failed to prepare delete statement: " . $koneksi->error;
                } else {
                    $stmt_delete->bind_param("ss", $id_produk, $id_user);
                    $stmt_delete->execute();
                    $stmt_delete->close();

                    // Insert into the orders (pesanan) table
                    $sql_insert = "INSERT INTO pesanan (id_alamat, id_produk, jumlah, id_user, total_bayar, metode_pembayaran) VALUES (?, ?, ?, ?, ?, ?)";
                    $stmt_insert = $koneksi->prepare($sql_insert);

                    if ($stmt_insert === false) {
                        $response['isSuccess'] = false;
                        $response['message'] = "Failed to prepare insert statement: " . $koneksi->error;
                    } else {
                        $stmt_insert->bind_param("ssssis", $id_alamat, $id_produk, $jumlah, $id_user, $total_bayar, $metode_pembayaran);

                        if ($stmt_insert->execute()) {
                            $response['isSuccess'] = true;
                            $response['message'] = "Berhasil menambahkan data";
                        } else {
                            $response['isSuccess'] = false;
                            $response['message'] = "Gagal menambahkan data: " . $stmt_insert->error;
                        }

                        $stmt_insert->close();
                    }
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
