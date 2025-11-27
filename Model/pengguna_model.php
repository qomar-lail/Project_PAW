<?php

function get_connection() {
    return mysqli_connect("localhost", "root", "", "diary_learning");
}

function ambil_data_pengguna() {
    $conn = get_connection();
    $result = mysqli_query($conn, "SELECT * FROM pengguna");

    $rows = [];
    while($row = mysqli_fetch_assoc($result)) {
        $rows[] = $row;
    }

    return $rows;
}
