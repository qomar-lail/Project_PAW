<?php
session_start();
require_once __DIR__ . "../../../Model/user/modul_model.php";

function modul_index() {

    // ✅ WAJIB LOGIN
    if (!isset($_SESSION['id'])) {
        header("Location: form_login.php");
        exit();
    }

    $pengguna_id = $_SESSION['id'];

    $moduls = ambil_semua_modul();
    $last_level_completed = ambil_last_level_selesai($pengguna_id);

    $_SESSION['_moduls'] = $moduls;
    $_SESSION['_last_level'] = $last_level_completed;
    $_SESSION['_pengguna_id'] = $pengguna_id;

    require_once __DIR__ . "../../../View/user/modul_view.php";
}
