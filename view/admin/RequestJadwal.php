<?php
require '../../model/be_main.php';

$query = "SELECT rj.*, 
s.nama as nama, s.noHp as nohp,  
st.nama as nama_teman, st.noHp as nohp_teman
FROM lap_reqJadwal rj
INNER JOIN security s ON rj.id_security = s.id_security
INNER JOIN security st ON rj.id_securityTeman = st.id_security
";
$hasil = mysqli_query($koneksi, $query);

if (isset($_POST["hapus"])) {
  be_hapusLaporanReq();
}

// notif
$statusMsg = '';
if (isset($_GET["status"])) {
  switch ($_GET["status"]) {
    case "laporanReqDihapus":
      $statusMsg = "Laporan request berhasil dihapus";
      break;
  }
}
?>
<!DOCTYPE html>
<html lang="id">

<head>
  <?php include '../../tamplate/meta.php'; ?>
  <?php require '../../tamplate/judul.php'; ?>
  <title>Request Jadwal</title>
</head>

<body class="bg-s-grey/20">
  <main class="w-full max-w-[430px] mx-auto min-h-screen bg-s-white shadow-2xl flex flex-col">
    <?php judulPath("Request Jadwal", "./JadwalSecurity.php") ?>

    <div class="flex-1 flex flex-col gap-5 px-4 py-5">
      <h1 class="text-base font-semibold text-s-black">Laporan Request Jadwal</h1>

      <?php
      if (mysqli_num_rows($hasil) > 0) :
        while ($data = mysqli_fetch_assoc($hasil)) :
          $data['tanggal'] = explode(' ', $data['tanggalWaktu'])[0];
      ?>
          <div class="flex flex-col gap-3 p-3 rounded-xl bg-ijo-500 text-s-white">
            <div class="flex items-center justify-between gap-2">
              <h2 class="text-sm font-semibold">Request Jadwal</h2>
              <span class="shrink-0 text-xs text-ijo-100"><?= $data['tanggal'] ?></span>
            </div>
            <div class="w-full h-px bg-s-white/40"></div>

            <div class="flex flex-col gap-1">
              <p class="text-xs font-medium text-ijo-100">Bertukar Jadwal</p>
              <p class="text-sm"><?= $data['nama'] ?> <span class="text-xs text-ijo-100"><?= $data['nohp'] ?></span></p>
              <div class="flex items-center gap-2 my-1">
                <span class="w-full h-px bg-s-white/30"></span>
                <span class="shrink-0 text-xs text-ijo-100">dengan</span>
                <span class="w-full h-px bg-s-white/30"></span>
              </div>
              <p class="text-sm"><?= $data['nama_teman'] ?> <span class="text-xs text-ijo-100"><?= $data['nohp_teman'] ?></span></p>
            </div>

            <div class="flex flex-col gap-1">
              <p class="text-xs font-medium text-ijo-100">Alasan Bertukar</p>
              <p class="text-sm"><?= $data['alasan'] ?></p>
            </div>

            <div class="flex gap-2 w-full">
              <?php $data['nohp'] = ltrim($data['nohp'], '0'); ?>
              <a href="https://wa.me/+62<?= $data['nohp'] ?>" target="_blank" class="flex-1 h-[44px] flex items-center justify-center rounded-lg border border-s-white/60 bg-s-white text-ijo-600 font-semibold text-sm hover:bg-ijo-100 active:bg-ijo-100 transition-colors">
                Hubungi
              </a>
              <a href="EditJadwalRequest.php?id_security=<?= $data['id_security'] ?>&id_securityTeman=<?= $data['id_securityTeman'] ?>" class="flex-1 h-[44px] flex items-center justify-center rounded-lg border border-s-white/60 bg-s-white text-ijo-600 font-semibold text-sm hover:bg-ijo-100 active:bg-ijo-100 transition-colors">
                Ubah Jadwal
              </a>
            </div>

            <form action="" method="post">
              <input type="hidden" name="id_reqJadwal" value="<?= $data['id_reqJadwal'] ?>">
              <button type="submit" name="hapus"
                class="w-full h-[44px] flex items-center justify-center rounded-lg border border-s-white/60 bg-s-white text-s-red font-semibold text-sm hover:bg-s-red hover:text-s-white active:bg-s-red active:text-s-white transition-colors">
                Hapus Laporan
              </button>
            </form>
          </div>
        <?php endwhile; ?>

      <?php else : ?>
        <div class="flex flex-col items-center gap-3 py-16 text-center">
          <div class="w-16 h-16 rounded-full bg-ijo-100 flex items-center justify-center">
            <svg class="w-8 h-8 text-ijo-600" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
              <path d="M8 2v4" />
              <path d="M16 2v4" />
              <rect x="3" y="4" width="18" height="18" rx="2" />
              <path d="M3 10h18" />
            </svg>
          </div>
          <p class="text-sm font-medium text-s-black">Belum ada request jadwal</p>
          <p class="text-xs text-s-grey max-w-[220px]">Request pergantian jadwal akan tampil di sini.</p>
        </div>
      <?php endif; ?>

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
