<?php

function judulPath($judul, $path)
{
?>
  <header class="sticky top-0 z-20 w-full h-[64px] bg-ijo-500 flex items-center gap-4 px-4 shadow-md">
    <a href="<?= $path ?>" aria-label="Kembali" class="flex items-center justify-center w-[45px] h-[45px] shrink-0 rounded-full text-s-white transition-colors hover:bg-ijo-600 active:bg-ijo-600">
      <svg class="w-6 h-6" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
        <path d="m15 18-6-6 6-6" />
      </svg>
    </a>
    <h1 class="flex-1 min-w-0 text-center text-s-white font-semibold text-lg truncate"><?= $judul ?></h1>
    <span class="w-[45px] h-[45px] shrink-0" aria-hidden="true"></span>
  </header>
<?php
}

function judulPolos($judul)
{
?>
  <header class="sticky top-0 z-20 w-full h-[64px] bg-ijo-500 flex items-center justify-center px-4 shadow-md">
    <h1 class="min-w-0 text-center text-s-white font-semibold text-lg truncate"><?= $judul ?></h1>
  </header>
<?php
}
