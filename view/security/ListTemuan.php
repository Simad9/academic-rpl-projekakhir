<?php
require '../../model/be_main.php';

$query = "SELECT * FROM lap_barang";
$hasil = mysqli_query($koneksi, $query);
?>

<!DOCTYPE html>
<html lang="id">

<head>
  <?php include '../../tamplate/meta.php'; ?>
  <?php require '../../tamplate/judul.php'; ?>
  <title>List Temuan</title>
</head>

<body class="bg-s-grey/20">
  <main class="w-full max-w-[430px] mx-auto min-h-screen bg-s-white shadow-2xl flex flex-col">
    <?php judulPath("List Temuan", "./SecurityJaga.php") ?>

    <div class="flex-1 flex flex-col gap-5 px-4 py-5">
      <h1 class="text-base font-semibold text-s-black">List Barang Temuan</h1>

      <?php
      if (mysqli_num_rows($hasil) > 0) :
        while ($data = mysqli_fetch_assoc($hasil)) :
          $data['tanggal'] = explode(' ', $data['tanggalWaktu'])[0];
      ?>
          <div class="flex flex-col gap-3 p-3 rounded-xl bg-ijo-500 text-s-white">
            <div class="flex items-center justify-between gap-2">
              <h2 class="text-sm font-semibold"><?= $data['jenisBarang'] ?></h2>
              <span class="shrink-0 text-xs text-ijo-100"><?= tampilanTanggal($data['tanggal']) ?></span>
            </div>

            <div class="flex gap-3">
              <div class="w-16 h-16 shrink-0 rounded-lg overflow-hidden bg-s-white/20">
                <img src="../../img/laporanBarang/<?= $data['urlFoto'] ?>" alt="Foto Barang" class="object-cover w-full h-full">
              </div>
              <div class="flex flex-col gap-1 text-xs min-w-0">
                <p class="font-semibold">Deskripsi ditemukan :</p>
                <p class="font-medium leading-relaxed"><?= $data['deskripsi'] ?></p>
              </div>
            </div>
          </div>
        <?php endwhile; ?>

      <?php else : ?>
        <div class="flex flex-col items-center gap-3 py-16 text-center">
          <div class="w-16 h-16 rounded-full bg-ijo-100 flex items-center justify-center">
            <svg class="w-8 h-8 text-ijo-600" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
              <circle cx="11" cy="11" r="8" />
              <path d="m21 21-4.3-4.3" />
            </svg>
          </div>
          <p class="text-sm font-medium text-s-black">Tidak ada laporan temuan</p>
          <p class="text-xs text-s-grey max-w-[220px]">Barang temuan yang dilaporkan akan tampil di sini.</p>
        </div>
      <?php endif; ?>

    </div>
  </main>
</body>

</html>
