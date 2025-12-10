<?php
session_start();
require_once __DIR__ . "/../../Model/user/detail_modul_model_user.php";

function detail_modul_index() {
    $pengguna_id = $_SESSION['user_id'] ?? 1;
    $level_id    = isset($_GET['level']) ? (int)$_GET['level'] : 0;
    $current     = isset($_GET['current']) ? (int)$_GET['current'] : 0;

    // Validasi akses level
    $last_level_completed = ambil_last_level_selesai($pengguna_id);
    if ($level_id > $last_level_completed + 1) {
        $_SESSION['error'] = "Anda belum menyelesaikan modul sebelumnya! Silakan selesaikan Modul " . $last_level_completed . " terlebih dahulu.";
        header("Location: modul.php");
        exit();
    }

    // Ambil data modul & soal
    $modul_judul = ambil_judul_modul($level_id);
    $challenges = ambil_soal_modul($level_id);

    if (empty($challenges)) {
        die("Tidak ada soal.");
    }

    if ($current >= count($challenges)) $current = count($challenges) - 1;
    if ($current < 0) $current = 0;

    $current_challenge = $challenges[$current];
    $total = count($challenges);

    // Proses jawaban
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['jawaban'])) {
        if (!isset($_SESSION['answers'])) $_SESSION['answers'] = [];
        $_SESSION['answers'][$current] = trim($_POST['jawaban']);

        if ($current < $total - 1) {
            header("Location: detail_modul.php?level=$level_id&current=" . ($current + 1));
            exit();
        } else {
            // Hitung skor dan simpan
            $skor = hitung_skor($challenges, $_SESSION['answers']);
            simpan_progress($pengguna_id, $level_id, $modul_judul, $skor);
            unset($_SESSION['answers']);
            $_SESSION['success'] = "Modul $modul_judul berhasil diselesaikan! Skor: $skor%";
            header("Location: modul.php");
            exit();
        }
    }

    // Load view
    require_once __DIR__ . "/../../View/user/detail_modul_view_user.php";
}
