<?php
session_start();
require '../../model/be_main.php';

$query = "SELECT * FROM security WHERE id_security = $_SESSION[id_security]";
$fetch = mysqli_query($koneksi, $query);
$data = mysqli_fetch_assoc($fetch);

if (isset($_POST["submit"])) {
  be_updateDataPersonal();
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
  <title>Edit Profile</title>
</head>

<body class="bg-s-grey/20">
  <main class="w-full max-w-[430px] mx-auto min-h-screen bg-s-white shadow-2xl flex flex-col">
    <?php judulPath("Edit Profile", "./FiturTambahan.php") ?>

    <div class="flex-1 flex flex-col gap-5 px-4 py-5">
      <h1 class="text-base font-semibold text-s-black">Edit Profile</h1>

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

      <form action="" method="post" class="flex flex-col gap-5">
        <input type="hidden" name="id_security" value="<?= $_SESSION['id_security'] ?>">

        <div class="flex flex-col gap-4">
          <div class="flex flex-col gap-1.5">
            <label for="nama" class="text-sm font-medium text-s-black">Nama</label>
            <input type="text" name="nama" id="nama" value="<?= $data['nama'] ?>" placeholder="Masukan Nama Security" required
              class="w-full h-[48px] px-4 rounded-lg border border-s-black/20 bg-s-white text-s-black placeholder:text-s-grey outline-none transition focus:border-ijo-500 focus:ring-2 focus:ring-ijo-400/40">
          </div>

          <div class="flex flex-col gap-1.5">
            <label for="nohp" class="text-sm font-medium text-s-black">No Hp</label>
            <input type="text" name="nohp" id="nohp" value="<?= $data['noHp'] ?>" placeholder="Masukan No Hp Security" required
              class="w-full h-[48px] px-4 rounded-lg border border-s-black/20 bg-s-white text-s-black placeholder:text-s-grey outline-none transition focus:border-ijo-500 focus:ring-2 focus:ring-ijo-400/40">
          </div>

          <div class="flex flex-col gap-1.5">
            <label for="username" class="text-sm font-medium text-s-black">Username</label>
            <input type="text" name="username" id="username" value="<?= $data['username'] ?>" placeholder="Masukan Username Security" required
              class="w-full h-[48px] px-4 rounded-lg border border-s-black/20 bg-s-white text-s-black placeholder:text-s-grey outline-none transition focus:border-ijo-500 focus:ring-2 focus:ring-ijo-400/40">
          </div>

          <div class="flex flex-col gap-1.5">
            <label for="password" class="text-sm font-medium text-s-black">Password</label>
            <input type="password" name="password" id="password" value="<?= $data['password'] ?>" placeholder="Masukan Password Security" required
              class="w-full h-[48px] px-4 rounded-lg border border-s-black/20 bg-s-white text-s-black placeholder:text-s-grey outline-none transition focus:border-ijo-500 focus:ring-2 focus:ring-ijo-400/40">
          </div>
        </div>

        <button type="submit" name="submit"
          class="w-full h-[48px] rounded-xl bg-ijo-500 text-s-white font-semibold text-base hover:bg-ijo-600 active:bg-ijo-600 focus-visible:ring-2 focus-visible:ring-ijo-400 transition-colors">
          Simpan
        </button>
      </form>
    </div>
  </main>
</body>

</html>
