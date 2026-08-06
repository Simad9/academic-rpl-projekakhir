<?php
require '../../model/be_main.php';

if (isset($_POST["submit"])) {
  be_laporanBarang();
}

// notif
$statusMsg = '';
if (isset($_GET["status"])) {
  switch ($_GET["status"]) {
    case "notImage":
      $statusMsg = "File harus berupa gambar (JPG/JPEG/PNG)";
      break;
    case "bigSize":
      $statusMsg = "Ukuran foto maksimal 2mb";
      break;
    case "gagal":
      $statusMsg = "Ada yang salah, silahkan coba lagi";
      break;
  }
}
?>
<!DOCTYPE html>
<html lang="id">

<head>
  <?php include '../../tamplate/meta.php'; ?>
  <?php require '../../tamplate/judul.php'; ?>
  <title>Penemuan Barang</title>
</head>

<body class="bg-s-grey/20">
  <main class="w-full max-w-[430px] mx-auto min-h-screen bg-s-white shadow-2xl flex flex-col">
    <?php judulPath("Penemuan Barang", "./SecurityJaga.php") ?>

    <div class="flex-1 flex flex-col gap-5 px-4 py-5">
      <h1 class="text-base font-semibold text-s-black">Laporan Penemuan</h1>

      <?php if ($statusMsg) : ?>
        <div class="flex items-start gap-2 px-4 py-3 rounded-xl bg-s-red/10 border border-s-red/30 text-s-red text-sm font-medium">
          <svg class="w-5 h-5 shrink-0 mt-0.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
            <circle cx="12" cy="12" r="10" />
            <path d="M12 8v4" />
            <path d="M12 16h.01" />
          </svg>
          <p><?= $statusMsg ?></p>
        </div>
      <?php endif; ?>

      <form action="" method="post" enctype="multipart/form-data" class="flex flex-col gap-5">
        <div class="flex flex-col gap-4">
          <div class="flex flex-col gap-1.5">
            <label class="text-sm font-medium text-s-black">Tanggal dan Waktu</label>
            <div class="flex gap-2">
              <input type="text" id="tanggal" value="<?= tampilanTanggal($tanggal_sekarang) ?>" readonly
                class="w-full h-[48px] px-4 text-center rounded-lg border border-s-black/20 bg-s-grey/5 text-s-grey font-medium outline-none">
              <input type="text" value="<?= $waktu_sekarang ?>" readonly
                class="w-full h-[48px] px-4 text-center rounded-lg border border-s-black/20 bg-s-grey/5 text-s-grey font-medium outline-none">
            </div>
          </div>

          <div class="flex flex-col gap-1.5">
            <label for="jenis" class="text-sm font-medium text-s-black">Jenis Barang</label>
            <input type="text" name="jenis" id="jenis" placeholder="Contoh: Kunci Motor, Tas, Dokumen, dst" required
              class="w-full h-[48px] px-4 rounded-lg border border-s-black/20 bg-s-white text-s-black placeholder:text-s-grey outline-none transition focus:border-ijo-500 focus:ring-2 focus:ring-ijo-400/40">
          </div>

          <div class="flex flex-col gap-1.5">
            <label for="deskripsi" class="text-sm font-medium text-s-black">Deskripsi Saat Ditemukan</label>
            <textarea name="deskripsi" id="deskripsi" rows="3" placeholder="Contoh: Ditemukan di motor xxx" required
              class="w-full px-4 py-3 rounded-lg border border-s-black/20 bg-s-white text-s-black placeholder:text-s-grey outline-none transition focus:border-ijo-500 focus:ring-2 focus:ring-ijo-400/40"></textarea>
          </div>

          <div class="flex flex-col gap-1.5">
            <label for="foto" class="text-sm font-medium text-s-black">Foto Barang Temuan</label>
            <label for="foto" class="cursor-pointer self-start">
              <img src="../../assets/icon/guest-icon-upload.png" id="foto-preview" class="object-cover w-[100px] h-[100px] border border-s-black/20 rounded-xl" alt="Foto Barang Temuan">
            </label>
            <p class="text-xs text-s-grey">Kirim foto maksimal 2mb</p>
            <input type="file" id="foto" name="foto" accept="image/*" class="hidden">
          </div>
        </div>

        <button type="submit" name="submit"
          class="w-full h-[48px] rounded-xl bg-ijo-500 text-s-white font-semibold text-base hover:bg-ijo-600 active:bg-ijo-600 focus-visible:ring-2 focus-visible:ring-ijo-400 transition-colors">
          Kirim Laporan
        </button>
      </form>
    </div>
  </main>

  <script>
    // Memperbaiki penanganan perubahan gambar
    document.getElementById('foto').onchange = function(event) {
      event.preventDefault(); // Mencegah default action form
      const fotoPreview = document.getElementById('foto-preview');
      const file = this.files[0];
      if (file) {
        const reader = new FileReader();
        reader.onload = function() {
          fotoPreview.src = reader.result;
        }
        reader.readAsDataURL(file);
      }
    };
  </script>
</body>

</html>