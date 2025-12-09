<?php
require_once __DIR__ . "/../user/koneksi.php";

function ambil_data_detail_modul($cari=""){
    global $conn;
    $cari_data = trim($cari ?? '');
    $where = '';
    if ($cari_data !== '') {
        $esc = $conn->real_escape_string($cari_data);
        $where = "WHERE judul LIKE '%$esc%' OR deskripsi LIKE '%$esc%'";
    }

    $list = [];
    $r = $conn->query("SELECT * FROM master_modul $where ORDER BY level_id ASC");
    if ($r) while($row = $r->fetch_assoc()) $list[] = $row;
    return $list;
}

function ambil_modul_by_id($id){
    global $conn;
    $id = (int)$id;
    $r = $conn->query("SELECT * FROM master_modul WHERE level_id=$id LIMIT 1");
    return $r ? $r->fetch_assoc() : null;
}
