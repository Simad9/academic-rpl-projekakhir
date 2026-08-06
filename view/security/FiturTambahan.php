<?php
// notif
$statusMsg = '';
$statusError = false;
if (isset($_GET["status"])) {
  switch ($_GET["status"]) {
    case "gagal":
      $statusMsg = "Ada yang salah, silahkan coba lagi";
      $statusError = true;
      break;
    case "updateProfile":
      $statusMsg = "Berhasil update profile";
      break;
  }
}
?>
<!DOCTYPE html>
<html lang="id">

<head>
  <?php include '../../tamplate/meta.php'; ?>
  <?php require '../../tamplate/judul.php'; ?>
  <title>Fitur Tambahan</title>
</head>

<body class="bg-s-grey/20">
  <main class="w-full max-w-[430px] mx-auto min-h-screen bg-s-white shadow-2xl flex flex-col">
    <?php judulPath("Fitur Tambahan", "./SecurityJaga.php") ?>

    <div class="flex-1 flex flex-col gap-5 px-4 py-5">
      <h1 class="text-base font-semibold text-s-black">Fitur Tambahan Kami</h1>

      <div class="flex flex-col gap-2">
        <a href="./LaporanKehilangan.php"
          class="w-full h-[48px] flex items-center justify-center rounded-xl border border-ijo-500 bg-s-white text-ijo-600 font-semibold text-sm hover:bg-ijo-100 active:bg-ijo-100 focus-visible:ring-2 focus-visible:ring-ijo-400 transition-colors">
          Laporan Kehilangan
        </a>
        <a href="./PerizinanKunci.php"
          class="w-full h-[48px] flex items-center justify-center rounded-xl border border-ijo-500 bg-s-white text-ijo-600 font-semibold text-sm hover:bg-ijo-100 active:bg-ijo-100 focus-visible:ring-2 focus-visible:ring-ijo-400 transition-colors">
          Perizinan Pinjaman Kunci
        </a>
        <a href="./PengembalianKunci.php"
          class="w-full h-[48px] flex items-center justify-center rounded-xl border border-ijo-500 bg-s-white text-ijo-600 font-semibold text-sm hover:bg-ijo-100 active:bg-ijo-100 focus-visible:ring-2 focus-visible:ring-ijo-400 transition-colors">
          Pengembalian Kunci
        </a>
        <a href="./RequestJadwal.php"
          class="w-full h-[48px] flex items-center justify-center rounded-xl border border-ijo-500 bg-s-white text-ijo-600 font-semibold text-sm hover:bg-ijo-100 active:bg-ijo-100 focus-visible:ring-2 focus-visible:ring-ijo-400 transition-colors">
          Request Jadwal
        </a>
        <a href="./EditProfile.php"
          class="w-full h-[48px] flex items-center justify-center rounded-xl border border-ijo-500 bg-s-white text-ijo-600 font-semibold text-sm hover:bg-ijo-100 active:bg-ijo-100 focus-visible:ring-2 focus-visible:ring-ijo-400 transition-colors">
          Edit Profile
        </a>
      </div>
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
