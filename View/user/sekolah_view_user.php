<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
$_SESSION["halaman"] = "Sekolah";
$no = 1;
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Sekolah</title>
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
    <?php include "navigation.php"?>

    <div class="conten px-3" style="padding-top:70px;">
        
        <div class="mb-3">
            <h3 class="text-primary">Daftar Sekolah</h3>
            <p class="p-0">Temukan dan jelajahi profil sekolah lain di sini.</p>
        </div>
        
        <div class="d-flex gap-1 align-items-center mb-3">
            <h4 class="text-primary p-0">Semua Sekolah</h4>
            <h5 class="text-secondary text-center p-0"><?= count($ls_data) ?? '0' ?></h5>
        </div>

        <div class="cards d-flex flex-md-wrap gap-3 mt-3 mb-4">
            <?php foreach($ls_data as $sekolah) : ?>
                <a href="sekolah.php?id=<?= $sekolah["sekolah_id"] ?>" style="text-decoration: none;">
                    <div class="kartu rounded-3 shadow-sm p-2 bg-primary" style="width: 230px; transition: 0.3s;">
                        <i class="fa-solid fa-school text-light"></i>
                        <h6 class="text-light"><?= $sekolah["nama_sekolah"] ?></h6>
                    </div>
                </a>
            <?php endforeach ?>
        </div>

        <?php if(!empty($ls_data_detail)): ?>
            
            <div class="d-flex justify-content-between align-items-center border-bottom pb-2 mb-3">
                <h5 class="mb-0 text-dark">
                    <i class="fa-solid fa-trophy text-warning"></i> Leaderboard Sekolah
                </h5>
                <?php if(isset($_GET['id'])): ?>
                    <a href="sekolah.php" class="btn btn-sm btn-outline-secondary">Tutup Tabel</a>
                <?php endif; ?>
            </div>

            <div class=" shadow-sm border-0 rounded-3">
                <div class="card-body p-0">
                    <table class="table table-striped table-hover m-0 z-n1 align-middle">
                        <thead class="table-primary">
                            <tr>
                                <th class="py-3 ps-4" style="width: 80px;">Rank</th>
                                <th class="py-3">Nama Siswa</th>
                                <th class="py-3">Sekolah</th>
                                <th class="py-3 text-center">Level</th>
                                <th class="py-3 text-center">Total Skor</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php foreach($ls_data_detail as $dt_sekolah): ?>
                            <tr class="<?= $no <= 3 ? 'table-warning' : '' ?>">
                                <td class="ps-4 fw-bold">
                                    <?php 
                                        if($no == 1) echo "🥇 1";
                                        elseif($no == 2) echo "🥈 2";
                                        elseif($no == 3) echo "🥉 3";
                                        else echo $no;
                                    ?>
                                </td>
                                <td>
                                    <div class="d-flex align-items-center gap-2">
                                        <i class="fa-solid fa-circle-user fa-lg text-secondary"></i>
                                        <span class="fw-bold"><?= $dt_sekolah["nama_pengguna"] ?></span>
                                    </div>
                                </td>
                                <td><?= $dt_sekolah["nama_sekolah"] ?></td>
                                <td class="text-center">
                                    <?php 
                                        $level = $dt_sekolah["level_sekarang"] ?? '-';
                                        $badge = 'bg-secondary';
                                        if($level == 'Expert') $badge = 'bg-danger';
                                        elseif($level == 'Advanced') $badge = 'bg-warning text-dark';
                                        elseif($level == 'Intermediate') $badge = 'bg-primary';
                                        elseif($level == 'Elementary') $badge = 'bg-info text-dark';
                                        elseif($level == 'Beginner') $badge = 'bg-success';
                                    ?>
                                    <span class="badge <?= $badge ?> rounded-pill px-3">
                                        <?= $level ?>
                                    </span>
                                </td>
                                <td class="text-center fw-bold text-primary fs-5">
                                    <?= $dt_sekolah["total_skor"] ?>
                                </td>
                            </tr>
                            <?php $no++ ?>
                        <?php endforeach?>
                        </tbody>
                    </table>
                </div>
            </div>
        <?php endif?>

        <?php if(isset($_GET['id']) && empty($ls_data_detail)): ?>
            <div class="alert alert-info mt-3">Belum ada siswa di sekolah ini.</div>
        <?php endif; ?>

    </div>
</body>
</html>