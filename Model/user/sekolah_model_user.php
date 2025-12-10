<?php
function ambil_semua_sekolah() {
    global $conn;
    $ls_data = [];
    $sql = "SELECT * FROM sekolah";
    
    if (isset($conn) && $conn) {
        $result = mysqli_query($conn, $sql);
        if ($result && mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                $ls_data[] = $row;
            }
        }
    }
    return $ls_data;
}

function ambil_siswa_sekolah($id_sekolah = null) {
    global $conn;
    $ls_data_detail = [];

    $sql = "SELECT 
                p.pengguna_id,
                p.nama_pengguna, 
                s.nama_sekolah,
                (SELECT COALESCE(SUM(pb.skor), 0) 
                 FROM progress_belajar pb 
                 WHERE pb.pengguna_id = p.pengguna_id) as total_skor,
                (SELECT m.judul FROM progress_belajar pb 
                 JOIN master_modul m ON pb.level_id = m.level_id 
                 WHERE pb.pengguna_id = p.pengguna_id 
                 ORDER BY pb.level_id DESC LIMIT 1) as level_sekarang,
                (SELECT pb.level_id FROM progress_belajar pb 
                 WHERE pb.pengguna_id = p.pengguna_id 
                 ORDER BY pb.level_id DESC LIMIT 1) as angka_level
            FROM pengguna p
            INNER JOIN sekolah s ON p.sekolah_id = s.sekolah_id";

    if ($id_sekolah != null && isset($conn)) {
        $safe_id = mysqli_real_escape_string($conn, $id_sekolah);
        $sql .= " WHERE p.sekolah_id = '$safe_id' ";
    }

    $sql .= " ORDER BY angka_level DESC, total_skor DESC";

    if (isset($conn) && $conn) {
        $result = mysqli_query($conn, $sql);
        if ($result && mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                $ls_data_detail[] = $row;
            }
        }
    }
    
    return $ls_data_detail;
}
?>