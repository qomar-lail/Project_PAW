<?php

function koneksi(){
    return new mysqli("localhost","root","","diary_learning_db");
}

function ambil_data_detail_sekolah($cari=" "){
    $conn = koneksi();
    $cari_data = trim($cari ?? '');
    $where = '';
    if ($cari_data !== '') {
        $esc = $conn->real_escape_string($cari_data);
        $where = "WHERE nama_sekolah LIKE '%$esc%'";
    }
    $list = [];
    $r = $conn->query("SELECT * FROM sekolah $where ORDER BY sekolah_id ASC");
    if ($r) while($row = $r->fetch_assoc()) $list[] = $row;
}

function ambil_data_sekolah(){
    $koneksi = koneksi();
    $result = $koneksi->query('SELECT * FROM sekolah');

    $ls_sekolah = [];
    while ($row = $result->fetch_assoc()){
        $ls_sekolah[] = $row;
    }
    return $ls_sekolah;
}?>