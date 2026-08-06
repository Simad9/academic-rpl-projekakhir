<?php
require '../../model/be_main.php';

if (isset($_POST['submit'])) {
  be_tambahSecurity();
}
?>

<!DOCTYPE html>
<html lang="id">

<head>
  <?php include '../../tamplate/meta.php'; ?>
  <?php require '../../tamplate/judul.php'; ?>
  <title>Tambah Security</title>
</head>

<body class="bg-s-grey/20">
  <main class="w-full max-w-[430px] mx-auto min-h-screen bg-s-white shadow-2xl flex flex-col">
    <?php judulPath("Tambah Security", "./JadwalSecurity.php") ?>

    <div class="flex-1 flex flex-col gap-5 px-4 py-5">
      <h1 class="text-base font-semibold text-s-black">Tambah Security</h1>

      <form action="" method="post" class="flex flex-col gap-5">
        <div class="flex flex-col gap-4">
          <div class="flex flex-col gap-1.5">
            <label for="nama" class="text-sm font-medium text-s-black">Nama</label>
            <input type="text" name="nama" id="nama" placeholder="Masukan Nama Security" required
              class="w-full h-[48px] px-4 rounded-lg border border-s-black/20 bg-s-white text-s-black placeholder:text-s-grey outline-none transition focus:border-ijo-500 focus:ring-2 focus:ring-ijo-400/40">
          </div>

          <div class="flex flex-col gap-1.5">
            <label for="noHp" class="text-sm font-medium text-s-black">No Hp</label>
            <input type="text" name="noHp" id="noHp" placeholder="Masukan No Hp Security" required
              class="w-full h-[48px] px-4 rounded-lg border border-s-black/20 bg-s-white text-s-black placeholder:text-s-grey outline-none transition focus:border-ijo-500 focus:ring-2 focus:ring-ijo-400/40">
          </div>

          <div class="flex flex-col gap-1.5">
            <label for="username" class="text-sm font-medium text-s-black">Username</label>
            <input type="text" name="username" id="username" placeholder="Masukan Username Security Sementara" required
              class="w-full h-[48px] px-4 rounded-lg border border-s-black/20 bg-s-white text-s-black placeholder:text-s-grey outline-none transition focus:border-ijo-500 focus:ring-2 focus:ring-ijo-400/40">
          </div>

          <div class="flex flex-col gap-1.5">
            <label for="password" class="text-sm font-medium text-s-black">Password</label>
            <input type="password" name="password" id="password" placeholder="Masukan Password Security Sementara" required
              class="w-full h-[48px] px-4 rounded-lg border border-s-black/20 bg-s-white text-s-black placeholder:text-s-grey outline-none transition focus:border-ijo-500 focus:ring-2 focus:ring-ijo-400/40">
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
