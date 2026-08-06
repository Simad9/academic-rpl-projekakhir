<?php
require '../../model/be_main.php';

$query = "SELECT * FROM lap_jaga
INNER JOIN security ON lap_jaga.id_security = security.id_security
LEFT JOIN jadwal ON lap_jaga.id_jadwal = jadwal.id_jadwal";
$hasil = mysqli_query($koneksi, $query);

// notif
$statusMsg = '';
if (isset($_GET["status"])) {
  switch ($_GET["status"]) {
    case "securityDiupdate":
      $statusMsg = "Berhasil update jadwal security";
      break;
    case "diupdate":
      $statusMsg = "Request diterima, ubah jadwal berhasil";
      break;
    case "laporanReqDihapus":
      $statusMsg = "Laporan request dihapus";
      break;
    case "securityDitambah":
      $statusMsg = "Berhasil tambah security";
      break;
    case "securityDihapus":
      $statusMsg = "Security dihapus";
      break;
  }
}
?>
<!DOCTYPE html>
<html lang="id">

<head>
  <?php include '../../tamplate/meta.php'; ?>
  <?php require '../../tamplate/judul.php'; ?>
  <title>Admin</title>
</head>

<body class="bg-s-grey/20">
  <main class="w-full max-w-[430px] mx-auto min-h-screen bg-s-white shadow-2xl flex flex-col">
    <?php judulPolos("Admin") ?>

    <div class="flex-1 flex flex-col gap-5 px-4 py-5">

      <!-- Fitur -->
      <section class="flex flex-col gap-3">
        <h1 class="text-base font-semibold text-s-black">Fitur Kami</h1>

        <section class="flex justify-between items-center">
          <div class="flex gap-[5px]">
            <div>
              <img src="../../assets/sementara/adm-icon-jadwalSecurity.svg">
            </div>
            <a href="./ListKunci.php">
              <img src="../../assets/sementara/adm-icon-listKunci-off.svg">
            </a>
          </div>
          <a href="../../">
            <img src="../../assets/sementara/adm-icon-tombolKeluar.svg">
          </a>
        </section>
        <div class="flex justify-end">
          <a href="./TambahSecurity.php">
            <img src="../../assets/sementara/adm-icon-tambahSecurity.svg">
          </a>
        </div>
      </section>

      <!-- Laporan Request Jadwal -->
      <a href="RequestJadwal.php" class="w-full h-[48px] flex items-center justify-center rounded-xl border border-ijo-500 bg-s-white text-ijo-600 font-semibold text-sm hover:bg-ijo-100 active:bg-ijo-100 focus-visible:ring-2 focus-visible:ring-ijo-400 transition-colors">
        Laporan Request Jadwal
      </a>

      <!-- Jadwal Security -->
      <section class="flex flex-col gap-3">
        <h1 class="text-base font-semibold text-s-black">Jadwal Security</h1>

        <?php
        if (mysqli_num_rows($hasil) > 0) :
          while ($data = mysqli_fetch_assoc($hasil)) :
            switch ($data['id_jadwal']) {
              case 1:
                $jadwal = "07:00 s/d 15:00";
                break;
              case 2:
                $jadwal = "15:00 s/d 22:00";
                break;
              case 3:
                $jadwal = "22:00 s/d 07:00";
                break;
              default:
                $jadwal = "-";
                break;
            }
        ?>
            <div class="flex flex-col gap-3 p-3 rounded-xl bg-ijo-500 text-s-white">
              <div class="flex items-center justify-between gap-2">
                <h2 class="text-sm font-semibold"><?= $data['nama'] ?></h2>
                <span class="shrink-0 px-2.5 py-1 rounded-full bg-s-white/20 text-xs font-medium"><?= $jadwal ?></span>
              </div>
              <div class="w-full h-px bg-s-white/40"></div>
              <p class="text-xs text-ijo-100">No Hp : <?= $data['noHp'] ?></p>
              <div class="flex gap-2 w-full">
                <a href="EditSecurity.php?id_security=<?= $data['id_security'] ?>" class="flex-1 h-[44px] flex items-center justify-center rounded-lg border border-s-white/60 bg-s-white text-ijo-600 font-semibold text-sm hover:bg-ijo-100 active:bg-ijo-100 transition-colors">
                  Edit Data
                </a>
                <a href="EditJadwal.php?id_security=<?= $data['id_security'] ?>" class="flex-1 h-[44px] flex items-center justify-center rounded-lg border border-s-white/60 bg-s-white text-ijo-600 font-semibold text-sm hover:bg-ijo-100 active:bg-ijo-100 transition-colors">
                  Ubah Jadwal
                </a>
              </div>
            </div>
          <?php endwhile; ?>

        <?php else : ?>
          <div class="flex flex-col items-center gap-3 py-16 text-center">
            <div class="w-16 h-16 rounded-full bg-ijo-100 flex items-center justify-center">
              <svg class="w-8 h-8 text-ijo-600" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                <path d="M21 16V8a2 2 0 0 0-1-1.73l-7-4a2 2 0 0 0-2 0l-7 4A2 2 0 0 0 3 8v8a2 2 0 0 0 1 1.73l7 4a2 2 0 0 0 2 0l7-4A2 2 0 0 0 21 16Z" />
                <path d="m3.3 7 8.7 5 8.7-5" />
                <path d="M12 22V12" />
              </svg>
            </div>
            <p class="text-sm font-medium text-s-black">Belum ada security</p>
            <p class="text-xs text-s-grey max-w-[220px]">Security yang ditambahkan akan tampil di sini.</p>
          </div>
        <?php endif; ?>

      </section>

    </div>
  </main>

  <?php if ($statusMsg) : ?>
    <div id="toast" class="fixed bottom-20 left-1/2 -translate-x-1/2 z-50 flex items-center gap-2 px-4 py-3 rounded-xl bg-ijo-600 text-s-white text-sm font-medium shadow-lg">
      <svg class="w-5 h-5 shrink-0" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
        <path d="M20 6 9 17l-5-5" />
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