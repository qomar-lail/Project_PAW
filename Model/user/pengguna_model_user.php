<?php

function get_connection() {
    return mysqli_connect("localhost", "root", "", "diary_learning");
}

function ambil_data_pengguna() {
    $conn = get_connection();
    $result = mysqli_query($conn, "SELECT * FROM pengguna");

    $rows_1 = [];
    while($row = mysqli_fetch_assoc($result)) {
        $rows_1[] = $row;
    }

    $select = mysqli_query($conn,"SELECT * FROM pengguna LEFT JOIN sekolah ON pengguna.id_sekolah = sekolah.sekolah_id");

    $rows_2 = [];
    while($row = mysqli_fetch_assoc($select)){
        $rows_2[] = $row;
    }

    return $rows_2;
}
