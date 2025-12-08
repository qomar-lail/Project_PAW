<?php
require_once __DIR__ . "/controler/session.php";
if (($_SESSION["role"] ?? "") !== "admin") { header("location: index.php"); exit; }

require_once __DIR__ . "/Model/user/koneksi.php";

$_SESSION["halaman"] = "Pengguna";
$active    = 'pengguna';
$pageTitle = "Pengguna";

$action = $_GET['action'] ?? 'index';
$msg    = $_GET['msg'] ?? '';
$error  = '';
$id_pengguna = isset($_GET['id']) ? (int)$_GET['id'] : 0;

/* LIST SEKOLAH UNTUK FORM */
$sekolah_list = [];
$r = $conn->query("SELECT sekolah_id, nama_sekolah FROM sekolah ORDER BY nama_sekolah ASC");
if ($r) while($row = $r->fetch_assoc()) $sekolah_list[] = $row;

/* CREATE */
if ($action === 'create' && $_SERVER['REQUEST_METHOD'] === 'POST') {
    $nama = trim($_POST['nama_pengguna'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $password = $_POST['password'] ?? '';
    $sekolah_id = $_POST['sekolah_id'] !== '' ? (int)$_POST['sekolah_id'] : null;
    $total_skor = (int)($_POST['total_skor'] ?? 0);

    if ($nama === '' || $email === '' || $password === '') {
        $error = "Nama, email, dan password wajib diisi.";
    } else {
        $n = $conn->real_escape_string($nama);
        $e = $conn->real_escape_string($email);
        $pw = md5($password);
        $ts = $total_skor;

        $sql = "INSERT INTO pengguna (nama_pengguna,email,password,sekolah_id,total_skor)
                VALUES('$n','$e','$pw',".($sekolah_id===null?'NULL':$sekolah_id).",$ts)";
        if ($conn->query($sql)) {
            header("Location: pengguna_admin.php?msg=created");
            exit;
        }
        $error = "Gagal menambah pengguna.";
    }
}

/* EDIT */
if ($action === 'edit' && $_SERVER['REQUEST_METHOD'] === 'POST') {
    $nama = trim($_POST['nama_pengguna'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $password = $_POST['password'] ?? '';
    $sekolah_id = $_POST['sekolah_id'] !== '' ? (int)$_POST['sekolah_id'] : null;
    $total_skor = (int)($_POST['total_skor'] ?? 0);

    if ($nama === '' || $email === '') {
        $error = "Nama dan email wajib diisi.";
    } else {
        $n = $conn->real_escape_string($nama);
        $e = $conn->real_escape_string($email);
        $ts = $total_skor;

        $set_pw = '';
        if ($password !== '') {
            $pw = md5($password);
            $set_pw = ", password='$pw'";
        }

        $sql = "UPDATE pengguna SET nama_pengguna='$n', email='$e',
                sekolah_id=".($sekolah_id===null?'NULL':$sekolah_id).",
                total_skor=$ts $set_pw
                WHERE pengguna_id=$id_pengguna LIMIT 1";

        if ($conn->query($sql)) {
            header("Location: pengguna_admin.php?msg=updated");
            exit;
        }
        $error = "Gagal mengubah pengguna.";
    }
}

/* DELETE */
if ($action === 'delete' && $_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = (int)($_POST['id'] ?? 0);
    if ($conn->query("DELETE FROM pengguna WHERE pengguna_id=$id LIMIT 1")) {
        header("Location: pengguna_admin.php?msg=deleted");
        exit;
    } else {
        header("Location: pengguna_admin.php?msg=faildelete");
        exit;
    }
}

/* DATA EDIT */
$edit_data = null;
if ($action === 'edit' && $id_pengguna > 0) {
    $r = $conn->query("SELECT * FROM pengguna WHERE pengguna_id=$id_pengguna LIMIT 1");
    if ($r && $r->num_rows === 1) {
        $edit_data = $r->fetch_assoc();
    } else {
        $action = 'index';
        $msg = 'notfound';
    }
}

/* LIST + RANKING + SEARCH */
$q = trim($_GET['q'] ?? '');
$where = '';
if ($q !== '') {
    $esc = $conn->real_escape_string($q);
    $where = "WHERE p.nama_pengguna LIKE '%$esc%' OR p.email LIKE '%$esc%' OR s.nama_sekolah LIKE '%$esc%'";
}
$list = [];
$r = $conn->query("SELECT p.*, s.nama_sekolah
                   FROM pengguna p
                   LEFT JOIN sekolah s ON p.sekolah_id=s.sekolah_id
                   $where
                   ORDER BY p.total_skor DESC, p.pengguna_id ASC");
if ($r) while($row = $r->fetch_assoc()) $list[] = $row;

/* ranking sederhana */
$ranking = [];
$rank = 1;
foreach ($list as $row) {
    $ranking[$row['pengguna_id']] = $rank++;
}
?>
<!doctype html>
<html lang="id">
<head>
  <meta charset="utf-8">
  <title>Admin | Pengguna</title>
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
            'created' => 'Berhasil menambah pengguna.',
            'updated' => 'Berhasil mengubah pengguna.',
            'deleted' => 'Berhasil menghapus pengguna.',
            'faildelete' => 'Gagal menghapus pengguna.',
            'notfound' => 'Pengguna tidak ditemukan.'
          ];
          echo htmlspecialchars($map[$msg] ?? $msg);
          ?>
        </div>
      <?php endif; ?>

      <?php if ($action === 'create' || $action === 'edit'): ?>
        <div class="form-card">
          <h3><?= $action === 'create' ? 'Tambah Pengguna' : 'Edit Pengguna' ?></h3>

          <?php if ($error): ?>
            <div class="alertx" style="border-color:#dc3545;color:#dc3545;">
              <?= htmlspecialchars($error) ?>
            </div>
          <?php endif; ?>

          <form method="post">
            <div class="row">
              <div>
                <label>Nama Pengguna</label>
                <input type="text" name="nama_pengguna" required
                       value="<?= htmlspecialchars($edit_data['nama_pengguna'] ?? ($_POST['nama_pengguna'] ?? '')) ?>">
              </div>
              <div>
                <label>Email</label>
                <input type="email" name="email" required
                       value="<?= htmlspecialchars($edit_data['email'] ?? ($_POST['email'] ?? '')) ?>">
              </div>
            </div>

            <div class="row">
              <div>
                <label>Password <?= $action === 'edit' ? '(kosongkan jika tidak diubah)' : '' ?></label>
                <input type="text" name="password">
              </div>
              <div>
                <label>Sekolah</label>
                <select name="sekolah_id">
                  <option value="">(Tidak ada / NULL)</option>
                  <?php
                  $val_sekolah = $edit_data['sekolah_id'] ?? ($_POST['sekolah_id'] ?? '');
                  foreach ($sekolah_list as $s):
                  ?>
                    <option value="<?= (int)$s['sekolah_id'] ?>"
                      <?= (string)$val_sekolah === (string)$s['sekolah_id'] ? 'selected' : '' ?>>
                      <?= htmlspecialchars($s['nama_sekolah']) ?>
                    </option>
                  <?php endforeach; ?>
                </select>
              </div>
            </div>

            <label>Total Skor</label>
            <input type="number" name="total_skor"
                   value="<?= htmlspecialchars($edit_data['total_skor'] ?? ($_POST['total_skor'] ?? 0)) ?>">

            <div style="margin-top:12px; display:flex; gap:10px; flex-wrap:wrap;">
              <button class="btnx primary" type="submit">Simpan</button>
              <a class="btnx" href="pengguna_admin.php">Batal</a>
            </div>
          </form>
        </div>
      <?php endif; ?>

      <div class="toolbar">
        <form method="get" style="display:flex;gap:10px;flex-wrap:wrap;align-items:center;">
          <input type="text" class="input" name="q" placeholder="Cari nama / email / sekolah..."
                 value="<?= htmlspecialchars($q) ?>">
          <button class="btnx primary" type="submit">Cari</button>
          <a class="btnx" href="pengguna_admin.php">Reset</a>
        </form>
        <a class="btnx primary" href="pengguna_admin.php?action=create">+ Tambah Pengguna</a>
      </div>

      <div class="user-grid">
        <?php if (empty($list)): ?>
          <p>Data pengguna kosong.</p>
        <?php else: foreach ($list as $p): ?>
          <div class="user-card">
            <div class="avatar">
              <?= strtoupper(substr($p['nama_pengguna'],0,1)) ?>
            </div>
            <div class="user-meta">
              <div class="line"><b>Username :</b> <?= htmlspecialchars($p['nama_pengguna']) ?></div>
              <div class="line"><b>Email :</b> <?= htmlspecialchars($p['email']) ?></div>
              <div class="line"><b>Sekolah :</b> <?= htmlspecialchars($p['nama_sekolah'] ?? '-') ?></div>
              <div class="line"><b>Ranking :</b> <?= $ranking[$p['pengguna_id']] ?? '-' ?></div>
            </div>
            <div class="actions">
              <a class="btnx primary"
                 href="pengguna_admin.php?action=edit&id=<?= (int)$p['pengguna_id'] ?>">Edit</a>
              <form method="post" action="pengguna_admin.php?action=delete"
                    onsubmit="return confirm('Hapus pengguna ini?')">
                <input type="hidden" name="id" value="<?= (int)$p['pengguna_id'] ?>">
                <button class="btnx danger" type="submit" style="border:none;">Hapus</button>
              </form>
            </div>
          </div>
        <?php endforeach; endif; ?>
      </div>

    </div>
  </div>
</div>

</body>
</html>
