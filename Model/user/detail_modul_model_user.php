<?php

function koneksi() {
    return new mysqli("localhost", "root", "", "diary_learning_db");
}

function ambil_last_level_selesai($pengguna_id) {
    $koneksi = koneksi();
    $pengguna_id = (int)$pengguna_id;
    $result = $koneksi->query("SELECT MAX(level_id) as last_level FROM progress_belajar WHERE pengguna_id = $pengguna_id");
    $row = $result->fetch_assoc();
    $koneksi->close();
    return $row['last_level'] ? (int)$row['last_level'] : 0;
}

function ambil_judul_modul($level_id) {
    $koneksi = koneksi();
    $level_id = (int)$level_id;
    $result = $koneksi->query("SELECT judul FROM master_modul WHERE level_id = $level_id");
    if (!$result || $result->num_rows === 0) die("Modul tidak ditemukan");
    $judul = $result->fetch_assoc()['judul'];
    $koneksi->close();
    return $judul;
}

function ambil_soal_modul($level_id) {
    $koneksi = koneksi();
    $level_id = (int)$level_id;
    $result = $koneksi->query("SELECT id, kata, arti, contoh_kalimat FROM kosakata WHERE level_id = $level_id ORDER BY id");
    $soal = [];
    while ($row = $result->fetch_assoc()) {
        $soal[] = $row;
    }
    $koneksi->close();
    return $soal;
}

function hitung_skor($challenges, $answers) {
    $benar = 0;
    $total = count($challenges);
    for ($i = 0; $i < $total; $i++) {
        $user_ans = isset($answers[$i]) ? trim(strtolower($answers[$i])) : '';
        $correct  = trim(strtolower($challenges[$i]['arti']));
        if ($user_ans === $correct) $benar++;
    }
    return round(($benar / $total) * 100);
}

function simpan_progress($pengguna_id, $level_id, $modul_judul, $skor) {
    $koneksi = koneksi();
    $materi_terakhir = "Selesai: $modul_judul";
    $tanggal = date('Y-m-d');
    $stmt = $koneksi->prepare("INSERT INTO progress_belajar (pengguna_id, level_id, judul_progress, materi_terakhir, skor, tanggal_akses) VALUES (?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("iissss", $pengguna_id, $level_id, $modul_judul, $materi_terakhir, $skor, $tanggal);
    $stmt->execute();
    $stmt->close();
    $koneksi->close();
}
