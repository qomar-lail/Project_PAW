<?php

$_SESSION["halaman"] = "modul";
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Modul</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
  <link rel="stylesheet" href="View/user/css/sidebar.css">
  <link rel="stylesheet" href="View/user/css/dasboard.css">
  <link rel="stylesheet" href="View/user/css/navigation.css">
</head>
<body>
<!-- Perbaiki path sidebar -->
<div>
  <?php include "navigation.php"?>
</div>
<div class="conten px-3" style="padding-top:70px;">
  <!-- Tampilkan pesan error/sukses -->
  <?php if (isset($_SESSION['error'])): ?>
    <div class="alert alert-warning m-4" role="alert">
      <?= htmlspecialchars($_SESSION['error']) ?>
    </div>
    <?php unset($_SESSION['error']); ?>
  <?php endif; ?>

  <?php if (isset($_SESSION['success'])): ?>
    <div class="alert alert-success m-4" role="alert">
      <?= htmlspecialchars($_SESSION['success']) ?>
    </div>
    <?php unset($_SESSION['success']); ?>
  <?php endif; ?>

  <div class="p-4">
    <div class="row row-cols-1 row-cols-md-3 g-4">
      <?php
      $moduls = $_SESSION['_moduls'] ?? [];
      $last_level_completed = $_SESSION['_last_level'] ?? 0;
      foreach ($moduls as $modul):
      ?>
        <div class="col">
          <div class=" p-3 rounded-3 h-100 shadow-sm border border-2 border-primary">
            <div class="card-header bg-white">
              <h5 class="mb-0">Modul <?= htmlspecialchars($modul['level_id']) ?></h5>
            </div>
            <div class="card-body">
              <p class="card-text"><?= htmlspecialchars($modul['deskripsi']) ?></p>
              <?php if ($modul['level_id'] <= $last_level_completed + 1): ?>
                <a href="detail_modul.php?level=<?= urlencode($modul['level_id']) ?>&current=0" class="btn btn-primary btn-sm">open</a>
              <?php else: ?>
                <!-- <button class="btn btn-secondary btn-sm" disabled>Lock</button> -->
                 <i class="fa-solid fa-lock"></i>
                 
              <?php endif; ?>
            </div>
          </div>
        </div>
      <?php endforeach; ?>
    </div>
  </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>