<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

$_SESSION["halaman"] = "Pengguna";
$no = 1;
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ranking Pengguna</title>
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
    
    <div class="d-flex">
        
        <div class="sidebar-wrapper">
             <?php include "sidebar.php" ?>
        </div>

        <div class="conten px-3 flex-grow-1" style="padding-top:70px; width: 100%;">
            
            <div class="text-primary mb-4">
                <h4><i class="fa-solid fa-trophy text-warning"></i> Leaderboard Pengguna</h4>
                <p>Peringkat siswa berdasarkan Level dan Total Skor.</p>
            </div>

            <div>
                <div >
                    <table class="table table-striped table-hover m-0 align-middle">
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
                            <?php if(empty($ls_data)): ?>
                                <tr>
                                    <td colspan="5" class="text-center py-5 text-muted">Belum ada data siswa.</td>
                                </tr>
                            <?php else: ?>
                                <?php foreach($ls_data as $row): ?>
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
                                                <span class="fw-bold"><?= $row['nama_pengguna'] ?></span>
                                            </div>
                                        </td>
                                        <td>
                                            <?php 
                                                if(empty($row['nama_sekolah'])) {
                                                    echo '<span class="text-muted fst-italic">Tidak Dalam Sekolah</span>';
                                                } else {
                                                    echo $row['nama_sekolah'];
                                                }
                                            ?>
                                        </td>
                                        <td class="text-center">
                                            <?php 
                                                $level = $row['level_sekarang'] ?? '-';
                                                $badge = 'bg-secondary';
                                                if($level == 'Expert') $badge = 'bg-danger';
                                                elseif($level == 'Advanced') $badge = 'bg-warning text-dark';
                                                elseif($level == 'Intermediate') $badge = 'bg-primary';
                                                elseif($level == 'Elementary') $badge = 'bg-info text-dark';
                                                elseif($level == 'Beginner') $badge = 'bg-success';
                                            ?>
                                            <span class="badge <?= $badge ?> rounded-pill px-3"><?= $level ?></span>
                                        </td>
                                        <td class="text-center fw-bold text-primary fs-5">
                                            <?= $row['total_skor'] ?>
                                        </td>
                                    </tr>
                                    <?php $no++; ?>
                                <?php endforeach; ?>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>

        </div> </div> </body>
</html>