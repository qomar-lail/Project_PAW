<?php
require_once __DIR__ . "/controler/session.php";
if (($_SESSION["role"] ?? "") !== "admin") { header("location: index.php"); exit; }

require_once __DIR__ . "/Model/user/koneksi.php";

$_SESSION["halaman"] = "Dashboard";
$active    = 'dashboard';
$pageTitle = "Dashboard";

$jumlah_modul   = 0;
$jumlah_sekolah = 0;
$jumlah_pengguna = 0;

$r = $conn->query("SELECT COUNT(*) AS c FROM master_modul");
if ($r) $jumlah_modul = (int)$r->fetch_assoc()['c'];

$r = $conn->query("SELECT COUNT(*) AS c FROM sekolah");
if ($r) $jumlah_sekolah = (int)$r->fetch_assoc()['c'];

$r = $conn->query("SELECT COUNT(*) AS c FROM pengguna");
if ($r) $jumlah_pengguna = (int)$r->fetch_assoc()['c'];
?>
<!doctype html>
<html lang="id">
<head>
  <meta charset="utf-8">
  <title>Admin | Dashboard</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
  <link rel="stylesheet" href="View/admin/css/admin.css">
</head>
<body>

<div class="admin-shell">
  <?php require __DIR__ . "/sidebar_admin.php"; ?>

  <div class="admin-main">
    <?php require __DIR__ . "/navigation_admin.php"; ?>

    <div class="admin-body">
      <div style="font-size:22px; margin-bottom:16px;">
        Selamat Datang<br><b>Admin Diary Learning</b>
      </div>

      <div class="stat-row">
        <div class="stat-card">
          <div class="head">
            <span>Modul</span>
            <i class="fa-solid fa-book"></i>
          </div>
          <div class="value"><?= $jumlah_modul ?></div>
        </div>

        <div class="stat-card">
          <div class="head">
            <span>Sekolah</span>
            <i class="fa-solid fa-school"></i>
          </div>
          <div class="value"><?= $jumlah_sekolah ?></div>
        </div>

        <div class="stat-card">
          <div class="head">
            <span>Pengguna</span>
            <i class="fa-solid fa-users"></i>
          </div>
          <div class="value"><?= $jumlah_pengguna ?></div>
        </div>
      </div>
    </div>
  </div>
</div>

</body>
</html>
