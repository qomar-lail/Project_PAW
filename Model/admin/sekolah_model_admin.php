<?php
require_once __DIR__ . "/../user/koneksi.php";

function ambil_data_detail_sekolah($cari=""){
    global $conn;
    $cari_data = trim($cari ?? '');
    $where = '';
    if ($cari_data !== '') {
        $esc = $conn->real_escape_string($cari_data);
        $where = "WHERE nama_sekolah LIKE '%$esc%'";
    }

    $list = [];
    $r = $conn->query("SELECT * FROM sekolah $where ORDER BY sekolah_id ASC");
    if ($r) while($row = $r->fetch_assoc()) $list[] = $row;
    return $list;
}

function ambil_sekolah_by_id($id){
    global $conn;
    $id = (int)$id;
    $r = $conn->query("SELECT * FROM sekolah WHERE sekolah_id=$id LIMIT 1");
    return $r ? $r->fetch_assoc() : null;
}
