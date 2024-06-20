<?php

header("Access-Control-Allow-Origin: *");
include 'koneksi.php';

if($_SERVER['REQUEST_METHOD'] == "POST") {
    $response = array();
    
    // Memeriksa keberadaan data POST yang diperlukan
    if(isset($_POST['id_user']) && isset($_POST['id_alamat']) && isset($_POST['nama']) && isset($_POST['no_hp']) && isset($_POST['alamat']) && isset($_POST['kode_pos'])) {
        $id_user = $_POST['id_user'];
        $id_alamat = $_POST['id_alamat'];
        $nama = $_POST['nama']; 
        $no_hp = $_POST['no_hp'];
        $alamat = $_POST['alamat'];
        $kode_pos = $_POST['kode_pos'];

        $sql = "UPDATE alamat_pengiriman SET nama = '$nama', no_hp = '$no_hp', alamat = '$alamat', kode_pos = '$kode_pos' WHERE id_alamat = $id_alamat";
        $isSuccess = $koneksi->query($sql);

        if ($isSuccess) {
            $cek = "SELECT * FROM alamat_pengiriman WHERE id_alamat = $id_alamat";
            $result = mysqli_fetch_array(mysqli_query($koneksi, $cek));
            $response['is_success'] = true;
            $response['value'] = 1;
            $response['message'] = "Alamat Pengiriman Berhasil di Edit";
            $response['id_alamat'] = $result['id_alamat'];
            $response['id_user'] = $result['id_user'];
            $response['nama'] = $result['nama']; 
            $response['no_hp'] = $result['no_hp']; 
            $response['alamat'] = $result['alamat']; 
            $response['kode_pos'] = $result['kode_pos']; 
        } else {
            $response['is_success'] = false;
            $response['value'] = 0;
            $response['message'] = "Gagal Edit Alamat Pengiriman: " . $koneksi->error; // Menampilkan pesan kesalahan
        }
    } else {
        // Jika salah satu data POST tidak lengkap
        $response['is_success'] = false;
        $response['value'] = 0;
        $response['message'] = "Data yang diperlukan tidak lengkap";
    }

    echo json_encode($response);
}

?>
