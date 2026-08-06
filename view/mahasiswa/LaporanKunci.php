<?php
require '../../model/be_main.php';

$query = "SELECT *, kunci.nama as 'nama_kunci', mahasiswa.nama as 'nama_mhs' FROM lap_pinjamKunci
INNER JOIN kunci ON lap_pinjamKunci.id_kunci = kunci.id_kunci
INNER JOIN mahasiswa ON lap_pinjamKunci.id_mhs = mahasiswa.id_mhs
WHERE diizinkan = 1";
$hasil = mysqli_query($koneksi, $query);

?>
<!DOCTYPE html>
<html lang="id">

<head>
  <?php include '../../tamplate/meta.php'; ?>
  <?php require '../../tamplate/judul.php'; ?>
  <title>Laporan Kunci</title>
</head>

<body class="bg-s-grey/20">
  <main class="w-full max-w-[430px] mx-auto min-h-screen bg-s-white shadow-2xl flex flex-col">
    <?php judulPath("Laporan Kunci", "../../index.php") ?>

    <div class="flex-1 flex flex-col gap-5 px-4 py-5">
      <div class="flex items-center justify-between gap-2">
        <h1 class="text-base font-semibold text-s-black">Fitur Kami</h1>
        <a href="./LaporanPinjamKunci.php" aria-label="Laporan Pinjam Kunci">
          <img src="../../assets/sementara/mhs-icon-pinjamKunci.svg" alt="">
        </a>
      </div>

      <div class="flex items-center gap-2">
        <a href="./LaporanBarang.php">
          <img src="../../assets/sementara/mhs-icon-lapBarang-off.svg" alt="Laporan Barang">
        </a>
        <div>
          <img src="../../assets/sementara/mhs-icon-lapKunci.svg" alt="Laporan Kunci">
        </div>
      </div>

      <?php
      if (mysqli_num_rows($hasil) > 0) :
        while ($data = mysqli_fetch_assoc($hasil)) :
      ?>
          <div class="flex flex-col gap-3 p-3 rounded-xl bg-ijo-500 text-s-white">
            <div class="flex items-center justify-between gap-2">
              <h2 class="text-sm font-semibold"><?= $data['nama_kunci'] ?></h2>
              <span class="shrink-0 text-xs text-ijo-100"><?= tampilanTanggal($data['tanggal']) ?></span>
            </div>

            <div class="flex gap-3">
              <div class="w-16 h-16 shrink-0 rounded-lg overflow-hidden bg-s-white/20">
                <img src="../../img/kunci/<?= $data['urlFoto'] ?>" alt="Foto Kunci" class="object-cover w-full h-full">
              </div>
              <div class="flex flex-col gap-1 text-xs min-w-0">
                <p>Nama : <?= $data['nama_mhs'] ?></p>
                <p>Jurusan : <?= $data['jurusan'] ?></p>
                <p>Nomor Hp : <?= $data['noHp'] ?></p>
              </div>
            </div>
          </div>
        <?php endwhile; ?>

      <?php else : ?>
        <div class="flex flex-col items-center gap-3 py-16 text-center">
          <div class="w-16 h-16 rounded-full bg-ijo-100 flex items-center justify-center">
            <svg class="w-8 h-8 text-ijo-600" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
              <rect x="3" y="11" width="18" height="11" rx="2" />
              <path d="M7 11V7a5 5 0 0 1 10 0v4" />
            </svg>
          </div>
          <p class="text-sm font-medium text-s-black">Tidak ada laporan kunci</p>
          <p class="text-xs text-s-grey max-w-[220px]">Kunci yang sedang dipinjam mahasiswa akan tampil di sini.</p>
        </div>
      <?php endif; ?>

    </div>
  </main>
</body>

</html>