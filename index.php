<?php
// Untuk logout
session_start();
session_destroy();

// mulai lagi
session_start();
require './model/be_main.php';

if (isset($_POST["submit"])) {
  be_login();
}

$loginGagal = isset($_GET["status"]) && $_GET["status"] === "gagal";
?>
<!DOCTYPE html>
<html lang="id">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="shortcut icon" href="./assets/favicon/Icon.svg" type="image/svg+xml">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
  <!-- CSS Tailwind -->
  <link rel="stylesheet" href="./src/output.css">
  <title>Security App</title>
</head>

<body class="bg-s-grey/20">
  <main class="w-full max-w-[430px] mx-auto min-h-screen bg-s-white shadow-2xl flex flex-col">
    <!-- Header visual -->
    <header class="relative">
      <img src="./assets/icon/hiasan bg.png" alt="Ilustrasi" class="w-full h-auto">
      <div class="absolute inset-x-0 bottom-0 flex justify-center translate-y-1/2">
        <img src="./assets/icon/Logo.png" alt="Logo Security App" class="w-[96px] h-[96px] object-contain drop-shadow-lg">
      </div>
    </header>

    <!-- Konten -->
    <section class="flex-1 flex flex-col justify-center gap-[28px] px-[20px] pt-[72px] pb-[32px]">

      <form action="" method="post" class="flex flex-col gap-[20px]">

        <?php if ($loginGagal) : ?>
          <div class="flex items-center gap-2 p-3 rounded-lg bg-s-red/10 border border-s-red/30 text-s-red text-sm" role="alert">
            <svg class="w-5 h-5 shrink-0" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
              <circle cx="12" cy="12" r="10" />
              <path d="M12 8v4" />
              <path d="M12 16h.01" />
            </svg>
            Terdapat kesalahan pada Username atau Password
          </div>
        <?php endif; ?>

        <div class="flex flex-col gap-[20px]">
          <div class="flex flex-col gap-1.5">
            <label for="username" class="text-sm font-medium text-s-black">Username</label>
            <input type="text" name="username" id="username" placeholder="Masukan Username anda" required
              class="w-full h-[48px] px-4 rounded-lg border border-s-black/20 bg-s-white text-s-black placeholder:text-s-grey outline-none transition focus:border-ijo-500 focus:ring-2 focus:ring-ijo-400/40">
          </div>

          <div class="flex flex-col gap-1.5">
            <label for="password" class="text-sm font-medium text-s-black">Password</label>
            <input type="password" name="password" id="password" placeholder="Masukan Password anda" required
              class="w-full h-[48px] px-4 rounded-lg border border-s-black/20 bg-s-white text-s-black placeholder:text-s-grey outline-none transition focus:border-ijo-500 focus:ring-2 focus:ring-ijo-400/40">
          </div>
        </div>

        <div class="flex flex-col gap-3">
          <button type="submit" name="submit"
            class="w-full h-[48px] rounded-xl bg-ijo-500 text-s-white font-semibold text-base hover:bg-ijo-600 active:bg-ijo-600 focus-visible:ring-2 focus-visible:ring-ijo-400 transition-colors">
            Masuk
          </button>

          <a href="./view/mahasiswa/LaporanBarang.php"
            class="w-full h-[48px] flex items-center justify-center rounded-xl border border-ijo-500 bg-s-white text-ijo-600 font-semibold text-base hover:bg-ijo-100 active:bg-ijo-100 focus-visible:ring-2 focus-visible:ring-ijo-400 transition-colors">
            Masuk sebagai Mahasiswa
          </a>
        </div>
      </form>

      <!-- Akun demo -->
      <div class="flex flex-col gap-2 p-4 rounded-xl bg-s-grey/10 border border-s-grey/20">
        <h2 class="text-sm font-semibold text-s-black">Akun Demo</h2>
        <p class="text-xs text-s-grey">Admin : <span class="font-medium text-s-black">admin / admin</span></p>
        <p class="text-xs text-s-grey">Security 1 : <span class="font-medium text-s-black">sec1 / sec1</span></p>
        <p class="text-xs text-s-grey">Security 2 : <span class="font-medium text-s-black">sec2 / sec2</span></p>
        <p class="text-xs text-s-grey">Security 3 : <span class="font-medium text-s-black">sec3 / sec3</span></p>
      </div>

    </section>
  </main>
</body>

</html>
