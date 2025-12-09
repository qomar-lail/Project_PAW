<?php
$_SESSION["halaman"] = "Sekolah";
$active    = 'sekolah';
$pageTitle = "Sekolah";

$action = $_GET['action'] ?? 'index';
$msg    = $_GET['msg'] ?? '';
$error  = '';
$id_sekolah = isset($_GET['id']) ? (int)$_GET['id'] : 0;

?>


<!doctype html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <title>Admin | Sekolah</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <link rel="stylesheet" href="../../../Project_PAW/View/admin/css/admin.css">
</head>
<body>

<div class="admin-shell">
    <?php include "sidebar_admin.php"?>

    <div class="admin-main">
        <?php include "navigation_admin.php"; ?>

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
            <input type="text" class="input" name="cari" placeholder="Cari nama sekolah..." value="<?= htmlspecialchars($cari_data ?? '') ?>">
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
            <?php if (empty($ls_data_sekolah)): ?>
                <tr><td colspan="3">Data sekolah kosong.</td></tr>
            <?php else: foreach ($ls_data_sekolah as $s): ?>
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
