<?php
require '../../model/be_main.php';

$query = "SELECT * FROM kunci";
$hasil = mysqli_query($koneksi, $query);

$queryLap = "SELECT * FROM lap_pinjamKunci
INNER JOIN kunci ON lap_pinjamKunci.id_kunci = kunci.id_kunci";
$hasilLap = mysqli_query($koneksi, $queryLap);

if (isset($_POST["submit"])) {
  $input = ["nama", "nohp", "jurusan", "kunci"];
  foreach ($input as $i) {
    if (empty($_POST[$i])) {
      header("location: LaporanPinjamKunci.php?status=kosong");
      exit;
    }
  }
  pinjamKunci();
}

// notif
$statusMsg = '';
if (isset($_GET["status"])) {
  switch ($_GET["status"]) {
    case "gagal":
      $statusMsg = "Pinjam kunci gagal";
      break;
    case "sudahAda":
      $statusMsg = "Kunci sudah dipinjam";
      break;
    case "kosong":
      $statusMsg = "Isi formnya dulu";
      break;
  }
}

?>
<!DOCTYPE html>
<html lang="id">

<head>
  <?php include '../../tamplate/meta.php'; ?>
  <?php require '../../tamplate/judul.php'; ?>
  <title>Pinjam Kunci</title>
</head>

<body class="bg-s-grey/20">
  <main class="w-full max-w-[430px] mx-auto min-h-screen bg-s-white shadow-2xl flex flex-col">
    <?php judulPath("Pinjam Kunci", "./LaporanKunci.php") ?>

    <div class="flex-1 flex flex-col gap-5 px-4 py-5">
      <h1 class="text-base font-semibold text-s-black">Laporan Pinjam Kunci</h1>

      <form action="" method="post" class="flex flex-col gap-5">
        <div class="flex flex-col gap-4">
          <div class="flex flex-col gap-1.5">
            <label for="nama" class="text-sm font-medium text-s-black">Nama</label>
            <input type="text" name="nama" id="nama" placeholder="Masukan Nama anda" required
              class="w-full h-[48px] px-4 rounded-lg border border-s-black/20 bg-s-white text-s-black placeholder:text-s-grey outline-none transition focus:border-ijo-500 focus:ring-2 focus:ring-ijo-400/40">
          </div>

          <div class="flex flex-col gap-1.5">
            <label for="jurusan" class="text-sm font-medium text-s-black">Jurusan</label>
            <input type="text" name="jurusan" id="jurusan" placeholder="Masukan Jurusan anda" required
              class="w-full h-[48px] px-4 rounded-lg border border-s-black/20 bg-s-white text-s-black placeholder:text-s-grey outline-none transition focus:border-ijo-500 focus:ring-2 focus:ring-ijo-400/40">
          </div>

          <div class="flex flex-col gap-1.5">
            <label for="nohp" class="text-sm font-medium text-s-black">No Hp</label>
            <input type="text" name="nohp" id="nohp" placeholder="Masukan No Hp anda" required
              class="w-full h-[48px] px-4 rounded-lg border border-s-black/20 bg-s-white text-s-black placeholder:text-s-grey outline-none transition focus:border-ijo-500 focus:ring-2 focus:ring-ijo-400/40">
          </div>

          <div class="flex flex-col gap-1.5">
            <label for="kunci" class="text-sm font-medium text-s-black">Kunci Yang Dipinjam</label>
            <select name="kunci" id="kunci"
              class="w-full h-[48px] px-4 rounded-lg border border-s-black/20 bg-s-white text-s-black outline-none transition focus:border-ijo-500 focus:ring-2 focus:ring-ijo-400/40">
              <option value="0">Pilih Kunci</option>
              <?php while ($data = mysqli_fetch_assoc($hasil)) : ?>
                <option value="<?= $data["id_kunci"] ?>"><?= $data["nama"] ?></option>
              <?php
              endwhile;
              ?>
            </select>
          </div>
        </div>

        <button type="submit" name="submit"
          class="w-full h-[48px] rounded-xl bg-ijo-500 text-s-white font-semibold text-base hover:bg-ijo-600 active:bg-ijo-600 focus-visible:ring-2 focus-visible:ring-ijo-400 transition-colors">
          Kirim
        </button>
      </form>
    </div>
  </main>

  <?php if ($statusMsg) : ?>
    <div id="toast" class="fixed bottom-20 left-1/2 -translate-x-1/2 z-50 flex items-center gap-2 px-4 py-3 rounded-xl bg-s-red text-s-white text-sm font-medium shadow-lg">
      <svg class="w-5 h-5 shrink-0" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
        <circle cx="12" cy="12" r="10" />
        <path d="M12 8v4" />
        <path d="M12 16h.01" />
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
