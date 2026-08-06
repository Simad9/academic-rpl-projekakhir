<?php
require '../../model/be_main.php';

$query = "SELECT * FROM lap_kehilangan
INNER JOIN lap_barang ON lap_kehilangan.id_lapBarang = lap_barang.id_lapBarang
INNER JOIN mahasiswa ON lap_kehilangan.id_mhs = mahasiswa.id_mhs";
$hasil = mysqli_query($koneksi, $query);

// notif
$statusMsg = '';
$statusError = false;
if (isset($_GET["status"])) {
  switch ($_GET["status"]) {
    case "terhapus":
      $statusMsg = "Laporan dihapus";
      break;
  }
}
?>
<!DOCTYPE html>
<html lang="id">

<head>
  <?php include '../../tamplate/meta.php'; ?>
  <?php require '../../tamplate/judul.php'; ?>
  <title>Lap. Kehilangan</title>
</head>

<body class="bg-s-grey/20">
  <main class="w-full max-w-[430px] mx-auto min-h-screen bg-s-white shadow-2xl flex flex-col">
    <?php judulPath("Lap. Kehilangan", "./FiturTambahan.php") ?>

    <div class="flex-1 flex flex-col gap-5 px-4 py-5">
      <h1 class="text-base font-semibold text-s-black">Laporan Kehilangan Barang</h1>

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

            <div class="w-full h-[2px] bg-s-white/30"></div>

            <div class="flex flex-col gap-1.5 text-xs">
              <p class="font-bold">Pelapor</p>
              <p>Nama : <?= $data['nama'] ?></p>
              <p>Nomor Hp : <?= $data['noHp'] ?></p>
            </div>

            <div class="flex gap-2 w-full">
              <?php $data['noHp'] = ltrim($data['noHp'], '0'); ?>
              <a href="https://wa.me/+62<?= $data['noHp'] ?>" target="_blank" rel="noopener"
                class="flex-1 h-[44px] flex items-center justify-center gap-2 rounded-lg border border-s-white/60 bg-s-white text-ijo-600 font-semibold text-sm hover:bg-ijo-100 active:bg-ijo-100 transition-colors">
                <svg class="w-4 h-4 shrink-0" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                  <path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z" />
                </svg>
                Hubungi
              </a>
              <a href="DetailKehilangan.php?id_lapKehilangan=<?= $data['id_lapKehilangan'] ?>"
                class="flex-1 h-[44px] flex items-center justify-center gap-2 rounded-lg border border-s-white/60 bg-s-white text-ijo-600 font-semibold text-sm hover:bg-ijo-100 active:bg-ijo-100 transition-colors">
                <svg class="w-4 h-4 shrink-0" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                  <path d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0z" />
                  <path d="M2.06 12.35a1 1 0 0 1 0-.7 10.75 10.75 0 0 1 19.88 0 1 1 0 0 1 0 .7 10.75 10.75 0 0 1-19.88 0" />
                </svg>
                Cek Detail
              </a>
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
          <p class="text-sm font-medium text-s-black">Tidak ada laporan kehilangan</p>
          <p class="text-xs text-s-grey max-w-[220px]">Laporan kehilangan barang dari mahasiswa akan tampil di sini.</p>
        </div>
      <?php endif; ?>

    </div>
  </main>

  <?php if ($statusMsg) : ?>
    <div id="toast" class="fixed bottom-20 left-1/2 -translate-x-1/2 z-50 flex items-center gap-2 px-4 py-3 rounded-xl <?= $statusError ? 'bg-s-red' : 'bg-ijo-600' ?> text-s-white text-sm font-medium shadow-lg">
      <svg class="w-5 h-5 shrink-0" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
        <?php if ($statusError) : ?>
          <circle cx="12" cy="12" r="10" />
          <path d="M12 8v4" />
          <path d="M12 16h.01" />
        <?php else : ?>
          <path d="M20 6 9 17l-5-5" />
        <?php endif; ?>
      </svg>
      <?= $statusMsg ?>
      <button type="button" onclick="closeToast()" aria-label="Tutup" class="flex items-center justify-center w-6 h-6 rounded-full hover:bg-s-white/20">
        <svg class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
          <path d="M18 6 6 18" />
          <path d="m6 6 12 12" />
        </svg>
      </button>
    </div>
    <script>
      function closeToast() {
        var toast = document.getElementById('toast');
        if (toast) toast.remove();
      }
      setTimeout(closeToast, 3000);
    </script>
  <?php endif; ?>
</body>

</html>
