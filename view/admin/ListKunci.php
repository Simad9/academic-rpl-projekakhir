<?php
require '../../model/be_main.php';

$query = "SELECT * FROM kunci";
$hasil = mysqli_query($koneksi, $query);

if (isset($_POST["hapus"])) {
  be_hapusKunci($_POST["id_kunci"]);
}

// notif
$statusMsg = '';
if (isset($_GET["status"])) {
  switch ($_GET["status"]) {
    case "kunciDiupdate":
      $statusMsg = "Berhasil update kunci";
      break;
    case "kunciDihapus":
      $statusMsg = "Kunci dihapus";
      break;
    case "kunciDitambah":
      $statusMsg = "Berhasil tambah kunci";
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
            <a href="./JadwalSecurity.php">
              <img src="../../assets/sementara/adm-icon-jadwalSecurity-off.svg">
            </a>
            <div>
              <img src="../../assets/sementara/adm-icon-listKunci.svg">
            </div>
          </div>
          <a href="../../">
            <img src="../../assets/sementara/adm-icon-tombolKeluar.svg">
          </a>
        </section>

        <div class="flex justify-end">
          <a href="./TambahKunci.php">
            <img src="../../assets/sementara/adm-icon-tambahKunci.svg">
          </a>
        </div>
    </section>

    <!-- List Kunci -->
    <section class="flex flex-col gap-3">
      <h1 class="text-base font-semibold text-s-black">List Kunci Dimiliki</h1>

      <?php
      if (mysqli_num_rows($hasil) > 0) :
        while ($data = mysqli_fetch_assoc($hasil)) :
      ?>
          <div class="flex flex-col gap-3 p-3 rounded-xl bg-ijo-500 text-s-white">
            <div class="flex items-center justify-center">
              <h2 class="text-sm font-semibold"><?= $data['nama'] ?></h2>
            </div>

            <div class="flex gap-3">
              <div class="w-16 h-16 shrink-0 rounded-lg overflow-hidden bg-s-white/20">
                <img src="../../img/kunci/<?= $data['urlFoto'] ?>" alt="Foto Kunci" class="object-cover w-full h-full">
              </div>
              <div class="flex flex-col gap-1 text-xs min-w-0">
                <p>Lokasi : <?= $data['lokasi'] ?></p>
                <p>Penanggung Jawab : <?= $data['penjaw'] ?></p>
                <p>Note : <?= $data['note'] ?></p>
              </div>
            </div>

            <form action="" method="post">
              <input type="hidden" name="id_kunci" value="<?= $data['id_kunci'] ?>">
              <div class="flex gap-2 w-full">
                <button type="submit" name="hapus"
                  class="flex-1 h-[44px] flex items-center justify-center rounded-lg border border-s-white/60 bg-s-white text-s-red font-semibold text-sm hover:bg-s-red hover:text-s-white active:bg-s-red active:text-s-white transition-colors">
                  Hapus
                </button>
                <a href="EditKunci.php?id_kunci=<?= $data['id_kunci'] ?>" class="flex-1 h-[44px] flex items-center justify-center rounded-lg border border-s-white/60 bg-s-white text-ijo-600 font-semibold text-sm hover:bg-ijo-100 active:bg-ijo-100 transition-colors">
                  Edit
                </a>
              </div>
            </form>
          </div>
        <?php endwhile; ?>

      <?php else : ?>
        <div class="flex flex-col items-center gap-3 py-16 text-center">
          <div class="w-16 h-16 rounded-full bg-ijo-100 flex items-center justify-center">
            <svg class="w-8 h-8 text-ijo-600" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
              <circle cx="8" cy="18" r="4" />
              <circle cx="17" cy="17" r="3" />
              <circle cx="16" cy="8" r="4" />
              <circle cx="7" cy="6" r="3" />
            </svg>
          </div>
          <p class="text-sm font-medium text-s-black">Belum ada kunci</p>
          <p class="text-xs text-s-grey max-w-[220px]">Kunci yang ditambahkan akan tampil di sini.</p>
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