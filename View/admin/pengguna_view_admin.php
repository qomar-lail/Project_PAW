<!doctype html><html lang="id"><head>
  <meta charset="utf-8"><title>Admin | Pengguna</title>
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
          <h3><?= $action==='create' ? 'Tambah Pengguna' : 'Edit Pengguna' ?></h3>
          <form method="post" action="pengguna_admin.php?action=<?= $action ?><?= $action==='edit' ? '&id='.(int)($_GET['id']??0) : '' ?>">
            <div class="row">
              <div>
                <label>Nama Pengguna</label>
                <input type="text" name="nama_pengguna" required value="<?= htmlspecialchars($edit_data['nama_pengguna'] ?? '') ?>">
              </div>
              <div>
                <label>Email</label>
                <input type="email" name="email" required value="<?= htmlspecialchars($edit_data['email'] ?? '') ?>">
              </div>
            </div>

            <div class="row">
              <div>
                <label>Password <?= $action==='edit' ? '(kosongkan jika tidak diubah)' : '' ?></label>
                <input type="text" name="password">
              </div>
              <div>
                <label>Sekolah</label>
                <select name="sekolah_id">
                  <option value="">(NULL)</option>
                  <?php $val = $edit_data['sekolah_id'] ?? '';
                  foreach ($sekolah_list as $s): ?>
                    <option value="<?= (int)$s['sekolah_id'] ?>" <?= ((string)$val === (string)$s['sekolah_id']) ? 'selected' : '' ?>>
                      <?= htmlspecialchars($s['nama_sekolah']) ?>
                    </option>
                  <?php endforeach; ?>
                </select>
              </div>
            </div>

            <label>Total Skor</label>

            <?php if ($action === 'create'): ?>
              <input type="number" value="0" disabled>
              <input type="hidden" name="total_skor" value="0">
            <?php else: ?>
              <input type="number" name="total_skor" value="<?= htmlspecialchars($edit_data['total_skor'] ?? 0) ?>">
            <?php endif; ?>

            <div style="margin-top:12px;display:flex;gap:10px;flex-wrap:wrap;">
              <button class="btnx primary" type="submit">Simpan</button>
              <a class="btnx" href="pengguna_admin.php">Batal</a>
            </div>
          </form>
        </div>
      <?php endif; ?>

      <div class="toolbar">
        <form method="get" action="pengguna_admin.php" style="display:flex;gap:10px;flex-wrap:wrap;align-items:center;">
          <input class="input" name="cari" placeholder="Cari nama / email / sekolah..." value="<?= htmlspecialchars($_GET['cari'] ?? '') ?>">
          <button class="btnx primary" type="submit">Cari</button>
          <a class="btnx" href="pengguna_admin.php">Reset</a>
        </form>
        <a class="btnx primary" href="pengguna_admin.php?action=create">+ Tambah Pengguna</a>
      </div>

      <table class="tablex">
        <thead>
          <tr><th>ID</th><th>Username</th><th>Email</th><th>Sekolah</th><th>Skor</th><th style="width:180px;">Aksi</th></tr>
        </thead>
        <tbody>
        <?php if (empty($ls_data_pengguna)): ?>
          <tr><td colspan="6">Data pengguna kosong.</td></tr>
        <?php else: foreach ($ls_data_pengguna as $p): ?>
          <tr>
            <td><?= (int)$p['pengguna_id'] ?></td>
            <td><?= htmlspecialchars($p['nama_pengguna']) ?></td>
            <td><?= htmlspecialchars($p['email']) ?></td>
            <td><?= htmlspecialchars($p['nama_sekolah'] ?? '-') ?></td>
            <td><?= (int)($p['total_skor'] ?? 0) ?></td>
            <td>
              <a class="btnx primary" style="padding:4px 8px;font-size:13px" href="pengguna_admin.php?action=edit&id=<?= (int)$p['pengguna_id'] ?>">Edit</a>
              <form method="post" action="pengguna_admin.php?action=delete" style="display:inline" onsubmit="return confirm('Hapus pengguna ini?')">
                <input type="hidden" name="id" value="<?= (int)$p['pengguna_id'] ?>">
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
