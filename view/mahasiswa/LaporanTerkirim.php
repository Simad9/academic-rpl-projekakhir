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
        <p class="text-xl font-bold text-s-black">Laporan Terkirim!</p>
        <p class="text-sm text-s-grey max-w-[240px]">Tunggu balasan dari kami!</p>
      </div>

      <a href="./LaporanBarang.php"
        class="w-full h-[48px] flex items-center justify-center rounded-xl bg-ijo-500 text-s-white font-semibold text-base hover:bg-ijo-600 active:bg-ijo-600 focus-visible:ring-2 focus-visible:ring-ijo-400 transition-colors">
        Kembali ke Halaman Awal
      </a>
    </div>
  </main>
</body>

</html>
