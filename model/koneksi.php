<?php
// Mempermudah kalo nanti udah di hosting
$host = "localhost";
$user = "root";
$password = "";
$nama_database = "projek_akhir_rpl";
// Konek ke database
$koneksi = new mysqli($host, $user, $password, $nama_database);
// jika connection nya error
if ($koneksi->connect_error) {
  // jika terjadi error, matikan proses dengan die() atau exit();
  die('Maaf koneksi gagal: ' . $koneksi->connect_error);
}
