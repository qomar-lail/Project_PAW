<?php

function get_connection() {
    return mysqli_connect("localhost", "root", "", "diary_learning");
}

function get_all_modul() {
    $conn = get_connection();
    $result = mysqli_query($conn, "SELECT * FROM modul");

    $rows = [];
    while($row = mysqli_fetch_assoc($result)) {
        $rows[] = $row;
    }

    return $rows;
}
