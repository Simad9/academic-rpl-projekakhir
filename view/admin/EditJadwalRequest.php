<?php
require '../../model/be_main.php';

$id_security = $_GET["id_security"];
$query1 = "SELECT * FROM lap_jaga 
INNER JOIN security ON lap_jaga.id_security = security.id_security
WHERE lap_jaga.id_security = $id_security";
$hasil1 = mysqli_query($koneksi, $query1);
$data1 = mysqli_fetch_assoc($hasil1);

$id_securityTeman = $_GET["id_securityTeman"];
$query2 = "SELECT * FROM lap_jaga 
INNER JOIN security ON lap_jaga.id_security = security.id_security
WHERE lap_jaga.id_security = $id_securityTeman";
$hasil2 = mysqli_query($koneksi, $query2);
$data2 = mysqli_fetch_assoc($hasil2);

$errorJadwal = false;
if (isset($_POST['simpan'])) {
  $id_jadwal = $_POST["id_jadwal"];
  $id_jadwalTeman = $_POST["id_jadwalTeman"];

  if ($id_jadwal != $id_jadwalTeman) {
    be_updateJadwalJaga($id_security, $id_jadwal);
    be_updateJadwalJaga($id_securityTeman, $id_jadwalTeman);
    header("location: JadwalSecurity.php?status=diupdate");
    exit();
  } else {
    $errorJadwal = true;
  }
}

?>
<!DOCTYPE html>
<html lang="id">

<head>
  <?php include '../../tamplate/meta.php'; ?>
  <?php require '../../tamplate/judul.php'; ?>
  <title>Edit Jadwal Request</title>
</head>

<body class="bg-s-grey/20">
  <main class="w-full max-w-[430px] mx-auto min-h-screen bg-s-white shadow-2xl flex flex-col">
    <?php judulPath("Edit Jadwal Request", "./RequestJadwal.php") ?>

    <div class="flex-1 flex flex-col gap-5 px-4 py-5">
      <h1 class="text-base font-semibold text-s-black">Edit Jadwal Security Request</h1>

      <?php if ($errorJadwal) : ?>
        <div class="flex items-center gap-2 p-3 rounded-lg bg-s-red/10 border border-s-red/30 text-s-red text-sm" role="alert">
          <svg class="w-5 h-5 shrink-0" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
            <circle cx="12" cy="12" r="10" />
            <path d="M12 8v4" />
            <path d="M12 16h.01" />
          </svg>
          Jam tidak boleh sama
        </div>
      <?php endif; ?>

      <form action="" method="post" class="flex flex-col gap-5">
        <div class="flex flex-col gap-5">
          <div class="flex flex-col gap-4">
            <h2 class="text-sm font-semibold text-s-black">Security 1</h2>
            <div class="flex flex-col gap-1.5">
              <label for="nama1" class="text-sm font-medium text-s-black">Nama</label>
              <input type="text" id="nama1" value="<?= $data1['nama'] ?>" readonly
                class="w-full h-[48px] px-4 rounded-lg border border-s-black/10 bg-s-grey/10 text-s-black outline-none">
            </div>

            <div class="flex flex-col gap-1.5">
              <label for="id_jadwal" class="text-sm font-medium text-s-black">Jadwal</label>
              <select name="id_jadwal" id="id_jadwal"
                class="w-full h-[48px] px-4 rounded-lg border border-s-black/20 bg-s-white text-s-black outline-none transition focus:border-ijo-500 focus:ring-2 focus:ring-ijo-400/40">
                <?php if ($data1['id_jadwal'] == 1) : ?>
                  <option value="1" selected>07:00 s/d 15:00</option>
                <?php else : ?>
                  <option value="1">07:00 s/d 15:00</option>
                <?php endif; ?>
                <?php if ($data1['id_jadwal'] == 2) : ?>
                  <option value="2" selected>15:00 s/d 22:00</option>
                <?php else : ?>
                  <option value="2">15:00 s/d 22:00</option>
                <?php endif; ?>
                <?php if ($data1['id_jadwal'] == 3) : ?>
                  <option value="3" selected>22:00 s/d 07:00</option>
                <?php else : ?>
                  <option value="3">22:00 s/d 07:00</option>
                <?php endif; ?>
              </select>
            </div>
          </div>

          <div class="w-full h-px bg-s-black/10"></div>

          <div class="flex flex-col gap-4">
            <h2 class="text-sm font-semibold text-s-black">Security 2</h2>
            <div class="flex flex-col gap-1.5">
              <label for="nama2" class="text-sm font-medium text-s-black">Nama</label>
              <input type="text" id="nama2" value="<?= $data2['nama'] ?>" readonly
                class="w-full h-[48px] px-4 rounded-lg border border-s-black/10 bg-s-grey/10 text-s-black outline-none">
            </div>

            <div class="flex flex-col gap-1.5">
              <label for="id_jadwalTeman" class="text-sm font-medium text-s-black">Jadwal</label>
              <select name="id_jadwalTeman" id="id_jadwalTeman"
                class="w-full h-[48px] px-4 rounded-lg border border-s-black/20 bg-s-white text-s-black outline-none transition focus:border-ijo-500 focus:ring-2 focus:ring-ijo-400/40">
                <?php if ($data2['id_jadwal'] == 1) : ?>
                  <option value="1" selected>07:00 s/d 15:00</option>
                <?php else : ?>
                  <option value="1">07:00 s/d 15:00</option>
                <?php endif; ?>
                <?php if ($data2['id_jadwal'] == 2) : ?>
                  <option value="2" selected>15:00 s/d 22:00</option>
                <?php else : ?>
                  <option value="2">15:00 s/d 22:00</option>
                <?php endif; ?>
                <?php if ($data2['id_jadwal'] == 3) : ?>
                  <option value="3" selected>22:00 s/d 07:00</option>
                <?php else : ?>
                  <option value="3">22:00 s/d 07:00</option>
                <?php endif; ?>
              </select>
            </div>
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
