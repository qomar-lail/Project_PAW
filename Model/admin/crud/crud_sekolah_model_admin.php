<?php

function conn(){
    $koneksi = new mysqli("localhost","root","","diary_learning_db");
    return $koneksi;
}


function tambah_data($post){
    $conn = conn();
    if ($post === 'POST') {
        echo "masuk ke tambah";
        $nama = trim($_POST['nama_sekolah'] ?? '');
        if ($nama === '') {
            $error = "Nama sekolah wajib diisi.";
        } else {
            $n = $conn->real_escape_string($nama);
            if ($conn->query("INSERT INTO sekolah (nama_sekolah) VALUES ('$n')")) {
                header("Location: sekolah_view_admin.php?msg=created");
                exit;
            }
            $error = "Gagal menambah sekolah.";
        }
    }
    echo "tidak masuk ke tambah";
}


// /* EDIT */
// if ($action === 'edit' && $_SERVER['REQUEST_METHOD'] === 'POST') {
//     $nama = trim($_POST['nama_sekolah'] ?? '');
//     if ($nama === '') {
//         $error = "Nama sekolah wajib diisi.";
//     } else {
//         $n = $conn->real_escape_string($nama);
//         if ($conn->query("UPDATE sekolah SET nama_sekolah='$n' WHERE sekolah_id=$id_sekolah LIMIT 1")) {
//             header("Location: sekolah_admin.php?msg=updated");
//             exit;
//         }
//         $error = "Gagal mengubah sekolah.";
//     }
// }



// /* DELETE */
// if ($action === 'delete' && $_SERVER['REQUEST_METHOD'] === 'POST') {
//     $id = (int)($_POST['id'] ?? 0);
//     if ($conn->query("DELETE FROM sekolah WHERE sekolah_id=$id LIMIT 1")) {
//         header("Location: sekolah_admin.php?msg=deleted");
//         exit;
//     } else {
//         header("Location: sekolah_admin.php?msg=faildelete");
//         exit;
//     }
// }

// /* DATA EDIT */
// $edit_data = null;
// if ($action === 'edit' && $id_sekolah > 0) {
//     $r = $conn->query("SELECT * FROM sekolah WHERE sekolah_id=$id_sekolah LIMIT 1");
//     if ($r && $r->num_rows === 1) {
//         $edit_data = $r->fetch_assoc();
//     } else {
//         $action = 'index';
//         $msg = 'notfound';
//     }
// }
// ?>
