<?php
require_once __DIR__ . "/../../user/koneksi.php";

function crud_pengguna_create(){
    global $conn;

    $nama  = trim($_POST['nama_pengguna'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $pw    = $_POST['password'] ?? '';
    $sid   = ($_POST['sekolah_id'] ?? '') === '' ? null : (int)$_POST['sekolah_id'];

    $skor = 0;

    if ($nama==='' || $email==='' || $pw==='') {
        return "Nama, email, dan password wajib diisi.";
    }

    $n = $conn->real_escape_string($nama);
    $e = $conn->real_escape_string($email);
    $p = md5($pw);

    $sql = "INSERT INTO pengguna (nama_pengguna, email, password, sekolah_id, total_skor)
            VALUES ('$n', '$e', '$p', ".($sid===null?'NULL':$sid).", $skor)";

    if ($conn->query($sql)) {
        header("Location: /Project_PAW/pengguna_admin.php?msg=created");
        exit;
    }

    return "Gagal menambah pengguna.";
}

function crud_pengguna_update($id){
    global $conn;
    $id = (int)$id;

    $nama  = trim($_POST['nama_pengguna'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $pw    = $_POST['password'] ?? '';
    $sid   = ($_POST['sekolah_id'] ?? '') === '' ? null : (int)$_POST['sekolah_id'];

    $rawSkor = trim($_POST['total_skor'] ?? '');
    $skor = ($rawSkor === '' ? 0 : (int)$rawSkor);

    if ($nama==='' || $email==='') {
        return "Nama dan email wajib diisi.";
    }

    $n = $conn->real_escape_string($nama);
    $e = $conn->real_escape_string($email);

    $set_pw = ($pw==='') ? "" : ", password='".md5($pw)."'";

    $sql = "UPDATE pengguna
            SET nama_pengguna='$n',
                email='$e',
                sekolah_id=".($sid===null?'NULL':$sid).",
                total_skor=$skor
                $set_pw
            WHERE pengguna_id=$id
            LIMIT 1";

    if ($conn->query($sql)) {
        header("Location: /Project_PAW/pengguna_admin.php?msg=updated");
        exit;
    }

    return "Gagal mengubah pengguna.";
}

function crud_pengguna_delete($id){
    global $conn;
    $id = (int)$id;

    if ($conn->query("DELETE FROM pengguna WHERE pengguna_id=$id LIMIT 1")) {
        header("Location: /Project_PAW/pengguna_admin.php?msg=deleted");
        exit;
    }

    header("Location: /Project_PAW/pengguna_admin.php?msg=faildelete");
    exit;
}
