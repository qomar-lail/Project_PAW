<?php
require_once __DIR__ . "/controler/session.php";
if (($_SESSION["role"] ?? "") !== "admin") { header("location: index.php"); exit; }

require_once __DIR__ . "/Model/user/koneksi.php";

$_SESSION["halaman"] = "Modul";
$active    = 'modul';
$pageTitle = "Modul";

$action = $_GET['action'] ?? 'index';
$msg    = $_GET['msg'] ?? '';
$error  = '';
$level_id = isset($_GET['id']) ? (int)$_GET['id'] : 0;

/* HANDLE CREATE */
if ($action === 'create' && $_SERVER['REQUEST_METHOD'] === 'POST') {
    $judul = trim($_POST['judul'] ?? '');
    $deskripsi = trim($_POST['deskripsi'] ?? '');

    if ($judul === '') {
        $error = "Judul wajib diisi.";
    } else {
        $j = $conn->real_escape_string($judul);
        $d = $conn->real_escape_string($deskripsi);
        if ($conn->query("INSERT INTO master_modul (judul, deskripsi) VALUES ('$j','$d')")) {
            header("Location: modul_admin.php?msg=created");
            exit;
        }
        $error = "Gagal menambah modul.";
    }
}

/* HANDLE EDIT */
if ($action === 'edit' && $_SERVER['REQUEST_METHOD'] === 'POST') {
    $judul = trim($_POST['judul'] ?? '');
    $deskripsi = trim($_POST['deskripsi'] ?? '');
    if ($judul === '') {
        $error = "Judul wajib diisi.";
    } else {
        $j = $conn->real_escape_string($judul);
        $d = $conn->real_escape_string($deskripsi);
        if ($conn->query("UPDATE master_modul SET judul='$j', deskripsi='$d' WHERE level_id=$level_id LIMIT 1")) {
            header("Location: modul_admin.php?msg=updated");
            exit;
        }
        $error = "Gagal mengubah modul.";
    }
}

/* HANDLE DELETE */
if ($action === 'delete' && $_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = (int)($_POST['id'] ?? 0);
    if ($conn->query("DELETE FROM master_modul WHERE level_id=$id LIMIT 1")) {
        header("Location: modul_admin.php?msg=deleted");
        exit;
    } else {
        header("Location: modul_admin.php?msg=faildelete");
        exit;
    }
}

/* DATA EDIT (JIKA EDIT) */
$edit_data = null;
if ($action === 'edit' && $level_id > 0) {
    $r = $conn->query("SELECT * FROM master_modul WHERE level_id=$level_id LIMIT 1");
    if ($r && $r->num_rows === 1) {
        $edit_data = $r->fetch_assoc();
    } else {
        $action = 'index';
        $msg = 'notfound';
    }
}

/* DATA LIST + SEARCH */
$q = trim($_GET['q'] ?? '');
$where = '';
if ($q !== '') {
    $esc = $conn->real_escape_string($q);
    $where = "WHERE judul LIKE '%$esc%' OR deskripsi LIKE '%$esc%'";
}
$list_modul = [];
$r = $conn->query("SELECT * FROM master_modul $where ORDER BY level_id ASC");
if ($r) while($row = $r->fetch_assoc()) $list_modul[] = $row;
?>
<!doctype html>
<html lang="id">
<head>
  <meta charset="utf-8">
  <title>Admin | Modul</title>
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
              'created' => 'Berhasil menambah modul.',
              'updated' => 'Berhasil mengubah modul.',
              'deleted' => 'Berhasil menghapus modul.',
              'faildelete' => 'Gagal menghapus modul.',
              'notfound' => 'Modul tidak ditemukan.'
            ];
            echo htmlspecialchars($map[$msg] ?? $msg);
          ?>
        </div>
      <?php endif; ?>

      <?php if ($action === 'create' || $action === 'edit'): ?>
        <div class="form-card">
          <h3><?= $action === 'create' ? 'Tambah Modul' : 'Edit Modul' ?></h3>

          <?php if ($error): ?>
            <div class="alertx" style="border-color:#dc3545;color:#dc3545;">
              <?= htmlspecialchars($error) ?>
            </div>
          <?php endif; ?>

          <form method="post">
            <label>Judul Modul</label>
            <input type="text" name="judul" required
                   value="<?= htmlspecialchars($edit_data['judul'] ?? ($_POST['judul'] ?? '')) ?>">

            <label>Deskripsi</label>
            <textarea name="deskripsi"><?= htmlspecialchars($edit_data['deskripsi'] ?? ($_POST['deskripsi'] ?? '')) ?></textarea>

            <div style="margin-top:12px; display:flex; gap:10px; flex-wrap:wrap;">
              <button class="btnx primary" type="submit">Simpan</button>
              <a class="btnx" href="modul_admin.php">Batal</a>
            </div>
          </form>
        </div>
      <?php endif; ?>

      <div class="toolbar">
        <form method="get" style="display:flex;gap:10px;flex-wrap:wrap;align-items:center;">
          <input type="text" class="input" name="q" placeholder="Cari judul / deskripsi..." value="<?= htmlspecialchars($q) ?>">
          <button class="btnx primary" type="submit">Cari</button>
          <a class="btnx" href="modul_admin.php">Reset</a>
        </form>
        <a class="btnx primary" href="modul_admin.php?action=create">+ Tambah Modul</a>
      </div>

      <div class="mod-grid">
        <?php if (empty($list_modul)): ?>
          <p>Tidak ada modul.</p>
        <?php else: foreach ($list_modul as $m): ?>
          <div class="mod-card">
            <div class="head">
              <?= htmlspecialchars($m['judul']) ?>
            </div>
            <div class="body">
              <?= nl2br(htmlspecialchars($m['deskripsi'])) ?>
              <div style="margin-top:10px; display:flex; gap:8px;">
                <a class="btnx primary" style="padding:4px 8px;font-size:13px;"
                   href="modul_admin.php?action=edit&id=<?= (int)$m['level_id'] ?>">
                  Edit
                </a>
                <form method="post" action="modul_admin.php?action=delete"
                      onsubmit="return confirm('Hapus modul ini?')">
                  <input type="hidden" name="id" value="<?= (int)$m['level_id'] ?>">
                  <button class="btnx danger" type="submit" style="padding:4px 8px;font-size:13px;border:none;">
                    Hapus
                  </button>
                </form>
              </div>
            </div>
          </div>
        <?php endforeach; endif; ?>
      </div>

    </div>
  </div>
</div>

</body>
</html>
