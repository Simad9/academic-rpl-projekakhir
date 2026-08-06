<?php
// Bottom tab bar. Sebelum di-include, set variabel:
// $navActive = 'home' | 'menu' | 'profile' | 'logout' (default 'home')
// Opsional $navItems = [ 'key' => ['label' => ..., 'href' => ...], ... ] (default untuk role Security)
$navActive = $navActive ?? 'home';

$navItems = $navItems ?? [
  'home' => ['label' => 'Beranda', 'href' => './SecurityJaga.php'],
  'menu' => ['label' => 'Menu', 'href' => './FiturTambahan.php'],
  'profile' => ['label' => 'Profil', 'href' => './EditProfile.php'],
  'logout' => ['label' => 'Keluar', 'href' => '../../'],
];

$navIcons = [
  'home' => '<svg class="w-6 h-6" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M3 10.5 12 3l9 7.5" /><path d="M5 10v10h5v-6h4v6h5V10" /></svg>',
  'menu' => '<svg class="w-6 h-6" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><rect x="3" y="3" width="7" height="7" rx="1.5" /><rect x="14" y="3" width="7" height="7" rx="1.5" /><rect x="3" y="14" width="7" height="7" rx="1.5" /><rect x="14" y="14" width="7" height="7" rx="1.5" /></svg>',
  'profile' => '<svg class="w-6 h-6" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M12 11a4 4 0 1 0 0-8 4 4 0 0 0 0 8Z" /><path d="M4 21c0-4 3.6-6.5 8-6.5s8 2.5 8 6.5" /></svg>',
  'logout' => '<svg class="w-6 h-6" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4" /><path d="m16 17 5-5-5-5" /><path d="M21 12H9" /></svg>',
];
?>
<nav class="sticky bottom-0 z-20 w-full bg-s-white border-t border-s-black/10" aria-label="Navigasi utama">
  <div class="flex items-stretch">
    <?php foreach ($navItems as $key => $item) :
      $isLogout = $key === 'logout';
      $isActive = $key === $navActive;
    ?>
      <a href="<?= $item['href'] ?>" aria-label="<?= $item['label'] ?>"
        class="relative flex-1 flex flex-col items-center justify-center gap-1 min-h-[64px] pb-1 transition-colors hover:bg-ijo-100 active:bg-ijo-100
          <?= $isLogout
              ? 'text-s-red'
              : ($isActive
                  ? 'text-ijo-600 font-semibold after:absolute after:top-0 after:left-1/2 after:-translate-x-1/2 after:w-8 after:h-[3px] after:rounded-b-full after:bg-ijo-500'
                  : 'text-s-grey') ?>">
        <span class="flex items-center justify-center w-11 h-11"><?= $navIcons[$key] ?></span>
        <span class="text-[11px] leading-none"><?= $item['label'] ?></span>
      </a>
    <?php endforeach; ?>
  </div>
</nav>
