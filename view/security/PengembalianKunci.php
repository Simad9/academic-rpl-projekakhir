<?php
require '../../model/be_main.php';

$query = "SELECT *, kunci.nama as 'nama_kunci', mahasiswa.nama as 'nama_mhs' FROM lap_pinjamKunci
INNER JOIN kunci ON lap_pinjamKunci.id_kunci = kunci.id_kunci
INNER JOIN mahasiswa ON lap_pinjamKunci.id_mhs = mahasiswa.id_mhs
WHERE diizinkan = 1";
$hasil = mysqli_query($koneksi, $query);

if (isset($_POST["dibalikan"])) {
  be_kunciKembali();
}

// notif
$statusMsg = '';
$statusError = false;
if (isset($_GET["status"])) {
  switch ($_GET["status"]) {
    case "gagal":
      $statusMsg = "Ada yang salah, silahkan coba lagi";
      $statusError = true;
      break;
    case "kunciBalik":
      $statusMsg = "Kunci dikembalikan";
      break;
  }
}
?>


<!DOCTYPE html>
<html lang="id">

<head>
  <?php include '../../tamplate/meta.php'; ?>
  <?php require '../../tamplate/judul.php'; ?>
  <title>Pengembalian Kunci</title>
</head>

<body class="bg-s-grey/20">
  <main class="w-full max-w-[430px] mx-auto min-h-screen bg-s-white shadow-2xl flex flex-col">
    <?php judulPath("Pengembalian Kunci", "./FiturTambahan.php") ?>

    <div class="flex-1 flex flex-col gap-5 px-4 py-5">
      <h1 class="text-base font-semibold text-s-black">Laporan Pengembalian Kunci</h1>

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
                <p>No Hp : <?= $data['noHp'] ?></p>
              </div>
            </div>

            <form action="" method="post">
              <input type="hidden" name="id_pinjamKunci" value="<?= $data['id_pinjamKunci'] ?>">
              <div class="flex gap-2 w-full">
                <?php $data['noHp'] = ltrim($data['noHp'], '0'); ?>
                <a href="https://wa.me/+62<?= $data['noHp'] ?>" target="_blank" rel="noopener"
                  class="flex-1 h-[44px] flex items-center justify-center gap-2 rounded-lg border border-s-white/60 bg-s-white text-ijo-600 font-semibold text-sm hover:bg-ijo-100 active:bg-ijo-100 transition-colors">
                  <svg class="w-4 h-4 shrink-0" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                    <path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z" />
                  </svg>
                  Hubungi
                </a>
                <button type="submit" name="dibalikan"
                  class="flex-1 h-[44px] flex items-center justify-center rounded-lg border border-s-white/60 bg-s-white text-ijo-600 font-semibold text-sm hover:bg-ijo-100 active:bg-ijo-100 transition-colors">
                  Dibalikan
                </button>
              </div>
            </form>
          </div>
        <?php endwhile; ?>

      <?php else : ?>
        <div class="flex flex-col items-center gap-3 py-16 text-center">
          <div class="w-16 h-16 rounded-full bg-ijo-100 flex items-center justify-center">
            <svg class="w-8 h-8 text-ijo-600" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
              <path d="M2 18h20" />
              <path d="m6 14-2-2 2-2" />
              <path d="m18 10 2 2-2 2" />
              <rect x="6" y="3" width="12" height="18" rx="2" />
            </svg>
          </div>
          <p class="text-sm font-medium text-s-black">Tidak ada pengembalian</p>
          <p class="text-xs text-s-grey max-w-[220px]">Kunci yang sudah diizinkan dipinjam akan tampil di sini.</p>
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
