<?php
require_once __DIR__ . "/../../user/koneksi.php";

function crud_sekolah_create(){
    global $conn;

    $nama = trim($_POST['nama_sekolah'] ?? '');
    if ($nama === '') return "Nama sekolah wajib diisi.";

    $n = $conn->real_escape_string($nama);
    if ($conn->query("INSERT INTO sekolah (nama_sekolah) VALUES ('$n')")) {
        header("Location: /Project_PAW/sekolah_admin.php?msg=created");
        exit;
    }
    return "Gagal menambah sekolah.";
}

function crud_sekolah_update($id){
    global $conn;

    $id = (int)$id;
    $nama = trim($_POST['nama_sekolah'] ?? '');
    if ($nama === '') return "Nama sekolah wajib diisi.";

    $n = $conn->real_escape_string($nama);
    if ($conn->query("UPDATE sekolah SET nama_sekolah='$n' WHERE sekolah_id=$id LIMIT 1")) {
        header("Location: /Project_PAW/sekolah_admin.php?msg=updated");
        exit;
    }
    return "Gagal mengubah sekolah.";
}

function crud_sekolah_delete($id){
    global $conn;

    $id = (int)$id;
    if ($conn->query("DELETE FROM sekolah WHERE sekolah_id=$id LIMIT 1")) {
        header("Location: /Project_PAW/sekolah_admin.php?msg=deleted");
        exit;
    }
    header("Location: /Project_PAW/sekolah_admin.php?msg=faildelete");
    exit;
}
