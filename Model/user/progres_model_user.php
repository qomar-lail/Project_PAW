<?php
function get_connection() {
    return mysqli_connect("localhost", "root", "", "diary_learning_db");
}

function ambil_data_progres($id) {
    $conn = get_connection();
    $result = mysqli_query($conn, "SELECT MAX(level_id) as level_sekarang FROM progress_belajar WHERE pengguna_id = '$id'");

    $rows_1 = [];
    while($row = mysqli_fetch_assoc($result)) {
        if($row["level_sekarang"] == 1){
            $row["level_sekarang"] = 20;
        }elseif($row["level_sekarang"]==2){
            $row["level_sekarang"]=40;
        }elseif($row["level_sekarang"]==3){
            $row["level_sekarang"]=60;
        }elseif($row["level_sekarang"]==4){
            $row["level_sekarang"]=80;
        }else{
            $row["level_sekarang"]=100;
        }
        $rows_1[] = $row;
    }
    return $rows_1;
}
