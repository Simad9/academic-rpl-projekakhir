<?php
require '../../model/be_main.php';

if (isset($_POST["submit"])) {
  be_tambahKunci();
}
?>

<!DOCTYPE html>
<html lang="id">

<head>
  <?php include '../../tamplate/meta.php'; ?>
  <?php require '../../tamplate/judul.php'; ?>
  <title>Tambah Kunci</title>
</head>

<body class="bg-s-grey/20">
  <main class="w-full max-w-[430px] mx-auto min-h-screen bg-s-white shadow-2xl flex flex-col">
    <?php judulPath("Tambah Kunci", "./ListKunci.php") ?>

    <div class="flex-1 flex flex-col gap-5 px-4 py-5">
      <h1 class="text-base font-semibold text-s-black">Tambah Kunci</h1>

      <form action="" method="post" enctype="multipart/form-data" class="flex flex-col gap-5">
        <div class="flex flex-col gap-4">
          <div class="flex flex-col gap-1.5">
            <label for="nama" class="text-sm font-medium text-s-black">Nama Kunci</label>
            <input type="text" name="nama" id="nama" placeholder="Masukan Nama Kunci" required
              class="w-full h-[48px] px-4 rounded-lg border border-s-black/20 bg-s-white text-s-black placeholder:text-s-grey outline-none transition focus:border-ijo-500 focus:ring-2 focus:ring-ijo-400/40">
          </div>

          <div class="flex flex-col gap-1.5">
            <label for="lokasi" class="text-sm font-medium text-s-black">Lokasi</label>
            <input type="text" name="lokasi" id="lokasi" placeholder="Masukan Lokasi" required
              class="w-full h-[48px] px-4 rounded-lg border border-s-black/20 bg-s-white text-s-black placeholder:text-s-grey outline-none transition focus:border-ijo-500 focus:ring-2 focus:ring-ijo-400/40">
          </div>

          <div class="flex flex-col gap-1.5">
            <label for="penjaw" class="text-sm font-medium text-s-black">Penanggung Jawab</label>
            <input type="text" name="penjaw" id="penjaw" placeholder="Masukan Penanggung Jawab" required
              class="w-full h-[48px] px-4 rounded-lg border border-s-black/20 bg-s-white text-s-black placeholder:text-s-grey outline-none transition focus:border-ijo-500 focus:ring-2 focus:ring-ijo-400/40">
          </div>

          <div class="flex flex-col gap-1.5">
            <label for="note" class="text-sm font-medium text-s-black">Note</label>
            <textarea name="note" id="note" rows="3" placeholder="Note untuk Kunci"
              class="w-full px-4 py-3 rounded-lg border border-s-black/20 bg-s-white text-s-black placeholder:text-s-grey outline-none transition focus:border-ijo-500 focus:ring-2 focus:ring-ijo-400/40"></textarea>
          </div>

          <div class="flex flex-col gap-1.5">
            <label for="foto" class="text-sm font-medium text-s-black">Foto Kunci</label>
            <label for="foto" class="cursor-pointer self-start">
              <img src="../../assets/icon/guest-icon-upload.png" id="foto-preview" class="object-cover w-[100px] h-[100px] border border-s-black/20 rounded-xl" alt="Foto Kunci">
            </label>
            <p class="text-xs text-s-grey">Kirim foto maksimal 2mb</p>
            <input type="file" id="foto" name="foto" accept="image/*" class="hidden">
          </div>
        </div>

        <button type="submit" name="submit"
          class="w-full h-[48px] rounded-xl bg-ijo-500 text-s-white font-semibold text-base hover:bg-ijo-600 active:bg-ijo-600 focus-visible:ring-2 focus-visible:ring-ijo-400 transition-colors">
          Tambah
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
