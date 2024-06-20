<?php

$koneksi = mysqli_connect("localhost", "root", "", "e-commerce");

if($koneksi){

	// echo "Database berhasil konek";
	
} else {
	echo "gagal Connect";
}

?>