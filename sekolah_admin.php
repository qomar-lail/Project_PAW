<?php
require_once __DIR__ . "/controler/session.php";
if (($_SESSION["role"] ?? "") !== "admin") { header("location: index.php"); exit; }

require_once __DIR__ . "/Model/user/koneksi.php";

$_SESSION["halaman"] = "Sekolah";
$active    = 'sekolah';
$pageTitle = "Sekolah";

$action = $_GET['action'] ?? 'index';
$msg    = $_GET['msg'] ?? '';
$error  = '';
$id_sekolah = isset($_GET['id']) ? (int)$_GET['id'] : 0;

/* CREATE */
if ($action === 'create' && $_SERVER['REQUEST_METHOD'] === 'POST') {
    $nama = trim($_POST['nama_sekolah'] ?? '');
    if ($nama === '') {
        $error = "Nama sekolah wajib diisi.";
    } else {
        $n = $conn->real_escape_string($nama);
        if ($conn->query("INSERT INTO sekolah (nama_sekolah) VALUES ('$n')")) {
            header("Location: sekolah_admin.php?msg=created");
            exit;
        }
        $error = "Gagal menambah sekolah.";
    }
}

/* EDIT */
if ($action === 'edit' && $_SERVER['REQUEST_METHOD'] === 'POST') {
    $nama = trim($_POST['nama_sekolah'] ?? '');
    if ($nama === '') {
        $error = "Nama sekolah wajib diisi.";
    } else {
        $n = $conn->real_escape_string($nama);
        if ($conn->query("UPDATE sekolah SET nama_sekolah='$n' WHERE sekolah_id=$id_sekolah LIMIT 1")) {
            header("Location: sekolah_admin.php?msg=updated");
            exit;
        }
        $error = "Gagal mengubah sekolah.";
    }
}

/* DELETE */
if ($action === 'delete' && $_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = (int)($_POST['id'] ?? 0);
    if ($conn->query("DELETE FROM sekolah WHERE sekolah_id=$id LIMIT 1")) {
        header("Location: sekolah_admin.php?msg=deleted");
        exit;
    } else {
        header("Location: sekolah_admin.php?msg=faildelete");
        exit;
    }
}

/* DATA EDIT */
$edit_data = null;
if ($action === 'edit' && $id_sekolah > 0) {
    $r = $conn->query("SELECT * FROM sekolah WHERE sekolah_id=$id_sekolah LIMIT 1");
    if ($r && $r->num_rows === 1) {
        $edit_data = $r->fetch_assoc();
    } else {
        $action = 'index';
        $msg = 'notfound';
    }
}

/* LIST + SEARCH */
$q = trim($_GET['q'] ?? '');
$where = '';
if ($q !== '') {
    $esc = $conn->real_escape_string($q);
    $where = "WHERE nama_sekolah LIKE '%$esc%'";
}
$list = [];
$r = $conn->query("SELECT * FROM sekolah $where ORDER BY sekolah_id ASC");
if ($r) while($row = $r->fetch_assoc()) $list[] = $row;
?>
<!doctype html>
<html lang="id">
<head>
  <meta charset="utf-8">
  <title>Admin | Sekolah</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
  <link rel="stylesheet" href="View/admin/css/admin.css">
</head>
<body>

<div class="admin-shell">
  <?php require __DIR__ . "/sidebar_admin.php"; ?>

  <div class="admin-main">
    <?php require __DIR__ . "/navigation_admin.php"; ?>

    <div class="admin-body">

      <?php if ($msg): ?>
        <div class="alertx">
          <?php
          $map = [
            'created' => 'Berhasil menambah sekolah.',
            'updated' => 'Berhasil mengubah sekolah.',
            'deleted' => 'Berhasil menghapus sekolah.',
            'faildelete' => 'Gagal menghapus sekolah.',
            'notfound' => 'Sekolah tidak ditemukan.'
          ];
          echo htmlspecialchars($map[$msg] ?? $msg);
          ?>
        </div>
      <?php endif; ?>

      <?php if ($action === 'create' || $action === 'edit'): ?>
        <div class="form-card">
          <h3><?= $action === 'create' ? 'Tambah Sekolah' : 'Edit Sekolah' ?></h3>

          <?php if ($error): ?>
            <div class="alertx" style="border-color:#dc3545;color:#dc3545;">
              <?= htmlspecialchars($error) ?>
            </div>
          <?php endif; ?>

          <form method="post">
            <label>Nama Sekolah</label>
            <input type="text" name="nama_sekolah" required
                   value="<?= htmlspecialchars($edit_data['nama_sekolah'] ?? ($_POST['nama_sekolah'] ?? '')) ?>">

            <div style="margin-top:12px; display:flex; gap:10px; flex-wrap:wrap;">
              <button class="btnx primary" type="submit">Simpan</button>
              <a class="btnx" href="sekolah_admin.php">Batal</a>
            </div>
          </form>
        </div>
      <?php endif; ?>

      <div class="toolbar">
        <form method="get" style="display:flex;gap:10px;flex-wrap:wrap;align-items:center;">
          <input type="text" class="input" name="q" placeholder="Cari nama sekolah..." value="<?= htmlspecialchars($q) ?>">
          <button class="btnx primary" type="submit">Cari</button>
          <a class="btnx" href="sekolah_admin.php">Reset</a>
        </form>
        <a class="btnx primary" href="sekolah_admin.php?action=create">+ Tambah Sekolah</a>
      </div>

      <table class="tablex">
        <thead>
          <tr>
            <th>ID</th>
            <th>Nama Sekolah</th>
            <th style="width:180px;">Aksi</th>
          </tr>
        </thead>
        <tbody>
          <?php if (empty($list)): ?>
            <tr><td colspan="3">Data sekolah kosong.</td></tr>
          <?php else: foreach ($list as $s): ?>
            <tr>
              <td><?= (int)$s['sekolah_id'] ?></td>
              <td><?= htmlspecialchars($s['nama_sekolah']) ?></td>
              <td>
                <a class="btnx primary" style="padding:4px 8px;font-size:13px;"
                   href="sekolah_admin.php?action=edit&id=<?= (int)$s['sekolah_id'] ?>">Edit</a>
                <form method="post" action="sekolah_admin.php?action=delete"
                      style="display:inline;" onsubmit="return confirm('Hapus sekolah ini?')">
                  <input type="hidden" name="id" value="<?= (int)$s['sekolah_id'] ?>">
                  <button class="btnx danger" type="submit" style="padding:4px 8px;font-size:13px;border:none;">
                    Hapus
                  </button>
                </form>
              </td>
            </tr>
          <?php endforeach; endif; ?>
        </tbody>
      </table>

    </div>
  </div>
</div>

</body>
</html>
