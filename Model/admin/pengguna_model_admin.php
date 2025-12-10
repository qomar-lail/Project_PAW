<?php
require_once __DIR__ . "/../user/koneksi.php";

function ambil_data_detail_pengguna($cari=""){
    global $conn;
    $cari_data = trim($cari ?? '');
    $where = '';
    if ($cari_data !== '') {
        $esc = $conn->real_escape_string($cari_data);
        $where = "WHERE p.nama_pengguna LIKE '%$esc%' OR p.email LIKE '%$esc%' OR s.nama_sekolah LIKE '%$esc%'";
    }

    $list = [];
    $sql = "SELECT p.*, s.nama_sekolah
            FROM pengguna p
            LEFT JOIN sekolah s ON p.sekolah_id = s.sekolah_id
            $where
            ORDER BY p.pengguna_id ASC";
    $r = $conn->query($sql);
    if ($r) while($row = $r->fetch_assoc()) $list[] = $row;
    return $list;
}

function ambil_pengguna_by_id($id){
    global $conn;
    $id = (int)$id;
    $r = $conn->query("SELECT * FROM pengguna WHERE pengguna_id=$id LIMIT 1");
    return $r ? $r->fetch_assoc() : null;
}

function ambil_opsi_sekolah(){
    global $conn;
    $list=[];
    $r = $conn->query("SELECT sekolah_id,nama_sekolah FROM sekolah ORDER BY nama_sekolah ASC");
    if ($r) while($row=$r->fetch_assoc()) $list[]=$row;
    return $list;
}
