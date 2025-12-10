<?php

function koneksi() {
    return new mysqli("localhost", "root", "", "diary_learning_db");
}

function ambil_semua_modul() {
    $koneksi = koneksi();
    $result = $koneksi->query("SELECT level_id, judul, deskripsi FROM master_modul ORDER BY level_id");
    $moduls = [];
    while ($row = $result->fetch_assoc()) {
        $moduls[] = $row;
    }
    $koneksi->close();
    return $moduls;
}

function ambil_last_level_selesai($pengguna_id) {
    $koneksi = koneksi();
    $pengguna_id = (int)$pengguna_id;
    $result = $koneksi->query("SELECT MAX(level_id) as last_level FROM progress_belajar WHERE pengguna_id = $pengguna_id");
    $row = $result->fetch_assoc();
    $koneksi->close();
    return $row['last_level'] ? (int)$row['last_level'] : 0;
}