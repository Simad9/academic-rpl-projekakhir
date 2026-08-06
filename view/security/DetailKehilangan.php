<?php
require '../../model/be_main.php';

$id_kehilangan = $_GET['id_lapKehilangan'];
$query = "SELECT *, lap_kehilangan.urlFoto as 'urlBukti' FROM lap_kehilangan
INNER JOIN lap_barang ON lap_kehilangan.id_lapBarang = lap_barang.id_lapBarang
INNER JOIN mahasiswa ON lap_kehilangan.id_mhs = mahasiswa.id_mhs
WHERE lap_kehilangan.id_lapKehilangan = '$id_kehilangan'";
$hasil = mysqli_query($koneksi, $query);
$data = mysqli_fetch_assoc($hasil);
$data['tanggal'] = explode(' ', $data['tanggalWaktu'])[0];

if (isset($_GET["hapus"])) {
  $id_lapKehilangan = $_GET["id_lapKehilangan"];
  $urlBukti = $data['urlBukti'];
  $id_lapBarang = $data['id_lapBarang'];
  $urlBarang = $data['urlBarang'];
  $id_mhs = $data['id_mhs'];
  hapusLapKehilangan($id_lapKehilangan, $urlBukti, $id_lapBarang, $urlBarang, $id_mhs);
}

// notif
$statusMsg = '';
if (isset($_GET["status"])) {
  switch ($_GET["status"]) {
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
  <title>Detail Kehilangan</title>
</head>

<body class="bg-s-grey/20">
  <main class="w-full max-w-[430px] mx-auto min-h-screen bg-s-white shadow-2xl flex flex-col">
    <?php judulPath("Detail Kehilangan", "./LaporanKehilangan.php") ?>

    <div class="flex-1 flex flex-col gap-5 px-4 py-5">
      <h1 class="text-base font-semibold text-s-black">Detail Kehilangan Barang</h1>

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

      <form action="" method="get" class="flex flex-col gap-4">
        <input type="hidden" name="id_lapKehilangan" value="<?= $data['id_lapKehilangan'] ?>">

        <div class="flex flex-col gap-3 p-3 rounded-xl bg-ijo-500 text-s-white">
          <div class="flex items-center justify-between gap-2">
            <h2 class="text-sm font-semibold"><?= $data['jenisBarang'] ?></h2>
            <span class="shrink-0 text-xs text-ijo-100"><?= tampilanTanggal($data['tanggal']) ?></span>
          </div>

          <div class="flex gap-3">
            <div class="w-16 h-16 shrink-0 rounded-lg overflow-hidden bg-s-white/20">
              <img src="../../img/laporanBarang/<?= $data['urlFoto'] ?>" alt="Foto Barang" class="object-cover w-full h-full">
            </div>
            <div class="flex flex-col gap-1 text-xs min-w-0">
              <p class="font-semibold">Deskripsi ditemukan :</p>
              <p class="font-medium leading-relaxed"><?= $data['deskripsi'] ?></p>
            </div>
          </div>

          <div class="w-full h-[2px] bg-s-white/30"></div>

          <div class="flex flex-col gap-1.5 text-xs">
            <p class="font-bold">Pelapor</p>
            <p>Nama : <?= $data['nama'] ?></p>
            <p>Nomor Hp : <?= $data['noHp'] ?></p>
            <p>Bukti Kepemilikan : <?= $data['bukti'] ?></p>
            <img src="../../img/laporanKehilangan/<?= $data['urlBukti'] ?>" alt="Foto Bukti" class="w-full h-[120px] object-cover rounded-lg bg-s-white/20">
          </div>

          <div class="flex gap-2 w-full">
            <button type="submit" name="hapus"
              class="flex-1 h-[44px] flex items-center justify-center rounded-lg border border-s-white/60 bg-s-white text-s-red font-semibold text-sm hover:bg-s-red hover:text-s-white active:bg-s-red active:text-s-white transition-colors">
              Hapus Laporan
            </button>
            <?php $data['noHp'] = ltrim($data['noHp'], '0'); ?>
            <a href="https://wa.me/+62<?= $data['noHp'] ?>" target="_blank" rel="noopener"
              class="flex-1 h-[44px] flex items-center justify-center gap-2 rounded-lg border border-s-white/60 bg-s-white text-ijo-600 font-semibold text-sm hover:bg-ijo-100 active:bg-ijo-100 transition-colors">
              <svg class="w-4 h-4 shrink-0" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                <path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z" />
              </svg>
              Hubungi
            </a>
          </div>
        </div>
      </form>
    </div>
  </main>
</body>

</html>
