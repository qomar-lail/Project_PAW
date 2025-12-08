<?php


$_SESSION["halaman"] = "Pengguna";
$no = 1;
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <script defer src="./package/jquery/jquery.js"></script>
    <script defer src="./js/sidebar.js"></script>
    <script defer src="./js/main.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="View/user/css/sidebar.css">
    <link rel="stylesheet" href="View/user/css/dasboard.css">
    <link rel="stylesheet" href="View/user/css/navigation.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body>
    <div>
        <?php include "navigation.php"?>
    </div>
    <div class="conten px-3" style="padding-top:70px;">
        <div class="">
            <h3 class="text-primary">Daftar Pengguna</h3>
            <p class="p-0">Temukan dan jelajahi profil pengguna lain di sini.</p>
        </div>
        <div class="d-flex justify-content-between">
            <div class="d-flex gap-1 align-items-center">
                <h4 class="text-primary p-0">Semua Pengguna</h4>
                <h5 class="text-secondary text-center p-0"><?= count($ls_data)?? '' ?></h5>
            </div>
            <div class="tombol d-flex gap-2">
                <h4 class="text-primary"></h4>
                <form action="" class="d-flex gap-1">
                    <input type="text" class="form-control" id="cari" placeholder="Cari Pengguna..." style="height: 30px;">
                    <button class="btn btn-primary p-0 px-2 d-flex align-items-center gap-1" name="cari" style="height: 30px;"><i class="fa-solid fa-magnifying-glass fa-xs"></i>Temukan</button>
                </form>
            </div>
        </div>
        <div>
            <table class="table table-striped">
                <tr>
                    <th class="text-primary">No</th>
                    <th class="text-primary">Nama</th>
                    <th class="text-primary">Sekolah</th>
                    <th class="text-primary">Tanggal Pembuatan</th>
                </tr>
                <?php foreach($ls_data as $pengguna): ?>
                    <tr>
                        <td><?= $no ?></td>
                        <td><i class="fa-solid fa-circle-user text-primary "></i> <?= $pengguna["nama_pengguna"] ?? '' ?></td>
                        <td><?= $pengguna["nama_sekolah"] ?? 'Tidak Masuk Sekolah' ?></td>
                        <td><?= $pengguna["created_at"] ?? '' ?></td>
                    </tr>
                    <?php $no+=1 ?>
                <?php endforeach?>
            </table>
        </div>
    </div>
</body>
</html>