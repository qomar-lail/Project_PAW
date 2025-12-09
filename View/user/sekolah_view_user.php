<?php


$_SESSION["halaman"] = "Sekolah";
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
    <link rel="stylesheet" href="View/user/css/sekolah.css">
    <link rel="stylesheet" href="View/user/css/navigation.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body>
    <div>
        <?php include "navigation.php"?>
    </div>
    <div class="conten px-3" style="padding-top:70px;">
        <div class="">
            <h3 class="text-primary">Daftar Sekolah</h3>
            <p class="p-0">Temukan dan jelajahi profil sekolah lain di sini.</p>
        </div>
        <div>
            <div class="d-flex gap-1 align-items-center">
                <h4 class="text-primary p-0">Semua Sekolah</h4>
                <h5 class="text-secondary text-center p-0"><?= count($ls_data)?? '' ?></h5>
            </div>
        </div>
        <div class="cards d-flex flex-md-wrap gap-3 mt-3 mb-3">
            <?php foreach($ls_data as $sekolah) : ?>
                <a href="sekolah.php?id=<?= $sekolah["sekolah_id"] ?>">
                    <div class="kartu rounded-3 shadow-sm p-2 bg-primary" style="width: 230px;">
                    <i class="fa-solid fa-school text-light"></i>
                    <h6 class="text-light"><?= $sekolah["nama_sekolah"] ?></h6>
                    </div>
                </a>
            <?php endforeach ?>
        </div>
        <?php if(isset($ls_data_detail)): ?>
            <div>
                <h6>Daftar Siswa di sekolah</h6>
            </div>
            <div class="my-3">
                <table class="table table-striped mt-3">
                    <tr>
                        <th class="text-primary">No</th>
                        <th class="text-primary">Nama_siswa</th>
                        <th class="text-primary">Sekolah</th>
                        <th class="text-primary">Level</th>
                    </tr>
                    <?php foreach($ls_data_detail as $dt_sekolah): ?>
                        <tr>
                            <td><?= $no ?></td>
                            <td><i class="fa-solid fa-circle-user text-primary "></i> <?= $dt_sekolah["nama_pengguna"] ?? '' ?></td>
                            <td><?= $dt_sekolah["nama_sekolah"] ?? 'Tidak Dalam Sekolah' ?></td>
                            <td><?= $dt_sekolah["judul"] ?? '' ?></td>
                        </tr>
                        <?php $no+=1 ?>
                    <?php endforeach?>
                </table>
            </div>
        <?php endif?>
    </div>
</body>
</html>