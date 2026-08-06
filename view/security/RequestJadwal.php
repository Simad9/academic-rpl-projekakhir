<?php
session_start();
require '../../model/be_main.php';

// panggil data security
$query = "SELECT * FROM security";
$hasil = mysqli_query($koneksi, $query);

$id_security = be_fetchIdSecurity();
$nama_security = be_fetchNameSecurity();

if (isset($_POST["submit"])) {
  requestJadwal();
}

$errorGagal = isset($_GET["status"]) && $_GET["status"] === "gagal";
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
    <?php judulPath("Request Jadwal", "./FiturTambahan.php") ?>

    <div class="flex-1 flex flex-col gap-5 px-4 py-5">
      <h1 class="text-base font-semibold text-s-black">Laporan Request Jadwal</h1>

      <?php if ($errorGagal) : ?>
        <div class="flex items-center gap-2 p-3 rounded-lg bg-s-red/10 border border-s-red/30 text-s-red text-sm" role="alert">
          <svg class="w-5 h-5 shrink-0" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
            <circle cx="12" cy="12" r="10" />
            <path d="M12 8v4" />
            <path d="M12 16h.01" />
          </svg>
          Ada yang gagal, silahkan coba lagi
        </div>
      <?php endif; ?>

      <form action="" method="post" class="flex flex-col gap-5">
        <input type="text" name="id_security" value="<?= $id_security ?>" class="hidden">

        <div class="flex flex-col gap-4">
          <div class="flex flex-col gap-1.5">
            <label for="tanggal" class="text-sm font-medium text-s-black">Tanggal dan Waktu</label>
            <div class="flex gap-2">
              <input type="text" id="tanggal" value="<?= tampilanTanggal($tanggal_sekarang) ?>" readonly
                class="w-full h-[48px] px-4 text-center rounded-lg border border-s-black/10 bg-s-grey/10 text-s-black outline-none">
              <input type="text" value="<?= $waktu_sekarang ?>" readonly
                class="w-full h-[48px] px-4 text-center rounded-lg border border-s-black/10 bg-s-grey/10 text-s-black outline-none">
            </div>
          </div>

          <div class="flex flex-col gap-1.5">
            <label for="nama" class="text-sm font-medium text-s-black">Nama</label>
            <input type="text" name="nama" id="nama" value="<?= $nama_security ?>" readonly
              class="w-full h-[48px] px-4 rounded-lg border border-s-black/10 bg-s-grey/10 text-s-black outline-none">
          </div>

          <div class="flex flex-col gap-1.5">
            <label for="id_rekan" class="text-sm font-medium text-s-black">Nama Teman Pengganti</label>
            <select name="id_rekan" id="id_rekan" required
              class="w-full h-[48px] px-4 rounded-lg border border-s-black/20 bg-s-white text-s-black outline-none transition focus:border-ijo-500 focus:ring-2 focus:ring-ijo-400/40">
              <option value="">Pilih Rekan</option>
              <?php while ($data = mysqli_fetch_assoc($hasil)) : ?>
                <?php if ($data['id_security'] == $id_security) continue; ?>
                <option value="<?= $data['id_security'] ?>"><?= $data['nama'] ?></option>
              <?php endwhile; ?>
            </select>
          </div>

          <div class="flex flex-col gap-1.5">
            <label for="alasan" class="text-sm font-medium text-s-black">Alasan Request Jadwal</label>
            <textarea name="alasan" id="alasan" rows="3" placeholder="Masukan alasan anda" required
              class="w-full px-4 py-3 rounded-lg border border-s-black/20 bg-s-white text-s-black placeholder:text-s-grey outline-none transition focus:border-ijo-500 focus:ring-2 focus:ring-ijo-400/40"></textarea>
          </div>
        </div>

        <button type="submit" name="submit"
          class="w-full h-[48px] rounded-xl bg-ijo-500 text-s-white font-semibold text-base hover:bg-ijo-600 active:bg-ijo-600 focus-visible:ring-2 focus-visible:ring-ijo-400 transition-colors">
          Kirim
        </button>
      </form>
    </div>
  </main>
</body>

</html>
