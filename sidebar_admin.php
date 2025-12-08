<?php
// $active di-set di tiap halaman: 'dashboard' | 'modul' | 'sekolah' | 'pengguna'
$active = $active ?? 'dashboard';
?>
<div class="admin-sidebar">
  <a class="admin-side-item <?= $active==='dashboard'?'active':'' ?>" href="admin_dashboard.php">
    <i class="fa-solid fa-house"></i>
    <span>Home</span>
  </a>

  <a class="admin-side-item <?= $active==='modul'?'active':'' ?>" href="modul_admin.php">
    <i class="fa-solid fa-book"></i>
    <span>Modul</span>
  </a>

  <a class="admin-side-item <?= $active==='sekolah'?'active':'' ?>" href="sekolah_admin.php">
    <i class="fa-solid fa-school"></i>
    <span>Sekolah</span>
  </a>

  <a class="admin-side-item <?= $active==='pengguna'?'active':'' ?>" href="pengguna_admin.php">
    <i class="fa-solid fa-users"></i>
    <span>Pengguna</span>
  </a>

  <div style="flex:1"></div>

<a class="admin-side-item admin-logout" href="./controler/logout.php">
  <i class="fa-solid fa-right-from-bracket"></i>
  <span>Log Out</span>
</a>
</div>
