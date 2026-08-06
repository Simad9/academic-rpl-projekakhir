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

if (isset($_GET["status"])) {
  switch ($_GET["status"]) {
    case "gagal":
      echo '<script>
      alert("Terdapat Kesalahan di Username atau di Password");
      </script>';
      break;
  }
}

?>
<!DOCTYPE html>
<html lang="en">

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

<body class="flex flex-col bg-s-white w-full md:w-5/12 md:m-auto border border-s-black border-e-black">
  <img src="./assets/icon/hiasan bg.png" class="w-full">
  <section class="flex flex-col justify-center items-center w-full px-[20px] gap-[10px] -mt-[80px] mb-36">
    <img src="./assets/icon/Logo.png" class="">

    <form action="" method="post" class="w-full flex flex-col gap-[20px]">

      <div class="flex flex-col gap-[5px]">
        <div id="username">
          <h1 class="font-semibold text-s-black text-[20px]">Username</h1>
          <input type="text" name="username" class="p-[10px] border border-s-black rounded-[10px] w-full" placeholder="Masukan Username anda">
        </div>
        <div id="password">
          <h1 class="font-semibold text-s-black text-[20px]">Password</h1>
          <input type="password" name="password" class="p-[10px] border border-s-black rounded-[10px] w-full" placeholder="Masukan Password anda">
        </div>
      </div>

      <div id="button-group" class="flex flex-col justify-center gap-[10px] w-full">

        <div class="w-full">
          <button type="submit" name="submit" class="w-full p-[10px] rounded-[10px] bg-ijo-500 text-s-white font-medium text-[20px]">MASUK</button>
        </div>

        <a href="./view/mahasiswa/LaporanBarang.php" class="w-full">
          <div class="w-full p-[10px] rounded-[10px] border border-ijo-500 bg-s-white text-ijo-500 font-medium text-[20px] text-center">Masuk sebagai Mahasiswa</div>
        </a>

      </div>
    </form>

    <div class="w-full border border-s-black rounded-[10px] p-[15px] flex flex-col gap-[5px]">
      <h1 class="font-semibold text-s-black text-[15px]">Akun Demo</h1>
      <p class="text-s-grey text-[13px]">Admin : <span class="font-medium text-s-black">admin / admin</span></p>
      <p class="text-s-grey text-[13px]">Security 1 : <span class="font-medium text-s-black">sec1 / sec1</span></p>
      <p class="text-s-grey text-[13px]">Security 2 : <span class="font-medium text-s-black">sec2 / sec2</span></p>
      <p class="text-s-grey text-[13px]">Security 3 : <span class="font-medium text-s-black">sec3 / sec3</span></p>
    </div>

  </section>
</body>

</html>