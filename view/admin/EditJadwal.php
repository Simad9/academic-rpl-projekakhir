<?php
require '../../model/be_main.php';

$id_security = $_GET["id_security"];
$query = "SELECT * FROM lap_jaga 
INNER JOIN security ON lap_jaga.id_security = security.id_security
WHERE lap_jaga.id_security = $id_security";
$hasil = mysqli_query($koneksi, $query);
$data = mysqli_fetch_assoc($hasil);

if (isset($_POST['simpan'])) {
  be_updateJadwalJaga($id_security, $_POST['id_jadwal']);
  header("location: JadwalSecurity.php?status=securityDiupdate");
  exit();
}

?>
<!DOCTYPE html>
<html lang="id">

<head>
  <?php include '../../tamplate/meta.php'; ?>
  <?php require '../../tamplate/judul.php'; ?>
  <title>Edit Jadwal</title>
</head>

<body class="bg-s-grey/20">
  <main class="w-full max-w-[430px] mx-auto min-h-screen bg-s-white shadow-2xl flex flex-col">
    <?php judulPath("Edit Jadwal", "./JadwalSecurity.php") ?>

    <div class="flex-1 flex flex-col gap-5 px-4 py-5">
      <h1 class="text-base font-semibold text-s-black">Edit Jadwal Security</h1>

      <form action="" method="post" class="flex flex-col gap-5">
        <div class="flex flex-col gap-4">
          <div class="flex flex-col gap-1.5">
            <label for="nama" class="text-sm font-medium text-s-black">Nama</label>
            <input type="text" id="nama" value="<?= $data['nama'] ?>" readonly
              class="w-full h-[48px] px-4 rounded-lg border border-s-black/10 bg-s-grey/10 text-s-black outline-none">
          </div>

          <div class="flex flex-col gap-1.5">
            <label for="id_jadwal" class="text-sm font-medium text-s-black">Jadwal</label>
            <select name="id_jadwal" id="id_jadwal"
              class="w-full h-[48px] px-4 rounded-lg border border-s-black/20 bg-s-white text-s-black outline-none transition focus:border-ijo-500 focus:ring-2 focus:ring-ijo-400/40">
              <?php if ($data['id_jadwal'] == 1) : ?>
                <option value="1" selected>07:00 s/d 15:00</option>
              <?php else : ?>
                <option value="1">07:00 s/d 15:00</option>
              <?php endif; ?>
              <?php if ($data['id_jadwal'] == 2) : ?>
                <option value="2" selected>15:00 s/d 22:00</option>
              <?php else : ?>
                <option value="2">15:00 s/d 22:00</option>
              <?php endif; ?>
              <?php if ($data['id_jadwal'] == 3) : ?>
                <option value="3" selected>22:00 s/d 07:00</option>
              <?php else : ?>
                <option value="3">22:00 s/d 07:00</option>
              <?php endif; ?>
              <?php if ($data['id_jadwal'] == NULL) : ?>
                <option value="-" selected>-</option>
              <?php endif; ?>
            </select>
          </div>
        </div>

        <button type="submit" name="simpan"
          class="w-full h-[48px] rounded-xl bg-ijo-500 text-s-white font-semibold text-base hover:bg-ijo-600 active:bg-ijo-600 focus-visible:ring-2 focus-visible:ring-ijo-400 transition-colors">
          Kirim
        </button>
      </form>
    </div>
  </main>
</body>

</html>
