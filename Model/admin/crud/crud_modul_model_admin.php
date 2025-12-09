<?php
require_once __DIR__ . "/../../user/koneksi.php";

function crud_modul_create(){
    global $conn;

    $judul = trim($_POST['judul'] ?? '');
    $desk  = trim($_POST['deskripsi'] ?? '');

    if ($judul === '') return "Judul wajib diisi.";

    $j = $conn->real_escape_string($judul);
    $d = $conn->real_escape_string($desk);

    if ($conn->query("INSERT INTO master_modul (judul, deskripsi) VALUES ('$j', '$d')")) {
        header("Location: /Project_PAW/modul_admin.php?msg=created");
        exit;
    }
    return "Gagal menambah modul.";
}

function crud_modul_update($id){
    global $conn;

    $id = (int)$id;
    $judul = trim($_POST['judul'] ?? '');
    $desk  = trim($_POST['deskripsi'] ?? '');

    if ($judul === '') return "Judul wajib diisi.";

    $j = $conn->real_escape_string($judul);
    $d = $conn->real_escape_string($desk);

    if ($conn->query("UPDATE master_modul SET judul='$j', deskripsi='$d' WHERE level_id=$id LIMIT 1")) {
        header("Location: /Project_PAW/modul_admin.php?msg=updated");
        exit;
    }
    return "Gagal mengubah modul.";
}

function crud_modul_delete($id){
    global $conn;

    $id = (int)$id;
    if ($conn->query("DELETE FROM master_modul WHERE level_id=$id LIMIT 1")) {
        header("Location: /Project_PAW/modul_admin.php?msg=deleted");
        exit;
    }
    header("Location: /Project_PAW/modul_admin.php?msg=faildelete");
    exit;
}
