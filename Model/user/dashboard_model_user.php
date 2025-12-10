<?php

function ambil_data_siswa(){

    $conn = new mysqli('localhost','root','','diary_learning_db');
    
    $data_yang_sekolah = "SELECT COUNT(*) as banyak_siswa FROM pengguna WHERE sekolah_id IS NOT NULL";
    $result = $conn->query($data_yang_sekolah);
    $data_siswa = 0;
    $row = $result->fetch_assoc();
    $data_siswa = $row["banyak_siswa"];
    return $data_siswa;
}

function ambil_bukan_siswa(){
    $conn = new mysqli('localhost','root','','diary_learning_db');
    
    $data_tidak_sekolah = "SELECT COUNT(*) as total FROM pengguna WHERE sekolah_id is NULL";
    $resul = $conn->query($data_tidak_sekolah);
    $data_bukan_siswa = 0;
    $row = $resul->fetch_assoc();
    $data_bukan_siswa = $row["total"];

    return $data_bukan_siswa;
}




?>