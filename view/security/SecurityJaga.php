<?php
session_start();
require '../../model/be_main.php';
// Set timezone
date_default_timezone_set('Asia/Jakarta'); // Ganti dengan timezone server yang sesuai

// ID login
$id_security = $_SESSION['id_security'];

// Ngecek aku jaga gak
$query = "SELECT * FROM lap_jaga
JOIN jadwal ON lap_jaga.id_jadwal = jadwal.id_jadwal
JOIN security ON lap_jaga.id_security = security.id_security
WHERE lap_jaga.id_security = $id_security;
";
$fetch1 = mysqli_query($koneksi, $query);
$data = mysqli_fetch_assoc($fetch1);

// Melihat siapa yang berjaga
$query = "SELECT * FROM lap_jaga
JOIN jadwal ON lap_jaga.id_jadwal = jadwal.id_jadwal
JOIN security ON lap_jaga.id_security = security.id_security
";
$fetch = mysqli_query($koneksi, $query);

// var_dump($data);
$current_time = new DateTime();
$belumJaga = false;
$berjaga = "";
$penjagaSekarang = [];


while ($jaga = mysqli_fetch_assoc($fetch)) {
  $waktu_mulai = new DateTime($jaga['jamMulai']);
  $waktu_selesai = new DateTime($jaga['jamAkhir']);
  // Menentukan siapa yang berjaga saat ini
  if ($waktu_mulai < $waktu_selesai) {
    // Shift tidak melintasi tengah malam
    if ($current_time >= $waktu_mulai && $current_time <= $waktu_selesai) {
      // var_dump($data);
      // echo "Belum malam";
      // Looping terus buat nampilin siapa yang jaga
      $penjagaSekarang[] = [
        'nama' => $jaga['nama'],
        'jamMulai' => $jaga['jamMulai'],
        'jamAkhir' => $jaga['jamAkhir']
      ];

      // Jika Login, dan di db berjaga maka selsaikan
      if ($data['statusJaga'] == 'berjaga' && $data['jamAkhir'] <= $current_time) {
        $berjaga = "selesai";
        // Jika login, dan sedang berjaga maka ready
      } elseif ($data['statusJaga'] == 'berjaga') {
        $berjaga = "sedang";
        // Jika login, dan akan berjaga maka ready
      } elseif ($jaga['id_security'] == $id_security) {
        $berjaga = "ready";
        // untuk yang gak jaga intinya
      } else {
        $belumJaga = true;
      }
    }
  } else {
    // var_dump($data);
    // echo "Jam malam";
    // Shift melintasi tengah malam
    if ($current_time >= $waktu_mulai || $current_time <= $waktu_selesai) {
      // Looping terus buat nampilin siapa yang jaga
      $penjagaSekarang[] = [
        'nama' => $jaga['nama'],
        'jamMulai' => $jaga['jamMulai'],
        'jamAkhir' => $jaga['jamAkhir']
      ];

      // Jika login, dan sedang berjaga maka ready
      if ($data['statusJaga'] == 'berjaga') {
        $berjaga = "sedang";
        // Jika Login, dan di db berjaga maka selsaikan
      } elseif ($data['statusJaga'] == 'berjaga' && $data['jamAkhir'] <= $current_time) {
        $berjaga = "selesai";
        // Jika login, dan akan berjaga maka ready
      } elseif ($jaga['id_security'] == $id_security) {
        $berjaga = "ready";
        // untuk yang gak jaga intinya
      } else {
        $belumJaga = true;
      }
    }
  }
}

// mulai jaga
if (isset($_POST["jaga"])) {
  be_mulaiJaga($id_security);
} else if (isset($_POST["selesai"])) {
  be_selesaiJaga($id_security);
}


?>
<!DOCTYPE html>
<html lang="id">

<head>
  <?php include '../../tamplate/meta.php'; ?>
  <?php require '../../tamplate/judul.php'; ?>
  <title>Security</title>
</head>

<body class="bg-s-grey/20">
  <main class="w-full max-w-[430px] mx-auto min-h-screen bg-s-white shadow-2xl flex flex-col">
    <?php judulPolos("Security") ?>

    <div class="flex-1 flex flex-col gap-5 px-4 py-5">

      <!-- Saat ini yang berjaga -->
      <section class="flex flex-col gap-3">
        <h1 class="text-base font-semibold text-s-black text-center">Saat Ini yang Berjaga</h1>

        <div class="flex flex-col gap-3 p-4 rounded-xl bg-ijo-500 text-s-white">
          <div class="flex items-center justify-between gap-2">
            <span class="text-xs font-medium text-ijo-100">Yang Berjaga</span>
            <span class="shrink-0 text-xs font-medium text-ijo-100"><?= tampilanTanggal($tanggal_sekarang) ?></span>
          </div>
          <div class="w-full h-px bg-s-white/40"></div>

          <?php if (!empty($penjagaSekarang)) : ?>
            <?php foreach ($penjagaSekarang as $penjaga) : ?>
              <div class="flex flex-col items-center gap-1 text-center">
                <p class="text-xl font-bold"><?= $penjaga['nama'] ?></p>
                <p class="text-sm font-medium text-ijo-100"><?= ubahFormatJam($penjaga['jamMulai']) ?> s/d <?= ubahFormatJam($penjaga['jamAkhir']) ?></p>
              </div>
            <?php endforeach; ?>
          <?php else : ?>
            <p class="text-center text-sm text-ijo-100">Belum ada penjaga saat ini</p>
          <?php endif; ?>
        </div>

        <?php
        if ($belumJaga) : ?>
          <button type="button" disabled
            class="w-full h-[48px] rounded-xl bg-s-grey text-s-white font-semibold text-base cursor-not-allowed">
            Tidak Jaga
          </button>
        <?php else : ?>
          <?php if ($berjaga == "ready") : ?>
            <form action="" method="post">
              <input type="hidden" name="$id_security" value="<?= $id_security ?>">
              <button type="submit" name="jaga"
                class="w-full h-[48px] rounded-xl bg-ijo-500 text-s-white font-semibold text-base hover:bg-ijo-600 active:bg-ijo-600 focus-visible:ring-2 focus-visible:ring-ijo-400 transition-colors">
                Mulai Berjaga
              </button>
            </form>
          <?php elseif ($berjaga == "sedang") : ?>
            <button type="button" disabled
              class="w-full h-[48px] rounded-xl bg-s-grey text-s-white font-semibold text-base cursor-not-allowed">
              Sedang Berjaga
            </button>
          <?php elseif ($berjaga == "selesai") : ?>
            <form action="" method="post">
              <input type="hidden" name="$id_security" value="<?= $id_security ?>">
              <button type="submit" name="selesai"
                class="w-full h-[48px] rounded-xl bg-ijo-500 text-s-white font-semibold text-base hover:bg-ijo-600 active:bg-ijo-600 focus-visible:ring-2 focus-visible:ring-ijo-400 transition-colors">
                Selesai Berjaga
              </button>
            </form>
          <?php endif; ?>
        <?php endif; ?>
      </section>

      <!-- Fitur utama lainnya -->
      <section class="flex flex-col gap-3">
        <h1 class="text-base font-semibold text-s-black">Fitur Utama Lainnya</h1>

        <div class="flex flex-col gap-2">
          <a href="./PenemuanBarang.php"
            class="w-full h-[48px] flex items-center justify-center rounded-xl bg-ijo-500 text-s-white font-semibold text-sm hover:bg-ijo-600 active:bg-ijo-600 focus-visible:ring-2 focus-visible:ring-ijo-400 transition-colors">
            Penemuan Barang
          </a>
          <a href="./ListTemuan.php"
            class="w-full h-[48px] flex items-center justify-center rounded-xl border border-ijo-500 bg-s-white text-ijo-600 font-semibold text-sm hover:bg-ijo-100 active:bg-ijo-100 focus-visible:ring-2 focus-visible:ring-ijo-400 transition-colors">
            List Barang Ditemukan
          </a>
          <a href="./FiturTambahan.php"
            class="w-full h-[48px] flex items-center justify-center rounded-xl border border-ijo-500 bg-s-white text-ijo-600 font-semibold text-sm hover:bg-ijo-100 active:bg-ijo-100 focus-visible:ring-2 focus-visible:ring-ijo-400 transition-colors">
            Tambahan
          </a>
          <a href="../../"
            class="w-full h-[48px] flex items-center justify-center rounded-xl border border-s-red bg-s-white text-s-red font-semibold text-sm hover:bg-s-red hover:text-s-white active:bg-s-red active:text-s-white focus-visible:ring-2 focus-visible:ring-s-red/40 transition-colors">
            Keluar
          </a>
        </div>
      </section>

    </div>
  </main>
</body>

</html>
