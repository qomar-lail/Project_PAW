<?php
?>
<!doctype html><html lang="id"><head>
  <meta charset="utf-8"><title>Admin | Modul</title>
  <link rel="stylesheet" href="View/admin/css/admin.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
</head><body>
<div class="admin-shell">
  <?php require __DIR__ . "/../../sidebar_admin.php"; ?>
  <div class="admin-main">
    <?php require __DIR__ . "/../../navigation_admin.php"; ?>
    <div class="admin-body">

      <?php if (!empty($msg)): ?>
        <div class="alertx"><?= htmlspecialchars($msg) ?></div>
      <?php endif; ?>
      <?php if (!empty($error)): ?>
        <div class="alertx" style="border-color:#dc3545;color:#dc3545;"><?= htmlspecialchars($error) ?></div>
      <?php endif; ?>

      <?php if ($action==='create' || $action==='edit'): ?>
        <div class="form-card">
          <h3><?= $action==='create' ? 'Tambah Modul' : 'Edit Modul' ?></h3>
          <form method="post" action="modul_admin.php?action=<?= $action ?><?= $action==='edit' ? '&id='.(int)($_GET['id']??0) : '' ?>">
            <label>Judul</label>
            <input type="text" name="judul" required value="<?= htmlspecialchars($edit_data['judul'] ?? '') ?>">
            <label>Deskripsi</label>
            <textarea name="deskripsi"><?= htmlspecialchars($edit_data['deskripsi'] ?? '') ?></textarea>
            <div style="margin-top:12px;display:flex;gap:10px;flex-wrap:wrap;">
              <button class="btnx primary" type="submit">Simpan</button>
              <a class="btnx" href="modul_admin.php">Batal</a>
            </div>
          </form>
        </div>
      <?php endif; ?>

      <div class="toolbar">
        <form method="get" action="modul_admin.php" style="display:flex;gap:10px;flex-wrap:wrap;align-items:center;">
          <input class="input" name="cari" placeholder="Cari judul / deskripsi..." value="<?= htmlspecialchars($_GET['cari'] ?? '') ?>">
          <button class="btnx primary" type="submit">Cari</button>
          <a class="btnx" href="modul_admin.php">Reset</a>
        </form>
        <a class="btnx primary" href="modul_admin.php?action=create">+ Tambah Modul</a>
      </div>

      <table class="tablex">
        <thead><tr><th>ID</th><th>Judul</th><th>Deskripsi</th><th style="width:180px;">Aksi</th></tr></thead>
        <tbody>
        <?php if (empty($ls_data_modul)): ?>
          <tr><td colspan="4">Data modul kosong.</td></tr>
        <?php else: foreach ($ls_data_modul as $m): ?>
          <tr>
            <td><?= (int)$m['level_id'] ?></td>
            <td><?= htmlspecialchars($m['judul']) ?></td>
            <td><?= htmlspecialchars($m['deskripsi']) ?></td>
            <td>
              <a class="btnx primary" style="padding:4px 8px;font-size:13px" href="modul_admin.php?action=edit&id=<?= (int)$m['level_id'] ?>">Edit</a>
              <form method="post" action="modul_admin.php?action=delete" style="display:inline" onsubmit="return confirm('Hapus modul ini?')">
                <input type="hidden" name="id" value="<?= (int)$m['level_id'] ?>">
                <button class="btnx danger" type="submit" style="padding:4px 8px;font-size:13px;border:none">Hapus</button>
              </form>
            </td>
          </tr>
        <?php endforeach; endif; ?>
        </tbody>
      </table>

    </div>
  </div>
</div>
</body></html>
