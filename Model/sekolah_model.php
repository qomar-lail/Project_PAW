<?php

function koneksi(){
    return new mysqli("localhost","root","","diary_learning");
}

function ambil_data_sekolah(){
    $koneksi = koneksi();
    $result = $koneksi->query("SELECT * FROM sekolah");

    $ls_sekolah = [];
    while ($row = $result->fetch_assoc()){
        $ls_sekolah[] = $row;
    }
    return $ls_sekolah;
}

?>