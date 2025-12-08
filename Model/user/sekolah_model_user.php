<?php

function koneksi(){
    return new mysqli("localhost","root","","diary_learning_db");
}

function ambil_data_detail_sekolah($id){
    $koneksi = koneksi();
    $result = $koneksi->query("SELECT nama_sekolah,nama_pengguna,judul FROM sekolah JOIN pengguna ON sekolah.sekolah_id = pengguna.sekolah_id JOIN progress_belajar ON pengguna.pengguna_id = progress_belajar.pengguna_id JOIN master_modul ON progress_belajar.level_id = master_modul.level_id WHERE sekolah.sekolah_id = '$id'");

    $ls_detail_sekolah = [];
    while ($row = $result->fetch_assoc()){
        $ls_detail_sekolah[] = $row;
    }
    return $ls_detail_sekolah;
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