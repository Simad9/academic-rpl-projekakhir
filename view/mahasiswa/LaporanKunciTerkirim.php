<?php
require '../../model/be_main.php';

$id_mhs = $_GET["id_mhs"];
$id_kunci = $_GET["id_kunci"];

$query = "SELECT *, kunci.nama as 'nama_kunci', mahasiswa.nama as 'nama_mhs' FROM lap_pinjamKunci
INNER JOIN kunci ON lap_pinjamKunci.id_kunci = kunci.id_kunci
INNER JOIN mahasiswa ON lap_pinjamKunci.id_mhs = mahasiswa.id_mhs
WHERE lap_pinjamKunci.id_mhs = '$id_mhs' AND lap_pinjamKunci.id_kunci = '$id_kunci'";
$result = mysqli_query($koneksi, $query);
$data = mysqli_fetch_assoc($result);

?>
<!DOCTYPE html>
<html lang="id">

<head>
  <?php include '../../tamplate/meta.php'; ?>
  <?php require '../../tamplate/judul.php'; ?>
  <title>Laporan Terkirim</title>
</head>

<body class="bg-s-grey/20">
  <main class="w-full max-w-[430px] mx-auto min-h-screen bg-s-white shadow-2xl flex flex-col">
    <?php judulPolos("Laporan Terkirim") ?>

    <div class="flex-1 flex flex-col items-center justify-center gap-8 px-4 pb-16 text-center">
      <div class="flex flex-col items-center gap-4">
        <div class="w-24 h-24 rounded-full bg-ijo-100 flex items-center justify-center">
          <svg class="w-12 h-12 text-ijo-600" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
            <circle cx="12" cy="12" r="10" />
            <path d="m8 12 3 3 5-6" />
          </svg>
        </div>

        <div class="flex flex-col gap-1">
          <p class="text-xl font-bold text-s-black">Nama : <?= $data["nama_mhs"] ?></p>
          <p class="text-xl font-bold text-s-black">Jurusan : <?= $data["jurusan"] ?></p>
          <p class="text-xl font-bold text-s-black">Kunci yang dipinjam</p>
          <p class="text-xl font-bold text-ijo-600">"<?= $data["nama_kunci"] ?>"</p>
        </div>

        <p class="text-sm font-medium text-s-grey max-w-[280px]">Silahkan screenshot halaman ini dan laporkan ke security yang bertugas untuk diizinkan.</p>
      </div>

      <a href="./LaporanKunci.php"
        class="w-full h-[48px] flex items-center justify-center rounded-xl bg-ijo-500 text-s-white font-semibold text-base hover:bg-ijo-600 active:bg-ijo-600 focus-visible:ring-2 focus-visible:ring-ijo-400 transition-colors">
        Kembali ke Halaman Awal
      </a>
    </div>
  </main>
</body>

</html>
